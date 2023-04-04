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
        return $this->hasMany(Rw::class, 'id_rw', 'id');
    }

    public function profile() {
        return $this->belongsTo(Profile::class, 'id_rt', 'id');
    }

    public function ketua_rt() {
        return $this->belongsTo(ListKetuaRt::class, 'id_rt', 'id');
    }
}
