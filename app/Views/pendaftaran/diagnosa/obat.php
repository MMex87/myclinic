<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class='mt-2 mb-2 ms-5'>
    <h4 class="me-3" style="font-family: 'Roboto Mono', monospace; font-weight:500;">NAMA : <?= $nama ?></h4>
</div>

<div class="container-fluid p-3" style="background-color: #eee; padding-top:4px; margin-right:20px;box-sizing: border-box; 
        border-radius: 2px;">
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
                        <div class='float-start ps-3 mb-3'>
                            <label for='diagnosa'
                                style="font-family: 'Roboto Mono', monospace; font-weight:450;">Diagnosa</label><br>
                            <input type='text' name='diagnosa' id='diagnosa'
                                style="width: 100px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;">
                        </div>
                    </td>

                    <td rowspan="10">
                        <div class='float-start ps-3 mb-3'>
                            <label for='nama_obat' style="font-family: 'Roboto Mono', monospace; font-weight:450;"
                                class="mb-1">Nama Obat</label><br>
                            <input type='text' name='nama_obat' id='nama_obat' class="mb-3"
                                style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;">

                            <label for='jumlah' class="mb-1"
                                style="font-family: 'Roboto Mono', monospace; font-weight:450; text-align:center;">Jumlah</label><br>
                            <input type='text' name='jumlah' class="mb-3" id='jumlah'
                                style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400; ">

                            <label for='pemakaian' class="mb-1"
                                style="font-family: 'Roboto Mono', monospace; font-weight:450; text-align:center;">Pemakaian</label><br>
                            <input type='text' name='pemakaian' class="mb-3" id='pemakaian'
                                style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;"
                                placeholder=".. x ..">

                            <label for='satuan' class="mb-1"
                                style="font-family: 'Roboto Mono', monospace; font-weight:450; text-align:center;">Satuan</label><br>
                            <select name='satuan' class="mb-3" id='satuan'
                                style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;">
                                <option value="Kapsul">Kapsul</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Botol">Botol</option>
                                <option value="Bungkus">Bungkus</option>
                            </select>

                            <label for='aturan' class="mb-1"
                                style="font-family: 'Roboto Mono', monospace; font-weight:450; text-align:center;">Aturan</label><br>
                            <select name='aturan' id='aturan'
                                style="width: 200px; padding-bottom:3px; font-family: 'Roboto Mono', monospace; font-weight:400;">
                                <option value="Sesudah">Sesudah</option>
                                <option value="Sebelum">Sebelum</option>
                                <option value="Pada_saat">Pada Saat</option>
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
            <input type="hidden" name="respirasi" id="respirasi" style="width: 270px;"
                value="<?= $_POST['respirasi'] ?>" require>
            <input type="hidden" name="suhu" id="suhu" style="width: 270px;" value="<?= $_POST['suhu'] ?>" require>
            <input type="hidden" name="penunjang" id="penunjang" style="width: 270px;"
                value="<?= $_POST['penunjang'] ?>" require>
            <input type="hidden" name="gns" id="gns" style="width: 270px;" value="<?= $_POST['gns'] ?>" require>
            <input type="hidden" name="au" id="au" style="width: 270px;" value="<?= $_POST['au'] ?>" require>
            <input type="hidden" name="choresterol" id="choresterol" style="width: 270px;"
                value="<?= $_POST['choresterol'] ?>" require>
            <input type="hidden" name="lain" id="lain" style="width: 270px;" value="<?= $_POST['lain'] ?>" require>
            <input type="hidden" name="O" id="O" style="width: 270px;" value="<? // $kumpulanData 
                                                                                ?>" require>
            <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
            <input type="hidden" name="nama" value="<?= $nama ?>">
            <input type="hidden" name="status" value="1">
            <!-- buuton -->
            <button type="submit" name="btTambah" class="button bg-primary text-light"
                style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff; float:right; margin-right:110px; margin-top:7px">
                ADD </button>
        </form>

        <table cellspacing='0' cellpadding='5' style="margin-top:90px; margin-bottom: 20px;">
            <tr>
                <th style=" width: 20%;">A</th>
                <th colspan="5" style="width: 20%;">P</th>
            </tr>
            <?php $i = 0;
            $diagnosa = [] ?>
            <?php foreach ($diagnosa as $row) : ?>
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
                    <form action="" method="post">
                        <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                        <input type="hidden" name="nama" value="<?= $nama ?>">
                        <input type="hidden" name="S" value="<?= $_POST['S'] ?>">
                        <input type="hidden" name="id_diagnosa" value="<?= $row['id_diagnosa'] ?>">
                        <input type="hidden" name="gcs" id="gcs" style="width: 270px;" value="<?= $_POST['gcs'] ?>"
                            require>
                        <input type="hidden" name="tensi" id="tensi" style="width: 270px;"
                            value="<?= $_POST['tensi'] ?>" require>
                        <input type="hidden" name="nacl" id="nacl" style="width: 270px;" value="<?= $_POST['nacl'] ?>"
                            require>
                        <input type="hidden" name="respirasi" id="respirasi" style="width: 270px;"
                            value="<?= $_POST['respirasi'] ?>" require>
                        <input type="hidden" name="suhu" id="suhu" style="width: 270px;" value="<?= $_POST['suhu'] ?>"
                            require>
                        <input type="hidden" name="penunjang" id="penunjang" style="width: 270px;"
                            value="<?= $_POST['penunjang'] ?>" require>
                        <input type="hidden" name="gns" id="gns" style="width: 270px;" value="<?= $_POST['gns'] ?>"
                            require>
                        <input type="hidden" name="au" id="au" style="width: 270px;" value="<?= $_POST['au'] ?>"
                            require>
                        <input type="hidden" name="choresterol" id="choresterol" style="width: 270px;"
                            value="<?= $_POST['choresterol'] ?>" require>
                        <input type="hidden" name="lain" id="lain" style="width: 270px;" value="<?= $_POST['lain'] ?>"
                            require>
                        <input type="hidden" name="O" id="O" style="width: 270px;" value="<?= $kumpulanData ?>" require>
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
                <form action="" method="post">
                    <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                    <button type="submit" name="btSave" class="ms-2 bg-primary fw-bold text-light"
                        style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;">
                        SAVE
            </div></button>
            </form>
        </div>
        <div class='float-end me-3 mt-2 mb-5'>
            <form action="diagnosaTindakan.php" method="post">
                <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                <button type="submit" onclick="top.location='diagnosa.php'" class="bg-success fw-bold text-light"
                    style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;">BACK</button>
            </form>
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

<?= $this->endSection(); ?>