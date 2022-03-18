<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1=Type::create([
            'name' => "summer"
        ]);

        $type2=Type::create([
            'name' => "winter"
        ]);

        $type3=Type::create([
            'name' => "autumn"
        ]);

        $type4=Type::create([
            'name' => "spring"
        ]);
    }
}
