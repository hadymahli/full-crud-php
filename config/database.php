<?php
$db = mysqli_connect('localhost', 'root', '', 'crud-php');

if (!$db) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>