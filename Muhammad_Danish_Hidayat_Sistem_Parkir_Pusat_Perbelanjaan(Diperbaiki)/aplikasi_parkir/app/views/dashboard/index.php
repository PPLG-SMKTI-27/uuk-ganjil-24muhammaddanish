<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Dashboard</h3>
  <div>
    <a class="btn btn-primary me-2" href="<?= BASE_URL ?>vehicles">Lihat Data Kendaraan</a>
    <?php if(isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['admin','petugas'])): ?>
      <a class="btn btn-success" href="<?= BASE_URL ?>vehicles/create">+ Tambah Kendaraan</a>
    <?php endif; ?>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-3">
    <div class="card text-bg-light p-2">
      <div class="card-body p-2">
        <small>Total Kendaraan (Semua)</small>
        <div class="fs-4"><?= $summaryAll['total'] ?? 0 ?></div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-bg-light p-2">
      <div class="card-body p-2">
        <small>Masih Parkir</small>
        <div class="fs-4"><?= $summaryActive['active'] ?? 0 ?></div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-bg-light p-2">
      <div class="card-body p-2">
        <small>Sudah Keluar (Hari Ini)</small>
        <div class="fs-4"><?= $summaryAll['exited'] ?? 0 ?></div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-bg-light p-2">
      <div class="card-body p-2">
        <small>Pendapatan Hari Ini</small>
        <div class="fs-6">Rp <?= number_format($summaryAll['revenue_today'] ?? 0,0,',','.') ?></div>
      </div>
    </div>
  </div>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <h5>Active Vehicles (Terbaru)</h5>
    <table class="table table-sm">
      <thead><tr><th>Plat</th><th>Tipe</th><th>Masuk</th><th>Petugas</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php foreach($vehicles as $v): ?>
          <tr>
            <td><?= htmlspecialchars($v['plate']) ?></td>
            <td><?= $v['type'] ?></td>
            <td><?= $v['entry_time'] ?></td>
            <td><?= htmlspecialchars($v['created_by_name'] ?? '-') ?></td>
            <td>
              <a class="btn btn-primary btn-sm" href="<?= BASE_URL ?>vehicles/exit?id=<?= $v['id'] ?>">Keluar</a>
              <a class="btn btn-warning btn-sm" href="<?= BASE_URL ?>vehicles/edit?id=<?= $v['id'] ?>">Edit</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
