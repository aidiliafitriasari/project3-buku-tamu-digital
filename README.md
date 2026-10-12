# 📖 Buku Tamu Digital

**Aplikasi Buku Tamu Digital Berbasis Web dan Progressive Web App (PWA)**

Aplikasi Buku Tamu Digital merupakan sistem pencatatan dan pengelolaan kunjungan tamu berbasis web yang dikembangkan untuk menggantikan proses pencatatan tamu secara manual. Aplikasi ini dirancang agar proses registrasi, verifikasi, pemantauan, hingga checkout kunjungan dapat dilakukan secara digital, terstruktur, dan terdokumentasi.

Aplikasi ditujukan untuk berbagai lingkungan pelayanan dan organisasi, seperti sekolah, kantor desa, instansi pemerintah, perusahaan, hotel, serta tempat pelayanan publik.

Project ini dikembangkan menggunakan **CodeIgniter 4**, **PHP**, dan **MySQL/MariaDB**, dengan pendekatan desain antarmuka **iOS 26 Look — Liquid Glass / Frosted Glass**.

---

## 📌 Informasi Project

| Informasi          | Keterangan                            |
| ------------------ | ------------------------------------- |
| Nama Project       | Buku Tamu Digital                     |
| Jenis Aplikasi     | Web Application & Progressive Web App |
| Kategori           | Sistem Informasi Pencatatan Kunjungan |
| Framework          | CodeIgniter 4                         |
| Bahasa Pemrograman | PHP, JavaScript                       |
| Database           | MySQL/MariaDB                         |
| CSS Framework      | Bootstrap 5                           |
| Font               | Poppins                               |
| Konsep UI          | iOS 26 Look — Liquid Glass            |
| Durasi Pengerjaan  | 5 Minggu                              |
| Target             | Produk Siap Demo                      |
| Instansi Magang    | CV Amins Project Teknologi Indonesia  |

> **Catatan:** Versi PHP, CodeIgniter, database, dan dependensi aktual mengikuti konfigurasi project. Periksa `composer.json`, `composer.lock`, serta lingkungan pengembangan sebelum mencantumkan versi spesifik.

---

## 🎯 Tujuan Project

Project ini bertujuan untuk:

1. Menggantikan pencatatan tamu manual dengan sistem digital.
2. Mempermudah proses registrasi dan pengelolaan data kunjungan.
3. Mempermudah petugas dalam memantau tamu yang sedang berada di lokasi.
4. Menyediakan proses check-in dan check-out yang tercatat secara otomatis berdasarkan waktu server.
5. Menghasilkan kode kunjungan dan QR Code unik untuk kebutuhan checkout.
6. Menyediakan dashboard dan laporan berdasarkan data kunjungan.
7. Menjaga keamanan informasi dan data pribadi tamu.
8. Menghadirkan aplikasi yang responsif dan dapat dipasang sebagai PWA.
9. Mengembangkan fondasi aplikasi yang dapat dipresentasikan dan berpotensi dikembangkan menjadi produk Amins Project.

---

## ✨ Fitur dan Modul Aplikasi

Fitur berikut merupakan ruang lingkup yang ditetapkan dalam ketentuan project. Status implementasinya perlu disesuaikan dengan kondisi aplikasi sebenarnya.

### 1. Modul Tamu (Public)

Tamu dapat melakukan registrasi kunjungan tanpa harus memiliki akun atau login.

Fitur yang direncanakan:

- Formulir registrasi kunjungan bertahap.
- Pengisian identitas tamu.
- Pemilihan bagian/departemen tujuan.
- Pemilihan pegawai yang dituju.
- Pengisian keperluan kunjungan.
- Pengisian jumlah rombongan.
- Pengambilan foto langsung menggunakan kamera perangkat.
- Fallback upload foto apabila kamera tidak dapat digunakan.
- Tanda tangan digital menggunakan canvas.
- Persetujuan penggunaan data pribadi.
- Pembuatan kode kunjungan unik.
- Pembuatan QR Code untuk checkout.
- Penampilan informasi kunjungan setelah registrasi berhasil.

### 2. Modul Administrator

