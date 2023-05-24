<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rts';
    protected $fillable = ['id', 'id_rw', 'nomor_rt'];

    public function rw() {
        return $this->belongsTo(Rw::class, 'id_rw', 'id');
    }

    public function list_keluarga() {
        return $this->hasMany(ListKeluarga::class, 'id_rt', 'id');
    }

    public function ketua_rt() {
        return $this->hasOne(ListKetuaRt::class, 'id_rt', 'id');
    }
}
