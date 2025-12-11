<?php require __DIR__ . '/../layout/header.php'; ?>
<h3>Edit User</h3>
<div class="card p-3">
  <form method="post" action="<?= BASE_URL ?>users/update?id=<?= $user['id'] ?>">
    <div class="mb-2"><input name="username" value="<?= htmlspecialchars($user['username']) ?>" class="form-control" required></div>
    <div class="mb-2"><input name="password" type="password" class="form-control" placeholder="Kosongkan jika tidak ganti"></div>
    <div class="mb-2">
      <select name="role" class="form-select" required>
        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="petugas" <?= $user['role'] === 'petugas' ? 'selected' : '' ?>>Petugas</option>
      </select>
    </div>
    <div><button class="btn btn-primary">Update</button></div>
  </form>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
