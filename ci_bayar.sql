-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2018 pada 01.32
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_bayar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_guru` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `login_type` int(11) NOT NULL,
  `last_login` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_guru`, `username`, `password`, `login_type`, `last_login`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-05-29 07:13:01', '0'),
(2, 'admin2', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-05-29 07:12:50', '0'),
(3, 'admin3', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-05-29 10:59:03', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id` int(11) NOT NULL,
  `id_siswa` varchar(50) NOT NULL,
  `id_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_kelas`
--

INSERT INTO `data_kelas` (`id`, `id_siswa`, `id_kelas`) VALUES
(2, '1234', '1'),
(3, '4213', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_master_kelas`
--

CREATE TABLE `data_master_kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_master_kelas`
--

INSERT INTO `data_master_kelas` (`id`, `kelas`, `jurusan`, `id_guru`, `ket`) VALUES
(1, 'X', 'TKJ/MM', 1, 'Kelas X TKJ/MM'),
(2, 'X', 'TSM/TKR', 1, 'Kelas X TSM/TKR'),
(3, 'X', 'TBS', 1, 'Kelas X TBS'),
(4, 'XI', 'TKJ', 2, 'Kelas XI TKJ'),
(5, 'XI', 'TSM', 2, 'Kelas XI TSM'),
(6, 'XI', 'TBS', 2, 'Kelas XI TBS'),
(7, 'XII', 'TKJ', 3, 'Kelas XII TKJ'),
(8, 'XII', 'TSM', 3, 'Kelas XII TSM'),
(9, 'XII', 'TBS', 3, 'Kelas XII TBS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pembayaran`
--

CREATE TABLE `data_pembayaran` (
  `id` int(11) NOT NULL,
  `id_tagihan` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_bayar` varchar(50) NOT NULL,
  `oleh` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pembayaran_temp`
--

CREATE TABLE `data_pembayaran_temp` (
  `id` int(11) NOT NULL,
  `id_tagihan` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_bayar` varchar(50) NOT NULL,
  `oleh` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `data_pembayaran_temp`
--

INSERT INTO `data_pembayaran_temp` (`id`, `id_tagihan`, `nis`, `id_admin`, `tgl_bayar`, `jml_bayar`, `oleh`, `keterangan`) VALUES
(1, 1, 1234, 1, '2018-06-07', '20000', '0', ''),
(2, 2, 1234, 1, '2018-06-07', '78000', '0', ''),
(3, 3, 1234, 1, '2018-06-07', '15000', '0', ''),
(4, 4, 1234, 1, '2018-06-07', '50000', '0', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_siswa`
--

CREATE TABLE `data_siswa` (
  `nis` varchar(50) NOT NULL,
  `nisn` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` char(1) NOT NULL,
  `alamat` text NOT NULL,
  `tp_lahir` varchar(100) NOT NULL,
  `tgl_lahir` varchar(100) NOT NULL,
  `sekolah_asal` varchar(100) NOT NULL,
  `th_masuk` varchar(4) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `wali` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_siswa`
--

INSERT INTO `data_siswa` (`nis`, `nisn`, `nama`, `jk`, `alamat`, `tp_lahir`, `tgl_lahir`, `sekolah_asal`, `th_masuk`, `foto`, `wali`, `status`) VALUES
('1234', '3413452', 'syaiful', 'L', 'Lamongan, RT.11/RW.1, Pacet, Mojokerto, Jawa Timur. 61374', 'Mojokerto', '11-11-2001', 'MTs. THORIQUL ULUM Pacet', '2017', '1234_1_syaiful1.png', 'Sumaji', '1'),
('4213', '7869800', 'Alfianto Wahyu', 'L', 'Lamongan, RT.11/RW.2, Pacet, Mojokerto, Jawa Timur. 61374', 'Mojokerto', '12-12-2001', 'MTs. THORIQUL ULUM Pacet', '2017', '', 'Sumaji', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(6) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='data guru';

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nama`, `alamat`) VALUES
(1, 'Abd. Rohman Hadi', 'Gondang'),
(2, 'M. Ikhfan Fathoni', 'Pacet'),
(3, 'Wahyudianto', 'Pacet');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seting`
--

CREATE TABLE `seting` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `seting`
--

INSERT INTO `seting` (`id`, `nama`, `nilai`, `ket`) VALUES
(1, 'sekolah', 'SMK. THORIQUL ULUM PACET', 'NAMA SEKOLAH'),
(2, 'kasek', 'MUNAWIR, M.Pd.I', 'KEPALA SEKOLAH'),
(3, 'bendahara', 'Abd. Rohman Hadi, S.Pd.I', 'Bendahara'),
(4, 'tapel', '2018-2019', 'Tahun Pelajaran'),
(5, 'spp', '50000', 'Biaya Perawatan'),
(6, 'printer', 'POS-58-Series (1)', 'seting printer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

CREATE TABLE `spp` (
  `id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tgl_bayar` varchar(50) NOT NULL,
  `bulan` int(11) NOT NULL,
  `oleh` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`id`, `nis`, `id_admin`, `tgl_bayar`, `bulan`, `oleh`) VALUES
(1, 1234, 1, '2018-06-02', 1, '0'),
(2, 1234, 1, '2018-06-02', 2, '0'),
(3, 1234, 0, '2018-06-02', 0, '0'),
(4, 1234, 0, '2018-06-02', 3, '0'),
(5, 1234, 0, '2018-06-02', 4, '0'),
(6, 1234, 0, '2018-06-02', 5, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `nominal` varchar(100) NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id`, `jenis`, `nominal`, `jatuh_tempo`, `kelas`, `keterangan`) VALUES
(1, 'Ekstrakurikuler', '20000', '2018-05-25', '0', 'Biaya Ekskul'),
(2, 'LKS Semester 1', '78000', '2018-05-25', '1', '15 LKS'),
(3, 'Kitab', '15000', '2018-05-25', '1', 'Kitab Pengajian'),
(4, 'Akhir Tahun', '50000', '2018-05-25', '1', 'Biaya Kegiatan akhir tahun');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_bayar`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_bayar` (
`id_tagihan` int(11)
,`tgl_bayar` date
,`oleh` varchar(100)
,`jenis` varchar(100)
,`nominal` varchar(100)
,`nis` varchar(50)
,`nama` varchar(100)
,`id_siswa` varchar(50)
,`id_kelas` varchar(50)
,`id` int(11)
,`kelas` varchar(50)
,`jurusan` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_siswa`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_siswa` (
`nis` varchar(50)
,`nama` varchar(100)
,`status` varchar(100)
,`id_siswa` varchar(50)
,`id_kelas` varchar(50)
,`id` int(11)
,`kelas` varchar(50)
,`jurusan` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_bayar`
--
DROP TABLE IF EXISTS `v_bayar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bayar`  AS  select `data_pembayaran_temp`.`id_tagihan` AS `id_tagihan`,`data_pembayaran_temp`.`tgl_bayar` AS `tgl_bayar`,`data_pembayaran_temp`.`oleh` AS `oleh`,`tagihan`.`jenis` AS `jenis`,`tagihan`.`nominal` AS `nominal`,`data_siswa`.`nis` AS `nis`,`data_siswa`.`nama` AS `nama`,`data_kelas`.`id_siswa` AS `id_siswa`,`data_kelas`.`id_kelas` AS `id_kelas`,`data_master_kelas`.`id` AS `id`,`data_master_kelas`.`kelas` AS `kelas`,`data_master_kelas`.`jurusan` AS `jurusan` from ((((`tagihan` join `data_pembayaran_temp`) join `data_siswa`) join `data_kelas`) join `data_master_kelas`) where ((`data_pembayaran_temp`.`nis` = `data_siswa`.`nis`) and (`data_pembayaran_temp`.`id_tagihan` = `tagihan`.`id`) and (`data_master_kelas`.`id` = `data_kelas`.`id_kelas`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_siswa`
--
DROP TABLE IF EXISTS `v_siswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_siswa`  AS  select `data_siswa`.`nis` AS `nis`,`data_siswa`.`nama` AS `nama`,`data_siswa`.`status` AS `status`,`data_kelas`.`id_siswa` AS `id_siswa`,`data_kelas`.`id_kelas` AS `id_kelas`,`data_master_kelas`.`id` AS `id`,`data_master_kelas`.`kelas` AS `kelas`,`data_master_kelas`.`jurusan` AS `jurusan` from ((`data_siswa` join `data_kelas`) join `data_master_kelas`) where ((`data_siswa`.`nis` = `data_kelas`.`id_siswa`) and (`data_kelas`.`id_kelas` = `data_master_kelas`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_master_kelas`
--
ALTER TABLE `data_master_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_pembayaran_temp`
--
ALTER TABLE `data_pembayaran_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `seting`
--
ALTER TABLE `seting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_master_kelas`
--
ALTER TABLE `data_master_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_pembayaran_temp`
--
ALTER TABLE `data_pembayaran_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `seting`
--
ALTER TABLE `seting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `spp`
--
ALTER TABLE `spp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
