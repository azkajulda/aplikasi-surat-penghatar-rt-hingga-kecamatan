<?php

namespace Database\Seeders;

use App\Models\Rt;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        Rt::insert([
            ['nomor_rt' => '001', 'id_rw'=>1, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>2, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>3, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>4, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '002', 'id_rw'=>4, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '003', 'id_rw'=>4, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '004', 'id_rw'=>4, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '005', 'id_rw'=>4, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>5, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '002', 'id_rw'=>5, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '003', 'id_rw'=>5, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '004', 'id_rw'=>5, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '005', 'id_rw'=>5, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>6, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '002', 'id_rw'=>6, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '003', 'id_rw'=>6, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '004', 'id_rw'=>6, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '005', 'id_rw'=>6, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>7, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '002', 'id_rw'=>7, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '003', 'id_rw'=>7, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '004', 'id_rw'=>7, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>8, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '002', 'id_rw'=>8, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '003', 'id_rw'=>8, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '004', 'id_rw'=>8, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>9, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '002', 'id_rw'=>9, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '003', 'id_rw'=>9, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>10, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '002', 'id_rw'=>10, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '003', 'id_rw'=>10, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>11, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '002', 'id_rw'=>11, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>12, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '002', 'id_rw'=>12, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '001', 'id_rw'=>13, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '002', 'id_rw'=>13, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '003', 'id_rw'=>13, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '004', 'id_rw'=>13, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '005', 'id_rw'=>13, 'created_at'=>$now, 'updated_at'=>$now],
            ['nomor_rt' => '006', 'id_rw'=>13, 'created_at'=>$now, 'updated_at'=>$now],
        ]);
    }
}
