<?php

namespace App\Http\Livewire\Siptadah;

use App\Models\Request as ModelsRequest;
use Carbon\Carbon;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use PhpOffice\PhpWord\TemplateProcessor;
use Spatie\Permission\Models\Role;

class Index extends LivewireDatatable
{
    public $model = ModelsRequest::class;
    public $exportable = true;
    public $hideable = 'select';

    public function builder()
    {
        if (auth()->user()->id == 1) {
            return ModelsRequest::query();
        }
        return ModelsRequest::query()
            ->where('user_id', auth()->user()->id);
    }

    public function columns()
    {
        $roles = Role::select('name')->get();
        $asal_instansi = [];
        foreach ($roles as $role) {
            $asal_instansi[$role->name] = $role->name;
        }

        $columns = [

            Column::name('no_surat_permohonan')
                ->label('Nomor Surat')
                ->searchable(),

            Column::name('email')
                ->label('Email')
                ->hide(),

            Column::name('no_hp')
                ->label('Nomor Hp')
                ->hide(),


            Column::name('jenis_permohonan')
                ->label('Jenis Permohonan')
                ->filterable(['penyitaan' => 'penyitaan', 'penggeledahan' => 'penggeledahan']),

            Column::name('pasal')
                ->label('Pasal')
                ->hide(),

            Column::callback('status', function ($status) {
                switch ($status) {
                    case '0':
                        $set_status = '<span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">Dalam Antrian</span>';
                        break;
                    case '1':
                        $set_status = '<span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-500 rounded-full">Sedang Diproses</span>';
                        break;
                    case '2':
                        $set_status = '<span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-yellow-500 rounded-full">Disetujui</span>';
                        break;
                    case '3':
                        $set_status = '<span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full">Ditolak</span>';
                        break;
                    case '4':
                        $set_status = '<span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-green-500 rounded-full">Selesai</span>';
                        break;
                }
                return $set_status;
            })
                ->defaultSort('asc')
                ->label('Status')
                ->filterable([0 => 'Dalam Antrian', 1 => 'Sedang Diproses', 2 => 'Disetujui', 3 => 'Ditolak', 4 => 'Selesai']),

            DateColumn::name('created_at')
                ->defaultSort('ASC')
                ->label('Dibuat'),

            Column::callback(['id', 'status'], function ($id, $status) {
                return view('siptadah-table-actions', ['id' => $id, 'status' => $status]);
            })
                ->label('Aksi')
                ->alignCenter(),
        ];

        if (auth()->user()->hasRole(['admin', 'Admin'])) {
            $first_column = [
                Column::name('asal_instansi')
                    ->label('Instansi')
                    ->filterable($asal_instansi)
                    ->searchable(),
            ];
            $columns = array_merge($first_column, $columns);
        }

        return $columns;
    }

    public function delete($id)
    {
        $request = ModelsRequest::findOrFail($id);
        if ($request->user_id == auth()->user()->id || auth()->user()->hasRole(['Admin', 'admin'])) {
            return $request->delete();
        }
    }

    public function export_sp($id)
    {
        $request = ModelsRequest::findOrFail($id);
        $evidence_lists = ModelsRequest::findOrFail($id)->evidence_lists;
        $surat = new TemplateProcessor(storage_path('app/template/' . $request->jenis_permohonan . '.docx'));
        $surat->setValues([
            'no_surat_permohonan' => $request->no_surat_permohonan,
            'tgl_surat_permohonan' => Carbon::parse($request->tgl_surat_permohonan)->isoFormat('D MMMM Y'),
            'pasal' => $request->pasal,
            'nama_tersangka' => ucfirst($request->nama_tersangka),
            'tempat_lahir' => $request->tempat_lahir,
            'umur' => Carbon::parse($request->tgl_lahir)->age,
            'tgl_lahir' => Carbon::parse($request->tgl_lahir)->isoFormat('D MMMM Y'),
            'jenis_kelamin' => $request->jenis_kelamin,
            'kebangsaan' => $request->kebangsaan,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'tgl_sekarang' => Carbon::now()->isoFormat('D MMMM Y'),
        ]);

        $surat->cloneBlock('list_barang_bukti', count($evidence_lists), true, true);
        $no = 1;
        foreach ($evidence_lists as $key => $evidence_list) {
            $surat->setValue('barang_bukti#' . $no, $evidence_list->barang_bukti);
            $no++;
        }

        $file_name = 'Surat ' . ucfirst($request->jenis_permohonan) . ' ' . $request->no_surat_permohonan . '.docx';
        $surat->saveAs($file_name);
        return response()->download(public_path($file_name))->deleteFileAfterSend();
    }

