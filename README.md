🏫 Tentang Website

Website ini merupakan platform pembelajaran interaktif yang menyediakan fitur kuis sebagai sarana siswa untuk mempelajari materi pelajaran sekolah. Selain kuis biasa, tersedia juga fitur quest, yaitu kuis khusus yang memberikan reward berupa currency (duit) setelah diselesaikan.

Dengan pendekatan gamifikasi ini, kegiatan belajar menjadi lebih menarik dan memberikan motivasi tambahan kepada siswa.

✨ Fitur Utama

🔹 1. Kuis Pembelajaran

Kuis berisi soal-soal yang berhubungan dengan materi pelajaran. Siswa dapat mengerjakan kuis untuk meningkatkan pemahaman mereka.

🔹 2. Quest (Kuis dengan Reward)

Quest adalah variasi kuis yang memberikan hadiah berupa currency. Fitur ini dirancang untuk menambah aspek kompetitif dan motivasi belajar.

🔹 3. Sistem Reward / Currency

Siswa memperoleh currency setiap kali berhasil menyelesaikan quest. Currency ini dapat digunakan sesuai fitur tambahan yang tersedia dalam website.

🧱 Struktur Entitas Database

Project ini menggunakan database bernama sts_pl, berisi 14 tabel sesuai dengan struktur yang terlihat pada phpMyAdmin. Berikut adalah entitas penting yang digunakan oleh sistem:

🧑‍🎓 Tabel Inti Aplikasi (Kuis & User)
Tabel	Fungsi
users	Menyimpan data seluruh pengguna (murid/admin).
quizzes	Menyimpan daftar kuis/quest.
questions	Pertanyaan untuk setiap kuis.
options	Pilihan jawaban untuk setiap pertanyaan.
answers	Jawaban yang dipilih oleh user.
quiz_attempts	Riwayat pengerjaan kuis, skor, status, dan waktu.
⚙️ Tabel Sistem Laravel (Otomatis Dibuat)
Tabel	Fungsi
cache	Menyimpan cache aplikasi
cache_locks	Locking mekanisme cache
failed_jobs	Menyimpan job yang gagal
jobs	Daftar job (queue)
job_batches	Batch job Laravel
migrations	Catatan migrasi Laravel
password_reset_tokens	Token reset password
sessions	Menangani sesi login user

Total keseluruhan: 14 tabel

🗄️ Setup Database (Sesuai Struktur Asli di phpMyAdmin)

Website ini menggunakan phpMyAdmin + MySQL. Langkah-langkah setup-nya adalah sebagai berikut:

1️⃣ Masuk ke phpMyAdmin

Akses melalui browser:

localhost/phpmyadmin


Login menggunakan kredensial server lokal (default XAMPP):

Username: root

Password: (kosong)

2️⃣ Buat Database Baru

Klik New pada sidebar kiri

Masukkan nama database:

sts_pl


Klik Create

3️⃣ Import Struktur Database (Jika Ada File SQL)

Jika project menyediakan file export seperti sts_pl.sql, lakukan:

Klik database sts_pl

Masuk tab Import

Pilih file .sql

Klik Go

Setelah itu, semua tabel berikut akan otomatis terbentuk:

answers

cache

cache_locks

failed_jobs

jobs

job_batches

migrations

options

password_reset_tokens

questions

quizzes

quiz_attempts

sessions

users

4️⃣ Jika Tidak Ada File SQL

Jika file SQL tidak tersedia, maka:

Tabel inti (users, quizzes, questions, options, answers, quiz_attempts) harus dibuat manual atau via migration.

Tabel sistem Laravel akan terbuat otomatis ketika menjalankan:

php artisan migrate


Dengan catatan: file migration Laravel sudah sesuai dan lengkap.

💻 Teknologi yang Digunakan

PHP (Backend)
MySQL (Database)

phpMyAdmin (Database Management)

Laravel (Framework PHP)


👥 Pembagian Tugas Tim

Project ini dikembangkan oleh tiga anggota tim dengan peran masing-masing sebagai berikut:

Aurellia Valeza Salim — Front-End Developer
Bertanggung jawab pada tampilan, UI, dan interaksi pengguna.

Vinisia Evelyn Jongnatan — Designer
Merancang tampilan visual, layout, dan konsep antarmuka.

Christian Rangga Putra — Back-End Developer
Mengembangkan logika server, database, dan fitur inti aplikasi.
