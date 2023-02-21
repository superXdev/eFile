<?php

namespace App\Models;

use CodeIgniter\Model;

class Arsip extends Model
{
    protected $table            = 'arsip';
    protected $primaryKey       = 'id_arsip';
    protected $allowedFields    = ['nama_file', 'nomor', 'deskripsi', 'file', 'ukuran', 'extensi', 'id_fakultas', 'id_kategori', 'id_user', 'tanggal_upload'];

    public function getAll()
    {
        return $this->db->table('arsip')
            ->join('fakultas', 'fakultas.id = arsip.id_fakultas', 'left')
            ->join('user', 'user.id = arsip.id_user', 'left')
            ->join('kategori', 'kategori.id = arsip.id_kategori', 'left')
            ->orderBy('arsip.id_arsip', 'DESC')
            // ->where('arsip.id_user', session()->get('id_user'))
            ->get()
            ->getResultArray();
    }

    public function findById($id)
    {
        return $this->db->table('arsip')
            ->join('fakultas', 'fakultas.id = arsip.id_fakultas', 'left')
            ->join('user', 'user.id = arsip.id_user', 'left')
            ->join('kategori', 'kategori.id = arsip.id_kategori', 'left')
            ->orderBy('arsip.id_arsip', 'DESC')
            ->where('arsip.id_arsip', $id)
            ->get()
            ->getResultArray();
    }

    public function getByUser($user_id)
    {
        return $this->db->table('arsip')
            ->join('fakultas', 'fakultas.id = arsip.id_fakultas', 'left')
            ->join('user', 'user.id = arsip.id_user', 'left')
            ->join('kategori', 'kategori.id = arsip.id_kategori', 'left')
            ->orderBy('arsip.id_arsip', 'DESC')
            ->where('arsip.id_user', $user_id)
            ->get()
            ->getResultArray();
    }
}
