<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require("function.php");

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Data Buku</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('wall.jpg'); background-size: cover;">

<div class="container p-4">
<h2>Tambah Data Buku</h2>
<a href="index.php" class="mb-3 d-block">Kembali</a>

<?php
if (isset($_POST['tombol_submit'])) {
    $res = tambah_buku($_POST);
    if ($res > 0) {
        echo "<script>alert('Buku berhasil ditambahkan!'); document.location.href = 'index.php';</script>";
    } elseif ($res === -1) {
        echo "<script>alert('Gagal upload gambar!');</script>";
    } else {
        echo "<script>alert('Buku gagal ditambahkan!');</script>";
    }
}
?>

<form action="" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label class="form-label fw-bold">Judul</label>
        <input type="text" class="form-control" name="judul" placeholder="Judul_buku" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Penulis</label>
        <input type="text" class="form-control" name="penulis" placeholder="Penulis" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Deskripsi</label>
        <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Kategori</label>
        <select name="id_kategori" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Gambar</label>
        <input type="file" class="form-control" name="gambar">
    </div>

    <button type="submit" name="tombol_submit" class="btn btn-primary">Simpan</button>
</form>
</div>
</body>
</html>
