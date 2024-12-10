# Langkah Instalasi

1. **Pastikan sudah memiliki software berikut:**
   - **PHP** (versi terbaru disarankan)
   - **Git**
   - **Composer**

2. **Clone atau Download ZIP Folder Proyek**  
   Clone repositori menggunakan Git atau download folder file ZIP.

3. **Buka Proyek di Text Editor**  
   Buka folder proyek yang sudah diclone atau ekstrak menggunakan text editor seperti **VS Code**.

4. **Buat Database**  
   Buat database baru dan sesuaikan namanya dengan yang ada di file `.env` (misalnya: menggunakan aplikasi seperti **XAMPP** atau **Laragon**).

5. **Buka Terminal di VS Code**  
   Pastikan terminal sudah berada di dalam direktori folder proyek. Anda bisa membuka terminal di VS Code dengan menekan `Ctrl + ~` atau klik terminal manual di navbar vscode.

6. **Instalasi Dependencies**  
   Ketik perintah berikut untuk menginstal dependensi proyek:
    - composer install
    - composer update
7. **Migrasi dan Seeding Database**  
    - php artisan migrate:fresh --seed

8. **Generate Application Key (Opsional karena sudah saya include .env nya)**  
    - php artisan key:generate

9. **Jalankan Server Laravel**  
    - php artisan serve

10. **Akses Website di Browser**
    klik kanan
    Starting Laravel development server: http://127.0.0.1:8000
