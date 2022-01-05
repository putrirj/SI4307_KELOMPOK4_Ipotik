<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = new User();
        $user->name = "John Doe";
        $user->email = "user@mail.com";
        $user->alamat = "Jakarta";
        $user->password = Hash::make("password");
        $user->photo = "avatars/default.png";
        $user->role = "user";
        $user->save();

        $apoteker = new User();
        $apoteker->name = "Apoteker";
        $apoteker->email = "apoteker@mail.com";
        $apoteker->alamat = "Jakarta";
        $apoteker->password = Hash::make("password");
        $apoteker->photo = "avatars/default.png";
        $apoteker->role = "apoteker";
        $apoteker->save();

        $admin = new User();
        $admin->name = "Administrator";
        $admin->email = "admin@mail.com";
        $admin->alamat = "Jakarta";
        $admin->password = Hash::make("password");
        $admin->photo = "avatars/default.png";
        $admin->role = "admin";
        $admin->save();
    }
}
