<?php
// Panggil file koneksi.php
require_once 'koneksi.php';

// Ambil data dari form tambah siswa
$nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['nama']));
$kelas = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['kelas']));
$no_presensi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['no_presensi']));

// Validasi input
if (empty($nama) || empty($kelas) || empty($no_presensi)) {
    die("Harap lengkapi semua kolom");
}

// Proses unggah foto
$target_dir = "uploads/";
$unique_file_name = uniqid() . "_" . basename($_FILES["foto"]["name"]);
$target_file = $target_dir . $unique_file_name;

if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    die("Gagal mengunggah file");
}

// Validasi file yang diunggah
$image_type = exif_imagetype($target_file);
$allowed_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);

if (!in_array($image_type, $allowed_types)) {
    unlink($target_file); // hapus file yang diunggah karena bukan gambar
    die("File yang diunggah harus berupa gambar (JPEG, PNG, GIF)");
}

// Proses tambah data siswa ke database
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$stmt = $koneksi->prepare("INSERT INTO tabel_siswa (nama, kelas, no_presensi, foto) VALUES (?, ?, ?, ?)");

if (!$stmt) {
    die("Error: " . $koneksi->error);
}

$stmt->bind_param("ssss", $nama, $kelas, $no_presensi, $unique_file_name);

if ($stmt->execute()) {
    header('Location: index.php');
} else {
    echo "Error: " . $stmt->error;
}

// Tutup koneksi database
$stmt->close();
$koneksi->close();
?>
