<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            "32x32",
            "64x64",
        ];

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'size' => $size
                ]);
            }
    }
}
