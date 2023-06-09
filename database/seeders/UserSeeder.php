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
            ['no_kk' => '456', 'email' => '456@gmail.com', 'password' => bcrypt('lurah123'), 'created_at' => $now, 'updated_at' => $now, 'role' => 'lurah'],
            ['no_kk' => 'kelurahan', 'email' => 'kelurahan@gmail.com', 'password' => bcrypt('lurah123'), 'created_at' => $now, 'updated_at' => $now, 'role' => 'lurah']
        ]);
    }
}
