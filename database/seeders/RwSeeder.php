<?php

namespace Database\Seeders;

use App\Models\Rw;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        Rw::insert([
            ['nomor_rw' => '001','created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rw' => '002','created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rw' => '003','created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rw' => '004','created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rw' => '005','created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rw' => '006','created_at'=>$now, 'updated_at'=>$now],
        ]);
    }
}
