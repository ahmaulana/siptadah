<div>
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="bg-gray-100 bg-gray-100 font-sans overflow-hidden">
            <div class="flex justify-end ... my-2 mx-2">
                <span class="inline-flex rounded-md">
                    <a href="{{ route('kelola-user.index') }}" class="bg-white text-gray-700 text-xs px-4 py-2 rounded shadow hover:bg-gray-50 outline-none focus:outline-none mr-1 mb-1">
                        User
                    </a>
                    <a href="{{ route('kelola-role.index') }}" class="bg-white text-gray-700 text-xs px-4 py-2 rounded shadow hover:bg-gray-50 outline-none focus:outline-none mr-1 mb-1">
                        Role
                    </a>
                </span>
            </div>
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Permission</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($permissions as $permission)
                    <tr class="border-b border-gray-200 {{ $loop->even ? 'bg-gray-50' : '' }} hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="font-medium">{{ $permission->id }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span>{{ $permission->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a wire:click="edit({{ $permission->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a wire:click="delete({{ $permission->id }})">
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
                    <button type="button" wire:click="create" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Tambah Permission
                    </button>
                </span>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div>
        <!-- Token Value Modal -->
        <x-jet-dialog-modal wire:model="modalAddPermission">
            <x-slot name="title">
                {{ ($edit) ? 'Edit' : 'Tambah' }}
                {{ __('Permission') }}
            </x-slot>

            <x-slot name="content">
                <div x-data="{}" x-init="$refs.name.focus()">
                    <x-jet-label for="name" value="{{ __('Nama Permission') }}" />
                    <x-jet-input id="name" x-ref="name" wire:model="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
                </div>
                @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
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
        <x-jet-confirmation-modal wire:model="modalDeletePermission">
            <x-slot name="title">
                {{ __('Hapus Data') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Anda yakin ingin menghapus permission: ' . $name) }}
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
</div>