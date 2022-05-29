<?= $this->extend('layout/template2'); ?>

<?= $this->section('content2'); ?>
<div class="container-fluid1 ps-5 pe-5">
    <div class="row pt-3 container-fluid ms-1">
        <div class='col-5'>
            <h1 style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:500;">LAPORAN</h1>
        </div>

        <div class='col-7 align-top mt-3'>
            <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>

        </div>
    </div>
</div>

<div class="container-satu">
    <div class="card">
        <div class="header">
            <p style="font-size: 40px;">PASIEN</p>
            <?php
            if ($pasien > 0) { ?>
            <P style="font-size: 70px;"> <?= $pasien ?> </P>
            <?php } else { ?>
            <P style="font-size: 70px;"> <?= 0 ?> </P>
            <?php } ?>
        </div>

        <div class="content">
            <p><a href="laporan/pasien" style="text-decoration: none; color: whitesmoke"> DETAIL </a> </p>
        </div>
    </div>
    <div class="card">
        <div class="header">
            <p> OBAT</p>
            <?php
            if ($obat > 0) { ?>
            <P style="font-size: 70px;"> <?= $obat ?> </P>
            <?php } else { ?>
            <P style="font-size: 70px;"> <?= 0 ?> </P>
            <?php } ?>

            <p style="font-size: 70px;"> <?= $obat ?></p>
        </div>
        <div class="content">
            <p> <a href="laporan/obat" style=" text-decoration: none; color: whitesmoke"> DETAIL </a> </p>
        </div>
    </div>
    <div class="card">
        <div class="header">
            <p>DIAGNOSA</p>
            <P style="font-size: 70px;"><?= $nama; ?> </P>
        </div>
        <div class="content">
            <p> <a href="/laporan/chartDiagnosa" style="text-decoration: none; color: whitesmoke"> DETAIL </a> </p>
        </div>
    </div>
    <div class="card">
        <div class="header">
            <p>PEMERIKSAAN</p>
        </div>
        <div class="content">
            <p> <a href="laporan/pemeriksaan" style="text-decoration: none; color: whitesmoke"> DETAIL </a> </p>
        </div>
    </div>

</div>

</body>

</html>

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