<?php

namespace App\Http\Livewire;

use App\Models\Request as ModelsRequest;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Spatie\Permission\Models\Role;

class Requests extends LivewireDatatable
{
    public $model = ModelsRequest::class;

    public function builder()
    {
        if(auth()->user()->id == 1)
        {
            return ModelsRequest::query();
        }
        return ModelsRequest::query()
            ->where('user_id', auth()->user()->id);
    }

    public function columns()
    {
        $roles = Role::select('name')->get();
        $asal_instansi = [];
        foreach($roles as $role ){
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

            Column::callback(['id'], function ($id) {
                return view('table-actions', ['id' => $id]);
            })
                ->label('Aksi')->alignCenter(),
            Column::delete()->label('Hapus')->alignCenter(),
        ];
    }
}
