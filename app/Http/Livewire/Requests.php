<?php

namespace App\Http\Livewire;

use App\Models\Request as ModelsRequest;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Requests extends LivewireDatatable
{
    public $model = ModelsRequest::class;

    public function columns()
    {
        return [
            NumberColumn::name('id'),

            Column::name('asal_instansi')
            ->label('Asal Instansi')
            ->filterable()
            ->searchable(),

            Column::name('jenis_permohonan')
            ->label('Jenis Permohonan')            
            ->filterable(['penyitaan','penggeledahan']),

            Column::name('status')
            ->label('Status')
            ->filterable(['diproses','disetujui','ditolak']),

            DateColumn::name('updated_at')
            ->label('Diperbarui'),

            Column::callback(['id'], function ($id) {
                return view('table-actions', ['id' => $id]);
            })
            ->label('Aksi'),
        ];
    }
}