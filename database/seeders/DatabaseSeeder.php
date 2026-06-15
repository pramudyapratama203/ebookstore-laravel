<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        $admin = User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@ebookstore.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'avatar' => 'A',
            'joined' => '2023-01-01',
        ]);

        $seller = User::create([
            'name' => 'Budi Santoso',
            'email' => 'seller@ebookstore.com',
            'password' => Hash::make('seller123'),
            'role' => 'seller',
            'avatar' => 'B',
            'store_name' => 'Budi Books Store',
            'bio' => 'Penjual buku profesional dengan koleksi terlengkap.',
            'joined' => '2023-03-15',
        ]);

        $buyer = User::create([
            'name' => 'Siti Rahayu',
            'email' => 'buyer@ebookstore.com',
            'password' => Hash::make('buyer123'),
            'role' => 'buyer',
            'avatar' => 'S',
            'joined' => '2023-06-20',
        ]);

        $seller2 = User::create([
            'name' => 'Rina Penerbit',
            'email' => 'seller2@ebookstore.com',
            'password' => Hash::make('seller123'),
            'role' => 'seller',
            'avatar' => 'R',
            'store_name' => 'Rina Digital Books',
            'bio' => 'Spesialis buku teknologi dan bisnis.',
            'joined' => '2023-04-10',
        ]);

        // Categories
        $categories = ['Novel', 'Self-Help', 'Teknologi', 'Sejarah', 'Bisnis', 'Fiksi', 'Sains', 'Pendidikan'];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }

        // Books
        $books = [
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'category' => 'Novel', 'price' => 75000, 'cover_color' => 'linear-gradient(135deg, #1e3a5f, #2d6a9f)', 'rating' => 4.9, 'sold' => 1240, 'is_new' => false, 'seller_id' => $seller->id, 'description' => 'Novel inspiratif tentang semangat anak-anak Belitung.', 'pages' => 529, 'publisher' => 'Bentang Pustaka', 'year' => 2005, 'stock' => 50],
            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'category' => 'Self-Help', 'price' => 129000, 'cover_color' => 'linear-gradient(135deg, #1a1a2e, #e94560)', 'rating' => 4.8, 'sold' => 980, 'is_new' => false, 'seller_id' => $seller->id, 'description' => 'Panduan membangun kebiasaan baik.', 'pages' => 320, 'publisher' => 'Gramedia', 'year' => 2020, 'stock' => 80],
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'category' => 'Teknologi', 'price' => 159000, 'cover_color' => 'linear-gradient(135deg, #0d1117, #238636)', 'rating' => 4.7, 'sold' => 750, 'is_new' => false, 'seller_id' => $seller2->id, 'description' => 'Panduan menulis kode yang bersih.', 'pages' => 431, 'publisher' => 'Informatika', 'year' => 2019, 'stock' => 30],
            ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'category' => 'Sejarah', 'price' => 149000, 'cover_color' => 'linear-gradient(135deg, #2d1b00, #c8860a)', 'rating' => 4.8, 'sold' => 890, 'is_new' => false, 'seller_id' => $seller2->id, 'description' => 'Sejarah singkat umat manusia.', 'pages' => 512, 'publisher' => 'Gramedia', 'year' => 2017, 'stock' => 45],
            ['title' => 'The Psychology of Money', 'author' => 'Morgan Housel', 'category' => 'Bisnis', 'price' => 119000, 'cover_color' => 'linear-gradient(135deg, #064e3b, #10b981)', 'rating' => 4.7, 'sold' => 670, 'is_new' => true, 'seller_id' => $seller->id, 'description' => 'Memahami perilaku uang.', 'pages' => 256, 'publisher' => 'Gramedia', 'year' => 2022, 'stock' => 60],
            ['title' => 'Dune', 'author' => 'Frank Herbert', 'category' => 'Fiksi', 'price' => 135000, 'cover_color' => 'linear-gradient(135deg, #451a03, #d97706)', 'rating' => 4.9, 'sold' => 550, 'is_new' => false, 'seller_id' => $seller2->id, 'description' => 'Epos sains fiksi epik.', 'pages' => 687, 'publisher' => 'Gramedia', 'year' => 2021, 'stock' => 35],
            ['title' => 'Python Crash Course', 'author' => 'Eric Matthes', 'category' => 'Teknologi', 'price' => 189000, 'cover_color' => 'linear-gradient(135deg, #1e3a5f, #3b82f6)', 'rating' => 4.6, 'sold' => 820, 'is_new' => true, 'seller_id' => $seller2->id, 'description' => 'Panduan lengkap Python.', 'pages' => 544, 'publisher' => 'Informatika', 'year' => 2023, 'stock' => 70],
            ['title' => 'Rich Dad Poor Dad', 'author' => 'Robert Kiyosaki', 'category' => 'Bisnis', 'price' => 95000, 'cover_color' => 'linear-gradient(135deg, #7c2d12, #ef4444)', 'rating' => 4.6, 'sold' => 1100, 'is_new' => false, 'seller_id' => $seller->id, 'description' => 'Pelajaran keuangan.', 'pages' => 336, 'publisher' => 'Gramedia', 'year' => 2015, 'stock' => 90],
            ['title' => 'A Brief History of Time', 'author' => 'Stephen Hawking', 'category' => 'Sains', 'price' => 110000, 'cover_color' => 'linear-gradient(135deg, #1e1b4b, #7c3aed)', 'rating' => 4.7, 'sold' => 430, 'is_new' => false, 'seller_id' => $seller2->id, 'description' => 'Perjalanan luar biasa.', 'pages' => 212, 'publisher' => 'Gramedia', 'year' => 2018, 'stock' => 25],
            ['title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'category' => 'Self-Help', 'price' => 85000, 'cover_color' => 'linear-gradient(135deg, #14532d, #84cc16)', 'rating' => 4.8, 'sold' => 960, 'is_new' => false, 'seller_id' => $seller->id, 'description' => 'Filsafat Stoa.', 'pages' => 296, 'publisher' => 'Kompas', 'year' => 2019, 'stock' => 55],
            ['title' => 'Bumi', 'author' => 'Tere Liye', 'category' => 'Novel', 'price' => 79000, 'cover_color' => 'linear-gradient(135deg, #0c4a6e, #06b6d4)', 'rating' => 4.7, 'sold' => 1080, 'is_new' => false, 'seller_id' => $seller->id, 'description' => 'Petualangan Raib.', 'pages' => 440, 'publisher' => 'Gramedia', 'year' => 2014, 'stock' => 65],
            ['title' => 'Zero to One', 'author' => 'Peter Thiel', 'category' => 'Bisnis', 'price' => 125000, 'cover_color' => 'linear-gradient(135deg, #18181b, #71717a)', 'rating' => 4.6, 'sold' => 480, 'is_new' => true, 'seller_id' => $seller2->id, 'description' => 'Cara membangun masa depan.', 'pages' => 224, 'publisher' => 'Gramedia', 'year' => 2022, 'stock' => 40],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Orders
        Order::create(['buyer_id' => $buyer->id, 'book_id' => 1, 'quantity' => 1, 'total' => 75000, 'status' => 'completed', 'date' => '2024-01-15']);
        Order::create(['buyer_id' => $buyer->id, 'book_id' => 1, 'quantity' => 3, 'total' => 225000, 'status' => 'completed', 'date' => '2024-01-16']);
        Order::create(['buyer_id' => $buyer->id, 'book_id' => 1, 'quantity' => 2, 'total' => 150000, 'status' => 'completed', 'date' => '2024-01-17']);
        Order::create(['buyer_id' => $buyer->id, 'book_id' => 2, 'quantity' => 1, 'total' => 129000, 'status' => 'completed', 'date' => '2024-01-20']);
        Order::create(['buyer_id' => $buyer->id, 'book_id' => 2, 'quantity' => 2, 'total' => 258000, 'status' => 'completed', 'date' => '2024-01-21']);
        Order::create(['buyer_id' => $buyer->id, 'book_id' => 5, 'quantity' => 1, 'total' => 119000, 'status' => 'processing', 'date' => '2024-02-01']);
        Order::create(['buyer_id' => $buyer->id, 'book_id' => 10, 'quantity' => 1, 'total' => 85000, 'status' => 'completed', 'date' => '2024-02-10']);
        Order::create(['buyer_id' => $buyer->id, 'book_id' => 10, 'quantity' => 1, 'total' => 85000, 'status' => 'pending', 'date' => '2024-02-11']);
        Order::create(['buyer_id' => $buyer->id, 'book_id' => 3, 'quantity' => 1, 'total' => 159000, 'status' => 'cancelled', 'date' => '2024-02-15']);
    }
}