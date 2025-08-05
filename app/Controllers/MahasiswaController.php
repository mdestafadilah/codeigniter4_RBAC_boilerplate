<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class MahasiswaController extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $data['mahasiswa'] = $this->mahasiswaModel->findAll();
        return view('mahasiswa/index', $data);
    }

    public function create()
    {
        return view('mahasiswa/create');
    }

    public function store()
    {
        $data = [
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'jurusan' => $this->request->getPost('jurusan'),
            'angkatan' => $this->request->getPost('angkatan'),
        ];

        if ($this->mahasiswaModel->save($data)) {
            session()->setFlashdata('success', 'Data mahasiswa berhasil ditambahkan');
        } else {
            session()->setFlashdata('error', 'Data mahasiswa gagal ditambahkan');
        }

        return redirect()->to('/mahasiswa');
    }

    public function edit($id)
    {
        $data['mahasiswa'] = $this->mahasiswaModel->find($id);
        
        if (!$data['mahasiswa']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view('mahasiswa/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'jurusan' => $this->request->getPost('jurusan'),
            'angkatan' => $this->request->getPost('angkatan'),
        ];

        if ($this->mahasiswaModel->update($id, $data)) {
            session()->setFlashdata('success', 'Data mahasiswa berhasil diperbarui');
        } else {
            session()->setFlashdata('error', 'Data mahasiswa gagal diperbarui');
        }

        return redirect()->to('/mahasiswa');
    }

    public function delete($id)
    {
        if ($this->mahasiswaModel->delete($id)) {
            session()->setFlashdata('success', 'Data mahasiswa berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data mahasiswa gagal dihapus');
        }

        return redirect()->to('/mahasiswa');
    }
}
