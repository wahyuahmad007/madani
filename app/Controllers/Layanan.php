<?php

namespace App\Controllers;

class Layanan extends BaseController
{
    public function index(): string
    {
        $data = ['cart' => \Config\Services::cart()];
        return view('konten/layanan', $data);
    }
}
