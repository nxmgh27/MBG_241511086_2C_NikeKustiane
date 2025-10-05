<?= $this->extend('dashboard_gudang') ?>
<?= $this->section('content') ?>

<div class="container py-4">
  <h3 class="mb-4"><i class="fa fa-box me-2"></i> Data Bahan Baku</a></h3>

  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show auto-close" role="alert">
      <?= session()->getFlashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari bahan baku...">

  <div class="card shadow-lg border-0">
    <div class="card-header d-flex justify-content-between align-items-center" style="background:#1C2D2A; color:white;">
      <strong>Daftar Bahan Baku</strong>
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
                <td>
                  <a href="/bahan/edit/<?= $b['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                  <button class="btn btn-sm btn-danger btn-hapus" data-id="<?= $b['id'] ?>" data-nama="<?= esc($b['nama']) ?>"><i class="fa fa-trash"></i></button>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formHapus" method="post">
        <?= csrf_field() ?>
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title"><i class="fa fa-trash"></i> Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p id="infoBahan"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger" id="btnConfirmHapus">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Search bahan
const searchInput = document.getElementById('searchInput');
const table = document.getElementById('bahanTable').getElementsByTagName('tbody')[0];
searchInput.addEventListener('keyup', function() {
  const filter = searchInput.value.toLowerCase();
  Array.from(table.rows).forEach(row => {
    const nama = row.cells[1].textContent.toLowerCase();
    row.style.display = nama.includes(filter) ? '' : 'none';
  });
});

// Modal hapus
const hapusModal = new bootstrap.Modal(document.getElementById('hapusModal'));
const formHapus = document.getElementById('formHapus');
const infoBahan = document.getElementById('infoBahan');

document.querySelectorAll('.btn-hapus').forEach(btn => {
  btn.addEventListener('click', () => {
    const id = btn.dataset.id;
    const nama = btn.dataset.nama;
    infoBahan.innerHTML = `Apakah Anda yakin ingin menghapus <b>${nama}</b>?`;
    formHapus.action = "/bahan/delete/" + id;
    hapusModal.show();
  });
});

// Flashdata auto-close
document.addEventListener('DOMContentLoaded', function() {
  setTimeout(() => {
    document.querySelectorAll('.alert.auto-close').forEach(el => {
      try { bootstrap.Alert.getOrCreateInstance(el).close(); } catch(e){ el.remove(); }
    });
  }, 3000);
});
</script>

<style>
.table-hover tbody tr:hover { background-color: #f0f5ec !important; }
.badge { font-size: 0.85rem; padding: 0.4em 0.7em; }
</style>

<?= $this->endSection() ?>
