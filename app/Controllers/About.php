<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index(): string
    {
        $data = ['cart' => \Config\Services::cart()];
        return view('konten/about', $data);
    }
}
