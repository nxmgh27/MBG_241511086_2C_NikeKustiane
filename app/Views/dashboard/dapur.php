<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Dapur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MBG - Dapur</a>
        <div class="d-flex">
        <span class="navbar-text me-3">Halo, <?= session('name') ?></span>
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
    </nav>

    <div class="container mt-4">
    <div class="alert alert-primary">Selamat datang di Dashboard Dapur 🍳</div>
    </div>
</body>
</html>
