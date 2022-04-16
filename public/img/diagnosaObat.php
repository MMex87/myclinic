<?php
require 'fungsi.php';

if (isset($_POST['btTambah'])) {
    if (diagnosa($_POST) == "gagal") {
        echo "<script>
        alert('Diagnosa gagal ditambahkan diKarenakan Stock Obat tidak Cukup! ');
        </script>";
    } else {
    }
} else if (isset($_POST['btHapus'])) {
    hapusDiagnosa($_POST['id_diagnosa']);
} else if (isset($_POST['btSave'])) {
    updateDiagnosa($_POST['id_pendaftaran']);
    updatePendaftaranStatus($_POST['id_pendaftaran']);
    header("Location: diagnosa.php");
}

// Hapus Diagnosa



// Deklarasi no Pendaftaran dan NIK
$id_pendaftaran = $_POST['id_pendaftaran'];
// $result = query("SELECT nik from pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE id_pendaftaran = $id_pendaftaran")[0];
$nama = $_POST['nama'];


// Select diagnosa

$diagnosa = query("SELECT * FROM diagnosa WHERE id_pendaftaran = '$id_pendaftaran' AND status = '1'");

// data
$gcs = $_POST['gcs'];
$tensi = $_POST['tensi'];
$nacl = $_POST['nacl'];
$respirasi = $_POST['respirasi'];
$suhu = $_POST['suhu'];
$penunjang = $_POST['penunjang'];
$gns = $_POST['gns'];
$au = $_POST['au'];
$choresterol = $_POST['choresterol'];
$lain = $_POST['lain'];

$kumpulanData = $gcs . ';' . $tensi . ';' . $nacl . ';' . $respirasi . ';' . $suhu . ';' . $penunjang . ';' . $gns . ';' . $au . ';' . $choresterol . ';' . $lain;
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kilink Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">
    <link rel="stylesheet" href="p.css">

    <!-- JQuery TimeStamp -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>

    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>
        input,
        select,
        textarea {
            background-color: #fff;
            border: 1px solid #8378a9;
            color: black;
            border-radius: 5px;
        }

        input {
            padding-left: 10px;
        }


        table,
        th,
        td {
            border: 1px solid #57358d;
        }

        th {
            height: 30px;
            text-align: center;
            font-weight: bold;
            font-size: 24px;
        }

        textarea {
            width: 200px;
        }

        .link-BC a:link {
            text-decoration: none;
            color: #6B59AE;
        }

        .link-BC a:visited {
            text-decoration: none;
            color: #6B59AE;
        }

        /* style auto complate */


        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .autocomplete-selected {
            background: #F0F0F0;
        }

        .autocomplete-suggestions strong {
            font-weight: normal;
            color: #3399FF;
        }

        .autocomplete-group {
            padding: 2px 5px;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }
    </style>
</head>

