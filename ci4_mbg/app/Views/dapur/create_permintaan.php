<?= $this->extend('dashboard_dapur') ?>
<?= $this->section('content') ?>

<div class="container py-4">
  <h3 class="mb-4">Buat Permintaan Bahan</h3>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <form action="<?= base_url('/dapur/store') ?>" method="post">
    <div class="mb-3">
      <label class="form-label">Tanggal Masak</label>
      <input type="date" name="tgl_masak" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Menu yang Akan Dibuat</label>
      <input type="text" name="menu_makan" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jumlah Porsi</label>
      <input type="number" name="jumlah_porsi" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Daftar Bahan Baku:</label>

      <table class="table table-bordered" id="bahan-table">
        <thead>
          <tr class="table-secondary">
            <th style="width:5%">No</th>
            <th>Nama Bahan Baku</th>
            <th style="width:20%">Jumlah</th>
            <th style="width:10%">Aksi</th>
          </tr>
        </thead>
        <tbody id="bahan-container">
          <tr>
            <td class="text-center">1</td>
            <td>
              <select name="bahan_id[]" class="form-select" required>
                <option value="">-- Pilih Bahan --</option>
                <?php foreach ($bahan as $b): ?>
                  <option value="<?= $b['id'] ?>"><?= esc($b['nama']) ?></option>
                <?php endforeach; ?>
              </select>
            </td>
            <td><input type="number" name="jumlah_diminta[]" class="form-control" placeholder="Jumlah" required></td>
            <td class="text-center">
              <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
            </td>
          </tr>
        </tbody>
      </table>

      <button type="button" class="btn btn-secondary btn-sm" id="addBahan">+ Tambah Baris</button>
    </div>

    <button type="submit" class="btn btn-success">Kirim Permintaan</button>
  </form>
</div>

<script>
document.getElementById('addBahan').addEventListener('click', function() {
  const container = document.getElementById('bahan-container');
  const rowCount = container.querySelectorAll('tr').length + 1;

  const newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td class="text-center">${rowCount}</td>
    <td>
      <select name="bahan_id[]" class="form-select" required>
        <option value="">-- Pilih Bahan --</option>
        <?php foreach ($bahan as $b): ?>
          <option value="<?= $b['id'] ?>"><?= esc($b['nama']) ?></option>
        <?php endforeach; ?>
      </select>
    </td>
    <td><input type="number" name="jumlah_diminta[]" class="form-control" placeholder="Jumlah" required></td>
    <td class="text-center">
      <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
    </td>
  `;
  container.appendChild(newRow);
  updateRowNumbers();
});

document.addEventListener('click', function(e) {
  if (e.target.classList.contains('remove-row')) {
    e.target.closest('tr').remove();
    updateRowNumbers();
  }
});

function updateRowNumbers() {
  const rows = document.querySelectorAll('#bahan-container tr');
  rows.forEach((row, index) => {
    row.querySelector('td:first-child').textContent = index + 1;
  });
}
</script>

<?= $this->endSection() ?>
