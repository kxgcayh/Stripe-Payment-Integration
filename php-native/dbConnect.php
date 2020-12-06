<?php
require_once('./config.php');
// Koneksi Database
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Tampil pesan error jika gagal
if ($db->connect_errno) {
   printf("Connection Failed: %s\n", $db->connect_errno);
   exit();
}
