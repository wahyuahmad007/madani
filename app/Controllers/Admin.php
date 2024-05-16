<?php

namespace App\Controllers;

use App\Models\m_kategori;
use App\Models\m_produk;
use App\Models\m_pesanan;
use App\Models\m_transaksi;
use App\Models\m_keranjang;
use App\Models\m_home;
use App\Models\m_user;
use App\Models\m_server;
use Dompdf\Dompdf;

class Admin extends BaseController
{

    protected $m_kategori;
    protected $m_produk;
    protected $m_pesanan;
    protected $m_transaksi;
    protected $m_keranjang;
    protected $m_home;
    protected $m_user;
    protected $m_server;
    public function __construct()
    {
        $this->m_kategori = new m_kategori();
        $this->m_produk = new m_produk();
        $this->m_pesanan = new m_pesanan();
        $this->m_transaksi = new m_transaksi();
        $this->m_keranjang = new m_keranjang();
        $this->m_home = new m_home();
        $this->m_user = new m_user();
        $this->m_server = new m_server();
        helper('form');
    }

    // tampil dashboard
    public function index(): string
    {
        $data = [
            'tot_pendapatan' => $this->m_home->tot_pendapatan(),
            'tot_produk' => $this->m_home->tot_produk(),
            'tot_jual' => $this->m_home->tot_jual(),
            'tot_kategori' => $this->m_home->tot_kategori(),
        ];
        return view('konten/admin/dashboard', $data);
    }

    // Server Midtrans
    public function server()
    {

        $data = [
            'server' => $this->m_server->findall(),
        ];
        return view('konten/admin/server', $data);
    }
    // edit server Midtrans
    public function server_edit($id)
    {

        $this->m_server->update($id, [
            'server_key' => $this->request->getpost('server'),
            'client_key' => $this->request->getpost('client'),
        ]);
        session()->setflashdata('pesan', 'Ditambahkan');
        return redirect()->to('admin/server');
    }
    // tampil produk
    public function produk()
    {
        $data = [
            'produk' => $this->m_produk->getall(),
            'kategori' => $this->m_kategori->findAll(),
        ];
        return view('konten/admin/produk', $data);
    }

    //  tambah produk
    public function tambah_produk()
    {

        $filegambar = $this->request->getFile('gambar');
        $namagambar = $filegambar->getRandomName();
        $filegambar->move('asset/img/produk', $namagambar);
        $this->m_produk->save([
            'id_kategori' => $this->request->getPost('kategori'),
            'nm_produk' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getpost('keterangan'),
            'harga' => $this->request->getPost('harga'),
            'gambar' => $namagambar
        ]);
        session()->setflashdata('pesan', 'Ditambahkan');
        return redirect()->to('admin/produk');
    }

    // edit produk
    public function edit_produk($id_produk)
    {
        $data = [
            'produk' => $this->m_produk->edit($id_produk),
            'kategori' => $this->m_kategori->findAll(),
        ];
        return view('konten/admin/edit_produk', $data);
    }
    // update produk
    public function update_produk($id_produk)
    {

        $filegambar = $this->request->getFile('gambar');
        $namagambar = $filegambar->getRandomName();
        $filegambar->move('asset/img/produk', $namagambar);
        $this->m_produk->update($id_produk, [
            'id_kategori' => $this->request->getPost('kategori'),
            'nm_produk' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getpost('keterangan'),
            'harga' => $this->request->getPost('harga'),
            'gambar' => $namagambar
        ]);
        session()->setflashdata('pesan', 'Diedit');
        return redirect()->to('admin/produk');
    }

    // hapus produk
    public function hapus_produk($id_produk)
    {
        $produk = new m_produk();
        $produk->delete($id_produk);
        session()->setflashdata('pesan', 'Dihapus');
        return redirect()->to('admin/produk');
    }

    // detail produk
    public function detail_produk($id_produk)
    {
        $data = [
            'detail' => $this->m_produk->Detail($id_produk),
        ];
        return view('konten/admin/detail_produk', $data);
    }

