<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entry;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(VoyagerDatabaseSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(EntrySeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(MainUserMenuSeeder::class);
        Entry::factory(100)->create();
    }
}
