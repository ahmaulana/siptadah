<div x-data="{
                'errors': {{ json_encode(array_keys($errors->getMessages())) }},
                focusField(input) {
                    fieldError = document.getElementById(input);
                    if (fieldError) {
                        fieldError.focus({preventScroll:false});
                    }
                },
            }" x-init="() => { $watch('errors', value => focusField(value[0])) }">
    <form wire:submit.prevent="update">
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Data Permohonan</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Deskripsi singkat...
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="nama_pemohon" class="block text-sm font-medium text-gray-700">Nama Pemohon</label>
                                    <input type="text" wire:model="nama_pemohon" id="nama_pemohon" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('nama_pemohon') <span class="error text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor Hp</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            +62
                                        </span>
                                        <input type="number" wire:model="no_hp" id="no_hp" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="">
                                    </div>
                                    @error('no_hp') <span class="error text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="no_surat_permohonan" class="block text-sm font-medium text-gray-700">Nomor Surat Permohonan</label>
                                    <input type="text" wire:model="no_surat_permohonan" id="no_surat_permohonan" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('no_surat_permohonan') <span class="error text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="tgl_surat_permohonan" class="block text-sm font-medium text-gray-700">Tanggal Surat Permohonan</label>
                                    <input type="date" wire:model="tgl_surat_permohonan" id="tgl_surat_permohonan" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('tgl_surat_permohonan') <span class="error text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <fieldset>
                                        <div>
                                            <legend class="text-sm font-medium text-gray-900">Jenis Permohonan yang Diajukan</legend>
                                        </div>
                                        <div class="mt-4 space-y-4">
                                            <div class="flex items-center">
                                                <input id="penyitaan" wire:model="jenis_permohonan" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="penyitaan">
                                                <label for="penyitaan" class="ml-3 block text-sm font-medium text-gray-700">
                                                    Penyitaan
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="penggeledahan`" wire:model="jenis_permohonan" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="penggeledahan">
                                                <label for="penggeledahan" class="ml-3 block text-sm font-medium text-gray-700">
                                                    Penggeledahan
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    @error('jenis_permohonan') <span class="error text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4"">
                                    <fieldset>
                                        <div>
                                            <legend class=" text-sm font-medium text-gray-900">Apakah Kegiatan PENYITAAN/PENGGELEDAHAN tersebut sudah dilaksakan?</legend>
                                </div>
                                <div class="mt-4 space-y-4">
                                    <div class="flex items-center">
                                        <input @click="open = true" id="sudah" wire:model="penyitaan_penggeledahan" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="sudah">
                                        <label for="sudah" class="ml-3 block text-sm font-medium text-gray-700">
                                            Sudah
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input @click="open = false" id="belum`" wire:model="penyitaan_penggeledahan" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="belum">
                                        <label for="belum" class="ml-3 block text-sm font-medium text-gray-700">
                                            Belum
                                        </label>
                                    </div>
                                </div>
                                </fieldset>
                                @error('penyitaan_penggeledahan') <span class="error text-red-500">{{ $message }}</span> @enderror
                                <div class="mt-4 col-span-6 sm:col-span-4">
                                    <label for="tgl_sita_geledah" class="block text-sm font-medium text-gray-700">Tanggal Sita Geledah</label>
                                    <input type="date" wire:model="tgl_sita_geledah" id="tgl_sita_geledah" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('tgl_sita_geledah') <span class="error text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
        <div class="border-t border-gray-200"></div>
    </div>
