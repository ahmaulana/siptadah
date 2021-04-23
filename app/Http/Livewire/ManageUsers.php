<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class ManageUsers extends Component
{
    public $modalAddUser, $modalDeleteUser = false;
    public $edit = false;
    public $user_id, $name, $email, $password, $password_confirmation, $role_id;
    public $permissionList = [];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
        'role_id' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Nama user tidak boleh kosong!',
        'email.required' => ':attribute tidak boleh kosong!',
        'email.email' => ':attribute tidak valid!',
        'password.required' => ':attribute tidak boleh kosong!',
        'password.confirmed' => 'Konfirmasi :attribute salah!',
        'password.min' => ':attribute minimal 6 karakter',
        'role_id.required' => ':attribute tidak boleh kosong!',
    ];

    public function render()
    {
        $userAndRole = [];
        $users = User::where('id', '!=', 1)->orWhere('name', '!=', 'admin')->get();
        foreach ($users as $user) {
            $user->role = $user->getRoleNames();
            $userAndRole[] = $user;
        }
        $roles = DB::table('roles')->get();
        return view('livewire.manage-users', compact(['userAndRole', 'roles']));
    }

    public function openModal($name)
    {
        if ($name == 'add') {
            $this->modalAddUser = true;
        } else {
            $this->modalDeleteUser = true;
        }
    }

    public function closeModal($name)
    {
        if ($name == 'add') {
            $this->modalAddUser = false;
            $this->resetInputFields();
        } else {
            $this->modalDeleteUser = false;
        }
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role_id = '';
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

        $user = User::find($id);

        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;        

        $this->role_id = isset($user->roles->first()->id) ? $user->roles->first()->id : '';
        $this->openModal('add');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->openModal('delete');
    }

    public function destroy()
    {        
        $user_id = $this->user_id;
        DB::transaction(function () use ($user_id) {
            //Delete User
            $user = User::where('id', '=', $user_id)->delete();

            //Delete User Role
            $role = DB::table('model_has_roles')->where('model_id', $user_id)->delete();            
        });

        $this->closeModal('delete');
    }

    public function submit()
    {
        if ($this->edit) {
            $this->password = '12345678';
            $this->password_confirmation = '12345678';
        }
        //Validasi input     
        $data = $this->validate();

        if (!$this->edit) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                ['name' => $data['name'], 'password' => Hash::make($data['password'])]
            );
        } else {
            $user = User::where('id', $this->user_id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }

        //Set User Role
        $user = User::where('email', $data['email'])->first();
        $getRole = Role::find($data['role_id']);
        $user->syncRoles($getRole->name);

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $this->closeModal('add');        
    }
}
