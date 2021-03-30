<div>
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="bg-gray-100 bg-gray-100 font-sans overflow-hidden">
            <div class="flex justify-end ... my-2 mx-2">
                <span class="inline-flex rounded-md">
                    <a href="{{ route('kelola-role.index') }}" class="bg-white text-gray-700 text-xs px-4 py-2 rounded shadow hover:bg-gray-50 outline-none focus:outline-none mr-1 mb-1">
                        Role
                    </a>
                    <a href="{{ route('kelola-permission.index') }}" class="bg-white text-gray-700 text-xs px-4 py-2 rounded shadow hover:bg-gray-50 outline-none focus:outline-none mr-1 mb-1">
                        Permission
                    </a>
                </span>
            </div>
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">User</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-center">Role</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($userAndRole as $user)
                    <tr class="border-b border-gray-200 {{ $loop->even ? 'bg-gray-50' : '' }} hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="font-medium">{{ $user->id }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span>{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span>{{ $user->email }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex items-center justify-center">
                                @foreach($user->role as $role)
                                {{ $role }}
                                @endforeach
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a wire:click="edit({{ $user->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                </div>                                
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a wire:click="delete({{ $user->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </div>                                
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-2 mx-2">
                <span class="inline-flex rounded-md">
                    <button wire:click="create" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Tambah User
                    </button>
                </span>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div>
        <!-- Token Value Modal -->
        <x-jet-dialog-modal wire:model="modalAddUser">
            <x-slot name="title">
                {{ ($edit) ? 'Edit' : 'Tambah' }}
                {{ __('User') }}
            </x-slot>

            <x-slot name="content">
                <div class="my-2">
                    <x-jet-label for="name" value="{{ __('Nama User') }}" />
                    <x-jet-input id="name" wire:model="name" class="block mt-1 w-full" type="text" name="name" />
                </div>
                @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
                <div class="my-2">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" wire:model="email" class="block mt-1 w-full" type="email" name="email" />
                </div>
                @error('email') <span class="error text-red-500">{{ $message }}</span> @enderror
                @if(!$edit)
                <div class="my-2">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" wire:model="password" class="block mt-1 w-full" type="password" name="password" />
                </div>
                @error('password') <span class="error text-red-500">{{ $message }}</span> @enderror
                <div class="my-2">
                    <x-jet-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                    <x-jet-input id="password_confirmation" wire:model="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                </div>
                @endif
                <div class="my-2">
                    <label class="block font-medium text-sm text-gray-700" for="role_id">
                        Sebagai
                    </label>
                    <select wire:model="role_id" name="role_id" class="block mt-1 w-full border-gray-300">
                        <option value="">Pilih Role...</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('role_id') <span class="error text-red-500">{{ $message }}</span> @enderror
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="closeModal('add')" wire:loading.attr="disabled">
                    {{ __('Batal') }}
                </x-jet-secondary-button>

                <x-jet-button wire:click="submit" class="ml-2 bg-indigo-600 hover:bg-indigo-700" wire:loading.attr="disabled">
                    {{ ($edit) ? 'Edit' : 'Simpan' }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>

    <!-- Delete Modal -->
    <div>
        <x-jet-confirmation-modal wire:model="modalDeleteUser">
            <x-slot name="title">
                {{ __('Hapus User') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Anda yakin ingin menghapus user: ' . $name) }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="closeModal('delete')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="destroy" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </div>
</div>