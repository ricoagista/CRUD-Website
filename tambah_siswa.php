<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Siswa</h1>
        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
            <label>Nama:</label>
            <input type="text" name="nama" required>

            <label>Kelas:</label>
            <select name="kelas" required>
                <option value="">Pilih kelas</option>
                <option value="XI TKJ 1">XI TKJ 1</option>
                <option value="XI TKJ 2">XI TKJ 2</option>
                <option value="XI TKJ 3">XI TKJ 3</option>
                <option value="XI TKJ 4">XI TKJ 4</option>
                <option value="XI TKJ 5">XI TKJ 5</option>
                <option value="XI TKJ 6">XI TKJ 6</option>
            </select>

            <label>Nomor Presensi:</label>
            <select name="no_presensi" required>
                <option value="">Pilih nomor presensi</option>
                <?php for ($i = 1; $i <= 36; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>

            <label>Foto:</label>
            <input type="file" name="foto" accept="image/*" required>

            <div class="buttons">
                <button type="submit">Tambah Siswa</button>
                <button id="cancel-button" onclick="location.href='index.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
