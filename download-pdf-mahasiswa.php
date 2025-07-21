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
if ($_SESSION['level'] != 1 AND $_SESSION['level'] != 3) {
  echo "<script>
  alert('Anda Tidak Memiliki Akses');
  document.location.href = 'crud-modal.php';
  </script>";
  exit;
}

require __DIR__. '/vendor/autoload.php';
require 'config/app.php';

use Spipu\Html2Pdf\Html2Pdf;

$data_barang = select("SELECT * FROM mahasiswa");

// Perbaikan: inisialisasi $content
$content = '';

// Perbaikan: struktur style
$content .= '<style type="text/css">
    .gambar {
        width: 50px;
    }
</style>';

$content .= '
<page>
    <table border="1" align="center">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Jenis Kelamin</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Foto</th>
        </tr>';

$no = 1;
foreach ($data_barang as $barang) {
    $content .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . $barang['nama'] . '</td>
            <td>' . $barang['prodi'] . '</td>
            <td>' . $barang['jk'] . '</td>
            <td>' . $barang['telepon'] . '</td>
            <td>' . $barang['email'] . '</td>
            <td><img src="assets/img/' . $barang['foto'] . '" class="gambar"></td>
        </tr>';
}

$content .= '
    </table>
</page>';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
ob_start();
$html2pdf->output('Laporan Mahasiswa.pdf');
