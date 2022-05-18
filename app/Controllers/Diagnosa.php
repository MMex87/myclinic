<?php

namespace App\Controllers;

use App\Models\DiagnosaModel;
use App\Models\ObatModel;
use App\Models\PendaftaranModel;

class Diagnosa extends BaseController
{
    public function __construct()
    {
        $this->diagnosaModel = new DiagnosaModel();
        $this->pendaftaranModel = new PendaftaranModel();
        $this->obatModel = new ObatModel();
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
        $diagnosa = $db->query('SELECT * FROM diagnosa WHERE id_pendaftaran = ' . $id_pendaftaran . ' AND status = 1');
        $nama = $db->query('SELECT nama from pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE id_pendaftaran = ' . $id_pendaftaran)->getFirstRow();
        $result = $diagnosa->getResultArray();
        $data = [
            'scrumb' => 'diagnosa',
            'appbar' => 'pendaftaran',
            'id_pendaftaran' => $id_pendaftaran,
            'nama' => $nama->nama,
            'diagnosa' => $result,
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
        $diagnosa = $db->query("SELECT * FROM diagnosa WHERE id_pendaftaran = '$id_pendaftaran' AND status = 1");
        $nama = $this->request->getVar('nama');
        $dataO = [
            'gcs' => $this->request->getPost('gcs'),
            'tensi' => $this->request->getPost('tensi'),
            'nacl' => $this->request->getPost('nacl'),
            'respirasi' => $this->request->getPost('respirasi'),
            'suhu' => $this->request->getPost('suhu'),
            'penunjang' => $this->request->getPost('penunjang'),
            'gns' => $this->request->getPost('gns'),
            'au' => $this->request->getPost('au'),
            'choresterol' => $this->request->getPost('choresterol'),
            'lain' => $this->request->getPost('lain'),
            'S' => $this->request->getPost('S'),
            'codeDiag' => $this->request->getPost('diagnosa'),
            'namaObat' => $this->request->getPost('nama_obat'),
            'jumlah' => $this->request->getPost('jumlah'),
            'pemakaian' => $this->request->getPost('pemakaian'),
            'satuan' => $this->request->getPost('satuan'),
            'aturan' => $this->request->getPost('aturan'),
        ];

        $data = [
            'scrumb' => 'diagnosa',
            'appbar' => 'pendaftaran',
            'id_pendaftaran' => $id_pendaftaran,
            'diagnosa' => $diagnosa,
            'nama' => $nama,
            'dataDiag' => $dataO,
            'cssdiag' => 'obat',
            'validation' => \Config\Services::validation()
        ];
        return view('pendaftaran/diagnosa/obat', $data);
    }

    public function save()
    {
        $db = \Config\Database::connect();

        // ambil data diagnosa
        $id_pendaftaran = $this->request->getVar('id_pendaftaran');
        $s = $this->request->getVar('S');
        $o = $this->request->getVar('O');
        $tindakan = $this->request->getVar('diagnosa');
        $namaObat = $this->request->getVar('nama_obat');
        $jumlah = $this->request->getVar('jumlah');
        $pemakaian = $this->request->getVar('pemakaian');
        $satuan = $this->request->getVar('satuan');
        $aturan = $this->request->getVar('aturan');
        $status = '1';
        $id_icd = 0;
        $jumlahObat = 1;
        if ($namaObat) {
            $datajumlahObat = $this->obatModel->where('nama_obat', $namaObat)->findColumn('jumlah_obat');
            $jumlahObat = $datajumlahObat[0];
        }


        // validation
        if (!$this->validate([
            'jumlah' => [
                'rules' => 'less_than_equal_to[' . $jumlahObat . ']',
                'errors' => [
                    'less_than_equal_to' => 'Gagal di tambahakan karena stock obat ' . $namaObat . ' tersisa ' . $jumlahObat
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }
        $diagnosa = $db->query("SELECT * FROM icd_10 WHERE code1 = '" . $tindakan . "' OR code2 = '" . $tindakan . "'")->getResultArray();
        // dd($diagnosa);
        foreach ($diagnosa as $row) {
            if ($row['code1'] == $tindakan || $row['code2'] == $tindakan) {
                $id_icd = $row['id_icd'];
            }
        }


        $this->diagnosaModel->save([
            's' => $s,
            'o' => $o,
            'a' => $tindakan,
            'p' => $namaObat,
            'jumlah' => $jumlah,
            'status' => $status,
            'pemakaian' => $pemakaian,
            'satuan' => $satuan,
            'aturan' => $aturan,
            'id_pendaftaran' => $id_pendaftaran,
            'id_icd' => $id_icd
        ]);


        $nama = $db->query('SELECT nama from pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE id_pendaftaran = ' . $id_pendaftaran)->getFirstRow();
        $diag = $db->query("SELECT * FROM diagnosa WHERE id_pendaftaran = '$id_pendaftaran' AND status = 1");
        $diagnosaBaru = $diag->getFirstRow();
        // dd($diagnosaBaru->o);
        $pisah = explode(';', $diagnosaBaru->o);

        $dataBaru = [
            'gcs' => $pisah[0],
            'tensi' => $pisah[1],
            'nacl' => $pisah[2],
            'respirasi' => $pisah[3],
            'suhu' => $pisah[4],
            'penunjang' => $pisah[5],
            'gns' => $pisah[6],
            'au' => $pisah[7],
            'choresterol' => $pisah[8],
            'lain' => $pisah[9],
            'S' => $diagnosaBaru->s,
        ];


        $data = [
            'scrumb' => 'diagnosa',
            'appbar' => 'pendaftaran',
            'id_pendaftaran' => $id_pendaftaran,
            'diagnosa' => $diag,
            'nama' => $nama->nama,
            'dataDiag' => $dataBaru,
            'cssdiag' => 'obat',
            'validation' => \Config\Services::validation()
        ];

        return view('pendaftaran/diagnosa/obat', $data);
    }

    public function selesai()
    {
        $id_pendaftaran = $this->request->getVar('id_pendaftaran');
        $status = 2;

        $this->diagnosaModel->where('id_pendaftaran', $id_pendaftaran)->set(['status' => $status])->update();
        $this->pendaftaranModel->where('id_pendaftaran', $id_pendaftaran)->set(['status' => $status])->update();

        return redirect()->to('pendaftaran/obat');
    }

    public function obatDelete($id_diagnosa)
    {
        $db = \Config\Database::connect();

        $this->diagnosaModel->where('id_diagnosa', $id_diagnosa)->delete();

        // ambil data diagnosa
        $id_pendaftaran = $this->request->getVar('id_pendaftaran');
        $diagnosa = $db->query("SELECT * FROM diagnosa WHERE id_pendaftaran = '$id_pendaftaran' AND status = 1");
        $nama = $this->request->getVar('nama');
        $diag = $this->request->getVar('O');
        $pisah = explode(';', $diag);




        $dataBaru = [
            'gcs' => $pisah[0],
            'tensi' => $pisah[1],
            'nacl' => $pisah[2],
            'respirasi' => $pisah[3],
            'suhu' => $pisah[4],
            'penunjang' => $pisah[5],
            'gns' => $pisah[6],
            'au' => $pisah[7],
            'choresterol' => $pisah[8],
            'lain' => $pisah[9],
            'S' => $this->request->getVar('S'),
        ];

        $data = [
            'scrumb' => 'diagnosa',
            'appbar' => 'pendaftaran',
            'id_pendaftaran' => $id_pendaftaran,
            'diagnosa' => $diagnosa,
            'nama' => $nama,
            'dataDiag' => $dataBaru,
            'cssdiag' => 'obat',
            'validation' => \Config\Services::validation()
        ];

        return view('pendaftaran/diagnosa/obat', $data);
    }
}