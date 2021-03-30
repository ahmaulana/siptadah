<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManageRoles extends Component
{
    public $modalAddRole, $modalDeleteRole = false;
    public $edit = false;
    public $role_id, $name;
    public $guard_name = 'web';
    public $permissionList = [];

    protected $rules = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Nama role tidak boleh kosong!',
    ];

    public function mount()
    {
        $permissions = Permission::all();        
        foreach ($permissions as $key => $permission) {
            $this->permissionList[$key]['name'] = $permission->name;
            $this->permissionList[$key]['id'] = $permission->id;
            $this->permissionList[$key]['status'] = false;
        }
    }

    public function render()
    {
        $roles = Role::get();    
        $roleAndPermission = [];
        foreach($roles as $role){
            $role->permission = $role->permissions;
            $roleAndPermission[] = $role;
        }        
        $permissions = $this->permissionList;
        return view('livewire.manage-roles', compact(['roleAndPermission', 'permissions']));
    }

    public function openModal($name)
    {
        if ($name == 'add') {
            $this->modalAddRole = true;
        } else {
            $this->modalDeleteRole = true;
        }
    }

    public function closeModal($name)
    {
        if ($name == 'add') {
            $this->modalAddRole = false;
            $this->resetInputFields();
        } else {
            $this->modalDeleteRole = false;
        }
    }

    public function resetInputFields()
    {
        $this->role_id = '';
        $this->name = '';
        for ($i = 0; $i < count($this->permissionList); $i++) {
            $this->permissionList[$i]['status'] = false;
        }
    }

    public function create()
    {
        $this->edit = false;
        $this->resetInputFields();
        $this->openModal('add');
    }

    public function edit($id)
    {
        $this->edit = true;

        $role = Role::find($id);

        $this->role_id = $id;
        $this->name = $role->name;

        for ($i = 0; $i < count($this->permissionList); $i++) {            
            $this->permissionList[$i]['status'] = $role->hasPermissionTo($this->permissionList[$i]['name']) == true ? true : false;
        }        

        $this->openModal('add');
    }

    public function delete($id)
    {
        $role = DB::table('roles')->find($id);
        $this->role_id = $id;
        $this->name = $role->name;
        $this->openModal('delete');
    }

    public function destroy()
    {
        if($this->role_id != 1 || $this->name != 'admin'){
            $role = Role::where('id', $this->role_id);
            $role->delete();
        }
        $this->closeModal('delete');
    }

    public function submit()
    {
        //Validasi input     
        $data = $this->validate();

        //Simpan ke db
        if (!$this->edit) {
            DB::table('roles')->upsert(
                [
                    'name' => $this->name,
                    'guard_name' => $this->guard_name,
                ],
                ['name']
            );
            $message = "Role berhasil ditambahkan";
        } else {
            DB::table('roles')->where('id', $this->role_id)->update([
                'name' => $this->name,
            ]);
            $message = "Role berhasil diperbarui";
        }

        //Set Permission
        $role = DB::table('roles')->where('name', $this->name)->first();

        foreach ($this->permissionList as $key => $permission) {
            if ($permission['status']) {
                DB::table('role_has_permissions')->upsert(
                    [
                        'permission_id' => $permission['id'],
                        'role_id' => $role->id,
                    ],
                    ['permission_id', 'role_id']
                );
            } else {
                DB::table('role_has_permissions')->where('permission_id', $permission['id'])->where('role_id', $role->id)->delete();
            }
        }

        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', 'success');

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();    
        $this->closeModal('add');
    }
}
