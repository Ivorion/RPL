-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jun 2021 pada 14.15
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `kd_anggota` varchar(5) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `jenkel` enum('pria','wanita') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `jns_pekerjaan` varchar(50) NOT NULL,
  `status_kawin` enum('ya','tidak') NOT NULL,
  `id_anggota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`kd_anggota`, `nama_anggota`, `jenkel`, `agama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_telp`, `foto`, `jns_pekerjaan`, `status_kawin`, `id_anggota`) VALUES
('P0001', 'Richardo', 'pria', 'Kristen', 'Medan', '2021-05-01', 'Medan', '082194912323', 'None', 'Bekerja', 'tidak', 10),
('P0002', 'Absolute', 'wanita', 'buddha', 'Surakarta', '2014-01-25', 'Bagan Vatu', '0823918238298', '2021214204913.png', 'Bos Besar', 'ya', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_login`
--

CREATE TABLE `anggota_login` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota_login`
--

INSERT INTO `anggota_login` (`id`, `username`, `email`, `password`) VALUES
(12, 'rich', 'richardo@gmail.com', '$2y$10$vQmPzyt66Lbc/VEdkfHrle/g9ESJY/aBkLs2dHsUgWq6ANPOVffny');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman_sementara`
--

CREATE TABLE `pinjaman_sementara` (
  `kd_pinjaman` varchar(5) NOT NULL,
  `tgl_pinjaman` date NOT NULL,
  `kd_anggota` varchar(5) NOT NULL,
  `lama_pinjaman` int(3) NOT NULL,
  `besar_pinjaman` int(12) NOT NULL,
  `angsuran_pokok` int(10) NOT NULL,
  `angsuran_bunga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjaman_sementara`
--

INSERT INTO `pinjaman_sementara` (`kd_pinjaman`, `tgl_pinjaman`, `kd_anggota`, `lama_pinjaman`, `besar_pinjaman`, `angsuran_pokok`, `angsuran_bunga`) VALUES
('S0001', '2021-05-31', 'P0001', 3, 120000, 40000, 800);

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan_sementara`
--

CREATE TABLE `simpanan_sementara` (
  `kd_simpanan` varchar(5) NOT NULL,
  `besar_simpanan` int(11) NOT NULL,
  `tgl_simpanan` date NOT NULL,
  `kd_anggota` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `simpanan_sementara`
--

INSERT INTO `simpanan_sementara` (`kd_simpanan`, `besar_simpanan`, `tgl_simpanan`, `kd_anggota`) VALUES
('J0001', 120000, '2021-05-31', 'P0001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`kd_anggota`);

--
-- Indeks untuk tabel `anggota_login`
--
ALTER TABLE `anggota_login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pinjaman_sementara`
--
ALTER TABLE `pinjaman_sementara`
  ADD PRIMARY KEY (`kd_pinjaman`);

--
-- Indeks untuk tabel `simpanan_sementara`
--
ALTER TABLE `simpanan_sementara`
  ADD PRIMARY KEY (`kd_simpanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota_login`
--
ALTER TABLE `anggota_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