<body class="text-dark" style="background-color: #c4b8e7;">
    <nav class="navbar navbar-expand-lg ps-4 pe-4" style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
                <li class="nav-item me-5 btn" style="background-color: #61529A; border-radius: 3px; width: 150px; text-align: center;">
                    <a href="pendaftaran.php" class="nav-link active" aria-current="page" style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">PENDAFTARAN</a>
                </li>
                <li class=" nav-item me-5 btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px">
                    <a href="obat.php" class="nav-link" style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">OBAT</a>
                </li>
                <li class="nav-item me-5 btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px">
                    <a href="pasien.php" class="nav-link" style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">PASIEN</a>
                </li>
                <li class=" nav-item btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px">
                    <a href="laporan.php" class="nav-link" style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">LAPORAN</a>
                </li>
            </ul>
        </div>
        <a href="#" class=""><img src="../img/Logo Klinik.png" width="100" height="100" style="margin-right: 20px" /></a>
    </nav>
    <div class="container-fluid ps-5 pe-5 link-BC">
        <div class="row pt-3 container-fluid ms-1">
            <div class='col-7'>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb fw-bold fs-4">
                        <li class="breadcrumb-item" style="color: #8471C9 ; font-family: 'Roboto Mono', monospace; font-weight:700;"> <a href="pendaftaran.php">DATA PASIEN</a></li>
                        <li class="breadcrumb-item active" style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:900;">DIAGNOSA</li>
                        <li class="breadcrumb-item" style="color: #8471C9 ; font-family: 'Roboto Mono', monospace; font-weight:700;"><a href="pendaftaranObat.php">OBAT</a></li>
                    </ol>
                </nav>
            </div>
            <div class='col-5 align-top mt-3 '>
                <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>
            </div>
        </div>
        <div class='mt-2 mb-2 ms-5'>
            <h4 class="me-3" style="font-family: 'Roboto Mono', monospace; font-weight:500;">NAMA : <?= $nama ?></h4>
        </div>
        <div class="container-fluid" style="background-color: #fff; padding: 10px; box-sizing: border-box; 
        border-radius: 3px;">
            <div class='mb-5'>
                <form action="" method="post">
                    <!-- Table 1 -->
                    <table cellspacing='0' cellpadding='5'>
                        <!--HEAD -->
                        <tr>
                            <th style="width: 20%;">S</th>
                            <th colspan="2" style="width: 30%;">O</th>
                            <th style=" width: 5%;">A</th>
                            <th colspan="3" style="width: 5%;">P</th>
                        </tr>
                        <!-- data pertama -->
                        <tr>
                            <td rowspan="10" class="tds">
                                <h6><?= $_POST['S'] ?><input type="hidden" name="S" value="<?= $_POST['S'] ?>"></h6>
                            </td>
                            <td class="tdo">
                                <h6>GCS :</h6>
                            </td>
                            <td class="tdo1">
                                <h6><?= $_POST['gcs'] ?></h6>
                            </td>
                            <td rowspan="10" class="tda">
                                <label for='diagnosa' style="font-family: 'Roboto Mono', monospace; font-weight:450;">Diagnosa</label><br>
                                <input type='text' name='diagnosa' id='diagnosa' style="width: 100px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;">
                            </td>
                            <td rowspan="10" colspan="2" class="tdp">
                                <label for='nama_obat' style="font-family: 'Roboto Mono', monospace; font-weight:450;">Nama Obat</label><br>
                                <input type='text' name='nama_obat' id='nama_obat' style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;">
                            </td>
                            <td rowspan="10" class="tdp">
                                <label for='jumlah' style="font-family: 'Roboto Mono', monospace; font-weight:450; text-align:center;">Jumlah</label><br>
                                <input type='text' name='jumlah' id='jumlah' style="width: 100px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400; ">
                            </td>
                        </tr>
                        <!-- Data No 2 -->
                        <tr>
                            <td class="tdo">
                                <h6>Tensi :</h6>
                            </td>
                            <td class="tdo1">
                                <h6> <?= $_POST['tensi'] ?></h6>
                            </td>
                        </tr>
                        <!-- Data No 3 -->
                        <tr>
                            <td class="tdo">
                                <h6>NACL :</h6>
                            </td>
                            <td class="tdo1">
                                <h6> <?= $_POST['nacl'] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>Respirasi Rate :</h6>
                            </td>
                            <td class="tdo1">
                                <h6> <?= $_POST['respirasi'] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>Suhu :</h6>
                            </td>
                            <td class="tdo1">
                                <h6> <?= $_POST['suhu'] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>Pemeriksaan Penunjang :</h6>
                            </td>
                            <td class="tdo1">
                                <h6> <?= $_POST['penunjang'] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>GNS :</h6>
                            </td>
                            <td class="tdo1">
                                <h6> <?= $_POST['gns'] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>AU :</h6>
                                <h6>
                            </td>
                            <td class="tdo1"><?= $_POST['au'] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>Choresterol :</h6>
                            </td>
                            <td class="tdo1">
                                <h6> <?= $_POST['choresterol'] ?></h6>
                            </td>

                        </tr>
                        <!-- Data No Last -->
                        <tr>
                            <td class="tdo">
                                <h6>lain-lain :</h6>
                            </td>
                            <td class="tdo1">
                                <h6> <?= $_POST['lain'] ?></h6>
                            </td>

                        </tr>
                    </table>
                    <input type="hidden" name="gcs" id="gcs" style="width: 270px;" value="<?= $_POST['gcs'] ?>" require>
                    <input type="hidden" name="tensi" id="tensi" style="width: 270px;" value="<?= $_POST['tensi'] ?>" require>
                    <input type="hidden" name="nacl" id="nacl" style="width: 270px;" value="<?= $_POST['nacl'] ?>" require>
                    <input type="hidden" name="respirasi" id="respirasi" style="width: 270px;" value="<?= $_POST['respirasi'] ?>" require>
                    <input type="hidden" name="suhu" id="suhu" style="width: 270px;" value="<?= $_POST['suhu'] ?>" require>
                    <input type="hidden" name="penunjang" id="penunjang" style="width: 270px;" value="<?= $_POST['penunjang'] ?>" require>
                    <input type="hidden" name="gns" id="gns" style="width: 270px;" value="<?= $_POST['gns'] ?>" require>
                    <input type="hidden" name="au" id="au" style="width: 270px;" value="<?= $_POST['au'] ?>" require>
                    <input type="hidden" name="choresterol" id="choresterol" style="width: 270px;" value="<?= $_POST['choresterol'] ?>" require>
                    <input type="hidden" name="lain" id="lain" style="width: 270px;" value="<?= $_POST['lain'] ?>" require>
                    <input type="hidden" name="O" id="O" style="width: 270px;" value="<?= $kumpulanData ?>" require>
                    <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                    <input type="hidden" name="nama" value="<?= $nama ?>">
                    <input type="hidden" name="status" value="1">

                    <!-- buuton -->
                    <td colspan="4" class="p-2"><button type="submit" name="btTambah" class="ms-2 bg-primary fw-bold text-light float-end me-3" style="width: 110px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;"> ADD <img src="../img/plus.png" width="20px" height="20px" class="mb-1">
                        </button></td>
                </form>

                <table cellspacing='0' cellpadding='5' style="margin-top:90px">
                    <tr>
                        <th style="width: 10%;">S</th>
                        <th colspan="2" style="width: 25%;">O</th>
                        <th style=" width: 20%;">A</th>
                        <th colspan="3" style="width: 20%;">P</th>
                    </tr>

                    <?php $i = 0;  ?>
                    <?php foreach ($diagnosa as $row): ?>
                        <tr>
                            <td rowspan="10" class="tds">
                                <h6><?= $row['s'] ?></h6>
                            </td>
                            <?php
                            if ($i == 0) {
                                $pisah = explode(';', $row['o']);
                            ?>
                                <td class="tdo">
                                    <h6>GCS :</h6>
                                </td>
                                <td class="tdo1">
                                    <h6><?= $pisah[0] ?></h6>
                                </td>
                            <?php }else{ ?>
                                <td class="tdo">
                                </td>
                                <td class="tdo1">
                                </td>
                            <?php } ?>
                                <td class="tda">
                                    <?php
                                    $a = $row["a"];
                                    ?>
                                    <h6><?= $a ?></h6>
                                </td>
                                <td colspan="2" class="tdp">
                                    <h6><?= $row['p'] ?></h6>
                                </td>
                                <td class="tdp">
                                    <h6><?= $row['jumlah'] ?></h6>
                                </td>
                        </tr>
                        <?php
                            if ($i == 0) {
                                $pisah = explode(';', $row['o']);
                            ?>
                        <tr>
                            <td class="tdo">
                                <h6>Tensi :</h6>
                            </td>
                            <td class="tdo1">
                                <h6><?= $pisah[1] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>NACL :</h6>
                            </td>
                            <td class="tdo1">
                                <h6><?= $pisah[2] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>Respirasi Rate :</h6>
                            </td>
                            <td class="tdo1">
                                <h6><?= $pisah[3] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>Suhu :</h6>
                            </td>
                            <td class="tdo1">
                                <h6><?= $pisah[4] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>Pemeriksaan Penunjang :</h6>
                            </td>
                            <td class="tdo1">
                                <h6><?= $pisah[5] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>GNS :</h6>
                                <h6>
                            </td>
                            <td class="tdo1"><?= $pisah[6] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>AU :</h6>
                                <h6>
                            </td>
                            <td class="tdo1"><?= $pisah[7] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>Choresterol :</h6>
                            </td>
                            <td class="tdo1">
                                <h6><?= $pisah[8] ?></h6>
                            </td>

                        </tr>
                        <tr>
                            <td class="tdo">
                                <h6>Lain - Lain :</h6>
                            </td>
                            <td class="tdo1">
                                <h6><?= $pisah[9] ?></h6>
                            </td>

                        </tr>
                        <?php
                        } else { 
                        ?>
                        <tr>
                            <td class="tdo"></td>
                            <td class="tdo1"> </td>

                        </tr>
                        <tr>
                            <td class="tdo"></td>
                            <td class="tdo1"></td>

                        </tr>
                        <tr>
                            <td class="tdo"></td>
                            <td class="tdo1"></td>

                        </tr>
                        <tr>
                            <td class="tdo"></td>
                            <td class="tdo1"></td>

                        </tr>
                        <tr>
                            <td class="tdo"></td>
                            <td class="tdo1"></td>

                        </tr>
                        <tr>
                            <td class="tdo"></td>
                            <td class="tdo1"></td>

                        </tr>
                        <tr>
                            <td class="tdo"></td>
                            <td class="tdo1"></td>

                        </tr>
                        <tr>
                            <td class="tdo"></td>
                            <td class="tdo1"></td>

                        </tr>
                        <tr>
                            <td class="tdo"></td>
                            <td class="tdo1"></td>

                        </tr>
                    <?php }
                    ?>
                    
                </Table>


                    <div class='float-end me-2'>
                        <form action="" method="post">
                            <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                            <input type="hidden" name="nama" value="<?= $nama ?>">
                            <input type="hidden" name="S" value="<?= $_POST['S'] ?>">
                            <input type="hidden" name="id_diagnosa" value="<?= $row['id_diagnosa'] ?>">
                            <input type="hidden" name="gcs" id="gcs" style="width: 270px;" value="<?= $_POST['gcs'] ?>" require>
                            <input type="hidden" name="tensi" id="tensi" style="width: 270px;" value="<?= $_POST['tensi'] ?>" require>
                            <input type="hidden" name="nacl" id="nacl" style="width: 270px;" value="<?= $_POST['nacl'] ?>" require>
                            <input type="hidden" name="respirasi" id="respirasi" style="width: 270px;" value="<?= $_POST['respirasi'] ?>" require>
                            <input type="hidden" name="suhu" id="suhu" style="width: 270px;" value="<?= $_POST['suhu'] ?>" require>
                            <input type="hidden" name="penunjang" id="penunjang" style="width: 270px;" value="<?= $_POST['penunjang'] ?>" require>
                            <input type="hidden" name="gns" id="gns" style="width: 270px;" value="<?= $_POST['gns'] ?>" require>
                            <input type="hidden" name="au" id="au" style="width: 270px;" value="<?= $_POST['au'] ?>" require>
                            <input type="hidden" name="choresterol" id="choresterol" style="width: 270px;" value="<?= $_POST['choresterol'] ?>" require>
                            <input type="hidden" name="lain" id="lain" style="width: 270px;" value="<?= $_POST['lain'] ?>" require>
                            <input type="hidden" name="O" id="O" style="width: 270px;" value="<?= $kumpulanData ?>" require>
                            <button type="submit" name="btHapus" style=" width: 120px; height: 30px; margin-left: 110px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;" class="bg-danger fw-bold text-light">DELETE<img src="../img/dell.png" width="17px" height="17px" class="mb-1 ms-1"></button>
                        </form>
                    </div>
                    <?php $i++;  ?>
                <?php endforeach; ?>
                <div class='float-end mt-2'>
                    <div class='float-end me-3'>
                        <form action="" method="post">
                            <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                            <button type="submit" name="btSave" class="ms-2 bg-primary fw-bold text-light" style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;"> SAVE <img src="../img/send.png" width="17px" height="17px" class="mb-1">
                    </div></button>
                    </form>
                </div>
                <div class='float-end me-3 mt-2'>
                    <form action="diagnosaTindakan.php" method="post">
                        <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                        <button type="submit" onclick="top.location='diagnosa.php'" class="bg-success fw-bold text-light" style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;">BACK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- JS TimeStamp -->
    <script>
        $(function() {
            setInterval(timestamp, 1000);
        });

        function timestamp() {
            $.ajax({
                url: 'ajax_timestamp.php',
                success: function(data) {
                    $('#timestamp').html(data);
                },
            });
        }
    </script>

    <!-- Memanggil jQuery.js -->
    <script src="jquery-3.2.1.min.js"></script>

    <!-- Memanggil Autocomplete.js -->
    <script src="jquery.autocomplete.min.js"></script>


    <!-- Script auto complate Nama_obat-->

    <script>
        $(document).ready(function() {
            $("#diagnosa").autocomplete({
                serviceUrl: 'autoComplateCodeDiagnosa.php',
                dataType: 'JSON',
                onSelect: function(suggestion) {
                    $('#diagnosa').val("" + suggestion.code),
                        $('#diagnosa').val("" + suggestion.code);
                }
            });
        });
    </script>

    <!-- Script auto complate Diagnosa-->

    <script>
        $(document).ready(function() {
            $("#nama_obat").autocomplete({
                serviceUrl: 'autoComplateNamaObat.php',
                dataType: 'JSON',
                onSelect: function(suggestion) {
                    $('#nama_obat').val("" + suggestion.nama_obat);
                }
            });
        });
    </script>



    <!-- script JS Diagnosa -->
    <script src="scriptDiagnosa.js"></script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>
</html>