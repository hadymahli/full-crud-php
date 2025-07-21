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

$title = 'Ubah Barang';

include 'config/database.php';
include 'config/controller.php';
include 'layout/header.php'; 

$id_barang = (int)$_GET['id_barang'];

// Proses update data
if (isset($_POST['ubah'])) {
    // Pastikan fungsi update_barang sudah ada di controller.php
    if (update_barang($_POST) > 0) {
        echo "<script>
              alert('Data Barang Berhasil Diubah');
              document.location.href = 'index.php';
              </script>";
        exit;
    } else {
        echo "<script>
              alert('Data Barang Gagal Diubah');
              document.location.href = 'index.php';
              </script>";
        exit;
    }
}

$barang = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];
?>

<div class="container mt-5">
    <h1>Ubah Barang</h1>
    <hr>
    <form action="" method="post">
        <input type="hidden" name="id_barang" value="<?= $barang['id_barang'] ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $barang['nama'] ?>"  placeholder="Nama Barang..." required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $barang['jumlah'] ?>"   placeholder="Jumlah Barang..." required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Barang</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?= $barang['harga'] ?>"   placeholder="Harga Barang..." required>
        </div>
        <button type="submit" class="btn btn-primary" style="float: right;" name="ubah">Ubah</button>
    </form>
</div>

<?php include 'layout/footer.php'; ?>