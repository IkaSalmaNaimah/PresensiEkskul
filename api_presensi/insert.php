<?php
include "koneksi.php";

// Ambil data dari POST
$nama = $_POST['nama'] ?? '';
$kode_qr = $_POST['kode_qr'] ?? '';

// Kalau $_POST kosong, coba baca data mentah
if ($nama == '' && $kode_qr == '') {
    $raw = file_get_contents("php://input");
    parse_str($raw, $data);

    $nama = $data['nama'] ?? '';
    $kode_qr = $data['kode_qr'] ?? '';
}

$tanggal = date("Y-m-d");
$waktu = date("H:i:s");

$query = "INSERT INTO presensi (nama, kode_qr, tanggal, waktu)
          VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $query);

mysqli_stmt_bind_param(
    $stmt,
    "ssss",
    $nama,
    $kode_qr,
    $tanggal,
    $waktu
);

if (mysqli_stmt_execute($stmt)) {
    echo "Presensi berhasil disimpan";
} else {
    http_response_code(500);
    echo "Gagal menyimpan presensi: " . mysqli_error($koneksi);
}