
# Laravel Web Course
<p align="center">
<img src="https://github.com/BagusFary/CourseLaravel/blob/master/laravellogo.png" width="200" height="200" />
</p>
Website Laravel Backend dengan tema web course dimana user dapat memesan/order dan mengakses course yang sudah dibeli menggunakan sistem payment manual berupa Admin Approvement.

- User Dashboard
- Admin Dashboard
- Course Management (CRUD Course)
- Admin Approve Orders (Manual Approvement)



## Setup Project

Clone the project

```bash
  git clone https://github.com/BagusFary/CourseLaravel
```

Go to the project directory

```bash
  cd CourseLaravel
```

Install dependencies

```bash
  cp .env.example .env 
```
```bash
   configure your env 
   FILESYSTEM_DISK=public
   QUEUE_CONNECTION=database
```
```bash
  Configure your mailtrap to set up mail notifications
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
  php artisan storage:link
```
```bash
  php artisan migrate
```
```bash
  php artisan db:seed
```
Start the server
```bash
  npm run dev
```
```bash
  php artisan serve
```
```bash
  php artisan queue:work
```





## User and Admin Login

- Admin\
Email    : admin@gmail.com\
Password : 12345678

- User\
Password for all users email is '12345678'




