# CodeIgniter 4 RBAC Boilerplate

![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.6.3-orange)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.0-purple)
![License](https://img.shields.io/badge/License-MIT-green)

## Deskripsi Produk

Ini adalah **boilerplate aplikasi web** yang dibangun menggunakan **CodeIgniter 4**, framework PHP yang ringan dan cepat. Produk ini dirancang khusus untuk mempermudah mahasiswa dalam menyelesaikan tugas akhir mereka, sehingga mereka bisa fokus pada pengembangan fitur inti, bukan pada konfigurasi dasar.

## 🚀 Fitur-fitur Utama

### 1. **Arsitektur Modern dengan Struktur Folder yang Lebih Rapi**
- CodeIgniter 4 menggunakan struktur folder yang lebih terorganisir
- Semua kode aplikasi berada di dalam folder `app/`
- File statis (CSS, JS, gambar) dipindahkan ke folder `public/`
- Membuat aplikasi lebih aman dan alur kerja pengembang jadi lebih jelas

### 2. **Autentikasi Pengguna yang Kuat dan Fleksibel**
Boilerplate ini sudah dilengkapi dengan sistem autentikasi yang aman dan siap pakai:

- ✅ **Login & Registrasi**: Fungsi dasar untuk pendaftaran akun dan login sudah tersedia
- ✅ **Proteksi Halaman**: Menggunakan Filters untuk melindungi routes atau controller tertentu
- ✅ **Session Management**: Mengelola sesi pengguna dengan cara yang aman dan efisien
- ✅ **Role-Based Access Control (RBAC)**: Sistem role admin dan user

### 3. **Database Migration dan Seeding**
Fitur unggulan dari CI4 yang membantu dalam pengemban database:

- ✅ **Migrations**: Membuat dan mengubah struktur tabel database
- ✅ **Seeders**: Mengisi data awal (sample data) ke dalam tabel
- ✅ **CLI Commands**: Menjalankan perintah dengan `php spark`

### 4. **CRUD (Create, Read, Update, Delete) Data Mahasiswa**
- ✅ Modul CRUD lengkap sebagai contoh implementasi
- ✅ Menggunakan Model bawaan CI4 untuk berinteraksi dengan database
- ✅ Validasi data terintegrasi
- ✅ Flash messages untuk feedback user

### 5. **Desain Responsif dengan Bootstrap 5**
- ✅ Terintegrasi dengan Bootstrap 5
- ✅ Desain yang bersih, modern, dan responsif
- ✅ View layouts untuk elemen yang bisa dipakai ulang
- ✅ Font Awesome icons
- ✅ Dashboard yang informatif

### 6. **Tools Pengembangan yang Lengkap**
- ✅ **Debugging Toolbar**: Toolbar bawaan CI4 untuk debugging
- ✅ **Spark Commands**: Server lokal dengan `php spark serve`
- ✅ **Error Handling**: Penanganan error yang baik
- ✅ **Development Environment**: Konfigurasi mudah untuk development

## 🛠️ Instalasi

### Prasyarat
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL/MariaDB
- Web server (Apache/Nginx) atau gunakan built-in server

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/muhammad-seman/codeigniter4_RBAC_boilerplate.git
   cd codeigniter4_RBAC_boilerplate
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Konfigurasi environment**
   ```bash
   cp env .env
   ```
   
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```
   database.default.hostname = localhost
   database.default.database = nama_database
   database.default.username = username_db
   database.default.password = password_db
   database.default.DBDriver = MySQLi
   ```

4. **Buat database dan jalankan migrations**
   ```bash
   php spark migrate
   ```

5. **Jalankan seeders untuk data contoh**
   ```bash
   php spark db:seed UserSeeder
   php spark db:seed MahasiswaSeeder
   ```

6. **Jalankan server**
   ```bash
   php spark serve
   ```

7. **Akses aplikasi**
   Buka browser dan akses: `http://localhost:8080`

## 👤 Akun Demo

### Admin
- **Username**: `admin`
- **Password**: `admin123`

### User
- **Username**: `user1`
- **Password**: `user123`

## 📁 Struktur Proyek

```
app/
├── Controllers/        # Controller files
│   ├── AuthController.php
│   ├── MahasiswaController.php
│   └── Home.php
├── Models/            # Model files
│   ├── UserModel.php
│   └── MahasiswaModel.php
├── Views/             # View files
│   ├── layouts/
│   ├── auth/
│   ├── mahasiswa/
│   └── dashboard.php
├── Database/
│   ├── Migrations/    # Database migrations
│   └── Seeds/         # Database seeders
├── Filters/           # Custom filters
│   └── AuthFilter.php
└── Config/            # Configuration files
    ├── Routes.php
    └── Filters.php
```

## 🎯 Fitur yang Tersedia

### Autentikasi & Autorisasi
- [x] Login dan Logout
- [x] Registrasi user baru
- [x] Session management
- [x] Role-based access control
- [x] Password hashing

### Dashboard
- [x] Overview statistik
- [x] Data mahasiswa terbaru
- [x] Informasi sistem

### Manajemen Mahasiswa
- [x] Tambah data mahasiswa
- [x] Lihat daftar mahasiswa
- [x] Edit data mahasiswa
- [x] Hapus data mahasiswa
- [x] Validasi form

## 🚀 Development Commands

```bash
# Menjalankan server development
php spark serve

# Membuat migration baru
php spark make:migration CreateTableName

# Menjalankan migrations
php spark migrate

# Rollback migrations
php spark migrate:rollback

# Membuat seeder
php spark make:seeder SeederName

# Menjalankan seeder
php spark db:seed SeederName

# Membuat controller
php spark make:controller ControllerName

# Membuat model
php spark make:model ModelName

# Membuat filter
php spark make:filter FilterName
```

## 🎨 Kustomisasi

### Menambah Role Baru
1. Update enum di migration `users` table
2. Tambahkan kondisi di `AuthFilter.php`
3. Update validasi di `UserModel.php`

### Menambah Modul CRUD Baru
1. Buat migration untuk tabel baru
2. Buat model dengan validation rules
3. Buat controller dengan method CRUD
4. Buat views untuk UI
5. Tambahkan routes di `Config/Routes.php`

## 📝 Database Schema

### Users Table
```sql
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- username (VARCHAR 100, UNIQUE)
- email (VARCHAR 100, UNIQUE)
- password (VARCHAR 255)
- role (ENUM: 'admin', 'user')
- created_at (DATETIME)
- updated_at (DATETIME)
```

### Mahasiswa Table
```sql
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- nim (VARCHAR 20, UNIQUE)
- nama (VARCHAR 100)
- email (VARCHAR 100)
- jurusan (VARCHAR 100)
- angkatan (YEAR)
- created_at (DATETIME)
- updated_at (DATETIME)
```

## 🔒 Security Features

- ✅ Password hashing dengan PHP `password_hash()`
- ✅ Session-based authentication
- ✅ CSRF protection (dapat diaktifkan)
- ✅ Input validation dan sanitization
- ✅ SQL injection protection melalui Query Builder
- ✅ XSS protection dengan `esc()` helper

## 🤝 Kontribusi

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.

## 📞 Support

Jika Anda mengalami masalah atau memiliki pertanyaan:

- 📧 Email: [muhammad-seman@example.com]
- 🐛 Issues: [GitHub Issues](https://github.com/muhammad-seman/codeigniter4_RBAC_boilerplate/issues)

## 🙏 Acknowledgments

- [CodeIgniter 4](https://codeigniter.com/) - The PHP framework
- [Bootstrap 5](https://getbootstrap.com/) - CSS framework
- [Font Awesome](https://fontawesome.com/) - Icons
- Komunitas CodeIgniter Indonesia

---

**Happy Coding! 🚀**

> Dibuat dengan ❤️ untuk membantu mahasiswa menyelesaikan tugas akhir mereka dengan lebih mudah dan efisien.