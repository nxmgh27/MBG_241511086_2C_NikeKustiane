<?= $this->extend('dashboard_gudang') ?>
<?= $this->section('content') ?>

<div class="container py-4">
  <h3 class="mb-4">Data Bahan Baku</h3>

  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari bahan baku...">

  <div class="card shadow-lg border-0">
    <div class="card-header d-flex justify-content-between align-items-center" style="background:#688A65; color:white;">
      <span><i class="fa fa-box me-2"></i> Daftar Bahan Baku</span>
      <a href="/bahan/create" class="btn btn-light btn-sm">
        <i class="fa fa-plus me-1"></i> Tambah Bahan
      </a>
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
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($bahan) > 0): ?>
              <?php $no=1; foreach($bahan as $b): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $b['nama'] ?></td>
                <td><?= $b['kategori'] ?></td>
                <td><?= $b['jumlah'] ?></td>
                <td><?= $b['satuan'] ?></td>
                <td><?= $b['tanggal_masuk'] ?></td>
                <td><?= $b['tanggal_kadaluarsa'] ?></td>
                <td>
                  <span class="badge 
                    <?= $b['status']=='tersedia' ? 'bg-success' : 
                        ($b['status']=='segera_kadaluarsa' ? 'bg-warning text-dark' : 'bg-danger') ?>">
                    <?= ucfirst($b['status']) ?>
                  </span>
                </td>
                <td>
                  <a href="/bahan/edit/<?= $b['id'] ?>" class="btn btn-sm btn-primary">
                    <i class="fa fa-edit"></i>
                  </a>
                  <a href="/bahan/delete/<?= $b['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="9" class="text-center">Belum ada data bahan baku</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
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

<?= $this->endSection() ?>
