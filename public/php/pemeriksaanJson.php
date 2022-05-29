<?php
require 'fungsi.php';
$id_daftar = $_GET['id'];
$perintah = "SELECT * FROM pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE month(pendaftaran.tanggal_daftar) BETWEEN 02 AND 03 HAVING year(pendaftaran.tanggal_daftar) = 2022 AND pendaftaran.status=0 AND pendaftaran.id_pendaftaran=" . $id_daftar;
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_affected_rows($konek);

while ($ambil = mysqli_fetch_object($eksekusi)) {
    $k["id_pasien"] = $ambil->id_pasien;
    $k["no_bpjs"] = $ambil->no_bpjs;
    $k["nama"] = $ambil->nama;
    $k["no_rm"] = $ambil->no_rm;
    $k["tanggal_lahir"] = $ambil->tanggal_lahir;
    $k["jenis_kelamin"] = $ambil->jenis_kelamin;
    $k["nik"] = $ambil->nik;
    $k["no_telfone"] = $ambil->no_telfone;
    $k["alamat"] = $ambil->alamat;
    $k["id_pendaftaran"] = $ambil->id_pendaftaran;
    $k["tanggal_daftar"] = $ambil->tanggal_daftar;
    $k["nama_dokter"] = $ambil->nama_dokter;
    $k["status"] = $ambil->status;
}

echo json_encode($k);
mysqli_close($konek);