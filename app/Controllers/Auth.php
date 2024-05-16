<?php

namespace App\Controllers;

use App\Models\m_user;

class Auth extends BaseController
{

    protected $m_user;

    public function __construct()
    {
        $this->m_user = new m_user();
    }

    public function index(): string
    {


        return view('auth/login');
    }

    public function cekuser()
    {
        $username = $this->request->getVar('username');
        $pass = $this->request->getVar('password');

        $validation = \config\services::validation();

        $valid = $this->validate([
            'username' => [
                'label' => 'username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $sesserror = [
                'errusername' => $validation->getError('username'),
                'errpassword' => $validation->getError('password')
            ];
            session()->setFlashdata($sesserror);
            return redirect()->to('auth');
        } else {
            $login = $this->m_user->where('username', $username)->first();
            if ($login == null) {
                $sesserror = [
                    'errusername' => 'username tidak ada',
                ];
                session()->setFlashdata($sesserror);
                return redirect()->to('auth');
            } else {
                if (password_verify($pass, $login['password'])) {
                    $sessionData = [
                        'id' => $login['id'],
                        'username' => $login['username'],
                        'alamat' => $login['alamat'],
                        'telp' => $login['telp'],
                        'email' => $login['email'],
                        'levels' => $login['levels'],
                    ];
                    session()->set($sessionData);
                    if (session()->levels == '1') {
                        return redirect()->to('admin');
                    } else {
                        return redirect()->to('/');
                    }
                } else {
                    $sesserror = [
                        'errpassword' => 'password salah',
                    ];
                    session()->setFlashdata($sesserror);
                    return redirect()->to('auth');
                }
            }
        }
    }

    public function register()
    {
        return view('auth/register');
    }
    public function process()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                    'is_unique' => 'Username sudah digunakan sebelumnya'
                ]
            ],
            'telepon' => [
                'rules' => 'required|min_length[12]|max_length[12]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 12 Karakter',
                    'max_length' => '{field} Maksimal 12 Karakter',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',

                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',

                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
            'password_conf' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],

        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $users = new m_user();
        $users->insert([
            'username' => $this->request->getVar('username'),
            'telp' => $this->request->getVar('telepon'),
            'alamat' => $this->request->getVar('alamat'),
            'email' => $this->request->getVar('email'),
            'levels' => 2,
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),



        ]);
        session()->setflashdata('pesan', 'dibuat');
        return redirect()->to('auth');
    }


    public function logout()
    {
        // hapus session
        session()->remove('id');
        session()->remove('username');
        session()->remove('telp');
        session()->remove('alamat');
        session()->remove('email');
        session()->remove('levels');
        // redirect login page
        return redirect()->to(route_to('/'));
    }
}
