# E-Bookstore

Aplikasi marketplace e-book berbasis web dengan tiga peran pengguna: **Admin**, **Seller**, dan **Buyer**. Dibangun menggunakan Laravel 13 + Tailwind CSS.

## Fitur

### 🔐 Autentikasi & Manajemen Pengguna
- Register, Login, dan Logout
- Reset password via email
- Profil pengguna (nama, email, telepon)
- Tiga role: Admin, Seller, Buyer

### 📚 Katalog Buku (Buyer)
- Jelajahi seluruh koleksi buku
- Cari berdasarkan judul/penulis
- Filter berdasarkan kategori
- Urutkan berdasarkan harga, rating, atau popularitas
- Lihat detail buku

### 🛒 Keranjang Belanja (Buyer)
- Tambah/hapus buku ke keranjang
- Checkout pesanan

### 📦 Manajemen Pesanan
- **Buyer**: Lihat histori pesanan, beri rating & ulasan
- **Seller**: Kelola pesanan masuk, perbarui status
- **Admin**: Pantau seluruh transaksi

### 📖 Manajemen Buku (Seller & Admin)
- Tambah, edit, dan hapus buku
- Atur stok, harga, kategori, dan deskripsi
- Admin dapat mengelola seluruh katalog global

### 📊 Dashboard
- **Admin**: Statistik global (total pengguna, buku, pendapatan, rating), pesanan terbaru, stok menipis, grafik mingguan
- **Seller**: Statistik penjualan pribadi, pendapatan, rating, pesanan
- **Buyer**: Riwayat pesanan terbaru

### 📋 Log Aktivitas Admin
- Catat semua aktivitas admin (lihat, cari, tambah, edit, hapus)
- Informasi: waktu, admin, aksi, modul, deskripsi, IP address
- Halaman khusus untuk monitoring aktivitas

## Arsitektur

### Models

| Model | Deskripsi |
|---|---|
| `User` | Pengguna dengan role admin/seller/buyer |
| `Book` | Buku dengan relasi ke seller |
| `Order` | Pesanan dengan relasi ke buyer dan book |
| `Cart` | Item keranjang belanja |
| `Category` | Kategori buku |
| `UserProfile` | Profil tambahan pengguna |
| `SellerRating` | Rating untuk seller |
| `AdminActivityLog` | Log aktivitas admin |

### Controllers

| Controller | Fungsi |
|---|---|
| `AuthController` | Register, login, logout |
| `AdminDashboardController` | Dashboard & log aktivitas admin |
| `DashboardController` | Dashboard buyer & seller |
| `BookController` | CRUD buku untuk buyer, seller, admin |
| `OrderController` | Manajemen pesanan semua role |
| `CartController` | Keranjang belanja |
| `UsersController` | Profil pengguna |
| `ForgotPasswordController` | Reset password |

### Routes (Web)

| Metode | URI | Deskripsi |
|---|---|---|
| GET/POST | `/login`, `/register` | Autentikasi |
| GET | `/home/buyer/**` | Halaman buyer |
| GET | `/home/seller/**` | Halaman seller |
| GET | `/admin/dashboard` | Dashboard admin |
| GET | `/admin/catalog` | Katalog global |
| GET | `/admin/orders` | Semua pesanan |
| GET | `/admin/activity-logs` | Log aktivitas admin |

## Role Pengguna

| Role | Kemampuan |
|---|---|
| **Admin** | Akses penuh ke semua fitur, kelola semua buku & pesanan, lihat log aktivitas |
| **Seller** | Kelola buku sendiri, kelola pesanan masuk, lihat dashboard penjualan |
| **Buyer** | Jelajahi & beli buku, kelola keranjang, beri rating & ulasan |

## Teknologi

| Stack | Versi |
|---|---|
| PHP | ^8.3 |
| Laravel | ^13.0 |
| Tailwind CSS | ^4.0 |
| Vite | ^8.0 |
| Alpine.js | ^3.4 |
| Database | SQLite / MySQL |

## Instalasi

### Prasyarat
- PHP 8.3+
- Composer
- Node.js & npm
- Database (SQLite default / MySQL)

### Langkah

```bash
# Clone repository
git clone <repo-url>
cd ebookstore-laravel

# Install dependensi PHP
composer install

# Copy environment
cp .env.example .env
# Windows: copy .env.example .env

# Generate app key
php artisan key:generate

# Konfigurasi database di file .env
# SQLite digunakan secara default

# Jalankan migrasi
php artisan migrate

# Install dependensi frontend
npm install

# Build asset
npm run build

# Jalankan aplikasi
php artisan serve
```

Atau gunakan script bawaan:

```bash
composer run setup
```

### Development

```bash
composer run dev
```

Menjalankan 4 proses secara bersamaan:
- `php artisan serve`
- `php artisan queue:listen`
- `php artisan pail`
- `npm run dev`

## Command

| Command | Deskripsi |
|---|---|
| `composer run setup` | Instalasi lengkap pertama kali |
| `composer run dev` | Menjalankan environment development |
| `composer run test` | Menjalankan test |

## Lisensi

MIT