Administrator memiliki kewenangan untuk mengelola data dan konfigurasi aplikasi.

Fitur yang direncanakan:

- Dashboard administrator.
- Melihat statistik kunjungan berdasarkan periode.
- Melihat grafik kunjungan harian.
- Melihat jam kunjungan terpadat.
- Melihat daftar kunjungan terbaru.
- Memantau tamu yang masih berada di lokasi.
- Mengelola akun pengguna.
- Mengelola role dan hak akses.
- Mengelola data pegawai.
- Mengelola bagian/departemen.
- Mengelola keperluan kunjungan.
- Mengelola identitas instansi.
- Mengelola konfigurasi aplikasi.
- Melihat laporan kunjungan.
- Melihat activity log.
- Mengelola data kunjungan sesuai kewenangan administrator.

### 3. Modul Petugas / Resepsionis

Petugas bertanggung jawab terhadap proses operasional kunjungan.

Fitur yang direncanakan:

- Dashboard petugas.
- Melihat ringkasan kunjungan.
- Melihat daftar kunjungan.
- Melihat detail kunjungan.
- Memproses check-in.
- Menolak kunjungan.
- Membatalkan kunjungan sesuai kewenangan.
- Memproses checkout secara manual.
- Memindai QR Code untuk checkout.
- Memperbaiki data kunjungan sesuai kewenangan.
- Memantau tamu yang masih berada di lokasi.

### 4. Modul Manajemen Kunjungan

Sistem menyediakan pengelolaan data kunjungan secara terstruktur.

Fitur yang direncanakan:

- Menampilkan daftar kunjungan.
- Pencarian berdasarkan nama, kode kunjungan, atau nomor HP.
- Filter berdasarkan tanggal dan rentang tanggal.
- Filter berdasarkan bagian/departemen.
- Filter berdasarkan pegawai tujuan.
- Filter berdasarkan status kunjungan.
- Pagination.
- Halaman detail kunjungan.
- Menampilkan foto dan tanda tangan.
- Menampilkan waktu kedatangan dan waktu keluar.
- Menghitung durasi kunjungan secara otomatis.
- Menampilkan riwayat aktivitas terkait kunjungan.
- Edit data sesuai hak akses.
- Hapus data oleh administrator dan pencatatan aktivitas penghapusan.

Tampilan data menggunakan tabel responsif pada desktop dan card/list pada perangkat mobile.

### 5. Modul Laporan

Laporan digunakan untuk membantu administrator memantau aktivitas kunjungan.

Jenis laporan:

- Laporan harian.
- Laporan mingguan.
- Laporan bulanan.
- Laporan berdasarkan rentang tanggal.
- Laporan berdasarkan bagian/departemen.
- Laporan berdasarkan pegawai tujuan.
- Laporan berdasarkan asal instansi tamu.
- Rekap jumlah kunjungan.
- Rekap durasi kunjungan.

Format keluaran yang direncanakan:

- PDF.
- Excel.

Filter yang diterapkan pada halaman laporan harus diterapkan juga pada hasil PDF dan Excel.

### 6. Modul Master Data

Master data digunakan sebagai sumber data untuk proses registrasi dan pengelolaan kunjungan.

| Master Data         | Keterangan                                                                  |
| ------------------- | --------------------------------------------------------------------------- |
| Pengguna            | Data akun administrator dan petugas                                         |
| Pegawai             | Data pegawai yang dapat menjadi tujuan kunjungan                            |
| Bagian/Departemen   | Data bagian atau departemen instansi                                        |
| Keperluan Kunjungan | Pilihan keperluan kunjungan                                                 |
| Identitas Instansi  | Nama, logo, alamat, telepon, dan email                                      |
| Pengaturan          | Warna utama, kewajiban foto/tanda tangan, ukuran foto, dan batas peringatan |

### 7. Modul Activity Log

Activity log digunakan untuk mencatat aktivitas penting dalam aplikasi.

Informasi yang dicatat menyesuaikan implementasi, antara lain:

- Pengguna yang melakukan aktivitas.
- Jenis aktivitas.
- Data atau objek yang berkaitan.
- Waktu aktivitas.
- Informasi pendukung yang diperlukan untuk audit.

