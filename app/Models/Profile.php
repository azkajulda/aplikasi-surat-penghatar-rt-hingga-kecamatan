<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $fillable = ['id', 'no_nik','nama','jenis_kelamin','alamat','tempat_lahir','tanggal_lahir','jenis_kelamin','alamat','pendidikan','pekerjaan','agama','ttd','photo','golongan_darah'];

    public function ketua_rt() {
        return $this->belongsTo(ListKetuaRt::class, 'id_rt', 'id');
    }

    public function ketua_rw() {
        return $this->belongsTo(ListKetuaRw::class, 'id_rw', 'id');
    }
    
    public function list_kelaurga() {
        return $this->hasOne(ListKeluarga::class, 'id_profile', 'id');
    }

    public function surat() {
        return $this->hasMany(Surat::class, 'id_profile', 'id');
    }
}
