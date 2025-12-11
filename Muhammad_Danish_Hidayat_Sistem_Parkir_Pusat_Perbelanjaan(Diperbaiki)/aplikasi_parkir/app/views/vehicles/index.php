<?php require __DIR__ . '/../layout/header.php'; ?>
  <div class="d-flex justify-content-between mb-3">
  <h3>Data Kendaraan</h3>
  <?php if(isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['admin','petugas'])): ?>
    <a class="btn btn-success" href="<?= BASE_URL ?>vehicles/create">+ Tambah</a>
  <?php endif; ?>
</div>
<div class="card">
  <div class="card-body">
    <form method="get" class="row g-2 mb-3">
      <div class="col-md-4"><input name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" class="form-control" placeholder="Cari plat... (misal: B1234)"></div>
      <div class="col-md-2">
        <select name="type" class="form-select">
          <option value="">Semua tipe</option>
          <option value="motor" <?= (($_GET['type'] ?? '') === 'motor') ? 'selected' : '' ?>>Motor</option>
          <option value="mobil" <?= (($_GET['type'] ?? '') === 'mobil') ? 'selected' : '' ?>>Mobil</option>
        </select>
      </div>
      <div class="col-md-2">
        <select name="status" class="form-select">
          <option value="">Semua status</option>
          <option value="active" <?= (($_GET['status'] ?? '') === 'active') ? 'selected' : '' ?>>Masih Parkir</option>
          <option value="exited" <?= (($_GET['status'] ?? '') === 'exited') ? 'selected' : '' ?>>Sudah Keluar</option>
        </select>
      </div>
      <div class="col-md-2"><button class="btn btn-primary">Filter</button></div>
    </form>
    </form>

    <?php if(!empty($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="mb-3">
      <div class="row">
        <div class="col-md-3">
          <div class="card text-bg-light p-2">
            <div class="card-body p-2">
              <small>Total Kendaraan</small>
              <div class="fs-4"><?= $summary['total'] ?? 0 ?></div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-bg-light p-2">
            <div class="card-body p-2">
              <small>Masih Parkir</small>
              <div class="fs-4"><?= $summary['active'] ?? 0 ?></div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-bg-light p-2">
            <div class="card-body p-2">
              <small>Sudah Keluar</small>
              <div class="fs-4"><?= $summary['exited'] ?? 0 ?></div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-bg-light p-2">
            <div class="card-body p-2">
              <small>Pendapatan Hari Ini</small>
              <div class="fs-6">Rp <?= number_format($summary['revenue_today'] ?? 0,0,',','.') ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <table class="table table-hover">
      <thead><tr><th>ID</th><th>Plat</th><th>Tipe</th><th>Masuk</th><th>Keluar</th><th>Durasi</th><th>Biaya</th><th>Petugas</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php foreach($vehicles as $v): ?>
          <tr>
            <td><?= $v['id'] ?></td>
            <td><?= htmlspecialchars($v['plate']) ?></td>
            <td><?= $v['type'] ?></td>
            <td><?= $v['entry_time'] ?></td>
            <td><?= $v['exit_time'] ?: '-' ?></td>
            <td><?php
                $entry = new DateTime($v['entry_time']);
                $end = $v['exit_time'] ? new DateTime($v['exit_time']) : new DateTime();
                $diff = $entry->diff($end);
                $parts = [];
                if($diff->d) $parts[] = $diff->d . ' hari';
                if($diff->h) $parts[] = $diff->h . ' jam';
                if($diff->i) $parts[] = $diff->i . ' mnt';
                if(empty($parts)) $parts[] = '0 mnt';
                echo implode(' ', $parts);
            ?></td>
            <td><?= $v['fee'] ? 'Rp '.number_format($v['fee'],0,',','.') : '-' ?></td>
            <td><?= htmlspecialchars($v['created_by_name'] ?? '-') ?></td>
            <td><?= $v['exit_time'] ? 'Sudah Keluar' : 'Masih Parkir' ?></td>
            <td>
              <?php if(!$v['exit_time'] && isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['admin','petugas'])): ?>
                <a class="btn btn-primary btn-sm" href="<?= BASE_URL ?>vehicles/exit?id=<?= $v['id'] ?>">Keluar</a>
              <?php endif; ?>
              <?php if(isset($_SESSION['user']) && ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['id'] === $v['created_by'])): ?>
                <a class="btn btn-warning btn-sm" href="<?= BASE_URL ?>vehicles/edit?id=<?= $v['id'] ?>">Edit</a>
              <?php endif; ?>
              <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a class="btn btn-danger btn-sm" href="<?= BASE_URL ?>vehicles/delete?id=<?= $v['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
