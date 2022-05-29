<?= $this->extend('layout/templateDetail'); ?>

<?= $this->section('content3'); ?>

<div class="card ms-3 me-3 " style="margin-top: 100px;">
    <div class="card-header text-dark" style="background-color: #A595D6; margin: top 100px; ">
        <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; ">LAPORAN PASIEN</h1>

        <button type="button"
            style="height: 40px; width: 120px; color: #ffff; font-family:  'Roboto Mono', monospace; text-align: center; font-weight: 900; background-color: #61529A;">
            <a href="pdfPasienPerBulan.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>">DOWNLOAD</a>
        </button>

        <form class="form-inline" action="" method="post" style="float:right">
            <select name="keyBulan">
                <?php
                if ($bulan == "1") { ?>
                <option value="01" selected>Januari</option>
                <?php } else { ?>
                <option value="01">Januari</option>
                <?php } ?>

                <?php
                if ($bulan == "2") { ?>
                <option value="02" selected>Februari</option>
                <?php } else { ?>
                <option value="02">Februari</option>
                <?php } ?>

                <?php
                if ($bulan == "3") { ?>
                <option value="03" selected>Maret</option>
                <?php } else { ?>
                <option value="03">Maret</option>
                <?php } ?>

                <?php
                if ($bulan == "4") { ?>
                <option value="04" selected>April</option>
                <?php } else { ?>
                <option value="04">April</option>
                <?php } ?>

                <?php
                if ($bulan == "5") { ?>
                <option value="05" selected>Mei</option>
                <?php } else { ?>
                <option value="05">Mei</option>
                <?php } ?>

                <?php
                if ($bulan == "6") { ?>
                <option value="06" selected>Juni</option>
                <?php } else { ?>
                <option value="06">Juni</option>
                <?php } ?>

                <?php
                if ($bulan == "7") { ?>
                <option value="07" selected>Juli</option>
                <?php } else { ?>
                <option value="07">Juli</option>
                <?php } ?>

                <?php
                if ($bulan == "8") { ?>
                <option value="08" selected>Agustus</option>
                <?php } else { ?>
                <option value="08">Agustus</option>
                <?php } ?>

                <?php
                if ($bulan == "9") { ?>
                <option value="09" selected>September</option>
                <?php } else { ?>
                <option value="09">September</option>
                <?php } ?>

                <?php
                if ($bulan == "10") { ?>
                <option value="10" selected>Oktober</option>
                <?php } else { ?>
                <option value="10">Oktober</option>
                <?php } ?>

                <?php
                if ($bulan == "11") { ?>
                <option value="11" selected>November</option>
                <?php } else { ?>
                <option value="11">November</option>
                <?php } ?>

                <?php
                if ($bulan == "12") { ?>
                <option value="12" selected>Desember</option>
                <?php } else { ?>
                <option value="12">Desember</option>
                <?php } ?>

            </select>

            <select name="keyTahun">
                <?php
                $mulai = $tahun - 4;
                for ($i = $mulai; $i < $mulai + 11; $i++) {
                    $sel = $i == $tahun ? ' selected="selected"' : '';
                    echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
                }
                ?>
            </select>
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
                    <?php foreach ($query as $row) : ?>
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
                                    JOIN diagnosa on diagnosa.id_pendaftaran= pendaftaran.id_pendaftaran WHERE pasien.nama = '$nama' AND month(tanggal_daftar)='$bulan' AND year(tanggal_daftar) = '$tahun'")->getResultArray();
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