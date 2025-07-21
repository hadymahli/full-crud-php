<?php

session_start();
//membatasi halaman sebelum login 
if (!isset($_SESSION["login"])) {
  echo "<script>
        alert('Anda harus login terlebih dahulu!');
        document.location.href = 'login.php'
        </script>";
  exit;
}

//membatasi halaman sesuai user yang login 
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
  echo "<script>
        alert('Anda tidak memiliki hak akses!');
        document.location.href = 'akun.php'
        </script>";
  exit;
}

$title = "Daftar Barang";
include 'layout/header.php';
// Ambil data barang dari database
$data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          
          <h1 class="m-0"><i class="nav-icon fas fa-box"></i>
           <b>Data Barang</b>
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Barang</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Barang</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <a href="tambah-barang.php" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus"></i> Tambah Barang</a>
                    <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal"
                    data-target="#modalfilter"><i class="fas fa-search"></i> Filter Data</button>


                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Barcode</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($data_barang as $barang): ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $barang['nama']; ?></td>
                          <td><?= $barang['jumlah']; ?></td>
                          <td>Rp.<?= number_format($barang['harga'], 0, ',', '.'); ?></td>
                          <td class="text-center">
                            <img alt="barcode"
                              src="barcode.php?codetype=Code128&size=15&text=<?= $barang['barcode']; ?>&print=true" />
                          </td>
                          <td><?= date('d/m/Y | H:i:s', strtotime($barang['tanggal'])); ?></td>
                          <td width="15%">
                            <div class="d-flex">
                              <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>"
                                class="btn btn-success btn-sm me-1"><i class="fa fa-edit"></i> Ubah</a>

                              <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin Data barang akan dihapus');"><i class="fa fa-trash"></i>
                                Hapus</a>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  
                  <div class="mt-2 justify-content-end d-flex">
                  <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include 'layout/footer.php'; ?>
</div>