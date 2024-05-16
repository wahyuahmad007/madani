<?= $this->extend('layout/template') ?>


<?= $this->section('content') ?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3">Pemesanan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Pemesanan</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-xxl">
    <div class="row g-0 ">
        <div class=" wow fadeInUp" data-wow-delay="0.1s">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="fas fa-home">Alamat Pengiriman</i>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="<?= session()->username; ?>" readonly>
                                        <label for="name">Nama lengkap</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="nomor" placeholder="Nomor " name="nomor" value="<?= session()->telp; ?>" readonly required>
                                        <label for="number">Nomor telephone</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a pesan here" id="alamat" style="height: 150px" name="alamat" readonly> <?= session()->alamat; ?></textarea>
                                        <label for="alamat">alamat lengkap</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="tgl" placeholder="Nama" name="tgl" value="<?= date('Y-m-d'); ?>">
                                        <label for="name">Tanggal Pakai</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" id="tombolPay">Bayar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table table-responsive">
                                <h5>Rincian Pemesanan</h5>
                                <div class="container  mt-3">
                                    <div class="row my-2 mx-1 justify-content-center">
                                        <?php echo form_open('pesan/update_pesan'); ?>
                                        <table class="table table-striped table-borderless">
                                            <thead style="background-color:#84B0CA ;" class="text-white">
                                                <tr>
                                                    <th scope="col" width='80px;'>Qty</th>
                                                    <th scope="col">Deskripsi</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Hapus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tot_qty = 0;
                                                $i = 1;
                                                $total = 0;
                                                foreach ($cart->contents() as $value) :
                                                    $tot_qty = $tot_qty + $value['qty'];
                                                    $total = $total + $value['subtotal'];
                                                ?>
                                                    <tr>
                                                        <td><input type="number" name="qty<?= $i++; ?>" class="form-control" value="<?= $value['qty']; ?>"></td>
                                                        <td><?= $value['name']; ?></td>
                                                        <td><?= rupiah($value['price']); ?></td>
                                                        <td><?= rupiah($value['subtotal']); ?></td>
                                                        <td><a href="<?= base_url(); ?>pesan/hapus/<?= $value['rowid']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <button class="btn btn-success" type="submit">Update</button>
                                    <?php echo form_close() ?>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Nama Produk</td>
                        <td>Deskripsi</td>
                        <td>Harga</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <?php foreach ($produk as $value) : ?>
                    <?php
                    echo form_open('pesan/tambah_pesanan');
                    echo form_hidden('id', $value['id_produk']);
                    echo form_hidden('price', $value['harga']);
                    echo form_hidden('name', $value['nm_produk']);
                    echo form_hidden('keterangan', $value['keterangan']);
                    ?>
                    <tbody>
                        <tr>
                            <td><?= $value['nm_produk']; ?></td>
                            <td><?= $value['keterangan']; ?></td>
                            <td><?= rupiah($value['harga']); ?></td>
                            <td><button type="submit" class="btn btn-primary btn-sm">Pilih</button></td>
                        </tr>
                    </tbody>
                    <?= form_close() ?>
                <?php endforeach; ?>
            </table>
            <div class=" text-center">
                <?= $pager->links('default', 'default_full') ?>
            </div>
        </div>


    </div>
</div>

<!-- Contact End -->

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=<?= $client; ?>></script>


<script>
    $(document).ready(function() {
        $('#tombolPay').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/pesan/bayar',
                data: {
                    customer: $('#nama').val(),
                    telp: $('#nomor').val(),
                    alamat: $('#alamat').val(),
                    tgl: $('#tgl').val(),
                },
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        Swal.fire('Error', response.error,
                            'error');
                    } else {
                        snap.pay(response.snapToken, {
                            // Optional
                            onSuccess: function(result) {
                                $.ajax({
                                    type: "post",
                                    url: "/pesan/simpan",
                                    data: {
                                        customer: response.customer,
                                        telp: response.telp,
                                        alamat: response.alamat,
                                        tgl: response.tgl,
                                        order_id: dataObj.order_id,
                                        payment_type: dataObj.payment_type,
                                        transaction_status: dataObj.transaction_status,
                                        va_number: dataObj.va_numbers[0].va_number,
                                        bank: dataObj.va_numbers[0].bank
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        if (response.sukses) {
                                            alert(response.sukses);
                                            window.location.reload();
                                        }
                                    },
                                });

                                /* You may add your own js here, this is just example */
                                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                // console.log(JSON.stringify(result, null, 2));
                            },

                            // Optional
                            onPending: function(result) {

                                let dataResult = JSON.stringify(result, null, 2);
                                let dataObj = JSON.parse(dataResult);

                                $.ajax({
                                    type: "post",
                                    url: "/pesan/simpan",
                                    data: {
                                        customer: response.customer,
                                        telp: response.telp,
                                        alamat: response.alamat,
                                        tgl: response.tgl,
                                        order_id: dataObj.order_id,
                                        payment_type: dataObj.payment_type,
                                        transaction_status: dataObj.transaction_status,
                                        va_number: dataObj.va_numbers[0].va_number,
                                        bank: dataObj.va_numbers[0].bank
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        if (response.sukses) {
                                            alert(response.sukses);
                                            window.location.reload();
                                        }

                                    },
                                });



                                /* You may add your own js here, this is just example */
                                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                // console.log(JSON.stringify(result, null, 2));

                            },
                            // Optional
                            onError: function(result) {

                                let dataResult = JSON.stringify(result, null, 2);
                                let dataObj = JSON.parse(dataResult);

                                $.ajax({
                                    type: "post",
                                    url: "/pesan/simpan",
                                    data: {
                                        customer: response.customer,
                                        telp: response.telp,
                                        alamat: response.alamat,
                                        tgl: response.tgl,
                                        order_id: dataObj.order_id,
                                        payment_type: dataObj.payment_type,
                                        transaction_status: dataObj.transaction_status,
                                        va_number: dataObj.va_numbers[0].va_number,
                                        bank: dataObj.va_numbers[0].bank
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        if (response.sukses) {
                                            alert(response.sukses);
                                            window.location.reload();
                                        }

                                    },
                                });

                                /* You may add your own js here, this is just example */
                                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                // console.log(JSON.stringify(result, null, 2));

                            }
                        });
                    }
                }

            });
        });
    });
</script>

<?= $this->endsection('content') ?>
<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>