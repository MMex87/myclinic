<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\PembelianModel;

class Obat extends BaseController
{
    public function __construct()
    {
        $this->obatModel = new ObatModel();
        $this->pembelianModel = new PembelianModel();
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
        $tanggal_beli = $this->request->getVar('tanggalBel');

        // deklarasi Data
        $obat = $this->obatModel->cariObat($nama);

        // d($this->request->getVar());
        // d($obat);
        // dd($obat['id_obat']);

        if ($obat) {
            $this->pembelianModel->save([
                'jumlah'   => $jumlah,
                'tanggal_beli'  => $tanggal_beli,
                'expired_date'  => $date,
                'id_obat'       => $obat['id_obat'],
            ]);
        } else {
            // save dengan model
            $this->obatModel->save([
                'nama_obat'     => $nama,
                'jumlah_obat'   => $jumlah,
                'expired_date'  => $date,
                'jenis_obat'    => $jenis
            ]);
        }


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

        return view('obat/data_obat', $data);
    }

    public function delete($id)
    {
        $this->obatModel->where('id_obat', $id)->delete();

        session()->getFlashdata('pesan', "Data Berhasil DiHapus");

        return redirect()->to('/obat/data_obat');
    }

    public function edit($id)
    {
        $data = [
            'appbar'    => 'obat',
            'obat'      => $this->obatModel->getObat($id)
        ];

        return view('obat/edit', $data);
    }

    public function update($id)
    {
        // deklarasi inputan
        $nama = $this->request->getVar('nama_obat');
        $jenis = $this->request->getVar('jenis');
        $jumlah = $this->request->getVar('jumlah_obat');
        $date = $this->request->getVar('expired_date');

        // save dengan model
        $this->obatModel->save([
            'id_obat'       => $id,
            'nama_obat'     => $nama,
            'jumlah_obat'   => $jumlah,
            'expired_date'  => $date,
            'jenis_obat'    => $jenis
        ]);

        session()->setFlashdata('pesan', "Data Berhasil DiUbah");

        return redirect()->to('/obat/data_obat');
    }
}