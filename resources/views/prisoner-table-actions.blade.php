<div class="flex space-x-1 justify-around">
    @if($status == 'selesai')
    <a href="{{ route('tahanan.show', [$id]) }}" class="rounded-full border border-transparent shadow-sm text-xs font-medium rounded-md text-white bg-green-500 hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500  py-2 px-2">Selesai</a>
    @if(auth()->user()->hasRole(['admin','Admin']))
    <a wire:click="export_sp('{{ $id }}')" class="p-1 text-teal-600 hover:bg-teal-600 hover:text-white rounded">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
    </a>
    @endif
    @elseif($status == 'ditolak')    
    <a href="{{ route('tahanan.show', [$id]) }}" class="rounded-full border border-transparent shadow-sm text-xs font-medium rounded-md text-white bg-red-500 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500  py-2 px-2">Ditolak</a>
    @else
    @can('Lihat Permohonan')
    <a href="{{ route('tahanan.show', [$id]) }}" class="p-1 text-teal-600 hover:bg-teal-600 hover:text-white rounded">
        @can('Verifikasi Permohonan')
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
        @else
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
        </svg>
        @endcan
    </a>
    @endcan


    @if($status == 'menunggu' && !auth()->user()->hasRole(['admin','Admin']))
    @can('Edit Permohonan')
    <a href="{{ route('tahanan.edit', [$id]) }}" class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
        </svg>
    </a>
    @endcan
    @endif

    @if($status == 'disetujui')
    @if(auth()->user()->hasRole(['admin','Admin']))
    <a wire:click="export_sp('{{ $id }}')" class="p-1 text-teal-600 hover:bg-teal-600 hover:text-white rounded">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
    </a>
    @endif

    @if(!auth()->user()->hasRole(['admin','Admin']))
    <a wire:click="export_ticket('{{ $id }}')" class="p-1 text-teal-600 hover:bg-teal-600 hover:text-white rounded">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
        </svg>
    </a>
    @endif
    @endif

    @if($status == 'menunggu' || auth()->user()->hasRole(['admin','Admin']))
    <a wire:click="delete('{{ $id }}')" class="p-1 text-teal-600 hover:bg-teal-600 hover:text-white rounded">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
    </a>
    @endif
    @endif

</div>