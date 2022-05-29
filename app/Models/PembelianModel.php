<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $allowedFields = ['jumlah', 'tanggal_beli', 'expired_date', 'id_obat'];

    public function getPembelian()
    {
        return $this->findAll();
    }
}