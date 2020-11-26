-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2020 at 05:46 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` varchar(11) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(15) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `deskripsi`, `harga`, `gambar`) VALUES
('BAHN.000001', 'Cat', 'Untuk mewarnai mobil', 80000, '4118498989_e17c7fe4-2e5f-4f4a-87ec-5bc0d90ebe08_800_800.png'),
('BAHN.000002', 'Tiner', 'Untuk mengencerkan cat kayu dan besi, politur serta bahan â€“ bahan finishing lain', 20000, '3734-Tiner-B.jpg'),
('BAHN.000003', 'Pernis / Clearcoat', 'Untuk meningkatkan estetika dan melindungi media kayu yang dilapisi', 50000, '31clear-coat-png.png'),
('BAHN.000004', 'Hardener', 'Bahan campuran semen dan batu untuk memberikan kekerasan ekstra ke lantai beton tanpa mempengaruhi komposisi bahan kimia semen', 20000, '12super-shine-uhs-clear-coat-500x500.jpg'),
('BAHN.000005', 'Compound', 'Untuk menghaluskan lapisan cat kasar pasca proses pengecatan', 10000, '9244396202_0bdea979-cc0a-4e09-9d8e-f63d3ea7f262_1024_1024.jpg'),
('BAHN.000006', 'Wak (Cat Pengkilap Mobil)', 'Untuk melindungi cat bodi pada mobil kesayangan', 20000, '3744396202_0bdea979-cc0a-4e09-9d8e-f63d3ea7f262_1024_1024.jpg'),
('BAHN.000007', 'Wax', 'Wax premium 35.000', 35000, '52download (1).jpg'),
('BAHN.000008', 'Obat Jamur Kaca', 'Pembersih kaca mobil', 25000, '550_95c8dbf4-3079-4879-91e9-f170a700c173_700_700.jpg'),
('BAHN.000009', 'Obat Jamur Body', 'Untuk membersihkan body mobil', 25000, '37download (2).jpg'),
('BAHN.000010', 'Compound', 'Compound 50.000', 50000, '9644396202_0bdea979-cc0a-4e09-9d8e-f63d3ea7f262_1024_1024.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_paket`
--

CREATE TABLE `detail_paket` (
  `id_detail` varchar(11) NOT NULL,
  `id_paket` varchar(11) NOT NULL,
  `id_bahan` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_paket`
--

INSERT INTO `detail_paket` (`id_detail`, `id_paket`, `id_bahan`) VALUES
('DPKT.000001', 'PAKT.000001', 'BAHN.000006'),
('DPKT.000002', 'PAKT.000001', 'BAHN.000005'),
('DPKT.000003', 'PAKT.000001', 'BAHN.000004'),
('DPKT.000004', 'PAKT.000001', 'BAHN.000003'),
('DPKT.000005', 'PAKT.000001', 'BAHN.000002'),
('DPKT.000006', 'PAKT.000001', 'BAHN.000001'),
('DPKT.000007', 'PAKT.000002', 'BAHN.000010'),
('DPKT.000008', 'PAKT.000002', 'BAHN.000009'),
('DPKT.000009', 'PAKT.000002', 'BAHN.000008'),
('DPKT.000010', 'PAKT.000002', 'BAHN.000007');

-- --------------------------------------------------------

--
-- Table structure for table `jasa_service`
--

CREATE TABLE `jasa_service` (
  `id_jasa` varchar(11) NOT NULL,
  `nama_jasa` varchar(100) NOT NULL,
  `harga_jasa` int(15) NOT NULL,
  `lama_pengerjaan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jasa_service`
--

INSERT INTO `jasa_service` (`id_jasa`, `nama_jasa`, `harga_jasa`, `lama_pengerjaan`) VALUES
('JASA.000001', 'Jasa Mengecat', 300000, 120),
('JASA.000002', 'Jasa Salon Mobil', 265000, 240);

-- --------------------------------------------------------

--
-- Table structure for table `mekanik`
--

CREATE TABLE `mekanik` (
  `id_mekanik` varchar(11) NOT NULL,
  `nama_mekanik` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekanik`
--

INSERT INTO `mekanik` (`id_mekanik`, `nama_mekanik`, `alamat`) VALUES
('MKNK.000001', 'Sarbini', 'Ds. Tuk, RT/RW 15/12\r\n'),
('MKNK.000002', 'Rumantaka', 'Ds. Rambatan wetan, RT 020 RW 006'),
('MKNK.000003', 'Sobana', 'Ds. Suci, RT 004 RW 001'),
('MKNK.000004', 'Amirudin', 'Ds. Bandengan, RT 002 RW 001');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `nopol` varchar(20) NOT NULL,
  `nama_mobil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `id_user`, `nopol`, `nama_mobil`) VALUES
('MOBI.000001', 'USER.000002', 'E 7890 JP', 'Nissan Silvia S13'),
('MOBI.000002', 'USER.000003', 'E 8909 JI', 'Avanza');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` varchar(11) NOT NULL,
  `id_jasa` varchar(11) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `id_jasa`, `nama_paket`, `deskripsi`) VALUES
