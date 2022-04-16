<?php

namespace App\Controllers;


class Diagnosa extends BaseController
{

    public function index()
    {
        $db = \Config\Database::connect();
        $pasien = $db->query("SELECT * FROM pasien INNER jOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE pendaftaran.status = 1");


        $data = [
            'scrumb' => 'diagnosa',
            'pasien' => $pasien,
            'appbar' => 'pendaftaran'
        ];
        return view('pendaftaran/diagnosa/index', $data);
    }
}