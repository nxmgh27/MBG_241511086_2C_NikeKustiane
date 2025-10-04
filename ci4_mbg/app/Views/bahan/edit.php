<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Bahan Baku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body style="background:#DDDFC2;">
<div class="container py-4">
  <h3 class="mb-4">Edit Bahan Baku</h3>

  <div class="card shadow-lg border-0">
    <div class="card-header" style="background:#688A65; color:#fff;">
      Form Edit Bahan
    </div>
    <div class="card-body bg-white">
      <form action="/bahan/update/<?= $bahan['id'] ?>" method="post">
        <div class="mb-3">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" value="<?= $bahan['nama'] ?>" required>
        </div>
        <div class="mb-3">
          <label>Kategori</label>
          <input type="text" name="kategori" class="form-control" value="<?= $bahan['kategori'] ?>" required>
        </div>
        <div class="mb-3">
          <label>Jumlah / Stok</label>
          <input type="number" name="jumlah" class="form-control" value="<?= $bahan['jumlah'] ?>" required min="0">
        </div>
        <div class="mb-3">
          <label>Satuan</label>
          <input type="text" name="satuan" class="form-control" value="<?= $bahan['satuan'] ?>" required>
        </div>
        <div class="mb-3">
          <label>Tanggal Masuk</label>
          <input type="date" name="tanggal_masuk" class="form-control" value="<?= $bahan['tanggal_masuk'] ?>" required>
        </div>
        <div class="mb-3">
          <label>Tanggal Kadaluarsa</label>
          <input type="date" name="tanggal_kadaluarsa" class="form-control" value="<?= $bahan['tanggal_kadaluarsa'] ?>" required>
        </div>
        <div class="d-flex justify-content-end">
          <a href="/bahan" class="btn btn-secondary me-2">Kembali</a>
          <button type="submit" class="btn btn-success"><i class="fa fa-save me-1"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
