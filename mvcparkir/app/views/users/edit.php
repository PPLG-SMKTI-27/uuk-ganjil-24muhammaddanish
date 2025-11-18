<h2>Edit User</h2>
<form method="post">
  <div class="mb-3"><label>Username</label><input class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>" required></div>
  <div class="mb-3"><label>Password (kosongkan jika tidak ganti)</label><input class="form-control" name="password" type="password"></div>
  <div class="mb-3"><label>Role</label>
    <select class="form-select" name="role"><option value="petugas" <?= $user['role']==='petugas'?'selected':'' ?>>Petugas</option><option value="admin" <?= $user['role']==='admin'?'selected':'' ?>>Admin</option></select>
  </div>
  <button class="btn btn-primary">Update</button>
</form>
