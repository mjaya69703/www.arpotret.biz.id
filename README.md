<p align="center"><a href="https://arpotret.biz.id target="_blank"><img src="./sample/demo-1.png" width="400" alt="Arpotret Logo"></a></p>
<p align="center">Preview FrontPage</p>
<p align="center"><a href="https://arpotret.biz.id target="_blank"><img src="./sample/demo-2.png" width="400" alt="Arpotret Logo"></a></p>
<p align="center">Preview Dashboard Admin</p>

<p align="center">
    <a href="CHANGELOG.MD">ARPotret - Open Source Project | v.1.0a - Changelogs</a>
    <br>
    <span>Latest Update: 22 Juni 2024</span>
</p>
<p align="center">
<a href="https://github.com/mjaya69703"><img src="https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white" alt="GitHub"></a>
<a href="https://facebook.com/kyouma052"><img src="https://img.shields.io/badge/Facebook-%231877F2.svg?style=for-the-badge&logo=Facebook&logoColor=white" alt="Facebook"></a>
<a href="https://instagram.com/mjaya69703"><img src="https://img.shields.io/badge/Instagram-%23E4405F.svg?style=for-the-badge&logo=Instagram&logoColor=white" alt="Instagram"></a>
<a href="mailto:jaya.kusuma@internal-dev.id"><img src="https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white" alt="Gmail"></a>
</p>

## About ARPotret - Photography Service By Internal Dev

Web Arpotret ini adalah website Pemesanan Jasa Fotografi yang Berlisensi Open Source ( MIT License ). Website ini dibangun untuk mempermudah konsumen dalam melakukan pemesanan jasa fotografi serta mempermudah penyedia jasa dalam mengelola produknya. Pada website ini memiliki fitur yang cukup lengkap mulai dari pemesanan secara online, pengelolaan data keuangan, serta masih banyak lagi fitur yang tersedia. Dengan adanya website ini diharapkan dapat mempermudah para penyedia jasa fotografi.


## Fitur Lengkap

- Fitur Kelola Halaman Utama Website
- Fitur Kelola Jenis Jasa Yang Ditawarkan
- Fitur Kelola Portofolio Fotografer
- Fitur Kelola Blog / Berita
- Fitur Pemesanan Melalui Website
- Fitur Chat Dalam Website
- Fitur Registrasi / Login / Dashboard Pada Klient Area
- Fitur Kelola Pesanan
- Fitur Kelola Data Keuangan
- Fitur Kelola Pengguna
- Fitur Kelola Pengaturan Website
- Fitur Kelola Email

## Panduan Install
1. Git Clone Repository Ini
```
git clone https://github.com/mjaya69703/siakad-pt.internal-dev.id
```
2. Lakukan Pembaruan Laravel
```
cp .env.example .env                    //  => Sesuaikan Settingan Database Pada ( .env )
composer install                        //  => Lakukan Update Komposer
php artisan storage:link                //  => Link Storage
php artisan migrate                     //  => Jalankan Migrasi Database
php artisan migrate:refresh --seed      //  => Jalankan Seeder
```
3. Jalankan Project Laravel
```
php artisan serve                       //  => Deploy Local Port 8000
```
Kunjungi Halaman http://127.0.0.1:8000 Pada Browser, Berikut Kresidensial Default Login
```
Login As Customer
Link : https://127.0.0.1:8000           // Klik Tombol Sign In
User : member
Pass : member1234

Login As Manager
Link : https://127.0.0.1:8000/admin/login
User : manager
Pass : manager123

Login As Manager
Link : https://127.0.0.1:8000/admin/login
User : admin
Pass : admin123

Login As Manager
Link : https://127.0.0.1:8000/admin/login
User : fotografer
Pass : fotografer123
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