('PAKT.000001', 'JASA.000001', 'Paket Mengecat', 'Paket Cat Body Mobil'),
('PAKT.000002', 'JASA.000002', 'Paket Salon Mobil Baru', 'Untuk salon mobil baru');

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id_pos` varchar(11) NOT NULL,
  `id_mekanik` varchar(11) NOT NULL,
  `nama_pos` varchar(100) NOT NULL,
  `total_waktu` int(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`id_pos`, `id_mekanik`, `nama_pos`, `total_waktu`) VALUES
('DPOS.000001', 'MKNK.000001', 'POS 1', 120),
('DPOS.000002', 'MKNK.000002', 'POS 2', 0),
('DPOS.000003', 'MKNK.000003', 'POS 3', 0),
('DPOS.000004', 'MKNK.000004', 'POS 4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id_service` varchar(11) NOT NULL,
  `id_paket` varchar(11) NOT NULL,
  `id_pos` varchar(11) NOT NULL,
  `id_mobil` varchar(11) NOT NULL,
  `no_antrian` varchar(3) NOT NULL,
  `tgl_service` date NOT NULL,
  `jam_service` time NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id_service`, `id_paket`, `id_pos`, `id_mobil`, `no_antrian`, `tgl_service`, `jam_service`, `jam_mulai`, `jam_selesai`, `total_biaya`, `status`) VALUES
('SRVC.000001', 'PAKT.000002', 'DPOS.000001', 'MOBI.000001', '1', '2020-08-04', '10:32:19', '10:32:19', '14:32:19', 400000, 'Selesai'),
('SRVC.000002', 'PAKT.000002', 'DPOS.000001', 'MOBI.000001', '1', '2020-08-05', '09:50:03', '09:50:03', '13:50:03', 400000, 'Selesai'),
('SRVC.000003', 'PAKT.000001', 'DPOS.000001', 'MOBI.000002', '2', '2020-08-05', '11:53:43', '14:32:19', '16:32:19', 500000, 'Selesai'),
('SRVC.000004', 'PAKT.000001', 'DPOS.000001', 'MOBI.000001', '3', '2020-08-05', '13:53:13', '13:53:13', '15:53:13', 500000, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL,
  `blokir` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `alamat`, `no_hp`, `level`, `blokir`) VALUES
('USER.000001', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Fatiha Rahayu', 'Gunung Jati', '628918711881', 'Admin', 'N'),
('USER.000002', 'budi', '00dfc53ee86af02e742515cdcf075ed3', 'Budi Setiawan', 'Watubelah', '6289666111308', 'Pelanggan', 'N'),
('USER.000003', 'nikma', '9c533af759f989c2f4c02cfea2c3f4a3', 'Nikma', 'Panguragan', '62897197180', 'Pelanggan', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `detail_paket`
--
ALTER TABLE `detail_paket`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `id_produk` (`id_bahan`);

--
-- Indexes for table `jasa_service`
--
ALTER TABLE `jasa_service`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indexes for table `mekanik`
--
ALTER TABLE `mekanik`
  ADD PRIMARY KEY (`id_mekanik`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_jasa` (`id_jasa`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id_pos`),
  ADD KEY `id_mekanik` (`id_mekanik`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pos`
--
ALTER TABLE `pos`
  ADD CONSTRAINT `pos_ibfk_1` FOREIGN KEY (`id_mekanik`) REFERENCES `mekanik` (`id_mekanik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
