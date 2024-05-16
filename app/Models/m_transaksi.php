<?php

namespace App\Models;

use CodeIgniter\Model;

class m_transaksi extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'no_nota', 'customer', 'no_telp', 'alamat',  'status',

        'order_id', 'payment_type', 'payment_method', 'transaction_time', 'transaction_status', 'va_number', 'bank'

    ];

    public function histori($id_transaksi)
    {
        return $this->where(['id_transaksi' => $id_transaksi])->first();
    }

    public function cetak($id_transaksi)
    {
        $builder = $this->db->table('keranjang');
        $builder->join('transaksi', 'transaksi.id_transaksi=keranjang.id_trx')->join('produk', 'produk.id_produk=keranjang.id_produk')
            ->where('id_transaksi', $id_transaksi);
        $query = $builder->get();
        return $query->getResultArray();
    }


    public function lap_penjualan($tgl_awal, $tgl_akhir)
    {
        $builder = $this->db->table('keranjang');
        $builder->join('transaksi', 'transaksi.id_transaksi=keranjang.id_trx')->join('produk', 'produk.id_produk=keranjang.id_produk')->where('transaction_time >=', $tgl_awal)
            ->where('transaction_time <=', $tgl_akhir);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
