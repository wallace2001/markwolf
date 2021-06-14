<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "outfits",
            "monster",
            "environments",
            "spells",
            "items"
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category
                ]);
            }
        }
    }
