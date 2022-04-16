<?= $this->extend('layout/template'); ?>

<?php

date_default_timezone_set('Asia/Jakarta');
$tanggal = date("Y-m-d");
?>



<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('pesan')) : ?>
<div class="alert alert-success mt-3" role="alert">
    <?= session()->getFlashdata('pesan'); ?>
</div>
<?php
    header("refresh:2;url=/"); //5 : detik
endif;
?>
<div class="container-fluid" style="background-color: #fff; border-radius: 2px;">
    <form action="pendaftaran/save" method="post">
        <div class="bodyForm">
            <table style="width: 100%;">
                <tr>
                    <th style="width: 20%;"></th>
                    <th style="width: 30%;"></th>
                    <th style="width: 20%;"></th>
                    <th style="width: 30%;"></th>
                </tr>
                <tr>
                    <td><label class="me-5" style="font-family: 'Roboto Mono', monospace; font-weight:750;">BPJS</label>
                    </td>
                    <td>
                        <input type="radio" name="bpjs" name="bpjs" value="BPJS" class="me-1" id="rd1"
                            onclick="checkButton()">
                        <label for="rd1" class="me-2">Iya</label>
                        <input type="radio" name="bpjs" value="Umum" class="me-1" id="rd2" onclick="checkButton()">
                        <label for="rd2">Tidak</label>
                    </td>
                    <td><label for="dokter"
                            style="font-family: 'Roboto Mono', monospace; font-weight:750;">Dokter</label></td>
                    <td><select name="dokter" id="dokter" style="width: 270px;"
                            style="width: 270px; font-family: 'Roboto Mono', monospace; font-weight:550;" require>
                            <option value="dr. Yohanes Ary Prayoga">dr. Yohanes Ary Prayoga</option>
                            <option value="dr. Yudha Erik Prabowo">dr. Yudha Erik Prabowo</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="noBPJS" id="noBpjs"
                            style="font-family: 'Roboto Mono', monospace; font-weight:750;">No. BPJS</label>
                    </td>
                    <td><input type="text" name="noBPJS" id="noBPJS" style="width: 270px; display: none;"></td>
                    <td><label for="tindakan"
                            style="font-family: 'Roboto Mono', monospace; font-weight:750;">Tindakan</label>
                    </td>
                    <td><select name="tindakan" id="tindakan" style="width: 270px;"
                            style="width: 270px; font-family: 'Roboto Mono', monospace; font-weight:550;" require>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Kecantikan">Poli Kecantikan</option>
                            <option value="Fisioterapi">Fisioterapi</option>
                            <option value="Rawat Luka">Rawat Luka</option>
                            <option value="KIA">KIA (Bidan)</option>
                            <option value="Antigen">Antigen</option>
                            <option value="PCR">PCR</option>
                        </select>
                        <input type="hidden" value="<?= $tanggal ?>" name="tanggal">
                    </td>
                </tr>
                <tr>
                    <td><label for="nik" style="font-family: 'Roboto Mono', monospace; font-weight:750;">NIK</label>
                    </td>
                    <td>
                        <input type="text" name="nik" id="nik" style="width: 270px; display: none;">
                        <div class="kotakHasil" id="hasilPencarian" style="display: none;">
                            <div class="daftarPencarian" id="dataPencarian"></div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="ceknama" id="ceknama" value="Umum" onclick="cekNama()">
                        Tidak Membawa KTP & BPJS</td>
                    <td><input type="text" name="nama" id="nama" style="width: 270px; display: none;"></td>
                    <td><input type="hidden" name="status" value="1"></td>
                    <td class="fw-bold text-light">
                        <button type="reset" name="btReset"
                            style="margin-left: 110px; font-family: 'Roboto Mono', monospace; font-weight:550;"
                            class="bg-danger fw-bold text-light">RESET <img src="../img/dell.png" width="25px"
                                height="25px" class="mb-1"> </button>
                        <button type="submit"
                            style="margin-left: 110px; font-family: 'Roboto Mono', monospace; font-weight:550;"
                            class="ms-2 bg-primary fw-bold text-light">KIRIM<img src="../img/send.png" width="17px"
                                height="17px" class="mb-1 ms-1">
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>

<!-- Script auto complate NIK-->
<script>
$(document).ready(function() {
    $("#nik").autocomplete({
        serviceUrl: '/php/autoComplateNikPendaftaran.php',
        dataType: 'JSON',
        onSelect: function(suggestion) {
            $('#nik').val("" + suggestion.nik);
        }
    });
});
</script>


<!-- Script auto complate No BPJS-->

<script>
$(document).ready(function() {
    $("#noBPJS").autocomplete({
        serviceUrl: '/php/autoComplateNoBpjs.php',
        dataType: 'JSON',
        onSelect: function(suggestion) {
            $('#noBPJS').val("" + suggestion.no_bpjs);
        }
    });
});
</script>
<!-- auto Complate Nama -->

<script>
$(document).ready(function() {
    $("#nama").autocomplete({
        serviceUrl: '/php/autocomplatenama.php',
        dataType: 'JSON',
        onSelect: function(suggestion) {
            $('#nama').val("" + suggestion.nama);
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
<!-- script JS Pendaftaran -->
<script>
function checkButton() {
    if (document.getElementById('rd2').checked) {
        document.getElementById('noBPJS').style.display = "none";
        document.getElementById('nik').style.display = "";
    } else if (document.getElementById('rd1').checked) {
        document.getElementById('noBPJS').style.display = "";
        document.getElementById('nik').style.display = "none";
    }
}
</script>

<!-- script cek NAMA -->
<script>
function cekNama() {
    if (document.getElementById('ceknama').checked) {
        document.getElementById('nama').style.display = "";
        if (document.getElementById('rd2').checked) {
            document.getElementById('rd2').checked = false;
            document.getElementById('nik').style.display = "none";
        } else if (document.getElementById('rd1').checked) {
            document.getElementById('rd1').checked = false;
            document.getElementById('noBPJS').style.display = "none";
        }
    } else {
        document.getElementById('nama').style.display = "none";
    }
}
</script>
<?= $this->endSection(); ?>