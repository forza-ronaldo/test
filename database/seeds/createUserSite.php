<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class createUserSite extends Seeder
{

    public function run()
    {
        $uesr = User::create([
            'id_number' => '10000012454',
            'email' => 'ghiathshamma2000@hotmail.com',
            'name' => 'ghiath shamma',
            'user_name' => 'ghiath_shamma',
            'phone' => '0994547308',
            'gender' => '0',
            'city' => 'damascus',
            'password' => Hash::make('12345678'),
            'bank_id' => '777',
            'group_id' => '0',
        ]);
        $uesr->attachRole('super_admin');

        User::create([
            'id_number' => '10000012312',
            'email' => 'ghiathshamma2002@hotmail.com',
            'name' => 'client444',
            'user_name' => 'client444',
            'phone' => '0994547308',
            'gender' => '0',
            'city' => 'damascus',
            'password' => Hash::make('12345678'),
            'bank_id' => '444',
            'group_id' => '2',
        ]);
        $user2 = User::create([
            'id_number' => '10000012312',
            'email' => 'lamaalzoubi73@hotmail.com',
            'name' => 'lama222',
            'user_name' => 'lama',
            'phone' => '0966128157',
            'gender' => '1',
            'city' => 'damascus',
            'password' => Hash::make('12345678'),
            'bank_id' => '222',
            'group_id' => '0',
        ]);
        $user2->attachRole('admin');
    }
}
