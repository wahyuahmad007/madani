<?= $this->extend('layout/template') ?>


<?= $this->section('content') ?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3">Riwayat Pembelian</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Riwayat Pembelian</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-fluid col-md-6">

    <div class="container mt-2">


        <div class="card" style="background-color: #EBEDEF ;">
            <ul class="nav nav-tabs ">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= site_url('transaksi/histori'); ?>">Pembelian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('pesan/histori'); ?>">Pemesanan</a>
                </li>
            </ul>
            <?php $no = 1;
            $total = 0;
            ?>
            <?php
            foreach ($keranjang as $value) : ?>

                <?php if ($value['id_transaksi'] == 0) { ?>
                    <p class="m-3"> Tidak ada data pembelian yang ditemukan
                    </p>
                <?php   } else { ?>
                    <div class="card m-3 py-2" >
                        <div class="card-body mt-2 ">
                            <div class="row">
                                <div class="col-md-3">
                                    No.Pesanan
                                    <br>
                                    <?= $value['no_nota']; ?>
                                    <br>
                                    <?= $value['transaction_time']; ?>
                                </div>
                                <div class="col-md-3">
                                    Status Pembayaran
                                    <br>
                                    <?php if ($value['transaction_status'] == "pending") { ?>
                                        <span class="badge bg-secondary"><?= $value['transaction_status']; ?></span>
                                    <?php  } elseif ($value['transaction_status'] == "settlement") { ?>
                                        <span class="badge bg-success">Sukses</span>

                                    <?php } else { ?>
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    <?php  } ?>
                                </div>
                                <div class="col-md-3">
                                    Tipe pembayaran <br>
                                    <?= $value['payment_type']; ?> </div>
                                <div class="col-md-3">
                                    <a href="<?= site_url('transaksi/detail_pembelian'); ?>/<?= $value['id_transaksi']; ?>" class="float-end">Lihat Detail</a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    Status Pesanan
                                    <br>

                                    <?= $value['status']; ?>


                                </div>
                                <div class="col-md-3">
                                    Metode Bayar
                                    <br>
                                    <?= $value['payment_method']; ?>
                                </div>


                            </div>

                        </div>
                    </div>
                <?php } ?>
            <?php endforeach ?>
            <div class=" text-center ms-3">
                <?= $pager->links('default', 'default_full') ?>
            </div>

        </div>


    </div>

</div>













<!-- tanggal -->
<?php function tanggal($tanggal)
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