<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyTags;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Prvo dodajemo uloge u tabelu 'roles'
        $roles = [
            ['name' => 'Vlasnik'],
            ['name' => 'Student'],
            ['name' => 'Admin'],
        ];

        // Ubacivanje uloga u bazu
        foreach ($roles as $role) {
            Role::create($role);
        }

        // Sada kreiramo korisnike i povezujemo ih sa ulogama
        User::factory(10)->create();
        PropertyTags::factory(10)->create();
        // Property::factory(10)->create();

    }
}
