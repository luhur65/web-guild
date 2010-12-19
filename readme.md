# Web Guild 

**By : [Dharma Bakti Situmorang](https://facebook.com/adiknya.situmorang)**

**Web Ini Menggunakan :**

1. Bahasa Pemograman `PHP v7.1.19`
   
2. `Template Admin Dasboard` Dari : 
   1. [Start Bootstrap - SB Admin 2 v4.0.7](https://startbootstrap.com/template-overviews/sb-admin-2)
   
3. `Template Login / Register` Dari:
   1. [Argon Design System - v1.1.0](https://www.creative-tim.com/product/argon-design-system)
   
4. Framework CSS :
   1. [Bootstrap v4.3.1](https://getbootstrap.com/)
      1. [jQuery JavaScript Library v3.4.1](https://jquery.com/)
   
5. `Font Awesome` Untuk Icon :
   1. [Font Awesome Free 5.10.2](https://fontawesome.com)
   
6. `Lightbox` by Lokesh Dhakar:
   1. [Lightbox v2.11.1](http://lokeshdhakar.com/projects/lightbox2/)
   
**Fitur - Fitur Didalam Website :**

1. Login / Registrasi 
2. Notification Center (Semua Role)
3. Profile Page (Semua Role)
4. Edit Profile (Semua Role)
5. MultiLevel User , diantaranya:
   1. Role SuperUser ( **Admin** ) , Memiliki Hak Akses Sebagai Berikut :
      1. Menu & Submenu Management :
         1. Role Access Menu :
            1. `User`
            2. `Admin`
         2. Membuat Menu Baru
         3. Submenu Management :
            1. Menonaktifkan / Mengaktifkan Submenu
            2. Edit Submenu
            3. Hapus Submenu
      2. Guild Management :
         1. Melihat Semua guild yg Ada
         2. Menghapus guild 
         3. Mengedit guild
         4. Memblockir Guild & Aktifkan guild
      3. Mengelolah Report 
         1. Report User :
            1. Membalas Report User
            2. Menghapus Report User
         2. Report Guild
            1. Menghapus Report User
   2. Role User ( **Anggota** ) , Memiliki Hak Akses Sebagai Berikut :
      1. Membuat Guild Baru :
         1. Menentukan Akses Guild :
            1. Private Guild
            2. Public Guild
      2. Join Ke Guild Yg Sudah Ada :
      3. Guild Management untuk `Anggota`, yaitu :
         1. Melihat HomePage Guild 
         2. Jika Sudah Punya Guild `Anggota` Bisa :
            1. Dapat Memposting cerita, quote, dll di guild
            2. Mengedit Postingan
            3. Menghapus Postingan
         3. Mengundang Teman Untuk Join Ke Guild
         4. Guild Chatting / Global Chatting
         5. Melihat List Member 
         6. Keluar dari Guild
         7. Melaporkan Guild ke Admin
      4. Melihat Profil User / Anggota Lain 
      5. System Reporting , Ada 2 Tipe Report , yaitu:
         1. Report User
         2. Report Konten
      6. Chatting Dengan User Lain Secara Private
      7. Mail List , Yang Berisi :
         1. Pesan Undangan Join Ke Guild Teman
6. Logout

**Set up Configurasi Database** 

1. Buka folder [`config`](config/config.php) dan Pilih `Config.php`, Kemudian edit Konfigurasi di Bagian Ini

    ```Php

    // Saya Menggunkan MySQL 

    // Konekesi Ke Database 

    $hostname = // isi Hostname Server Database Anda disini;
    $username = // isi username database anda;
    $pass = // Isi password database anda;
    $dbname = // Nama Database Anda;

    $conn = mysqli_connect($hostname,$username,$pass,$dbname);

    <!-- Kemudian Edit Bagian Ini  -->
    // Link Utama
    define('base_url',"http://localhost/tugasphp/guild");

    // Ubah Menjadi Link Folder tempat Menyimpan web ini di komputer / laptop anda

    ```
2. Konfigurasi Database Pun Sudah Selesai

**Membuat File .htaccess**

1. Buat File Baru Untuk Membersihkan `Url` Dari ekstensi file `.php` , `.html` dll.
2. Beri Nama File Tersebut `.htaccess` , simpan di tempat dimana file `index.php` ada .
3. Copy semua Kode Dibawah Ini Kedalam File `.htaccess`

    ```htaccess
        
        Options -Indexes

        # HTID:12249889: DO NOT REMOVE OR MODIFY THIS LINE AND THE LINES BELOW
        php_value display_errors 1
        # DO NOT REMOVE OR MODIFY THIS LINE AND THE LINES ABOVE HTID:12249889:

        <IfModule mod_rewrite.c>
        RewriteEngine on

        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME}.php -f
        RewriteRule ^(.*)$ $1.php


        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME}.html -f
        RewriteRule ^(.*)$ $1.html


        </IfModule>

    ```
4. Kemudian Buat Lagi file `.htaccess` didalam folder `attr`
5. Tuliskan Kode Berikut :
    
    ```htaccess

        Options -Indexes

    ```

6. Membuat File `.htaccess` Selesai..



Demo Web nya Disini : [Web Guild](https://awesomeguild.000webhostapp.com)

Data Login :

1. Anggota :
   * Username = public
   * password = 123

2. Admin :
   * username = admin
   * password = 123


**Sekian Penjelasan dan Konfigurasi Yg Saya jelaskan Diatas . Anda Bisa Mencoba Demo Nya Secara Live Di Link Yg Telah Saya Berikan..**
**Saya Ucapkan Terima Kasih, Salam Koding!!**