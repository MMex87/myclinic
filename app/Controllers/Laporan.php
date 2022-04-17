<?php

namespace App\Controllers;

use \App\Models\PendaftaranModel;

class Laporan extends BaseController
{

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranModel();
    }

    public function index()
    {
        $data = [
            'appbar' => 'laporan'
        ];
        return view('laporan/index', $data);
    }
}