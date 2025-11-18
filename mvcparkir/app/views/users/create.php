<h2>Tambah User</h2>
<form method="post">
  <div class="mb-3"><label>Username</label><input class="form-control" name="username" required></div>
  <div class="mb-3"><label>Password</label><input class="form-control" name="password" type="password" required></div>
  <div class="mb-3"><label>Role</label>
    <select class="form-select" name="role"><option value="petugas">Petugas</option><option value="admin">Admin</option></select>
  </div>
  <button class="btn btn-primary">Simpan</button>
</form>
