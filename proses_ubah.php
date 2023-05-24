<?php
// Memulai koneksi ke database
require_once 'koneksi.php';

// Mengambil data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$no_presensi = $_POST['no_presensi'];

// Mengecek apakah ada file foto yang diupload
if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
    // Mengambil nama file dan direktori sementara
    $filename = $_FILES['foto']['name'];
    $tempname = $_FILES['foto']['tmp_name'];

    // Menghapus foto lama
    $query = "SELECT foto FROM tabel_siswa WHERE id=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $foto_lama = $data['foto'];
    unlink('uploads/'.$foto_lama);

    // Memindahkan file foto dari direktori sementara ke direktori yang ditentukan
    move_uploaded_file($tempname, 'uploads/'.$filename);

    // Menyimpan nama file ke database
    $query = "UPDATE tabel_siswa SET nama=?, kelas=?, no_presensi=?, foto=? WHERE id=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ssssi", $nama, $kelas, $no_presensi, $filename, $id);
} else {
    // Jika tidak ada file foto yang diupload, hanya update data siswa tanpa mengubah foto
    $query = "UPDATE tabel_siswa SET nama=?, kelas=?, no_presensi=? WHERE id=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssi", $nama, $kelas, $no_presensi, $id);
}

// Menjalankan query untuk mengupdate data siswa
if ($stmt->execute()) {
    header('Location: index.php');
} else {
    echo "Error: " . $stmt->error;
}

// Menutup koneksi ke database
$stmt->close();
$koneksi->close();
?>
