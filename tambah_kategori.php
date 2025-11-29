<?php 
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require("function.php");

if (isset($_POST['tombol_submit'])) {
    if (tambah_kategori($_POST) > 0) {
        echo "<script>
                alert('Data kategori berhasil ditambahkan ke database!');
                document.location.href = 'tambah_kategori.php';
              </script>";
    } else {
        echo "<script>
                alert('Data kategori gagal ditambahkan ke database!');
                document.location.href = 'tambah_kategori.php';
              </script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tambah Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1 class="mb-3">Tambah Data Kategori</h1>
    <a href="halaman_kategori.php" class="mb-3 d-block">Kembali</a>

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label fw-bold">Nama Kategori</label>
            <input type="text" class="form-control" name="nama_kategori" placeholder="Nama Kategori" autocomplete="off" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi kategori"></textarea>
        </div>
        <button type="submit" name="tombol_submit" class="btn btn-primary">Simpan</button>
        <a href="halaman_kategori.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
