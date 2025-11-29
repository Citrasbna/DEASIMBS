<?php 
include "config/koneksi.php";

$q = mysqli_query($koneksi, $sql);
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Buku</h3>
        <div class="card-tools">
            <a href="buku_tambah.php" class="btn btn-primary btn-sm">Tambah Buku</a>
        </div>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tanggal Input</th>
                <th>Aksi</th>
            </tr>

            <?php while ($d = mysqli_fetch_assoc($q)) { ?>
            <tr>
                <td><?= $d['id_buku'] ?></td>
                <td><?= $d['judul'] ?></td>
                <td><?= $d['penulis'] ?></td>
                <td><?= $d['nama_kategori'] ?></td>
                <td><?= $d['tanggal_input'] ?></td>
                <td>
                    <a href="buku_edit.php?id=<?= $d['id_buku'] ?>" class="btn btn-sm btn-success">Edit</a>
                    <a href="buku_hapus.php?id=<?= $d['id_buku'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>
</div>

<?php 
session_start();
require 'functions.php';

$buku = query("
    SELECT buku.*, kategori.nama_kategori 
    FROM buku 
    LEFT JOIN kategori ON buku.kategori = kategori.id_kategori
    ORDER BY tanggal_input DESC
");

if (isset($_POST['search'])) {
    $buku = cari_buku($_POST['keyword']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link rel="stylesheet" href="dist/assets/style.css"> 
</head>
<body>

<h2> Data Buku</h2>

<a href="buku_tambah.php" style="padding:6px; background:blue; color:white; text-decoration:none;">Tambah Buku</a>

<form action="" method="POST">
    <input type="text" name="keyword" placeholder="Cari buku..." autofocus autocomplete="off">
    <button type="submit" name="search">Cari</button>
</form>

<
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Kategori</th>
        <th>Gambar</th>
        <th>Tanggal Input</th>
        <th>Aksi</th>
    </tr>

    <?php $i = 1; ?>
    <?php foreach ($buku as $row): ?>
    <tr>
        <td><?= $i++; ?></td>
        <td><?= $row['judul_buku']; ?></td>
        <td><?= $row['penulis']; ?></td>
        <td><?= $row['nama_kategori'] ? $row['nama_kategori'] : 'Tidak ada kategori'; ?></td>
        <td>
            <?php if (!empty($row['gambar'])): ?>
                <img src="dist/assets/img/<?= $row['gambar']; ?>" width="50">
            <?php else: ?>
                -
            <?php endif; ?>
        </td>
        <td><?= $row['tanggal_input']; ?></td>
        <td>
            <a href="buku_edit.php?id=<?= $row['id_buku']; ?>" style="color:green;">Edit</a> | 
            <a href="buku_hapus.php?id=<?= $row['id_buku']; ?>" onclick="return confirm('Yakin hapus data?');" style="color:red;">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
