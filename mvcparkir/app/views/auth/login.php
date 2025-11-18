<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title mb-3">Login</h4>
        <?php if(!empty($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <form method="post" action="">
          <div class="mb-3"><label>Username</label><input class="form-control" name="username" required></div>
          <div class="mb-3"><label>Password</label><input class="form-control" type="password" name="password" required></div>
          <button class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>
