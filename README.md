# 📖 Buku Tamu Digital

**Aplikasi Pencatatan Kunjungan Berbasis Web dan Progressive Web App (PWA)**

Buku Tamu Digital merupakan aplikasi berbasis web yang dikembangkan untuk mempermudah proses registrasi, pencatatan, pemantauan, dan pengelolaan kunjungan tamu secara digital.

Aplikasi ini dirancang untuk mendukung berbagai kebutuhan pencatatan kunjungan, seperti pada sekolah, kantor desa, instansi pemerintah, perusahaan, hotel, dan tempat pelayanan publik.

Project dikembangkan menggunakan **CodeIgniter 4** dengan pendekatan desain **iOS 26 Look — Liquid Glass**, serta memperhatikan keamanan data, kemudahan penggunaan, dan responsivitas pada berbagai perangkat yaitu Desktop, Tablet, Mobile.

---

## 📌 Informasi Project

| Informasi      | Keterangan                           |
| -------------- | ------------------------------------ |
| Nama Project   | Buku Tamu Digital                    |
| Jenis          | Web Application & PWA                |
| Framework      | CodeIgniter 4                        |
| Bahasa         | PHP, JavaScript                      |
| Database       | MySQL / MariaDB                      |
| CSS Framework  | Bootstrap 5                          |
| Font           | Poppins                              |
| Desain UI      | iOS 26 Look — Liquid Glass           |
| Durasi Project | 5 Minggu                             |
| Instansi       | CV Amins Project Teknologi Indonesia |

---

## ✨ Fitur Utama

### 👤 Registrasi Tamu

- Registrasi kunjungan tanpa login.
- Formulir identitas dan tujuan kunjungan.
- Pengambilan foto melalui kamera atau upload.
- Tanda tangan digital.
- Persetujuan penggunaan data.
- Pembuatan kode kunjungan dan QR Code.

### 🏢 Administrator

- Dashboard statistik kunjungan.
- Pengelolaan pengguna dan hak akses.
- Pengelolaan pegawai, departemen, dan keperluan kunjungan.
- Pengelolaan identitas instansi dan pengaturan aplikasi.
- Pengelolaan data kunjungan.
- Laporan dan activity log.

### 🧑‍💼 Petugas / Resepsionis

- Dashboard operasional.
- Melihat daftar dan detail kunjungan.
- Memproses check-in dan checkout.
- Checkout melalui pemindaian QR Code.
- Mengelola kunjungan sesuai kewenangan.

### 📊 Laporan

- Rekap kunjungan berdasarkan periode.
- Filter berdasarkan bagian, pegawai, dan asal instansi.
- Export laporan ke PDF dan Excel.

### 📱 Progressive Web App (PWA)

- Dapat dipasang pada perangkat yang mendukung PWA.
- Web App Manifest dan Service Worker.
- Halaman offline.
- Indikator koneksi.
- Navigasi bawah pada perangkat mobile.
- Dukungan safe area perangkat.

---

## 🔄 Alur Penggunaan

1. Tamu membuka halaman registrasi.
2. Tamu mengisi identitas dan tujuan kunjungan.
3. Tamu mengambil foto dan mengisi tanda tangan digital.
4. Tamu memberikan persetujuan penggunaan data.
5. Sistem memvalidasi dan menyimpan data kunjungan.
6. Sistem menghasilkan kode kunjungan dan QR Code.
7. Petugas memantau kunjungan yang berlangsung.
8. Tamu melakukan checkout melalui QR Code atau bantuan petugas.
9. Sistem mencatat waktu keluar dan menghitung durasi kunjungan.

### Status Kunjungan

- **Menunggu**
- **Masih Berkunjung**
- **Selesai**
- **Ditolak**
- **Dibatalkan**

---

## 🎨 Desain Antarmuka

Aplikasi menggunakan konsep **iOS 26 Look — Liquid Glass / Frosted Glass** dengan identitas visual yang modern, bersih, dan profesional.

Karakteristik desain:

