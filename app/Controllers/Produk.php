<?php

namespace App\Controllers;

use App\Models\m_produk;
use App\Models\m_keranjang;
use App\Models\m_transaksi;
use App\Models\m_user;

class Produk extends BaseController
{
    protected $m_produk;
    protected $m_keranjang;
    protected $m_transaksi;
    protected $m_user;
    public function __construct()
    {
        $this->m_produk = new m_produk();
        $this->m_keranjang = new m_keranjang();
        $this->m_transaksi = new m_transaksi();
        $this->m_user = new m_user();
        helper('form');
    }

    // tampil produk
    public function index(): string
    {

        $keyword = $this->request->getGet('keyword');
        $data = $this->m_produk->page(9, $keyword);
        return view('konten/produk', $data);
    }

    // tambah keranjang
    public function keranjang()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $this->request->getPost('id'),
            'qty'     => 1,
            'price'   => $this->request->getPost('price'),
            'name'    => $this->request->getPost('name'),
            'options' => array($this->request->getPost('keterangan'))
        ));
        session()->setFlashdata('pesan', 'Ditambahkan');
        return redirect()->to('produk');
    }

    // detail keranjang
    public function detail_keranjang()
    {
        $data = ['cart' => \Config\Services::cart()];
        return view('konten/detail_keranjang', $data);
    }

    // update keranjang
    public function update_keranjang()
    {
        $cart = \Config\Services::cart();
        $i = 1;
        foreach ($cart->contents() as $value) {
            $cart->update(array(
                'rowid'   =>  $value['rowid'],
                'qty'     => $this->request->getpost('qty' . $i++),

            ));
        }
        session()->setFlashdata('pesan', 'Diupdate');
        return redirect()->to('produk/detail_keranjang');
    }

    // hapus keranjang
    public function hapus_keranjang($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        session()->setFlashdata('pesan', 'Dihapus');
        return redirect()->to('produk/detail_keranjang');
    }
}
