<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Bahan Baku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body style="background:#DDDFC2;">
<div class="container py-4">
  <h3 class="mb-4">Tambah Bahan Baku</h3>

  <div class="card shadow-lg border-0">
    <div class="card-header" style="background:#688A65; color:#fff;">
      <i class="fa fa-plus me-2"></i> Form Input Bahan Baku
    </div>
    <div class="card-body bg-white">
      <form action="/bahan/simpan" method="post">
        <div class="mb-3">
          <label class="form-label">Nama Bahan</label>
          <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select name="kategori" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Bahan Pokok">Karbohidrat</option>
            <option value="Bahan Segar">Protein Hewani</option>
            <option value="Bahan Lain">Protein Nabati</option>
            <option value="Bahan Lain">Sayuran</option>
            <option value="Bahan Lain">Buah</option>
          </select>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" min="1" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Kadaluarsa</label>
            <input type="date" name="tanggal_kadaluarsa" class="form-control" required>
          </div>
        </div>
        <div class="d-flex justify-content-end">
          <a href="/bahan" class="btn btn-secondary me-2">
            <i class="fa fa-arrow-left me-1"></i> Kembali
          </a>
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save me-1"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
