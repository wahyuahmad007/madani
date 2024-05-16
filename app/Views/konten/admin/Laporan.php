<?= $this->extend('layout/admin/template'); ?>


<?= $this->Section('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan</h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <div class="card-shadow">
                    <div class="card-header bg-success text-light">
                        <h3>Laporan Penjualan</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>admin/laporan_penjualan" target="_blank" method="post">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Tanggal Awal</label>
                                    <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" value="<?= date('Y-m-01'); ?>" title="Tanggal Awal">
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="<?= date('Y-m-t'); ?>" title="Tanggal Akhir">
                                </div>
                            </div>
                            <button class="btn  btn-primary mt-2"><i class="fas fa-print me-2"> </i>Cetak</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card ">
                <div class="card-shadow">
                    <div class="card-header bg-warning text-light">
                        <h3>Laporan Pemesanan</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>admin/laporan_pesanan" target="_blank" method="post">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Tanggal Awal</label>
                                    <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" value="<?= date('Y-m-01'); ?>" title="Tanggal Awal">
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="<?= date('Y-m-t'); ?>" title="Tanggal Akhir">
                                </div>
                            </div>
                            <button class="btn  btn-primary mt-2"><i class="fas fa-print me-2"> </i>Cetak</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>