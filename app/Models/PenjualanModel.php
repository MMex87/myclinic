<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $allowedFields = ['jumlah', 'tanggal_terjual', 'id_pendaftaran', 'id_obat'];

    public function getPenjualan()
    {
        return $this->findAll();
    }
}