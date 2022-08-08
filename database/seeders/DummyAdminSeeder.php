<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\SettingStatus;

class DummyAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSeeder = [
            'id' => 1,
            'name' =>'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234') ,
            'remember_token' => Str::random(20),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => NULL
        ];
        DB::table('admins')->truncate();
        DB::table('admins')->insert($dataSeeder);
    }
}
