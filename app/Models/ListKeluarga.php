<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKeluarga extends Model
{
    use HasFactory;

    protected $table = 'list_keluargas';
    protected $fillable = ['id', 'id_user', 'id_rt', 'id_rw', 'id_profile', 'status'];

    public function rw() {
        return $this->belongsTo(Rw::class, 'id_rw', 'id');
    }

    public function rt() {
        return $this->belongsTo(Rt::class, 'id_rt', 'id');
    }

    public function profile() {
        return $this->hasMany(Profile::class, 'id_profile', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    
}