    public function export_ticket($id)
    {
        $request = ModelsRequest::findOrFail($id);

        $evidence_lists = ModelsRequest::findOrFail($id)->evidence_lists;

        $ticket = new TemplateProcessor(storage_path('app/template/e-ticket-siptadah.docx'));
        $ticket->setValues([
            'id' => $request->id,
            'asal_instansi' => $request->asal_instansi,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'no_surat_permohonan' => $request->no_surat_permohonan,
            'tgl_surat_permohonan' => Carbon::parse($request->tgl_surat_permohonan)->isoFormat('D MMMM Y'),
            'jenis_permohonan' => ucfirst($request->jenis_permohonan),
            'penyitaan_penggeledahan' => $request->penyitaan_penggeledahan,
            'tgl_sita_geledah' => Carbon::parse($request->tgl_sita_geledah)->isoFormat('D MMMM Y'),
            'pasal' => $request->pasal,
            'sumber' => $request->sumber,
            'nama_tersangka' => ucfirst($request->nama_tersangka),
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => Carbon::parse($request->tgl_lahir)->isoFormat('D MMMM Y'),
            'umur' => Carbon::parse($request->tgl_lahir)->age,
            'alamat' => $request->alamat,
            'tgl_sekarang' => Carbon::now()->isoFormat('D MMMM Y'),
        ]);

        $files = [
            ['name' => 'Surat Permohonan', 'link' => $request->berkas_surat_permohonan],
            ['name' => 'Laporan Polisi', 'link' => $request->berkas_laporan_polisi],
            ['name' => 'Surat Perintah Penyitaan/Penggeledahan', 'link' => $request->berkas_sp_pp],
            ['name' => 'Berita Acara Penyitaan/Penggeledahan', 'link' => $request->berkas_berita_acara],
            ['name' => 'Surat Tanda Penerimaan', 'link' => $request->berkas_surat_penerimaan],
            ['name' => 'Surat Perintah Penyidikan', 'link' => $request->berkas_sp_penyidikan],
            ['name' => 'Surat Perintah Dimulainya Penyidikan (SPDP)', 'link' => $request->berkas_spdp],
            ['name' => 'Resume', 'link' => $request->berkas_resume]
        ];

        //Jumlah dokumen yang diupload
        foreach ($files as $document) {
            if (isset($document['link'])) {
                $documents[]['name'] = $document['name'];
            }
        }

        if (!isset($documents)) {
            $documents[]['name'] = 'Tidak ada berkas yang diunggah.';
        }

        $ticket->cloneBlock('list_berkas', count($documents), true, true);
        $no = 1;
        foreach ($documents as $key => $berkas) {
            $ticket->setValue('berkas#' . $no, $berkas['name']);
            $no++;
        }

        $ticket->cloneBlock('list_barang_bukti', count($evidence_lists), true, true);
        $no = 1;
        foreach ($evidence_lists as $key => $evidence_list) {
            $ticket->setValue('barang_bukti#' . $no, $evidence_list->barang_bukti);
            $no++;
        }

        $file_name = 'E-ticket ' . $request->no_surat_permohonan . '.docx';
        $ticket->saveAs($file_name);
        return response()->download(public_path($file_name))->deleteFileAfterSend();
    }
}
