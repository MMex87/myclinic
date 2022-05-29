<?= $this->extend('layout/templateDetail'); ?>


<?= $this->section('content3'); ?>

<div class="card ms-3 me-3" style="margin-top: 100px;">
    <div class="card-header text-dark" style="background-color: #A595D6;">
        <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; "> CHART PENGUNJUNG
            KLINIK AKIVA</h1>
    </div>
    <div class="panel panel-primary">
        <div class="panel-body">
            <div id="graph"></div>
        </div>
    </div>
</div>

<script>
am5.ready(function() {

    // buat root elemet
    var root = am5.Root.new("graph");

    // set tama
    root.setThemes([
        am5themes_Animated.new(root)
    ]);

    // buat chart
    var chart =
        root.container.children.push(am5percent.PieChart.new(root, {
            layout: root.verticalLayout
        }));

    // buat series
    var series =
        chart.series.push(am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category"
        }));

    // set Data
    series.data.setAll([
        <?php
            $db = \Config\Database::connect();
            $query = $db->query("SELECT DISTINCT alamat FROM pasien")->getResultArray();

            foreach ($query as $row) {
                $alamat = $row['alamat'];

                $data = $db->query("SELECT COUNT(d.a) as jumlah FROM diagnosa d JOIN pasien p JOIN pendaftaran c on p.id_pasien = c.id_pasien AND c.id_pendaftaran = d.id_pendaftaran WHERE p.alamat = '$alamat'")->getRowArray();
                $jumlah = $data['jumlah'];
            ?> {
            value: <?php echo $jumlah; ?>,
            category: '<?php echo $alamat ?>'
        },
        <?php
            }
            ?>
    ]);
    // set Legend
    var legend = chart.children.push(am5.Legend.new(root, {
        centerX: am5.percent(50),
        x: am5.percent(50),
        marginTop: 15,
        marginBottom: 15
    }));

    legend.data.setAll(series.dataItems);
    series.appear(1000, 100);
});
</script>


<?= $this->endSection(); ?>