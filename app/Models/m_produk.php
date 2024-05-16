<?php

namespace App\Models;

use CodeIgniter\Model;

class m_produk extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = ['id_kategori', 'nm_produk', 'harga', 'keterangan', 'gambar'];



    // join tabel
    public function getall()
    {
        $builder = $this->db->table('produk');
        $builder->join('kategori', 'kategori.id_kategori=produk.id_kategori');
        $query = $builder->get();
        return $query->getResultArray();
    }


    // detail produk
    public function Detail($id_produk)
    {
        $builder = $this->db->table('produk');
        $builder->join('kategori', 'kategori.id_kategori=produk.id_kategori')->where('id_produk', $id_produk);
        $query = $builder->get();
        return $query->getResultArray();
    }


    // paginasi
    public function page($num, $keyword = null)
    {

        $builder = $this->builder();
        $builder->join('kategori', 'kategori.id_kategori=produk.id_kategori');
        return [
            'produk' => $this->paginate($num),
            'pager' => $this->pager,
            'cart' =>  \Config\Services::cart(),
          
        ];
    }

    // edit produk
    public function edit($id_produk)
    {
        return $this->where(['id_produk' => $id_produk])->first();
    }



    // public function kode()
    // {
    //     $this->db->select('RIGHT(transaction.no_order,2) as no_order', FALSE);
    //     $this->db->order_by('no_order', 'DESC');
    //     $this->db->limit(1);
    //     $query = $this->db->get('transaction');  //cek dulu apakah ada sudah ada kode di tabel.    
    //     if ($query->num_rows() <> 0) {
    //         //cek kode jika telah tersedia    
    //         $data = $query->row();
    //         $kode = intval($data->no_order) + 1;
    //     } else {
    //         $kode = 1;  //cek jika kode belum terdapat pada table
    //     }
    //     $tgl = date('dmY');
    //     $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
    //     $kodetampil = "TR" . $tgl . $batas;  //format kode
    //     return $kodetampil;
    // }



}
