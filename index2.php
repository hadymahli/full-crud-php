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

//membatasi halaman sesuai login
if ($_SESSION['level'] != 1 AND $_SESSION['level'] != 2) {
  echo "<script>
  alert('Anda Tidak Memiliki Akses');
  document.location.href = 'crud-modal.php';
  </script>";
  exit;
}

$title = "Daftar Barang";
include_once 'config/database.php';
include_once 'config/controller.php';

$data_barang = select("SELECT * FROM barang");
?>

<!doctype html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>CRUD PHP MySQL bootstrap</title>
</head>

<body>

  <?php
  include 'layout/header.php';
  $data_barang = select("SELECT * FROM barang ORDER BY id_barang ASC");
  ?>

  <div class="container mt-5">

    <h1>Data Barang</h1>
    <hr>
    <a href="tambah-barang.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambah</a>
    <table id="example" class="table table-bordered table-striped">
      <thead>
        <th>No</th>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>barcode</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </thead>
      <tbody>
        <?php
        $no = 1; ?>
        <?php foreach ($data_barang as $barang) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $barang['nama']; ?></td>
            <td><?= $barang['jumlah']; ?></td>
            <td>Rp. <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
            <td class="text-center">
              <img alt="Barcode" src="barcode.php?codetype=Code128&size=15&text=<?= $barang['barcode']; ?>&print=true"/>
            </td>
            <td><?= date("d/m/Y | H:i:s", strtotime($barang['tanggal'])); ?></td>
            <td widht="15%" class="text-center">
              <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?> " class="btn btn-success"><i class="fas fa-edit"></i>Ubah</a>
              <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?> " class="btn btn-danger" onclick="return confirm('Yakin Data Barang Akan Dihapus.');"><i class="fas fa-trash-alt"></i>Hapus</a>
            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php include 'layout/footer.php'; ?>