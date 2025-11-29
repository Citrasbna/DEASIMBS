<?php
require 'function.php';
session_start();

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$kat = query("SELECT * FROM kategori WHERE id_kategori = $id");
if (empty($kat)) { 
    header("Location: halaman_kategori.php"); 
    exit; 
}
$kat = $kat[0];

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST['id_kategori'] = $id; 
    if (ubah_kategori($_POST) > 0) {
        header("Location: halaman_kategori.php"); 
        exit;
    } else {
        $msg = 'Tidak ada perubahan atau gagal';
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ubah Kategori</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <div class="card p-4">

    <h3 class="mb-3">Ubah Kategori</h3>

    <?php if ($msg): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="hidden" name="id_kategori" value="<?= $kat['id_kategori'] ?>">

      <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" 
               value="<?= htmlspecialchars($kat['nama_kategori']) ?>" required>
      </div>

      <button class="btn btn-primary">Simpan</button>
      <a href="halaman_kategori.php" class="btn btn-secondary">Batal</a>

    </form>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
