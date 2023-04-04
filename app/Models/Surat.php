<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surats';
    protected $fillable = ['id', 'id_user', 'id_kepentingan', 'status', 'tanggal_permohonan'];

    public function user() {
        return $this->belongsTo(Surat::class, 'id_user', 'id');
    }

    public function kepentingan() {
        return $this->hasMany(Kepentingan::class, 'id_kepentingan', 'id');
    }
    
}
