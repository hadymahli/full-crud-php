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
$title = "Tambah Mahasiswa";
include 'layout/header.php';
if (isset($_POST['nama'])) {
    if (create_mahasiswa($_POST) > 0) {
        echo "<script>
            alert('Data mahasiswa Berhasil Ditambahkan');
            document.location.href = 'mahasiswa.php';
        </script>";
    } else {
        echo "<script>
            alert('Data mahasiswa Gagal Ditambahkan');
            document.location.href = 'mahasiswa.php';
        </script>";
    }
}

?>

<?php include 'layout/footer.php'; ?>
<div class="container mt-5">
    <h1>Tambah Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama mahasiswa..." required>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="prodi" class="form-label">Program Studi</label>
                <select name="prodi" id="prodi" class="form-control" required>
                    <option value="">-- pilih prodi --</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknik Mesin">Teknik Mesin</option>
                    <option value="Teknik Listrik">Teknik Listrik</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control" required>
                    <option value="">-- pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" placeholder="no telp..." required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>

            <textarea name="alamat" id="alamat"></textarea>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="email mahasiswa..." required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" placeholder="foto mahasiswa..."
                onchange="previewImage()">

            <img src="assets/img/<?= $mahasiswa['foto'] ?>" alt="" class="img-thumbnail img-preview mt-2" width="100px">

            <img src="" alt="" class="img-thumbnail img-preview" width="100%">
        </div>
        <button type="submit" name="tambah" class="btn btn-primary" style="float: right;"><i class="fas-fa-plus"></i>
            Tambah</button>
    </form>
</div>

<!-- preview image -->
<script>
    function previewImage() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function (e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php include 'layout/footer.php'; ?>