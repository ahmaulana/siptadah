<?php

namespace App\Http\Livewire;

use App\Models\Request as ModelsRequest;
use Carbon\Carbon;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use PhpOffice\PhpWord\TemplateProcessor;
use Spatie\Permission\Models\Role;

class Requests extends LivewireDatatable
{
    public $model = ModelsRequest::class;

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
            $asal_instansi[] = $role->name;
        }

        return [
            NumberColumn::name('id'),

            Column::name('asal_instansi')
                ->label('Asal Instansi')
                ->filterable($asal_instansi)
                ->searchable(),

            Column::name('jenis_permohonan')
                ->label('Jenis Permohonan')
                ->filterable(['penyitaan', 'penggeledahan']),

            Column::name('status')
                ->label('Status')
                ->filterable(['menunggu', 'sedang diproses', 'disetujui', 'ditolak']),

            DateColumn::name('updated_at')
                ->label('Diperbarui'),

            Column::callback(['id', 'status'], function ($id, $status) {
                return view('table-actions', ['id' => $id, 'status' => $status]);
            })
                ->label('Aksi')->alignCenter(),            
        ];
    }

    public function delete($id)
    {                
        $request = ModelsRequest::findOrFail($id);
        if($request->user_id == auth()->user()->id)
        {
            $request->delete();
        }
    }

    public function export_sp($id)
    {        
        $request = ModelsRequest::findOrFail($id);
        $evidence_lists = ModelsRequest::findOrFail($id)->evidence_lists;        
        $surat = new TemplateProcessor(storage_path('app/template/sita.docx'));
        $surat->setValues([
            'no_surat_permohonan' => $request->no_surat_permohonan,
            'tgl_surat_permohonan' => Carbon::parse($request->tgl_surat_permohonan)->isoFormat('D MMMM Y'),
            'pasal' => $request->pasal,
            'nama_tersangka' => $request->nama_tersangka,
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

        $file_name = 'surat ' . $request->jenis_permohonan . '.docx';
        $surat->saveAs($file_name);
        return response()->download(public_path($file_name))->deleteFileAfterSend();
    }

    public function export_ticket($id)
    {
        $request = ModelsRequest::findOrFail($id);

        $evidence_lists = ModelsRequest::findOrFail($id)->evidence_lists;

        $ticket = new TemplateProcessor(storage_path('app/template/surat.docx'));
        $ticket->setValues([
            'id' => $request->id,
            'asal_instansi' => $request->asal_instansi,
            'email' => $request->email,
            'no_surat_permohonan' => $request->no_surat_permohonan,
            'tgl_surat_permohonan' => $request->tgl_surat_permohonan,
            'jenis_permohonan' => $request->jenis_permohonan,
            'penyitaan_penggeledahan' => $request->penyitaan_penggeledahan,
            'tgl_sita_geledah' => $request->tgl_sita_geledah,
        ]);

        dd('OK');
    }
}
