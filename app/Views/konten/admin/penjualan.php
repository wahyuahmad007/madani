<?= $this->extend('layout/admin/template') ?>

<?= $this->section('content') ?>
<!-- sweetalert2 -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            text: 'berhasil  <?= session()->getflashdata('pesan'); ?>',
            title: 'pembelian',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Penjualan</h1>
    </div>
    <div class="card o-hidden border-0 shadow-lg ">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h6>Data Penjualan</h6>
                </div>
                <div class="col-md-2">
                    <a href="<?= base_url(); ?>admin/kasir"><button class="btn btn-primary ">Tambah</button></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nota </th>
                            <th>Customer</th>
                            <th>tanggal Transaksi</th>
                            <th>Metode bayar</th>
                            <th>Status Transaksi</th>
                            <th>opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($penjualan as $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <?= $value['no_nota']; ?>
                                </td>
                                <td>
                                    <?= $value['customer']; ?>
                                </td>
                                <td>
                                    <?= $value['transaction_time']; ?>
                                </td>

                                <td>
                                    <?php if ($value['payment_method'] == "Midtrans") { ?>
                                        <span class="badge badge-primary"><?= $value['payment_method']; ?></span>
                                    <?php } else { ?>
                                        <span class="badge badge-warning"><?= $value['payment_method']; ?></span>
                                    <?php  } ?>
                                </td>
                                <td>
                                    <?php if ($value['transaction_status'] == "pending") { ?>
                                        <span class="badge badge-secondary"><?= $value['transaction_status']; ?></span>
                                    <?php  } elseif ($value['transaction_status'] == "settlement") { ?>
                                        <span class="badge badge-success">Sukses</span>

                                    <?php } else { ?>
                                        <span class="badge badge-danger">Kadaluarsa</span>
                                    <?php  } ?>
                                </td>
                                <td>


                                    <?php if ($value['transaction_status'] == "settlement") { ?>

                                        <a href="<?= base_url(); ?>admin/detail_penjualan/<?= $value['id_transaksi']; ?>"><button class="btn btn-sm btn-primary"> <i class="fas fa-bars me-2"></i>Detail</button></a>


                                    <?php     } elseif ($value['transaction_status'] == "pending") { ?>
                                        <a href="<?= base_url(); ?>admin/detail_penjualan/<?= $value['id_transaksi']; ?>"><button class="btn btn-sm btn-primary"> <i class="fas fa-bars me-2"></i>Detail</button></a>

                                    <?php   } else { ?>
                                        <a href="<?= base_url(); ?>admin/detail_penjualan/<?= $value['id_transaksi']; ?>"><button class="btn btn-sm btn-primary"> <i class="fas fa-bars me-2"></i>Detail</button></a>
                                        <a href="<?= base_url(); ?>admin/hapus/<?= $value['id_transaksi']; ?>"><button class="btn btn-sm btn-danger"> <i class="fas fa-trash me-2"></i></button></a>
                                    <?php } ?>



                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>opsi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=<?= $client; ?>></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>


<?php function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
function tanggal($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
function bulan($bulan)
{
    switch ($bulan) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
    }
    return $bulan;
} ?>
<?= $this->endsection('content') ?>