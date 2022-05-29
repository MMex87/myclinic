<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class='mt-2 mb-2 ms-5'>
    <h4 class="me-3">NAMA : <?= $nama ?></h4>
</div>
<div class="container-fluid" style="background-color: #fff; padding: 10px; box-sizing: border-box; 
        border-radius: 3px;">
    <div class='mb-5'>
        <form action="" method="post">
            <Table style="width: 100%;" id="countDiagnosaObat">
        </form>
        <tr>
            <th style="width: 20%;">Nama Obat</th>
            <th style="width: 15%;">Jumlah</th>
            <th style="width: 15%;">Pemakaian</th>
            <th style="width: 15%;">Satuan</th>
            <th style="width: 15%;">Aturan</th>
            <th style="width: 20%;">Selesai</th>
        </tr>

        <?php $i = 1 ?>
        <?php foreach ($pasien as $row) : ?>
        <form action="/sistemobat/save" method="post">
            <?php
                if ($row['p'] == null) { ?>
            <tr>
                <td>Tidak Pakai Obat</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td class="p-2">
                    <div class='float-start ms-2'>
                        <input type="checkbox" name="selesai" value="1">
                    </div>
                </td>
            </tr>
            <?php } else { ?>
            <tr>
                <td class="p-2">
                    <h6><?= $row['p'] ?></h6>
                    <input type="hidden" name="nama<?= $i ?>" value="<?= $row['p'] ?>">
                </td>
                </td>
                <td class="p-2">
                    <h6><?= $row['jumlah'] ?></h6>
                    <input type="hidden" name="jumlah<?= $i ?>" value="<?= $row['jumlah'] ?>">
                </td>
                <td class="p-2">
                    <h6><?= $row['pemakaian'] ?></h6>
                </td>
                <td class="p-2">
                    <h6><?= $row['satuan'] ?></h6>
                </td>
                <td class="p-2">
                    <h6><?= $row['aturan'] ?></h6>
                </td>
                <?php
                        foreach ($obat as $rows) {
                            if ($row['p'] == $rows['nama_obat']) {
                                $idObat = $rows['id_obat'];
                            }
                        }
                        ?>
                <input type="hidden" name="id_obat<?= $i ?>" value="<?= $idObat ?>">
                <td class="p-2">
                    <div class='float-start ms-2'>
                        <input type="checkbox" name="obat<?= $i ?>" value="<?= $i ?>">
                    </div>
                </td>
            </tr>
            <?php } ?>
            <?php $i++ ?>
            <?php endforeach;  ?>
            </Table>
            <div class='float-end mt-3'>
                <div class='float-end me-3'>
                    <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                    <button type="submit" name="btSave" class="ms-2 bg-primary fw-bold text-light"
                        style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffffff;">Save
                        <img src="../img/send.png" width="17px" height="17px" class="mb-1">
                </div></button>
        </form>
    </div>
    <div class='float-end me-3 mt-3'>
        <button type="button" onclick="top.location='/sistemobat'" class="bg-success fw-bold text-light"
            style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffffff;">Back
            <img src="../img/send.png" width="17px" height="17px" class="mb-1"></button>
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

<!-- script JS obat -->
<script>
function checkButton() {
    if (document.getElementById('obat').checked) {
        document.getElementById('noBPJS').style.display = "none";
    }
}
</script>

<?= $this->endSection(); ?>