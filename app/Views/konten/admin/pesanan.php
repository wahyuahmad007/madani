<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<!-- sweetalert2 -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            text: 'berhasil  <?= session()->getflashdata('pesan'); ?>',
            title: 'pesanan',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pesanan</h1>
    </div>
    <div class="card o-hidden border-0 shadow-lg ">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h6>Data Pesanan</h6>
                </div>
                <div class="col-md-2">
                    <!-- <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-plus-circle mr-2"></i>Tambah </button> -->
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No faktur</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Transaksi</th>
                            <th>Tanggal Kirim</th>
                            <th>Status</th>
                            <th>opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($pesan as $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['no_faktur']; ?></td>
                                <td><?= $value['nama']; ?></td>
                                <td><?= tanggal($value['tgl_transaksi']); ?></td>
                                <td><?= tanggal($value['tgl_kirim']); ?></td>
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

                                        <a href="<?= base_url(); ?>admin/detail_pesanan/<?= $value['id_transaksi']; ?>"><button class="btn btn-sm btn-primary"> <i class="fas fa-bars me-2"></i>Detail</button></a>


                                    <?php     } elseif ($value['transaction_status'] == "pending") { ?>
                                        <a href="<?= base_url(); ?>admin/detail_pesanan/<?= $value['id_transaksi']; ?>"> <button class="btn btn-sm btn-primary"> <i class="fas fa-bars me-2"></i>Detail</button>
                                        </a>
                                    <?php   } else { ?>
                                        <a href="<?= base_url(); ?>admin/detail_pesanan/<?= $value['id_transaksi']; ?>"> <button class="btn btn-sm btn-primary"> <i class="fas fa-bars me-2"></i>Detail</button>
                                        </a>
                                        <a href="<?= base_url(); ?>admin/hapus_pesanan/<?= $value['id_transaksi']; ?>"> <button class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></button>
                                        </a>




                                    <?php } ?>







                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No faktur</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Transaksi</th>
                            <th>Status</th>
                            <th>opsi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- modal input -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="<?= base_url(); ?>admin/tambah_pesanan" method="post">
        <div class="modal-dialog modal-m ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> <i class="fas fa-plus-circle"></i> Tambah Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nama">nama customer</label>
                            <input type="text" class="form-control " name="nama" required autofocus>

                        </div>
                        <div class="col-md-6">
                            <label for="nomor">nomor telphone</label>
                            <input type="number" class="form-control " name="nomor" required>
                        </div>
                    </div>
                    <label for="alamat">alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" cols="5" rows="3" required></textarea>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="jumlah">jumlah</label>
                            <input type="number" class="form-control" name="jumlah" required>
                        </div>
                        <div class="col-md-6">
                            <label for="harga">harga</label>
                            <input type="number" class="form-control" name="harga" required>
                        </div>
                        <input type="text" hidden value="belum ada proses" name="status" class="form-control">
                    </div>
                    <label for="pesan">Pesan</label>
                    <textarea class="form-control" name="pesan" id="pesan" cols="5" rows="3" required></textarea>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-danger btn-sm float-end" data-bs-dismiss="modal"> <i class="fas fa-times-circle"></i> Batal</button>
                        <button type="submit" class="btn btn-success btn-sm"> <i class="fas fa-check-circle"></i> Simpan</button>
                    </div>
                </div>
            </div>
    </form>
</div>






<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=<?= $client; ?>></script>

<!-- datatable -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

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
} ?> ?>

<?= $this->endsection('content'); ?>