<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title'=>'Pulang',
            'description'=>'Petualangan seorang pemuda yang kembali ke tanah kelahirannya',
            'price'=>40000,
            'stock'=>15,
            'cover_photo'=>'pulang.jpg',
            'genre_id'=>1,
            'author_id'=>1
        ]);

        Book::create([
            'title'=>'Sebuah Seni untuk bersikap Bodo Amat',
            'description'=>'Buku yang membahas tentang kehidupan dan filosofi hidup seseorang',
            'price'=>25000,
            'stock'=>5,
            'cover_photo'=>'sebuah_seni.jpg',
            'genre_id'=>2,
            'author_id'=>2
        ]);

        Book::create([
            'title'=>'Sasuke',
            'description'=>'Petualangan seorang ninja yang tersesat dalam ambisinya',
            'price'=>45000,
            'stock'=>15,
            'cover_photo'=>'sasske.jpg',
            'genre_id'=>3,
            'author_id'=>3
        ]);

        Book::create([
            'title'=>'Harry Potter and the Sorcerer\'s Stone',
            'description'=>'Petualangan seorang anak penyihir bernama Harry Potter di sekolah sihir Hogwarts.',
            'price'=>75000,
            'stock'=>20,
            'cover_photo'=>'harry_potter.jpg',
            'genre_id'=>4,
            'author_id'=>4
        ]);

        Book::create([
            'title'=>'Hujan',
            'description'=>'Kisah cinta dan bencana alam yang menyentuh hati, ditulis dengan gaya khas Tere Liye.',
            'price'=>65000,
            'stock'=>10,
            'cover_photo'=>'hujan.jpg',
            'genre_id'=>5,
            'author_id'=>5
        ]);
    }
}
