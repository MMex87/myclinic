<?php

$konek = mysqli_connect("localhost", "root", "", "klinik_akiva");

function tambah_pasien($data)
{
    global $konek;
    // ambil data
    $no_bpjs = htmlspecialchars($data['noBPJS']);
    $nama = htmlspecialchars($data['namaPasien']);
    $rm = htmlspecialchars($data['noRM']);
    $nik = htmlspecialchars($data['nik']);
    $no_HP = htmlspecialchars($data['noHP']);
    $tanggal = htmlspecialchars($data['tanggalLahir']);
    $alamat = htmlspecialchars($data['alamat']);
    $jenisKel = htmlspecialchars($data['jenisKelamin']);
    $aksi = "";

    $sql = query("SELECT * FROM pasien");
    foreach ($sql as $data) {
        if ($rm == $data['no_rm']) {
            $aksi = "gagal";
        }
    }
    if ($aksi == "gagal") {
        return "gagal";
    } else {
        if ($nik == "") {
            $nik = "-";
            if ($no_bpjs == "") {
                $no_bpjs = "-";
            }
        }
        $query = "INSERT INTO pasien VALUE ('','$no_bpjs','$nama','$rm','$tanggal','$jenisKel','$nik','$no_HP','$alamat')";
        mysqli_query($konek, $query);
        return "berhasil";
    }
}

function edit_pasien($data)
{
    global $konek;
    // ambil data
    $id_pasien = htmlspecialchars($data['id_pasien']);
    $no_bpjs = htmlspecialchars($data['noBPJS']);
    $nama = htmlspecialchars($data['namaPasien']);
    $rm = htmlspecialchars($data['noRM']);
    $nik = htmlspecialchars($data['nik']);
    $no_HP = htmlspecialchars($data['noHP']);
    $tanggal = htmlspecialchars($data['tanggalLahir']);
    $alamat = htmlspecialchars($data['alamat']);
    $jenisKel = htmlspecialchars($data['jenisKelamin']);

    // update
    $query = "UPDATE pasien SET no_bpjs = '$no_bpjs', nama = '$nama', no_rm = '$rm', nik = '$nik', no_telfone = '$no_HP', alamat = '$alamat', tanggal_lahir = '$tanggal', jenis_kelamin = '$jenisKel' WHERE id_pasien = '$id_pasien'";
    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}

function hapus_pasien($data)
{
    global $konek;
    // eksekui

    $query = "DELETE FROM pasien WHERE id_pasien = $data";
    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}

