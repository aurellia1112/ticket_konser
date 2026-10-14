# Pemesanan Tiket

Aplikasi pemesanan tiket acara berbasis Laravel. Pengunjung dapat melihat acara
dan memesan tiket, sedangkan admin dapat mengelola acara serta memeriksa dan
mengubah status pesanan.

## Persyaratan

- PHP 8.2 atau lebih baru
- Composer
- Node.js `^20.19.0` atau `>=22.12.0`, beserta npm
- Ekstensi PHP yang dibutuhkan Laravel, termasuk PDO SQLite

## Instalasi lokal (Windows)

Jalankan perintah berikut dari folder proyek menggunakan PowerShell.

1. Pasang dependensi PHP:

   ```powershell
   composer install
   ```

2. Siapkan file konfigurasi dan database SQLite:

   ```powershell
   Copy-Item .env.example .env
   if (-not (Test-Path database\database.sqlite)) {
       New-Item -ItemType File database\database.sqlite
   }
   ```

   Jika file `.env` sudah ada, jangan menyalinnya lagi agar konfigurasi lokal
   tidak tertimpa.

3. Buat application key, jalankan migrasi, dan isi data contoh:

   ```powershell
   php artisan key:generate
   php artisan migrate --seed
   ```

   Seeder membuat akun admin pengujian dan beberapa acara contoh.

4. Pasang dependensi frontend:

   ```powershell
   npm install
   ```

5. Jalankan aplikasi. Buka dua terminal dari folder proyek:

   Terminal pertama:

   ```powershell
   php artisan serve
   ```

   Terminal kedua:

   ```powershell
   npm run dev
   ```

   Buka alamat `http://127.0.0.1:8000` di browser. Untuk menampilkan gambar
   yang diunggah melalui panel admin, jalankan sekali:

   ```powershell
   php artisan storage:link
   ```

## Akun pengujian

| Peran | Email | Kata sandi |
| --- | --- | --- |
| Admin | `admin@gmail.com` | `password123` |

Masuk melalui `http://127.0.0.1:8000/login`. Setelah masuk, admin dapat
mengakses dashboard dan pengelolaan acara. Pengunjung tidak perlu membuat akun
untuk memesan tiket dari halaman utama.

> Akun di atas hanya untuk pengujian lokal. Jangan gunakan kredensial ini di
> lingkungan produksi.

## Menjalankan pengujian

```powershell
php artisan test
```
