<?php
session_start();

if (!isset($_SESSION["login"])) {
    echo "<script>
        alert('Anda harus login terlebih dahulu!');
        document.location.href = 'login.php';
    </script>";
    exit;
}

$title = "Daftar Akun";
include 'layout/header.php';

$data_akun = select("SELECT * FROM akun");
$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");

if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
            alert('Data Akun Berhasil Ditambahkan');
            document.location.href = 'akun.php';
        </script>";
    } else {
        echo "<script>
            alert('Data Akun Gagal Ditambahkan');
            document.location.href = 'akun.php';
        </script>";
    }
}

if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
            alert('Data Akun Berhasil Diubah');
            document.location.href = 'akun.php';
        </script>";
    } else {
        echo "<script>
            alert('Data Akun Gagal Diubah');
            document.location.href = 'akun.php';
        </script>";
    }
}
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><i class="nav-icon fas fa-user-cog"></i> <b>Data Akun</b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Akun</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Akun</h3>
        </div>

        <div class="card-body">
          <?php if ($_SESSION['level'] == 1): ?>
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
              <i class="fas fa-plus-circle"></i> Tambah Akun
            </button>
          <?php endif; ?>

          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php $list = $_SESSION['level'] == 1 ? $data_akun : $data_bylogin; ?>
              <?php foreach ($list as $akun): ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $akun['nama']; ?></td>
                  <td><?= $akun['username']; ?></td>
                  <td><?= $akun['email']; ?></td>
                  <td>Akun Ter-enkripsi</td>
                  <td class="text-center">
                    <div class="d-flex">
                      <button type="button" class="btn btn-success btn-sm me-1" data-bs-toggle="modal"
                        data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">
                        <i class="fa fa-edit"></i> Ubah
                      </button>
                      <?php if ($_SESSION['level'] == 1): ?>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                          data-bs-target="#modalHapus<?= $akun['id_akun']; ?>">
                          <i class="fa fa-trash"></i> Hapus
                        </button>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="" method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah Akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" name="nama" required>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <div class="mb-3">
          <label for="level" class="form-label">Level</label>
          <select name="level" class="form-control" required>
            <option value="">-- Pilih Level --</option>
            <option value="1">Admin</option>
            <option value="2">Operator Barang</option>
            <option value="3">Operator Mahasiswa</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Ubah -->
<?php foreach ($list as $akun): ?>
  <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="modalUbahLabel<?= $akun['id_akun']; ?>" aria-hidden="true">
    <div class="modal-dialog">
      <form action="" method="post" class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Ubah Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="<?= $akun['nama']; ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?= $akun['username']; ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= $akun['email']; ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <?php if ($_SESSION['level'] == 1): ?>
            <div class="mb-3">
              <label class="form-label">Level</label>
              <select name="level" class="form-control" required>
                <option value="1" <?= $akun['level'] == 1 ? 'selected' : ''; ?>>Admin</option>
                <option value="2" <?= $akun['level'] == 2 ? 'selected' : ''; ?>>Operator Barang</option>
                <option value="3" <?= $akun['level'] == 3 ? 'selected' : ''; ?>>Operator Mahasiswa</option>
              </select>
            </div>
          <?php else: ?>
            <input type="hidden" name="level" value="<?= $akun['level']; ?>">
          <?php endif; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
          <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
        </div>
      </form>
    </div>
  </div>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php if ($_SESSION['level'] == 1): ?>
  <?php foreach ($data_akun as $akun): ?>
    <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title">Hapus Akun</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Yakin ingin menghapus akun <b><?= $akun['nama']; ?></b>?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
            <a href="hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger btn-sm">Hapus</a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<?php include 'layout/footer.php'; ?>
