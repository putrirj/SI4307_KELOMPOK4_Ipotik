<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Asma', 'photo' => 'categories/asma.png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Batuk & Pilek', 'photo' => 'categories/batuk_pilek.png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Demam', 'photo' => 'categories/demam.png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Diare', 'photo' => 'categories/diare.png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Kulit', 'photo' => 'categories/kulit.png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mata', 'photo' => 'categories/mata.png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mulut', 'photo' => 'categories/mulut.png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Vitamin', 'photo' => 'categories/vitamin.png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ];

        Category::insert($data);
    }
}
