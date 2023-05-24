<?php
    // Panggil file koneksi.php
    require_once('koneksi.php');

    // Validasi parameter id
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Proses hapus data siswa dari database
        $sql = "DELETE FROM tabel_siswa WHERE id=$id";
        if (mysqli_query($koneksi, $sql)) {
            header('Location: index.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } else {
        // Jika parameter id tidak valid, tampilkan pesan error atau redirect ke halaman lain
        echo "Parameter id tidak valid";
		header("Location: halaman_error.php");
	}

    // Tutup koneksi database
    mysqli_close($koneksi);
?>
