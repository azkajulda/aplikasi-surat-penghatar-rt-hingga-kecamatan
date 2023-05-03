<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surats';
    protected $fillable = ['id', 'id_profile', 'id_user', 'id_kepentingan', 'status', 'tanggal_permohonan', 'berkas', 'tipe_berkas'];

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function profile() {
        return $this->belongsTo(Profile::class, 'id_profile', 'id');
    }

    public function kepentingan() {
        return $this->belongsTo(Kepentingan::class, 'id_kepentingan', 'id');
    }
    
}
