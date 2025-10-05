<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= esc($title ?? 'Status Permintaan Bahan') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body { background-color: #DDDFC2; }
    .sidebar {
      width: 220px;
      height: 100vh;
      position: fixed;
      top: 0; left: 0;
      background: #1C2D2A;
      color: #fff;
      padding: 20px 0;
    }
    .sidebar a {
      display: block;
      padding: 10px 20px;
      color: #DDDFC2;
      text-decoration: none;
    }
    .sidebar a:hover,
    .sidebar .active {
      background: #97AC82;
      color: #1C2D2A;
    }
    .content {
      margin-left: 220px;
      padding: 20px;
    }
    .topbar {
      background: #97AC82;
      padding: 10px 20px;
      border-radius: 8px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #2C341B;
      margin-bottom: 20px;
    }
    .table-container {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .btn-tambah {
      background-color: #97AC82;
      color: #1C2D2A;
      font-weight: 600;
    }
    .btn-tambah:hover {
      background-color: #859a72;
      color: #fff;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-center mb-4">
      <i class="fa fa-utensils me-2"></i> Dapur - MBG
    </h4>
    <a href="/dashboard/dapur" class="<?= url_is('dashboard/dapur') ? 'active' : '' ?>">
      <i class="fa fa-home me-2"></i> Dashboard</a>
    <a href="/dapur/status_permintaan" class="<?= url_is('dapur/status_permintaan') ? 'active' : '' ?>">
      <i class="fa fa-clipboard-list me-2"></i> Status Permintaan</a>
    <a href="/dapur/create_permintaan" class="<?= url_is('dapur/create_permintaan') ? 'active' : '' ?>">
      <i class="fa fa-plus-circle me-2"></i> Buat Permintaan</a>
    <a href="/dapur/data_bahan" class="<?= url_is('dapur/data_bahan') ? 'active' : '' ?>">
      <i class="fa fa-box me-2"></i> Lihat Data Bahan</a>
    <a href="/logout"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
  </div>

  <!-- Content -->
  <div class="content">
    <div class="topbar">
      <h5><i class="fa fa-clipboard-list me-2"></i> Status Permintaan Bahan</h5>
      <div>
        <span class="me-3"><?= session()->get('name'); ?> (<?= session()->get('role'); ?>)</span>
        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" width="35" class="rounded-circle">
      </div>
    </div>

    <div class="table-container">
      <div class="d-flex justify-content-end mb-3">
        </a>
      </div>

      <?php if (!empty($permintaan)): ?>
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-dark text-center">
            <tr>
              <th>No</th>
              <th>Tanggal Masak</th>
              <th>Menu Makan</th>
              <th>Jumlah Porsi</th>
              <th>Status</th>
              <th>Dibuat</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($permintaan as $p): ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= esc($p['tgl_masak']) ?></td>
                <td><?= esc($p['menu_makan']) ?></td>
                <td class="text-center"><?= esc($p['jumlah_porsi']) ?></td>
                <td class="text-center">
                  <?php if ($p['status'] === 'menunggu'): ?>
                    <span class="badge bg-warning text-dark">Menunggu</span>
                  <?php elseif ($p['status'] === 'disetujui'): ?>
                    <span class="badge bg-success">Disetujui</span>
                  <?php elseif ($p['status'] === 'ditolak'): ?>
                    <span class="badge bg-danger">Ditolak</span>
                  <?php else: ?>
                    <span class="badge bg-secondary"><?= esc($p['status']) ?></span>
                  <?php endif; ?>
                </td>
                <td><?= esc($p['created_at']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="alert alert-info text-center">Belum ada data permintaan.</div>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>
