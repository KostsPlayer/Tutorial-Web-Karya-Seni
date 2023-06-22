-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 22 Jun 2023 pada 05.19
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arts`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `access_menu`
--

CREATE TABLE `access_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `access_menu`
--

INSERT INTO `access_menu` (`id`, `menu_id`, `role_id`) VALUES
(1, 1, 1),
(3, 3, 1),
(4, 4, 1),
(6, 5, 1),
(7, 2, 2),
(8, 4, 2),
(9, 5, 2),
(15, 6, 1),
(16, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(32) NOT NULL,
  `icon` varchar(64) NOT NULL,
  `about` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `categories`, `icon`, `about`) VALUES
(1, 'Fine Arts', 'fa-solid fa-fw fa-toolbox', 'Fine art provides freedom for artists to express their worldview and inspire viewers to experience and understand the world through different visual perspectives.'),
(2, 'Painting', 'fa-solid fa-fw fa-paintbrush', 'Painting is a wordless language that allows us to convey and understand emotions, stories, and beauty through the touch of brushes, vibrant colors, and flowing imagery. In the silence of created images, the world is manifested in boundless ways, inviting u'),
(3, 'Art of Music', 'fa-solid fa-fw fa-music', 'Music is a universal language that touches the soul and guides us into a realm of profound emotions. With each created melody, interwoven harmony, and pulsating rhythm, music connects us to unspoken beauty. It opens the door to the heart, embraces unexpres'),
(4, 'Vokal Arts', 'fa-brands fa-fw fa-soundcloud', 'Vocal art is a marvel of sound that fills the space and touches our hearts with unexpected beauty. In every uttered note, shaped melody, and sung lyric, the human voice becomes an enchanting instrument to express emotions, evoke feelings, and connect our s'),
(5, 'Dance Arts', 'fa-solid fa-fw fa-icons', 'Dance is a language of movement that liberates the soul and reveals beauty in choreographed motion. Through expressive gestures and flowing rhythms, dance portrays stories, emotions, and cultures in an unparalleled way. With every step taken and movement c'),
(6, 'Dramatic Arts', 'fa-solid fa-fw fa-masks-theater', 'Drama is a stage of life that unfolds profound stories and brings characters to life with boundless emotional power. Within the magical world of the stage, actors come together to convey heart-stirring narratives, evoke laughter, and explore the complexiti'),
(7, 'Literary Arts', 'fa-solid fa-fw fa-book-bookmark', 'Literature is the beauty unfolded through words, creating boundless worlds in our imagination. Within the pages filled with thoughts, stories, and insights, literature offers a window into human life, taking us on profound emotional journeys. Through the p');

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery_method`
--

CREATE TABLE `delivery_method` (
  `id` int(11) NOT NULL,
  `delivery` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `delivery_method`
--

INSERT INTO `delivery_method` (`id`, `delivery`) VALUES
(1, 'Standard Delivery'),
(2, 'Express Delivery'),
(3, 'In-Store Pickup'),
(4, 'International Delivery'),
(5, 'PT Pos Indonesia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `format`
--

CREATE TABLE `format` (
  `id` int(11) NOT NULL,
  `format` varchar(32) NOT NULL,
  `icon` varchar(64) NOT NULL,
  `about` varchar(192) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `format`
--

INSERT INTO `format` (`id`, `format`, `icon`, `about`) VALUES
(1, 'Photo', 'fa-solid fa-fw fa-image', 'Visualizing images can provide the freedom of imaginative space in personal development.'),
(2, 'Video', 'fa-solid fa-fw fa-film', 'Animated motion can provide a clearer perspective on many things.'),
(3, 'Audio', 'fa-solid fa-fw fa-compact-disc', 'Audio holds many secrets that can only be felt by the listener.'),
(4, 'Document', 'fa-solid fa-fw fa-signature', 'Documentation is the beginning of elevated knowledge and the implementation of abstraction.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `main_contact`
--

CREATE TABLE `main_contact` (
  `id` int(11) NOT NULL,
  `location` varchar(128) NOT NULL,
  `map` varchar(512) NOT NULL,
  `email` varchar(64) NOT NULL,
  `number` varchar(24) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `main_contact`
--

INSERT INTO `main_contact` (`id`, `location`, `map`, `email`, `number`, `is_active`) VALUES
(2, 'Gedung Rektorat, Jl. Sari Asih No.54, Kota Bandung, Jawa Barat 40151', 'Google map', 'azka.nuril070@gmail.com', '082334100715', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `menu`) VALUES
(1, 'Administrator'),
(2, 'User'),
(3, 'Menu'),
(4, 'Fiture'),
(5, 'Transaction'),
(6, 'Item');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `payment` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payment_method`
--

