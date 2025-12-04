🗨️ ChatKita

Aplikasi Chat Realtime berbasis Web dengan Laravel + Reverb

ChatKita adalah aplikasi obrolan (chat) realtime yang dibangun menggunakan Laravel, Laravel Reverb, JavaScript, dan TailwindCSS.
Project ini dibuat untuk menghadirkan pengalaman komunikasi cepat, ringan, dan modern layaknya aplikasi perpesanan populer.

🚀 Fitur Utama

Realtime Messaging – Menggunakan Laravel Reverb untuk komunikasi instan tanpa reload.

Private & Group Chat – Pengguna dapat mengirim pesan secara pribadi atau dalam satu grup.


UI Modern – Tampilan clean menggunakan TailwindCSS.

Autentikasi User – Login/registrasi menggunakan Laravel Breeze atau Jetstream (opsional).

🛠️ Teknologi yang Digunakan

Laravel — Backend utama.

Laravel Reverb — Komunikasi websocket realtime.

MySQL — Database.

TailwindCSS — Styling modern responsif.

JavaScript + Axios — Handling event dan request.

Vite — Bundling aset frontend.

📦 Cara Instalasi (Development)

Clone repository:

git clone https://github.com/Zainsyam/ChatKita.git
cd ChatKita


Install dependencies:

composer install
npm install


Copy environment:

cp .env.example .env
php artisan key:generate


Konfigurasi database di .env, lalu jalankan migrasi:

php artisan migrate


Jalankan server backend:

php artisan serve


Jalankan server frontend:

npm run dev


Jalankan Reverb:

php artisan reverb:start

🌐 Cara Menjalankan Mode Production

Build aset:

npm run build


Jalankan Laravel di server:

php artisan serve --env=production


Pastikan Reverb berjalan di server:

php artisan reverb:start --env=production

🧩 Struktur Folder Penting
app/
resources/
   views/
   js/
public/
routes/

🤝 Kontribusi

Kontribusi sangat diterima!
Silakan fork repository ini lalu buat pull request.

📄 Lisensi

Project ChatKita dirilis di bawah lisensi MIT — bebas digunakan untuk kebutuhan apa pun.
