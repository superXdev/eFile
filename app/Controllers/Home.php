<?php

namespace App\Controllers;

use App\Models\{Arsip, Fakultas, Kategori, User};
class Home extends BaseController
{
    public function index()
    {
        $arsip = new Arsip();
        $fakultas = new Fakultas();
        $kategori = new Kategori();
        $user = new User();

        if(session()->get('level') == 1) {
            $files = $arsip->select('extensi, COUNT(*) as jumlah')->groupBy('extensi')->findAll();
            $uploads = $arsip->findAll(10);
        } else {
            $files = $arsip->where('id_user', session()->get('id'))->select('extensi, COUNT(*) as jumlah')->groupBy('extensi')->findAll();
            $uploads = $arsip->where('id_user', session()->get('id'))->findAll(10);
        }

        $data = [
            'title' => 'Dashboard',
            'arsip' => $arsip->countAll(),
            'user' => $user->countAll() - 2,
            'kategori' => $kategori->countAll(),
            'fakultas' => $fakultas->countAll(),
            'files' => $files,
            'uploads' => $uploads
        ];

        return view('admin/dashboard', $data);
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        $data = (new Fakultas())->findAll();
        return view('register', compact('data'));
    }
}
