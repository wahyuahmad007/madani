<nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a href="<?= base_url(); ?>" class="navbar-brand ms-4 ms-lg-0">
        <h1 class="text-primary m-0">Madani Bakery & Cake</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto p-4 p-lg-0">
            <a href="<?= base_url(); ?>" class="nav-item nav-link ">Home</a>
            <a href="<?= base_url(); ?>about" class="nav-item nav-link">Tentang</a>
            <a href="<?= base_url(); ?>Produk" class="nav-item nav-link">Produk</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Layanan</a>
                <div class="dropdown-menu m-0">
                    <a href="<?= base_url(); ?>Layanan" class="dropdown-item">Services</a>
                    <?php if (session()->levels == "2") : ?>
                        <a href="<?= base_url(); ?>Pesan" class="dropdown-item">Pemesanan</a>
                    <?php else : ?>
                        <a href="<?= base_url(); ?>auth" class="dropdown-item">Pemesanan</a>

                    <?php endif; ?>
                </div>
            </div>


            <?php if (session()->levels == '2') : ?>
                <a href="<?= base_url(); ?>Transaksi/histori" class="nav-link ">Transaksi</a>

            <?php else : ?>
                <a href="<?= base_url(); ?>auth" class="nav-link ">Transaksi</a>


            <?php endif; ?>

            <?php if (session()->levels == '2') : ?>
                <?php

                $keranjang = $cart->contents();

                $jml_item = 0;
                foreach ($keranjang as $key => $value) {
                    $jml_item = $jml_item + $value['qty'];
                }
                ?>
                <a href="<?= base_url(); ?>produk/detail_keranjang" class="nav-item nav-link">Keranjang(<?= $jml_item; ?>)
                </a>



                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle fa-2x mb-4 "></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user mr-2 text-gray-400"></i>
                            <?= session()->username; ?>
                        </a>
                        <div class="dropdown-divider"></div>
                       
                        <a class="dropdown-item" href="<?= base_url(); ?>auth/logout" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            <?php else : ?>

                <a href="<?= base_url(); ?>auth" class="nav-item nav-link">Keranjang
                </a>
                <a href="<?= base_url(); ?>auth" class="nav-item nav-link">Login</a>

            <?php endif; ?>


        </div>
        <div class=" d-none d-lg-flex">
            <div class="flex-shrink-0 btn-lg-square border border-light rounded-circle">
                <i class="fa fa-phone text-primary"></i>
            </div>
            <div class="ps-3">
                <small class="text-primary mb-0">hubungi kami</small>
                <p class="text-light fs-5 mb-0">085229343516</p>
            </div>
        </div>
    </div>
</nav>