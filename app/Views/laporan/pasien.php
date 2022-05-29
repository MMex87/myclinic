<?= $this->extend('layout/templateDetail'); ?>

<?= $this->section('content3'); ?>

<div class="card ms-3 me-3 " style="margin-top: 100px;">
    <div class="card-header text-dark" style="background-color: #A595D6; margin: top 100px; ">
        <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; ">LAPORAN PASIEN</h1>

        <button type="button"
            style="height: 40px; width: 120px; color: #ffff; font-family:  'Roboto Mono', monospace; text-align: center; font-weight: 900; background-color: #61529A;">
            <a href="pdfPasien.php?tanggal=<?= $tanggal ?>">DOWNLOAD</a>
        </button>
        <button type="button" class="ms-3"
            style="height: 40px; width: 130px; color: #ffff; font-family:  'Roboto Mono', monospace; text-align: center; font-weight: 900; background-color: #61529A;">
            <a href="/laporan/chartPasien">CHART PASIEN</a>
        </button>

        <form class="form-inline" action="" method="get" style="float:right">
            <input type="date" id="cari" name="cari" autocomplete="off" value="<?= $tanggal ?>">
            <button class="button" type="submit" id="cari"
                style="color: #ffffff; background-color: #2A87FF; border-radius: 3px; border: 1px solid #A595D6;">Cari
                <img src="../img/cari.png" width="20px" height="20px" class="ms-1 mb-1"></button>
            <h4 style="float: left; margin-right:6px;"><a style=" color:#ffff;text-decoration:none;"
                    href="/laporan/pasienBulan">BULAN</a></h4>
        </form>
    </div>

    <br>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:800;">
                    <th scope="col">#</th>
                    <th scope="col">RM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Usia</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tindakan</th>
                    <th scope="col">Diganosa</th>

                </tr>
            </thead>
            <tbody>
                <div>
                    <?php $i = 1; ?>
                    <?php foreach ($pasien as $row) : ?>

                    <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:400;">
                        <th><?= $i ?></th>
                        <td scope="row"><?= $row['no_rm'] ?></td>
                        <td scope="row"><?= $row['nama'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?php
                                $lahir = new DateTime($row['tanggal_lahir']);
                                $umur = $waktu_sekarang->diff($lahir);
                                echo $umur->y;
                                echo " Tahun, ";
                                echo $umur->m;
                                echo " Bulan ";
                                ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td><?= $row['tindakan'] ?></td>
                        <?php
                            $db = \Config\Database::connect();
                            $nama = $row['nama'];
                            $isiDiagnosa = "";
                            $diagnosa = $db->query("SELECT diagnosa.a
                                    FROM pendaftaran
                                    JOIN pasien on pasien.id_pasien=pendaftaran.id_pasien 
                                    JOIN diagnosa on diagnosa.id_pendaftaran= pendaftaran.id_pendaftaran WHERE pasien.nama = '$nama' AND tanggal_daftar = '$tanggal'")->getResultArray();
                            foreach ($diagnosa as $rows) {
                                $isiDiagnosa = $isiDiagnosa . $rows['a'] . ', ';
                            }
                            ?>
                        <td><?= $isiDiagnosa ?></td>
                        <?php $i++; ?>
                    </tr>
                    <?php endforeach; ?>
                </div>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>