<?= $this->extend('layout/template2'); ?>


<?= $this->section('content2'); ?>
<div class="container-fluid1 ps-5 pe-5">
    <div class="row pt-3 container-fluid ms-1">
        <div class='col-5'>
            <h1 style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:500;">OBAT</h1>
        </div>
        <div class='col-7 align-top mt-3'>
            <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>
        </div>
    </div>
    <div class="container-fluid" style="background: #ffffff; border-radius: 3px;">
        <form action="/obat/save" method="post">
            <div class="bodyForm">
                <?php
                $waktu_sekarang = new DateTime();
                if (session()->getFlashdata('pesan') == 'Data Berhasil DiTambahkan') : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
                <?php
                    header("refresh:2;url=/obat"); //5 : detik
                endif; ?>

                <?php if (session()->getFlashdata('pesan') == 'Data Gagal Ditambahkan') : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
                <?php
                    header("refresh:2;url=/obat"); //5 : detik
                endif; ?>

                <table style="width: 100%;">
                    <tr>
                        <th style="width: 20%;"></th>
                        <th style="width: 30%;"></th>
                        <th style="width: 20%;"></th>
                        <th style="width: 30%;"></th>
                    </tr>
                    <tr>
                        <!-- input id hidden -->
                        <input type="hidden" name="tanggalBel" value="<?= $waktu_sekarang->format('Y-m-d') ?>">
                        <td><label for="nama_obat"> Obat</label></td>
                        <td><input type="text" name="nama_obat" id="nama_obat" style="width: 270px;"> </td>

                        <td><label for=" jenis">Jenis</label></td>
                        <td><select name="jenis" id="jenis" style="width: 270px;">
                                <option value="Kapsul">Kapsul
                                </option>
                                <option value="Tablet">Tablet
                                </option>
                                <option value="Sendok">Sendok
                                </option>
                                <option value="Bungkus">Bungkus
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="jumlah_obat">Jumlah Obat</label></td>
                        <td><input type="text" name="jumlah_obat" id="jumlah_obat" style="width: 270px;"></td>

                        <td><label for="expired_date">Expired Date</label></td>
                        <td><input type="date" name="expired_date" id="expired_date" style="width: 270px;"></td>

                    </tr>
                    <tr class="jenisUmur">
                        <td class="fw-bold text-light">
                            <button type="reset" name="btReset" style="margin-left: 4px;"
                                class="bg-danger fw-bold text-light"><img src="/img/refresh.png" width="20px"
                                    height="20px" class="mb-1"> RESET</button>
                            <button type="submit" name="btAdd" style="margin-left: 4px; margin-top: 10px;"
                                class="bg-primary fw-bold text-light"><img src="/img/save.png" width="20px"
                                    height="20px" class="mb-1"> SAVE</button>
                            <button type="button" name="btData" style="margin-left: 4px; margin-top: 10px;"
                                class="bg-info fw-bold text-light"><img src="/img/data.png" width="20px" height="20px"
                                    class="mb-1"><a href="/obat/data_obat" class="to_data"
                                    style="text-decoration: none; color:#ffffff;"> DATA </button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>


<!-- Memanggil jQuery.js -->
<script src="jquery-3.2.1.min.js"></script>

<!-- Memanggil Autocomplete.js -->
<script src="jquery.autocomplete.min.js"></script>


<!-- Script auto complate Nama_obat-->

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