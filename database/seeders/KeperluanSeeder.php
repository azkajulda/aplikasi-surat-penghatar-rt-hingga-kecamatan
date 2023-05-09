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
            ['jenis_kepentingan' => 'Surat Keterangan Miskin'],
            ['jenis_kepentingan' => 'Surat Keterangan Domisili'],
            ['jenis_kepentingan' => 'Surat Keterangan Belum Menikah'],

        ]);
    }
}
