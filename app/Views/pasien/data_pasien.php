<?= $this->extend('layout/templateDetail'); ?>

<?php

// waktu
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = new DateTime();


?>

<?= $this->section('content3'); ?>

<div class="card mt-3 ms-3 me-3">
    <div class="card-header text-dark" style="background-color: #A595D6;">
        <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; ">DATA PASIEN</h1>

        <form class="form-inline" action="" method="get" style="float:right">

            <input type="text" placeholder="cari data.." id="keyword" name="keyword" autofocus autocomplete="off"
                value="<?= ($key) ? $key : "" ?>">
            <button class="button" type="submit" id="cari"
                style="color: #ffffff; background-color: #2A87FF; border-radius: 3px; border: 1px solid #A595D6;">Cari
                <img src="/img/cari.png" width="20px" height="20px" class="ms-1 mb-1"></button>

        </form>
    </div>

    <br>
    <div class="card-body">
        <!-- Alert -->

        <?php if (session()->getFlashdata('pesan') == 'Data Berhasil DiHapus') : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
        <?php
            header("refresh:2;url=/pasien/data_pasien"); //5 : detik
        endif; ?>

        <?php if (session()->getFlashdata('pesan') == 'Data Berhasil DiUbah') : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
        <?php
            header("refresh:2;url=/pasien/data_pasien"); //5 : detik
        endif; ?>
        <table class="table">
            <thead>
                <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:800;">
                    <th scope="col">#</th>
                    <th scope="col">No.BPJS</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No RM</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <?php



            ?>
            <?php $i = 1 + (7 * ($currentPage - 1)); ?>
            <?php foreach ($pasien as $row) : ?>
            <tbody>
                <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:400;">
                    <th><?= $i ?></th>
                    <td scope="row"><?= $row['no_bpjs'] ?></td>
                    <td scope="row"><?= $row['nik'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['no_rm'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?php
                            $lahir = new DateTime($row['tanggal_lahir']);
                            $umur = $waktu_sekarang->diff($lahir);
                            echo $umur->y;
                            echo " Tahun, ";
                            echo $umur->m;
                            echo " Bulan, ";
                            echo $umur->d;
                            echo " Hari";
                            ?></td>
                    <td><?= $row['jenis_kelamin'] ?></td>
                    <td>
                        <a href="/pasien/edit/<?= $row['id_pasien'] ?>"><button type="button"
                                class="tombol btn-warning mb-1 ">Edit</button></a>
                        <form action="/pasien/data_pasien/<?= $row['id_pasien'] ?>" class="d-inline" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="tombol btn-danger mb-1"
                                onclick="return confirm('Hapus Data?')">Delete</button>
                        </form>
                    </td>
                    <?php $i++; ?>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <?= $pager->links('pasien', 'pages'); ?>
</div>

<?= $this->endSection(); ?>