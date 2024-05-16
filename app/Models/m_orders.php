<?php

namespace App\Models;

use CodeIgniter\Model;

class m_orders extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'id_order';
    protected $useAutoIncrement = true;
    protected $allowedFields = [ 'id_pesan', 'id_produk', 'produk', 'qty', 'total'];


    public function barang($id_transaksi)
    {
        $builder = $this->db->table('orders');
        $builder->join('pesanan', 'pesanan.id_transaksi=orders.id_transaksi')->join('produk', 'produk.id_produk=orders.id_produk')->where('id_transaksi', $id_transaksi);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function histori($id_transaksi)
    {
        $builder = $this->db->table('orders');
        $builder->join('pesanan', 'pesanan.id_transaksi=orders.id_pesan')->join('produk', 'produk.id_produk=orders.id_produk')->where('id_pesan', $id_transaksi);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
