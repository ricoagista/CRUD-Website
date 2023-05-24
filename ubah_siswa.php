<!DOCTYPE html>
<html>
<head>
	<title>Ubah Siswa</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">
		<h1>Ubah Siswa</h1>
		<?php
			// Memulai koneksi ke database
			include 'koneksi.php';

			// Mengambil id siswa dari parameter URL
			$id = $_GET['id'];

			// Query untuk mengambil data siswa berdasarkan id
			$query = "SELECT * FROM tabel_siswa WHERE id='$id'";
			$result = mysqli_query($koneksi, $query);

			// Mengubah data menjadi bentuk array
			$data = mysqli_fetch_array($result);
		?>
		<form action="proses_ubah.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
			<label>Nama:</label>
			<input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>

			<label>Kelas:</label>
			<select name="kelas" required>
				<option value="">Pilih kelas</option>
				<option value="XI TKJ 1" <?php if($data['kelas'] == 'XI TKJ 1') echo 'selected'; ?>>XI TKJ 1</option>
				<option value="XI TKJ 2" <?php if($data['kelas'] == 'XI TKJ 2') echo 'selected'; ?>>XI TKJ 2</option>
				<option value="XI TKJ 3" <?php if($data['kelas'] == 'XI TKJ 3') echo 'selected'; ?>>XI TKJ 3</option>
				<option value="XI TKJ 4" <?php if($data['kelas'] == 'XI TKJ 4') echo 'selected'; ?>>XI TKJ 4</option>
				<option value="XI TKJ 5" <?php if($data['kelas'] == 'XI TKJ 5') echo 'selected'; ?>>XI TKJ 5</option>
				<option value="XI TKJ 6" <?php if($data['kelas'] == 'XI TKJ 6') echo 'selected'; ?>>XI TKJ 6</option>
			</select>

			<label>Nomor Presensi:</label>
			<select name="no_presensi" required>
				<option value="">Pilih nomor presensi</option>
				<?php
					for ($i = 1; $i <= 36; $i++) {
						echo '<option value="'.$i.'"';
						if ($data['no_presensi'] == $i) {
							echo ' selected';
						}
						echo '>'.$i.'</option>';
					}
				?>
			</select>

			<label>Foto:</label>
			<?php
				if ($data['foto']) {
				  echo '<img src="uploads/'.$data['foto'].'" class="siswa-img">';
				} else {
				  echo 'Tidak ada foto';
				}
			?>
			<input type="file" name="foto" accept="image/*">

			<div class="buttons">
				<button type="submit">Ubah Siswa</button>
				<button id="cancel-button" onclick="location.href='index.php'">Cancel</button>
			</div>
		</form>
	</div>
</body>
</html>
