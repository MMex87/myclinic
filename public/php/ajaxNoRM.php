<?php 
require "fungsi.php";
$nik = $_GET['nik'];
$noRm = mysqli_fetch_array(mysqli_query($konek,"SELECT no_rm from pendaftaran INNER JOIN pasien on pasien.id_pasien = pendaftaran.id_pasien WHERE nik='$nik'"));

$dataRM = array('no_rm' => $noRm['no_rm']);

echo json_encode($dataRM);


?>