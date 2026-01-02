<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper('form');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->userModel->where('username', $username)->first(); //dd($user); exit; //dd($this->userModel->getLastQuery()->getQuery()); exit;

            if ($user && password_verify($password, $user['password']) && $user['is_active']) {
                // Get user with role information
                $userWithRole = $this->userModel->getUserWithRole($user['id']);
                
                // Update last login
                $this->userModel->updateLastLogin($user['id']);
                
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'role_id' => $user['role_id'],
                    'role_name' => $userWithRole['role_name'] ?? $user['role'],
                    'logged_in' => true
                ]);
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('error', 'Username atau password salah');
            }
        }

        return $this->render('auth/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role' => 'user'
            ];

            if ($this->userModel->save($data)) {
                session()->setFlashdata('success', 'Registrasi berhasil, silakan login');
                return redirect()->to('/auth/login');
            } else {
                session()->setFlashdata('error', 'Registrasi gagal');
            }
        }

        return $this->render('auth/register');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
