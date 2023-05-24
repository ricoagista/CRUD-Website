<?php
include 'koneksi.php';
$siswa = mysqli_query($koneksi, "SELECT * FROM tabel_siswa");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Siswa</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <h1>Data Siswa</h1>
  <div class="buttons">
    <a href="tambah_siswa.php" class="button tambah">Tambah Siswa</a>
  </div>
  <?php if(mysqli_num_rows($siswa) > 0): ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>No. Presensi</th>
        <th>Foto</th>
        <th>Aksi</th>
      </tr>

      <?php 
      $no = 1;
      while($data = mysqli_fetch_array($siswa)): 
      ?>
        <tr>
          <td><?php echo $data['id']; ?></td>
          <td><?php echo $data['nama']; ?></td>
          <td><?php echo $data['kelas']; ?></td>
          <td><?php echo $data['no_presensi']; ?></td>
          <td>
            <?php if($data['foto']): ?>
              <img src="uploads/<?php echo $data['foto']; ?>" alt="Foto" class="siswa-img">
            <?php else: ?>
              <span>Tidak ada foto</span>
            <?php endif; ?>
          </td>
          <td>
            <a href="ubah_siswa.php?id=<?php echo $data['id']; ?>" class="button ubah">Ubah</a>
            <a href="proses_hapus.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="button hapus">Hapus</a>
          </td>
        </tr>
        <?php 
        $no++;
      endwhile; 
      ?>
    </table>
  <?php else: ?>
    <p>Tidak ada data siswa</p>
  <?php endif; ?>
</body>
</html>
