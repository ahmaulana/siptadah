<?php

namespace App\Http\Livewire\Prisoner;

use App\Models\Prisoner;
use Carbon\Carbon;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use PhpOffice\PhpWord\TemplateProcessor;
use Spatie\Permission\Models\Role;

class Index extends LivewireDatatable
{
    public $model = Prisoner::class;
    public $exportable = true;

    public function builder()
    {
        if (auth()->user()->id == 1) {
            return Prisoner::query();
        }
        return Prisoner::query()
            ->where('user_id', auth()->user()->id);
    }

    public function columns()
    {
        $roles = Role::select('name')->get();
        $asal_instansi = [];
        foreach ($roles as $role) {
            $asal_instansi[] = $role->name;
        }

        return [
            NumberColumn::name('id'),

            Column::name('asal_instansi')
                ->label('Asal Instansi')
                ->filterable($asal_instansi)
                ->searchable(),

            Column::name('no_surat')
                ->label('Nomor Surat')
                ->filterable(['penyitaan', 'penggeledahan']),

            Column::name('status')
                ->label('Status')
                ->filterable(['menunggu', 'sedang diproses', 'disetujui', 'ditolak', 'selesai']),

            DateColumn::name('updated_at')
                ->label('Diperbarui'),

            Column::callback(['id', 'status'], function ($id, $status) {
                return view('prisoner-table-actions', ['id' => $id, 'status' => $status]);
            })
                ->label('Aksi')->alignCenter(),
        ];
    }

    public function export_sp($id)
    {
        $request = Prisoner::findOrFail($id);
        $evidence_lists = Prisoner::findOrFail($id)->evidence_lists;
        $surat = new TemplateProcessor(storage_path('app/template/prisoner.docx'));
        $surat->setValues([
            'no_surat' => $request->no_surat,
            'tgl_surat' => Carbon::parse($request->tgl_surat)->isoFormat('D MMMM Y'),            
            'nama_tersangka' => ucfirst($request->nama_tersangka),
            'tempat_lahir' => $request->tempat_lahir,
            'umur' => Carbon::parse($request->tgl_lahir)->age,
            'tgl_lahir' => Carbon::parse($request->tgl_lahir)->isoFormat('D MMMM Y'),
            'jenis_kelamin' => $request->jenis_kelamin,            
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'tgl_sekarang' => Carbon::now()->isoFormat('D MMMM Y'),
        ]);        

        $file_name = 'Perpanjangan Tahanan ' . ucfirst($request->jenis_permohonan) . ' ' . $request->no_surat . '.docx';
        $surat->saveAs($file_name);
        return response()->download(public_path($file_name))->deleteFileAfterSend();
    }

    public function export_ticket($id)
    {
        $request = Prisoner::findOrFail($id);        

        $ticket = new TemplateProcessor(storage_path('app/template/e-ticket-prisoner.docx'));
        $ticket->setValues([
            'id' => $request->id,
            'asal_instansi' => $request->asal_instansi,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'no_surat' => $request->no_surat,
            'tgl_surat' => Carbon::parse($request->tgl_surat)->isoFormat('D MMMM Y'),            
            'nama_tersangka' => ucfirst($request->nama_tersangka),
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => Carbon::parse($request->tgl_lahir)->isoFormat('D MMMM Y'),
            'umur' => Carbon::parse($request->tgl_lahir)->age,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'tgl_sekarang' => Carbon::now()->isoFormat('D MMMM Y'),
        ]);

        $files = [
            ['name' => 'Surat Permohonan', 'link' => $request->berkas_surat_permohonan],
            ['name' => 'Laporan Polisi', 'link' => $request->berkas_laporan_polisi],
            ['name' => 'Surat Perintah Penyidikan', 'link' => $request->berkas_sp_penyidikan],
            ['name' => 'Surat Perintah Dimulainya Penyidikan (SPDP)', 'link' => $request->berkas_spdp],
            ['name' => 'Penetapan Penahanan Penyidik', 'link' => $request->berkas_penetapan_penahanan_penyidik],
            ['name' => 'Penetapan Perpanjangan Penahanan', 'link' => $request->berkas_penetapan_perpanjangan_penahanan],
            ['name' => 'Berita Acara', 'link' => $request->berkas_berita_acara],            
            ['name' => 'Resume', 'link' => $request->berkas_resume]
        ];        

        //Jumlah dokumen yang diupload
        foreach ($files as $document) {
            if (isset($document['link'])) {
                $documents[]['name'] = $document['name'];
            }
        }

        $ticket->cloneBlock('list_berkas', count($documents), true, true);
        $no = 1;
        foreach ($documents as $key => $berkas) {
            $ticket->setValue('berkas#' . $no, $berkas['name']);
            $no++;
        }        

        $file_name = 'E-ticket ' . $request->no_surat . '.docx';
        $ticket->saveAs($file_name);
        return response()->download(public_path($file_name))->deleteFileAfterSend();
    }

    public function delete($id)
    {
        $request = Prisoner::findOrFail($id);
        if ($request->user_id == auth()->user()->id || auth()->user()->hasRole(['Admin', 'admin'])) {
            $request->delete();
        }
    }
}
