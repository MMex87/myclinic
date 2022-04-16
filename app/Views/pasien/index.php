<?= $this->extend('layout/template2'); ?>

<?= $this->section('content2'); ?>

<div class="container-fluid1 ps-5 pe-5">
    <div class="row pt-3 container-fluid">
        <div class='col-7'>
            <h1 style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:500;">PASIEN</h1>
        </div>
        <div class='col-5 align-top mt-3'>
            <h4 class="ms-5 mt-1" id="timestamp" style="float: right;"></h4>
        </div>
    </div>
    <div class="container-fluid" style="background: #ffffff; border-radius: 3px;">
        <form action="/pasien/save" method="post">
            <div class="bodyForm">
                <!-- Alert -->
                <?php if (session()->getFlashdata('pesan') == 'Data Berhasil Ditambahkan') : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
                <?php
                    header("refresh:2;url=/pasien"); //5 : detik
                endif; ?>

                <?php if (session()->getFlashdata('pesan') == 'Data Gagal Ditambahkan') : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
                <?php
                    header("refresh:2;url=/pasien"); //5 : detik
                endif; ?>

                <!-- Inputan Data -->
                <table style="width: 100%;">
                    <tr>
                        <th style="width: 20%;"></th>
                        <th style="width: 30%;"></th>
                        <th style="width: 20%;"></th>
                        <th style="width: 30%;"></th>
                    </tr>
                    <!-- input id hidden -->
                    <tr>
                        <td><label for="noBPJS">No.BPJS</label></td>
                        <td>
                            <input type="text" name="noBPJS" id="noBPJS" style="width: 270px;" maxlength="13"
                                autocomplete="off" value="<?= old('noBPJS') ?>"
                                class="<?= ($validation->hasError('noBPJS') ? 'is-invalid' : ''); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('noBPJS'); ?>
                            </div>
                        </td>

                        <td><label for="nik">NIK</label></td>
                        <td>
                            <input type="text" name="nik" id="nik" style="width: 270px;" maxlength="16"
                                autocomplete="off" value="<?= old('nik') ?>"
                                class="<?= ($validation->hasError('nik') ? 'is-invalid' : ''); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nik'); ?>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td><label for="namaPasien">Nama</label></td>
                        <td><input type="text" name="namaPasien" id="namaPasien" style="width: 270px;"
                                value="<?= old('namaPasien') ?>"></td>

                        <td><label for="noHP">No HP</label></td>
                        <td><input type="text" name="noHP" id="noHP" style="width: 270px;" value="<?= old('noHP') ?>">
                        </td>

                    </tr>


                    <tr>
                        <td><label for="tanggalLahir">Tanggal Lahir</label></td>
                        <td><input type="date" name="tanggalLahir" id="tanggalLahir" style="width: 270px;"
                                value="<?= old('tanggalLahir') ?>"></td>

                        <td><label for="alamat">Alamat</label></td>
                        <td><input type="text" name="alamat" id="alamat" style="width: 270px;"
                                value="<?= old('alamat') ?>"></td>

                    </tr>

                    <tr>
                        <td><label for="jenisKelamin">Jenis Kelamin</label></td>
                        <td><select name="jenisKelamin" id="jenisKelamin" style="width: 270px;">
                                <option value="Laki Laki" <?= (old('jenisKelamin') == 'Laki Laki') ? 'selected' : "" ?>>
                                    Laki - Laki</option>
                                <option value="Perempuan" <?= (old('jenisKelamin') == 'Perempuan') ? 'selected' : "" ?>>
                                    Perempuan</option>
                            </select></td>
                        <td><label for="noRM">RM</label></td>
                        <td>
                            <input class="<?= ($validation->hasError('noRM') ? 'is-invalid' : ''); ?>" type="text"
                                name="noRM" id="noRM" style="width: 270px;" value="<?= old('noRM') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('noRM'); ?>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td class="fw-bold text-light">
                            <button type="reset" name="btReset" style="margin-left: 4px;"
                                class="bg-danger fw-bold text-light"><img src="../img/refresh.png" width="20px"
                                    height="20px" class="mb-1"> RESET</button>
                            <button type="submit" name="btAdd" style="margin-left: 4px; margin-top: 10px;"
                                class="bg-primary fw-bold text-light"><img src="../img/save.png" width="20px"
                                    height="20px" class="mb-1"> SAVE</button>
                            <button type="button" name="btData" style="margin-left: 4px; margin-top: 10px;"
                                class="bg-info fw-bold text-light"> <img src="../img/data.png" width="20px"
                                    height="20px" class="mb-1"> <a href="/pasien/data_pasien" class="to_data"
                                    style="text-decoration: none; color:#ffffff;"> DATA</a></button>
                        </td>
                    </tr>

                </table>
            </div>
        </form>
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