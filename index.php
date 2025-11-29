<?php
require 'function.php'; 

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;

if ($keyword) {
    $buku = query("
        SELECT buku.*, kategori.nama_kategori 
        FROM buku 
        LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
        WHERE 
            buku.id_buku LIKE '%$keyword%' OR
            buku.judul_buku LIKE '%$keyword%' OR
            buku.penulis LIKE '%$keyword%' OR
            buku.deskripsi LIKE '%$keyword%' OR
            kategori.nama_kategori LIKE '%$keyword%'
        ORDER BY buku.tanggal_input DESC
    ");
} else {
    $buku = query("
        SELECT buku.*, kategori.nama_kategori 
        FROM buku 
        LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
        ORDER BY buku.tanggal_input DESC
    ");
}

?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Uji_Kopetensi</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="dist/css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media='all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.min.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div class="app-wrapper">
    
    <!-- Header -->
    <nav class="app-header navbar navbar-expand bg-body">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i></a>
          </li>
          <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
        </ul>

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button"><i class="bi bi-search"></i></a>
         <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img src="dist/assets/img/profil.jpg"
                  class="user-image rounded-circle shadow" alt="User Image" />
                <span class="d-none d-md-inline">Dea Nursifa</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <li class="user-header text-bg-primary">
                  <img src="dist/assets/img/profil.jpg"
                    class="rounded-circle shadow" alt="User Image" />
                  <p>
                    Dea Nursifa - UI/UX
                    <small>Member Naquinity since August 2024</small>
                  </p>
                </li>
              </li>
              <li class="user-footer">
                <a href="logout.php" class="btn btn-default btn-flat float-end">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <div class="sidebar-brand">
        <a href="index.php" class="brand-link">
          <img src="dist/assets/img/AdminLTELogo.png" alt="Logo" class="brand-image opacity-75 shadow" />
          <span class="brand-text fw-light">SIMBS</span>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" id="navigation">
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Data Master <i class="nav-arrow bi bi-chevron-right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php" class="nav-link active"><i class="nav-icon bi bi-circle"></i><p>Data Buku</p></a>
                </li>
                <li class="nav-item">
                  <a href="halaman_kategori.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Data Kategori</p></a>
                </li>
              </ul>
            </li>
            <li class="nav-header">AUTENTIKASI</li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link"><i class="nav-icon bi bi-box-arrow-right"></i><p>LOGOUT</p></a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-3">Data Buku</h3>
              <a href="tambah_buku.php"><button class="btn-sm btn btn-primary">Tambah Buku</button></a>
            </div>
            <div class="col-sm-6 d-flex flex-column align-items-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Buku</li>
              </ol>
              <form class="mt-2">
                <div class="input-group">
                  <input type="text" class="form-control" name="keyword" placeholder="Cari buku..." />
                  <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

<div class="app-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <table class="table table-striped table-hover">
          <tr>
            <th>No.</th>
            <th>ID Buku</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Tanggal Input</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>

          <?php $no = 1; foreach ($buku as $b): ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $b['id_buku']; ?></td>
            <td><?= htmlspecialchars($b['judul_buku']); ?></td>
            <td><?= htmlspecialchars($b['penulis']); ?></td>
            <td><?= htmlspecialchars($b['deskripsi']); ?></td>
            <td><?= htmlspecialchars($b['nama_kategori']); ?></td>
            <td><?= $b['tanggal_input']; ?></td>
            
            <td>
              <?php if (!empty($b['gambar'])): ?>
                <img src="dist/assets/img/<?= htmlspecialchars($b['gambar']); ?>" width="80" alt="gambar">
              <?php else: ?>
                <span>-</span>
              <?php endif; ?>
            </td>

            <td>
              <a href="ubah_buku.php?id=<?= $b['id_buku']; ?>" class="btn btn-success btn-sm">Edit</a>
              <a href="hapus_buku.php?id=<?= $b['id_buku']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</div>

    
    <footer class="app-footer">
      <div class="float-end d-none d-sm-inline">(SIMBS) Sistem Informasi Manajemen Buku Sederhana</div>
      <strong> Copyright &copy; 2025&nbsp;</strong>
    </footer>
  </div>

  <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
</body>
</html>