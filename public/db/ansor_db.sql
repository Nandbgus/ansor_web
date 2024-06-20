-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Jun 2024 pada 07.05
-- Versi server: 8.0.30
-- Versi PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ansor_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `blogs`
--

CREATE TABLE `blogs` (
  `id_blog` varchar(25) NOT NULL,
  `judul` text,
  `body` text,
  `foto_blogs` varchar(25) DEFAULT NULL,
  `id_author` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `blogs`
--

INSERT INTO `blogs` (`id_blog`, `judul`, `body`, `foto_blogs`, `id_author`, `time_stamp`) VALUES
('b1', 'Apa itu One Piece ?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, iure modi beatae dolores autem vitae temporibus consequuntur error, sapiente animi tempora ipsum esse voluptatibus minus dicta, impedit nesciunt eligendi nobis in. Soluta iste consequatur adipisci commodi, nostrum dolores ipsum dolorum, repudiandae sed voluptatem voluptatibus hic impedit numquam doloremque ex eius pariatur, facilis error quis. Sint nostrum earum neque ad ipsa soluta laborum ullam maiores molestias, incidunt eos doloremque animi! Eligendi eaque asperiores soluta aliquam? Quis similique qui officia culpa amet!', NULL, 'XII265BENDOAGUNG3', '2024-06-12 05:27:51'),
('b10', 'Guru Besar UIN Jakarta Singgung Inovasi Penyelenggaraan Haji, Dorong Terobosan Baru', 'Makkah (Kemenag) --- Puncak penyelenggaraan ibadah haji 2024, usai. Guru besar UIN Jakarta Ahmad Tholabi Kharlie menilai, secara umum, pelaksanaan ibadah haji berjalan dengan baik.\r\n\r\nmenurutnya, sejumlah inovasi penyelenggaraan ibadah haji tahun ini dapat meminimalisasi risiko dalam penyelenggaraan haji. Catatan evaluatif perlu dibaca sebagai ikhtiar untuk perbaikan penyelenggaraan ibadah haji di waktu mendatang.\r\n\r\nAhmad Tholabi Kharlie mencatat ada sejumlah inovasi dalam penyelenggaraan ibadah haji 2024 menjadi ikhtiar pemerintah Indonesia untuk meminimalisasi risiko atas penyelenggaraan ibadah haji, khususnya bagi jemaah yang masuk kategori rentan.\r\n\r\n“Kebijakan murur saat di Arafah, Muzdalifah, dan Mina (Armuzna), keberadaan aplikasi kawal haji dan aplikasi fast track merupakan terobosan yang muncul sebagai respons atas persoalan yang terjadi dalam penyelenggaraan ibadah haji sebelumnya,” kata Tholabi di sela-sela kegiatan monitoring dan evaluasi penyelenggaraan ibadah haji 2024 di Makkah, Rabu (19/6/2024).\r\n\r\nWakil Rektor UIN Jakarta ini mencontohkan kebijakan murur berupa pendorongan sebagian jemaah langsung dari Arafah ke Mina, terutama bagi jemaah lansia, risiko tinggi, dan difabel, tanpa melakukan mabit atau berdiam diri di area Muzdalifah merupakan terobosan yang progresif. “Langkah Kementerian Agama ini sudah tepat dan memenuhi asas perlindungan terhadap Jemaah. Ini kebijakan yang out of the box,” tegas Tholabi.\r\n\r\nKebijakan tersebut, kata Profesor Hukum Islam ini, juga telah melalui proses istinbath hukum dengan melibatkan ulama dari pelbagai organisasi kemasyarakatan Islam. Langkah tersebut, kata Tholabi, dimaksudkan agar kebijakan murur tidak menimbulkan polemik sehingga akan melahirkan keyakinan pada diri jemaah yang mengikuti program murur.\r\n\r\n“Ini salah satu ijtihad penting Kementerian Agama dalam mengatasi problem empirik ibadah haji saat ini. Kebijakan ini juga secara signifikan mengurangi angka kematian jemaah calon haji yang sangat rawan pada titik ini,” tambah Tholabi.', 'pp.jpg', 'XII265NGADIMULYO4', '2024-06-20 05:36:31'),
('b2', 'Aqua Coy', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure distinctio laborum rerum iste. Culpa qui eveniet veritatis quam numquam a non impedit quisquam nemo quidem saepe officia porro, iure quo sequi dolores ut ducimus laborum quia. Obcaecati magni alias vel odio, expedita tempora inventore corporis, vero excepturi voluptatum totam maiores quos quia est voluptatem. Accusantium, voluptates quia distinctio architecto similique nemo! Fuga, quasi consectetur labore molestiae facere debitis! Ab in, ut ratione delectus ducimus placeat numquam labore reiciendis pariatur omnis ea, exercitationem unde dolores commodi repellendus non a sed fuga minus! Beatae, non. Porro laudantium placeat dolorem voluptatum accusamus impedit quo, cum numquam doloribus molestiae quod nam architecto amet, distinctio similique. Quod molestiae tempora enim, fugiat exercitationem facere veniam, laboriosam obcaecati commodi est, quasi omnis repellendus! Sequi iste tempore vero minima, maiores nemo. Distinctio facere obcaecati minima laboriosam officia dignissimos. Facere iusto totam praesentium voluptatibus dolor nemo nisi, doloribus quia.', NULL, 'XII265BENDOAGUNG3', '2024-06-12 05:27:51'),
('b3', 'Kinerja Pemerintah Dunia', 'Misteri Kinerja Pemerintah Dunia atau World Goverment', NULL, 'XII265BENDOAGUNG3', '2024-06-12 13:00:39'),
('b4', 'The Most Popular', 'Dunia dihebokan oleh Kepopuleran oleh sebuah aplikasi, namanya tiktok', NULL, 'XII265BENDOAGUNG3', '2024-06-12 13:22:44'),
('b5', 'Hp bapuk? Poco x5 Pro', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel debitis distinctio quis, est provident aut doloremque. Iusto consequatur eligendi nostrum atque suscipit magni sequi, consectetur vitae a provident laborum, delectus repudiandae quis illum. Ipsa magni consequuntur officiis veniam placeat rerum magnam tempore facilis esse tenetur quidem, id aliquid incidunt explicabo molestiae animi consequatur sit fugiat! Debitis nemo rem pariatur voluptatem earum labore ad odio tempora. Minus, excepturi. Laboriosam totam id iure rerum porro voluptates dolore commodi veniam beatae ex expedita ipsum magni error neque doloremque aspernatur consequuntur perferendis vero, nemo, odit cumque impedit reprehenderit. Laborum praesentium id quis quod. Non nesciunt eum quisquam! Voluptas error alias, hic fugit, asperiores tempora non porro nobis sequi et molestiae excepturi laboriosam aperiam nemo! Voluptates, ut voluptatibus adipisci quos totam modi tempore corrupti assumenda explicabo, reprehenderit delectus dolorum omnis enim praesentium facere itaque. Doloribus reprehenderit dicta dignissimos explicabo excepturi? At mollitia repellat, reiciendis possimus placeat fugiat ea ex, consequatur laudantium consequuntur officiis enim necessitatibus suscipit neque commodi nemo blanditiis eum magnam saepe. Amet nam quam quasi laboriosam, similique nulla quo cum accusamus reiciendis odio voluptatibus autem exercitationem maxime sint vel natus deserunt maiores dignissimos aperiam consectetur temporibus. Dolorum soluta illo modi ipsum nisi sunt!', NULL, 'XII265BENDOAGUNG3', '2024-06-12 17:46:09'),
('b6', 'Kinerja Pemerintah', 'tes', NULL, 'XII265BENDOAGUNG3', '2024-06-13 06:04:55'),
('b7', 'Tes', 'asdasdhk', NULL, 'XII265BENDOAGUNG3', '2024-06-14 15:45:20'),
('b8', 'Saya ingin mencoba lewat hp', 'Tes 123', NULL, 'XII265BENDOAGUNG3', '2024-06-14 16:11:43'),
('b9', 'Menag: Indonesia Dapat 221 Ribu Kuota Haji 1446 H/2025 M', 'Makkah (Kemenag) --- Menteri Agama Yaqut Cholil Qoumas mengatakan bahwa Indonesia kembali mendapat kuota 221.000 jemaah pada operasional haji 1446 H/2025 M. Kepastian kuota haji tahun depan diperoleh Menag usai menghadiri Tasyakuran Penutupan Penyelenggaraan Ibadah Haji 1445 H dan Pemberian Kuota 1446 H.\r\n\r\nAcara ini diselenggarakan oleh Kementerian Haji dan Umrah Arab Saudi di Makkah. Hadir para pimpinan delegasi haji dari berbagai negara.\r\n\r\nIkut mendampingi Menag, Wakil Menteri Agama Saiful Rahmat Dasuki, Sekjen Kemenag M Ali Ramdhani, Dirjen Penyelenggaraan Haji dan Umrah Hilman Latief, Staf Khusus Menag Ishfah Abidal Aziz, Direktur Layanan Haji Luar Negeri Subhan Cholid, dan Konsul Haji KJRI Jeddah Nasrullah Jasam.\r\n\r\n\"Malam ini saya menghadiri Haflul Hajji Al-Khitamy semacam malam tasyakuran atas selesainya penyelenggaraan ibadah haji 1445 H. Saya mendapat informasi dari Wakil Kementerian Bidang Urusan Haji \'Ayed Al Ghuwainim, dan sesuai surat yang saya terima, bahwa Indonesia mendapat 221.000 kuota haji 1446 H/2025 M,\" terang Menag Yaqut, di kantor Kementerian Haji dan Umrah Saudi, Makkah, Selasa (18/6/2024).\r\n\r\n\"Kita mengapresiasi Kemenhaj Saudi yang kembali mengumumkan kuota lebih awal. Sehingga proses persiapan penyelenggaraan haji juga bisa dilakukan lebih cepat,\" sebut Gus Men, panggilan akrabnya.', NULL, 'XII265NGADIMULYO4', '2024-06-20 05:20:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog_kategori`
--

CREATE TABLE `blog_kategori` (
  `id_blog` varchar(25) NOT NULL,
  `id_kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `blog_kategori`
--

INSERT INTO `blog_kategori` (`id_blog`, `id_kategori`) VALUES
('b1', 'HR'),
('b1', 'SC'),
('b2', 'SC'),
('b3', 'SC'),
('b4', 'HR'),
('b5', 'SC'),
('b6', 'HR'),
('b7', 'HR'),
('b8', 'HR'),
('b9', 'SC'),
('b10', 'HR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa`
--

CREATE TABLE `desa` (
  `id` varchar(50) NOT NULL,
  `kecamatan_id` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `desa`
--

INSERT INTO `desa` (`id`, `kecamatan_id`, `nama`, `aktif`) VALUES
('3503040001', '3503040', 'NGADIMULYO', 1),
('3503040002', '3503040', 'KARANGREJO', 1),
('3503040003', '3503040', 'SENDEN', 1),
('3503040004', '3503040', 'SUGIHAN', 1),
('3503040005', '3503040', 'BENDOAGUNG', 1),
('3503040006', '3503040', 'BOGORAN', 1),
('3503040007', '3503040', 'TIMAHAN', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dusun`
--

CREATE TABLE `dusun` (
  `id_dusun` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_desa` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `dusun`
--

INSERT INTO `dusun` (`id_dusun`, `id_desa`, `nama`, `aktif`) VALUES
('3503040003Kemiri', '3503040003', 'Kemiri', 1),
('350304001PG', '3503040001', 'Pagu', 1),
('350304005BR', '3503040005', 'Bogoran', 1),
('350304005KD', '3503040005', 'Kedungdowo', 1);

--
-- Trigger `dusun`
--
DELIMITER $$
CREATE TRIGGER `before_dusun_insert` BEFORE INSERT ON `dusun` FOR EACH ROW BEGIN
    SET NEW.id_dusun = CONCAT(NEW.id_desa, NEW.nama);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategories`
--

CREATE TABLE `kategories` (
  `id_kategori` varchar(25) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategories`
--

INSERT INTO `kategories` (`id_kategori`, `kategori`) VALUES
('HR', 'HOROR'),
('SC', 'SCIENCE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama`, `aktif`) VALUES
('3501010', 'DONOROJO', 1),
('3501020', 'PUNUNG', 1),
('3501030', 'PRINGKUKU', 1),
('3501040', 'PACITAN', 1),
('3501050', 'KEBONAGUNG', 1),
('3501060', 'ARJOSARI', 1),
('3501070', 'NAWANGAN', 1),
('3501080', 'BANDAR', 1),
('3501090', 'TEGALOMBO', 1),
('3501100', 'TULAKAN', 1),
('3501110', 'NGADIROJO', 1),
('3501120', 'SUDIMORO', 1),
('3502010', 'NGRAYUN', 1),
('3502020', 'SLAHUNG', 1),
('3502030', 'BUNGKAL', 1),
('3502040', 'SAMBIT', 1),
('3502050', 'SAWOO', 1),
('3502060', 'SOOKO', 1),
('3502061', 'PUDAK', 1),
('3502070', 'PULUNG', 1),
('3502080', 'MLARAK', 1),
('3502090', 'SIMAN', 1),
('3502100', 'JETIS', 1),
('3502110', 'BALONG', 1),
('3502120', 'KAUMAN', 1),
('3502130', 'JAMBON', 1),
('3502140', 'BADEGAN', 1),
('3502150', 'SAMPUNG', 1),
('3502160', 'SUKOREJO', 1),
('3502170', 'PONOROGO', 1),
('3502180', 'BABADAN', 1),
('3502190', 'JENANGAN', 1),
('3502200', 'NGEBEL', 1),
('3503010', 'PANGGUL', 1),
('3503020', 'MUNJUNGAN', 1),
('3503030', 'WATULIMO', 1),
('3503040', 'KAMPAK', 1),
('3503050', 'DONGKO', 1),
('3503060', 'PULE', 1),
('3503070', 'KARANGAN', 1),
('3503071', 'SURUH', 1),
('3503080', 'GANDUSARI', 1),
('3503090', 'DURENAN', 1),
('3503100', 'POGALAN', 1),
('3503110', 'TRENGGALEK', 1),
('3503120', 'TUGU', 1),
('3503130', 'BENDUNGAN', 1),
('3504010', 'BESUKI', 1),
('3504020', 'BANDUNG', 1),
('3504030', 'PAKEL', 1),
('3504040', 'CAMPUR DARAT', 1),
('3504050', 'TANGGUNG GUNUNG', 1),
('3504060', 'KALIDAWIR', 1),
('3504070', 'PUCANG LABAN', 1),
('3504080', 'REJOTANGAN', 1),
('3504090', 'NGUNUT', 1),
('3504100', 'SUMBERGEMPOL', 1),
('3504110', 'BOYOLANGU', 1),
('3504120', 'TULUNGAGUNG', 1),
('3504130', 'KEDUNGWARU', 1),
('3504140', 'NGANTRU', 1),
('3504150', 'KARANGREJO', 1),
('3504160', 'KAUMAN', 1),
('3504170', 'GONDANG', 1),
('3504180', 'PAGER WOJO', 1),
('3504190', 'SENDANG', 1),
('3505010', 'BAKUNG', 1),
('3505020', 'WONOTIRTO', 1),
('3505030', 'PANGGUNGREJO', 1),
('3505040', 'WATES', 1),
('3505050', 'BINANGUN', 1),
('3505060', 'SUTOJAYAN', 1),
('3505070', 'KADEMANGAN', 1),
('3505080', 'KANIGORO', 1),
('3505090', 'TALUN', 1),
('3505100', 'SELOPURO', 1),
('3505110', 'KESAMBEN', 1),
('3505120', 'SELOREJO', 1),
('3505130', 'DOKO', 1),
('3505140', 'WLINGI', 1),
('3505150', 'GANDUSARI', 1),
('3505160', 'GARUM', 1),
('3505170', 'NGLEGOK', 1),
('3505180', 'SANANKULON', 1),
('3505190', 'PONGGOK', 1),
('3505200', 'SRENGAT', 1),
('3505210', 'WONODADI', 1),
('3505220', 'UDANAWU', 1),
('3506010', 'MOJO', 1),
('3506020', 'SEMEN', 1),
('3506030', 'NGADILUWIH', 1),
('3506040', 'KRAS', 1),
('3506050', 'RINGINREJO', 1),
('3506060', 'KANDAT', 1),
('3506070', 'WATES', 1),
('3506080', 'NGANCAR', 1),
('3506090', 'PLOSOKLATEN', 1),
('3506100', 'GURAH', 1),
('3506110', 'PUNCU', 1),
('3506120', 'KEPUNG', 1),
('3506130', 'KANDANGAN', 1),
('3506140', 'PARE', 1),
('3506141', 'BADAS', 1),
('3506150', 'KUNJANG', 1),
('3506160', 'PLEMAHAN', 1),
('3506170', 'PURWOASRI', 1),
('3506180', 'PAPAR', 1),
('3506190', 'PAGU', 1),
('3506191', 'KAYEN KIDUL', 1),
('3506200', 'GAMPENGREJO', 1),
('3506201', 'NGASEM', 1),
('3506210', 'BANYAKAN', 1),
('3506220', 'GROGOL', 1),
('3506230', 'TAROKAN', 1),
('3507010', 'DONOMULYO', 1),
('3507020', 'KALIPARE', 1),
('3507030', 'PAGAK', 1),
('3507040', 'BANTUR', 1),
('3507050', 'GEDANGAN', 1),
('3507060', 'SUMBERMANJING', 1),
('3507070', 'DAMPIT', 1),
('3507080', 'TIRTO YUDO', 1),
('3507090', 'AMPELGADING', 1),
('3507100', 'PONCOKUSUMO', 1),
('3507110', 'WAJAK', 1),
('3507120', 'TUREN', 1),
('3507130', 'BULULAWANG', 1),
('3507140', 'GONDANGLEGI', 1),
('3507150', 'PAGELARAN', 1),
('3507160', 'KEPANJEN', 1),
('3507170', 'SUMBER PUCUNG', 1),
('3507180', 'KROMENGAN', 1),
('3507190', 'NGAJUM', 1),
('3507200', 'WONOSARI', 1),
('3507210', 'WAGIR', 1),
('3507220', 'PAKISAJI', 1),
('3507230', 'TAJINAN', 1),
('3507240', 'TUMPANG', 1),
('3507250', 'PAKIS', 1),
('3507260', 'JABUNG', 1),
('3507270', 'LAWANG', 1),
('3507280', 'SINGOSARI', 1),
('3507290', 'KARANGPLOSO', 1),
('3507300', 'DAU', 1),
('3507310', 'PUJON', 1),
('3507320', 'NGANTANG', 1),
('3507330', 'KASEMBON', 1),
('3508010', 'TEMPURSARI', 1),
('3508020', 'PRONOJIWO', 1),
('3508030', 'CANDIPURO', 1),
('3508040', 'PASIRIAN', 1),
('3508050', 'TEMPEH', 1),
('3508060', 'LUMAJANG', 1),
('3508061', 'SUMBERSUKO', 1),
('3508070', 'TEKUNG', 1),
('3508080', 'KUNIR', 1),
('3508090', 'YOSOWILANGUN', 1),
('3508100', 'ROWOKANGKUNG', 1),
('3508110', 'JATIROTO', 1),
('3508120', 'RANDUAGUNG', 1),
('3508130', 'SUKODONO', 1),
('3508140', 'PADANG', 1),
('3508150', 'PASRUJAMBE', 1),
('3508160', 'SENDURO', 1),
('3508170', 'GUCIALIT', 1),
('3508180', 'KEDUNGJAJANG', 1),
('3508190', 'KLAKAH', 1),
('3508200', 'RANUYOSO', 1),
('3509010', 'KENCONG', 1),
('3509020', 'GUMUK MAS', 1),
('3509030', 'PUGER', 1),
('3509040', 'WULUHAN', 1),
('3509050', 'AMBULU', 1),
('3509060', 'TEMPUREJO', 1),
('3509070', 'SILO', 1),
('3509080', 'MAYANG', 1),
('3509090', 'MUMBULSARI', 1),
('3509100', 'JENGGAWAH', 1),
('3509110', 'AJUNG', 1),
('3509120', 'RAMBIPUJI', 1),
('3509130', 'BALUNG', 1),
('3509140', 'UMBULSARI', 1),
('3509150', 'SEMBORO', 1),
('3509160', 'JOMBANG', 1),
('3509170', 'SUMBER BARU', 1),
('3509180', 'TANGGUL', 1),
('3509190', 'BANGSALSARI', 1),
('3509200', 'PANTI', 1),
('3509210', 'SUKORAMBI', 1),
('3509220', 'ARJASA', 1),
('3509230', 'PAKUSARI', 1),
('3509240', 'KALISAT', 1),
('3509250', 'LEDOKOMBO', 1),
('3509260', 'SUMBERJAMBE', 1),
('3509270', 'SUKOWONO', 1),
('3509280', 'JELBUK', 1),
('3509710', 'KALIWATES', 1),
('3509720', 'SUMBERSARI', 1),
('3509730', 'PATRANG', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama`, `tanggal`, `keterangan`) VALUES
('MS2', 'Meeting Bulanan', '2024-06-05', ''),
('MS3', 'Pelatihan Kenaikan', '2024-06-12', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_kegiatan`
--

CREATE TABLE `laporan_kegiatan` (
  `id_laporan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_anggota` varchar(25) NOT NULL,
  `id_kegiatan` varchar(25) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `status_verif` enum('pending','approve','rejected','') NOT NULL DEFAULT 'pending',
  `foto` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `laporan_kegiatan`
--

INSERT INTO `laporan_kegiatan` (`id_laporan`, `id_anggota`, `id_kegiatan`, `tanggal_kegiatan`, `status_verif`, `foto`) VALUES
('XII265BENDOAGUNG3_20240607', 'XII265BENDOAGUNG3', 'MS2', '2024-06-07', 'approve', 'pp.jpg'),
('XII265BENDOAGUNG3_20240618', 'XII265BENDOAGUNG3', 'MS3', '2024-06-18', 'rejected', 'XII265BENDOAGUNG3_MS3.jpg'),
('XII265BENDOAGUNG5_20240611', 'XII265BENDOAGUNG5', 'MS2', '2024-06-11', 'rejected', 'XII265BENDOAGUNG5_MS2.jpg'),
('XII265BENDOAGUNG5_20240622', 'XII265BENDOAGUNG5', 'MS3', '2024-06-22', 'approve', 'XII265BENDOAGUNG5_MS3.jpg'),
('XII265BENDOAGUNG5_20240627', 'XII265BENDOAGUNG5', 'MS2', '2024-06-27', 'pending', 'XII265BENDOAGUNG5_MS2.jpg'),
('XII265BENDOAGUNG5_20240629', 'XII265BENDOAGUNG5', 'MS3', '2024-06-29', 'rejected', 'XII265BENDOAGUNG5_MS3.jpg');

--
-- Trigger `laporan_kegiatan`
--
DELIMITER $$
CREATE TRIGGER `generate_id_laporan_kegiatan` BEFORE INSERT ON `laporan_kegiatan` FOR EACH ROW SET NEW.id_laporan = CONCAT(NEW.id_anggota,'_',DATE_FORMAT(NEW.tanggal_kegiatan, '%Y%m%d'))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id` varchar(25) NOT NULL,
  `nama_a` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `id_dusun` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rt` int NOT NULL,
  `foto` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id`, `nama_a`, `no_hp`, `id_dusun`, `rt`, `foto`, `id_status`) VALUES
('XII265BENDOAGUNG1', 'Nanda Bagus', '082228507585', '350304005KD', 37, '', 'ANS'),
('XII265BENDOAGUNG3', 'Ananda Bagus', '0822285647123', '350304005BR', 38, '666c3.jpg', 'RJA'),
('XII265BENDOAGUNG5', 'Fernandi Miftahkur riski', '082228507585', '350304005KD', 38, '666c6.jpg', 'BNS'),
('XII265NGADIMULYO4', 'Reinaldi', '085643511283', '350304001PG', 37, '6673b.jpg', 'ANS'),
('XII265NGADIMULYO5', 'Ananda', '082228507585', '350304001PG', 38, NULL, 'RJA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_keanggotaan`
--

CREATE TABLE `status_keanggotaan` (
  `id` varchar(25) NOT NULL,
  `nama_keanggotaan` varchar(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `status_keanggotaan`
--

INSERT INTO `status_keanggotaan` (`id`, `nama_keanggotaan`, `keterangan`) VALUES
('ANS', 'ANSOR', ''),
('BNS', 'BANSER', ''),
('RJA', 'RIJALUL ANSOR', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(25) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `is_admin`, `password`) VALUES
('XII265BENDOAGUNG1', 1, 'admin'),
('XII265BENDOAGUNG3', 1, '$2y$10$GMQF/T54zoEr2.z4JX0fW.rPjZ7HkXA2lUhQHlZaLpY1EZKDdwF4G'),
('XII265BENDOAGUNG5', 0, '$2y$10$Hk8.5OAbHX3dBmhJ4w9DFefbTjVWT.1XvSy7DQdnIPeoyJbpq1bAa'),
('XII265NGADIMULYO4', 1, '$2y$10$fXpbJw7pIRdOBjmDc.zrwOxXeM0fLmiZAchcnT0nBaEcYZv79hDXO'),
('XII265NGADIMULYO5', 0, '$2y$10$KgqOQtLm/eVqUrBzp6nqte/Y6Qs5eqK8W.SPqQ/cWtm7SgZCYDxTK');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id_blog`),
  ADD UNIQUE KEY `id` (`id_blog`),
  ADD KEY `id_author` (`id_author`);

--
-- Indeks untuk tabel `blog_kategori`
--
ALTER TABLE `blog_kategori`
  ADD KEY `id_blog` (`id_blog`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indeks untuk tabel `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id_dusun`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indeks untuk tabel `kategories`
--
ALTER TABLE `kategories`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indeks untuk tabel `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_kegiatan` (`id_kegiatan`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rt` (`id_dusun`),
  ADD KEY `id_status` (`id_status`);

--
-- Indeks untuk tabel `status_keanggotaan`
--
ALTER TABLE `status_keanggotaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `members` (`id`);

--
-- Ketidakleluasaan untuk tabel `blog_kategori`
--
ALTER TABLE `blog_kategori`
  ADD CONSTRAINT `blog_kategori_ibfk_1` FOREIGN KEY (`id_blog`) REFERENCES `blogs` (`id_blog`),
  ADD CONSTRAINT `blog_kategori_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategories` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `desa`
--
ALTER TABLE `desa`
  ADD CONSTRAINT `desa_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`);

--
-- Ketidakleluasaan untuk tabel `dusun`
--
ALTER TABLE `dusun`
  ADD CONSTRAINT `dusun_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id`);

--
-- Ketidakleluasaan untuk tabel `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  ADD CONSTRAINT `laporan_kegiatan_ibfk_2` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`),
  ADD CONSTRAINT `laporan_kegiatan_ibfk_3` FOREIGN KEY (`id_anggota`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`id_dusun`) REFERENCES `dusun` (`id_dusun`),
  ADD CONSTRAINT `members_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status_keanggotaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
