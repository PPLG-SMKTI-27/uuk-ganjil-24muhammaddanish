<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3>Register</h3>
            <?php if(!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <?php if(!empty($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>
            <form method="post" action="<?= BASE_URL ?>register">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input name="username" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input name="password2" type="password" class="form-control" required />
                </div>
                <button class="btn btn-primary">Register</button>
                <a class="btn btn-link" href="<?= BASE_URL ?>login">Login</a>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
