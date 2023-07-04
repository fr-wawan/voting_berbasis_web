-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2023 pada 11.09
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting_berbasis_web`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kandidat`
--

CREATE TABLE `kandidat` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_pemilihan` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `voting_count` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kandidat`
--

INSERT INTO `kandidat` (`id`, `nama`, `id_pemilihan`, `deskripsi`, `image`, `voting_count`) VALUES
(12, 'Prabowo Subianto Djojohadikusumo', 9, '\"Terwujudnya bangsa dan negara Republik Indonesia yang adil, makmur, bermartabat, relijius, berdaulat, berdiri di atas kaki sendiri di bidang ekonomi, dan berkepribadian nasional yang kuat di bidang budaya serta menjamin kehidupan yang rukun antarwarga negara tanpa memandang suku, agama, ras, latar belakang etnis dan sosial berdasarkan Pancasila dan UUD Negara Republik Indonesia Tahun 1945.\"', '../../images/kandidat/164a36966020b10.jpg', ''),
(13, 'Anies Rasyid Baswedan', 9, 'Rakyat mendambakan kesejahteraan bagi semua, bukan bagi sebagian. Pertumbuhan ekonomi yang juga menjangkau semua, rakyat mendambakan kehidupan yang guyub, yang rukun. Keragaman kebhinekaan manusia Indonesia adalah karunia Allah, tapi persatuan dan kesatuan adalah ikhtiar kita bersama\"', '../../images/kandidat/164a3697356e9e6.jpg', ''),
(15, 'Ganjar Pranowo', 9, '\"Peningkatan kualitas sumber daya manusia Indonesia merupakan syarat utama bagi terwujudnya Indonesia yang berdaulat di bidang politik, berdiri di atas kaki sendiri di bidang ekonomi, dan berkepribadian dalam bidang kebudayaan,\"', '../../images/kandidat/164a378886eb757.jpg', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilihan`
--

CREATE TABLE `pemilihan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` enum('tidak_berlangsung','berlangsung','selesai') NOT NULL,
  `tanggal_pemilihan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemilihan`
--

INSERT INTO `pemilihan` (`id`, `nama`, `status`, `tanggal_pemilihan`) VALUES
(9, 'Pemilihan Presiden', 'selesai', '2023-07-04'),
(12, 'Pemilihan Ketua RT', 'tidak_berlangsung', '2023-07-04'),
(16, 'Pemilihan Partai', 'tidak_berlangsung', '2023-07-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_ktp` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('pemilih','admin') NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `vote_candidate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `email`, `no_ktp`, `alamat`, `tanggal_lahir`, `password`, `role`, `jenis_kelamin`, `vote_candidate_id`) VALUES
(15, 'Hermawan Tan', 'hermawantan12@gmail.com', '08123', 'Hermawan Tan', '2023-07-03', '$2y$10$ALdnmPrgVlwtPofk2JN72OnXmY1Np1RY.SlDekt9Ps89zOQvArYSa', 'admin', 'pria', 0),
(19, 'Hermawan Tan', 'wawan@gmail.com', '123131', 'mana', '2023-07-03', '$2y$10$mcWSyLFFQX4a2PXhZFIIl.Ce1/3Mh1S69MNiIcbWf8TJ8huYee/hy', 'pemilih', 'pria', 0),
(20, 'Radhit', 'radit@gmail.com', '123', 'Radhit', '2023-07-04', '$2y$10$44ydXyjgWRNfLqIv4lyR/OvTV.40KBC3LxBRVyT67uNMVf9qTKfpO', 'pemilih', 'wanita', 0),
(21, 'Rizki', 'rizki@gmail.com', '457457767567', 'asdfsafasdf', '2023-07-04', '$2y$10$mwWCR6RKMYwx6mDInd3H/.ei94Z/Naqu3AOSIXUhMO5mGMqtsm5.6', 'pemilih', 'pria', 0),
(22, 'Ini Demo', 'demo@gmail.com', '734537353567', 'wawa', '2023-06-25', '$2y$10$9isOi88G0kmijO.qiqUr1eMbQ/qm4XA/f3jys8gTR.B6of1I9B7im', 'pemilih', 'pria', 0),
(23, 'Hermawan Tan222', 'admin@gmail.com', '1231243131231231', 'afsfasdf', '2023-07-04', '$2y$10$LXi0xCjltT6iXRdlJmoF6uCT67/NrKHvX63JhFE.koYN5/fVRZ4ui', 'pemilih', 'pria', 0),
(25, 'Radhit', 'radhit@gmail.com', '123131313', 'Juanda', '2023-07-04', '$2y$10$o4tGZD.EECM.pPvI35O7Y.ugVVbG2o.zPye59jFAsyIGtbBLeagge', 'pemilih', 'pria', 0),
(26, 'Hermawan Tan', 'hermawantan12222@gmail.com', '12313131', 'adsfasdfadsf', '2023-07-04', '$2y$10$slFQyADU1nGdArWh8mkbVOK6DOM1eTYRkk/F41qdZMmO6hgMzQRLi', 'pemilih', 'pria', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `voting`
--

CREATE TABLE `voting` (
  `id` int(11) NOT NULL,
  `id_kandidat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pemilihan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `voting`
--

INSERT INTO `voting` (`id`, `id_kandidat`, `id_user`, `id_pemilihan`) VALUES
(5, 12, 19, 9),
(6, 13, 20, 9),
(7, 13, 21, 9),
(8, 13, 15, 9),
(9, 13, 22, 9),
(10, 12, 23, 9),
(11, 12, 24, 9);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indeks untuk tabel `pemilihan`
--
ALTER TABLE `pemilihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vote_candidate_id` (`vote_candidate_id`);

--
-- Indeks untuk tabel `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kandidat` (`id_kandidat`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pemilihan`
--
ALTER TABLE `pemilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `voting`
--
ALTER TABLE `voting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kandidat`
--
ALTER TABLE `kandidat`
  ADD CONSTRAINT `kandidat_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
