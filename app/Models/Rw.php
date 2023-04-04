<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rws';
    protected $fillable = ['id', 'nomor_rw'];

    public function rt() {
        return $this->belongsTo(Rt::class, 'id_rw', 'id');
    }

    
    public function profile() {
        return $this->belongsTo(Profile::class, 'id_rw', 'id');
    }

    public function ketua_rw() {
        return $this->belongsTo(ListKetuaRw::class, 'id_rw', 'id');
    }
}
