<?php
$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_presensi_ekskul"
);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>