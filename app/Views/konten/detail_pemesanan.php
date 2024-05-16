<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>




<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3">Riwayat Pesanan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Riwayat Pesanan</li>
            </ol>
        </nav>
    </div>
</div>
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            text: 'berhasil  <?= session()->getflashdata('pesan'); ?>',
            title: 'Transaksi',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>

<div class="container-xxl  my-6 py-6 pt-0" style="margin: 12rem 0;">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="container mb-5 mt-6">
                            <div class="row d-flex align-items-baseline">
                                <div class="col-xl-5">
                                    <p style="color: #7e8d9f;font-size: 18px;">Invoice >> <strong> <?= $transaksi['no_faktur']; ?></strong></p>
                                </div>
                                <div class="col-xl-5 ">
                                    <p style="color: #7e8d9f;font-size: 18px;" class="float-inline-end mt-3 pt-6">Status Transaksi >> <strong>
                                            <?php if ($transaksi['transaction_status'] == "pending") { ?>
                                                <span class="badge bg-secondary"><?= $transaksi['transaction_status']; ?></span>
                                            <?php  } elseif ($transaksi['transaction_status'] == "settlement") { ?>
                                                <span class="badge bg-success">Sukses</span>

                                            <?php } else { ?>
                                                <span class="badge bg-danger">Batal</span>
                                            <?php  } ?>
                                        </strong></p>
                                </div>
                                <div class="col-xl-2">
                                    <a href="<?= base_url(); ?>pesan/cetak/<?= $transaksi['id_transaksi']; ?>" target="_blank"><button class="btn btn-sm btn-primary"><i class="fas fa-download"></i>Unduh</button></a>

                                </div>
                                <hr>
                            </div>
                            <div class="container">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h4>Madani Backery & Cake</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <ul class="list-unstyled">
                                            <li class="text-muted">kepada: <span style="color:#5d9fc5 ;"><?= $transaksi['nama']; ?></span></li>
                                            <li class="text-muted"><?= $transaksi['alamat']; ?></li>
                                            <li class="text-muted"><i class="fas fa-phone"></i><?= $transaksi['no_telp']; ?></li>

                                        </ul>
                                    </div>
                                    <div class="col-xl-6 ">
                                        <ul class="list-unstyled float-end">
                                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Tanggal transaksi:</span><?= tanggal($transaksi['tgl_transaksi']); ?></li>
                                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Tanggal pakai : </span><?= tanggal($transaksi['tgl_kirim']); ?></li>
                                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                                <span class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                                                    <?= $transaksi['status']; ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row my-2 mx-1 justify-content-center">
                                    <table class="table table-striped table-borderless">
                                        <thead style="background-color:#84B0CA ;" class="text-white">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php
                                            $total = 0;
                                            $tot_qty = 0;
                                            foreach ($order as $value) : ?>
                                                <tr>
                                                    <th scope="row"><?= $no++; ?></th>
                                                    <td><?= $value['produk']; ?></td>
                                                    <td><?= $value['qty']; ?></td>
                                                    <td><?= rupiah($value['harga']); ?></td>
                                                    <td><?= rupiah($value['total']); ?></td>
                                                </tr>
                                                <?php $total += $value['total'] ?>
                                                <?php $tot_qty += $value['qty'] ?>
                                            <?php endforeach ?>
                                    </table>
                                </div>

                                <hr>
                                <div class="row">
                                    <?php if ($transaksi['transaction_status'] == "pending") { ?>
                                        <a href="<?= site_url('pesan/batal'); ?>/<?= $transaksi['id_transaksi']; ?>" class="btn btn-danger col-md-6 hapus">Batalkan Pesanan</a>
                                    <?php    } else { ?>
                                        <div class="col-xl-6">
                                            <p>Terima kasih atas pembelian Anda</p>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-6">
                                        <a href="<?= base_url(); ?>pesan/histori"> <button type="button" class="btn btn-primary text-capitalize float-end" style="background-color:#60bdf3 ;">Kembali</button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-body">

                        <p>Tagihan Pembayaran No.<?= $transaksi['no_faktur']; ?></p>
                        <hr>

                        <?php if ($transaksi['transaction_status'] == "settlement") { ?>
                            <h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif;">Total Belanja
                            </h3>
                            <h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif;"> <?= rupiah($total); ?></h3>
                            <div class="alert alert-warning " role="alert">
                                <h5 style="font-family:Arial, Helvetica, sans-serif;" class="text-center">Tagihan Berhasil Dibayarkan!</h5>
                            </div>

                            <form action="<?= site_url('pesan/penerimaan'); ?>/<?= $transaksi['id_transaksi']; ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="text" hidden value="diterima" name="status">
                                <button class="btn btn-danger col-md-12" type="submit">Konfirmasi Penerimaan</button>
                            </form>
                        <?php } elseif ($transaksi['transaction_status'] == 'cancel') { ?>

                            <h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif;">Total Belanja
                            </h3>
                            <h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif;"> <?= rupiah($total); ?></h3>

                            <div class="alert alert-danger text-center" role="alert">
                                Transaksi Dibatalkan
                            </div>

                        <?php } elseif ($transaksi['transaction_status'] == 'expire') { ?>

                            <h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif;">Total Belanja
                            </h3>
                            <h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif;"> <?= rupiah($total); ?></h3>

                            <div class="alert alert-danger text-center" role="alert">
                                Transaksi Kadaluarsa
                            </div>


                        <?php  } else { ?>
                            <h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif;">Total Belanja
                            </h3>
                            <h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif;"> <?= rupiah($total); ?></h3>
                            <br>
                            Silahkan lakukan Pembayaran ke nomor VA Berikut
                            <h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif" ;> (<?= $transaksi['bank']; ?>)<?= $transaksi['va_number']; ?></h3>


                        <?php   } ?>



                    </div>
                </div>
            </div>
        </div>




    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=<?= $client; ?>></script>

<script>
    $(document).on('click', '.hapus', function(e) {
        e.preventDefault();
        const href = this.href
        Swal.fire({
            title: 'Apakah yakin  ',
            text: "Anda akan membatalkan pesanan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })

    })
</script>




<?= $this->endsection('conten'); ?>
<?php
function rupiah($angka)
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
}
?>