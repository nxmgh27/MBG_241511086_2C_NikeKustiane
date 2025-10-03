<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

  <div class="container">
    <h2>Halo, <?= session()->get('username') ?> 👋</h2>
    <p>Selamat datang di Dashboard.</p>
    <a href="<?= base_url('/logout') ?>" class="btn btn-danger">Logout</a>
  </div>

</body>
</html>
