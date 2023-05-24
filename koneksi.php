<?php
// Konfigurasi koneksi ke database
define('DB_HOST', 'localhost'); // nama host database
define('DB_USER', 'root'); // username untuk koneksi ke database
define('DB_PASS', ''); // password untuk koneksi ke database
define('DB_NAME', 'data_siswa'); // nama database yang digunakan

// Membuat koneksi ke database
$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Mengecek koneksi ke database
if (mysqli_connect_errno()) {
    die("Koneksi gagal: " . mysqli_connect_error()); // jika gagal, maka tampilkan pesan error dan hentikan program
}
?>
