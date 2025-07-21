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

require 'config/app.php';

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeSheet = $spreadsheet->getActiveSheet();
$activeSheet->setCellValue('A2', 'No');
$activeSheet->setCellValue('B2', 'Nama');
$activeSheet->setCellValue('C2', 'Program Studi');
$activeSheet->setCellValue('D2', 'Jenis Kelamin');
$activeSheet->setCellValue('E2', 'Telepon');
$activeSheet->setCellValue('F2', 'Email');
$activeSheet->setCellValue('G2', 'Foto');

$data_mahasiswa = select("SELECT * FROM mahasiswa");

$no = 1;
$start = 3;

foreach ($data_mahasiswa as $mahasiswa) {
    $activeSheet->setCellValue('A' . $start, $no++)->getColumnDimension('A')->setAutoSize(true);
    $activeSheet->setCellValue('B' . $start, $mahasiswa['nama'])->getColumnDimension('B')->setAutoSize(true);
    $activeSheet->setCellValue('C' . $start, $mahasiswa['prodi'])->getColumnDimension('C')->setAutoSize(true);
    $activeSheet->setCellValue('D' . $start, $mahasiswa['jk'])->getColumnDimension('D')->setAutoSize(true);
    $activeSheet->setCellValue('E' . $start, $mahasiswa['telepon'])->getColumnDimension('E')->setAutoSize(true);
    $activeSheet->setCellValue('F' . $start, $mahasiswa['email'])->getColumnDimension('F')->setAutoSize(true);
    $activeSheet->setCellValue('G' . $start, 'http://localhost/crud-phpk/assets/img/' . $mahasiswa['foto'])->getColumnDimension('G')->setAutoSize(true);
    $start++;
}   

// border excel
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$border = $start - 1;

$activeSheet->getStyle('A2:G' . $border)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('Laporan data mahasiswa.xlsx');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Laporan data mahasiswa.xlsx"');
readfile('Laporan data mahasiswa.xlsx');
unlink('Laporan data mahasiswa.xlsx'); 
exit;
?>