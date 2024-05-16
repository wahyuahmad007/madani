<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            text: 'berhasil  <?= session()->getflashdata('pesan'); ?>',
            title: 'Pesanan',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>


<div class="container-fluid">
    <div class="row">
    <a href="<?= base_url(); ?>/admin/pesanan"> <button type="submit" class="btn btn-danger text-capitalize bg-warning my-3" >Kembali</button>
                                        </a>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="container mb-5 mt-3">
                        <div class="row d-flex align-items-baseline">
                            <div class="col-xl-9">
                                <p style="color: #7e8d9f;font-size: 20px;">No.Faktur >> <strong><?= $pesan['no_faktur']; ?></strong></p>
                            </div>
                            <div class="col-xl-3 float-end">
                                <a href="<?= base_url(); ?>admin/cetak_faktur/<?= $pesan['id_transaksi']; ?>" target="_blank" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
                            </div>
                            <hr>
                        </div>
                        <form action="<?= base_url(); ?>admin/update_pesanan/<?= $pesan['id_transaksi']; ?>" method="post">
                            <div class="container">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <img src="<?= base_url(); ?>asset/img/logo.jpeg" alt="" height="120px" width="auto">
                                        <h4 class="pt-0">Madani Backery & Cake</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-8">
                                        <ul class="list-unstyled">
                                            <li class="text-muted">Kepada: <span style="color:#5d9fc5 ;"><?= $pesan['nama']; ?></span></li>
                                            <li class="text-muted"><?= $pesan['alamat']; ?></li>
                                            <li class="text-muted"><i class="fas fa-phone"></i><?= $pesan['no_telp']; ?></li>
                                        </ul>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <label for="">Ubah Status</label>
                                                <select name="status" id="" class="form-select btn-m " required>
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Proses">Proses</option>
                                                    <option value="Kirim">Kirim</option>
                                                    <option value="Diterima">Diterima</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Tanggal Kirim</label>
                                                <input type="date" name="tgl_kirim" class="form-control" value="<?= date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-xl-4">
                                        <p class="text-muted">Invoice</p>
                                        <ul class="list-unstyled">
                                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">ID:</span><?= $pesan['no_faktur']; ?></li>
                                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Tanggal Transaksi: </span><?= tanggal($pesan['tgl_transaksi']); ?></li>
                                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Tanggal Kirim: </span><?= tanggal($pesan['tgl_kirim']); ?></li>
                                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status:</span>
                                                <?php if ($pesan['status'] == "Kirim") { ?>
                                                    <span class="badge badge-success text-white fw-bold"><?= $pesan['status']; ?></span>
                                                <?php  } elseif ($pesan['status'] == "Diterima") { ?>
                                                    <span class="badge badge-primary text-white fw-bold"><?= $pesan['status']; ?></span>

                                                <?php } else { ?>
                                                    <span class="badge badge-warning text-white fw-bold"><?= $pesan['status']; ?></span>
                                                <?php  } ?>
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
                                            $tot_qty = 0; ?>
                                            <?php foreach ($barang as $value) : ?>
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

                                        </tbody>

                                    </table>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-xl-10">
                                   
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="btn btn-primary text-capitalize" style="background-color:#60bdf3 ;">Update</button>
                                      
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h4 class="m-2 mt-3"> Rincian Pembayaran</h4>
                <hr>
                <table class="table table-striped">
                    <tr>
                        <td>Metode Bayar</td>
                        <td>:</td>
                        <td><?= $pesan['payment_type']; ?></td>
                    </tr>

                    <tr>
                        <td>Va Number</td>
                        <td>:</td>
                        <td><?= $pesan['va_number']; ?></td>
                    </tr>
                    <tr>
                        <td>Bank</td>
                        <td>:</td>
                        <td><?= $pesan['bank']; ?></td>
                    </tr>
                    <tr>
                        <td>Status transaksi</td>
                        <td>:</td>
                        <td>
                            <?php if ($pesan['transaction_status'] == "pending") { ?>
                                <span class="badge badge-secondary"><?= $pesan['transaction_status']; ?></span>
                            <?php  } elseif ($pesan['transaction_status'] == "settlement") { ?>
                                <span class="badge badge-success">Sukses</span>

                            <?php } else { ?>
                                <span class="badge badge-danger">Kadaluwarsa</span>
                            <?php  } ?>
                        </td>
                    </tr>
                    <h4 class="text-center">Total Amount</h4>
                    <h2 class="text-center"><?= rupiah($total); ?></h2>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection('content'); ?>

<!-- tanggal indo -->
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
}
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
} ?>