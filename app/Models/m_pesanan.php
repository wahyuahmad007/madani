<?php

namespace App\Models;

use CodeIgniter\Model;

class m_pesanan extends Model
{
    protected $table      = 'pesanan';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['no_faktur', 'nama', 'alamat', 'no_telp', 'tgl_transaksi', 'tgl_kirim',  'status', 'order_id', 'payment_type', 'payment_method', 'transaction_status', 'va_number', 'bank'];


    public function histori($id_transaksi)
    {
        return $this->where(['id_transaksi' => $id_transaksi])->first();
    }

    public function kode()
    {
        $this->db->table('pesanan')->select('RIGHT(pesanan.no_faktur) as no_faktur', FALSE);
        $this->db->table('pesanan')->orderby('no_faktur', 'DESC');
        $this->db->table('pesanan');
        $query = $this->db->table('pesanan');  //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->countAll() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->countAll();
            $kode = intval($data) + 1;
        } else {
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $tgl = date('dmY');
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "FP" . $tgl . $batas;  //format kode
        return $kodetampil;
    }


    public function cetak($id_transaksi)
    {
        $builder = $this->db->table('orders');
        $builder->join('pesanan', 'pesanan.id_transaksi=orders.id_pesan')->join('produk', 'produk.id_produk=orders.id_produk')->where('id_transaksi', $id_transaksi);
        $query = $builder->get();
        return $query->getResultArray();
    }




    public function pesanan($tgl_awal, $tgl_akhir)
    {
        $builder = $this->db->table('orders');
        $builder->join('pesanan', 'pesanan.id_transaksi=orders.id_pesan')->join('produk', 'produk.id_produk=orders.id_produk')->where('tgl_transaksi >=', $tgl_awal)
            ->where('tgl_transaksi <=', $tgl_akhir);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function customer()
    {
        $builder = $this->db->table('pesanan');
        $builder->where('nama', session()->username)->orderBy('no_faktur', 'desc');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
