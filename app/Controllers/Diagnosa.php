<?php

namespace App\Controllers;

use App\Models\DiagnosaModel;
use App\Models\PendaftaranModel;

class Diagnosa extends BaseController
{
    public function __construct()
    {
        $this->diagnosaModel = new DiagnosaModel();
        $this->pendaftaranModel = new PendaftaranModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $pasien = $db->query("SELECT * FROM pasien INNER jOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE pendaftaran.status = 1");


        $data = [
            'scrumb' => 'diagnosa',
            'pasien' => $pasien,
            'appbar' => 'pendaftaran',
            'cssdiag' => 'diagnosa'
        ];
        return view('pendaftaran/diagnosa/index', $data);
    }

    public function tindakan($id_pendaftaran)
    {
        $db = \Config\Database::connect();
        $diagnosa = $db->query('SELECT * FROM diagnosa WHERE id_pendaftaran = ' . $id_pendaftaran . ' AND status = 1')->getFirstRow();
        $nama = $db->query('SELECT nama from pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE id_pendaftaran = ' . $id_pendaftaran)->getFirstRow();

        $data = [
            'scrumb' => 'diagnosa',
            'appbar' => 'pendaftaran',
            'id_pendaftaran' => $id_pendaftaran,
            'nama' => $nama->nama,
            'diagnosa' => $diagnosa,
            'cssdiag' => 'diagnosa'
        ];
        return view('pendaftaran/diagnosa/tindakan', $data);
    }

    public function delete($id_pendaftaran)
    {
        $this->pendaftaranModel->where('id_pendaftaran', $id_pendaftaran)->delete();

        return redirect()->to('/diagnosa');
    }

    public function obat()
    {
        $id_pendaftaran = $this->request->getVar('id_pendaftaran');
        $db = \Config\Database::connect();
        $diagnosa = $db->query("SELECT * FROM diagnosa WHERE id_pendaftaran = '$id_pendaftaran' AND status = 1")->getFirstRow();
        $nama = $this->request->getVar('nama');
        $data = [
            'scrumb' => 'diagnosa',
            'appbar' => 'pendaftaran',
            'id_pendaftaran' => $id_pendaftaran,
            'diagnosa' => $diagnosa,
            'nama' => $nama,
            'cssdiag' => 'obat'
        ];
        return view('pendaftaran/diagnosa/obat', $data);
    }
}