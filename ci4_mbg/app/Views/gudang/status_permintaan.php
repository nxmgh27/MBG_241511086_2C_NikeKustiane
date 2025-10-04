<?= $this->extend('dashboard_gudang') ?>
<?= $this->section('content') ?>

<div class="container py-4">
  <h3 class="mb-4"><i class="fa fa-clipboard-list me-2"></i> Status Permintaan Bahan</h3>

  <div class="card shadow-lg border-0">
    <div class="card-header text-white" style="background: #1C2D2A;">
      <strong>Daftar Permintaan</strong>
    </div>
    <div class="card-body bg-white">
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead style="background: #1C2D2A; color:#DDDFC2;">
            <tr>
              <th>No</th>
              <th>Menu Makan</th>
              <th>Jumlah Porsi</th>
              <th>Tanggal Masak</th>
              <th>Status</th>
              <th>Dibuat Pada</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($permintaan) && is_array($permintaan)): ?>
              <?php $no=1; foreach($permintaan as $p): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= esc($p['menu_makan']) ?></td>
                  <td><?= esc($p['jumlah_porsi']) ?></td>
                  <td><?= esc($p['tgl_masak']) ?></td>
                  <td>
                    <?php if ($p['status'] == 'menunggu'): ?>
                      <span class="badge bg-warning text-dark">Menunggu</span>
                    <?php elseif ($p['status'] == 'disetujui'): ?>
                      <span class="badge bg-success">Disetujui</span>
                    <?php else: ?>
                      <span class="badge bg-danger">Ditolak</span>
                    <?php endif; ?>
                  </td>
                  <td><?= esc($p['created_at']) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center">Belum ada permintaan</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<style>
  .table-hover tbody tr:hover {
    background-color: #f0f5ec !important; 
  }
  .badge {
    font-size: 0.85rem;
    padding: 0.4em 0.7em;
  }
</style>

<?= $this->endSection() ?>
