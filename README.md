
# Aplikasi Pemesanan Kendaraan

Technical Test - Sekawan Media

XAMPP Versi 3.2.4

PHP 8.1.13

Framework Laravel

# Bagian Belum Selesai
- Grafik Pemakaian Kendaraan

- # Bagian sudah di update
- Riwayat Pemakaian Kendaraan (Updated / Done)
- Panduan Penggunaan Aplikasi Pemesanan Kendaraan (Updated / Done)
- Laporan Periodik Pemesanan Kendaraaan (Updated / Done)

## Setup Project

Clone the project

```bash
  git clone https://github.com/BagusFary/Aplikasi-Pemesanan-Kendaraan
```

Go to the project directory

```bash
  cd Aplikasi-Pemesanan-Kendaraan
```

Install dependencies

```bash
  cp .env.example .env 
```
```bash
  composer install
```
```bash
  npm install
```
```bash
  php artisan key:generate
```
```bash
  php artisan migrate
```
```bash
  php artisan db:seed --class=AdminSeeder
```
Start the server
```bash
  npm run dev
```
```bash
  php artisan serve
```



## User and Admin Login

- Admin\
Email    : admin@gmail.com\
Password : 12345678

- User/Pihak\
Email    : email yang dibuat Admin/Pegawai\
Password : 12345678

# Panduan Penggunaan Aplikasi Pemesanan Kendaraan

1. Admin/Pegawai Login dengan username dan password yang sudah disediakan
2. Admin/Pegawai membuat Data Kendaraan, Data Driver, dan Data Pihak yang menyetujui.
3. Admin/Pegawai membuat pemesanan kendaraan dengan data kendaraan, data driver, dan data pihak yang sudah dibuat.
4. Pihak yang menyetujui dapat login dengan username dan password yang sudah dibuat oleh admin

## Physical Data Model
![PDM Aplikasi Pemesanan Kendaraan4](https://github.com/BagusFary/Aplikasi-Pemesanan-Kendaraan/assets/51037655/01191155-86fb-42d4-8178-ba15c1d60bc2)







