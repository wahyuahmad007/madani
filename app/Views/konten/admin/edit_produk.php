<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <form action="<?= base_url(); ?>admin/update_produk/<?= $produk['id_produk']; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body border text-center">
                        <img src="<?= base_url(); ?>asset/img/produk/<?= $produk['gambar']; ?>" alt="" class="card-img-top" style="aspect-ratio: 0,5 / 1">
                        <input type="file" name="gambar" class="form-control mt-3" required>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-primary">
                        <h4>Edit Produk</h4>
                    </div>
                    <div class="card-body">
                        <label for="nama">Nama Produk</label>
                        <input type="text" name="nama" class="form-control" value="<?= $produk['nm_produk']; ?>" required>
                        <label for="kategori">kategori</label>
                        <select name="kategori" id="" class="form-select">
                            <option value="" hidden></option>
                            <?php foreach ($kategori as $row) : ?>
                                <option value="<?= $row['id_kategori']; ?>" <?= $produk['id_kategori'] == $row['id_kategori'] ? 'selected' : ''; ?> required>
                                    <?= $row['nm_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="harga">Harga </label>
                        <input type="number" name="harga" class="form-control" value="<?= $produk['harga']; ?>" required>
                        <label for="keterangan">keterangan </label>
                        <textarea name="keterangan" id="" cols="30" rows="4" class="form-control" required><?= $produk['keterangan']; ?></textarea>

                        <button type="submit" class="btn btn-sm btn-success mt-2">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?= $this->endsection('content'); ?>