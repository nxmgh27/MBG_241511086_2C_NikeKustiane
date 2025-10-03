<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Gudang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MBG - Gudang</a>
    <div class="d-flex">
      <span class="navbar-text me-3">Halo, <?= session('name') ?></span>
      <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h2 class="mb-3">Dashboard Gudang</h2>
  <a href="<?= base_url('bahanbaku/create') ?>" class="btn btn-primary mb-3">+ Tambah Bahan Baku</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Jumlah</th>
        <th>Satuan</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Kadaluarsa</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($bahanBaku)): ?>
        <?php foreach ($bahanBaku as $b): ?>
          <tr>
            <td><?= esc($b['nama']) ?></td>
            <td><?= esc($b['kategori']) ?></td>
            <td><?= esc($b['jumlah']) ?></td>
            <td><?= esc($b['satuan']) ?></td>
            <td><?= esc($b['tanggal_masuk']) ?></td>
            <td><?= esc($b['tanggal_kadaluarsa']) ?></td>
            <td><?= esc($b['status']) ?></td>
          </tr>
        <?php endforeach ?>
      <?php else: ?>
        <tr>
          <td colspan="7" class="text-center">Belum ada data</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
</body>
</html>
