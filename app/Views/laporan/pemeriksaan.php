<?= $this->extend('layout/templateDetail'); ?>

<?= $this->section('content3'); ?>

<div class="card ms-3 me-3" style="margin-top: 100px;">
    <div class="card-header text-dark" style="background-color: #A595D6;">
        <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; "> DAFTAR PEMERIKSAAN
        </h1>
        <form action="" method="get" class="cari" style="float:right">
            <input type="text" placeholder="cari data.." id="cari" name="cari" autofocus autocomplete="off"
                value="<?= $keyword ?>">
            <button class="button" type="submit" id="cari"
                style="color: #ffffff; background-color: #2A87FF; border-radius: 3px; border: 1px solid #A595D6;">Cari
                <img src="../img/cari.png" width="20px" height="20px" class="ms-1 mb-1"></button>
        </form>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:800;">
                    <th scope="col">#</th>
                    <th scope="col">RM</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Tanggal Daftar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($pasien as $p) : ?>
                <tr class="data view-pasien"
                    style="color: black; font-family:  'Roboto Mono', monospace; font-weight:400;">
                    <th scope="row"><?= $i++; ?></th>
                    <td scope="row"><?= $p['no_rm']; ?></td>
                    <td scope="row"><?= $p['nama']; ?></td>
                    <td scope="row"><?= $p['jenis_kelamin']; ?></td>
                    <td scope="row" style="color: red;"><?= $p['tanggal_daftar']; ?></td>
                    <input type="hidden" value="<?= $p['id_pendaftaran']; ?>" class="id_pendaftaran">
                    <td scope="row">
                        <a><button type="button" class="tombol btn-warning mb-1 btn-view" data-bs-toggle="modal"
                                data-bs-target="#viewModal" data-id="<?= $p['id_pendaftaran']; ?>">Detail</button></a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #E5E5E5;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>