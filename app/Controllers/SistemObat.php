<?php

namespace App\Controllers;

use App\Models\DiagnosaModel;
use App\Models\ObatModel;
use App\Models\PendaftaranModel;

class SistemObat extends BaseController
{
    public function __construct()
    {
        $this->obatModel = new ObatModel();
        $this->diagnosaModel = new DiagnosaModel();
        $this->pendaftaranModel = new PendaftaranModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $pasien = $db->query("SELECT * FROM pasien INNER jOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE pendaftaran.status = 2");


        $data = [
            'scrumb' => 'obat',
            'pasien' => $pasien,
            'appbar' => 'pendaftaran',
            'cssdiag' => ''
        ];
        return view('pendaftaran/obat/index', $data);
    }
    public function tindakan($id_pendaftaran)
    {
        $db = \Config\Database::connect();
        $nama = $db->query('SELECT nama from pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE id_pendaftaran = ' . $id_pendaftaran)->getFirstRow();
        $pasien = $db->query("SELECT * FROM diagnosa WHERE id_pendaftaran = '$id_pendaftaran' AND status = '2'")->getResultArray();
        $obat = $db->query('SELECT * FROM obat')->getResultArray();

        $data = [
            'scrumb' => 'obat',
            'id_pendaftaran' => $id_pendaftaran,
            'pasien' => $pasien,
            'appbar' => 'pendaftaran',
            'nama' => $nama->nama,
            'obat' => $obat,
            'cssdiag' => ''
        ];
        return view('pendaftaran/obat/tindakan', $data);
    }
}