INSERT INTO `payment_method` (`id`, `payment`) VALUES
(1, 'Cash Payment'),
(2, 'Bank Transfer'),
(3, 'Credit/Debit Card'),
(4, 'Digital Payment'),
(5, 'Virtual Account');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `name_item` varchar(128) NOT NULL,
  `description` varchar(196) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `price` int(11) NOT NULL,
  `file` varchar(128) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `format_id` int(11) NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `username`, `email`, `name_item`, `description`, `address`, `phone_number`, `price`, `file`, `categories_id`, `format_id`, `date_create`) VALUES
(57, 'Kosts Player', 'azka.nuril070@gmail.com', 'Water color', 'The best things', '-', '', 0, 'pexels-alexander-ant-7004697.jpg', 2, 1, 1686272575),
(58, 'Kosts Player', 'azka.nuril070@gmail.com', 'Fine 1', '', '-', '', 0, 'pexels-los-muertos-crew-8066078.jpg', 1, 1, 1686272695),
(59, 'Kosts Player', 'azka.nuril070@gmail.com', 'Fine 2', '', '-', '', 0, 'pexels-regiane-tosatti-22824.jpg', 1, 1, 1686272669),
(60, 'Kosts Player', 'azka.nuril070@gmail.com', 'Angklung', 'From Indonesia to World!', '-', '', 0, 'pexels-teguh-dewanto-14530658.jpg', 3, 1, 1686272752),
(62, 'Kosts Player', 'azka.nuril070@gmail.com', 'Literary 2', 'Read good', '-', '', 0, 'pexels-poppy-thomas-hill-6535877.jpg', 7, 1, 1686274711),
(63, 'Kosts Player', 'azka.nuril070@gmail.com', 'Musix', 'Read best', '-', '', 0, 'pexels-wendy-wei-2044181-1920x1080-60fps.mp4', 3, 2, 1686274789),
(64, 'Kosts Player', 'azka.nuril070@gmail.com', 'Musix', '', '-', '', 0, 'pexels-cottonbro-studio-4709822.jpg', 3, 1, 1686275100),
(65, 'Nur4ini', 'fikrifaad@gmail.com', 'Something', '', '-', '', 0, 'pexels-cottonbro-studio-7520751.jpg', 6, 1, 1686280682),
(67, 'Kosts Player', 'azka.nuril070@gmail.com', 'Colorfull', 'Ready to order!', 'Bandung', '', 19, 'pexels-this-is-zun-1253951.jpg', 2, 1, 1686617529),
(68, 'Kosts Player', 'playerskost@gmail.com', 'arts', '', '-', '', 0, 'pexels-cottonbro-studio-75207511.jpg', 5, 1, 1686617767),
(69, 'Nur4ini', 'fikrifaad@gmail.com', 'misal', '', '-', '', 0, '648a8fff5186b.jpg', 1, 1, 1686889710),
(70, 'Kosts Player', 'azka.nuril070@gmail.com', '', 'some', 'Bandung Lautan Api Jauh Di Sana Sekali Banget', '', 0, 'pexels-gentina-danurendra-2919437.jpg', 6, 1, 1687350237),
(71, 'Kosts Player', 'azka.nuril070@gmail.com', 'asf', 'a', '-', '', 0, 'DB6.png', 1, 1, 1686981689),
(72, 'Kosts Player', 'azka.nuril070@gmail.com', 'aefae', 'l', '-', '', 1, 'DB7.png', 1, 1, 1686983389),
(73, 'Kosts Player', 'azka.nuril070@gmail.com', 'something', 'Ini adalah sesuatu', '-', '', 1, 'forMyLove.png.png', 1, 1, 1686988323),
(74, 'Kosts Player', 'azka.nuril070@gmail.com', 'buna', 'banu', '-', '', 1, 'indonesia.png.png', 1, 1, 1686989928),
(75, 'Kosts Player', 'azka.nuril070@gmail.com', 'apalah', 'aplaah juga', '-', '', 12000, 'pexels-anete-lusina-5721137.jpg.jpg', 1, 1, 1686990026),
(76, 'Kosts Player', 'azka.nuril070@gmail.com', '', '<?php\r\ndefined(\'BASEPATH\') OR exit(\'No direct script access allowed\');\r\n\r\nclass ChatController extends CI_Controller {\r\n\r\n    public function index()\r\n    {\r\n        $this->load->view(\'chat\');\r\n  ', 'Bandung Lautan Api Jauh Di Sana Sekali Banget', '', 2, 'pexels-ronaldo-nascimento-16015906.jpg', 2, 1, 1687350286),
(77, 'Kosts Player', 'azka.nuril070@gmail.com', 'some', 'Anda dapat menyesuaikan tampilan dan opsi lainnya dengan menggunakan berbagai opsi yang disediakan oleh DataTables. Misalnya, Anda dapat menambahkan opsi seperti pengaturan jumlah entri per halama', 'Bandung Lautan Api Jauh Di Sana Sekali Banget', '', 12, 'stemming.png.png', 4, 1, 1687234078),
(78, 'Kosts Player', 'azka.nuril070@gmail.com', 'idk', 'Jadi, jika Anda ingin membalik urutan elemen dalam Bootstrap 5, Anda perlu menggunakan metode CSS atau JavaScript yang sesuai untuk mencapai hasil tersebut, karena kelas reverse tidak lagi tersedi', 'Bandung Lautan Api Jauh Di Sana Sekali Banget', '', 0, 'pexels-luis-quintero-4341241.jpg', 7, 1, 1687351639),
(79, 'Kosts Player', 'azka.nuril070@gmail.com', 'buatafaeaef', 'aegaaegwjnrabauhihfdksnvknaknvkbx v bx  m,vlknsdnklngnsnvknxnvlksV,xc ,xc, kbXHVIOSDVs  V NSDNVONSpovjosJfvosFVSDLNv  NVNsdnvnsdfnlwefsd.  sn nsdvnosjpjsjfweanfjs s ', 'Bandung Lautan Api Jauh Di Sana Sekali Banget', '', 1, 'pexels-mehmet-aslan-15999726.jpg', 2, 1, 1687352390),
(80, 'Kosts Player', 'azka.nuril070@gmail.com', 'Angklung', 'Angklung adalah alat musik tradisional dari Indonesia yang terbuat dari bambu. Alat ini memiliki beberapa tabung bambu dengan ukuran yang berbeda, menghasilkan nada saat digoyangkan. Dimainkan sec', 'Bandung Lautan Api Jauh Di Sana Sekali Banget', '082334100715', 0, 'pexels-teguh-dewanto-14530658.jpg', 3, 1, 1687398997),
(81, 'Kosts Player', 'azka.nuril070@gmail.com', 'The Gucci', 'Guci khas seni adalah wadah penyimpanan dengan elemen seni yang unik. Mereka dibuat oleh seniman yang menggabungkan kerajinan tangan dengan seni. Guci ini berasal dari berbagai budaya dan gaya sen', 'Bandung Lautan Api Jauh Di Sana Sekali Banget', '082334100715', 10, 'pexels-los-muertos-crew-8066078.jpg', 1, 1, 1687400236);

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `name_item` varchar(128) NOT NULL,
  `email_seller` varchar(64) NOT NULL,
  `email_buyer` varchar(64) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_id` varchar(11) NOT NULL,
  `delivery_id` varchar(11) NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `set_uid_item`
--

CREATE TABLE `set_uid_item` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `format_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `new_uid` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `set_uid_item`
--

