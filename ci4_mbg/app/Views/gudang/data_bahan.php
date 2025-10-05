<?= $this->extend('dashboard_dapur') ?>
<?= $this->section('content') ?>

<div class="container py-4">
  <h3 class="mb-4"><i class="fa fa-box me-2"></i> Data Bahan Baku </h3>

  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari bahan baku...">

  <div class="card shadow-lg border-0">
    <div class="card-header" style="background:#1C2D2A; color:white;">
      <strong>Daftar Bahan Baku di Gudang</strong>
    </div>
    <div class="card-body bg-white">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle" id="bahanTable">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Satuan</th>
              <th>Tgl Masuk</th>
              <th>Tgl Kadaluarsa</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($bahan) > 0): ?>
              <?php $no=1; foreach($bahan as $b): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($b['nama']) ?></td>
                <td><?= esc($b['kategori']) ?></td>
                <td><?= esc($b['jumlah']) ?></td>
                <td><?= esc($b['satuan']) ?></td>
                <td><?= esc($b['tanggal_masuk']) ?></td>
                <td><?= esc($b['tanggal_kadaluarsa']) ?></td>
                <td>
                  <?php
                    $status = $b['status'];
                    $badge = 'bg-secondary';
                    $text = '';
                    if ($status == 'tersedia') $badge='bg-success';
                    elseif ($status == 'segera_kadaluarsa') { $badge='bg-warning'; $text='text-dark'; }
                    elseif ($status == 'kadaluarsa') $badge='bg-danger';
                    elseif ($status == 'habis') $badge='bg-secondary';
                  ?>
                  <span class="badge <?= $badge ?> <?= $text ?>"><?= ucfirst(str_replace('_',' ',$status)) ?></span>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="8" class="text-center">Belum ada data bahan baku</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
// Pencarian bahan
const searchInput = document.getElementById('searchInput');
const table = document.getElementById('bahanTable').getElementsByTagName('tbody')[0];
searchInput.addEventListener('keyup', function() {
  const filter = searchInput.value.toLowerCase();
  Array.from(table.rows).forEach(row => {
    const nama = row.cells[1].textContent.toLowerCase();
    row.style.display = nama.includes(filter) ? '' : 'none';
  });
});
</script>

<style>
.table-hover tbody tr:hover { background-color: #f0f5ec !important; }
.badge { font-size: 0.85rem; padding: 0.4em 0.7em; }
</style>

<?= $this->endSection() ?>
