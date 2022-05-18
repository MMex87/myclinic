<?php

namespace App\Controllers;


class SistemObat extends BaseController
{

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
}