---

## 🔄 Alur Utama Kunjungan

Alur umum proses kunjungan:

1. Tamu membuka halaman registrasi Buku Tamu Digital.
2. Tamu mengisi identitas pribadi.
3. Tamu memilih bagian/departemen dan pegawai tujuan.
4. Tamu mengisi keperluan serta jumlah rombongan.
5. Tamu mengambil foto melalui kamera perangkat.
6. Tamu membubuhkan tanda tangan digital.
7. Tamu menyetujui penggunaan data.
8. Sistem melakukan validasi pada sisi server.
9. Sistem menyimpan data kunjungan.
10. Sistem membuat kode kunjungan unik dan QR Code.
11. Status kunjungan berubah menjadi **Masih Berkunjung** setelah proses registrasi berhasil sesuai alur yang ditetapkan.
12. Petugas memantau kunjungan yang sedang berlangsung.
13. Setelah kunjungan selesai, petugas melakukan checkout melalui pemindaian QR Code atau tombol checkout.
14. Server mencatat waktu keluar dan menghitung durasi kunjungan secara otomatis.
15. Status kunjungan berubah menjadi **Selesai**.

### Status Kunjungan

| Status           | Keterangan                           |
| ---------------- | ------------------------------------ |
| Menunggu         | Kunjungan menunggu proses verifikasi |
| Masih Berkunjung | Tamu sedang berada di lokasi         |
| Selesai          | Tamu telah melakukan checkout        |
| Ditolak          | Kunjungan ditolak oleh petugas       |
| Dibatalkan       | Kunjungan dibatalkan                 |

> Waktu check-in dan checkout harus berasal dari server, bukan dari waktu yang dikirimkan oleh browser pengguna.

---

## 📸 Pengambilan Foto Tamu

Aplikasi menyediakan fitur pengambilan foto secara langsung menggunakan kamera perangkat.

Ketentuan implementasi:

- Menggunakan `navigator.mediaDevices.getUserMedia()`.
- Mengutamakan kamera depan dengan `facingMode: "user"`.
- Menampilkan preview kamera secara real-time tanpa audio.
- Menyediakan tombol Buka Kamera, Ambil Foto, dan Foto Ulang.
- Menghentikan media stream setelah pengambilan foto atau ketika halaman ditutup.
- Menampilkan pesan apabila izin kamera ditolak.
- Menyediakan fallback upload foto.
- Mengompresi foto ke JPG/JPEG/WebP dengan target maksimal 500 KB.
- Menggunakan nama file acak.
- Melakukan validasi MIME type, ekstensi, dan ukuran di backend.
- Menyimpan file foto di server.
- Menyimpan path foto pada database, bukan Base64 atau BLOB.
- Memastikan foto hanya disimpan setelah persetujuan penggunaan data diberikan.

Kamera harus dijalankan melalui HTTPS atau localhost.

---

## ✍️ Tanda Tangan Digital

Aplikasi menyediakan tanda tangan digital melalui elemen HTML canvas.

Ketentuan implementasi:

- Mendukung input menggunakan mouse.
- Mendukung input melalui layar sentuh.
- Menyediakan tombol hapus atau ulangi.
- Menyediakan preview tanda tangan.
- Menyimpan hasil tanda tangan sebagai file dengan nama unik.
- Menyimpan path file pada database.
- Mencegah penyimpanan tanda tangan kosong apabila tanda tangan diwajibkan.

---

## 🔳 QR Code dan Checkout

QR Code digunakan sebagai sarana identifikasi kunjungan dan proses checkout.

Ketentuan keamanan:

- Setiap kunjungan memiliki token atau kode unik yang sulit ditebak.
- QR Code hanya memuat token atau URL yang aman.
- QR Code tidak boleh memuat identitas sensitif secara langsung.
- QR dapat membuka detail kunjungan terbatas.
- QR digunakan untuk melakukan checkout.
- Sistem menolak token yang tidak valid atau kedaluwarsa.
- Sistem mencegah akses terhadap data kunjungan lain.
- Sistem mencegah checkout ganda.
- Aktivitas checkout dicatat.

---

## 📊 Dashboard

