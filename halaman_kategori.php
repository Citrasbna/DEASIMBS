<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require("function.php");

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Kategori - SIMBAS</title>
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
  <h3>Data Kategori</h3>
  <a href="tambah_kategori.php" class="btn btn-primary mb-3">Tambah Kategori</a>

  <table class="table table-striped">
    <tr>
        <th>No.</th>
        <th>Nama Kategori</th>
        <th>Tanggal Input</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; foreach($kategori as $k): ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($k['nama_kategori']); ?></td>
        <td><?= htmlspecialchars($k['tanggal_input'] ?? '-'); ?></td>
        <td>
          <a href="ubah_kategori.php?id=<?= $k['id_kategori']; ?>" class="btn btn-sm btn-success">Edit</a>
          <a href="hapus_kategori.php?id=<?= $k['id_kategori']; ?>" onclick="return confirm('Hapus kategori?');" class="btn btn-sm btn-danger">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>

    <?php if(empty($kategori)): ?>
      <tr>
        <td colspan="4" class="text-center">Belum ada kategori</td>
      </tr>
    <?php endif; ?>
  </table>
</div>
  </table>
</div>
</body>
</html>
