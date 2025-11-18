<h2>History Parkir</h2>
<table class="table table-sm"><thead><tr><th>Plat</th><th>Jenis</th><th>Masuk</th><th>Keluar</th><th>Biaya</th><th>Petugas</th></tr></thead><tbody>
<?php foreach($history as $h): ?>
<tr>
  <td><?= htmlspecialchars($h['plat_nomor']) ?></td>
  <td><?= $h['jenis_kendaraan'] ?></td>
  <td><?= $h['jam_masuk'] ?></td>
  <td><?= $h['jam_keluar'] ?></td>
  <td><?= number_format($h['biaya'],0,',','.') ?></td>
  <td><?= $h['petugas'] ?></td>
</tr>
<?php endforeach; ?>
</tbody></table>
