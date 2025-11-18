<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            'name'=>'Fiksi',
            'description'=>'Cerita Bohongan.'

        ]);

        Genre::create([
            'name'=>'Saint',
            'description'=>'Cerita berdasarkan data sains.'

        ]);

        Genre::create([
            'name'=>'Komedi',
            'description'=>'Cerita lucu.'

        ]);

        Genre::create([
            'name'=>'Romansa',
            'description'=>'Cerita tentang cinta, hubungan, dan emosi antar karakter.'

        ]);

        Genre::create([
            'name'=>'Petualangan',
            'description'=>'Kisah perjalanan seru dan penuh tantangan di dunia nyata maupun fantasi.'

        ]);
    }
}
