<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class='p-2'>
        <h2 style=" font-family: 'Roboto Mono', monospace; font-weight:500;">List Pendaftaran Obat</h2>
    </div>
    <div class='p-2 mb-3' style="background-color: #fff; border-radius: 3px;">
        <table class="table">
            <tr class="p-2 align-baseline"
                style=" font-family: 'Roboto Mono', monospace; font-weight:900; border-bottom: black solid 2px;">
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">NIK</th>
                <th scope="col">Tindakan</th>
                <th scope="col">Dokter</th>
                <th scope="col">Aksi</th>
                <th scope="col"></th>
            </tr>
            <?php $a = 1; ?>
            <?php foreach ($pasien->getResultArray() as $row) : ?>
            <form action="pendaftaranTindakanObat.php" method="post">
                <tr class="p-2 align-baseline" style=" font-family: 'Roboto Mono', monospace; font-weight:390;">
                    <td style="font-family: 'Roboto Mono', monospace; font-weight:900;"><?= $a ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['nik'] ?></td>
                    <td><?= $row['tindakan'] ?></td>
                    <td><?= $row['nama_dokter'] ?> <input type="hidden" name="id_pendaftaran"
                            value="<?= $row['id_pendaftaran'] ?>"></td>
                    <td><button type="submit" name="btTindakan" class=" button bg-primary text-light"
                            style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffffff;">
                            TINDAKAN <img src="../img/send.png" width="17px" height="17px" class="mb-1"></button></td>
            </form>
            <form action="" method="post">
                <input type="hidden" name="id_pendaftaran" value="<?= $row['id_pendaftaran'] ?>">
                <td><button type="submit" name="btHapus"
                        style="margin-left: 110px; font-family: 'Roboto Mono', monospace; font-weight:550;"
                        class="bg-danger fw-bold text-light">DELETE <img src="../img/dell.png" width="25px"
                            height="25px" class="mb-1"> </button></td>
                <?php $a++; ?>
                </tr>
            </form>
            <?php endforeach; ?>
        </table>
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