<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = ['cart' => \Config\Services::cart()];
        return view('konten/home', $data);
    }
}
