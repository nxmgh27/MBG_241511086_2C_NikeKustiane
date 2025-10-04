<?= $this->extend('dashboard_gudang') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <h3 class="mb-4"><i class="fa fa-clipboard-list me-2"></i> Status Permintaan Bahan</h3>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show auto-close" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

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
                            <th>Tanggal Masak</th>
                            <th>Menu</th>
                            <th>Jumlah Porsi</th>
                            <th>Bahan & Jumlah Diminta</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($permintaan)): ?>
                            <?php $no = 1; foreach($permintaan as $p): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($p['tgl_masak']) ?></td>
                                    <td><?= esc($p['menu_makan']) ?></td>
                                    <td><?= esc($p['jumlah_porsi']) ?></td>
                                    <td>
                                        <?php foreach($p['detail'] as $d): ?>
                                            <?= esc($d['bahan_nama']) ?> (<?= esc($d['jumlah_diminta']) ?>)<br>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <?php if($p['status'] == 'menunggu'): ?>
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        <?php elseif($p['status'] == 'disetujui'): ?>
                                            <span class="badge bg-success">Disetujui</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Ditolak</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($p['status']=='menunggu'): ?>
                                            <a href="/gudang/approve/<?= $p['id'] ?>" class="btn btn-sm btn-success"
                                               onclick="return confirm('Yakin ingin menyetujui permintaan ini?')">Setuju</a>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#tolakModal<?= $p['id'] ?>">Tolak</button>

                                            <!-- Modal Tolak -->
                                            <div class="modal fade" id="tolakModal<?= $p['id'] ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <form action="/gudang/reject/<?= $p['id'] ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title">Tolak Permintaan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label>Alasan Penolakan:</label>
                                                                <textarea name="alasan" class="form-control" required></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Belum ada permintaan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        document.querySelectorAll('.alert.auto-close').forEach(el => {
            try { bootstrap.Alert.getOrCreateInstance(el).close(); } catch(e){ el.remove(); }
        });
    }, 3000);
});
</script>

<?= $this->endSection() ?>
