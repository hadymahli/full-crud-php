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

$title = "Daftar Akun";

include 'layout/header.php';

$data_akun = select("SELECT * FROM akun");

// tampilkan data akun berdasarkan level
$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");

if (isset($_POST['tambah'])) {
    // Pastikan fungsi update_barang sudah ada di controller.php
    if (create_akun($_POST) > 0) {
        echo "<script>
              alert('Data Akun Berhasil Ditambahkan');
              document.location.href = 'crud-modal.php';
              </script>";
        exit;
    } else {
        echo "<script>
              alert('Data Akun Gagal Ditambahkan');
              document.location.href = 'crud-modal.php';
              </script>";
        exit;
    }
}

if (isset($_POST['ubah'])) {
    // Pastikan fungsi update_barang sudah ada di controller.php
    if (update_akun($_POST) > 0) {
        echo "<script>
              alert('Data Akun Berhasil Diubah');
              document.location.href = 'crud-modal.php';
              </script>";
        exit;
    } else {
        echo "<script>
              alert('Data Akun Gagal Diubah');
              document.location.href = 'crud-modal.php';
              </script>";
        exit;
    }
}


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

    <div class="container mt-5">

        <h1>Data Akun</h1>
        <hr>

        <?php if ($_SESSION['level'] == 1) : ?>
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambahan"><i class="fas fa-plus-circle"></i> Tambah</button>
        <?php endif; ?>

        <table id="example" class="table table-bordered table-striped">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Aksi</th>
            </thead>
            <tbody>

                <?php $no = 1; ?>
                <?php if ($_SESSION['level'] == 1) : ?>
                    <?php foreach ($data_akun as $akun) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $akun['nama']; ?></td>
                            <td><?= $akun['username']; ?></td>
                            <td><?= $akun['email']; ?></td>
                            <td>password ter-enkripsi</td>
                            <td widht="15%" class="text-center">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">
                                    Ubah
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun['id_akun']; ?>">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <!-- Tampil data berdasarkan user login -->
                     <?php foreach ($data_bylogin as $akun) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $akun['nama']; ?></td>
                            <td><?= $akun['username']; ?></td>
                            <td><?= $akun['email']; ?></td>
                            <td>password ter-enkripsi</td>
                            <td widht="15%" class="text-center">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">
                                    Ubah
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTambahan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="6">
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select name="level" id="level" class="form-control" required>
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
    </div>

    <!-- Modal Hapus -->
    <?php foreach ($data_akun as $akun) : ?>
        <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin Ingin Menghapus Data Akun : <?= $akun['nama']; ?> .?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>




    <!-- Modal Ubah -->
    <?php foreach ($data_akun as $akun) : ?>

        <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $akun['nama']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $akun['username']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $akun['email']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <small>(masukan password baru/lama)</small></label>
                                <input type="password" class="form-control" id="password" name="password" required minlength="6">
                            </div>

                            <?php if ($_SESSION['level'] == 1) : ?>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="1" <?= $level == "1" ? 'selected' : null ?>>Admin</option>
                                    <option value="2" <?= $level == "2" ? 'selected' : null ?>>Operator Barang</option>
                                    <option value="3" <?= $level == "3" ? 'selected' : null ?>>Operator Mahasiswa</option>
                                </select>
                            </div>
                            <?php else : ?>
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
        </div>


    <?php endforeach; ?>

    <?php include 'layout/footer.php'; ?>

    <!-- Pastikan ini ada sebelum </body> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>