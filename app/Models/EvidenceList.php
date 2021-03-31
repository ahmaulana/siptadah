<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenceList extends Model
{
    use HasFactory;

    protected $fillable = ['request_id', 'barang_bukti'];
    public $timestamps = false;

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