</div>

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Berkas-Berkas</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Deskripsi singkat...
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <fieldset>
                                <div class="mt-4 space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" wire:click="$toggle('suratPermohonan')" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" @if($suratPermohonan) checked @else @endif>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label class="font-medium text-gray-700">Surat Permohonan (ditujukan kepada Ketua Pengadilan Negeri Kendal)</label>
                                        </div>
                                    </div>

                                    @if($suratPermohonan)
                                    <div class="flex items-start">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <input type="file" wire:model="berkas_surat_permohonan" id="berkas_surat_permohonan" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                        @if($file_surat_permohonan['link'])
                                        <div class="mt-1 ml-1 col-span-6 sm:col-span-3">
                                            <label class="text-sm font-medium text-gray-700">Berkas saat ini:
                                                <a wire:click="download('{{ $file_surat_permohonan['link'] }}','{{ $file_surat_permohonan['name'] }}')" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                    Lihat
                                                </a>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                    @error('berkas_surat_permohonan') <span class="error text-red-500">{{ $message }}</span> @enderror
                                    @endif
                                    <div>
                                        <div wire:loading wire:target="berkas_surat_permohonan">Mohon tunggu...</div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" wire:click="$toggle('laporanPolisi')" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" @if($laporanPolisi) checked @else @endif>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label class="font-medium text-gray-700">Laporan Polisi</label>
                                        </div>
                                    </div>

                                    @if($laporanPolisi)
                                    <div class="flex items-start">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <input type="file" wire:model="berkas_laporan_polisi" id="berkas_laporan_polisi" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                        @if($file_laporan_polisi['link'])
                                        <div class="mt-1 ml-1 col-span-6 sm:col-span-3">
                                            <label class="text-sm font-medium text-gray-700">Berkas saat ini: <a wire:click="download('{{ $file_laporan_polisi['link'] }}','{{ $file_laporan_polisi['name'] }}')" class="font-medium text-indigo-600 hover:text-indigo-500">Lihat</a>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                    @error('berkas_laporan_polisi') <span class="error text-red-500">{{ $message }}</span> @enderror
                                    @endif
                                    <div>
                                        <div wire:loading wire:target="berkas_laporan_polisi">Mohon tunggu...</div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" wire:click="$toggle('sppp')" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" @if($sppp) checked @else @endif>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label class="font-medium text-gray-700">Surat Perintah Penyitaan/Penggeledahan</label>
                                        </div>
                                    </div>

                                    @if($sppp)
                                    <div class="flex items-start">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <input type="file" wire:model="berkas_sp_pp" id="berkas_sp_pp" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                        @if($file_sp_pp['link'])
                                        <div class="mt-1 ml-1 col-span-6 sm:col-span-3">
                                            <label class="text-sm font-medium text-gray-700">Berkas saat ini: <a wire:click="download('{{ $file_sp_pp['link'] }}','{{ $file_sp_pp['name'] }}')" class="font-medium text-indigo-600 hover:text-indigo-500">Lihat</a>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                    @error('berkas_sp_pp') <span class="error text-red-500">{{ $message }}</span> @enderror
                                    @endif
                                    <div>
                                        <div wire:loading wire:target="berkas_sp_pp">Mohon tunggu...</div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" wire:click="$toggle('beritaAcara')" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" @if($beritaAcara) checked @else @endif>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label class="font-medium text-gray-700">Berita Acara Penyitaan/Penggeledahan (jika sudah dilaksanakan)</label>
                                        </div>
                                    </div>

                                    @if($beritaAcara)
                                    <div class="flex items-start">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <input type="file" wire:model="berkas_berita_acara" id="berkas_berita_acara" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                        @if($file_berita_acara['link'])
                                        <div class="mt-1 ml-1 col-span-6 sm:col-span-3">
                                            <label class="text-sm font-medium text-gray-700">Berkas saat ini: <a wire:click="download('{{ $file_berita_acara['link'] }}','{{ $file_berita_acara['name'] }}')" class="font-medium text-indigo-600 hover:text-indigo-500">Lihat</a>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                    @error('berkas_berita_acara') <span class="error text-red-500">{{ $message }}</span> @enderror
                                    @endif
                                    <div>
                                        <div wire:loading wire:target="berkas_berita_acara">Mohon tunggu...</div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" wire:click="$toggle('suratPenerimaan')" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" @if($suratPenerimaan) checked @else @endif>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label class="font-medium text-gray-700">Surat Tanda Penerimaan</label>
                                        </div>
                                    </div>

                                    @if($suratPenerimaan)
                                    <div class="flex items-start">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <input type="file" wire:model="berkas_surat_penerimaan" id="berkas_surat_penerimaan" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                        @if($file_surat_penerimaan['link'])
                                        <div class="mt-1 ml-1 col-span-6 sm:col-span-3">
                                            <label class="text-sm font-medium text-gray-700">Berkas saat ini: <a wire:click="download('{{ $file_surat_penerimaan['link'] }}','{{ $file_surat_penerimaan['name'] }}')" class="font-medium text-indigo-600 hover:text-indigo-500">Lihat</a>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                    @error('berkas_surat_penerimaan') <span class="error text-red-500">{{ $message }}</span> @enderror
                                    @endif
                                    <div>
                                        <div wire:loading wire:target="berkas_surat_penerimaan">Mohon tunggu...</div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" wire:click="$toggle('spPenyidikan')" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" @if($spPenyidikan) checked @else @endif>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label class="font-medium text-gray-700">Surat Perintah Penyidikan</label>
                                        </div>
                                    </div>

                                    @if($spPenyidikan)
                                    <div class="flex items-start">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <input type="file" wire:model="berkas_sp_penyidikan" id="berkas_sp_penyidikan" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                        @if($file_sp_penyidikan['link'])
                                        <div class="mt-1 ml-1 col-span-6 sm:col-span-3">
                                            <label class="text-sm font-medium text-gray-700">Berkas saat ini: <a wire:click="download('{{ $file_sp_penyidikan['link'] }}','{{ $file_sp_penyidikan['name'] }}')" class="font-medium text-indigo-600 hover:text-indigo-500">Lihat</a>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                    @error('berkas_sp_penyidikan') <span class="error text-red-500">{{ $message }}</span> @enderror
                                    @endif
                                    <div>
                                        <div wire:loading wire:target="berkas_sp_penyidikan">Mohon tunggu...</div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" wire:click="$toggle('spdp')" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" @if($spdp) checked @else @endif>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label class="font-medium text-gray-700">Surat Perintah Dimulainya Penyidikan (SPDP)</label>
                                        </div>
                                    </div>

                                    @if($spdp)
                                    <div class="flex items-start">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <input type="file" wire:model="berkas_spdp" id="berkas_spdp" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                        @if($file_spdp['link'])
                                        <div class="mt-1 ml-1 col-span-6 sm:col-span-3">
                                            <label class="text-sm font-medium text-gray-700">Berkas saat ini: <a wire:click="download('{{ $file_spdp['link'] }}','{{ $file_spdp['name'] }}')" class="font-medium text-indigo-600 hover:text-indigo-500">Lihat</a>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                    @error('berkas_spdp') <span class="error text-red-500">{{ $message }}</span> @enderror
                                    @endif
                                    <div>
                                        <div wire:loading wire:target="berkas_spdp">Mohon tunggu...</div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" wire:click="$toggle('resume')" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" @if($resume) checked @else @endif>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label class="font-medium text-gray-700">Resume (jika ada)</label>
                                        </div>
                                    </div>

                                    @if($resume)
                                    <div class="flex items-start">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <input type="file" wire:model="berkas_resume" id="berkas_resume" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                        @if($file_resume['link'])
                                        <div class="mt-1 ml-1 col-span-6 sm:col-span-3">
                                            <label class="text-sm font-medium text-gray-700">Berkas saat ini: <a wire:click="download('{{ $file_resume['link'] }}','{{ $file_resume['name'] }}')" class="font-medium text-indigo-600 hover:text-indigo-500">Lihat</a>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                    @error('berkas_resume') <span class="error text-red-500">{{ $message }}</span> @enderror
                                    @endif
                                    <div>
                                        <div wire:loading wire:target="berkas_resume">Mohon tunggu...</div>
                                    </div>

                                </div>
                            </fieldset>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
        <div class="border-t border-gray-200"></div>
    </div>