- Font Poppins.
- Warna utama Emerald Green.
- Glass surface dengan transparansi dan blur yang terukur.
- Border tipis, highlight, dan shadow lembut.
- Sudut komponen yang konsisten.
- Layout responsif untuk desktop dan mobile.
- Floating bottom navigation untuk pengalaman PWA.

Pendekatan desain diterapkan secara konsisten pada dashboard administrator, dashboard petugas, halaman registrasi tamu, kiosk, dan halaman pendukung lainnya.

---

## 🛠️ Teknologi

| Komponen        | Teknologi                         |
| --------------- | --------------------------------- |
| Backend         | PHP                               |
| Framework       | CodeIgniter 4                     |
| Database        | MySQL / MariaDB                   |
| Frontend        | HTML5, CSS3, JavaScript           |
| CSS Framework   | Bootstrap 5                       |
| Font            | Poppins                           |
| PWA             | Web App Manifest & Service Worker |
| Version Control | Git & GitHub                      |

Library tambahan untuk QR Code, PDF, dan Excel mengikuti dependensi yang tercatat pada `composer.json`.

---

## 💻 Persyaratan Sistem

- PHP 8.2 atau lebih baru.
- CodeIgniter 4.
- MySQL 8.0+ atau MariaDB.
- Composer 2.x.
- Apache atau Nginx.
- Ekstensi PHP yang dibutuhkan aplikasi.
- Browser modern.

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/aidiliafitriasari/project3-buku-tamu-digital.git

cd project3-buku-tamu-digital
```

### 2. Install Dependensi

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`.

**Windows:**

```cmd
copy .env.example .env
```

**Linux / macOS:**

```bash
cp .env.example .env
```

Sesuaikan konfigurasi aplikasi dan database di dalam file `.env`.

### 4. Buat Database

```sql
CREATE DATABASE db_buku_tamu_digital
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;
```

### 5. Jalankan Migration dan Seeder

```bash
php spark migrate

php spark db:seed DatabaseSeeder
```

### 6. Jalankan Aplikasi

```bash
php spark serve
```

Buka aplikasi melalui alamat berikut:

```text
http://localhost:8080
```

---

## 🔒 Keamanan

Keamanan aplikasi diperhatikan melalui beberapa mekanisme:

- CSRF Protection.
- Validasi data pada frontend dan server-side.
- Query Builder atau prepared statement.
- Password hashing dan verifikasi password.
- Pembatasan akses berdasarkan role.
- Validasi file upload.
- Masking data sensitif.
- Activity log.
- Penanganan halaman error 403, 404, dan 500.

Data foto dan tanda tangan disimpan sebagai file pada server, sedangkan database menyimpan path file.

> **Penting:** Jangan mengunggah file `.env`, password, token, API key, kredensial database, maupun data pribadi asli ke repository.

---

## 🧪 Pengujian

Pengujian dilakukan untuk memastikan fitur berjalan sesuai kebutuhan, meliputi:

- Autentikasi dan hak akses.
- Registrasi dan validasi tamu.
- Kamera dan upload foto.
- Tanda tangan digital.
- Check-in dan checkout.
- QR Code.
- Dashboard dan laporan.
- Export PDF dan Excel.
- Responsivitas tampilan.
- Instalasi dan fungsi PWA.
- Keamanan dasar aplikasi.

---

## 👨‍💻 Author

**Aidilia Fitriasari**

- GitHub: [@aidiliafitriasari](https://github.com/aidiliafitriasari)
- Repository: [project3-buku-tamu-digital](https://github.com/aidiliafitriasari/project3-buku-tamu-digital)

---

## 🏢 Instansi Magang

**CV Amins Project Teknologi Indonesia**

Project ini dikembangkan sebagai bagian dari kegiatan magang untuk menerapkan kemampuan analisis, perancangan, pengembangan, pengujian, dan dokumentasi aplikasi berbasis web.

---

**© 2026 Buku Tamu Digital — CV Amins Project Teknologi Indonesia**
