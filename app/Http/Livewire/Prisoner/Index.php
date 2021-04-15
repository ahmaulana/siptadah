<?php

namespace App\Http\Livewire\Prisoner;

use App\Models\Prisoner;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Spatie\Permission\Models\Role;

class Index extends LivewireDatatable
{
    public $model = Prisoner::class;
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
                return view('table-actions', ['id' => $id, 'status' => $status]);
            })
                ->label('Aksi')->alignCenter(),
        ];
    }
}