<?php require __DIR__ . '/../layout/header.php'; ?>
<h3>Tambah Kendaraan Masuk</h3>
<div class="card p-3">
  <form method="post" action="<?= BASE_URL ?>vehicles/store">
    <div class="mb-2"><input name="plate" class="form-control" placeholder="Nomor Plat (cth: B1234ABC)" required></div>
    <div class="mb-2">
      <select name="type" class="form-select" required>
        <option value="motor">Motor</option>
        <option value="mobil">Mobil</option>
      </select>
    </div>
    <div><button class="btn btn-primary">Simpan</button></div>
  </form>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
