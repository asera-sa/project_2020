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
            'user_name' => 'asera',
            'full_name' => 'آسرة عمر أبو خريص',
            'email' => 'info@example.com',
            'phone' => '0926383981',
            'last_login' => date("Y-m-d"),
            'scope' => UserScope::ADMINISTRATOR->value,
        ]); //->syncRoles(Role::all()->pluck('name'));

        
      //  $this->call(InstitutionSeeder::class);

    }
}
