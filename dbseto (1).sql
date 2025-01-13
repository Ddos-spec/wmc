-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2025 pada 13.35
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
-- Database: `dbseto`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbframe`
--

CREATE TABLE `tbframe` (
  `id_frame` int(11) NOT NULL,
  `nama_frame` varchar(100) NOT NULL,
  `url_gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbframe`
--

INSERT INTO `tbframe` (`id_frame`, `nama_frame`, `url_gambar`) VALUES
(24, 'frame alloy', 'frame_6748598d57467.jpg'),
(25, 'frame baja ', 'frame_6748599ccccd4.jpg'),
(26, 'frame carbon', 'frame_674859a993856.jpg'),
(27, 'frame chromoly', 'frame_674859ba3d7d8.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbkategori`
--

CREATE TABLE `tbkategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi_kategori` text DEFAULT NULL,
  `url_gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbkategori`
--

INSERT INTO `tbkategori` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`, `url_gambar`) VALUES
(16, 'sepeda anak', 'Berbagai pilihan sepeda hadir untuk menemani bersepeda anak Anda', 'kategori_674859ff071ab.jpg'),
(17, 'Sepeda BMX', 'Jenis sepeda yang cocok bagi Anda pecinta olahraga sepeda ekstrim, melakukan trik dan gerakan memukau', 'kategori_67485a37818ff.jpg'),
(18, 'Sepeda lipat', 'Sepeda lipat yang cocok bagi Anda untuk menjelajahi kota', 'kategori_67485a5b7d242.jpg'),
(19, 'Sepeda gunung ', 'Sepeda yang cocok bagi Anda ingin merasakan sepeda gunung serbaguna untuk off-road ringan di akhir pekan', 'kategori_67485a86ccf69.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbsepeda`
--

CREATE TABLE `tbsepeda` (
  `id_sepeda` int(11) NOT NULL,
  `nama_sepeda` varchar(100) NOT NULL,
  `deskripsi_sepeda` text DEFAULT NULL,
  `shifter` varchar(50) DEFAULT NULL,
  `rd` varchar(50) DEFAULT NULL,
  `berat` float DEFAULT NULL,
  `diameter` float DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `id_frame` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `url_gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbframe`
--
ALTER TABLE `tbframe`
  ADD PRIMARY KEY (`id_frame`);

--
-- Indeks untuk tabel `tbkategori`
--
ALTER TABLE `tbkategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbsepeda`
--
ALTER TABLE `tbsepeda`
  ADD PRIMARY KEY (`id_sepeda`),
  ADD KEY `id_frame` (`id_frame`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbframe`
--
ALTER TABLE `tbframe`
  MODIFY `id_frame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tbkategori`
--
ALTER TABLE `tbkategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbsepeda`
--
ALTER TABLE `tbsepeda`
  MODIFY `id_sepeda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbsepeda`
--
ALTER TABLE `tbsepeda`
  ADD CONSTRAINT `tbsepeda_ibfk_1` FOREIGN KEY (`id_frame`) REFERENCES `tbframe` (`id_frame`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbsepeda_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `tbkategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
