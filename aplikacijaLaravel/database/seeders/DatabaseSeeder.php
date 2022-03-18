<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dress;
use App\Models\User;
use App\Models\Type;
use App\Models\Designer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Dress::truncate();
        User::truncate();
        Designer::truncate();
        Type::truncate();

        $this->call([
            TypeSeeder::class
        ]);

        Dress::factory(10)->create();
    }
}