INSERT INTO `set_uid_item` (`id`, `categories_id`, `format_id`, `time`, `new_uid`) VALUES
(7, 2, 4, 2023, 242023),
(8, 5, 1, 2023, 512023),
(9, 1, 1, 2023, 112023),
(10, 2, 2, 2023, 222023),
(11, 2, 2, 2023, 222023),
(12, 5, 3, 2023, 532023),
(13, 3, 1, 2023, 312023),
(14, 7, 4, 2023, 742023),
(16, 7, 4, 2023, 742023),
(17, 2, 2, 2023, 222023);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `date_transaction` int(11) NOT NULL,
  `item` varchar(128) NOT NULL,
  `seller` varchar(128) NOT NULL,
  `email_seller` varchar(64) NOT NULL,
  `buyer` varchar(128) NOT NULL,
  `email_buyer` varchar(64) NOT NULL,
  `address_buyer` varchar(128) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `shipping` int(1) NOT NULL,
  `date_shipping` int(11) NOT NULL,
  `recipient` int(1) NOT NULL,
  `date_recipient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `shipping`
--

INSERT INTO `shipping` (`id`, `purchase_id`, `date_transaction`, `item`, `seller`, `email_seller`, `buyer`, `email_buyer`, `address_buyer`, `phone_number`, `shipping`, `date_shipping`, `recipient`, `date_recipient`) VALUES
(9, 30, 1686281565, 'Fine 2', 'Kosts Player', 'azka.nuril070@gmail.com', 'Nur4ini', 'fikrifaad@gmail.com', '-', '', 1, 1686281676, 1, 1686281706),
(10, 31, 1686617860, 'Colorfull', 'Kosts Player', 'azka.nuril070@gmail.com', 'Muhammad Azka Nuril Islami', 'playerskost@gmail.com', '-', '', 1, 1686708137, 1, 1686617966),
(11, 32, 1686889953, 'arts', 'Kosts Player', 'playerskost@gmail.com', 'azril', 'fikrifaad@gmail.com', '-', '', 0, 0, 1, 1687005008);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `url` varchar(32) NOT NULL,
  `icon` varchar(64) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `title`, `menu_id`, `url`, `icon`, `is_active`) VALUES
(1, 'Dashboard', 1, 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 'Menu Manajement', 3, 'menu', 'fas fa-fw fa-folder', 1),
(3, 'Submenu Manajement', 3, 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(4, 'My Profile', 2, 'user', 'fas fa-fw fa-user', 1),
(5, 'Office', 1, 'main/contact', 'fas fa-fw fa-city', 1),
(6, 'Edit Profile', 2, 'user/edit_profile', 'fas fa-fw fa-user-edit', 1),
(7, 'Change Password', 2, 'user/change_password', 'fas fa-fw fa-key', 1),
(8, 'Upload', 4, 'fiture/upload', 'fas fa-fw fa-cloud-upload-alt', 1),
(9, 'Role', 1, 'admin/role', 'fas fa-fw fa-users-cog', 1),
(10, 'Categories', 6, 'item/categories', 'fas fa fa-th-large', 1),
(11, 'Format', 6, 'item/format', 'fas fa-fw fa-print', 1),
(12, 'Delivery Method', 6, 'item/delivery', 'fas fa-fw fa-truck-loading', 1),
(13, 'Payment Method', 6, 'item/payment', 'fas fa-fw fa-wallet', 1),
(14, 'Member', 1, 'admin/member', 'fas fa-fw fa-id-card', 1),
(15, 'Gallery', 4, 'fiture/gallery', 'fas fa-fw fa-icons', 1),
(16, 'History', 5, 'transaction/history', 'fas fa-fw fa-history', 1),
(18, 'Item UID', 6, 'item', 'fab fa-fw fa-codepen', 1),
(19, 'Storage', 5, 'transaction/store', 'fas fa-fw fa-store', 1),
(27, 'Shipping', 5, 'transaction/shipping', 'fas fa-fw fa-shipping-fast', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `token`
--

INSERT INTO `token` (`id`, `email`, `token`, `date_created`) VALUES
(4, 'farhan3504@gmail.com', 'XObwhBiXbkzy4cxXkEAYPkBOTYVDFxykY97Cu1rm2Lc=', 1685172568),
(6, 'azka.nuril070@gmail.com', 'hUcDql7+C57KOKByurDmMuIlEb0UPZnp2NMheyzGA2c=', 1685364388),
(7, 'tonyyudik@gmail.com', 'SqkiRXYks+GBoCAdy8m1phb0pFTXhjem0gStPr2PqCY=', 1685735241),
(8, 'maaf@gmail.com', 'cMNeI8+QVux4EoetdL2FKdsdV1zyjhKl7ykQqpekk4Q=', 1685931440),
(12, 'idk@gmail.com', 'YpHkF/OIKVZxsapk5t/MMMC7w97bbpUhljnIx+CJdio=', 1686611169),
(13, 'maaf123@gmail.com', '/pXq3GPAYBVJLHj4lPUgqaaWW0GbCwhp1cd8YpawaLw=', 1686611229),
(14, 'maaf1@gmail.com', 'gAuliszGfboFurw0NW4Y/u1gxaGDbQLIoDd2L+1k1HQ=', 1686611298),
(15, 'maaf2@gmail.com', '4r505N6L2xVrVpxr5+OOt+TKZOoM7KkOSmWHfyRyXkc=', 1686611669),
(16, 'maaf3@gmail.com', 'tuwtf/ysm2m9ktk7HSj1tRi2C0v0JnCf/1RSO7Nz7ZE=', 1686611878),
(17, 'maa4f@gmail.com', 'e7T3fkkevl65wuOteOSN/+Lrp8E7eWLsDG2f0rwHP+k=', 1686612020),
(18, 'idk1@gmail.com', 'NlQ/CxYreJfcukCr02j4VpHJLkB0KzXuIPj1BZoxJiE=', 1686613405),
(19, 'tonyyudik1@gmail.com', 'x1w86imxRx1Erdhh4EZokWC+otgwYpiOR81Wrg2h+9A=', 1686613775),
(20, 'azka.nuril0701@gmail.com', 'c5IvZM6tMY5Yv6LBlyG8t+HYsiHIXyVjvQgnZwZ+7os=', 1686614061),
(21, '1maaf@gmail.com', 'BUKiShyQQA8uN9DY/3kTOpfbyVaFV6wpDe09pGzRyaY=', 1686614234),
(22, '1tonyyudik@gmail.com', 'lHpMC1SWnu25n8OGXmR7D5RNwtHmJw9LbslTOuqx74U=', 1686614332),
(23, 'fikrifaad1@gmail.com', 'W3NasBkSyzC5xc94LPn0IDG8EmZxb3wVtKmc/cX+4Ls=', 1686614520),
(24, 'maaf6@gmail.com', 'CW96sOq7A3edRCJ0H5TD3uQs3YwI6Y26tvynY72Rbq4=', 1686614732),
(25, 'azka.nuril0710@gmail.com', 'PaHp+QinCMO4+/DDnYAb+TzzawLsdUsd+UKOFqULjgU=', 1686614904),
(26, 'tony1yudik@gmail.com', 'iDQq9qC/W+QJm+j5G7GvtaJrFqV2LzM/N1bobhPqf5U=', 1686615068),
(27, 'fuck@gmail.com', 'yKJlkZK9LjDHWkTWqVuh9hMJyufR9PxYC+/EOC3yO+o=', 1686615255),
(28, 'me@gmail.com', 'qBdF27Lig9hyhNtiH1QjKtFQTuUUzjEzv6tBpbqZpLk=', 1686615285),
(29, 'azka.nuril1070@gmail.com', 'Y4iTjIFrscJ0H8yr7iqPJBHWh6oMVQ+NY579LJnnCgE=', 1686615706),
(34, 'playerskost@gmail.com', 'YUb98SvrAf7WKhZdKPoJSC5G23N52OLnfXj2hNVG25w=', 1686890137);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `address`, `phone_number`, `image`, `password`, `role_id`, `is_active`, `date_create`) VALUES
(5, 'Kosts Player', 'azka.nuril070@gmail.com', 'Bandung Lautan Api Jauh Di Sana Sekali Banget', '082334100715', 'forMyLove.png', '$2y$10$RmnnGAe02i8ceKiHUXTmqeE9Nrt1b0QfWT4IK.F4wHqmqAEqCa3U.', 1, 1, 1685144881),
(6, 'Ichika', 'farhan3504@gmail.com', '', '', 'default.jpg', '$2y$10$hY50jSlRqaCqddCa1w/xxOnp/W6l8L2OreDmfoqttL3d4DSYwfR0q', 2, 0, 1685172568),
(11, 'Just Try', 'maaf@gmail.com', '', '', 'default.jpg', '$2y$10$orVo6T17nMqqzTPUG18ptOoeM3I/gEpsNbI76vL7tjB0Uld8em3Xm', 2, 1, 1685931440),
(14, 'Nur4ini', 'fikrifaad@gmail.com', '', '', 'wordcloud.png', '$2y$10$RVXKwyi8HfbPUdnJ9XOlcOlyhX8V/VRp/m5zAH.UuJkg5gCYZoPV.', 2, 1, 1686280477),
(15, 'me', 'idk@gmail.com', '', '', 'default.jpg', '$2y$10$Los4uRt4NuVxDdKXXTzN9eqh96JhrvkLttTzcyk/yK5.ppTDe7hw2', 2, 0, 1686611169),
(36, 'Kosts Player', 'playerskost@gmail.com', 'Bukan, di sana ajah', '082334100715', 'default.jpg', '$2y$10$4WjYHxW.bU5R7VuBRlTsO.Atk3jH1xFf06Nbv2z5RO.XJKQQDn27e', 2, 1, 1686617642);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `access_menu`
--
ALTER TABLE `access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `delivery_method`
--
ALTER TABLE `delivery_method`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `format`
--
ALTER TABLE `format`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `main_contact`
--
ALTER TABLE `main_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `set_uid_item`
--
ALTER TABLE `set_uid_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `access_menu`
--
ALTER TABLE `access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `delivery_method`
--
ALTER TABLE `delivery_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `format`
--
ALTER TABLE `format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `main_contact`
--
ALTER TABLE `main_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `set_uid_item`
--
ALTER TABLE `set_uid_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
