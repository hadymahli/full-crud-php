<?php
session_start();
// Membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
  echo "<script>
        alert('Anda harus login terlebih dahulu!');
        document.location.href = 'login.php'
        </script>";
  exit;
}

// Membatasi halaman sesuai user yang login 
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3) {
  echo "<script>
        alert('Anda tidak memiliki hak akses!');
        document.location.href = 'akun.php'
        </script>";
  exit;
}

$title = "Daftar Mahasiswa";
include 'layout/header.php';

$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><i class="nav-icon fas fa-user-graduate"></i> <b>Data Mahasiswa</b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Mahasiswa</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Data Table -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Mahasiswa</h3>
            </div>
            <div class="card-body">
              <a href="tambah-mahasiswa.php" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus"></i> Tambah Mahasiswa</a>
              <a href="download-excel-mahasiswa.php" class="btn btn-success btn-sm mb-2"><i class="fas fa-file-excel"></i> Download Excel</a>
              <a href="download-pdf-mahasiswa.php" class="btn btn-danger btn-sm mb-2"><i class="fas fa-file-pdf"></i> Download PDF</a>

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($data_mahasiswa as $mahasiswa): ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $mahasiswa['nama']; ?></td>
                      <td><?= $mahasiswa['prodi']; ?></td>
                      <td><?= $mahasiswa['jk']; ?></td>
                      <td><?= $mahasiswa['telepon']; ?></td>
                      <td width="25%">
                        <div class="d-flex">
                          <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-secondary btn-sm me-1">
                            <i class="fa fa-eye"></i> Detail
                          </a>
                          <a href="ubah-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-success btn-sm me-1">
                            <i class="fa fa-edit"></i> Ubah
                          </a>
                          <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus data ini?');">
                            <i class="fa fa-trash"></i> Hapus
                          </a>
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

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'layout/footer.php'; ?>
