-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2024 pada 09.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `madani`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nm_kategori` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nm_kategori`) VALUES
(1, 'sobek'),
(2, 'gula aren'),
(3, 'bolu'),
(4, 'bundel'),
(5, 'sisir jawa'),
(6, 'wijen coklat'),
(7, 'pilihan'),
(8, 'sisir pandan'),
(9, 'sisir meses'),
(10, 'bolu jala'),
(11, 'biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_trx` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nm_barang` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id_levels` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id_levels`, `name`) VALUES
(1, 'admin'),
(2, 'customer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_pesan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `produk` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_transaksi` int(11) NOT NULL,
  `no_faktur` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` char(100) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `tgl_kirim` date NOT NULL,
  `status` char(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_method` enum('Tunai','Midtrans') NOT NULL,
  `transaction_status` varchar(50) NOT NULL,
  `va_number` char(50) NOT NULL,
  `bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nm_produk` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nm_produk`, `harga`, `keterangan`, `gambar`) VALUES
(1, 2, 'gulren a', 12000, 'gula aren,donat,manis coklat,bolu kukus', '1711415955_337c21ac8d8cfabc81f7.jpg'),
(3, 2, 'gulren c', 14000, 'gula aren, donat, bolu jam, lapis kotak', '1711416093_41ac33772917c96047cc.jpg'),
(4, 2, 'gulren d', 14500, 'gula aren, donat, manis coklat, bolu kukus, brownies', '1711416154_93aa112bbbccf69009f0.jpg'),
(6, 11, 'paket biasa b', 21000, 'bolu, brownies, dll', '1711416289_7c4758eccde108789471.jpg'),
(7, 11, 'paket biasa c', 21000, 'bolu, donat, lapis', '1711416342_49d45628cf600c11644e.jpg'),
(8, 11, 'paket biasa d', 23000, 'bolu, brownies', '1711416395_e37794022be4b1cf98cb.jpg'),
(9, 1, 'sobek a', 14000, 'sobe 4 keju, donat, manis selai, bolu jam', '1711416805_87f63251ecbc662e3ff9.jpg'),
(10, 1, 'sobek b', 14500, 'sobek 4 keju, donat, manis susu zebra, bolu jam', '1711416865_4a5f359c143eed819641.jpg'),
(11, 1, 'sobek c', 15500, 'sobek 4 keju,donat,manis selai, lapis kotak', '1711416929_c2e3a4960d6ab8e21599.jpg'),
(12, 1, 'sobek d', 16500, 'sobek 4 keju, donat, manis selai, bolu kukus, brownies', '1711416980_c876ecc02d27c7ad0115.jpg'),
(13, 11, 'paket biasa e', 13000, 'brwonies, bolu', '1711417041_cedb936c051478f2afa8.jpg'),
(14, 11, 'paket biasa f', 10500, 'manis selai', '1711417085_25aecce4eaa6b2c34adc.jpg'),
(15, 11, 'paket biasa g', 14500, 'donat, manis selai', '1711417148_e234ddfb2aef1de295cd.jpg'),
(16, 1, 'sobek 5', 200000, 'sobek 5 keju,donat,', '1711854131_2258222e07e5ec7abb14.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `server`
--

CREATE TABLE `server` (
  `id` int(11) NOT NULL,
  `server_key` varchar(200) NOT NULL,
  `client_key` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `server`
--

INSERT INTO `server` (`id`, `server_key`, `client_key`) VALUES
(1, 'SB-Mid-server-zY6fG71YtvPNb19XtHPoF0p4', 'SB-Mid-client-sWJl-ru-h4Kw43ge');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_nota` varchar(200) NOT NULL,
  `customer` varchar(200) NOT NULL,
  `no_telp` char(100) NOT NULL,
  `alamat` text NOT NULL,
  `status` char(100) NOT NULL,
  `order_id` char(20) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_method` enum('Tunai','Midtrans') NOT NULL,
  `transaction_time` datetime NOT NULL,
  `transaction_status` varchar(50) NOT NULL,
  `va_number` char(50) NOT NULL,
  `bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `levels` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `telp`, `alamat`, `email`, `password`, `levels`) VALUES
(1, 'admin', '', '', '', '$2y$10$FYP/9ip5BiyUL606d2Xkyus/kKYZyq6sizmvkecER1ecwP26mTjFS', 1),
(14, 'customer', '123456789012', 'batang', 'customer@gmail.com', '$2y$10$egC.bS/dUVPLG7jCpy5H4.bgcD6gfbsPfUOno4CPisAhMfZNBETUK', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_kategori` (`id_produk`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_trx` (`id_trx`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id_levels`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD UNIQUE KEY `id_transaksi` (`id_pesan`,`id_produk`),
  ADD KEY `id_transaksi_2` (`id_pesan`,`id_produk`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id_levels` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `server`
--
ALTER TABLE `server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_trx`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
