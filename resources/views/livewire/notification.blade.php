<div>
    <div x-data="{ dropdownOpen: false }">
        <input type="text" wire:model="total" hidden>        
        <button wire:click.prevent="notificationClick" @click="dropdownOpen = !dropdownOpen" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none">
            <!-- Heroicon name: solid/check -->
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
            </svg>
            {{ $total }}
        </button>

        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

        <div x-show="dropdownOpen" class="absolute mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20" style="width:20rem; right:8%">
            @foreach($notifications as $notification)
            <div>
                <button class="px-4 py-3 border-0 hover:bg-gray-300 -mx-2 focus:outline-none">
                    <div class="mx-2 text-left">
                        <p class="text-gray-600 text-md">
                            {{ $notification->message }}                            
                        </p>
                        <div class="text-gray-500 text-sm">{{ $notification->updated_at->diffForHumans() }}</div>
                    </div>
                </button>
            </div>
            @endforeach
            <div class="block bg-gray-800 text-white text-center font-bold py-2"></div>
        </div>
    </div>
</div>