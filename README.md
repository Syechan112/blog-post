# Aplikasi Blog Post Laravel 📝

<p align="center">
  <img style="margin-right: 8px;" src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel Badge">
  <img style="margin-right: 8px;" src="https://img.shields.io/badge/Blade-gray?style=for-the-badge&logo=laravelblade&logoColor=white" alt="Blade Badge">
  <img style="margin-right: 8px;" src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript Badge">
  <img style="margin-right: 8px;" src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3 Badge">
  <img style="margin-right: 8px;" src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS Badge">
  <img style="margin-right: 8px;" src="https://img.shields.io/badge/Alpine.js-gray?style=for-the-badge&logo=alpinelinux&logoColor=#007ACC" alt="Alpine.js Badge">
</p>

Aplikasi Blog Post Laravel v1 adalah aplikasi web yang dibangun dengan Laravel 11, memungkinkan pengguna untuk membuat, membaca, memperbarui, dan menghapus posting blog. Aplikasi ini dirancang dengan fokus pada pengalaman pengguna yang intuitif dan antarmuka yang responsif. Cocok untuk personal blog maupun website konten dinamis lainnya.

## Fitur Utama ✨

*   **Manajemen Postingan**: ➕ Membuat, mengedit, dan menghapus postingan blog dengan mudah melalui antarmuka admin.
*   **Kategori**: 📂 Mengkategorikan postingan untuk organisasi yang lebih baik dan navigasi yang mudah.
*   **Autentikasi Pengguna**: 🔑 Sistem pendaftaran dan login pengguna yang aman.
*   **Komentar**: 💬 Pengguna dapat memberikan komentar pada postingan, memfasilitasi diskusi dan interaksi.
*   **Responsif**: 📱 Desain responsif yang berfungsi dengan baik di berbagai perangkat.

## Tech Stack 🛠️

*   Bahasa: PHP
*   Framework: Laravel 11
*   Templating Engine: Blade
*   Frontend: JavaScript, Tailwind CSS, Alpine.js
*   Database:  Mungkin MySQL (default Laravel) 💡

## Instalasi & Menjalankan 🚀

1.  Clone repositori:
    ```bash
    git clone https://github.com/Syechan112/blog-post
    ```
2.  Masuk ke direktori:
    ```bash
    cd blog-post
    ```
3.  Install dependensi:
    ```bash
    composer install
    ```
4.  Konfigurasi environment: Salin `.env.example` ke `.env` dan sesuaikan konfigurasi database.
    ```bash
    cp .env.example .env
    ```
    Lalu generate app key.
     ```bash
    php artisan key:generate
    ```
5.  Migrasi database:
    ```bash
    php artisan migrate
    ```

6. Jalankan seeder (jika diperlukan, misalnya untuk data dummy):
    ```bash
    php artisan db:seed
    ```

7.  Jalankan proyek:
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://localhost:8000`.

## Cara Berkontribusi 🤝

1.  Fork repositori ini.
2.  Buat branch untuk fitur atau perbaikan Anda: `git checkout -b feature/nama-fitur`.
3.  Commit perubahan Anda: `git commit -m "Menambahkan fitur baru"`.
4.  Push ke branch Anda: `git push origin feature/nama-fitur`.
5.  Buat Pull Request.

## Lisensi 📄

Tidak disebutkan.


---
README.md ini dihasilkan secara otomatis oleh [README.MD Generator](https://github.com/emRival) — dibuat dengan ❤️ oleh [emRival](https://github.com/emRival)
