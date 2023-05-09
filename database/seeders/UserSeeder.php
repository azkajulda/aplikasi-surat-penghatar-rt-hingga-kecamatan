<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        User::insert([
            ['no_kk' => '32731310121999', 'email' => 'azk@gmail.com', 'password' => bcrypt('warga123'), 'created_at' => $now, 'updated_at' => $now, 'role' => 'warga'],
            ['no_kk' => '123', 'email' => '123@gmail.com', 'password' => bcrypt('rt123'), 'created_at' => $now, 'updated_at' => $now, 'role' => 'rt'],
            ['no_kk' => '321', 'email' => '321@gmail.com', 'password' => bcrypt('rw123'), 'created_at' => $now, 'updated_at' => $now, 'role' => 'rw'],
            ['no_kk' => '456', 'email' => '456@gmail.com', 'password' => bcrypt('lurah123'), 'created_at' => $now, 'updated_at' => $now, 'role' => 'lurah']
        ]);
    }
}
