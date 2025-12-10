<?php require __DIR__ . '/../layout/header.php'; ?>
<h3>Edit Kendaraan</h3>
<div class="card p-3">
  <form method="post" action="<?= BASE_URL ?>vehicles/update?id=<?= $vehicle['id'] ?>">
    <div class="mb-2"><input name="plate" value="<?= htmlspecialchars($vehicle['plate']) ?>" class="form-control" required></div>
    <div class="mb-2">
      <select name="type" class="form-select" required>
        <option value="motor" <?= $vehicle['type'] === 'motor' ? 'selected' : '' ?>>Motor</option>
        <option value="mobil" <?= $vehicle['type'] === 'mobil' ? 'selected' : '' ?>>Mobil</option>
      </select>
    </div>
    <div><button class="btn btn-primary">Update</button></div>
  </form>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
