<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4><i class="fas fa-sign-in-alt me-2"></i>Login</h4>
            </div>
            <div class="card-body">
                <?= form_open('/auth/login') ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </div>
                <?= form_close() ?>
            </div>
            <div class="card-footer text-center">
                <small class="text-muted">
                    Belum punya akun? <a href="<?= base_url('/auth/register') ?>">Daftar di sini</a>
                </small>
            </div>
        </div>
        
        <div class="mt-4">
            <div class="card">
                <div class="card-header">
                    <h6>Akun Demo</h6>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Admin:</strong></p>
                    <p class="mb-1">Username: admin</p>
                    <p class="mb-3">Password: admin123</p>
                    
                    <p class="mb-1"><strong>User:</strong></p>
                    <p class="mb-1">Username: user1</p>
                    <p class="mb-0">Password: user123</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>