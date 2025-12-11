<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="d-flex justify-content-between mb-3">
  <h3>Manajemen User</h3>
  <a class="btn btn-success" href="<?= BASE_URL ?>users/create">+ Tambah User</a>
</div>
<div class="card">
  <div class="card-body">
    <table class="table table-bordered">
      <thead><tr><th>ID</th><th>Username</th><th>Role</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php foreach($users as $u): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td>
              <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <form method="post" action="<?= BASE_URL ?>users/change_role?id=<?= $u['id'] ?>" class="d-flex align-items-center">
                  <select name="role" class="form-select form-select-sm me-2" style="width:auto;">
                    <option value="admin" <?= $u['role'] === 'admin' ? 'selected' : '' ?>>admin</option>
                    <option value="petugas" <?= $u['role'] === 'petugas' ? 'selected' : '' ?>>petugas</option>
                  </select>
                  <button class="btn btn-sm btn-primary">Simpan</button>
                </form>
              <?php else: ?>
                <?= $u['role'] ?>
              <?php endif; ?>
            </td>
            <td>
              <a class="btn btn-sm btn-warning" href="<?= BASE_URL ?>users/edit?id=<?= $u['id'] ?>">Edit</a>
              <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <?php if($_SESSION['user']['id'] !== $u['id']): ?>
                  <a class="btn btn-sm btn-danger" href="<?= BASE_URL ?>users/delete?id=<?= $u['id'] ?>" onclick="return confirm('Hapus user?')">Hapus</a>
                <?php else: ?>
                  <span class="text-muted">(Anda)</span>
                <?php endif; ?>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
