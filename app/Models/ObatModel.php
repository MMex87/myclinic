<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table = 'obat';
    protected $primaryKey = 'id_obat';
    protected $allowedFields = ['nama_obat', 'jumlah_obat', 'expired_date', 'jenis_obat'];

    public function getObat($id = false)
    {
        if ($id == false) {
            return $this->table('obat')->orderBy('id_obat', 'DESC');
        }

        return $this->where(['id_obat' => $id])->first();
    }

    public function cariObat($key)
    {

        return $this->where(['nama_obat' => $key])->first();
    }


    public function search($keyword)
    {
        return $this->table('obat')->like('nama_obat', $keyword)->orLike('jumlah_obat', $keyword)->orLike('jenis_obat', $keyword)->orderBy('id_obat', 'DESC');
    }
}