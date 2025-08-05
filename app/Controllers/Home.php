<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Home extends BaseController
{
    public function index(): string
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return redirect()->to('/auth/login');
    }

    public function dashboard()
    {
        $mahasiswaModel = new MahasiswaModel();
        $data = [
            'title' => 'Dashboard',
            'total_mahasiswa' => $mahasiswaModel->countAll(),
            'recent_mahasiswa' => $mahasiswaModel->orderBy('created_at', 'DESC')->limit(5)->findAll()
        ];
        
        return view('dashboard', $data);
    }
}
