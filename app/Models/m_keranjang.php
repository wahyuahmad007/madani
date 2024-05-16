<?php

namespace App\Models;

use CodeIgniter\Model;

class m_keranjang extends Model
{
    protected $table      = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_produk', 'id_trx', 'nm_barang', 'qty', 'total'];


    public function barang($id_transaksi)
    {
        $builder = $this->db->table('keranjang');
        $builder->join('transaksi', 'transaksi.id_transaksi=keranjang.id_trx')->join('produk', 'produk.id_produk=keranjang.id_produk')->where('id_trx', $id_transaksi);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function kode()
    {
        $this->db->table('transaksi')->select('RIGHT(transaksi.no_nota) as no_nota', FALSE);
        $this->db->table('transaksi')->orderby('no_nota', 'DESC');
        $this->db->table('transaksi');
        $query = $this->db->table('transaksi');  //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->countAll() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->countAll();
            $kode = intval($data) + 1;
        } else {
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $tgl = date('dmY');
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "TR" . $tgl . $batas;  //format kode
        return $kodetampil;
    }
}
