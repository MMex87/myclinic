<?= $this->extend('layout/templateDetail'); ?>

<?= $this->section('content3'); ?>

<div class="card mt-3 ms-3 me-3">
    <div class="card-header text-dark" style="background-color: #A595D6;">
        <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; ">DATA OBAT</h1>

        <form action="" method="get" class="form-inline" style="float:right">
            <input type="text" placeholder="cari data.." id="keyword" name="keyword" autofocus autocomplete="off"
                value="<?= ($key) ? $key : '' ?>">
            <button class="button" type="submit" id="cari"
                style="color: #ffffff; background-color: #2A87FF; border-radius: 3px; border: 1px solid #A595D6;">Cari
                <img src="/img/cari.png" width="20px" height="20px" class="ms-1 mb-1"></button>
        </form>
    </div>

    <br />

    <div class="card-body">
        <!-- Alert -->

        <?php if (session()->getFlashdata('pesan') == 'Data Berhasil DiHapus') : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
        <?php
            header("refresh:2;url=/obat/data_obat"); //5 : detik
        endif; ?>


        <?php if (session()->getFlashdata('pesan') == 'Data Berhasil DiUbah') : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
        <?php
            header("refresh:2;url=/obat/data_obat"); //5 : detik
        endif; ?>

        <table class="table">
            <thead>
                <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:800;">
                    <th scope="col">#</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Jumlah Obat</th>
                    <th scope="col">Expired Date</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 + (7 * ($currentPage - 1)); ?>
                <?php foreach ($obat as $o) : ?>
                <tr class="data" style="color: black; font-family:  'Roboto Mono', monospace; font-weight:400;">
                    <th scope="row"><?= $i++ ?></th>
                    <td scope="row"><?= $o['nama_obat'] ?></td>
                    <td scope="row"><?= $o['jenis_obat'] ?></td>
                    <td scope="row"><?= $o['jumlah_obat'] ?></td>
                    <td scope="row" style="color: red;"><?= $o['expired_date'] ?></td>
                    <td scope="row">
                        <a href="/obat/edit/<?= $o['id_obat'] ?>"><button type="button"
                                class="tombol btn-warning mb-1 ">Edit</button></a>
                        <form action="/obat/data_obat/delete/<?= $o['id_obat'] ?>" class="d-inline" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <button onclick="return confirm('Hapus Data?')" type="submit"
                                class="tombol btn-danger mb-1">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $pager->links('obat', 'pages'); ?>
</div>
<?= $this->endSection(); ?>