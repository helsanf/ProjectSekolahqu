-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 Des 2018 pada 10.08
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sekolahqu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_acara`
--

CREATE TABLE `tbl_acara` (
  `id_acara` int(11) NOT NULL,
  `nama_acara` varchar(255) NOT NULL,
  `tanggal_acara` date NOT NULL,
  `deskripsi` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_sekolah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_acara`
--

INSERT INTO `tbl_acara` (`id_acara`, `nama_acara`, `tanggal_acara`, `deskripsi`, `image`, `id_sekolah`) VALUES
(1, 'Acara Penerimaan Siswa Baru', '2018-11-07', 'BUTETTTSSSSSS', 'Mantul', 22),
(3, 'Acara Penerimaan Siswa Baru', '2018-12-14', 'ACARA BAPUKSSSSSS', 'b468fa4972899c8cbb9fd694270e2b0b.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_berita`
--

CREATE TABLE `tbl_berita` (
  `id_berita` int(11) NOT NULL,
  `nama_berita` varchar(255) NOT NULL,
  `tanggal_berita` date NOT NULL,
  `deskripsi` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_sekolah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_berita`
--

INSERT INTO `tbl_berita` (`id_berita`, `nama_berita`, `tanggal_berita`, `deskripsi`, `image`, `id_sekolah`) VALUES
(5, 'ASA DE QINTIL', '2018-11-07', 'CAWWWWW', '9a4cd67744a9936318c5ccae6777540b.jpg', 0),
(6, 'ASOY GEBOY', '2018-12-12', 'CMIWWW', '1e318db8b5e7042e4bd9194cc7e459a6.jpg', 0),
(7, 'ASOY GEBOY', '2018-12-16', 'BUTETTT', '665fe422b74dd11a3f035934fb9ee172.jpg', 22),
(8, 'ASOY GEBOY', '2018-12-19', 'PRIKITIWWW', '8231897ef70b4f0b4a153a51d8cc5031.png', 22),
(9, 'Helsan Krenzzz', '2018-12-05', 'Butettt', '5980179abd0f2d4d41d882615e8834a9.png', 21),
(10, 'Helsan Krenzzz 2', '2018-12-16', 'Krenzzz', '8837aefd0611662aa77517c77c1a33d7.jpg', 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul`
--

CREATE TABLE `tbl_ekskul` (
  `id_ekskul` int(11) NOT NULL,
  `nama_ekskul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `pembina` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `ketua` varchar(255) DEFAULT NULL,
  `id_sekolah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ekskul`
--

INSERT INTO `tbl_ekskul` (`id_ekskul`, `nama_ekskul`, `deskripsi`, `pembina`, `image`, `ketua`, `id_sekolah`) VALUES
(3, 'FUTSAL', 'BUTETTTSSS', 'HELSAN', '54e0f0e318098701a814c73da2adeb6d.jpg', 'ZZZ', 0),
(4, 'FUTSAL', 'TEST', 'TEST', '3543fe3b6fd849a4769aab474e550bfd.jpg', 'BUTET', 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_fasilitas`
--

CREATE TABLE `tbl_fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_sekolah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_fasilitas`
--

INSERT INTO `tbl_fasilitas` (`id_fasilitas`, `nama_fasilitas`, `image`, `id_sekolah`) VALUES
(2, 'Kantin', '9fecff0bd8d80e2e0edf1f236a6750e8.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(15, 1, 1),
(19, 1, 3),
(21, 2, 1),
(24, 1, 9),
(28, 2, 3),
(29, 2, 2),
(30, 1, 2),
(31, 1, 10),
(32, 3, 11),
(33, 3, 10),
(34, 2, 11),
(35, 2, 10),
(36, 1, 11),
(37, 1, 12),
(38, 3, 12),
(39, 1, 13),
(40, 3, 13),
(41, 1, 14),
(42, 3, 14),
(43, 1, 15),
(44, 3, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'y'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 'y'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 'y'),
(10, 'Profile Sekolah', 'Profile_sekolah', 'glyphicon glyphicon-user', 0, 'y'),
(11, 'Acara', 'Acara', 'glyphicon glyphicon-user', 0, 'y'),
(12, 'Berita', 'Berita', 'glyphicon glyphicon-user', 0, 'y'),
(13, 'Ekskul', 'Ekskul', 'glyphicon glyphicon-user', 0, 'y'),
(14, 'Fasilitas', 'Fasilitas', 'glyphicon glyphicon-user', 0, 'y'),
(15, 'Prestasi', 'Prestasi', 'glyphicon glyphicon-user', 0, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_prestasi`
--

CREATE TABLE `tbl_prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `nama_prestasi` varchar(255) NOT NULL,
  `tanggal_didapat` date NOT NULL,
  `deskripsi` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_sekolah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_prestasi`
--

INSERT INTO `tbl_prestasi` (`id_prestasi`, `nama_prestasi`, `tanggal_didapat`, `deskripsi`, `image`, `id_sekolah`) VALUES
(2, 'Juara Taekwondo', '2018-12-12', 'MENANGGG', '191a05a64ae39e34372ea79602b4c84a.jpg', 0),
(3, 'Juara Taekwondo', '2018-12-17', 'BAPUKKK', 'fe2d7ac604905fb98172298b5028673c.jpg', 22),
(4, 'Juara Taekwondo', '2018-12-11', 'Bapuk Jasaaa', 'db4a55f40c4e807b904dc3e77472c549.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_profile_sekolah`
--

CREATE TABLE `tbl_profile_sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `logo_sekolah` varchar(255) NOT NULL,
  `visi_misi` text NOT NULL,
  `kalender_akademik` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_profile_sekolah`
--

INSERT INTO `tbl_profile_sekolah` (`id_sekolah`, `nama_sekolah`, `alamat`, `email`, `no_telp`, `logo_sekolah`, `visi_misi`, `kalender_akademik`) VALUES
(21, 'SMAN 14 Bandung', 'Bandung', 'helsanfirmansyah@gmail.com', '08119071111', '52edcc4f88ee7a328bdc47e8b13e9123.jpg', 'BANDUNG LAUTAN API MAJU TEROSS', '825b0871f3ec76001c9da94f9ee17f98.pdf'),
(22, 'SMAN 1 TAMARA', 'BANDOENGG', 'sman1tamara@gmail.com', '08119071111', 'fb2a3b2c56e7de805d357ca175c6b1b3.jpg', 'BANDOENGGG', '8b3c005768ac5d5a54a08e5d7e8e1bc7.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL,
  `id_sekolah` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`, `id_sekolah`) VALUES
(11, 'Helsan Firmansyah', 'helsanfirmansyah@gmail.com', '$2y$04$i2A4wFte4gHw9W2DPt1Sn.iLQgwaVf/hayD/c77hgcsnnHNocEjBG', '135736_179874315380379_6123340_o2.jpg', 1, 'y', 0),
(13, 'Helsan Firmansyah', 'helsankrenz@ymail.com', '$2y$04$rXEBRuK7zNbkeQ.88B26NeHjWo1EBM6Vx1IRYl2RoIY/U3HihxrWW', '135736_179874315380379_6123340_o4.jpg', 3, 'y', 21),
(14, 'butet', 'butet@gmail.com', '$2y$04$FmIR6BmNNdQS0dGM3p807.BYhefRrl/OwyNedIaOblYHhOCjw7GuW', 'ayana.jpg', 3, 'y', 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'sekolah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acara`
--
ALTER TABLE `tbl_acara`
  ADD PRIMARY KEY (`id_acara`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indexes for table `tbl_berita`
--
ALTER TABLE `tbl_berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indexes for table `tbl_ekskul`
--
ALTER TABLE `tbl_ekskul`
  ADD PRIMARY KEY (`id_ekskul`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indexes for table `tbl_fasilitas`
--
ALTER TABLE `tbl_fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indexes for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_prestasi`
--
ALTER TABLE `tbl_prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indexes for table `tbl_profile_sekolah`
--
ALTER TABLE `tbl_profile_sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_acara`
--
ALTER TABLE `tbl_acara`
  MODIFY `id_acara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_berita`
--
ALTER TABLE `tbl_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_ekskul`
--
ALTER TABLE `tbl_ekskul`
  MODIFY `id_ekskul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_fasilitas`
--
ALTER TABLE `tbl_fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_prestasi`
--
ALTER TABLE `tbl_prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_profile_sekolah`
--
ALTER TABLE `tbl_profile_sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
