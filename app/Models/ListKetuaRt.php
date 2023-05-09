<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKetuaRt extends Model
{
    use HasFactory;

    protected $table = 'list_ketua_rts';
    protected $fillable = ['id', 'id_rt', 'id_profile'];

    public function rw() {
        return $this->hasOne(Rt::class, 'id_rt', 'id');
    }

    
    public function profile() {
        return $this->belongsTo(Profile::class, 'id_profile', 'id');
    }
}
