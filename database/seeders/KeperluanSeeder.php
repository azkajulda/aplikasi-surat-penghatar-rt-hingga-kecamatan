<?php

namespace Database\Seeders;

use App\Models\Kepentingan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeperluanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kepentingan::insert([
            ['jenis_kepentingan' => 'Surat Keterangan Miskin', 'tipe_surat' => 'Keterangan', 'keterangan' => 'KTP dan Kartu Keluarga'],
            ['jenis_kepentingan' => 'Surat Keterangan Domisili', 'tipe_surat' => 'Penghantar', 'keterangan' => 'KTP dan Kartu Keluarga'],
            ['jenis_kepentingan' => 'Surat Keterangan Belum Menikah', 'tipe_surat' => 'Penghantar', 'keterangan' => 'KTP, Kartu Keluarga, dan Akta Cerai / Surat Kematian untuk keterangan Janda/Duda'],

        ]);
    }
}
