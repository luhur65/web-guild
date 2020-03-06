-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Mar 2020 pada 05.17
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guild`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `access_menu`
--

CREATE TABLE `access_menu` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `access_menu`
--

INSERT INTO `access_menu` (`id`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(7, 1, 4),
(8, 3, 2),
(9, 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `id_report` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_read` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `feedback`, `id_report`, `user_id`, `is_read`) VALUES
(4, 'Terima Kasih Telah Melaporkan Kepada Kami , Kami Akan Menindaklanjuti Masalah Ini Dan Akan Memberikan Sanksi Pelanggaran Jika Benar User-Profile Yg Anda Lapor Menyerbarkan Konten Hoax . &#039; Salam Admin&#039;', 4, 2, 1),
(5, 'Admin we Proud of You Because You Send us About his Konten , We will handle it Now , Thank You for you report', 5, 1, 0),
(6, 'We Temporaly have view this ', 1, 1, 0),
(7, 'Terima Kasih , Kami Akan Menindaklanjuti Laporan Anda', 1, 1, 0),
(8, 'Terima Kasih Sudah Mereport akun ini , bila ternyata akun ini memang bersalah kami akan meblokir akun ini sementara waktu !!!', 2, 2, 0),
(9, 'Terima Kasih Atas Laporan Anda , Kami Akan Selalu Membuat Anda Nyaman Berada Disini !!!', 1, 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guild_center`
--

CREATE TABLE `guild_center` (
  `id_guild` int(11) NOT NULL,
  `guild_name` varchar(250) NOT NULL,
  `guild_server` int(11) NOT NULL,
  `guild_info` text NOT NULL,
  `guild_aktif` int(1) NOT NULL,
  `guild_img` varchar(250) NOT NULL,
  `guild_post` varchar(200) NOT NULL,
  `creator` int(11) NOT NULL,
  `guild_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guild_center`
--

INSERT INTO `guild_center` (`id_guild`, `guild_name`, `guild_server`, `guild_info`, `guild_aktif`, `guild_img`, `guild_post`, `creator`, `guild_pass`) VALUES
(1, 'Strawberries', 1292, 'Strawberries are such a tasty snack, especially with a little sugar on top!', 0, '3.jpg', 'Public', 1, ''),
(2, 'Ice Cream', 1286, 'A dark blue background with a colored pencil, a clip, and a tiny ice cream cone!', 1, '2.jpg', 'Public', 1, ''),
(3, 'WorkSpace', 1829, 'Work Paper , By Developer\r\n', 1, '4.jpg', 'Public', 1, ''),
(4, 'Stationnary', 1290, 'A yellow pencil with envelopes on a clean, blue backdrop!', 1, '1.jpg', 'Public', 1, ''),
(97, 'Skidipappap Indonesia', 0, '18+ Keatass ya , Bocil Dilarang Keras Masuk . Khusus Orang Dewasa', 1, '5e4908b9dcdc8.jpg', 'Private', 2, 'MTIz'),
(98, 'Gamers Indonesia', 0, 'We Respect Each Other , Play As A Team ', 1, '5e4909821279e.png', 'Public', 4, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guild_chat`
--

CREATE TABLE `guild_chat` (
  `id_invite` int(11) NOT NULL,
  `pengirim` int(11) NOT NULL,
  `pesan_invite` text NOT NULL,
  `to_user` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `guild_id` int(11) NOT NULL,
  `accept` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guild_chat`
--

INSERT INTO `guild_chat` (`id_invite`, `pengirim`, `pesan_invite`, `to_user`, `date`, `guild_id`, `accept`) VALUES
(11, 2, 'IEhhaSAsIFdobyBhbSBJID8/Pz8/Pz8/Pz8/Pz8/Pz8gIFNheWEgTWVuZ3VuZGFuZyBtdSBVbnR1ayBCZXJnYWJ1bmcgRGVuZ2FuIEd1aWxkIFNheWEgU2tpZGlwYXBwYXAgSW5kb25lc2lhICwgU2F5YSBUdW5nZ3UgS2FtdSBEaSBndWlsZCBTYXlhIFlhICEh', 4, '2010-12-19 19:00:45', 97, 1),
(12, 3, 'IEhhaSAsIFdobyBhbSBJID8/Pz8/Pz8/Pz8/Pz8/Pz8gIFNheWEgTWVuZ3VuZGFuZyBtdSBVbnR1ayBCZXJnYWJ1bmcgRGVuZ2FuIEd1aWxkIFNheWEgU3RyYXdiZXJyaWVzICwgU2F5YSBUdW5nZ3UgS2FtdSBEaSBndWlsZCBTYXlhIFlhICEh', 4, '2010-12-19 18:36:39', 1, 1),
(13, 4, 'IEhhaSAsIFZpa2EgU2l0dW1vcmFuZyAgU2F5YSBNZW5ndW5kYW5nIG11IFVudHVrIEJlcmdhYnVuZyBEZW5nYW4gR3VpbGQgU2F5YSBHYW1lcnMgSW5kb25lc2lhICwgU2F5YSBUdW5nZ3UgS2FtdSBEaSBndWlsZCBTYXlhIFlhICEh', 3, '2010-12-19 19:53:30', 98, 1),
(14, 4, 'IEhhaSAsIFZpa2EgU2l0dW1vcmFuZyAgU2F5YSBNZW5ndW5kYW5nIG11IFVudHVrIEJlcmdhYnVuZyBEZW5nYW4gR3VpbGQgU2F5YSBHYW1lcnMgSW5kb25lc2lhICwgU2F5YSBUdW5nZ3UgS2FtdSBEaSBndWlsZCBTYXlhIFlhICEh', 3, '2010-12-19 22:23:43', 98, 1),
(15, 3, 'IEhhaSAsIEFkbWluIEd1aWxkQ2hhdHRpbmcgIFNheWEgTWVuZ3VuZGFuZyBtdSBVbnR1ayBCZXJnYWJ1bmcgRGVuZ2FuIEd1aWxkIFNheWEgR2FtZXJzIEluZG9uZXNpYSAsIFNheWEgVHVuZ2d1IEthbXUgRGkgZ3VpbGQgU2F5YSBZYSAhIQ==', 1, '2010-12-19 19:56:31', 98, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guild_info_member`
--

CREATE TABLE `guild_info_member` (
  `id_user` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` int(1) NOT NULL,
  `email` varchar(155) NOT NULL,
  `biografi` text NOT NULL,
  `foto_profil` varchar(250) NOT NULL,
  `tgl_join` date NOT NULL,
  `is_aktif` int(1) NOT NULL,
  `guild_id` int(11) NOT NULL,
  `gender` int(1) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guild_info_member`
--

INSERT INTO `guild_info_member` (`id_user`, `full_name`, `username`, `password`, `role`, `email`, `biografi`, `foto_profil`, `tgl_join`, `is_aktif`, `guild_id`, `gender`, `tgl_lahir`) VALUES
(1, '404 Not Found', 'admin', '$2y$10$tEq2O72Ff82klD8DUbyBVeHU43.aMXdg1teC.Im3yAbQ7NNpzfxOe', 1, 'dharmabakti1202@gmail.com', 'Saya Mengucapkan Terima Kasih Kepada Kamu Yg Sudah Bergabung Dari Awal Di GuildRoom .\r\nSekian Pemberitahuan dari saya , atas perhatiannya saya ucapkan terima kasih banyak .\r\nHappy Enjoy All . Salam Admin                                                                                                         ', '4d0e3c9cef854.jpg', '2010-12-19', 1, 0, 1, '2002-01-17'),
(2, 'Kwaza kwaza Osaz ', 'user', '$2y$10$RzUET62z5a3VE0nSx5bu.O7Zt1Cta1so0GFM28iRKYKrDpxi32oF6', 2, 'user@gmail.com', 'Hello , My Name is KwazaKwazaOzaz      ', '4d0e6322de288.png', '2020-01-13', 1, 98, 1, '2001-10-22'),
(3, 'Vika Situmorang', 'vikacu', '$2y$10$bz./ezLEKKXJg/8SpumpQeVPL8WYNCq8iq.4OCtwbl1nEwMfhU3GK', 2, 'vikacu@pokemonlistrik.com', 'Vika Regina Situmorang v2.0.\r\nInstagram : @vika_situmorang.    \r\nhttp://localhost/tugasphp/guild/assets/img/user-icon/4d0e7bcb11e07.jpg          ', '4d0e7bcb11e07.jpg', '2010-12-19', 0, 98, 2, '2012-06-08'),
(4, 'Who am I ?', 'acer', '$2y$10$klHFMcS1EXdqYWp6xsIEsuD6JC7qsOymYmzRF4lkqq.Enot1p.xh.', 2, 'acer@gmail.com', '$%$%$5#$^%*%^&amp;*^&amp;*&amp;T^^SA$%^$Q&amp;WR&amp;Q$W%QRR&amp;RQ%^          ', '5e3e7659bf10b.jpg', '2010-12-19', 1, 98, 1, '2010-12-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guild_post`
--

CREATE TABLE `guild_post` (
  `id_post` int(11) NOT NULL,
  `post` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_guild` int(11) NOT NULL,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guild_post`
--

INSERT INTO `guild_post` (`id_post`, `post`, `user_id`, `id_guild`, `post_date`) VALUES
(1, '[ S O L V E D ]  \n Wkwkwkwk , nih apaan nih\r\n', 4, 98, '2010-12-19 18:18:28'),
(3, 'Hello , Friends !! ', 2, 98, '2010-12-19 22:07:45'),
(4, 'http://localhost/tugasphp/guild/assets/img/guild_img/5e4909821279e.png\r\nHappy Birthday', 3, 98, '2010-12-19 20:21:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guild_role`
--

CREATE TABLE `guild_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guild_role`
--

INSERT INTO `guild_role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `menu`) VALUES
(1, 'Admin Management'),
(2, 'User Management'),
(3, 'Guild Management'),
(4, 'Menu & SubMenu Set');

-- --------------------------------------------------------

--
-- Struktur dari tabel `object_report`
--

CREATE TABLE `object_report` (
  `id_object` int(11) NOT NULL,
  `isi` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `object_report`
--

INSERT INTO `object_report` (`id_object`, `isi`) VALUES
(1, 'User & Profile Reporting'),
(2, 'Konten Reporting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reply_user_chat`
--

CREATE TABLE `reply_user_chat` (
  `id_reply` int(11) NOT NULL,
  `id_chat` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `reply_isi_chat` text NOT NULL,
  `penerima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reply_user_chat`
--

INSERT INTO `reply_user_chat` (`id_reply`, `id_chat`, `to_user`, `reply_isi_chat`, `penerima`) VALUES
(2, 4, 2, 'eWEgb2tl', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `report_guild`
--

CREATE TABLE `report_guild` (
  `id_report_guild` int(11) NOT NULL,
  `guild_report` int(11) NOT NULL,
  `report_teks` text NOT NULL,
  `user_report` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `report_type`
--

CREATE TABLE `report_type` (
  `id_type` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `object_report` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `report_type`
--

INSERT INTO `report_type` (`id_type`, `type`, `object_report`) VALUES
(1, 'Melakukan Kejahatan Cyber', 1),
(2, 'Menghina Orang Lain', 1),
(3, 'Berkata Kotor', 1),
(4, 'Menganggu Saya', 1),
(5, 'Akun Palsu', 1),
(6, 'Konten Palsu ( Hoax )', 2),
(7, 'Konten Bersifat Negatif', 2),
(8, 'Konten Berisi Sindiran', 2),
(9, 'Konten Menghina Agama , Ras , dan Suku ', 2),
(10, 'Konten Berisi Kekerasan , Pembunuhan dan Pelecehan Seksual', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `report_user`
--

CREATE TABLE `report_user` (
  `id_report` int(11) NOT NULL,
  `reported_user` int(11) NOT NULL,
  `detail_report` text NOT NULL,
  `from_user` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `is_receive` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `is_aktif` int(1) NOT NULL,
  `icon` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `menu_id`, `title`, `url`, `is_aktif`, `icon`) VALUES
(1, 2, 'My Profile', 'profile', 1, 'fa fa-user-circle'),
(2, 2, 'Edit Profile', 'editProfile', 1, 'fas fa-user-edit'),
(3, 3, 'List Guild', 'viewGuild', 1, 'fas fa-users'),
(4, 3, 'Create Guild', 'newGuild', 0, 'fas fa-users-cog'),
(5, 1, 'Account Registered', 'registered', 0, 'fas fa-user-check'),
(8, 4, 'Menu Set', 'settingMenu', 1, 'fas fa-cogs'),
(9, 4, 'Submenu Setting', 'settingSubMenu', 1, 'fas fa-cogs'),
(10, 4, 'Role Access Menu', 'access', 1, 'fas fa-user-secret'),
(11, 1, 'User Online', 'viewOnlineUser', 0, 'fas fa-user-shield'),
(12, 2, 'Mail List', 'listMail', 1, 'fas fa-envelope'),
(13, 1, 'List Report User', 'viewListReport', 1, 'fas fa-list-ul  '),
(14, 1, 'List Reporting Guild', 'guildCase', 1, 'fas fa-users'),
(15, 1, 'log activity', 'viewAllLog', 1, 'fas fa-list');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_chat`
--

CREATE TABLE `user_chat` (
  `no_chat` int(11) NOT NULL,
  `dari_user` int(11) NOT NULL,
  `isi_chat` text NOT NULL,
  `to_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_chat`
--

INSERT INTO `user_chat` (`no_chat`, `dari_user`, `isi_chat`, `to_user`) VALUES
(4, 2, 'R2FrIGFkYSBhcGEgYXBhIEtvayAsIGY4ZjhmOGY4', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `access_menu`
--
ALTER TABLE `access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Indeks untuk tabel `guild_center`
--
ALTER TABLE `guild_center`
  ADD PRIMARY KEY (`id_guild`);

--
-- Indeks untuk tabel `guild_chat`
--
ALTER TABLE `guild_chat`
  ADD PRIMARY KEY (`id_invite`);

--
-- Indeks untuk tabel `guild_info_member`
--
ALTER TABLE `guild_info_member`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `guild_post`
--
ALTER TABLE `guild_post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indeks untuk tabel `guild_role`
--
ALTER TABLE `guild_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `object_report`
--
ALTER TABLE `object_report`
  ADD PRIMARY KEY (`id_object`);

--
-- Indeks untuk tabel `reply_user_chat`
--
ALTER TABLE `reply_user_chat`
  ADD PRIMARY KEY (`id_reply`);

--
-- Indeks untuk tabel `report_guild`
--
ALTER TABLE `report_guild`
  ADD PRIMARY KEY (`id_report_guild`);

--
-- Indeks untuk tabel `report_type`
--
ALTER TABLE `report_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indeks untuk tabel `report_user`
--
ALTER TABLE `report_user`
  ADD PRIMARY KEY (`id_report`);

--
-- Indeks untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_chat`
--
ALTER TABLE `user_chat`
  ADD PRIMARY KEY (`no_chat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `access_menu`
--
ALTER TABLE `access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `guild_center`
--
ALTER TABLE `guild_center`
  MODIFY `id_guild` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `guild_chat`
--
ALTER TABLE `guild_chat`
  MODIFY `id_invite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `guild_info_member`
--
ALTER TABLE `guild_info_member`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `guild_post`
--
ALTER TABLE `guild_post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `guild_role`
--
ALTER TABLE `guild_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `object_report`
--
ALTER TABLE `object_report`
  MODIFY `id_object` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `reply_user_chat`
--
ALTER TABLE `reply_user_chat`
  MODIFY `id_reply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `report_guild`
--
ALTER TABLE `report_guild`
  MODIFY `id_report_guild` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `report_type`
--
ALTER TABLE `report_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `report_user`
--
ALTER TABLE `report_user`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `no_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
