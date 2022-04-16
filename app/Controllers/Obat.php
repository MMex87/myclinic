<?php

namespace App\Controllers;

use App\Models\ObatModel;

class Obat extends BaseController
{
    public function __construct()
    {
        $this->obatModel = new ObatModel();
    }

    public function index()
    {
        $data = [
            'appbar' => 'obat'
        ];
        return view('obat/index', $data);
    }

    public function save()
    {
        // deklarasi inputan
        $nama = $this->request->getVar('nama_obat');
        $jenis = $this->request->getVar('jenis');
        $jumlah = $this->request->getVar('jumlah_obat');
        $date = $this->request->getVar('expired_date');

        // save dengan model
        $this->obatModel->save([
            'nama_obat'     => $nama,
            'jumlah_obat'   => $jumlah,
            'expired_date'  => $date,
            'jenis_obat'    => $jenis
        ]);

        session()->setFlashdata('pesan', "Data Berhasil DiTambahkan");

        return redirect()->to('/obat');
    }

    public function data_obat()
    {
        $currentPage = $this->request->getVar('page_pasien') ?
            $this->request->getVar('page_pasien') : 1;

        // kata kunci search
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $obat = $this->obatModel->search($keyword);
        } else {
            $obat = $this->obatModel->getObat();
        }

        $data = [
            'detail'        => 'obat',
            'obat'          => $obat->paginate(7, 'obat'),
            'pager'         => $obat->pager,
            'currentPage'   => $currentPage,
            'key'           => $keyword
        ];

        return view('/obat/data_obat', $data);
    }
}