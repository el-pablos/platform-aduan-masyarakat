# 🏛️ Aplikasi Layanan Publik Digital - Platform Aduan Masyarakat

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php)](https://php.net)
[![Tests](https://img.shields.io/badge/Tests-138%20Passing-success?style=flat)](https://pestphp.com)
[![License](https://img.shields.io/badge/License-MIT-blue.svg?style=flat)](LICENSE)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=flat&logo=tailwind-css)](https://tailwindcss.com)

> **Platform digital modern untuk memfasilitasi pelaporan dan penanganan aduan masyarakat terhadap layanan publik dengan sistem role-based yang terstruktur.**

---

## 📋 Deskripsi Aplikasi

**Aplikasi Layanan Publik Digital** adalah platform berbasis web yang dirancang untuk mempermudah masyarakat dalam melaporkan berbagai permasalahan layanan publik seperti infrastruktur rusak, kebersihan lingkungan, penerangan jalan, dan lainnya. Aplikasi ini menghubungkan warga dengan petugas pemerintah untuk penanganan yang cepat dan transparan.

### 🎯 Tujuan Aplikasi

- **Transparansi**: Memberikan transparansi dalam proses penanganan aduan masyarakat
- **Efisiensi**: Mempercepat proses pelaporan dan penanganan masalah layanan publik
- **Akuntabilitas**: Memastikan setiap laporan ditangani dengan baik dan dapat dilacak statusnya
- **Partisipasi**: Meningkatkan partisipasi masyarakat dalam pembangunan daerah

### 👥 Pengguna Aplikasi

1. **Warga (Citizen)**: Masyarakat umum yang dapat membuat dan melacak laporan
2. **Petugas (Officer)**: Petugas pemerintah yang dapat memberikan tanggapan pada laporan
3. **Admin**: Administrator sistem yang dapat mengelola laporan, kategori, dan pengguna

### 🛠️ Tech Stack

Aplikasi ini dibangun menggunakan **TALL Stack** dengan teknologi modern:

- **T**ailwind CSS - Utility-first CSS framework untuk styling modern
- **A**lpine.js - Lightweight JavaScript framework untuk interaktivitas
- **L**aravel 12 - PHP framework terbaru dengan fitur-fitur modern
- **L**ivewire/Blade - Template engine Laravel untuk rendering views

**Additional Technologies:**
- MySQL - Database relational untuk penyimpanan data
- Pest PHP - Testing framework modern untuk PHP
- Lottie - Animasi modern untuk meningkatkan UX
- Vite - Modern build tool untuk asset bundling

---

## ✨ Fitur-Fitur Lengkap

### 🙋 Fitur untuk Warga (Citizen)

- ✅ **Registrasi & Login** - Sistem autentikasi dengan email verification
- ✅ **Dashboard Laporan** - Melihat semua laporan yang telah dibuat dengan statistics cards
- ✅ **Buat Laporan Baru** - Form lengkap dengan:
  - Upload foto bukti (drag & drop support)
  - Pilih kategori masalah
  - Deskripsi detail dengan character counter
  - Lokasi kejadian
  - Image preview sebelum upload
- ✅ **Edit Laporan** - Mengubah laporan yang masih berstatus "menunggu"
- ✅ **Hapus Laporan** - Menghapus laporan sendiri
- ✅ **Lihat Detail Laporan** - Melihat detail lengkap laporan termasuk:
  - Status laporan (menunggu, diproses, selesai, ditolak)
  - Foto bukti
  - Timeline tanggapan dari petugas
  - Informasi pelapor dan kategori
- ✅ **Filter & Search** - Mencari laporan berdasarkan status
- ✅ **Notifikasi Status** - Melihat perubahan status laporan
- ✅ **Profile Management** - Mengelola profil dan password

### 👮 Fitur untuk Petugas (Officer)

- ✅ **Dashboard Admin** - Melihat semua laporan dari seluruh warga dengan:
  - Statistics cards (Total, Menunggu, Diproses, Selesai)
  - Filter berdasarkan status
  - Tabel modern dengan photo thumbnails
- ✅ **Lihat Detail Laporan** - Akses ke semua detail laporan warga
- ✅ **Beri Tanggapan** - Memberikan tanggapan/komentar pada laporan dengan:
  - Form tanggapan yang sticky
  - Timeline view untuk history tanggapan
  - Avatar dan timestamp
- ✅ **Akses Multi-Laporan** - Dapat melihat dan menanggapi semua laporan

### 👨‍💼 Fitur untuk Admin

**Semua fitur Petugas, ditambah:**

- ✅ **Update Status Laporan** - Mengubah status laporan:
  - Menunggu → Diproses
  - Diproses → Selesai
  - Menunggu/Diproses → Ditolak
- ✅ **Manajemen Kategori** - CRUD kategori laporan (Infrastruktur, Kebersihan, Penerangan, dll)
- ✅ **Manajemen User** - CRUD pengguna dan pengaturan role
- ✅ **Full Control** - Akses penuh ke semua fitur sistem

### 🔐 Fitur Authentication & Authorization

- ✅ **Role-Based Access Control (RBAC)** - Tiga level akses (warga, petugas, admin)
- ✅ **Email Verification** - Verifikasi email saat registrasi
- ✅ **Password Reset** - Fitur lupa password dengan email
- ✅ **Password Confirmation** - Konfirmasi password untuk aksi sensitif
- ✅ **Session Management** - Manajemen sesi login yang aman
- ✅ **Middleware Protection** - Proteksi route berdasarkan role

### 🧪 Fitur Testing

- ✅ **138 Comprehensive Tests** - Coverage lengkap untuk semua fitur:
  - 43 Unit Tests (Models: User, Kategori, Laporan, Tanggapan)
  - 95 Feature Tests (Controllers, Middleware, Validation, Authorization)
- ✅ **Pest PHP Framework** - Testing framework modern dengan syntax yang clean
- ✅ **Database Testing** - RefreshDatabase untuk isolated testing
- ✅ **Factory & Seeders** - Data dummy untuk development dan testing

---

## 📸 Screenshots

### Landing Page
![Landing Page](docs/screenshots/landing-page.png)
> Modern minimalist landing page dengan glassmorphism navbar, hero section dengan Lottie animation, features section, dan categories showcase.

### Dashboard Warga
![Dashboard Warga](docs/screenshots/dashboard-warga.png)
> Dashboard dengan statistics cards, modern card layout untuk laporan, status badges dengan icons, dan responsive design.

### Form Create Laporan
![Form Create](docs/screenshots/form-create.png)
> Form modern dengan drag-and-drop upload, image preview, character counter, dan loading modal dengan Lottie animation.

### Detail Laporan
![Detail Laporan](docs/screenshots/detail-laporan.png)
> Detail view dengan info cards, large photo display, status badge, dan timeline tanggapan dari petugas.

### Dashboard Admin
![Dashboard Admin](docs/screenshots/dashboard-admin.png)
> Admin dashboard dengan statistics cards, filter options, modern table design dengan photo thumbnails dan status badges.

### Admin Detail & Update Status
![Admin Detail](docs/screenshots/admin-detail.png)
> Admin view dengan status update form, info cards, dan improved tanggapan section dengan sticky form.

**Note**: Untuk menambahkan screenshots, buat folder `docs/screenshots/` dan tambahkan gambar-gambar di atas.

---

## 💻 Tech Stack & Requirements

### System Requirements

- **PHP**: 8.2 atau lebih tinggi
- **Composer**: 2.x
- **Node.js**: 18.x atau lebih tinggi
- **NPM**: 9.x atau lebih tinggi
- **MySQL**: 8.0 atau lebih tinggi
- **Web Server**: Apache/Nginx (untuk production)

### PHP Extensions Required

- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

---

## 🚀 Installation Guide

### 1. Clone Repository

```bash
git clone https://github.com/el-pablos/platform-aduan-masyarakat.git
cd platform-aduan-masyarakat
```

### 2. Install Dependencies

**Install PHP dependencies dengan Composer:**
```bash
composer install
```

**Install Node.js dependencies dengan NPM:**
```bash
npm install
```

### 3. Environment Setup

**Copy file .env.example menjadi .env:**
```bash
cp .env.example .env
```

**Edit file .env dan sesuaikan konfigurasi database:**
```env
APP_NAME="Aplikasi Layanan Publik Digital"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lapor_publik
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@laporpublik.id"
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Database Setup

**Buat database MySQL:**
```sql
CREATE DATABASE lapor_publik CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Jalankan migrations:**
```bash
php artisan migrate
```

**Jalankan seeders untuk data awal:**
```bash
php artisan db:seed
```

Seeder akan membuat:
- 4 kategori default (Infrastruktur, Kebersihan, Penerangan Jalan, Lainnya)
- 1 admin user
- 2 petugas user
- 5 warga user
- 15 laporan dummy dengan tanggapan

### 6. Storage Link

**Buat symbolic link untuk storage:**
```bash
php artisan storage:link
```

### 7. Build Assets

**Untuk development:**
```bash
npm run dev
```

**Untuk production:**
```bash
npm run build
```

### 8. Run Development Server

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

### 9. Default Credentials untuk Testing

**Admin:**
- Email: `admin@laporpublik.id`
- Password: `password`

**Petugas:**
- Email: `petugas1@laporpublik.id`
- Password: `password`

**Warga:**
- Email: `warga1@laporpublik.id`
- Password: `password`

---

## 🗄️ Database Schema

### Tabel: users

| Column | Type | Description |
|--------|------|-------------|
| id | bigint (PK) | Primary key |
| name | varchar(255) | Nama lengkap user |
| email | varchar(255) | Email (unique) |
| email_verified_at | timestamp | Waktu verifikasi email |
| password | varchar(255) | Password (hashed) |
| role | enum | Role: 'warga', 'petugas', 'admin' |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |

### Tabel: kategoris

| Column | Type | Description |
|--------|------|-------------|
| id | bigint (PK) | Primary key |
| nama | varchar(255) | Nama kategori |
| slug | varchar(255) | Slug (unique) |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |

### Tabel: laporans

| Column | Type | Description |
|--------|------|-------------|
| id | bigint (PK) | Primary key |
| user_id | bigint (FK) | Foreign key ke users |
| kategori_id | bigint (FK) | Foreign key ke kategoris |
| judul | varchar(255) | Judul laporan (min: 5 chars) |
| isi_laporan | text | Isi/deskripsi laporan (min: 10 chars) |
| lokasi | varchar(255) | Lokasi kejadian (min: 5 chars) |
| foto_bukti | varchar(255) | Path foto bukti (nullable) |
| status | enum | Status: 'menunggu', 'diproses', 'selesai', 'ditolak' |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |

### Tabel: tanggapans

| Column | Type | Description |
|--------|------|-------------|
| id | bigint (PK) | Primary key |
| laporan_id | bigint (FK) | Foreign key ke laporans |
| user_id | bigint (FK) | Foreign key ke users (petugas/admin) |
| isi_tanggapan | text | Isi tanggapan (min: 10 chars) |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |

### Relationships

- **User** `hasMany` **Laporan** (1 user dapat membuat banyak laporan)
- **User** `hasMany` **Tanggapan** (1 petugas/admin dapat membuat banyak tanggapan)
- **Kategori** `hasMany` **Laporan** (1 kategori dapat memiliki banyak laporan)
- **Laporan** `belongsTo` **User** (1 laporan dimiliki oleh 1 user)
- **Laporan** `belongsTo` **Kategori** (1 laporan memiliki 1 kategori)
- **Laporan** `hasMany` **Tanggapan** (1 laporan dapat memiliki banyak tanggapan)
- **Tanggapan** `belongsTo` **Laporan** (1 tanggapan untuk 1 laporan)
- **Tanggapan** `belongsTo` **User** (1 tanggapan dibuat oleh 1 petugas/admin)

---

## 🧪 Testing

Aplikasi ini dilengkapi dengan **138 comprehensive tests** yang mencakup semua aspek fungsionalitas.

### Menjalankan Tests

**Jalankan semua tests:**
```bash
php artisan test
```

**Jalankan tests dengan coverage:**
```bash
php artisan test --coverage
```

**Jalankan hanya Unit tests:**
```bash
php artisan test --testsuite=Unit
```

**Jalankan hanya Feature tests:**
```bash
php artisan test --testsuite=Feature
```

**Jalankan test tertentu:**
```bash
php artisan test --filter=LaporanTest
```

### Test Coverage

**Unit Tests (43 tests):**
- `KategoriTest.php` - 8 tests untuk model Kategori
  - Attributes, relationships, factory, validation, cascade delete
- `LaporanTest.php` - 13 tests untuk model Laporan
  - Attributes, relationships, status, foto_bukti, factory, timestamps, cascade delete
- `TanggapanTest.php` - 7 tests untuk model Tanggapan
  - Attributes, relationships, factory, timestamps, delete
- `UserTest.php` - 14 tests untuk model User
  - Attributes, relationships, roles, password hashing, email unique, factory, cascade delete

**Feature Tests (95 tests):**
- `AdminDashboardTest.php` - 11 tests
  - Access control, filter by status, view laporan detail
- `LaporanCRUDTest.php` - 11 tests
  - Create, read, update, delete laporan dengan authorization
- `LaporanTest.php` - 8 tests
  - Laporan functionality, role-based access
- `LaporanValidationTest.php` - 10 tests
  - Validation rules untuk judul, isi_laporan, lokasi, kategori_id, foto_bukti
- `RoleBasedAccessTest.php` - 15 tests
  - RBAC untuk warga, petugas, admin
  - Dashboard routing, middleware protection
- `StatusUpdateTest.php` - 7 tests
  - Update status laporan (admin only)
  - Validation untuk status values
- `TanggapanTest.php` - 8 tests
  - Create tanggapan, validation, authorization
- `Auth Tests` - 24 tests (Laravel Breeze)
  - Authentication, registration, password reset, email verification
- `ProfileTest.php` - 5 tests
  - Profile management, password update, account deletion

### Test Factories

Aplikasi menggunakan factories untuk generate data dummy:
- `UserFactory` - Generate users dengan role
- `KategoriFactory` - Generate kategori dengan slug
- `LaporanFactory` - Generate laporan dengan status dan foto
- `TanggapanFactory` - Generate tanggapan dari petugas/admin

---

## 📖 Usage Guide

### Sebagai Warga (Citizen)

1. **Registrasi Akun**
   - Klik "Daftar" di halaman landing
   - Isi form registrasi (nama, email, password)
   - Verifikasi email (cek inbox)
   - Login dengan credentials

2. **Membuat Laporan**
   - Login dan masuk ke dashboard
   - Klik tombol "Buat Laporan Baru"
   - Isi form laporan:
     - Pilih kategori (Infrastruktur, Kebersihan, Penerangan Jalan, Lainnya)
     - Tulis judul laporan (minimal 5 karakter)
     - Tulis deskripsi detail (minimal 10 karakter)
     - Tulis lokasi kejadian (minimal 5 karakter)
     - Upload foto bukti (opsional, max 2MB, format: jpg, png, gif)
   - Klik "Kirim Laporan"

3. **Melihat Status Laporan**
   - Dashboard menampilkan semua laporan Anda
   - Status ditampilkan dengan badge berwarna:
     - 🟡 **Menunggu** - Laporan baru, belum ditangani
     - 🔵 **Diproses** - Sedang ditangani petugas
     - 🟢 **Selesai** - Masalah sudah diselesaikan
     - 🔴 **Ditolak** - Laporan ditolak dengan alasan

4. **Melihat Detail & Tanggapan**
   - Klik laporan untuk melihat detail
   - Lihat foto bukti, deskripsi lengkap
   - Lihat timeline tanggapan dari petugas
   - Lihat perubahan status

5. **Edit/Hapus Laporan**
   - Hanya laporan dengan status "Menunggu" yang bisa diedit/dihapus
   - Klik tombol "Edit" atau "Hapus" di detail laporan

### Sebagai Petugas (Officer)

1. **Login**
   - Login dengan akun petugas
   - Otomatis diarahkan ke Admin Dashboard

2. **Melihat Semua Laporan**
   - Dashboard menampilkan semua laporan dari warga
   - Statistics cards menampilkan jumlah laporan per status
   - Filter laporan berdasarkan status
   - Tabel modern dengan photo thumbnails

3. **Memberikan Tanggapan**
   - Klik laporan untuk melihat detail
   - Scroll ke bagian "Tanggapan"
   - Tulis tanggapan (minimal 10 karakter)
   - Klik "Kirim Tanggapan"
   - Tanggapan akan muncul di timeline

4. **Melihat History Tanggapan**
   - Semua tanggapan ditampilkan dalam timeline
   - Menampilkan nama petugas, waktu, dan isi tanggapan

### Sebagai Admin

**Semua fitur Petugas, ditambah:**

1. **Update Status Laporan**
   - Buka detail laporan
   - Pilih status baru dari dropdown:
     - Menunggu → Diproses
     - Diproses → Selesai
     - Menunggu/Diproses → Ditolak
   - Klik "Update Status"
   - Status akan berubah dan warga akan melihat perubahan

2. **Manajemen Kategori**
   - Akses menu "Kategori"
   - CRUD kategori laporan:
     - Create: Tambah kategori baru
     - Read: Lihat semua kategori
     - Update: Edit nama kategori
     - Delete: Hapus kategori (cascade delete laporans)

3. **Manajemen User**
   - Akses menu "Users"
   - CRUD users:
     - Create: Tambah user baru dengan role
     - Read: Lihat semua users
     - Update: Edit user data dan role
     - Delete: Hapus user (cascade delete laporans & tanggapans)

---

## 🛣️ API Routes

### Public Routes

| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/` | home | Landing page |
| GET | `/login` | login | Login page |
| POST | `/login` | - | Login process |
| GET | `/register` | register | Register page |
| POST | `/register` | - | Register process |
| POST | `/logout` | logout | Logout process |

### Warga Routes (Middleware: auth, verified, warga)

| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/dashboard` | laporan.index | Dashboard warga |
| GET | `/dashboard/create` | laporan.create | Form create laporan |
| POST | `/dashboard` | laporan.store | Store laporan |
| GET | `/dashboard/{laporan}` | laporan.show | Detail laporan |
| GET | `/dashboard/{laporan}/edit` | laporan.edit | Form edit laporan |
| PUT | `/dashboard/{laporan}` | laporan.update | Update laporan |
| DELETE | `/dashboard/{laporan}` | laporan.destroy | Delete laporan |

### Petugas/Admin Routes (Middleware: auth, petugas)

| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/admin/dashboard` | admin.dashboard | Admin dashboard |
| GET | `/admin/laporan/{laporan}` | admin.laporan.show | Detail laporan |
| POST | `/admin/laporan/{laporan}/tanggapan` | admin.tanggapan.store | Create tanggapan |

### Admin Only Routes (Middleware: auth, admin)

| Method | URI | Name | Description |
|--------|-----|------|-------------|
| PATCH | `/admin/laporan/{laporan}/status` | admin.laporan.updateStatus | Update status laporan |
| Resource | `/admin/users` | admin.users.* | CRUD users |
| Resource | `/admin/kategori` | admin.kategori.* | CRUD kategori |

---

## 🎨 Design System

Aplikasi ini menggunakan **Modern Minimalist Design** yang terinspirasi dari Notion dengan prinsip-prinsip berikut:

### Color Palette

**Neutral Colors (Base):**
- `neutral-50` - Background utama
- `neutral-100` - Background secondary
- `neutral-200` - Border, divider
- `neutral-300` - Border hover
- `neutral-400` - Disabled text
- `neutral-500` - Secondary text
- `neutral-600` - Primary text
- `neutral-700` - Heading text
- `neutral-800` - Dark text
- `neutral-900` - Darkest text

**Accent Colors:**
- `blue-500` to `blue-600` - Primary actions, links
- `indigo-500` to `indigo-600` - Secondary actions
- `green-500` - Success, status "selesai"
- `yellow-500` - Warning, status "menunggu"
- `red-500` - Danger, status "ditolak"
- `sky-500` - Info, status "diproses"

### Typography

**Font Family:**
- Primary: `Inter` (Google Fonts)
- Fallback: `system-ui, -apple-system, sans-serif`

**Font Sizes:**
- `text-xs` (12px) - Small labels, captions
- `text-sm` (14px) - Body text, form inputs
- `text-base` (16px) - Default body text
- `text-lg` (18px) - Large body text
- `text-xl` (20px) - Small headings
- `text-2xl` (24px) - Medium headings
- `text-3xl` (30px) - Large headings
- `text-4xl` (36px) - Hero headings

### Components

**Cards:**
- Border: `border border-neutral-200`
- Rounded: `rounded-xl` atau `rounded-2xl`
- Shadow: `shadow-sm` (default), `shadow-md` (hover)
- Padding: `p-6` atau `p-8`
- Background: `bg-white`

**Buttons:**
- Primary: `bg-gradient-to-r from-blue-500 to-indigo-600 text-white`
- Secondary: `bg-white border border-neutral-300 text-neutral-700`
- Danger: `bg-red-500 text-white`
- Rounded: `rounded-lg`
- Padding: `px-4 py-2` atau `px-6 py-3`
- Hover: `hover:shadow-lg hover:-translate-y-0.5`
- Transition: `transition-all duration-200`

**Badges:**
- Menunggu: `bg-yellow-100 text-yellow-800 border border-yellow-200`
- Diproses: `bg-sky-100 text-sky-800 border border-sky-200`
- Selesai: `bg-green-100 text-green-800 border border-green-200`
- Ditolak: `bg-red-100 text-red-800 border border-red-200`
- Rounded: `rounded-full`
- Padding: `px-3 py-1`
- Font: `text-xs font-medium`

**Forms:**
- Input: `border border-neutral-300 rounded-lg px-4 py-2`
- Focus: `focus:ring-2 focus:ring-blue-500 focus:border-blue-500`
- Label: `text-sm font-medium text-neutral-700`
- Error: `border-red-300 text-red-600`

**Glassmorphism:**
- Background: `bg-white/80` atau `bg-white/90`
- Backdrop: `backdrop-blur-md`
- Border: `border border-white/20`
- Shadow: `shadow-lg`

### Animations

**Transitions:**
- Default: `transition-all duration-200`
- Slow: `transition-all duration-300`
- Fast: `transition-all duration-150`

**Hover Effects:**
- Lift: `hover:-translate-y-1`
- Shadow: `hover:shadow-xl`
- Scale: `hover:scale-105`

**Loading:**
- Spinner: Lottie animation
- Skeleton: `animate-pulse bg-neutral-200`

---

## 💻 Development

### Development Server

**Jalankan Laravel development server:**
```bash
php artisan serve
```

**Jalankan Vite development server (hot reload):**
```bash
npm run dev
```

**Akses aplikasi:**
- Frontend: `http://localhost:8000`
- Vite HMR: `http://localhost:5173`

### Build untuk Production

**Build assets:**
```bash
npm run build
```

**Optimize autoloader:**
```bash
composer install --optimize-autoloader --no-dev
```

**Cache configuration:**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**Clear cache:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Coding Standards

**PHP:**
- Follow PSR-12 coding standard
- Use type hints untuk parameters dan return types
- Write docblocks untuk methods dan classes
- Use meaningful variable dan method names

**Blade:**
- Use components untuk reusable UI elements
- Keep views clean dan readable
- Avoid business logic di views
- Use `@auth`, `@guest`, `@can` directives untuk authorization

**JavaScript:**
- Use ES6+ syntax
- Use Alpine.js untuk interactivity
- Keep JavaScript minimal dan focused
- Use `defer` untuk script loading

**CSS:**
- Use Tailwind utility classes
- Avoid custom CSS jika memungkinkan
- Use `@apply` untuk repeated patterns
- Follow mobile-first approach

### Git Workflow

**Branch naming:**
- `feature/nama-fitur` - Fitur baru
- `bugfix/nama-bug` - Bug fix
- `hotfix/nama-hotfix` - Hotfix untuk production
- `refactor/nama-refactor` - Code refactoring

**Commit messages:**
- Use descriptive commit messages
- Format: `[Type] Short description`
- Types: `feat`, `fix`, `docs`, `style`, `refactor`, `test`, `chore`
- Example: `feat: Add drag-and-drop upload untuk foto bukti`

---

## 🔧 Troubleshooting

### Common Issues

**1. Error: "No application encryption key has been specified"**
```bash
php artisan key:generate
```

**2. Error: "SQLSTATE[HY000] [1049] Unknown database"**
- Pastikan database sudah dibuat di MySQL
- Cek konfigurasi `.env` untuk `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

**3. Error: "The stream or file could not be opened"**
```bash
chmod -R 775 storage bootstrap/cache
```

**4. Error: "Vite manifest not found"**
```bash
npm install
npm run build
```

**5. Error: "Class 'Storage' not found"**
```bash
php artisan storage:link
```

**6. Foto tidak muncul setelah upload**
```bash
php artisan storage:link
chmod -R 775 storage/app/public
```

**7. CSS tidak loading / tampilan berantakan**
- Clear browser cache (Ctrl+Shift+R atau Ctrl+F5)
- Rebuild assets: `npm run build`
- Clear Laravel cache: `php artisan cache:clear`

**8. Tests failing dengan "no such table" error**
- Pastikan menggunakan `RefreshDatabase` trait di test files
- Jalankan: `php artisan migrate --env=testing`

### FAQ

**Q: Bagaimana cara menambah kategori baru?**
A: Login sebagai admin, akses menu "Kategori", klik "Tambah Kategori Baru"

**Q: Apakah warga bisa menghapus laporan yang sudah diproses?**
A: Tidak, hanya laporan dengan status "Menunggu" yang bisa diedit/dihapus

**Q: Apakah petugas bisa mengubah status laporan?**
A: Tidak, hanya admin yang bisa mengubah status laporan

**Q: Bagaimana cara reset password?**
A: Klik "Lupa Password" di halaman login, masukkan email, cek inbox untuk link reset

**Q: Apakah bisa upload multiple foto?**
A: Saat ini hanya support 1 foto per laporan (max 2MB)

---

## 🤝 Contributing

Kontribusi sangat diterima! Jika Anda ingin berkontribusi pada project ini, silakan ikuti langkah-langkah berikut:

### How to Contribute

1. **Fork repository ini**
   - Klik tombol "Fork" di GitHub

2. **Clone fork Anda**
   ```bash
   git clone https://github.com/YOUR_USERNAME/platform-aduan-masyarakat.git
   cd platform-aduan-masyarakat
   ```

3. **Buat branch baru**
   ```bash
   git checkout -b feature/nama-fitur-anda
   ```

4. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

5. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

6. **Buat perubahan Anda**
   - Write clean, readable code
   - Follow coding standards
   - Add tests untuk fitur baru
   - Update documentation jika diperlukan

7. **Run tests**
   ```bash
   php artisan test
   ```

8. **Commit perubahan**
   ```bash
   git add .
   git commit -m "feat: Add nama fitur anda"
   ```

9. **Push ke fork Anda**
   ```bash
   git push origin feature/nama-fitur-anda
   ```

10. **Buat Pull Request**
    - Buka repository Anda di GitHub
    - Klik "New Pull Request"
    - Jelaskan perubahan yang Anda buat
    - Submit PR

### Contribution Guidelines

- **Code Quality**: Pastikan code Anda clean, readable, dan well-documented
- **Testing**: Tambahkan tests untuk fitur baru atau bug fixes
- **Documentation**: Update README.md jika menambah fitur baru
- **Commit Messages**: Gunakan commit messages yang descriptive
- **Code Style**: Follow PSR-12 untuk PHP, Tailwind best practices untuk CSS
- **No Breaking Changes**: Hindari breaking changes tanpa diskusi terlebih dahulu

### Code of Conduct

- Be respectful dan professional
- Welcome newcomers dan bantu mereka belajar
- Focus on constructive feedback
- Respect different viewpoints dan experiences
- Accept responsibility dan apologize untuk mistakes

### Reporting Bugs

Jika menemukan bug, silakan buat issue di GitHub dengan informasi:
- Deskripsi bug yang jelas
- Steps to reproduce
- Expected behavior vs actual behavior
- Screenshots (jika applicable)
- Environment info (PHP version, Laravel version, OS, browser)

### Suggesting Features

Untuk suggest fitur baru:
- Buat issue dengan label "enhancement"
- Jelaskan fitur yang diinginkan
- Jelaskan use case dan benefit
- Diskusikan dengan maintainers sebelum implement

---

## 📄 License

This project is licensed under the **MIT License**.

```
MIT License

Copyright (c) 2025 el-pablos

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 🙏 Credits & Acknowledgments

### Developer

**el-pablos**
- GitHub: [@el-pablos](https://github.com/el-pablos)
- Email: yeteprem.end23juni@gmail.com

### Technologies & Libraries

Terima kasih kepada semua open-source projects yang membuat aplikasi ini possible:

**Backend:**
- [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze) - Minimal authentication scaffolding
- [Pest PHP](https://pestphp.com) - Elegant PHP Testing Framework

**Frontend:**
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Alpine.js](https://alpinejs.dev) - Lightweight JavaScript framework
- [Lottie](https://lottiefiles.com) - Lightweight, scalable animations
- [Heroicons](https://heroicons.com) - Beautiful hand-crafted SVG icons

**Build Tools:**
- [Vite](https://vitejs.dev) - Next generation frontend tooling
- [PostCSS](https://postcss.org) - Tool for transforming CSS
- [Autoprefixer](https://github.com/postcss/autoprefixer) - Parse CSS and add vendor prefixes

**Database:**
- [MySQL](https://www.mysql.com) - Open-source relational database

**Development Tools:**
- [Composer](https://getcomposer.org) - Dependency Manager for PHP
- [NPM](https://www.npmjs.com) - Package manager for JavaScript

### Design Inspiration

- [Notion](https://notion.so) - Modern minimalist design inspiration
- [Linear](https://linear.app) - Clean UI/UX patterns
- [Vercel](https://vercel.com) - Modern web design aesthetics

### Special Thanks

- Laravel community untuk framework yang amazing
- Tailwind CSS team untuk utility-first CSS revolution
- Pest PHP team untuk testing framework yang elegant
- Semua contributors yang telah membantu improve project ini

---

## 📞 Contact

Jika Anda memiliki pertanyaan, saran, atau ingin berdiskusi tentang project ini:

**Developer:**
- **Name**: el-pablos
- **Email**: [yeteprem.end23juni@gmail.com](mailto:yeteprem.end23juni@gmail.com)
- **GitHub**: [@el-pablos](https://github.com/el-pablos)

**Repository:**
- **GitHub**: [platform-aduan-masyarakat](https://github.com/el-pablos/platform-aduan-masyarakat)
- **Issues**: [Report a bug or request a feature](https://github.com/el-pablos/platform-aduan-masyarakat/issues)
- **Pull Requests**: [Contribute to the project](https://github.com/el-pablos/platform-aduan-masyarakat/pulls)

---

## 🌟 Support

Jika project ini bermanfaat untuk Anda, silakan berikan ⭐ di GitHub!

**Share this project:**
- Twitter: Share dengan hashtag #LaporPublik #Laravel #TALL
- LinkedIn: Share untuk professional network
- Facebook: Share untuk komunitas developer

**Spread the word:**
- Blog tentang pengalaman menggunakan aplikasi ini
- Tutorial atau video walkthrough
- Recommend ke teman atau kolega

---

<div align="center">

**Made with ❤️ by [el-pablos](https://github.com/el-pablos)**

**Powered by Laravel 12 & TALL Stack**

---

© 2025 Aplikasi Layanan Publik Digital. All rights reserved.

</div>