Dashboard administrator dan petugas menampilkan informasi sesuai hak akses masing-masing.

Informasi dashboard yang direncanakan:

- Total tamu hari ini.
- Total tamu minggu ini.
- Total tamu bulan ini.
- Jumlah tamu yang masih berada di lokasi.
- Jumlah kunjungan yang telah selesai.
- Jumlah kunjungan yang belum checkout.
- Kunjungan berdasarkan bagian/departemen.
- Grafik kunjungan harian.
- Jam kunjungan terpadat.
- Daftar kunjungan terbaru.
- Peringatan kunjungan yang berlangsung terlalu lama.

**Seluruh informasi dashboard wajib menggunakan data asli dari database.** Data statis atau dummy tidak diperbolehkan pada hasil final.

---

## 🎨 Desain Antarmuka — iOS 26 Look

Seluruh dashboard administrator, dashboard petugas, halaman buku tamu, halaman kiosk, dan PWA wajib menggunakan pendekatan desain **iOS 26 Look — Liquid Glass / Frosted Glass**.

Arah visual:

- Font Poppins.
- Latar terang dengan ambient gradient lembut.
- Glass surface berlapis.
- Transparansi, backdrop blur yang wajar, border tipis, highlight, dan shadow lembut.
- Radius konsisten sekitar 20–28 px.
- Tombol rounded atau pill.
- Ikon modern dan konsisten.
- Whitespace yang cukup.
- Kontras teks yang mudah dibaca.
- Identitas warna mengikuti identitas instansi.

### Dashboard Desktop

- Floating glass sidebar.
- Header ringkas berisi judul, pencarian, notifikasi, dan profil.
- Statistik dan grafik menggunakan glass card.
- Badge dengan warna lembut.
- Daftar dan tabel tidak terlalu padat.
- Loading, empty, error, dan success state yang konsisten.

### Mobile dan PWA

- Pendekatan mobile-first.
- Floating bottom navigation.
- Dukungan safe area menggunakan `env(safe-area-inset-*)`.
- Touch target minimal 44 × 44 px.
- Tidak memiliki horizontal scroll.
- Navigasi mudah dijangkau satu tangan.
- Tampilan terasa seperti aplikasi native.

### Halaman Kiosk

Alur tampilan formulir kiosk:

**Identitas → Tujuan → Foto → Tanda Tangan/Persetujuan → Konfirmasi → QR Berhasil**

Ketentuan tampilan:

- Glass card utama.
- Tombol berukuran besar.
- Label dan petunjuk jelas.
- Frame kamera rounded.
- Area tanda tangan yang nyaman digunakan.
- Mudah digunakan melalui layar sentuh.

### Komponen UI yang Konsisten

- Glass card.
- Button.
- Input dan select.
- Date picker.
- Modal.
- Toast.
- Badge.
- Tabel desktop.
- Mobile card/list.
- Sidebar.
- Bottom navigation.
- Kamera.
- Signature canvas.
- QR Code.
- Skeleton loading.
- Empty state.
- Confirmation dialog.

Design token disimpan menggunakan CSS variables untuk warna, radius, blur, shadow, spacing, dan opacity.

### Larangan Desain

- Tidak menggunakan tampilan default template admin/sidebar gelap Bootstrap.
- Tidak sekadar menambahkan radius lalu menyebutnya iOS 26.
- Tidak menggunakan gradient berlebihan.
- Tidak menggunakan border tebal dan shadow hitam pekat.
- Tidak membuat terlalu banyak card kecil.
- Tidak menggunakan blur yang mengganggu keterbacaan.
- Tidak menggunakan emoji sebagai ikon antarmuka.
- Tidak membuat tampilan mobile hanya dengan mengecilkan dashboard desktop.

---

## 📱 Progressive Web App (PWA)

Aplikasi dikembangkan agar dapat digunakan melalui browser dan dipasang pada perangkat yang mendukung PWA.

Komponen PWA:

- Web App Manifest.
- Ikon aplikasi.
- Splash screen.
- Mode standalone.
- Theme color.
- Service Worker.
- Halaman offline.
- Indikator koneksi online/offline.
- Safe area support.
- Floating bottom navigation pada perangkat mobile.