</div>

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Pasal & Bukti</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Deskripsi singkat...
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="pasal" class="block text-sm font-medium text-gray-700">Dugaan pasal yang dilanggar tersangka/terlapor</label>
                            <input type="text" wire:model="pasal" id="pasal" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('pasal') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="barang_bukti" class="block text-sm font-medium text-gray-700">
                                Daftar atau List Barang Bukti apa saja yang (telah/akan) dilakukan penyitaan/penggeledahan
                            </label>
                            @foreach($inputs as $key => $value)
                            <div class="col-span-6">
                                <div class="flex">
                                    <input type="text" wire:model="barang_bukti.{{ $key }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('barang_bukti.{{ $key }}') <span class="error text-red-500">{{ $message }}</span> @enderror

                                    <button wire:click.prevent="remove({{ $key }})" class="bg-red-700 ml-1 text-white text-xs px-4 py-2 rounded-full shadow hover:bg-red-900 outline-none focus:outline-none mr-1 mb-1" {{ count($inputs) == 1 ? 'disabled' : '' }}>Hapus</button>

                                </div>
                            </div>
                            @endforeach
                        </div>


                        <div class="col-span-6">
                            <div class="flex justify-center ...">
                                <button wire:click.prevent="add({{ $i }})" class="bg-indigo-700 text-white text-xs px-4 py-2 rounded-full shadow hover:bg-indigo-900 outline-none focus:outline-none mr-1 mb-1">Tambah</button>
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label for="sumber" class="block text-sm font-medium text-gray-700">
                                Barang Bukti diperoleh dari (diisi Nama dan Status)
                            </label>
                            <div class="mt-1">
                                <textarea id="sumber" wire:model="sumber" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                            @error('sumber') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
        <div class="border-t border-gray-200"></div>
    </div>
