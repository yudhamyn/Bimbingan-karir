Langkah install
1.PASTIKAN SUDAH PUNYA PHP,GIT,COMPOSER
2.CLONE ATAU DOWNLOAD ZIP FOLDERNYA
3.BUKA DI TEXT EDITOR SEPERTI VSCODE
4.BUAT DATABASE dan sesuaikan namanya dengan yag di env(EX: XAMPP/LARAGON)
5.BUKA TERMINAL DI VS CODE, PASTIKAN ROUTE KE FOLDER
6.KETIK composer install lalu composer update
7.KETIK php artisan migrate:fresh --seed
8.KETIK php artisan key:generate(OPSIONAL KARENA SUDAH SAYA INCLUDE FILE .ENV NYA)
9.KETIK php artisan serve 
10.KLIK KANAN LINK LOCAL YANG MUNCUL (Starting Laravel development server: http://127.0.0.1:8000)
11.website sudah terbuka di browser default