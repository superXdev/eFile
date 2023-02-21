<?php

namespace App\Controllers;

use App\Models\{Arsip, User, Kategori};
use App\Controllers\BaseController;

class ArsipController extends BaseController
{
    public function __construct()
    {
        $this->arsip = new Arsip();
        $this->user = new User();
        $this->kategori = new Kategori();
    }

    public function index()
    {
        if(session()->get('level') == 1) {
            $data = $this->arsip->getAll();
        } else {
            $data = $this->arsip->getByUser(session()->get('id'));
        }
        
        $kategori = $this->kategori->findAll();

        return view('admin/arsip', [
            'title' => 'File', 
            'data' => $data,
            'kategori' => $kategori
        ]);
    }

    public function create()
    {
        $nama = $this->request->getPost('nama_file');
        $nomor = $this->request->getPost('nomor');
        $deskripsi = $this->request->getPost('deskripsi');
        $id_kategori = $this->request->getPost('id_kategori');
        $file = $this->request->getFile('file_arsip');

        // nama file
        $nama_file = $file->getRandomName();
        // mengambil ukuran file
        $ukuran_file = $file->getSize('kb');
        // extensi file
        $extensi = $file->getExtension();

        // informasi user
        $user_data = $this->user->find(session()->get('id'));

        // return d($nama);

        $file->move('uploads', $nama_file);

        $this->arsip->insert([
            'file' => $nama_file,
            'nama_file' => $nama,
            'nomor'=> $nomor,
            'deskripsi' => $deskripsi,
            'extensi' => $extensi,
            'ukuran' => $ukuran_file,
            'id_fakultas' => $user_data['id_fakultas'],
            'id_kategori' => $id_kategori,
            'id_user' => $user_data['id'],
            'tanggal_upload' => date('d-m-Y H:m:s A')
        ]);

        session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        return redirect()->to('/file');
    }

    public function detail()
    {
        $data = $this->arsip->findById($this->request->getVar('id'));

        return $this->response->setJSON($data[0]);
    }

    public function update()
    {
        $data = $this->arsip->find($this->request->getVar('id'));

        if($this->request->getVar('file_arsip') !== null) {
            $file = $this->request->getFile('file_arsip');

            // nama file
            $nama_file = $file->getRandomName();
            // mengambil ukuran file
            $ukuran_file = $file->getSize('kb');
            // extensi file
            $extensi = $file->getExtension();

            $data['file'] = $nama_file;
            $data['ukuran'] = $ukuran_file;
            $data['extensi'] = $extensi;   
        }

        $data['nama_file'] = $this->request->getVar('nama_file');
        $data['id_kategori'] = $this->request->getVar('id_kategori');
        $data['deskripsi'] = $this->request->getVar('deskripsi');

        // update data
        $this->arsip->save($data);

        session()->setFlashdata('success', 'Data berhasil diupdate!');

        return redirect()->to('/file');
    }

    public function delete()
    {
        $data = $this->arsip->find($this->request->getVar('id'));
        $this->arsip->delete($data['id_arsip']);

        unlink(FCPATH.'uploads/'.$data['file']);

        session()->setFlashdata('success', 'Data berhasil dihapus!');

        return redirect()->to('/file');
    }
}
