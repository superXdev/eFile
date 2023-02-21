<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\BaseController;

class Login extends BaseController
{
    public function __construct()
    {
        $this->user = new User();
    }

    public function auth()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $this->user->where('username', $username)->first();

        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'       => $data['id'],
                    'nama'     => $data['nama'],
                    'username'     => $data['username'],
                    'level'     => $data['level'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            }else{
                $session->setFlashdata('error', 'Password salah!');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/');
        }
    }

    public function register()
    {
        $nama = $this->request->getVar('nama');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $c_password = $this->request->getVar('c_password');
        $id_fakultas = $this->request->getVar('id_fakultas');


        if($password != $c_password) {
            session()->setFlashdata('error', 'Password tidak sama!');
            return redirect()->to('/user');
        }

        $this->user->insert([
            'nama' => $nama,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level' => 2,
            'id_fakultas' => $id_fakultas
        ]);

        session()->setFlashdata('success', 'Silahkan login');
        return redirect()->to('/');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}
