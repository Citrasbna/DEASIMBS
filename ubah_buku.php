<?php
require 'function.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "<script>alert('ID buku tidak ditemukan!'); document.location.href='index.php';</script>";
    exit;
}

$id = $_GET['id'];
$buku = query("SELECT * FROM buku WHERE id_buku = '$id'")[0];
$kategori = query("SELECT * FROM kategori");

if (isset($_POST['tombol_submit'])) {
    $_POST['id_buku'] = $id;
    $_POST['tanggal_input'] = date("Y-m-d H:i:s");

    if (ubah_buku($_POST) > 0) {
        echo "<script>alert('Data buku berhasil diubah!'); document.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data buku!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ubah Data Buku</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="p-4 container">
    <h1 class="mb-3">Ubah Data Buku</h1>
    <a href="index.php" class="mb-3 d-block">Kembali</a>

    <form action="" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label fw-bold">Judul Buku</label>
            <input type="text" class="form-control" name="judul_buku" value="<?= htmlspecialchars($buku['judul_buku']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Penulis</label>
            <input type="text" class="form-control" name="penulis" value="<?= htmlspecialchars($buku['penulis']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Deskripsi</label>
            <textarea class="form-control" name="deskripsi"><?= htmlspecialchars($buku['deskripsi']); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori']; ?>" <?= $k['id_kategori']==$buku['id_kategori']?'selected':'' ?>>
                        <?= htmlspecialchars($k['nama_kategori']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Gambar Saat Ini</label><br>
            <?php if (!empty($buku['gambar'])): ?>
                <img src="dist/assets/img/<?= htmlspecialchars($buku['gambar']); ?>" width="150">
            <?php else: ?>
                <p>Tidak ada gambar</p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Ganti Gambar (opsional)</label>
            <input type="file" class="form-control" name="gambar">
        </div>

        <button type="submit" name="tombol_submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
