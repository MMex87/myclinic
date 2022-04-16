<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    protected $allowedFields = ['no_bpjs', 'nama', 'no_rm', 'tanggal_lahir', 'jenis_kelamin', 'nik', 'no_telfone', 'alamat'];

    public function getPasien($id = false)
    {
        if ($id == false) {
            return $this->table('pasien')->orderBy('id_pasien', 'DESC');
        }

        return $this->where(['id_pasien' => $id])->first();
    }


    public function search($keyword)
    {
        return $this->table('pasien')->like('nama', $keyword)->orLike('no_bpjs', $keyword)->orLike('nik', $keyword)->orLike('alamat', $keyword)->orderBy('id_pasien', 'DESC');
    }
}