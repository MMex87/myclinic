<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosaModel extends Model
{
    protected $table = 'diagnosa';
    protected $primaryKey = 'id_diganosa';
    protected $allowedFields = ['s', 'o', 'a', 'p', 'jumlah', 'status', 'pemakaian', 'satuan', 'aturan', 'id_pendaftaran', 'id_icd'];

    public function getDiagnosa($id_pendaftaran)
    {
        return $this->where(['id_diagnosa' => $id_pendaftaran]);
    }
}