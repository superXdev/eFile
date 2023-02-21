<?php

namespace App\Controllers;

use App\Models\Kategori;
use App\Controllers\BaseController;

class KategoriController extends BaseController
{
    public function __construct()
    {
        $this->kategori = new Kategori();
    }

    public function index()
    {
        $data = $this->kategori->findAll();

        return view('admin/kategori', [
            'title' => 'Daftar Kategori', 
            'data' => $data
        ]);
    }

    public function create()
    {
        $nama_kategori = $this->request->getVar('nama_kategori');

        $this->kategori->insert([
            'nama_kategori' => $nama_kategori,
            'tanggal' => date('d-md-Y h:m:s A'),
        ]);

        session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        return redirect()->to('/kategori');
    }

    public function detail()
    {
        $data = $this->kategori->find($this->request->getVar('id'));

        return $this->response->setJSON($data);
    }

    public function update()
    {

        $data = $this->kategori->find($this->request->getVar('id'));
        $data['nama_kategori'] = $this->request->getVar('nama_kategori');

        // update data
        $this->kategori->save($data);

        session()->setFlashdata('success', 'Data berhasil diupdate!');

        return redirect()->to('/kategori');
    }

    public function delete()
    {
        $data = $this->kategori->find($this->request->getVar('id'));
        $this->kategori->delete($data['id']);

        session()->setFlashdata('success', 'Data berhasil dihapus!');

        return redirect()->to('/kategori');
    }
}
