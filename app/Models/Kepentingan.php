<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepentingan extends Model
{
    use HasFactory;

    protected $table = 'kepentingans';
    protected $fillable = ['id', 'jenis_kepentingan', 'deskripsi', 'keterangan'];

    public function surat() {
        return $this->hasMany(Surat::class, 'id_kepentingan', 'id');
    }

}
