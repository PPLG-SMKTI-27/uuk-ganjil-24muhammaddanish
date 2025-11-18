<h2>Manajemen Users</h2>
<?php if($this->getFlash('success')): ?><div class="alert alert-success"><?= $this->getFlash('success') ?></div><?php endif; ?>
<a class="btn btn-primary mb-2" href="<?= $this->baseUrl ?>/?url=user/create">Tambah User</a>
<table class="table"><thead><tr><th>ID</th><th>Username</th><th>Role</th><th>Aksi</th></tr></thead><tbody>
<?php foreach($users as $u): ?>
<tr>
  <td><?= $u['id'] ?></td>
  <td><?= htmlspecialchars($u['username']) ?></td>
  <td><?= $u['role'] ?></td>
  <td>
    <a class="btn btn-sm btn-warning" href="<?= $this->baseUrl ?>/?url=user/edit/<?= $u['id'] ?>">Edit</a>
    <a class="btn btn-sm btn-danger" href="<?= $this->baseUrl ?>/?url=user/delete/<?= $u['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
  </td>
</tr>
<?php endforeach; ?>
</tbody></table>
