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

$title = 'Ubah Mahasiswa'; 

include 'config/database.php';
include 'config/controller.php';
include 'layout/header.php';

if (isset($_POST['ubah'])) {
    if (update_mahasiswa($_POST) > 0) {
        echo "<script>
              alert('Data Mahasiswa Berhasil Diubah');
              document.location.href = 'mahasiswa.php';
                </script>";
    }else {
        echo "<script>
              alert('Data Mahasiswa Gagal Diubah');
              document.location.href = 'mahasiswa.php';
                </script>";
    }
}

//ambil id mahasiswa dari url
$id_mahasiswa = (int) $_GET['id_mahasiswa'];

//query data mahasiswa 
$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
?>

<div class="container mt-5">
    <h1>Ubah Data Mahasiswa</h1>
    <hr>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
        <input type="hidden" name="fotoLama" value="<?= $mahasiswa['foto']; ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $mahasiswa['nama']; ?>" placeholder="Nama Mahasiswa..." required>
        </div>

        <div class="row">
            <div class="nb-3 col-md-6">
                <label for="prodi" class="form-label">Program Studi</label>
                <select name="prodi" id="prodi" class="form-control" required>
                    <option value="">Pilih Program Studi</option>
                    <?php $prodi = $mahasiswa['prodi']; ?>
                    <option value="Teknik Informatika" <?= $prodi == 'Teknik Informatika' ? 'selected' : null ?>>Teknik Informatika</option>
                    <option value="Teknik Mesin" <?= $prodi == 'Teknik Mesin' ? 'selected' : null ?>>Teknik Mesin</option>
                    <option value="Tenik Listrik" <?= $prodi == 'Teknik Listrik' ? 'selected' : null ?>>Teknik Listrik</option>
                </select>
            </div>
            <div class="nb-3 col-md-6">
                <label for="prodi" class="form-label">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <?php $jk = $mahasiswa['jk']; ?>
                    <option value="Laki-laki" <?= $jk == 'Laki-laki' ? 'selected' : null ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="telepon" name="telepon"
            value="<?= $mahasiswa['telepon']; ?>" placeholder="Telepon..." required>
        </div>

        <div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <textarea name="alamat" class="form-control" id="alamat" placeholder="Alamat..." required><?= $mahasiswa['alamat']; ?></textarea>
</div>


        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" 
            value="<?= $mahasiswa['email']; ?>" placeholder=" Email..." required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto..."
            onchange="previewImage()">
            <p>
                <small> Gambar Sebelumnnya</small>
            </p>
            <img src="assets/img/<?= $mahasiswa['foto']; ?>" alt="foto" class="img-thumbnail img-preview mt-2" width="100px">
        </div>

        <button type="submit" name="ubah" class="btn btn-primary" style="float: right;" ><i class="fas fa-plus"></i>ubah</button>
    </form> 
</div>
<!-- preview image -->
<script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php include 'layout/footer.php'; ?>