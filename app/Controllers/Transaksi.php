<?php

namespace App\Controllers;

use App\Models\m_produk;
use App\Models\m_keranjang;
use App\Models\m_transaksi;
use App\Models\m_user;
use App\Models\m_server;
use Dompdf\Dompdf;
use Predis\Command\Argument\Server\To;

class Transaksi extends BaseController
{
    protected $m_produk;
    protected $m_keranjang;
    protected $m_transaksi;
    protected $m_user;
    protected $m_server;
    public function __construct()
    {
        $this->m_produk = new m_produk();
        $this->m_keranjang = new m_keranjang();
        $this->m_transaksi = new m_transaksi();
        $this->m_user = new m_user();
        $this->m_server = new m_server();
        helper('form');
    }
    public function index($id_transaksi)
    {
        // cetak nota
        $transaksi = new m_transaksi();
        $cetak = $transaksi->cetak($id_transaksi);
        $histori = $transaksi->histori($id_transaksi);
        $data = [
            'histori' => $histori, 'id_transaksi' => $id_transaksi,
            'result' => $cetak, 'id_transaksi' => $id_transaksi,

        ];
        $view = view('konten/admin/cetak_nota', $data);
        $dompdf = new Dompdf();

        // instantiate and use the dompdf class
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('a5', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream(" Nota", array('Attachment' => false));
    }



    // melihat histori pembelian
    public function histori()
    {
        $data = [
            'cart' => \Config\Services::cart(),


            'keranjang' => $this->m_transaksi->where('customer', session()->username)->paginate(10),
            'pager' => $this->m_transaksi->pager,

        ];
        return view('konten/riwayat_pembelian', $data);
    }

    // melihat detail pembelian dan update Status 
    public function detail_pembelian($id_transaksi)

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

        $data = new m_transaksi();
        $cekdata = $data->find($id_transaksi);

        $status = \Midtrans\Transaction::status($cekdata['order_id']);

        $this->m_transaksi->update(
            $id_transaksi,
            [
                'transaction_status' => $status->transaction_status
            ]
        );

        $data = [
            'cart' => \Config\Services::cart(),
            'transaksi' => $this->m_transaksi->histori($id_transaksi),
            'barang' => $this->m_keranjang->barang($id_transaksi),
            'client' => $server['client_key']
        ];
        return view('konten/detail_pembelian', $data);
    }

    // form pembayaran
    public function invoice()
    {

        $server = $this->m_server->find(1);
        $data = [
            'cart' => \Config\Services::cart(),
            'client' => $server['client_key']
        ];
        return view('konten/form_bayar', $data);
    }


    // pembelian midtrans
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
            $status = $this->request->getPost('status');
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
                'email'            => session()->email,
                'shipping_address' => $shipping_address
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
                'status' => $status,
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
            $status = $this->request->getPost('status');
            $order_id = $this->request->getPost('order_id');
            $payment_type = $this->request->getPost('payment_type');
            $transaction_time = $this->request->getPost('transaction_time');
            $transaction_status = $this->request->getPost('transaction_status');
            $va_number = $this->request->getPost('va_number');
            $bank = $this->request->getPost('bank');



            $this->m_transaksi->save(
                [
                    'no_nota' => $this->m_keranjang->kode(),
                    'customer' => $customer,
                    'no_telp' => $telp,
                    'alamat' => $alamat,
                    'status' => $status,
                    'order_id' => $order_id,
                    'payment_method' => "Midtrans",
                    'payment_type' => $payment_type,
                    'transaction_time' => $transaction_time,
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
                $this->m_keranjang->save([
                    'id_trx' => $this->m_transaksi->getInsertID(),
                    'id_produk' => $id,
                    'nm_barang' => $name,
                    'qty' => $qty,
                    'total' => $total,
                ]);
            }
            $cart->destroy();
            $json = ['sukses' => 'Transaksi Berhasil Disimpan Silahkan Lakukan Pembayaran'];
            echo json_encode($json);
        }
    }

    // cancel pembelian 
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


        $data = new m_transaksi();
        $cekdata = $data->find($id);
        \Midtrans\Transaction::cancel($cekdata['order_id']);



        session()->setflashdata('pesan', 'dibatalkan');
        return redirect()->to('transaksi/detail_pembelian/' . $this->request->uri->getSegment(3));
    }


    public function tunai()
    {
        $cart = \Config\Services::cart();

        $customer = $this->request->getPost('customer');
        $alamat = $this->request->getPost('alamat');
        $status = $this->request->getPost('status');



        $this->m_transaksi->save(
            [
                'no_nota' => $this->m_keranjang->kode(),
                'customer' => $customer,
                'no_telp' => 0,
                'alamat' => $alamat,
                'status' => $status,
                'order_id' => 0,
                'payment_method' => "Tunai",
                'payment_type' => 0,
                'transaction_time' =>  date("Y-m-d H:i:s"),
                'transaction_status' => "settlement",
                'va_number' => 0,
                'bank' => 0,
            ]
        );
        foreach ($cart->contents() as $value) {
            $id = $value['id'];
            $name = $value['name'];
            $qty = $value['qty'];
            $total = $value['subtotal'];
            $this->m_keranjang->save([
                'id_trx' => $this->m_transaksi->getInsertID(),
                'id_produk' => $id,
                'nm_barang' => $name,
                'qty' => $qty,
                'total' => $total,
            ]);
        }
        $cart->destroy();
        session()->setflashdata('pesan', 'ditambahkan');
        return redirect()->to('admin/kasir');
    }




    public function konfirmasi()
    {
        $data = [
            'cart' => \Config\Services::cart(),

        ];
        return view('konten/konfirmasi', $data);
    }

    public function penerimaan($id)

    {
        $this->m_transaksi->update($id, [
            'status' => $this->request->getpost('status')
        ]);
        session()->setFlashdata('pesan', 'diterima');
        return redirect()->to('transaksi/detail_pembelian/' . $this->request->uri->getSegment(3));
    }
}
