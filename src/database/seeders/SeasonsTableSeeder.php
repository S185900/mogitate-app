<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            "春",
            "夏",
            "秋",
            "冬"
        ];

        foreach ($names as $name) {
            DB::table('seasons')->insert([
                'name' => $name,
            ]);
        }
    }
}