### Ketentuan Cache dan Offline

- Aset statis dapat disimpan menggunakan strategi cache yang sesuai.
- Foto, tanda tangan, identitas sensitif, dan halaman administrator tidak boleh disimpan secara permanen dalam cache.
- Pengiriman formulir hanya dilakukan ketika koneksi ke server tersedia.
- Halaman offline menampilkan informasi yang jelas kepada pengguna.

---

## 🛠️ Teknologi yang Digunakan

| Komponen             | Teknologi                                     |
| -------------------- | --------------------------------------------- |
| Backend              | PHP                                           |
| Framework            | CodeIgniter 4                                 |
| Database             | MySQL / MariaDB                               |
| CSS Framework        | Bootstrap 5                                   |
| Markup               | HTML5                                         |
| Styling              | CSS3                                          |
| Frontend Interaction | JavaScript                                    |
| Font                 | Poppins                                       |
| PWA                  | Web App Manifest & Service Worker             |
| Version Control      | Git                                           |
| Repository           | GitHub                                        |
| QR Code              | Library QR Code sesuai dependensi project     |
| PDF                  | Library PDF sesuai dependensi project         |
| Excel                | Library spreadsheet sesuai dependensi project |

### Lingkungan Pengembangan

Lingkungan pengembangan yang digunakan dapat mencakup:

- Laragon.
- Apache.
- MySQL/MariaDB.
- Composer.
- Visual Studio Code.
- Browser modern.

> Dependensi QR Code, PDF, dan Excel harus dicantumkan sesuai library yang benar-benar terpasang di `composer.json`. Jangan menganggap library tertentu sudah digunakan sebelum diperiksa.

---

## 💻 Kebutuhan Sistem

Sebelum menjalankan aplikasi, siapkan:

- PHP 8.2 atau lebih baru (sesuaikan dengan kebutuhan CodeIgniter dan dependensi project).
- CodeIgniter 4.
- MySQL 8.0+ atau MariaDB.
- Composer 2.x.
- Apache atau Nginx.
- Git.
- Browser modern.

### Ekstensi PHP

Pastikan ekstensi yang dibutuhkan tersedia, antara lain:

- `intl`
- `mbstring`
- `json`
- `mysqlnd`
- `curl`
- `gd`
- `fileinfo`

Ekstensi tambahan dapat diperlukan sesuai library dan fitur yang digunakan.

---

## 🚀 Instalasi dan Konfigurasi

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

**Windows CMD:**

```cmd
copy .env.example .env
```

**Linux/macOS:**

```bash
cp .env.example .env
```

Sesuaikan konfigurasi aplikasi dan database di dalam file `.env`.

Contoh konfigurasi:

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'
app.indexPage = ''

database.default.hostname = localhost
database.default.database = db_buku_tamu_digital
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Sesuaikan hostname, database, username, password, dan port dengan konfigurasi lokal.

### 4. Buat Database

Buat database melalui phpMyAdmin atau MySQL CLI.

```sql
CREATE DATABASE db_buku_tamu_digital
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;
```

### 5. Jalankan Migration

```bash
php spark migrate
```

Migration digunakan untuk membangun struktur tabel berdasarkan definisi database pada project.

### 6. Jalankan Seeder

```bash
php spark db:seed DatabaseSeeder
```

Seeder akan memasukkan data awal sesuai implementasi, misalnya:

- Akun administrator dan petugas.
- Data bagian/departemen.
- Data pegawai.
- Keperluan kunjungan.
- Identitas instansi.
- Pengaturan aplikasi.

### 7. Jalankan Aplikasi

```bash
php spark serve
```

Buka browser dan akses:

```text
http://localhost:8080
```

Alternatifnya, jalankan melalui lingkungan Laragon sesuai konfigurasi virtual host yang digunakan.

---

## 🔐 Akun Demo

Akun demo hanya boleh dicantumkan apabila sudah tersedia dan berhasil diuji melalui seeder.

| Role          | Email                | Password             |
| ------------- | -------------------- | -------------------- |
| Administrator | Isi sesuai akun demo | Isi sesuai akun demo |
| Petugas       | Isi sesuai akun demo | Isi sesuai akun demo |