</div>

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Identitas Tersangka/Terlapor</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Deskripsi singkat...
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="nama_tersangka" class="block text-sm font-medium text-gray-700">Nama Tersangka/Terlapor (jika tersangka lebih dari satu, cukup tuliskan saja nama Tersangka/Terlapor pertama dan tambahkan 'Dkk' pada akhir nama)</label>
                            <input type="text" wire:model="nama_tersangka" id="nama_tersangka" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('nama_tersangka') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir Tersangka/Terlapor</label>
                            <input type="text" wire:model="tempat_lahir" id="tempat_lahir" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('tempat_lahir') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir Tersangka/Terlapor</label>
                            <input type="date" wire:model="tgl_lahir" id="tgl_lahir" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" onchange="dob(event)">
                            @error('tgl_lahir') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <script>
                            function dob(e) {
                                tgl_lahir = new Date(e.target.value);
                                var diff_ms = Date.now() - tgl_lahir.getTime();
                                var age_dt = new Date(diff_ms);
                                var usia = Math.abs(age_dt.getUTCFullYear() - 1970);
                                document.getElementById('usia').value = usia;
                            }
                        </script>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="usia" class="block text-sm font-medium text-gray-700">
                                Usia Tersangka/Terlapor
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" name="usia" id="usia" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" readonly>
                                <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    tahun
                                </span>
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select wire:model="jenis_kelamin" id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Pilih jenis kelamin...</option>
                                <option wire-click="$jenis_kelamin='Laki-laki'" value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="col-span-6">
                            <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                            <select wire:model="agama" id="agama" name="agama" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Pilih agama...</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>

                        <div class="col-span-6">
                            <label for="pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                            <input type="text" wire:model="pekerjaan" id="pekerjaan" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6">
                            <label for="kebangsaan" class="block text-sm font-medium text-gray-700">Kebangsaan</label>
                            <input type="text" wire:model="kebangsaan" id="kebangsaan" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('kebangsaan') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">
                                Alamat Tersangka/Terlapor
                            </label>
                            <div class="mt-1">
                                <textarea id="alamat" wire:model="alamat" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                            @error('alamat') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
</div>