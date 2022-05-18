<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php

// data
$gcs = $dataDiag['gcs'];
$tensi = $dataDiag['tensi'];
$nacl = $dataDiag['nacl'];
$respirasi = $dataDiag['respirasi'];
$suhu = $dataDiag['suhu'];
$penunjang = $dataDiag['penunjang'];
$gns = $dataDiag['gns'];
$au = $dataDiag['au'];
$choresterol = $dataDiag['choresterol'];
$lain = $dataDiag['lain'];

$kumpulanData = $gcs . ';' . $tensi . ';' . $nacl . ';' . $respirasi . ';' . $suhu . ';' . $penunjang . ';' . $gns . ';' . $au . ';' . $choresterol . ';' . $lain;
?>


<div class='mb-5 ms-5'>
    <h4 class="me-2 float-start" style="font-family: 'Roboto Mono', monospace; font-weight:450;">NAMA : </h4>
    <h4 class="float-start" style="font-family: 'Roboto Mono', monospace; font-weight:450;"><?= $nama ?></h4>
</div>
<div class="container-fluid p-3" style="background-color: #eee; padding-top:4px; margin-right:20px;box-sizing: border-box; 
        border-radius: 2px;">
    <div class='mb-5'>
        <form action="/diagnosa/save" method="post">
            <!-- Table 1 -->
            <table cellspacing='0' cellpadding='5'>
                <!--HEAD -->
                <tr id="th-atas">
                    <th style="width: 20%;">S</th>
                    <th colspan="2" style="width: 30%;">O</th>
                    <th style=" width: 5%;">A</th>
                    <th colspan="3" style="width: 5%;">P</th>
                </tr>
                <!-- data pertama -->
                <tr>
                    <td rowspan="10" class="tds">
                        <h6>
                            <?= (old('S')) ? old('S') : $dataDiag['S'] ?>
                            <input type="hidden" name="S" value="<?= (old('S')) ? old('S') : $dataDiag['S'] ?>">
                        </h6>
                    </td>
                    <td class="tdo">
                        <h6>GCS :</h6>
                    </td>
                    <td class="tdo1">
                        <h6><?= (old('gcs')) ? old('gcs') : $dataDiag['gcs'] ?></h6>
                    </td>
                    <td rowspan="10" class="tda">
                        <div class='float-start ps-3 mb-3'>
                            <label for='diagnosa'
                                style="font-family: 'Roboto Mono', monospace; font-weight:450;">Diagnosa</label><br>
                            <input type='text' name='diagnosa' value="<?= (old('diagnosa')) ? old('diagnosa') : '' ?>"
                                id='diagnosa'
                                style="width: 100px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;">
                        </div>
                    </td>

                    <td rowspan="10">
                        <div class='float-start ps-3 mb-3'>
                            <label for='nama_obat' style="font-family: 'Roboto Mono', monospace; font-weight:450;"
                                class="mb-1">Nama
                                Obat</label><br>
                            <input type='text' name='nama_obat'
                                value="<?= (old('nama_obat')) ? old('nama_obat') : ''; ?>" id='nama_obat' class="mb-3 "
                                style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;">

                            <label for='jumlah' class="mb-1"
                                style="font-family: 'Roboto Mono', monospace; font-weight:450; text-align:center;">Jumlah</label><br>
                            <input type='number' name='jumlah' value="<?= (old('jumlah')) ? old('jumlah') : 0; ?>"
                                class="mb-3 <?= ($validation->hasError('jumlah') ? 'is-invalid' : ''); ?>" id='jumlah'
                                style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400; ">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jumlah'); ?>
                            </div>
                            <label for='pemakaian' class="mb-1"
                                style="font-family: 'Roboto Mono', monospace; font-weight:450; text-align:center;">Pemakaian</label><br>
                            <input type='text' name='pemakaian'
                                value="<?= (old('pemakaian')) ? old('pemakaian') : ''; ?>" class="mb-3" id='pemakaian'
                                style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;"
                                placeholder=".. x ..">

                            <label for='satuan' class="mb-1"
                                style="font-family: 'Roboto Mono', monospace; font-weight:450; text-align:center;">Satuan</label><br>
                            <select name='satuan' class="mb-3" id='satuan'
                                style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;">
                                <option value="Kapsul" <?= (old('satuan') == "Kapsul") ? 'SELECTED' : ''; ?>>Kapsul
                                </option>
                                <option value="Tablet" <?= (old('satuan') == "Tablet") ? 'SELECTED' : ''; ?>>Tablet
                                </option>
                                <option value="Botol" <?= (old('satuan') == "Bottol") ? 'SELECTED' : ''; ?>>Botol
                                </option>
                                <option value="Bungkus" <?= (old('satuan') == "Bungkus") ? 'SELECTED' : ''; ?>>Bungkus
                                </option>
                            </select>

                            <label for='aturan' class="mb-1"
                                style="font-family: 'Roboto Mono', monospace; font-weight:450; text-align:center;">Aturan</label><br>
                            <select name='aturan' id='aturan'
                                style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;">
                                <option value="Sesudah" <?= (old('aturan') == "Sesudah") ? 'SELECTED' : ''; ?>>Sesudah
                                </option>
                                <option value="Sebelum" <?= (old('aturan') == "Sebelum") ? 'SELECTED' : ''; ?>>Sebelum
                                </option>
                                <option value="Pada_saat" <?= (old('aturan') == "Pada_saat") ? 'SELECTED' : ''; ?>>Pada
                                    Saat</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <!-- Data No 2 -->
                <tr>
                    <td class="tdo">
                        <h6>Tensi :</h6>
                    </td>
                    <td class="tdo1">
                        <h6> <?= (old('tensi')) ? old('tensi') : $dataDiag['tensi'] ?></h6>
                    </td>
                </tr>
                <!-- Data No 3 -->
                <tr>
                    <td class="tdo">
                        <h6>NACL :</h6>
                    </td>
                    <td class="tdo1">
                        <h6> <?= (old('nacl')) ? old('nacl') : $dataDiag['nacl'] ?></h6>
                    </td>

                </tr>
                <tr>
                    <td class="tdo">
                        <h6>Respirasi Rate :</h6>
                    </td>
                    <td class="tdo1">
                        <h6> <?= (old('respirasi')) ? old('respirasi') : $dataDiag['respirasi'] ?></h6>
                    </td>

                </tr>
                <tr>
                    <td class="tdo">
                        <h6>Suhu :</h6>
                    </td>
                    <td class="tdo1">
                        <h6> <?= (old('suhu')) ? old('suhu') : $dataDiag['suhu'] ?></h6>
                    </td>

                </tr>
                <tr>
                    <td class="tdo">
                        <h6>Pemeriksaan Penunjang :</h6>
                    </td>
                    <td class="tdo1">
                        <h6> <?= (old('penunjang')) ? old('penunjang') : $dataDiag['penunjang'] ?></h6>
                    </td>

                </tr>
                <tr>
                    <td class="tdo">
                        <h6>GNS :</h6>
                    </td>
                    <td class="tdo1">
                        <h6> <?= (old('gns')) ? old('gns') : $dataDiag['gns'] ?></h6>
                    </td>

                </tr>
                <tr>
                    <td class="tdo">
                        <h6>AU :</h6>
                        <h6>
                    </td>
                    <td class="tdo1"><?= (old('au')) ? old('au') : $dataDiag['au'] ?></h6>
                    </td>

                </tr>
                <tr>
                    <td class="tdo">
                        <h6>Choresterol :</h6>
                    </td>
                    <td class="tdo1">
                        <h6> <?= (old('choresterol')) ? old('choresterol') : $dataDiag['choresterol'] ?></h6>
                    </td>

                </tr>
                <!-- Data No Last -->
                <tr>
                    <td class="tdo">
                        <h6>lain-lain :</h6>
                    </td>
                    <td class="tdo1">
                        <h6> <?= (old('lain')) ? old('lain') : $dataDiag['lain'] ?></h6>
                    </td>

                </tr>
            </table>
            <input type="hidden" name="gcs" id="gcs" style="width: 270px;"
                value="<?= (old('gcs')) ? old('gcs') : $dataDiag['gcs'] ?>" require>
            <input type="hidden" name="tensi" id="tensi" style="width: 270px;"
                value="<?= (old('tensi')) ? old('tensi') : $dataDiag['tensi'] ?>" require>
            <input type="hidden" name="nacl" id="nacl" style="width: 270px;"
                value="<?= (old('nacl')) ? old('nacl') : $dataDiag['nacl'] ?>" require>
            <input type="hidden" name="respirasi" id="respirasi" style="width: 270px;"
                value="<?= (old('respirasi')) ? old('respirasi') : $dataDiag['respirasi'] ?>" require>
            <input type="hidden" name="suhu" id="suhu" style="width: 270px;"
                value="<?= (old('suhu')) ? old('suhu') : $dataDiag['suhu'] ?>" require>
            <input type="hidden" name="penunjang" id="penunjang" style="width: 270px;"
                value="<?= (old('penunjang')) ? old('penunjang') : $dataDiag['penunjang'] ?>" require>
            <input type="hidden" name="gns" id="gns" style="width: 270px;"
                value="<?= (old('gns')) ? old('gns') : $dataDiag['gns'] ?>" require>
            <input type="hidden" name="au" id="au" style="width: 270px;"
                value="<?= (old('au')) ? old('au') : $dataDiag['au'] ?>" require>
            <input type="hidden" name="choresterol" id="choresterol" style="width: 270px;"
                value="<?= (old('choresterol')) ? old('choresterol') : $dataDiag['choresterol'] ?>" require>
            <input type="hidden" name="lain" id="lain" style="width: 270px;"
                value="<?= (old('lain')) ? old('lain') : $dataDiag['lain'] ?>" require>
            <input type="hidden" name="O" id="O" style="width: 270px;" value="<?= $kumpulanData ?>" require>
            <input type="hidden" name="id_pendaftaran"
                value="<?= (old('id_pendaftaran')) ? old('id_pendaftaran') : $id_pendaftaran ?>">
            <input type="hidden" name="nama" value="<?= (old('nama')) ? old('nama') : $nama ?>">
            <input type="hidden" name="status" value="1">
            <!-- buuton -->
            <button type="submit" name="btTambah" class="button bg-primary text-light" style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  
                border: 2px solid #ffff; float:right; margin-right:110px; margin-top:7px"> ADD </button>
        </form>

        <!-- table bawah / hasil -->
        <table cellspacing='0' cellpadding='5' style="margin-top:90px; margin-bottom: 20px;">
            <tr id="th-bawah">
                <th style=" width: 20%;">A</th>
                <th colspan="5" style="width: 20%;">P</th>
            </tr>
            <?php $i = 0; ?>
            <?php foreach ($diagnosa->getResultArray() as $row) : ?>
            <tr>
                <td class="tds">
                    <h6><?= $row['a'] ?></h6>
                </td>
                <td class="tdp">
                    <h6><?= $row['p'] ?></h6>
                </td>
                <td class="tdp">
                    <h6><?= $row['jumlah'] ?></h6>
                </td>
                </td>
                <td class="tdp">
                    <h6><?= $row['pemakaian'] ?></h6>
                </td>
                <td class="tdp">
                    <h6><?= $row['aturan'] ?></h6>
                </td>
                <td class="tdp">
                    <form action="/diagnosa/obatDelete/<?= $row['id_diagnosa']; ?>" class="d-inline" method="post">
                        <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                        <input type="hidden" name="nama" value="<?= $nama ?>">
                        <input type="hidden" name="S" value="<?= $_POST['S'] ?>">
                        <input type="hidden" name="O" id="O" style="width: 270px;" value="<?= $kumpulanData ?>" require>
                        <input type="hidden" value="DELETE" name="_method">
                        <button type="submit" name="btHapus"
                            style=" width: 120px; height: 30px; margin-left: 110px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;"
                            class="bg-danger fw-bold text-light">DELETE</button>
                    </form>
                </td>
            </tr>
            <?php $i++;  ?>
            <?php endforeach; ?>
        </Table>
        <div class='float-end mt-2 mb-5' style="margin-right: 90px;">
            <div class='float-end me-3'>
                <form action="/diagnosa/selesai" method="post">
                    <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                    <button type="submit" name="btSave" class="ms-2 bg-primary fw-bold text-light"
                        style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;">
                        SAVE
                    </button>
                </form>
            </div>
        </div>
        <div class='float-end me-3 mt-2 mb-5'>
            <button type="submit" onclick="top.location='/diagnosa/tindakan/<?= $id_pendaftaran ?>'"
                class="bg-success fw-bold text-light"
                style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;">BACK</button>
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
        url: '/php/ajax_timestamp.php',
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
        serviceUrl: '/php/autoComplateCodeDiagnosa.php',
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
        serviceUrl: '/php/autoComplateNamaObat.php',
        dataType: 'JSON',
        onSelect: function(suggestion) {
            $('#nama_obat').val("" + suggestion.nama_obat);
        }
    });
});
</script>

<?= $this->endSection(); ?>