> Ganti password default sebelum aplikasi digunakan pada lingkungan production. Jangan menggunakan password demo untuk akun sebenarnya.

---

## 🗄️ Struktur Database Minimal

Berdasarkan ketentuan project, tabel minimal yang perlu disiapkan:

| Tabel            | Fungsi                                     |
| ---------------- | ------------------------------------------ |
| `users`          | Menyimpan akun pengguna dan informasi role |
| `guests`         | Menyimpan data identitas tamu              |
| `visits`         | Menyimpan data kunjungan dan statusnya     |
| `employees`      | Menyimpan data pegawai                     |
| `departments`    | Menyimpan data bagian/departemen           |
| `visit_purposes` | Menyimpan data keperluan kunjungan         |
| `settings`       | Menyimpan konfigurasi aplikasi             |
| `activity_logs`  | Menyimpan riwayat aktivitas                |

Ketentuan database:

- Menggunakan primary key dan foreign key.
- Menggunakan indeks untuk kebutuhan pencarian.
- Menggunakan tipe data yang sesuai.
- Menggunakan `created_at` dan `updated_at`.
- Menggunakan `deleted_at` apabila menerapkan soft delete.
- Struktur database dikelola menggunakan migration CodeIgniter 4.
- Data awal dikelola menggunakan seeder.
- ERD dibuat untuk menggambarkan relasi antartabel.

Struktur dan nama kolom final mengikuti migration yang benar-benar diterapkan pada project.

---

## 🔒 Keamanan Aplikasi

Keamanan merupakan bagian penting dari pengembangan Buku Tamu Digital karena aplikasi menangani data pribadi dan informasi kunjungan.

Ketentuan keamanan:

1. Mengaktifkan CSRF protection pada formulir.
2. Menerapkan validasi server-side menggunakan validation rules.
3. Menggunakan Query Builder atau prepared statement untuk akses database.
4. Mencegah SQL injection.
5. Melakukan escaping output untuk mengurangi risiko XSS.
6. Mencegah manipulasi ID dan akses data tanpa hak.
7. Menggunakan `password_hash()` untuk menyimpan password.
8. Menggunakan `password_verify()` untuk memverifikasi password.
9. Melakukan session regeneration setelah login.
10. Membatasi halaman dan aksi berdasarkan role pengguna.
11. Memvalidasi file upload berdasarkan MIME type, ekstensi, dan ukuran.
12. Menggunakan nama file acak.
13. Menyimpan foto dan tanda tangan sebagai file di server, bukan Base64/BLOB di database.
14. Melakukan masking nomor identitas dan nomor HP pada daftar umum.
15. Mencatat aktivitas penting pada activity log.
16. Menyediakan halaman error khusus untuk 403, 404, dan 500.

### Perlindungan Data Sensitif

- QR Code tidak boleh memuat identitas sensitif secara langsung.
- Foto dan tanda tangan hanya diproses sesuai persetujuan penggunaan data.
- File sensitif tidak boleh dapat diakses secara bebas tanpa mekanisme otorisasi yang sesuai.
- Informasi sensitif tidak boleh disimpan secara permanen dalam cache PWA.
- File `.env`, password, token, API key, kredensial database, dan data identitas asli tidak boleh diunggah ke repository.

---

## 🧪 Pengujian Aplikasi

Pengujian dilakukan untuk memastikan fitur berjalan sesuai kebutuhan dan hak akses yang ditentukan.

Area pengujian:

| Area            | Hal yang Diuji                                         |
| --------------- | ------------------------------------------------------ |
| Autentikasi     | Login, logout, session, dan role                       |
| Registrasi Tamu | Validasi input dan penyimpanan data                    |
| Kamera          | Izin browser, preview, foto ulang, dan fallback upload |
| Upload Foto     | MIME type, ekstensi, ukuran, dan nama file             |
| Tanda Tangan    | Mouse, layar sentuh, hapus, dan validasi kosong        |
| Kunjungan       | Status, check-in, dan checkout                         |
| QR Code         | Token valid, tidak valid, dan checkout                 |
| Dashboard       | Data statistik berasal dari database                   |
| Master Data     | CRUD dan pembatasan akses                              |
| Laporan         | Filter, PDF, dan Excel                                 |
| Activity Log    | Pencatatan aktivitas                                   |
| PWA             | Install, offline page, cache, dan indikator koneksi    |
| Responsivitas   | HP, tablet, dan desktop                                |
| Keamanan        | CSRF, validasi, XSS, SQL injection, dan akses role     |

