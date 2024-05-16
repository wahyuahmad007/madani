<?=$this->extend('layout/template');?>


<?=$this->section('content');?>

  <!-- Page Header Start -->
  <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Tentang Kami</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Tentang</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="<?=base_url();?>/asset/img/about-1.jpg" alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="<?=base_url();?>/asset/img/about-2.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <p class="text-primary text-uppercase mb-2">// Tentang Kami</p>
                        <h1 class="display-6 mb-4">Kami Membuat Setiap Produk Dengan Setulus Hati</h1>
                        <p>Madani bakery & cake berdiri pada tahun 2019,yang didirikan oleh Bapak Pujiono</p>
                        <p>setiap harinya kami memproduksi sekitar 1500 dus dengan berbagai macam jenis paket dengan total tim produksi saat ini sebanyak 24 orang</p>
                        <p>produk yang kami tawarkan mulai dari berbagai macam jenis roti bolu,roti sisir dan roti sobek kami juga menerima apabila anda ingin memesan roti sesuai dengan keinginan anda</p>
                        <p>Pelayanan yang kami berikan diantaranya</p>
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Produk yang berkualitas
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>kustom produk
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>pemesanan online
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Pengantaran ke rumah
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

<?=$this->endsection('content')?>