<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sistem Parkir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="<?= BASE_URL ?>dashboard">Sistem Parkir</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>dashboard">Dashboard</a></li>
          <?php if($_SESSION['user']['role'] === 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>users">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>admin/audit">Audit Log</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>vehicles">Parkir</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>logout">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>login">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>register">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">
