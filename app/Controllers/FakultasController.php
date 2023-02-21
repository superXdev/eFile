<?php

namespace App\Controllers;

use App\Models\{Fakultas, User};
use App\Controllers\BaseController;

class FakultasController extends BaseController
{
    public function __construct()
    {
        $this->fakultas = new Fakultas();
    }

    public function index()
    {
        $data = $this->fakultas->findAll();

        return view('admin/fakultas', [
            'title' => 'Daftar Fakultas', 
            'data' => $data
        ]);
    }

    public function create()
    {
        $nama_fakultas = $this->request->getVar('nama_fakultas');

        $this->fakultas->insert([
            'nama_fakultas' => $nama_fakultas,
            'tanggal' => date('d-md-Y h:m:s A'),
        ]);

        session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        return redirect()->to('/fakultas');
    }

    public function detail()
    {
        $data = $this->fakultas->find($this->request->getVar('id'));

        return $this->response->setJSON($data);
    }

    public function update()
    {

        $data = $this->fakultas->find($this->request->getVar('id'));
        $data['nama_fakultas'] = $this->request->getVar('nama_fakultas');

        // update data
        $this->fakultas->save($data);

        session()->setFlashdata('success', 'Data berhasil diupdate!');

        return redirect()->to('/fakultas');
    }

    public function delete()
    {
        $data = $this->fakultas->find($this->request->getVar('id'));
        $this->fakultas->delete($data['id']);

        session()->setFlashdata('success', 'Data berhasil dihapus!');

        return redirect()->to('/fakultas');
    }
}
