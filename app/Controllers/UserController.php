<?php

namespace App\Controllers;

use App\Models\{User, Fakultas};
use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->user = new User();
        $this->fakultas = new Fakultas();
    }

    public function index()
    {
        $users = $this->user->findAll();

        return view('admin/user', [
            'title' => 'Daftar User',
            'users' => $users,
            'fakultas' => $this->fakultas->findAll()
        ]);
    }

    public function create()
    {
        $nama = $this->request->getVar('nama');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $c_password = $this->request->getVar('c_password');
        $level = $this->request->getVar('level');
        $id_fakultas = $this->request->getVar('id_fakultas');


        if($password != $c_password) {
            session()->setFlashdata('error', 'Password tidak sama!');
            return redirect()->to('/user');
        }

        $this->user->insert([
            'nama' => $nama,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level' => $level,
            'id_fakultas' => $id_fakultas
        ]);

        session()->setFlashdata('success', 'Akun berhasil dibuat!');
        return redirect()->to('/user');
    }

    public function detail()
    {
        $data = $this->user->find($this->request->getVar('id'));

        return $this->response->setJSON($data);
    }

    public function update()
    {
        if($this->request->getVar('password') != $this->request->getVar('c_password')) {
            session()->setFlashdata('error', 'Password tidak sama!');
            return redirect()->to('/user');
        }

        $data = $this->user->find($this->request->getVar('id'));

        $data['nama'] = $this->request->getVar('nama');
        $data['username'] = $this->request->getVar('username');
        $data['password'] = $this->request->getVar('password');
        $data['level'] = $this->request->getVar('level');
        $data['id_fakultas'] = $this->request->getVar('id_fakultas');

        // update data
        $this->user->save($data);

        session()->setFlashdata('success', 'Akun berhasil diupdate!');

        return redirect()->to('/user');
    }

    public function delete()
    {
        $data = $this->user->find($this->request->getVar('id'));
        $this->user->delete($data['id']);

        session()->setFlashdata('success', 'Akun berhasil dihapus!');

        return redirect()->to('/user');
    }
}
