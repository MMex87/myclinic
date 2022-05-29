<?php

namespace App\Controllers;

use App\Models\DiagnosaModel;
use App\Models\ObatModel;
use App\Models\PendaftaranModel;
use App\Models\PenjualanModel;
use CodeIgniter\I18n\Time;

class SistemObat extends BaseController
{
    public function __construct()
    {
        $this->obatModel = new ObatModel();
        $this->diagnosaModel = new DiagnosaModel();
        $this->pendaftaranModel = new PendaftaranModel();
        $this->penjualanModel = new PenjualanModel();
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

    public function save()
    {
        $db = \Config\Database::connect();
        $id_pendaftaran = $this->request->getVar('id_pendaftaran');
        $pasien = $db->query("SELECT * FROM diagnosa WHERE id_pendaftaran = '$id_pendaftaran' AND status = '2'")->getResultArray();
        $selesai = $this->request->getVar('selesai');
        $waktu = Time::today('Asia/Jakarta');

        // dd($waktu->toDateString());

        $i = 1;
        $jumlahData = count($pasien);

        if ($selesai == '1') {
            // dd($this->request->getVar());
            $this->pendaftaranModel->update($id_pendaftaran, ['status' => '0']);
            $this->diagnosaModel->where('id_pendaftaran', $id_pendaftaran)->set(['status' => '0'])->update();
            return redirect()->to('/sistemobat');
        } else {
            while ($i <= $jumlahData) {
                if ($this->request->getVar('obat' . $i)) {
                    // dd($this->request->getVar());
                    $jumlah = $this->request->getVar('jumlah' . $i);
                    $tanggal = $waktu->toDateString();
                    $id_obat = $this->request->getVar('id_obat' . $i);

                    $this->penjualanModel->save([
                        'jumlah' => $jumlah,
                        'tanggal_terjual' => $tanggal,
                        'id_pendaftaran' => $id_pendaftaran,
                        'id_obat'  => $id_obat,
                    ]);
                    $this->pendaftaranModel->update($id_pendaftaran, ['status' => '0']);
                    $this->diagnosaModel->where('id_pendaftaran', $id_pendaftaran)->set(['status' => '0'])->update();
                }

                $i++;
            }
            return redirect()->to('/sistemobat');
        }
    }
}