# Sistem Rekap Postingan 📊

Sistem Rekap Postingan adalah aplikasi berbasis web yang dikembangkan untuk **MAN 2 Bantul** guna memudahkan pencatatan, pelacakan, dan perekapan tautan publikasi, baik dari media sosial (Instagram, Facebook, YouTube, dll.) maupun portal berita.

Aplikasi ini dilengkapi dengan fitur **Auto-Extract** yang dapat menarik metadata judul artikel atau postingan secara otomatis hanya dari input URL, sehingga mempercepat proses *data entry*.

## 🚀 Fitur Utama

- **Public Form Responsif**: Formulir pengisian data yang mudah digunakan, mobile-friendly, dan dirancang dengan antarmuka modern (Tailwind CSS).
- **Auto-Extract Link**: Mendeteksi otomatis platform (Sosial Media / Portal Berita) dan mengambil judul halaman berdasarkan URL yang dimasukkan (menggunakan Guzzle & Symfony DomCrawler).
- **Admin Dashboard**: Panel manajemen admin yang *powerful* menggunakan Filament v3 untuk melihat, menyaring, dan mengekspor rekap data.
- **Export Data**: Ekspor hasil rekap ke format Excel dengan mudah.

## 🛠️ Teknologi yang Digunakan

Proyek ini dibangun menggunakan *stack* teknologi modern:

- **Framework**: [Laravel 10](https://laravel.com/)
- **Admin Panel**: [Filament v3](https://filamentphp.com/)
- **Styling**: [Tailwind CSS](https://tailwindcss.com/)
- **Database**: MySQL / MariaDB
- **Web Scraping / Extractor**: GuzzleHTTP & Symfony DOM Crawler
- **Export**: Maatwebsite Excel

## 📋 Persyaratan Sistem

Pastikan environment Anda memenuhi persyaratan berikut sebelum menginstal:

- PHP >= 8.1
- Composer
- Node.js & NPM (untuk *compile assets*)
- MySQL atau MariaDB
- Ekstensi PHP: DOM, cURL, mbstring, PDO, dll.

## ⚙️ Panduan Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan project di *local environment* Anda:

1. **Clone repositori**
   ```bash
   git clone https://github.com/MenaraWas/sistem-rekap.git
   cd sistem-rekap
   ```

2. **Install dependensi PHP dan Node.js**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env`.
   ```bash
   cp .env.example .env
   ```
   Sesuaikan konfigurasi *database* di dalam file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sistem_rekap
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan Migrasi dan Seeder**
   *(Opsional: Jalankan seeder jika ada untuk data platform awal)*
   ```bash
   php artisan migrate --seed
   ```

6. **Compile Assets**
   ```bash
   npm run build
   # atau npm run dev untuk development
   ```

7. **Jalankan Local Server**
   ```bash
   php artisan serve
   ```

Aplikasi sekarang dapat diakses melalui `http://localhost:8000`.

## 🛡️ Keamanan & Akses

- Halaman formulir rekap publik dapat diakses langsung oleh user di halaman utama (`/`).
- Panel admin dapat diakses di URL `/admin` (sesuai konfigurasi Filament). Pastikan membuat akun admin menggunakan perintah *Filament User*:
  ```bash
  php artisan make:filament-user
  ```

## 📄 Lisensi

Aplikasi ini dikembangkan untuk keperluan internal MAN 2 Bantul.

---
*Dibuat dengan ❤️ untuk MAN 2 Bantul*
