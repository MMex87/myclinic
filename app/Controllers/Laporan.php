<?php

namespace App\Controllers;

use \App\Models\PendaftaranModel;
use CodeIgniter\I18n\Time;
use TCPDF;


class Laporan extends BaseController
{

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranModel();
        $this->waktu = Time::now('Asia/Jakarta');
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $tanggal = $this->waktu->toDateString();

        // pasien
        $pasien = $db->query("SELECT COUNT(id_pendaftaran) as pasien FROM pendaftaran WHERE tanggal_daftar LIKE '%$tanggal%' AND status = '0' ")->getFirstRow();
        // obat
        $obat = $db->query("SELECT SUM(jumlah) as obat FROM penjualan WHERE tanggal_terjual LIKE '%$tanggal%' ")->getFirstRow();

        $nama = $db->query("SELECT COUNT(a) , a FROM diagnosa GROUP BY (a) ORDER BY COUNT(a) DESC")->getFirstRow();


        $data = [
            'appbar'    => 'laporan',
            'obat'      => $obat->obat,
            'nama'      => $nama->a,
            'pasien'    => $pasien->pasien
        ];

        return view('laporan/index', $data);
    }

    public function pasien()
    {
        $db = \Config\Database::connect();
        $waktu = Time::now('Asia/Jakarta');
        $tanggal = $waktu->toDateString();
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $tanggal = $keyword;
        }



        $pasien = $db->query("SELECT pendaftaran.tindakan, pasien.no_rm, pasien.nama, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, diagnosa.a, pendaftaran.tanggal_daftar, pendaftaran.keterangan
        FROM pendaftaran
        JOIN pasien on pasien.id_pasien=pendaftaran.id_pasien 
        JOIN diagnosa on diagnosa.id_pendaftaran= pendaftaran.id_pendaftaran WHERE tanggal_daftar LIKE '%$tanggal%' GROUP BY pasien.nama")->getResultArray();



        $data = [
            'detail' => 'laporan',
            'tanggal' => $tanggal,
            'pasien' => $pasien,
            'waktu_sekarang' => $waktu
        ];

        return view('/laporan/pasien', $data);
    }

    public function pasienBulan()
    {
        $db = \Config\Database::connect();
        $waktu = Time::now('Asia/Jakarta');
        $bulan = $waktu->toLocalizedString('MM');
        $tahun = $waktu->toLocalizedString('yyyy');
        $keyBulan = $this->request->getVar('keyBulan');
        $keyTahun = $this->request->getVar('keyTahun');

        if ($keyBulan || $keyTahun) {
            $bulan = $keyBulan;
            $tahun = $keyTahun;
        }


        $query = $db->query("SELECT pendaftaran.tindakan, pasien.no_rm, pasien.nama, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, diagnosa.a, pendaftaran.tanggal_daftar, pendaftaran.keterangan
        FROM pendaftaran
        JOIN pasien on pasien.id_pasien=pendaftaran.id_pasien 
        JOIN diagnosa on diagnosa.id_pendaftaran= pendaftaran.id_pendaftaran WHERE month(tanggal_daftar)='$bulan' AND year(tanggal_daftar) = '$tahun' GROUP BY pasien.nama")->getResultArray();

        // dd($waktu->toLocalizedString('yyyy'));

        $data = [
            'detail'    => 'laporan',
            'bulan'     => $bulan,
            'tahun'     => $tahun,
            'query'     => $query,
            'waktu_sekarang' => $waktu
        ];

        return view('/laporan/pasienPerBulan', $data);
    }

    public function Obat()
    {
        $db = \Config\Database::connect();
        $waktu = Time::now('Asia/Jakarta');
        $bulan = $waktu->toLocalizedString('MM');
        $tahun = $waktu->toLocalizedString('yyyy');
        $keyBulan = $this->request->getVar('keyBulan');
        $keyTahun = $this->request->getVar('keyTahun');

        if ($keyBulan || $keyTahun) {
            $bulan = $keyBulan;
            $tahun = $keyTahun;
        }


        $query = $db->query("SELECT SUM(penjualan.jumlah) , obat.nama_obat, obat.jenis_obat 
        FROM penjualan 
        JOIN obat on (obat.id_obat=penjualan.id_obat) 
        WHERE month(tanggal_terjual)='$bulan' and year(tanggal_terjual) = '$tahun' 
        GROUP BY penjualan.id_obat;")->getResultArray();

        // dd($waktu->toLocalizedString('yyyy'));

        $data = [
            'detail'    => 'laporan',
            'bulan'     => $bulan,
            'tahun'     => $tahun,
            'query'     => $query,
            'waktu_sekarang' => $waktu
        ];

        return view('/laporan/obat', $data);
    }

    public function pemeriksaan()
    {
        $db = \Config\Database::connect();

        $keyword = $this->request->getVar('cari');

        if ($keyword) {
            $pasien = $db->query("SELECT * FROM pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE month(pendaftaran.tanggal_daftar) BETWEEN 02 AND 03 HAVING year(pendaftaran.tanggal_daftar) = 2022 AND pendaftaran.status=0 AND pasien.nama LIKE '%$keyword%' OR pasien.no_rm LIKE '%$keyword%'")->getResultArray();
        } else {
            $pasien = $db->query("SELECT * FROM pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE month(pendaftaran.tanggal_daftar) BETWEEN 02 AND 03 HAVING year(pendaftaran.tanggal_daftar) = 2022 AND pendaftaran.status=0")->getResultArray();
        }

        $data = [
            'detail' => 'laporan',
            'pasien' => $pasien,
            'keyword' => $keyword,
            'waktu_sekarang' => $this->waktu
        ];

        return view('/laporan/pemeriksaan', $data);
    }

    // public function pdfPasien()
    // {
    //     $db = \Config\Database::connect();
    //     $tanggal = $this->request->getGet('tanggal');

    //     $query = $db->query("SELECT pendaftaran.tindakan, pasien.no_rm, pasien.nama, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, diagnosa.a, pendaftaran.tanggal_daftar, pendaftaran.keterangan
    //     FROM pendaftaran
    //     JOIN pasien on pasien.id_pasien=pendaftaran.id_pasien 
    //     JOIN diagnosa on diagnosa.id_pendaftaran= pendaftaran.id_pendaftaran WHERE tanggal_daftar LIKE '%$tanggal%' GROUP BY pasien.nama")->getResultArray();



    //     $data = [
    //         'pasien' => $query,
    //         'tanggal' => $tanggal,
    //         'waktu_sekarang' => $this->waktu
    //     ];

    //     $html = view('/laporan/pdfPasien', $data);



    //     // // create new PDF document
    //     // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    //     // // set document information
    //     // $pdf->setCreator(PDF_CREATOR);
    //     // $pdf->setAuthor('Klinik Akiva');
    //     // $pdf->setTitle('Klinik Akiva');
    //     // $pdf->setSubject('Data Obat');
    //     // $pdf->setKeywords('Data Obat');

    //     // $pdf->setFont('times', '', 12, '', true);

    //     // $pdf->AddPage('L', 'A4');



    //     // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    //     // ---------------------------------------------------------

    //     // Close and output PDF document
    //     // This method has several options, check the source code documentation for more information.
    //     //     return $pdf->Output('Laporan_Pasien_' . $tanggal . '.pdf', 'I');
    // }
}