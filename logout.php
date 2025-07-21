<?php 
session_start();

//membatasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "<script>
    alert('Anda Harus Login Terlebih Dahulu');
    document.location.href = 'login.php';
    </script>";
    exit;
}

$_SESSION = [];
session_unset();    
session_destroy();
echo "<script>
      alert('Anda Berhasil Keluar');
      document.location.href = 'login.php';
      </script>";