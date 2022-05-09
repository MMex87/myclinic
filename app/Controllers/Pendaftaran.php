<?php

namespace App\Controllers;

use \App\Models\PendaftaranModel;

class Pendaftaran extends BaseController
{

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranModel();
    }

    public function index()
    {
        $data = [
            'scrumb' => 'pasien',
            'appbar' => 'pendaftaran',
            'cssdiag' => ''
        ];
        return view('pendaftaran/pendaftaran/index', $data);
    }

    public function save()
    {
        $db = \Config\Database::connect();

        // ambil id pasien
        $nik = $this->request->getVar('nik');
        $noBPJS = $this->request->getVar('noBPJS');
        $nama = $this->request->getVar('nama');
        $sql = "";

        if ($nik > 0) {
            $sql = "SELECT id_pasien from pasien WHERE nik = '$nik'";
            $keterangan = $this->request->getVar('bpjs');
        } elseif ($noBPJS > 0) {
            $sql = "SELECT id_pasien from pasien WHERE no_bpjs = '$noBPJS'";
            $keterangan = $this->request->getVar('bpjs');
        } elseif ($nama > 0) {
            $sql = "SELECT id_pasien from pasien WHERE nama = '$nama'";
            $keterangan = $this->request->getVar('ceknama');
        }

        $result  = $db->query($sql)->getRowArray(0);
        $id_pasien = $result['id_pasien'];

        // dd($this->request->getVar());


        //  ambil data
        $dokter = $this->request->getVar('dokter');
        $tindakan = $this->request->getVar('tindakan');
        $status = $this->request->getVar('status');
        $tanggal = $this->request->getVar('tanggal');

        $this->pendaftaranModel->save([
            'nama_dokter' => $dokter,
            'tindakan' => $tindakan,
            'status' => $status,
            'tanggal_daftar' => $tanggal,
            'keterangan' => $keterangan,
            'id_pasien' => $id_pasien,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/');
    }
}