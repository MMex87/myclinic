<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div>
        <h2 style=" font-family: 'Roboto Mono', monospace; font-weight:500;">List Pendaftaran</h2>
    </div>
    <div class='p-2 mb-5' style="background-color: #fff; border-radius: 2px;">
        <table class="table">
            <tr class="p-2 align-baseline"
                style=" font-family: 'Roboto Mono', monospace; font-weight:900; border-bottom: black solid 2px;">
                <th scope="col">#</th>
                <th scope="col">No RM</th>
                <th scope="col">NAMA</th>
                <th scope="col">NIK</th>
                <th scope="col">TINDAKAN</th>
                <th scope="col">DOKTER</th>
                <th scope="col">KETERANGAN</th>
                <th scope="col">AKSI</th>
                <th scope="col"></th>
            </tr>
            <?php $a = 1; ?>
            <?php foreach ($pasien->getResultArray() as $row) : ?>
            <tr class="p-2 align-baseline" style=" font-family: 'Roboto Mono', monospace; font-weight:390;">
                <td style="font-family: 'Roboto Mono', monospace; font-weight:900;"><?= $a ?></td>
                <td><?= $row['no_rm'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['nik'] ?></td>
                <td><?= $row['tindakan'] ?></td>
                <td><?= $row['nama_dokter'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td>
                    <input type="hidden" name="id_pendaftaran" value="<?= $row['id_pendaftaran'] ?>">
                    <button type="submit" name="btTindakan" class="button bg-primary text-light"
                        onclick="top.location='diagnosa/tindakan/<?= $row['id_pendaftaran'] ?>'"
                        style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffffff;">
                        TINDAKAN </button>
                </td>
                <form action="/diagnosa/delete/<?= $row['id_pendaftaran']; ?>" class="d-inline" method="post">
                    <input type="hidden" value="DELETE" name="_method">
                    <td><button type="submit" name="btHapus"
                            style="margin-left: 50px; height: 40px; width: 130px; font-family: 'Roboto Mono', monospace; font-weight:550;"
                            class="bg-danger fw-bold text-light" onclick="return confirm('Hapus Data?')">DELETE <img
                                src="../img/dell.png" width="17px" height="17px" class="mb-1"> </button></td>
                </form>
            </tr>
            <?php $a++; ?>
            <?php endforeach; ?>
        </table>
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

<?= $this->endSection(); ?>