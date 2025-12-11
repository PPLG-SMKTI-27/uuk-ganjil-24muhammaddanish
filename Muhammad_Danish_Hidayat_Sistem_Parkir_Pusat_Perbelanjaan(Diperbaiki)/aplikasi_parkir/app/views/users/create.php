<?php require __DIR__ . '/../layout/header.php'; ?>
<h3>Tambah User</h3>
<div class="card p-3">
  <form method="post" action="<?= BASE_URL ?>users/store">
    <div class="mb-2"><input name="username" class="form-control" placeholder="Username" required></div>
    <div class="mb-2"><input name="password" type="password" class="form-control" placeholder="Password" required></div>
    <div class="mb-2">
      <select name="role" class="form-select" required>
        <option value="admin">Admin</option>
        <option value="petugas">Petugas</option>
      </select>
    </div>
    <div><button class="btn btn-primary">Simpan</button></div>
  </form>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
