<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Enums\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $dataSeeders = [];
        for ($i = 1; $i <= 50; $i++) {
            $birthDay = Carbon::now()->subYears(20)->addDays($i);
            $dataSeeders[] = [
                'name' => 'user' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'email_verified_at' => $date,
                'password' => Hash::make('user1234'),
                'birth_date' => $birthDay,
                'sex' => rand(1, 3),
                'remember_token' => null,
                'created_at' => $date,
                'updated_at' => $date,
                'deleted_at' => NULL
            ];
        }
        DB::table('users')->truncate();
        DB::table('users')->insert($dataSeeders);
    }
}
