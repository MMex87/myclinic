<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<?php
if ($diagnosa) {
    $jumlah = count($diagnosa) - 1;
    $tampil = $diagnosa[$jumlah];
    $pisah = explode(';', $tampil['o']);
} else {
    $data['s'] = "";
    $file[0] = "";
    $file[1] = "";
    $file[2] = "";
    $file[3] = "";
    $file[4] = "";
    $file[5] = "";
    $file[6] = "";
    $file[7] = "";
    $file[8] = "";
    $file[9] = "";
    $tampil = $data;
    $pisah = $file;
}

?>
<div class='mb-5 ms-5'>
    <h4 class="me-2 float-start" style="font-family: 'Roboto Mono', monospace; font-weight:450;">NAMA : </h4>
    <h4 class="float-start" style="font-family: 'Roboto Mono', monospace; font-weight:450;"><?= $nama ?></h4>
</div>
<div class="container-fluid" style="margin-bottom: 150px;" id="tindakan">
    <div class='mb-2'>
        <form action="/diagnosa/obat" method="post">
            <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
            <input type="hidden" name="nama" value="<?= $nama ?>">

            <Table style="width: 100%; background-color: #ffff; border-radius: 4px;">
                <tr style="align-items: center;">
                    <th style="width: 50% ;font-family: 'Roboto Mono', monospace; font-weight:900;">S</th>
                    <th style="width: 50%; font-family: 'Roboto Mono', monospace; font-weight:900;">O</th>
                </tr>
                <tr>
                    <td class="p-2"><textarea name="S" id="" cols="30" rows="10"
                            style="widfont-family: 'Roboto Mono', monospace; font-weight:500; width: 100%; height: 100%;"><?= $tampil['s']
                                                                                                                                                                                ?></textarea>
                    </td>
                    <td class="p-2">
                        <div class='float-start ps-2 mb-3'>
                            <label for="gcs">GCS</label><br>
                            <input type="text" name="gcs" id="gcs" style="width: 270px;" value="<?= $pisah[0] ?>"
                                require><br>
                            <label for="tensi">Tensi</label><br>
                            <input type="text" name="tensi" id="tensi" style="width: 270px;" value="<?= $pisah[1] ?>"
                                require><br>
                            <label for="nacl">NACL</label><br>
                            <input type="text" name="nacl" id="nacl" style="width: 270px;" value="<?= $pisah[2] ?>"
                                require><br>
                            <label for="respirasi">Respirasi Rate</label><br>
                            <input type="text" name="respirasi" id="respirasi" style="width: 270px;"
                                value="<?= $pisah[3] ?>" require><br>
                            <label for="suhu">Suhu</label><br>
                            <input type="text" name="suhu" id="suhu" style="width: 270px;" value="<?= $pisah[4] ?>"
                                require><br>
                        </div>
                        <div class='float-end pe-2 mb-3'>

                            <label for="penunjang">Pemeriksaan Penunjang</label><br>
                            <input type="text" name="penunjang" id="penunjang" style="width: 270px;"
                                value="<?= $pisah[5] ?>" require><br>
                            <label for="gns">GNS</label><br>
                            <input type="text" name="gns" id="gns" style="width: 270px;" value="<?= $pisah[6] ?>"
                                require><br>
                            <label for="au">AU</label><br>
                            <input type="text" name="au" id="au" style="width: 270px;" value="<?= $pisah[7] ?>"
                                require><br>
                            <label for="choresterol">Choresterol</label><br>
                            <input type="text" name="choresterol" id="choresterol" style="width: 270px;"
                                value="<?= $pisah[8] ?>" require><br>
                            <label for="lain">Lain - Lain</label><br>
                            <input type="text" name="lain" id="lain" style="width: 270px;" value="<?= $pisah[9] ?>"
                                require><br>
                        </div>
                    </td>
                </tr>
            </Table>
            <div class='float-end mt-3'>
                <button type="button" onclick="top.location='/diagnosa'" class="bg-success fw-bold text-light"
                    style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #c4b8e7;">
                    BACK <img src="/img/send.png" width="17px" height="17px" class="mb-1"> </button>
                <button type="submit" name="btNext" class="ms-2 bg-primary fw-bold text-light"
                    style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #c4b8e7;">
                    NEXT <img src="/img/send.png" width="17px" height="17px" class="mb-1">
            </div></button>
        </form>
    </div>
</div>

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

<?= $this->endSection(); ?>