<?php

namespace App\Models;

use CodeIgniter\Model;

class m_home extends Model
{
    protected $table = 'produk';
    public function tot_produk()
    {
        return $this->db('madani')->table('produk')->countAll();
    }
    public function tot_jual()
    {
        return $this->db('madani')->table('transaksi')->countAll();
    }
    public function tot_kategori()
    {
        return $this->db('madani')->table('kategori')->countAll();
    }

    public function tot_pendapatan()
    {
        $builder = $this->db->table('keranjang');
        $builder->selectSum('total');
        $query = $builder->get();
        return $query->getRow()->total;
    }


    public function transaksi($tahun)
    {

        $builder = $this->db->table('keranjang');
        $builder->select('MONTH(transaction_time) bulan,sum(total)  total')->join('transaksi', 'transaksi.id_transaksi=keranjang.id_trx')->where('YEAR(transaction_time)', $tahun)->orderBy('MONTH(transaction_time)');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function produk($tahun)
    {
        $builder = $this->db->table('keranjang');
        $builder->select('MONTH(transaction_time) bulan,count(qty) total')->join('transaksi', 'transaksi.id_transaksi=keranjang.id_trx')->where('YEAR(transaction_time)', $tahun)->orderBy('MONTH(transaction_time)');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
