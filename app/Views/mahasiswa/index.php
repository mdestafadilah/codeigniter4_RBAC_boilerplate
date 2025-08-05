<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-users me-2"></i>Data Mahasiswa</h2>
        <a href="<?= base_url('/mahasiswa/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Mahasiswa
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (empty($mahasiswa)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data mahasiswa</h5>
                    <p class="text-muted">Klik tombol "Tambah Mahasiswa" untuk menambah data</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jurusan</th>
                                <th>Angkatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mahasiswa as $index => $mhs): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><span class="badge bg-secondary"><?= esc($mhs['nim']) ?></span></td>
                                <td><?= esc($mhs['nama']) ?></td>
                                <td><?= esc($mhs['email']) ?></td>
                                <td><?= esc($mhs['jurusan']) ?></td>
                                <td><?= esc($mhs['angkatan']) ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('/mahasiswa/edit/' . $mhs['id']) ?>" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('/mahasiswa/delete/' . $mhs['id']) ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>