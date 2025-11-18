<?php
$config = require __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/core/Database.php';
$db = Database::getInstance($config['db'])->getConnection();

$users = [
  ['username'=>'admin','password'=>'admin123','role'=>'admin'],
  ['username'=>'petugas','password'=>'petugas123','role'=>'petugas']
];

foreach($users as $u){
  $s = $db->prepare("SELECT id FROM users WHERE username=?");
  $s->execute([$u['username']]);
  if (!$s->fetch()){
    $h = password_hash($u['password'], PASSWORD_BCRYPT);
    $ins = $db->prepare("INSERT INTO users (username,password,role) VALUES (?,?,?)");
    $ins->execute([$u['username'],$h,$u['role']]);
    echo "Created ".$u['username']."<br>";
  } else echo $u['username']." exists<br>";
}
echo "done.";
