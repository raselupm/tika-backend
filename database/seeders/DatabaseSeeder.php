<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Rasel Ahmed';
        $user->email = 'demo@user.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('123');
        $user->remember_token = Str::random(10);
        $user->save();
    }
}
