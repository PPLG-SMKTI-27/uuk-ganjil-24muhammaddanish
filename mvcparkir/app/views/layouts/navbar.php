<?php $user=$_SESSION['user'] ?? null; $base=$this->baseUrl; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= $base ?>/">Parkir</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navc"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navc">
      <ul class="navbar-nav me-auto">
        <?php if($user): ?>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>/?url=dashboard">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>/?url=parkir">Parkir</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>/?url=parkir/create">Masuk</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>/?url=parkir/history">History</a></li>
          <?php if($user['role']==='admin'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= $base ?>/?url=user">Users</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if($user): ?>
          <li class="nav-item"><span class="nav-link">Hi, <?= htmlspecialchars($user['username']) ?></span></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>/?url=auth/logout">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>/?url=auth/login">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
