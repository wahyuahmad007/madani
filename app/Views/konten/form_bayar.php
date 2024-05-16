<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>



<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3"></h1>
        <nav aria-label="breadcrumb animated slideInDown">
        </nav>
    </div>
</div>
<div class="container-xxl ">
    <div class="container">
        <div class="row g-0 justify-content-center">
            <div class="col-lg-10 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h5><i class="fas fa-home"></i> Alamat Pengiriman</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?= session()->username; ?>" readonly>
                                            <label for="name">Nama lengkap</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="nomor" placeholder="nomor " name="nomor" readonly value="<?= session()->telp; ?>">
                                            <label for="number">Nomor telephone</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" readonly name="alamat" id="alamat" style="height: 150px"><?= session()->alamat; ?></textarea>
                                            <label for="pesan">Alamat lengkap</label>
                                        </div>
                                        <input type="text" value="belum diproses" name="status" id="status" hidden>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="card ">
                            <div class="card-body " style=" font-size:20px;">
                                <h4>Rincian Pembelian</h4>
                                <?php
                                $tot_qty = 0;
                                $i = 1;
                                $total = 0;
                                foreach ($cart->contents() as $value) :
                                    $tot_qty = $tot_qty + $value['qty'];
                                    $total = $total + $value['subtotal'];
                                ?>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <?= $value['name']; ?>
                                        </div>
                                        <div class="col-md-2">
                                            <?= $value['qty']; ?>
                                        </div>
                                        <div class="col-md-5">
                                            <?= rupiah($value['subtotal']); ?>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                <hr>
                                <div class="row" style="font-weight: bold;">
                                    <div class="col-md-7">
                                        Total Harga
                                    </div>
                                    <div class="col-md-5 float-end">
                                        <?= rupiah($total); ?>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary  p-2 m-3" type="button" title="Bayar" id="tombolPay">Pilih Metode Bayar</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=<?= $client; ?>></script>


<script>
    $(document).ready(function() {
        $('#tombolPay').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/Transaksi/bayar',
                data: {
                    customer: $('#nama').val(),
                    telp: $('#nomor').val(),
                    alamat: $('#alamat').val(),
                    status: $('#status').val(),
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

                                let dataResult = JSON.stringify(result, null, 2);
                                let dataObj = JSON.parse(dataResult);

                                $.ajax({
                                    type: "post",
                                    url: "/Transaksi/simpan",
                                    data: {
                                        customer: response.customer,
                                        telp: response.telp,
                                        alamat: response.alamat,
                                        status: response.status,
                                        order_id: dataObj.order_id,
                                        payment_type: dataObj.payment_type,
                                        transaction_time: dataObj.transaction_time,
                                        transaction_status: dataObj.transaction_status,
                                        va_number: dataObj.va_numbers[0].va_number,
                                        bank: dataObj.va_numbers[0].bank
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        if (response.sukses) {
                                            alert(response.sukses);
                                            location.href = "/Transaksi/konfirmasi";
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
                                    url: "/Transaksi/simpan",
                                    data: {
                                        customer: response.customer,
                                        telp: response.telp,
                                        alamat: response.alamat,
                                        status: response.status,
                                        order_id: dataObj.order_id,
                                        payment_type: dataObj.payment_type,
                                        transaction_time: dataObj.transaction_time,
                                        transaction_status: dataObj.transaction_status,
                                        va_number: dataObj.va_numbers[0].va_number,
                                        bank: dataObj.va_numbers[0].bank
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        if (response.sukses) {
                                            alert(response.sukses);
                                            location.href = "/Transaksi/konfirmasi";
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
                                    url: "/Transaksi/simpan",
                                    data: {
                                        customer: response.customer,
                                        telp: response.telp,
                                        alamat: response.alamat,
                                        status: response.status,
                                        order_id: dataObj.order_id,
                                        payment_type: dataObj.payment_type,
                                        transaction_time: dataObj.transaction_time,
                                        transaction_status: dataObj.transaction_status,
                                        va_number: dataObj.va_numbers[0].va_number,
                                        bank: dataObj.va_numbers[0].bank
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        if (response.sukses) {
                                            alert(response.sukses);
                                            location.href = "/Transaksi/konfirmasi";
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
<?= $this->endsection('content'); ?>




<!-- <?php
        function rupiah($angka)
        {

            $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
            return $hasil_rupiah;
        }
        ?> -->