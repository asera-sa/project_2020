<?php

namespace Database\Seeders;

use Database\Seeders\InstitutionSeeder;
use App\Enums\UserScope;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Artisan::call("seed:permissions");

        $user = \App\Models\User::factory()->create([
            'user_name' => 'admin',
            'full_name' => 'حسام الدايم',
            'email' => 'info@example.com',
            'phone' => '0921112233',
            'last_login' => date("Y-m-d"),
            'scope' => UserScope::ADMINISTRATOR->value,
             // البريد موثق
            'email_verified_at'  => now(),
            'email_verification_token' => null, // ما عادش يحتاج توكن
            'email_verification_token_expires_at'=> null, // مش ضروري لأنه موثق
        ]); //->syncRoles(Role::all()->pluck('name'));


      //  $this->call(InstitutionSeeder::class);

    }
}
