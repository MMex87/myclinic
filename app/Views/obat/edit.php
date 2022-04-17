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
        <form action="/obat/update/<?= $obat['id_obat']; ?>" method="post">
            <div class="bodyForm">

                <table style="width: 100%;">
                    <tr>
                        <th style="width: 20%;"></th>
                        <th style="width: 30%;"></th>
                        <th style="width: 20%;"></th>
                        <th style="width: 30%;"></th>
                    </tr>
                    <tr>
                        <!-- input id hidden -->
                        <input type="hidden" name="id_obat">
                        <input type="hidden" name="tanggalBel">
                        <td><label for="nama_obat"> Obat</label></td>
                        <td><input type="text" name="nama_obat" id="nama_obat" style="width: 270px;"
                                value="<?= (old('nama_obat')) ? old('nama_obat') : $obat['nama_obat'] ?>"> </td>

                        <td><label for=" jenis">Jenis</label></td>
                        <td><select name="jenis" id="jenis" style="width: 270px;">
                                <option value="Kapsul"
                                    <?= (old('jenis') == 'Kapsul') ? 'selected' : (($obat['jenis_obat'] == 'Kapsul') ? 'selected' : '') ?>>
                                    Kapsul
                                </option>
                                <option value="Tablet"
                                    <?= (old('jenis') == 'Tablet') ? 'selected' : (($obat['jenis_obat'] == 'Tablet') ? 'selected' : '') ?>>
                                    Tablet
                                </option>
                                <option value="Sendok"
                                    <?= (old('jenis') == 'Sendok') ? 'selected' : (($obat['jenis_obat'] == 'Sendok') ? 'selected' : '') ?>>
                                    Sendok
                                </option>
                                <option value="Bungkus"
                                    <?= (old('jenis') == 'Bungkus') ? 'selected' : (($obat['jenis_obat'] == 'Bungkus') ? 'selected' : '') ?>>
                                    Bungkus
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="jumlah_obat">Jumlah Obat</label></td>
                        <td><input type="text" name="jumlah_obat" id="jumlah_obat" style="width: 270px;"
                                value="<?= (old('jumlah_obat')) ? old('jumlah_obat') : $obat['jumlah_obat'] ?>"></td>

                        <td><label for="expired_date">Expired Date</label></td>
                        <td><input type="date" name="expired_date" id="expired_date" style="width: 270px;"
                                value="<?= (old('expired_date')) ? old('expired_date') : $obat['expired_date'] ?>"></td>

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