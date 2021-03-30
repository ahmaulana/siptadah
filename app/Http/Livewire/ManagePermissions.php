<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ManagePermissions extends Component
{
    public $modalAddPermission, $modalDeletePermission = false;
    public $edit = false;
    public $permission_id, $name;
    public $guard_name = 'web';

    protected $rules = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Nama permission tidak boleh kosong!',
    ];

    public function render()
    {
        $permissions = DB::table('permissions')->get();
        return view('livewire.manage-permissions', compact(['permissions']));
    }

    public function openModal($name)
    {
        if ($name == 'add') {
            $this->modalAddPermission = true;
        } else {
            $this->modalDeletePermission = true;
        }
    }

    public function closeModal($name)
    {
        if ($name == 'add') {
            $this->modalAddPermission = false;
            $this->resetInputFields();
        } else {
            $this->modalDeletePermission = false;
        }
    }

    public function resetInputFields()
    {
        $this->permission_id = '';
        $this->name = '';
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

        $permission = DB::table('permissions')->find($id);

        $this->permission_id = $id;
        $this->name = $permission->name;
        $this->openModal('add');
    }

    public function delete($id)
    {
        $permission = DB::table('permissions')->find($id);
        $this->permission_id = $id;
        $this->name = $permission->name;
        $this->openModal('delete');
    }

    public function destroy()
    {
        $permission = DB::table('permissions')->where('id', '=', $this->permission_id)->delete();
        $this->closeModal('delete');
    }

    public function submit()
    {
        //Validasi input     
        $data = $this->validate();

        //Simpan ke db
        if (!$this->edit) {
            DB::table('permissions')->upsert(
                [
                    'name' => $this->name,
                    'guard_name' => $this->guard_name,
                ],
                ['name']
            );
            $message = "Permission berhasil ditambahkan";
        } else {
            DB::table('permissions')->where('id', $this->permission_id)->update([
                'name' => $this->name,
            ]);
            $message = "Permission berhasil diperbarui";
        }

        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', 'success');

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $this->closeModal('add');
    }
}