Pengujian dilakukan pada browser dan perangkat yang tersedia. Hasil pengujian dan daftar bug dicatat sebagai bagian dokumentasi project.

---

## 📂 Struktur Folder Project

Berikut gambaran struktur folder yang direncanakan. Struktur aktual mengikuti file dan direktori yang benar-benar tersedia di repository.

```text
project3-buku-tamu-digital/
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Database/
│   │   ├── Migrations/
│   │   └── Seeds/
│   ├── Filters/
│   ├── Helpers/
│   ├── Libraries/
│   ├── Models/
│   ├── Services/
│   ├── Validation/
│   └── Views/
│       ├── layouts/
│       ├── admin/
│       ├── petugas/
│       ├── guest/
│       └── kiosk/
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   ├── images/
│   │   └── icons/
│   ├── manifest.json
│   ├── sw.js
│   └── offline.html
├── tests/
├── writable/
├── .env.example
├── .gitignore
├── composer.json
├── composer.lock
└── README.md
```

---

## 📱 Screenshot Aplikasi

Screenshot ditambahkan setelah halaman terkait selesai diimplementasikan dan diuji.

| Halaman                 | Screenshot       |
| ----------------------- | ---------------- |
| Login                   | Akan ditambahkan |
| Dashboard Administrator | Akan ditambahkan |
| Dashboard Petugas       | Akan ditambahkan |
| Registrasi Tamu         | Akan ditambahkan |
| Halaman Kiosk           | Akan ditambahkan |
| Detail Kunjungan        | Akan ditambahkan |
| Laporan                 | Akan ditambahkan |
| PWA Mobile              | Akan ditambahkan |

Contoh struktur folder screenshot:

```text
docs/
└── screenshots/
    ├── login.png
    ├── dashboard-admin.png
    ├── dashboard-petugas.png
    ├── registrasi-tamu.png
    ├── kiosk.png
    ├── detail-kunjungan.png
    ├── laporan.png
    └── pwa-mobile.png
```

Setelah screenshot tersedia, tampilkan menggunakan Markdown, misalnya:

```markdown
![Dashboard Administrator](docs/screenshots/dashboard-admin.png)
```

---

## 🗓️ Tahapan Pengerjaan

Project direncanakan selesai dalam waktu lima minggu.

### Minggu 1 — Analisis, Desain, dan Persiapan

- Analisis kebutuhan.
- Pembuatan flowchart.
- Pembuatan use case.
- Perancangan ERD.
- Penyusunan struktur menu.
- Pembuatan wireframe desktop dan mobile.
- Desain halaman kiosk.
- Pembagian tugas dan jadwal.
- Setup CodeIgniter 4.
- Setup repository.
- Pembuatan migration dan seeder awal.

### Minggu 2 — Autentikasi dan Master Data

- Login dan logout.
- Implementasi role dan hak akses.
- Dashboard dasar.
- Implementasi layout iOS 26 Look.
- CRUD pengguna.
- CRUD pegawai.
- CRUD bagian/departemen.
- CRUD keperluan kunjungan.
- Identitas instansi dan pengaturan.
- Activity log dasar.
- Validasi dan pembatasan akses.

### Minggu 3 — Form Tamu dan Proses Kunjungan

- Form registrasi bertahap.
- Implementasi kamera.
- Fallback upload.
- Kompresi dan validasi foto.
- Tanda tangan digital.
- Check-in.
- Pembuatan kode kunjungan unik.
- QR Code.
- Detail kunjungan.
- Check-out dan durasi kunjungan.

**Target akhir minggu:** alur registrasi hingga checkout harus berfungsi.

### Minggu 4 — Dashboard, Laporan, dan PWA