function query($query)
{
    global $konek;
    $result = mysqli_query($konek, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function pendaftaranNik($data)
{
    global $konek;

    // ambil id pasien
    $nik = htmlspecialchars($data['nik']);
    $noBPJS = htmlspecialchars($data['noBPJS']);
    $nama = htmlspecialchars($data['nama']);

    if ($nik > 0) {
        $sql = "SELECT id_pasien from pasien WHERE nik = '$nik'";
        $keterangan = htmlspecialchars($data['bpjs']);
    } elseif ($noBPJS > 0) {
        $sql = "SELECT id_pasien from pasien WHERE no_bpjs = '$noBPJS'";
        $keterangan = htmlspecialchars($data['bpjs']);
    } elseif ($nama > 0) {
        $sql = "SELECT id_pasien from pasien WHERE nama = '$nama'";
        $keterangan = htmlspecialchars($data['ceknama']);
    }

    $result = query($sql)[0];
    $id_pasien = $result['id_pasien'];

    //  ambil data
    $dokter = htmlspecialchars($data['dokter']);
    $tindakan = htmlspecialchars($data['tindakan']);
    $status = htmlspecialchars($data['status']);
    $tanggal = htmlspecialchars($data['tanggal']);

    $query = "INSERT INTO pendaftaran VALUE ('','$dokter','$tindakan','$status','$tanggal','$keterangan','$id_pasien')";
    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}

function diagnosa($data)
{
    global $konek;
    $obat = query("SELECT * FROM obat");
    $jumlah = htmlspecialchars($data['jumlah']);
    $nama = htmlspecialchars($data['nama_obat']);
    $aksi = "";
    foreach ($obat as $row) {
        if ($row['jumlah_obat'] < $jumlah) {
            if ($row['nama_obat'] == $nama) {
                $aksi = "gagal";
            } else
                $aksi = "";
        }
    }

    if ($aksi == "gagal") {
        return $aksi;
    } else {
        $tindakan = htmlspecialchars($data['diagnosa']);

        $diagnosa = query("SELECT * FROM icd_10 WHERE code1 = '$tindakan' OR code2 = '$tindakan'");
        $id_icd = 0;

        foreach ($diagnosa as $row) {
            if ($row['code1'] == $tindakan || $row['code2'] == $tindakan) {
                $id_icd = $row['id_icd'];
            }
        }
        $id_pendaftaran = htmlspecialchars($data['id_pendaftaran']);

        $total = count(query("SELECT * FROM diagnosa WHERE id_pendaftaran = '$id_pendaftaran' AND status = '1'"));
        // ambil data
        if ($total == 0) {
            $s = htmlspecialchars($data['S']);
            $o = htmlspecialchars($data['O']);
        } else {
            $s = "";
            $o = "";
        }

        $pemakaian = htmlspecialchars($data['pemakaian']);
        $satuan = htmlspecialchars($data['satuan']);
        $aturan = htmlspecialchars($data['aturan']);
        $status = htmlspecialchars($data['status']);
        $jumlah = htmlspecialchars($data['jumlah']);
        $query = "INSERT INTO diagnosa VALUE ('','$s','$o','$tindakan','$nama','$jumlah','$status','$pemakaian','$satuan','$aturan','$id_pendaftaran','$id_icd')";
        mysqli_query($konek, $query);
        return mysqli_affected_rows($konek);
    }
}

function cari($keyword, $awalData, $jumlahDataPerHalaman)
{
    $query = "SELECT * FROM pasien 
        WHERE nama LIKE '%$keyword%' OR 
        nik LIKE '%$keyword%' OR 
        no_bpjs LIKE '%$keyword%' OR 
        alamat LIKE '%$keyword%' OR
        no_telfone LIKE '%$keyword%'
        LIMIT " . $awalData . "," . $jumlahDataPerHalaman . "";

    return query($query);
}

function cariTanpaLimit($keyword)
{
    $query = "SELECT * FROM pasien 
        WHERE nama LIKE '%$keyword%' OR 
        nik LIKE '%$keyword%' OR 
        no_bpjs LIKE '%$keyword%' OR 
        alamat LIKE '%$keyword%' OR
        no_telfone LIKE '%$keyword%'";

    return query($query);
}


function cariObat($keyword, $awalData, $jumlahDataPerHalaman)
{
    $query = "SELECT * FROM obat 
        WHERE nama_obat LIKE '%$keyword%' OR 
        jenis_obat LIKE '%$keyword%'
        LIMIT " . $awalData . "," . $jumlahDataPerHalaman . "";

    return query($query);
}

function cariObatTanpaLimit($keyword)
{
    $query = "SELECT * FROM obat 
        WHERE nama_obat LIKE '%$keyword%' OR 
        jenis_obat LIKE '%$keyword%'";

    return query($query);
}

function hapusDiagnosa($keyword)
{
    global $konek;

    $query = "DELETE FROM diagnosa WHERE id_diagnosa = '$keyword'";

    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}

// Update Diagnosa Save Diagnosa OBAT
function updateDiagnosa($data)
{
    global $konek;

    $query = "UPDATE diagnosa SET status = '2' WHERE id_pendaftaran = '$data'";
    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}
function updatePendaftaranStatus($data)
{
    global $konek;

    $query = "UPDATE pendaftaran SET status = '2' WHERE id_pendaftaran = '$data'";
    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}

// Update Tindakan Pendaftaran OBAT
function updateStatusDiagnosa($data)
{
    global $konek;

    $query = "UPDATE diagnosa SET status = '0' WHERE id_pendaftaran = '$data'";
    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}

function updatePendaftaranStatusObat($data)
{
    global $konek;

    $query = "UPDATE pendaftaran SET status = '0' WHERE id_pendaftaran = '$data'";
    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}

// Delete Diagnosa
function hapus_diagnosa($data)
{
    global $konek;

    $sql = "DELETE from pendaftaran WHERE id_pendaftaran = '$data'";
    mysqli_query($konek, $sql);
    return mysqli_affected_rows($konek);
}

// Delete pendaftaran OBAT
function updateDiagnosaStatusObat($data)
{
    global $konek;

    $query = "UPDATE pendaftaran SET status = '1' WHERE id_pendaftaran = '$data'";
    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}

function hapus_diagnosa_obat($data)
{
    global $konek;

    $sql = "DELETE FROM diagnosa WHERE id_pendaftaran = '$data' AND status='2'";
    mysqli_query($konek, $sql);
    return mysqli_affected_rows($konek);
}


// fungsi OBAT

function hapus_obat($data)
{
    global $konek;

    $query = "DELETE FROM obat WHERE id_obat = '$data'";
    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}

function update_obat($data)
{
    global $konek;
    // ambli data

    $id = htmlspecialchars($data['id_obat']);
    $nama = htmlspecialchars($data['nama_obat']);
    $jenis = htmlspecialchars($data['jenis']);
    $jumlah = htmlspecialchars($data['jumlah_obat']);
    $exp = htmlspecialchars($data['expired_date']);

    $query = "UPDATE  obat SET nama_obat = '$nama', jumlah_obat = '$jumlah', jenis_obat ='$jenis' , expired_date = '$exp'  WHERE id_obat = '$id'";
    mysqli_query($konek, $query);
    return mysqli_affected_rows($konek);
}

function tambah_obat($data)
{
    global $konek;

    // ambli data
    $nama = htmlspecialchars($data['nama_obat']);
    $jenis = htmlspecialchars($data['jenis']);
    $jumlah = htmlspecialchars($data['jumlah_obat']);
    $tanggal = htmlspecialchars($data['tanggalBel']);
    $exp = htmlspecialchars($data['expired_date']);
    $id_obat = 0;
    $tindakan = "stock";

    $sql = query("SELECT * FROM obat");
    foreach ($sql as $data) {
        if ($nama == $data['nama_obat']) {
            $id_obat = $data['id_obat'];
        }
    }
    if ($id_obat > 0) {
        return tambah_pembelian($jumlah, $tanggal, $id_obat, $exp);
    } else {
        mysqli_query($konek, "INSERT INTO obat VALUE ('','$nama',0,'$exp','$jenis')");
        $sql = query("SELECT * FROM obat");
        foreach ($sql as $data) {
            if ($nama == $data['nama_obat']) {
                $id = $data['id_obat'];
            }
        }
        if ($id > 0) {
            mysqli_query($konek, "INSERT INTO pembelian VALUE ('','$jumlah','$tanggal','$exp','$id')");
            mysqli_close($konek);
            return "tambah";
        } else
            return "";
    }
}

function tambah_pembelian($jumlah, $tanggal, $id, $exp)
{
    global $konek;

    mysqli_query($konek, "INSERT INTO pembelian VALUE ('','$jumlah','$tanggal','$exp','$id')");
    return "stock";
}