<?= $this->extend('dashboard_gudang') ?>
<?= $this->section('content') ?>

<div class="container py-4">
  <h3 class="mb-4"><i class="fa fa-box me-2"></i> Data Bahan Baku</h3>

  <!-- Flashdata Alert -->
  <?php if(session()->getFlashdata('success')): ?>
    <div id="flash-success" class="alert alert-success alert-dismissible fade show auto-close" role="alert">
      <?= session()->getFlashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if(session()->getFlashdata('error')): ?>
    <div id="flash-error" class="alert alert-danger alert-dismissible fade show auto-close" role="alert">
      <?= session()->getFlashdata('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- Search bar -->
  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari bahan baku...">

  <!-- Card -->
  <div class="card shadow-lg border-0">
    <div class="card-header d-flex justify-content-between align-items-center" 
         style="background:#1C2D2A; color:#FFFFFF;">
      <strong>Daftar Bahan Baku</strong>
      <a href="/bahan/create" class="btn btn-light btn-sm">
        <i class="fa fa-plus me-1"></i> Tambah Bahan
      </a>
    </div>
    <div class="card-body bg-white">
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle" id="bahanTable">
          <thead style="background:#97AC82; color:#FFFFFF;">
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
                  <button 
                    class="btn btn-sm btn-danger btn-hapus" 
                    data-id="<?= $b['id'] ?>" 
                    data-nama="<?= $b['nama'] ?>" 
                    data-status="<?= $b['status'] ?>" 
                    data-jumlah="<?= $b['jumlah'] ?>" 
                    data-satuan="<?= $b['satuan'] ?>"
                    <?= $b['status'] != 'kadaluarsa' ? 'disabled' : '' ?>
                  >
                    <i class="fa fa-trash"></i>
                  </button>
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

<!-- Modal Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formHapus" method="post">
        <?= csrf_field() ?>
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title"><i class="fa fa-trash"></i> Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="infoBahan" class="mb-3"></p>
          <div id="alertTidakBisa" class="alert alert-warning d-none">
            Bahan ini tidak dapat dihapus karena statusnya bukan <b>Kadaluarsa</b>.
          </div>
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
// Search filter
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
const btnConfirmHapus = document.getElementById('btnConfirmHapus');
const alertTidakBisa = document.getElementById('alertTidakBisa');

document.querySelectorAll('.btn-hapus').forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    const id = btn.dataset.id;
    const nama = btn.dataset.nama;
    const status = btn.dataset.status;
    const jumlah = btn.dataset.jumlah;
    const satuan = btn.dataset.satuan;

    infoBahan.innerHTML = `
      Apakah Anda yakin ingin menghapus <b>${nama}</b>? <br>
      Jumlah: ${jumlah} ${satuan} <br>
      Status: <span class="badge ${status === 'kadaluarsa' ? 'bg-danger' : 'bg-secondary'}">${status}</span>
    `;

    formHapus.action = "/bahan/delete/" + id;

    if(status !== 'kadaluarsa'){
      btnConfirmHapus.disabled = true;
      alertTidakBisa.classList.remove('d-none');
    } else {
      btnConfirmHapus.disabled = false;
      alertTidakBisa.classList.add('d-none');
    }

    hapusModal.show();
  });
});

// Flashdata auto-close 3 detik
document.addEventListener('DOMContentLoaded', function() {
  const AUTO_CLOSE_MS = 3000;
  document.querySelectorAll('.alert.auto-close').forEach(alertEl => {
    setTimeout(() => {
      if (!document.body.contains(alertEl)) return;
      try {
        const bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
        bsAlert.close();
      } catch (err) {
        alertEl.remove();
      }
    }, AUTO_CLOSE_MS);
  });
});
</script>

<style>
  .table-hover tbody tr:hover {
    background-color: #f0f5ec !important;
  }
  .badge {
    font-size: 0.85rem;
    padding: 0.35em 0.6em;
  }
</style>

<?= $this->endSection() ?>
