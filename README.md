# PPKPT - Sistem Pelaporan Kasus
**Pusat Pengaduan Kekerasan, Pelecehan, dan Tindak Pidana**  
*Politeknik Negeri Jember*

![PHP](https://img.shields.io/badge/PHP-7.4+-purple)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange)
![Tailwind](https://img.shields.io/badge/Tailwind-CSS-06B6D4)
![License](https://img.shields.io/badge/License-MIT-green)

---

## Tentang
Aplikasi web untuk mengelola laporan pengaduan kasus di lingkungan Polije.  
Memudahkan pelaporan online dan monitoring oleh admin.

---

## Fitur Utama

### Pelapor
- Kirim laporan dengan data lengkap
- Upload bukti pendukung

### Admin
- **Dashboard statistik** real-time
- **Kelola laporan**: Lihat, Edit status, Tambah catatan, Hapus
- **Mode gelap/terang** (Dark/Light mode)
- **Responsive** untuk mobile

---

## Teknologi
- **Backend:** PHP Native + PDO
- **Database:** MySQL
- **Frontend:** Tailwind CSS + JavaScript

---

## 📁 Struktur Folder
```
PPKPT/
├── admin/
│   ├── dashboard/         # Halaman utama admin
│   ├── Pengaturan/        # Pengaturan sistem
│   └── Pengguna/          # Manajemen pengguna
├── auth/                  # Login
├── config/                # Koneksi database
├── laporan/               # Proses tambah/edit/hapus laporan
├── index.php              # Halaman utama
└── test.php
```

---

## 🗄️ Database

**Tabel: `laporan`**

| Kolom | Tipe | Ket |
|-------|------|-----|
| id | INT | Primary Key |
| nama | VARCHAR(100) | Nama pelapor |
| nim | VARCHAR(20) | NIM (opsional) |
| nik | VARCHAR(20) | NIK (opsional) |
| hp | VARCHAR(20) | No telepon |
| email | VARCHAR(100) | Email |
| tkp | VARCHAR(200) | Tempat kejadian |
| bukti | VARCHAR(200) | File bukti |
| tanggal | DATETIME | Tgl kejadian |
| kronologi | TEXT | Kronologi |
| created_at | TIMESTAMP | Tgl laporan masuk |
| status | VARCHAR(20) | Pending / Diproses / Selesai |
| catatan_admin | TEXT | Catatan dari admin |

**Default:** `status = 'Pending'`, `created_at = CURRENT_TIMESTAMP`

---

## 🚀 Instalasi

### 1. Clone
```bash
git clone https://github.com/PrasetyoHerwibowo/PPKPT.git
cd PPKPT
```

### 2. Buat Database
```sql
CREATE DATABASE ppkpt;
USE ppkpt;

CREATE TABLE laporan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(20),
    nik VARCHAR(20),
    hp VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    tkp VARCHAR(200) NOT NULL,
    bukti VARCHAR(200),
    tanggal DATETIME NOT NULL,
    kronologi TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'Pending',
    catatan_admin TEXT
);
```

### 3. Konfigurasi Koneksi
Edit `config/connection.php`:
```php
<?php
$host = 'localhost';
$dbname = 'ppkpt';
$user = 'root';
$pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $pdo;
?>
```

### 4. Jalankan
- Letakkan di `htdocs` (XAMPP) atau `www` (WAMP)
- Akses: `http://localhost/PPKPT`

---

## 📖 Cara Pakai

### Admin
1. Buka `http://localhost/PPKPT/admin/dashboard/`
2. Login (default: admin/admin)
3. Kelola laporan via tabel:
   - **Detail** → Lihat info lengkap
   - **Edit** → Update status + catatan
   - **Hapus** → Hapus laporan

### Tambah Laporan
- Klik **Tambah** di dashboard
- Isi form → Simpan

---

## 🔌 API

### Tambah Laporan
```
POST /laporan/proses_laporan.php
Body: {nama, nim, nik, hp, email, tkp, bukti, tanggal, kronologi}
```

### Update Status
```
POST /laporan/update_status.php
Body: {id, status, catatan_admin}
```

### Hapus Laporan
```
GET /laporan/delete_laporan.php?id={id}
```

---

## 👥 Kontribusi
1. Fork repo
2. Buat branch baru: `git checkout -b fitur-anda`
3. Commit: `git commit -m "feat: tambah fitur"`
4. Push: `git push origin fitur-anda`
5. Buat Pull Request

---

## 📄 Lisensi
MIT License © 2024 Prasetyo Herwibowo

---

## 📞 Kontak
- GitHub: [@PrasetyoHerwibowo](https://github.com/PrasetyoHerwibowo)
- Issues: [https://github.com/PrasetyoHerwibowo/PPKPT/issues](https://github.com/PrasetyoHerwibowo/PPKPT/issues)

---

**⭐ Jangan lupa kasih star ya!**
```
