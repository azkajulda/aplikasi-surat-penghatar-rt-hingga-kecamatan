<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKetuaRw extends Model
{
    use HasFactory;

    protected $table = 'list_ketua_rws';
    protected $fillable = ['id', 'id_rw', 'id_profile'];

    public function rw() {
        return $this->hasOne(Rw::class, 'id_rw', 'id');
    }

    
    public function profile() {
        return $this->belongsTo(Profile::class, 'id_profile', 'id');
    }
}
