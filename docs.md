## 1\. Dokumentasi Proyek: Aplikasi Layanan Publik (LaporCepat)

### Deskripsi Proyek

  * **Nama Proyek:** LaporCepat (atau nama sejenis)
  * **Deskripsi:** Platform berbasis web yang memungkinkan warga melaporkan masalah publik (jalan rusak, sampah, dll.) dan memantau tindak lanjut dari instansi terkait.
  * **Tujuan:** Transparansi, akuntabilitas, dan efisiensi penanganan masalah publik.

### Tech Stack

  * **Backend:** Laravel (versi terbaru)
  * **Database:** MySQL
  * **Frontend:** Laravel Blade dengan Tailwind CSS
  * **Auth:** Laravel Breeze (untuk scaffolding login & register)
  * **Testing:** Pest / PHPUnit (bawaan Laravel)

### Model Database & Migrations

Ini adalah jantung aplikasinya. Kita butuh 4 tabel utama:

**1. `users` (Tabel bawaan Laravel, dimodifikasi)**

  * `id` (Primary Key)
  * `name` (String) - Nama warga/petugas
  * `email` (String, Unique)
  * `password` (String)
  * `role` (Enum: 'warga', 'petugas', 'admin') - **PENTING** untuk hak akses.
  * `remember_token`, `timestamps`

**2. `kategoris` (Tabel Kategori Laporan)**

  * `id` (Primary Key)
  * `nama` (String) - Contoh: "Jalan Rusak", "Sampah Menumpuk", "Penerangan Jalan"
  * `slug` (String, Unique)
  * `timestamps`

**3. `laporans` (Tabel Laporan/Pengaduan)**

  * `id` (Primary Key)
  * `user_id` (Foreign Key ke `users.id`) - Siapa yang melapor.
  * `kategori_id` (Foreign Key ke `kategoris.id`) - Jenis laporannya.
  * `judul` (String) - Judul singkat laporan.
  * `isi_laporan` (Text) - Deskripsi detail masalah.
  * `lokasi` (String) - Alamat atau deskripsi lokasi.
  * `foto_bukti` (String, Nullable) - Path/nama file gambar yang di-upload.
  * `status` (Enum: 'menunggu', 'diproses', 'selesai', 'ditolak') - Default: 'menunggu'.
  * `timestamps`

**4. `tanggapans` (Tabel Tanggapan dari Petugas)**

  * `id` (Primary Key)
  * `laporan_id` (Foreign Key ke `laporans.id`) - Menanggapi laporan mana.
  * `user_id` (Foreign Key ke `users.id`) - Petugas yang menanggapi.
  * `isi_tanggapan` (Text) - Isi balasan/tanggapan.
  * `timestamps`

### Relasi Model (Eloquent)

  * `User` **hasMany** `Laporan`
  * `User` (Petugas) **hasMany** `Tanggapan`
  * `Kategori` **hasMany** `Laporan`
  * `Laporan` **belongsTo** `User`
  * `Laporan` **belongsTo** `Kategori`
  * `Laporan` **hasMany** `Tanggapan`
  * `Tanggapan` **belongsTo** `Laporan`
  * `Tanggapan` **belongsTo** `User`

### Hak Akses & Peran (Authorization)

Sistem ini punya 3 level pengguna:

1.  **Warga (`role` = 'warga')**

      * Bisa registrasi dan login.
      * Bisa membuat `Laporan` baru (CRUD Laporan *miliknya sendiri*).
      * Hanya bisa melihat `Laporan` miliknya sendiri di dashboard-nya.
      * Bisa melihat `Tanggapan` di laporannya.
      * *Tidak bisa* mengakses dashboard admin.

2.  **Petugas (`role` = 'petugas')**

      * Tidak bisa registrasi (akun dibuat oleh Admin).
      * Bisa login.
      * Bisa melihat *semua* `Laporan` yang masuk (terutama yang 'menunggu').
      * Bisa membuat `Tanggapan` untuk sebuah `Laporan`.
      * Bisa mengubah `status` sebuah `Laporan` (misal dari 'menunggu' ke 'diproses').

3.  **Admin (`role` = 'admin')**

      * Hak penuh (Super Admin).
      * Bisa melakukan semua yang 'petugas' lakukan.
      * Bisa mengelola (CRUD) akun `User` (termasuk membuat akun 'petugas').
      * Bisa mengelola (CRUD) data `Kategori` laporan.

### Alur Fitur Utama (User Stories)

1.  **Auth:**

      * Warga mendaftar akun baru.
      * Semua user (warga, petugas, admin) bisa login.
      * User yang login diarahkan ke dashboard yang sesuai (Warga ke `dashboard`, Petugas/Admin ke `admin.dashboard`).

2.  **Warga: Membuat Laporan**

      * Di dashboard-nya, Warga klik "Buat Laporan Baru".
      * Muncul form: Judul, Kategori (Dropdown), Lokasi, Isi Laporan, Upload Foto.
      * Validasi: Semua field wajib diisi, foto harus gambar (jpg/png).
      * Setelah submit, laporan dibuat dengan status 'menunggu'.

3.  **Petugas/Admin: Menanggapi Laporan**

      * Di dashboard admin, ada tabel berisi semua laporan masuk.
      * Petugas klik 'Detail' pada laporan yang statusnya 'menunggu'.
      * Di halaman detail, terlihat semua info laporan + foto.
      * Ada form untuk "Beri Tanggapan" DAN "Ubah Status".
      * Petugas mengisi tanggapan (misal: "Siap, tim meluncur.") dan mengubah status jadi 'diproses'.
      * Tanggapan tersimpan di tabel `tanggapans`.

4.  **Warga: Memantau Laporan**

      * Warga melihat di dashboard-nya, status laporannya sudah berubah jadi 'diproses'.
      * Warga bisa mengklik laporannya dan melihat `Tanggapan` dari petugas.

### Kebutuhan Testing (Unit & Feature)

Untuk memastikan aplikasi berjalan baik:

  * **Unit Test:**

      * Test relasi antar model (misal: `User` benar punya `hasMany` `Laporan`).
      * Test *scope* atau *attribute* khusus jika ada.

  * **Feature Test (Paling Penting):**

      * `test_warga_can_register_an_account`
      * `test_petugas_cannot_register_an_account`
      * `test_unauthenticated_user_cannot_access_dashboard`
      * `test_warga_can_create_laporan_with_valid_data`
      * `test_warga_cannot_create_laporan_with_invalid_data`

  * `test_warga_cannot_see_other_peoples_laporan`

      * `test_warga_is_redirected_from_admin_dashboard`
      * `test_petugas_can_access_admin_dashboard`
      * `test_petugas_can_view_all_laporan`
      * `test_petugas_can_update_laporan_status`
      * `test_petugas_can_post_tanggapan`
      * `test_admin_can_create_petugas_account`
      * `test_admin_can_manage_kategori`