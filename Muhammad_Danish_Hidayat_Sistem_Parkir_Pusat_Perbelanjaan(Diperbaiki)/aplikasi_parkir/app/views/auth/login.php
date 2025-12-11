<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="mb-3">Login Sistem Parkir</h4>
        <?php if(!empty($_SESSION['error'])): ?>
          <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <form method="post" action="<?= BASE_URL ?>login">
          <div class="mb-2"><input name="username" class="form-control" placeholder="Username" required></div>
          <div class="mb-2"><input name="password" type="password" class="form-control" placeholder="Password" required></div>
          <div class="d-grid"><button class="btn btn-primary">Login</button></div>
        </form>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <small>Default: admin/admin123 | petugas/petugas123</small>
            <a class="btn btn-sm btn-outline-secondary" href="<?= BASE_URL ?>register">Register</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
