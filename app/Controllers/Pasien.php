<?php

namespace App\Controllers;

use \App\Models\PasienModel;

class Pasien extends BaseController
{

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
    }

    public function index()
    {

        $data = [
            'appbar' => 'pasien',
            'validation' => \Config\Services::validation()
        ];
        return view('pasien/index', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'noRM' => [
                'rules' => 'required|is_unique[pasien.no_rm]',
                'errors' => [
                    'required' => 'no RM harus diisi',
                    'is_unique' => 'no RM sudah terdaftar'
                ]
            ],
            'nik' => [
                'rules' => 'is_unique[pasien.nik]',
                'errors' => [
                    'is_unique' => 'no RM sudah terdaftar'
                ]
            ],
            'noBPJS' => [
                'rules' => 'is_unique[pasien.no_bpjs]',
                'errors' => [
                    'is_unique' => 'no RM sudah terdaftar'
                ]
            ],
        ])) {
            return redirect()->to('pasien')->withInput();
        }

        $db = \Config\Database::connect();
        // deklarasi
        $rm = $this->request->getVar('noRM');
        $no_bpjs = $this->request->getVar('noBPJS');
        $nama = $this->request->getVar('namaPasien');
        $nik = $this->request->getVar('nik');
        $no_HP = $this->request->getVar('noHP');
        $tanggal = $this->request->getVar('tanggalLahir');
        $alamat = $this->request->getVar('alamat');
        $jenisKel = $this->request->getVar('jenisKelamin');
        $aksi = "";

        // dd($this->request->getVar());

        // // validasi
        // $sql = $db->query("SELECT * FROM pasien")->getResultArray();
        // foreach ($sql as $data) {
        //     if ($rm == $data['no_rm']) {
        //         $aksi = "gagal";
        //     }
        // }
        // if ($aksi == "gagal") {
        //     session()->setFlashdata('pesan', 'Data Gagal Ditambahkan');
        // } else {

        if ($nik == "") {
            $nik = "-";
            if ($no_bpjs == "") {
                $no_bpjs = "-";
            }
        }
        $this->pasienModel->save([
            'no_bpjs' => $no_bpjs,
            'nama' => $nama,
            'no_rm' => $rm,
            'tanggal_lahir' => $tanggal,
            'jenis_kelamin' => $jenisKel,
            'nik' => $nik,
            'no_telfone' => $no_HP,
            'alamat' => $alamat
        ]);


        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        // }
        return redirect()->to('/pasien');
    }

    public function data_pasien()
    {
        $currentPage = $this->request->getVar('page_pasien') ?
            $this->request->getVar('page_pasien') : 1;



        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pasien = $this->pasienModel->search($keyword);
        } else {
            $pasien = $this->pasienModel->getPasien();
        }


        $data = [
            'detail'        => 'pasien',
            'pasien'        => $pasien->paginate(7, 'pasien'),
            'pager'         => $pasien->pager,
            'currentPage'   => $currentPage,
            'key'           => $keyword
        ];
        return view('pasien/data_pasien', $data);
    }

    public function delete($id_pasien)
    {
        $this->pasienModel->where('id_pasien', $id_pasien)->delete();
        session()->setFlashdata('pesan', 'Data Berhasil DiHapus');

        return redirect()->to('pasien/data_pasien');
    }

    public function edit($id)
    {
        $data = [
            'appbar'        => 'pasien',
            'validation'    => \Config\Services::validation(),
            'pasien'        => $this->pasienModel->getPasien($id)
        ];

        return view('pasien/edit', $data);
    }

    public function update($id_pasien)
    {
        // deklarasi
        $rm = $this->request->getVar('noRM');
        $no_bpjs = $this->request->getVar('noBPJS');
        $nama = $this->request->getVar('namaPasien');
        $nik = $this->request->getVar('nik');
        $no_HP = $this->request->getVar('noHP');
        $tanggal = $this->request->getVar('tanggalLahir');
        $alamat = $this->request->getVar('alamat');
        $jenisKel = $this->request->getVar('jenisKelamin');
        $aksi = "";


        // cek no RM

        $pasienLama = $this->pasienModel->getPasien($this->request->getVar('id_pasien'));
        if ($pasienLama['no_rm'] == $rm) {
            $rule_rm = 'required';
        } else {
            $rule_rm = 'required|is_unique[pasien.no_rm]';
        }
        // cek nik

        if ($pasienLama['nik'] == '-') {
            $rule_nik = 'required';
        } else {
            $rule_nik = 'is_unique[pasien.nik]';
        }
        // cek no bpjs

        if ($pasienLama['no_bpjs'] == '-') {
            $rule_bpjs = 'required';
        } else {
            $rule_bpjs = 'is_unique[pasien.no_bpjs]';
        }


        // validasi input
        if (!$this->validate([
            'noRM' => [
                'rules' => $rule_rm,
                'errors' => [
                    'required' => 'No RM harus diisi',
                    'is_unique' => 'No RM sudah terdaftar'
                ]
            ],
            'nik' => [
                'rules' => $rule_nik,
                'errors' => [
                    'is_unique' => 'NIK sudah terdaftar'
                ]
            ],
            'noBPJS' => [
                'rules' => $rule_bpjs,
                'errors' => [
                    'is_unique' => 'No BPJS sudah terdaftar'
                ]
            ],
        ])) {
            return redirect()->to('pasien/edit/' . $this->request->getVar('id_pasien'))->withInput();
        }


        $this->pasienModel->update($id_pasien, [
            'id_pasien' => $id_pasien,
            'no_bpjs' => $no_bpjs,
            'nama' => $nama,
            'no_rm' => $rm,
            'tanggal_lahir' => $tanggal,
            'jenis_kelamin' => $jenisKel,
            'nik' => $nik,
            'no_telfone' => $no_HP,
            'alamat' => $alamat
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil DiUbah');
        // }
        return redirect()->to('pasien/data_pasien');
    }
}