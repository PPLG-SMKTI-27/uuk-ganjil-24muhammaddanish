<h2>Dashboard</h2>
<?php if($this->getFlash('success')): ?><div class="alert alert-success"><?= $this->getFlash('success') ?></div><?php endif; ?>
<div class="row">
  <div class="col-md-6">
    <h5>Parkir Aktif</h5>
    <table class="table table-sm"><thead><tr><th>Plat</th><th>Jenis</th><th>Masuk</th><th>Petugas</th><th>Aksi</th></tr></thead><tbody>
      <?php foreach($active as $a): ?>
      <tr>
        <td><?= htmlspecialchars($a['plat_nomor']) ?></td>
        <td><?= $a['jenis_kendaraan'] ?></td>
        <td><?= $a['jam_masuk'] ?></td>
        <td><?= $a['petugas'] ?></td>
        <td><a class="btn btn-sm btn-success" href="<?= $this->baseUrl ?>/?url=parkir/keluar/<?= $a['id'] ?>">Keluar</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody></table>
  </div>
  <div class="col-md-6">
    <h5>Terakhir Keluar</h5>
    <table class="table table-sm"><thead><tr><th>Plat</th><th>Jenis</th><th>Keluar</th><th>Biaya</th></tr></thead><tbody>
      <?php foreach($history as $h): ?>
      <tr>
        <td><?= htmlspecialchars($h['plat_nomor']) ?></td>
        <td><?= $h['jenis_kendaraan'] ?></td>
        <td><?= $h['jam_keluar'] ?></td>
        <td><?= number_format($h['biaya'],0,',','.') ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody></table>
  </div>
</div>