    // tampil kategori
    public function kategori()
    {
        $data = [
            'kategori' => $this->m_kategori->findall(),
        ];
        return view('konten/admin/kategori', $data);
    }

    // tambah kategori
    public function add_kategori()
    {
        $this->m_kategori->Save([
            'nm_kategori' => $this->request->getpost('kategori'),
        ]);
        session()->setFlashdata('pesan', 'Ditambahkan');
        return redirect()->to('admin/kategori');
    }

    // hapus kategori
    public function hapus_kategori($id_kategori)
    {
        $kategori = new m_kategori();
        $kategori->delete($id_kategori);
        session()->setflashdata('pesan', 'Dihapus');
        return redirect()->to('admin/kategori');
    }


    // tampil pesanan
    public function pesanan()
    {
        $cekserver = $this->m_server->find(1);

        $data = [
            'pesan' => $this->m_pesanan->orderBy('no_faktur', 'desc')->findAll(),
            'client' => $cekserver['client_key']
        ];
        return view('konten/admin/pesanan', $data);
    }


    //  tambah pesanan
    public function tambah_pesanan()
    {


        $kode = $this->m_pesanan->kode();
        $this->m_pesanan->save([
            'no_faktur' => $kode,
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('nomor'),
            'tgl_transaksi' => date('y-m-d'),
            'tgl_kirim' => date('y-m-d'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga' => $this->request->getPost('harga'),
            'pesan' => $this->request->getPost('pesan'),
            'status' => $this->request->getPost('status'),

        ]);
        session()->setFlashdata('pesan', 'Ditambahkan');
        return redirect()->to('admin/pesanan');
    }


    // detail pesanan
    public function detail_pesanan($id_pesan)
    {
        $data = [
            'pesan' => $this->m_pesanan->histori($id_pesan),
            'barang' => $this->m_pesanan->cetak($id_pesan)
        ];
        return view('konten/admin/detail_pesanan', $data);
    }


    //  update pesanan
    public function update_pesanan($id_pesan)
    {
        $this->m_pesanan->update($id_pesan, [
            'harga' => $this->request->getPost('harga'),
            'status' => $this->request->getPost('status'),
            'tgl_kirim' => $this->request->getPost('tgl_kirim'),
        ]);
        session()->setFlashdata('pesan', 'diupdate');
        return redirect()->to('admin/detail_pesanan/' . $this->request->uri->getSegment(3));
    }

    public function hapus_pesanan($id_pesanan)
    {

        $data = new m_pesanan();
        $data->delete($id_pesanan);
        session()->setflashdata('pesan', 'Dihapus');
    }


    // tampil penjualan
    public function penjualan()
    {
        $cekserver = $this->m_server->find(1);
        $data = [
            'penjualan' => $this->m_transaksi->orderBy('no_nota', 'desc')->findall(),
            'client' => $cekserver['client_key']
        ];
        return view('konten/admin/penjualan', $data);
    }

    // melihat detail penjualan
    public function detail_penjualan($id_transaksi)

    {
        $data = [
            'transaksi' => $this->m_transaksi->histori($id_transaksi),
            'barang' => $this->m_keranjang->barang($id_transaksi)
        ];
        return view('konten/admin/detail_penjualan', $data);
    }

    // update detail penjualan
    public function update_penjualan($id_transaksi)
    {
        $this->m_transaksi->update(
            $id_transaksi,


            [
                'status' => $this->request->getPost('status'),
                'tgl_kirim' => $this->request->getpost('tgl_kirim')
            ]
        );
        session()->setFlashdata('pesan', 'diupdate');

        return redirect()->to('admin/detail_penjualan/' . $this->request->uri->getSegment(3));
    }

    // cetak nota
    public function cetak_nota($id_transaksi)
    {


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



    // cetak faktur
    public function cetak_faktur($id_pesanan)
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
    // area chart
    public function showChartTransaksi()

    {
        $tahun = $this->request->getVar('tahun');
        $data = $this->m_home->transaksi($tahun);
        $response = [
            'status' > true,
            'data' => $data
        ];
        echo json_encode($response);
    }
    // char bar
    public function showchartproduk()
    {
        $tahun = $this->request->getVar('tahun');
        $data = $this->m_home->produk($tahun);
        $response = [
            'status' > true,
            'data' => $data
        ];
        echo json_encode($response);
    }
    public function laporan()
    {
        return view('konten/admin/laporan');
    }
    //  cetak laporan penjualan
    public function laporan_penjualan($tgl_awal = null, $tgl_akhir = null)
    {
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $laporan = new m_transaksi();
        $tunggakan = $laporan->lap_penjualan($tgl_awal, $tgl_akhir);
        $data = [
            'result' => $tunggakan,
            'tglawal' => $tgl_awal,
            'tglakhir' => $tgl_akhir
        ];
        $view =  view('konten/admin/cetak_penjualan', $data);

        $dompdf = new Dompdf();
        // instantiate and use the dompdf class
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream("Laporan Penjualan", array('Attachment' => false));
    }
    //  cetak laporan pemesanan
    public function laporan_pesanan()
    {
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $laporan = new m_pesanan();
        $tunggakan = $laporan->pesanan($tgl_awal, $tgl_akhir);
        $data = [
            'result' => $tunggakan,
            'tglawal' => $tgl_awal,
            'tglakhir' => $tgl_akhir
        ];
        $view =  view('konten/admin/cetak_pesanan', $data);

        $dompdf = new Dompdf();
        // instantiate and use the dompdf class
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream("Laporan Penjualan", array('Attachment' => false));
    }

    public function kasir()
    {
        $data = [
            'kode' => $this->m_keranjang->kode(),
            'cart' => \Config\Services::cart(),
            'produk' => $this->m_produk->getall(),
        ];
        return view('konten/admin/kasir', $data);
    }




    public function tambah_penjualan()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $this->request->getPost('id'),
            'qty'     => 1,
            'price'   => $this->request->getPost('price'),
            'name'    => $this->request->getPost('name'),
            'options' => array($this->request->getPost('keterangan'))
        ));
        return redirect()->to('admin/kasir');
    }

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
        return redirect()->to('admin/tambah_penjualan');
    }

    public function hapus_keranjang($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to('admin/tambah_penjualan');
    }
    // simpan 
    public function simpan()
    {
        $cart = \Config\Services::cart();
        $nota = $this->m_keranjang->kode();
        $this->m_transaksi->save(
            [
                'no_nota' => $nota,
                'customer' => $this->request->getPost('customer'),
                'no_telp' => $this->request->getPost('nomer'),
                'alamat' => $this->request->getPost('alamat'),
                'tgl_trk' => $this->request->getpost('tanggal'),
                'tgl_kirim' => date('Y-m-d'),
                'status' => $this->request->getPost('status'),
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
        session()->setflasdata('pesan', 'diupdate');
        return redirect()->to('admin/penjualan');
    }
    public function hapus($id)
    {
        $data = new m_transaksi();
        $data->delete($id);
        session()->setflashdata('pesan', 'Dihapus');
        return redirect()->to('admin/penjualan');
    }
    public function user()
    {
        $data = ['user' => $this->m_user->getall()];
        return view('konten/admin/user', $data);
    }


    public function tambah_user()
    {
        $data = ['user' => $this->m_user->getall()];
        return view('konten/admin/register', $data);
    }
    public function process()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                    'is_unique' => 'Username sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
            'password_conf' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],
            'name' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $users = new m_user();
        $users->insert([
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'name' => $this->request->getVar('name'),
            'levels' => $this->request->getVar('levels')
        ]);
        session()->setflashdata('pesan', 'dibuat');
        return redirect()->to('admin/user');
    }

    public function hapus_user($id)
    {
        $id_user = new m_user();
        $id_user->delete($id);
        session()->setflashdata('pesan', 'Dihapus');
        return redirect()->to('admin/user');
    }
}
