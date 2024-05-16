<?php

namespace App\Controllers;

use App\Models\m_pesanan;
use App\Models\m_produk;
use App\Models\m_orders;
use App\Models\m_server;
use Dompdf\Dompdf;


class Pesan extends BaseController
{
    protected $m_pesanan;
    protected $m_produk;
    protected $m_orders;
    protected $m_server;
    public function __construct()
    {
        $this->m_pesanan = new m_pesanan();
        $this->m_produk = new m_produk();
        $this->m_orders = new m_orders();
        $this->m_server = new m_server();
        helper('form');
    }
    public function index(): string
    {
        $cekserver = $this->m_server->find(1);
        $data = [
            'produk' => $this->m_produk->paginate(5),
            'pager' => $this->m_produk->pager,
            'cart' =>   \Config\Services::cart(),
            'client' => $cekserver['client_key']
        ];

        return view('konten/pesan', $data);
    }


    public function histori()
    {
        $data = [
            'cart' => \Config\Services::cart(),
            'pesan' => $this->m_pesanan->where('nama', session()->username)->orderBy('tgl_transaksi', 'desc')->paginate(10),
            'pager' => $this->m_pesanan->pager,
        ];
        return view('konten/riwayat_pesanan', $data);
    }

    public function detail($id_transaksi)
    {


        $server = $this->m_server->find(1);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $server['server_key'];
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $data = new m_pesanan();
        $cekdata = $data->find($id_transaksi);

        $status = \Midtrans\Transaction::status($cekdata['order_id']);

        $this->m_pesanan->update(
            $id_transaksi,
            [
                'transaction_status' => $status->transaction_status
            ]
        );
        $data = [
            'cart' => \Config\Services::cart(),
            'transaksi' => $this->m_pesanan->histori($id_transaksi),
            'order' => $this->m_orders->histori($id_transaksi),
            'client' => $server['client_key']

        ];
        return view('konten/detail_pemesanan', $data);
    }
    public function tambah_pesanan()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $this->request->getPost('id'),
            'qty'     => 1,
            'price'   => $this->request->getPost('price'),
            'name'    => $this->request->getPost('name'),
            'options' => array($this->request->getPost('keterangan'))
        ));
        return redirect()->to('pesan');
    }

    public function update_pesan()
    {
        $cart = \Config\Services::cart();
        $i = 1;
        foreach ($cart->contents() as $value) {
            $cart->update(array(
                'rowid'   =>  $value['rowid'],
                'qty'     => $this->request->getpost('qty' . $i++),

            ));
        }
        return redirect()->to('pesan/tambah_pesanan');
    }
    public function bayar()
    {
        if ($this->request->isAJAX()) {
            $cart = \Config\Services::cart();
            $server = $this->m_server->find(1);


            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = $server['server_key'];
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;



            $customer = $this->request->getPost('customer');
            $telp = $this->request->getPost('telp');
            $alamat = $this->request->getPost('alamat');
            $tgl = $this->request->getPost('tgl');


            // Populate items
            foreach ($cart->contents() as $value) :
                $items[] = [
                    'id'       => $value['id'],
                    'price'    => $value['price'],
                    'quantity' => $value['qty'],
                    'name'     => $value['name'],
                ];
            endforeach;
            $shipping_address = array(

                'address'      => session()->alamat,

            );
            // Populate customer's info
            $customer_details = array(
                'first_name'       => session()->username,
                'phone'            => session()->telp,
                'shipping_address' => $shipping_address,
                'email'            => session()->email
            );

            $params = [
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => 500000,
                ),
                'item_details'        => $items,
                'customer_details'    => $customer_details
            ];
            $json = [
                'customer' => $customer,
                'telp' => $telp,
                'alamat' => $alamat,
                'tgl' => $tgl,
                'snapToken' => \Midtrans\Snap::getSnapToken($params)
            ];


            echo json_encode($json);
        }
    }
    // save transaksi
    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $cart = \Config\Services::cart();

            $customer = $this->request->getPost('customer');
            $telp = $this->request->getPost('telp');
            $alamat = $this->request->getPost('alamat');
            $tgl = $this->request->getPost('tgl');
            $order_id = $this->request->getPost('order_id');
            $payment_type = $this->request->getPost('payment_type');
            $transaction_status = $this->request->getPost('transaction_status');
            $va_number = $this->request->getPost('va_number');
            $bank = $this->request->getPost('bank');



            $this->m_pesanan->save(
                [
                    'no_faktur' => $this->m_pesanan->kode(),
                    'nama' => $customer,
                    'alamat' => $alamat,
                    'no_telp' => $telp,
                    'tgl_transaksi' => date('y-m-d'),
                    'tgl_kirim' => $tgl,
                    'status' => "belum diproses",
                    'order_id' => $order_id,
                    'payment_type' => $payment_type,
                    'payment_method' => "Midtrans",
                    'transaction_status' => $transaction_status,
                    'va_number' => $va_number,
                    'bank' => $bank,
                ]
            );
            foreach ($cart->contents() as $value) {
                $id = $value['id'];
                $name = $value['name'];
                $qty = $value['qty'];
                $total = $value['subtotal'];
                $this->m_orders->save([
                    'id_pesan' => $this->m_pesanan->getInsertID(),
                    'id_produk' => $id,
                    'produk' => $name,
                    'qty' => $qty,
                    'total' => $total,
                ]);
            }
            $cart->destroy();
            $json = ['sukses' => 'Transaksi Berhasil Disimpan Silahkan Lakukan Pembayaran'];
            echo json_encode($json);
        }
    }

    public function batal($id)
    {
        $cekserver = $this->m_server->find(1);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $cekserver['server_key'];
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        $data = new m_pesanan();
        $cekdata = $data->find($id);
        \Midtrans\Transaction::cancel($cekdata['order_id']);



        session()->setflashdata('pesan', 'dibatalkan');
        return redirect()->to('pesan/detail/' . $this->request->uri->getSegment(3));
    }


    public function penerimaan($id)
    {
        $this->m_pesanan->update($id, [
            'status' => $this->request->getpost('status')
        ]);
        session()->setFlashdata('pesan', 'diterima');
        return redirect()->to('pesan/detail/' . $this->request->uri->getSegment(3));
    }

    public function cetak($id_pesanan)
    {

        $pesanan = new m_pesanan();
        $customer = $pesanan->histori($id_pesanan);
        $barang = $pesanan->cetak($id_pesanan);
        $data = [
            'histori' => $customer, 'id_transaksi' => $id_pesanan,
            'barang' => $barang, 'id_transaksi' => $id_pesanan,

        ];
        $view = view('konten/admin/cetak_faktur', $data);
        $dompdf = new Dompdf();

        // instantiate and use the dompdf class
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('a5', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream(" Faktur", array('Attachment' => false));
    }


  
}
