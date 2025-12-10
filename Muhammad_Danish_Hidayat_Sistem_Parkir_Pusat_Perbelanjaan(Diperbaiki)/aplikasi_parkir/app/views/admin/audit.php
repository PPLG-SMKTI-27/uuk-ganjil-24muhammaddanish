<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Audit Log</h2>

    <div class="mb-3">
        <form class="form-inline" method="get">
            <label class="me-2">Lines:</label>
            <input type="number" name="lines" value="<?= htmlspecialchars($_GET['lines'] ?? 200) ?>" class="form-control me-2" style="width:100px" />
            <button class="btn btn-primary me-2">Refresh</button>
            <a class="btn btn-secondary" href="<?= BASE_URL ?>admin/audit?export=csv">Export CSV</a>
        </form>
    </div>

    <?php if (empty($entries)): ?>
        <div class="alert alert-info">No audit entries found.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Action</th>
                        <th>User</th>
                        <th>Vehicle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($entries as $e): ?>
                        <tr>
                            <td><?= htmlspecialchars($e['timestamp']) ?></td>
                            <td><?= htmlspecialchars($e['action']) ?></td>
                            <td><?= htmlspecialchars($e['user']) ?></td>
                            <td><?= htmlspecialchars($e['vehicle']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