- Statistik dan grafik.
- Pencarian, filter, dan pagination.
- Peringatan kunjungan terlalu lama.
- Laporan.
- Export PDF dan Excel.
- Web App Manifest.
- Service Worker.
- Ikon dan splash screen.
- Halaman offline.
- Bottom navigation.
- Penyempurnaan desain dan responsivitas.

### Minggu 5 — Pengujian dan Finalisasi

- Pengujian fitur.
- Pengujian role dan hak akses.
- Pengujian kamera dan izin browser.
- Pengujian tanda tangan.
- Pengujian QR Code.
- Pengujian PDF dan Excel.
- Pengujian PWA.
- Pengujian perangkat HP, tablet, dan komputer.
- Audit keamanan dasar.
- Perbaikan bug prioritas tinggi.
- Deploy aplikasi demo.
- Penyusunan dokumentasi.
- Pembuatan video demo dan slide presentasi.

> Pada minggu kelima, penambahan fitur baru ditunda sampai bug penting pada fitur utama selesai diperbaiki.

---

## 📦 Hasil Akhir yang Ditargetkan

Hasil akhir project yang wajib disiapkan:

- Source code aplikasi lengkap dan rapi.
- Database.
- Migration dan seeder.
- ERD.
- Use case.
- Flowchart.
- Wireframe.
- Desain UI desktop dan mobile.
- Dokumentasi instalasi.
- Panduan pengguna.
- Akun demo.
- Test case.
- Hasil pengujian.
- Daftar bug.
- Video demo.
- Slide presentasi.
- Aplikasi demo online.
- Proposal pengembangan lanjutan.

---

## ⚠️ Batasan dan Catatan Project

- Aplikasi tidak boleh hanya berupa tampilan UI tanpa backend.
- Dashboard final wajib menggunakan data asli dari database.
- Password tidak boleh disimpan dalam bentuk teks biasa.
- Foto dan tanda tangan tidak boleh disimpan sebagai Base64 atau BLOB di database.
- Perubahan struktur database harus menggunakan migration.
- Kredensial dan data pribadi tidak boleh diunggah ke repository.
- Kode yang digunakan harus dipahami dan dapat dijelaskan oleh anggota yang mengerjakannya.
- Desain seluruh halaman harus konsisten.
- Fitur tidak boleh dinyatakan selesai sebelum diuji.
- Implementasi harus mengikuti persetujuan pembimbing.

### Pengembangan Opsional

Fitur tambahan seperti integrasi WhatsApp API, notifikasi otomatis, dan integrasi layanan pihak ketiga dapat dipertimbangkan sebagai pengembangan lanjutan apabila sudah mendapat persetujuan dan tidak mengganggu penyelesaian fitur wajib.

---

## 🤝 Kontribusi dan Version Control

Git dan GitHub digunakan untuk mengelola source code dan riwayat pengerjaan.

Panduan kerja:

1. Gunakan repository project sebagai sumber kode bersama.
2. Lakukan commit secara berkala.
3. Gunakan pesan commit yang menjelaskan perubahan.
4. Pisahkan pekerjaan berdasarkan modul atau tanggung jawab.
5. Jangan mengunggah `.env` dan data sensitif.
6. Lakukan pengujian sebelum menggabungkan perubahan.
7. Dokumentasikan progres dan kendala setiap minggu.

Contoh pesan commit:

```text
feat: add guest registration form
feat: implement guest photo capture
feat: add visit checkout using QR
fix: validate guest identity input
style: improve administrator dashboard
docs: update project documentation
```

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

## 🙏 Acknowledgements

- **CV Amins Project Teknologi Indonesia** — instansi dan pembimbing magang.
- **CodeIgniter 4** — framework pengembangan aplikasi.
- **Bootstrap 5** — framework antarmuka.
- **Poppins** — font antarmuka aplikasi.
- **Git dan GitHub** — version control dan pengelolaan repository.

---

**© 2026 Buku Tamu Digital — CV Amins Project Teknologi Indonesia**

_Dikembangkan sebagai project magang dengan target menjadi aplikasi Buku Tamu Digital yang fungsional, aman, responsif, dan siap didemonstrasikan._
