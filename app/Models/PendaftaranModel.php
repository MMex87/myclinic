<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table = 'pendaftaran';
    protected $allowedFields = ['nama_dokter', 'tindakan', 'status', 'tanggal_daftar', 'keterangan', 'id_pasien'];

    public function getDaftar()
    {
        return $this->findAll();
    }
}