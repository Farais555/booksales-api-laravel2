<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name'=>'Budi',
            'photo'=>'budi.png',
            'bio'=>'Seorang penulis legendaris dari serial Ini Bapak Budi.'
        ]);

        Author::create([
            'name'=>'Rehan Wangsaff',
            'photo'=>'Rehan.png',
            'bio'=>'Seorang yang terkenal karena namanya dijadikan lelucon.'
        ]);

        Author::create([
            'name'=>'Masasih Kisikisi',
            'photo'=>'MKFake.png',
            'bio'=>'Seorang penulis copium dari manga naruto, karena kisah karakter favoritnya jadi nomer 2.'
        ]);

        Author::create([
            'name'=>'J.K. Rowling',
            'photo'=>'jk_rowling.jpg',
            'bio'=>'Penulis asal Inggris yang terkenal lewat seri Harry Potter, karya fantasi yang mendunia.'
        ]);

        Author::create([
            'name'=>'Tere Liye',
            'photo'=>'tere_liye.jpg',
            'bio'=>'Penulis produktif asal Indonesia yang dikenal lewat novel-novel bertema cinta, kehidupan, dan sosial.'
        ]);
    }
}
