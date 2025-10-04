<?= $this->extend('dashboard_gudang') ?>
<?= $this->section('content') ?>

<div class="container py-4">
  <h3 class="mb-4">Tambah Bahan Baku</h3>

  <div class="card shadow-lg border-0">
    <div class="card-body">
      <form action="/bahan/store" method="post">
        <div class="mb-3">
          <label>Nama Bahan</label>
          <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Kategori</label>
          <input type="text" name="kategori" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Jumlah</label>
          <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Satuan</label>
          <input type="text" name="satuan" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tanggal Masuk</label>
          <input type="date" name="tanggal_masuk" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tanggal Kadaluarsa</label>
          <input type="date" name="tanggal_kadaluarsa" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/bahan" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
