
# Aplikasi Pemesanan Kendaraan

Technical Test - Sekawan Media

XAMPP Versi 3.2.4
PHP 8.1.13
Framework Laravel

# Bagian Belum Selesai
- Riwayat Pemakaian Kendaraan
- Grafik Pemakaian Kendaraan
- Laporan Periodik Export Excel

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

## Physical Data Model
![PDM Aplikasi Pemesanan Kendaraan2](https://github.com/BagusFary/Aplikasi-Pemesanan-Kendaraan/assets/51037655/804f66bd-e648-45b5-a412-7fb6e2be7347)






