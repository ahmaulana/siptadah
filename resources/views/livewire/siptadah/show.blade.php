<div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex">
            <div class="flex-1">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Applicant Information
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Personal details and application.
                </p>
            </div>
            <div class="flex-1 text-right sm:px-6">
                @if($data->status == 0 || $data->status == 1)
                @can('Verifikasi Siptadah')
                <button wire:click="verify('tolak')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Tolak
                </button>
                <button wire:click="verify('setuju')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Setuju
                </button>
                @else
                <div class="text-sm bg-green-600 text-white">
                    <p class="text-lg"><strong>Permohonan sedang diproses!</strong></p>
                    <p class="text-sm">Permohonan Anda sedang diproses, mohon menunggu</p>
                </div>
                @endcan
                @elseif($data->status == 2)
                @can('Verifikasi Siptadah')
                <button wire:click="verify('selesai')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Selesai
                </button>
                @else
                <div class="text-sm bg-green-600 text-white">
                    <p class="text-lg"><strong>Permohonan disetujui!</strong></p>
                    <p class="text-sm">Silahkan ambil dokumen ke kantor dengan membawa berkas-berkas dan e-ticket</p>
                </div>
                @endcan
                @elseif($data->status == 3)
                <div class="bg-red-600 text-white">
                    <p class="text-lg"><strong>Permohonan ditolak!</strong></p>
                    @cannot('Verifikasi Siptadah')
                    <p class="text-sm">Mohon maaf permohonan Anda tidak disetujui, silahkan ajukan permohonan baru</p>
                    @endcan
                </div>
                @else
                <div class="bg-green-600 text-white">
                    <p class="text-lg"><strong>Permohonan selesai!</strong></p>
                    <p class="text-sm">Permohonan selesai diproses pada {{ date('d/m/Y', strtotime($data->updated_at)) }}</p>
                </div>
                @endif
            </div>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Asal Instansi
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->asal_instansi }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Email/Nomor Hp
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->email . ' (+62' . $data->no_hp . ')' }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nomor Surat Permohonan
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->no_surat_permohonan }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tanggal Surat Permohonan
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ date('d/m/Y', strtotime($data->tgl_surat_permohonan)) }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Jenis Permohonan
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->jenis_permohonan . ' (' }}

                        {{ $data->penyitaan_penggeledahan == 'sudah' ? 'sudah dilakukan pada ' . date('d/m/Y', strtotime($data->tgl_sita_geledah)) : 'belum dilakukan' }}

                        {{ ')' }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Berkas-Berkas
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @php
                            $count_request = 0;
                            @endphp
                            @foreach($files as $file)
                            @if(isset($file['link']))
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <!-- Heroicon name: solid/paper-clip -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                        Berkas {{ $file['name'] }}
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <button wire:click="download('{{ $file['link'] }}','{{ $file['name'] }}')" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Download
                                    </button>
                                </div>
                            </li>
                            @php
                            $count_request ++;
                            @endphp
                            @endif
                            @endforeach
                            @if($count_request <= 0) <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                Tidak ada berkas yang diunggah
                                </li>
                                @endif
                        </ul>
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Dugaan pasal yang dilanggar tersangka/terlapor
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->pasal }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Daftar atau List Barang Bukti
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @foreach($barang_bukti as $bukti)
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <!-- Heroicon name: solid/paper-clip -->
                                    {{ $bukti->barang_bukti }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="mt-1">
                            Sumber: <strong>{{ $data->sumber }}</strong>
                        </div>
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nama Tersangka/Terlapor
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->nama_tersangka }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tempat, Tanggal Lahir
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->tempat_lahir . ', ' . date('d/m/Y', strtotime($data->tgl_lahir))}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Jenis Kelamin
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->jenis_kelamin }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Agama
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->agama }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Pekerjaan
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->pekerjaan }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Kebangsaan
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->kebangsaan }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Alamat Tersangka
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->alamat }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>