<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white text-center">
                <h4><i class="fas fa-user-plus me-2"></i>Registrasi</h4>
            </div>
            <div class="card-body">
                <?= form_open('/auth/register') ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required minlength="6">
                        </div>
                        <div class="form-text">Minimal 6 karakter</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-user-plus me-2"></i>Daftar
                        </button>
                    </div>
                <?= form_close() ?>
            </div>
            <div class="card-footer text-center">
                <small class="text-muted">
                    Sudah punya akun? <a href="<?= base_url('/auth/login') ?>">Login di sini</a>
                </small>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>