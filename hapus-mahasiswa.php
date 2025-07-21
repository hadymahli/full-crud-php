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

include 'config/app.php';

//menerima id mahasiswa yang dipilih pengguna
$id_mahasiswa =(int) $_GET['id_mahasiswa'];

if (delete_mahasiswa($id_mahasiswa) > 0) {
    echo "<script>
              alert('Data Mahasiswa Berhasil Dihapus');
              document.location.href = 'mahasiswa.php';
              </script>";
              exit;
}else{
echo "<script>
              alert('Data Mahasiswa Gagal Diubah');
              document.location.href = 'mahasiswa.php';
              </script>";
        exit;
}