<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h2>
        <div class="text-muted">
            Selamat datang, <strong><?= session()->get('username') ?></strong>!
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Total Mahasiswa</h5>
                            <h2 class="mb-0"><?= $total_mahasiswa ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('/mahasiswa') ?>" class="text-white text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Status</h5>
                            <h6 class="mb-0">Sistem Aktif</h6>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <small>Semua sistem berjalan normal</small>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Role</h5>
                            <h6 class="mb-0"><?= ucfirst(session()->get('role')) ?></h6>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-user-shield fa-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <small>Level akses saat ini</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-users me-2"></i>Data Mahasiswa Terbaru</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($recent_mahasiswa)): ?>
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada data mahasiswa</p>
                            <a href="<?= base_url('/mahasiswa/create') ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>Tambah Data
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Jurusan</th>
                                        <th>Angkatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_mahasiswa as $mhs): ?>
                                    <tr>
                                        <td><span class="badge bg-secondary"><?= esc($mhs['nim']) ?></span></td>
                                        <td><?= esc($mhs['nama']) ?></td>
                                        <td><?= esc($mhs['jurusan']) ?></td>
                                        <td><?= esc($mhs['angkatan']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end">
                            <a href="<?= base_url('/mahasiswa') ?>" class="btn btn-primary btn-sm">
                                Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle me-2"></i>Informasi Sistem</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-code me-2 text-primary"></i>
                            <strong>Framework:</strong> CodeIgniter 4
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-palette me-2 text-success"></i>
                            <strong>UI:</strong> Bootstrap 5
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-database me-2 text-info"></i>
                            <strong>Database:</strong> MySQL
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-shield-alt me-2 text-warning"></i>
                            <strong>Auth:</strong> Session-based
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-user-cog me-2 text-danger"></i>
                            <strong>RBAC:</strong> Role-Based Access
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>