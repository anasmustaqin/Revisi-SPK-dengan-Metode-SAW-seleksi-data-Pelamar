-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 04:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erecrutment`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(10) NOT NULL,
  `kategori` varchar(15) NOT NULL,
  `alternatif` int(3) NOT NULL,
  `bobot` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kategori`, `alternatif`, `bobot`) VALUES
(1, 'KATEGORI', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(10) NOT NULL,
  `nama_alternatif` varchar(30) NOT NULL,
  `nilai_saw` double NOT NULL,
  `rangking` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternatif`, `nama_alternatif`, `nilai_saw`, `rangking`) VALUES
(1, 'JURUSAN', 1, 20),
(2, 'PENGALAMAN', 1, 20),
(3, 'KELAMIN', 1, 30),
(4, 'IPK', 1, 20),
(5, 'GAJI', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluarga`
--

CREATE TABLE `tb_keluarga` (
  `id_pelamar` int(11) NOT NULL,
  `id_keluarga` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `relasi` varchar(10) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_keluarga`
--

INSERT INTO `tb_keluarga` (`id_pelamar`, `id_keluarga`, `nama`, `relasi`, `tanggal_lahir`) VALUES
(2, 1, 'joni', 'kakak', '1995-07-19'),
(2, 2, 'johan', 'adik', '2000-01-08'),
(8, 4, 'canthika andreena', 'adik', '1998-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(10) NOT NULL,
  `id_alternatif` int(10) NOT NULL,
  `cek` varchar(10) NOT NULL,
  `from` varchar(15) NOT NULL,
  `to` varchar(50) NOT NULL,
  `bobot` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `id_alternatif`, `cek`, `from`, `to`, `bobot`) VALUES
(1, 1, 'FIX', '0', 'LAIN-LAIN', 20),
(2, 1, 'FIX', '0', 'TEKNIK ELEKTRONIKA', 40),
(3, 1, 'FIX', '0', 'TEKNIK TELEKOMUNIKASI', 50),
(4, 1, 'FIX', '0', 'TEKNIK INFORMATIKA', 60),
(5, 1, 'FIX', '0', 'TEKNOLOGI INFORMASI', 70),
(6, 2, 'FIX', '0', 'TIDAK ADA', 20),
(7, 2, 'FIX', '0', 'ADA PENGALAMAN', 80),
(8, 3, 'FIX', '0', 'WANITA', 20),
(9, 3, 'FIX', '0', 'LAKI-LAKI', 80),
(10, 4, 'RANGE', '2.00', '2.25', 50),
(11, 4, 'RANGE', '2.26', '3.00', 60),
(12, 4, 'RANGE', '3.01', '3.50', 70),
(13, 4, 'RANGE', '3.51', '4.00', 80),
(14, 5, 'RANGE', '0', '1500000', 10),
(15, 5, 'RANGE', '1500001', '2000000', 50),
(16, 5, 'RANGE', '2000001', '4000000', 60),
(17, 5, 'RANGE', '4000001', '6500000', 70),
(18, 5, 'RANGE', '6500001', '10000000', 80),
(19, 5, 'RANGE', '10000001', '999999999', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tb_organisasi`
--

CREATE TABLE `tb_organisasi` (
  `id_pelamar` int(11) NOT NULL,
  `id_organisasi` int(11) NOT NULL,
  `nama_organisasi` varchar(250) NOT NULL,
  `jabatan` varchar(250) NOT NULL,
  `tanggal_masuk` date NOT NULL COMMENT 'tanggal menjabat di organisasi',
  `tanggal_keluar` date NOT NULL COMMENT 'tanggal akhir menjabat di organisasi',
  `jenis_organisasi` varchar(15) NOT NULL COMMENT 'luar kampus / dalam kampus'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_organisasi`
--

INSERT INTO `tb_organisasi` (`id_pelamar`, `id_organisasi`, `nama_organisasi`, `jabatan`, `tanggal_masuk`, `tanggal_keluar`, `jenis_organisasi`) VALUES
(2, 1, 'paguyupan lambe turah', 'tukang nyangkem', '2019-07-22', '2023-08-31', 'luar_kampus'),
(8, 2, 'koperasi jaya', 'keuangan', '2022-10-03', '2023-06-30', 'luar_kampus'),
(2, 3, 'celtic wedding organizer', 'pengarah gaya', '2021-12-22', '2022-08-31', 'luar_kampus'),
(16, 4, 'senam sehat sejahtera', 'instruktur senam', '2020-03-01', '2021-01-01', 'dalam_kampus');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pekerjaan`
--

CREATE TABLE `tb_pekerjaan` (
  `id_pelamar` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `tahun_keluar` year(4) NOT NULL,
  `gaji_terakhir` varchar(10) NOT NULL,
  `alasan_keluar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pekerjaan`
--

INSERT INTO `tb_pekerjaan` (`id_pelamar`, `id_pekerjaan`, `nama_perusahaan`, `jabatan`, `tahun_masuk`, `tahun_keluar`, `gaji_terakhir`, `alasan_keluar`) VALUES
(2, 1, 'pt. jaya perkasa', 'administrasi produksi', '2022', '2023', '4900000', 'ada tawaran lebih tinggi dan dekat dengan rumah'),
(8, 2, 'pt jayamahe', 'security attendant', '2023', '2023', '2500000', 'ingin menjadi polisi'),
(10, 3, 'cv karya abadi', 'kasir', '2022', '2022', '2000000', 'kasir menggunakan mesin'),
(11, 4, 'pt gudang garam tbk', 'pengadministrasi produksi', '2000', '2008', '4500000', 'ingin melanjutkan studi keluar negeri'),
(12, 5, 'pt epson indonesia elektronik', 'teknisi elektro', '2020', '2021', '5500000', 'kembali ke jawa timur'),
(17, 6, 'pt globalindo textile', 'administrasi produksi', '2020', '2022', '5000000', 'lingkungan kerja kurang nyaman');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelamar`
--

CREATE TABLE `tb_pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `panggilan` varchar(200) NOT NULL,
  `templahir` varchar(100) NOT NULL,
  `tgllahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `agama` varchar(9) NOT NULL,
  `alamat_tinggal` varchar(150) NOT NULL,
  `alamat_ktp` varchar(150) NOT NULL,
  `hp` varchar(13) NOT NULL,
  `wa` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pelamar`
--

INSERT INTO `tb_pelamar` (`id_pelamar`, `nama`, `panggilan`, `templahir`, `tgllahir`, `jenis_kelamin`, `agama`, `alamat_tinggal`, `alamat_ktp`, `hp`, `wa`, `email`, `foto`) VALUES
(2, 'raihan utama', 'kaktus', 'lumajang', '1997-06-20', 'l', 'hindu', 'jalan kebersamaan\r\n', 'jalan bonorogo rt. 002 rw 004, kel telomoyo kec tanjung, kupang', '085160367', '08114627388', 'kaktus_lucu@dot.com', 'raihan utama.png'),
(8, 'anas mustaqin\r\n', 'anas', 'ponorogo', '1985-07-30', 'l', 'islam', 'jl. tumapel gang 2 no. 20 singosari', 'jl. tumapel gang 2 no. 20 singosari', '085231944421', '085231944421', 'anas_22520012@stimata.ac.id', 'anas mustaqin.jpeg'),
(9, 'andri wicaksono\r\n', 'andri', 'ponorogo', '1990-07-23', 'l', 'kristen', 'jl. mangga no. 1 rungkut\r\n', 'jl. madura no. 100 bangkalan, madura\r\n', '081221218989', '085231944421', 'andri@gmail.com', 'andri wicaksono.jpg'),
(10, 'maria anastasia\r\n', 'maria', 'nganjuk', '1997-09-18', 'p', 'katolik', 'jl. kendil no. 32 kras, nganjuk\r\n', 'jl. kendil no. 32 kras, nganjuk\r\n', '0812121324', '08123141341', 'maria@gmail.com', 'maria anastasia.png'),
(11, 'devian pratama', 'devian', 'ponorogo', '1997-08-19', 'l', 'khonghucu', 'jl pertama no. 1 tulungagung', 'tulungagung', '0819990193', '08179879873', 'raihan@jancok.com', 'devian pratama.jpg'),
(12, 'erlyna susanti\r\n', 'erlyna', 'malang', '2003-10-30', 'p', 'budha', 'jl. ketindan rt 03 rw 04 kecamatan lawang kabupaten malang\r\n', 'jl. ketindan rt 03 rw 04 kecamatan lawang kabupaten malang\r\n', '085707890717', '085707890717', 'erlynasusanti3010@gmail.com', 'erlyna susanti.png'),
(13, 'moh qoyum', 'qoyum', 'nganjuk', '1990-12-10', 'l', 'islam', 'jl. sukarno hatta no. 1 kota nganjuk\r\n', 'jl. sukarno hatta no. 1 kota nganjuk\r\n', '081210697174', '081210697174', 'mooh.qoyum@gmail.com', 'moh qoyum.png'),
(14, 'mohamad fathul fahmi\r\n', 'fahmi', 'blitar', '2000-08-01', 'l', 'islam', 'jl. adi sucipto no. 20 kab. blitar\r\n', 'jl. adi sucipto no. 20 kab. blitar\r\n', '087677632312', '087767639850', 'fahmi_1212@gmail.com', 'mohamad fathul fahmi.png'),
(15, 'luthfiana firdaus\r\n', 'fiana', 'kediri', '1999-12-12', 'p', 'islam', 'jl. lembursuro no. 45 kota kediri\r\n', 'jl. lembursuro no. 45 kota kediri\r\n', '085259504438', '085259504438', 'firdausluthfiana@gmail.com', 'luthfiana firdaus.png'),
(16, 'siti nurhaliza', 'nur', 'surabaya', '1994-01-19', 'p', 'budha', 'jalan majapahit, rt. 002, rw. 001, desa kemenangan, kecamatan sukses, bali', 'jalan majemuk, rt. 001, rw. 002, kel. sukses, kecamatan welerang, boyolali', '0819980876', '0819980876', 'imoetz@testing.co.id', 'siti nurhaliza.png'),
(17, 'ekananda ayu ', 'ayu', 'kediri', '2000-05-01', 'p', 'islam', 'jl. letjend sutoyo no. 55 waru, sidoarjo', 'jl. geneng no. 32 kec. banyakan kota kediri', '08214102419', '08214102419', 'ekanandaayu@gmail.com', 'ekananda ayu .jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendidikan`
--

CREATE TABLE `tb_pendidikan` (
  `id_pelamar` int(11) NOT NULL,
  `id_pendidikan` int(11) NOT NULL,
  `sma` varchar(100) NOT NULL,
  `awal_sma` year(4) NOT NULL,
  `lulus_sma` year(4) NOT NULL,
  `jurusan_sma` varchar(6) NOT NULL,
  `jenjang_pendidikan` varchar(5) NOT NULL,
  `universitas` varchar(100) NOT NULL,
  `awal_kuliah` year(4) NOT NULL,
  `lulus_kuliah` year(4) NOT NULL,
  `jurusan_kuliah` varchar(250) NOT NULL,
  `ipk` varchar(4) NOT NULL,
  `judul_skripsi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pendidikan`
--

INSERT INTO `tb_pendidikan` (`id_pelamar`, `id_pendidikan`, `sma`, `awal_sma`, `lulus_sma`, `jurusan_sma`, `jenjang_pendidikan`, `universitas`, `awal_kuliah`, `lulus_kuliah`, `jurusan_kuliah`, `ipk`, `judul_skripsi`) VALUES
(2, 1, 'sma taruna nala malang', '1995', '1998', 'ipa', 's1', 'politeknik negeri malang', '1998', '2002', 'teknik listrik', '3.78', 'pengaplikasian listrik dalam kehidupan sehari-hari'),
(8, 2, 'sma negeri 1 lawang', '1999', '2002', 'ipa', 's1', 'politeknik negeri malang', '2018', '2022', 'teknik informatika', '3.80', 'aplikasi seleksi tes calon karyawan'),
(9, 3, 'sma negeri 1 pamekasan\r\n', '1990', '1996', 'ipa', 's1', 'universitas brawijaya\r\n', '1996', '2000', 'teknik industri', '3.89', 'perbandingan nilai pada penentuan pengiriman cepat pada lokasi yang sama\r\n'),
(10, 4, 'sma negeri 1 nganjuk\r\n', '2021', '2023', 'ips', 's1', 'universitas gadjah mada', '2023', '2025', 'ekonomi bisnis', '2.89', 'pembedahan mekanisme dan keefektifan dp rumah 0% bagi kaum menengah ke bawah'),
(11, 5, 'ma maarif 1 kediri\r\n', '2014', '2017', 'ipa', 'd4', 'universitas airlangga', '2018', '2021', 'mekatronika medis', '3.67', 'pembedahan sistem pencernaan pada tikus usia 3 bulan menggunakan sistem penelusuran jaringan ikat '),
(12, 6, 'sma negeri 1 surabaya\r\n', '2020', '2023', 'ipa', 's1', 'universitas brawijaya', '2020', '2023', 'teknik informatika', '3.04', 'teknologi buatan kunci otomomatis, dengan bahasa pemograman\r\n'),
(13, 7, 'slta malioboro 2 jogjakarta\r\n', '2011', '2014', 'ipa', 'd4', 'sekolah tinggi nulir jogjakarta', '2012', '2015', 'teknik kimia', '3.67', 'teknik nuklir memberikan dampak industri apa'),
(14, 8, 'sma negeri 1 pandaan', '2018', '2021', 'ips', 's1', 'universitas islam kadiri', '2020', '2023', 'teknik industri', '3.89', 'pemamfaatan metode dengan fifo vs fuzzy'),
(15, 9, 'sma negeri bandung', '2010', '2013', 'ipa', 's1', 'institut teknologi bandung', '0000', '0000', 'teknik industri', '3.30', 'industri untuk proses sabun mandi'),
(16, 10, 'sman 1 boyolali', '2016', '2019', 'ipa', 's1', 'universitas cepat lulus', '2019', '2021', 'ilmu tafsir', '3.77', 'penafsiran gelombang ultraviolet pada akrilik dengan sinar gamma '),
(17, 11, 'sma negeri 1 kediri', '2016', '2019', 'ipa', 'slta', 'universitas brawijaya', '2019', '2023', 'manajemen ekonomi pembangunan', '3.56', 'politik uang di tahun 2023 sudah tidak mempan lagi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(13) NOT NULL,
  `jenis_user` varchar(13) NOT NULL COMMENT 'administrator, pelamar, supervisor, staff',
  `status` varchar(1) NOT NULL DEFAULT 'n' COMMENT 'Y = valid; N = tidak valid;\r\nvalid = bisa login'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama`, `password`, `jenis_user`, `status`) VALUES
(1, 'admin', 'administrator', 'admin', 'administrator', 'y'),
(2, 'zprastiwi', 'zelika pratiwi', 'qwe123', 'supervisor', 'y'),
(3, 'andhika', 'andhika galih', 'andhika', 'supervisor', 'n'),
(4, 'mokan', 'uchiha mokan', 'qwe123', 'staff', 'y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  ADD PRIMARY KEY (`id_keluarga`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_organisasi`
--
ALTER TABLE `tb_organisasi`
  ADD UNIQUE KEY `id_organisasi` (`id_organisasi`),
  ADD UNIQUE KEY `id_organisasi_2` (`id_organisasi`),
  ADD UNIQUE KEY `id_organisasi_3` (`id_organisasi`);

--
-- Indexes for table `tb_pekerjaan`
--
ALTER TABLE `tb_pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `tb_pelamar`
--
ALTER TABLE `tb_pelamar`
  ADD PRIMARY KEY (`id_pelamar`);

--
-- Indexes for table `tb_pendidikan`
--
ALTER TABLE `tb_pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id_alternatif` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_organisasi`
--
ALTER TABLE `tb_organisasi`
  MODIFY `id_organisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pekerjaan`
--
ALTER TABLE `tb_pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pelamar`
--
ALTER TABLE `tb_pelamar`
  MODIFY `id_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
