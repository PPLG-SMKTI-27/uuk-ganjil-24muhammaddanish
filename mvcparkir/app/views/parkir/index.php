<h2>Parkir Aktif</h2>
<?php if($this->getFlash('success')): ?><div class="alert alert-success"><?= $this->getFlash('success') ?></div><?php endif; ?>
<a class="btn btn-primary mb-2" href="<?= $this->baseUrl ?>/?url=parkir/create">Tambah Masuk</a>
<table class="table"><thead><tr><th>Plat</th><th>Jenis</th><th>Masuk</th><th>Petugas</th><th>Aksi</th></tr></thead><tbody>
<?php foreach($data as $d): ?>
<tr>
  <td><?= htmlspecialchars($d['plat_nomor']) ?></td>
  <td><?= $d['jenis_kendaraan'] ?></td>
  <td><?= $d['jam_masuk'] ?></td>
  <td><?= $d['petugas'] ?></td>
  <td><a class="btn btn-sm btn-success" href="<?= $this->baseUrl ?>/?url=parkir/keluar/<?= $d['id'] ?>">Keluar</a></td>
</tr>
<?php endforeach; ?>
</tbody></table>

