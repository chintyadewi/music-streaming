-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2018 at 03:50 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_musik`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id_album` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_rilis` date NOT NULL,
  `id_artis` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `id_label` int(11) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `total_lagu` int(11) NOT NULL,
  `flag` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `nama`, `tgl_rilis`, `id_artis`, `id_genre`, `id_label`, `cover`, `total_lagu`, `flag`) VALUES
(1, 'Skyline', '2018-12-21', 6, 1, 8, 'skyline.jpg', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `artis`
--

CREATE TABLE `artis` (
  `id_artis` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `total_lagu` int(11) NOT NULL,
  `total_album` int(11) NOT NULL,
  `info` varchar(500) NOT NULL,
  `flag` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artis`
--

INSERT INTO `artis` (`id_artis`, `nama`, `foto`, `total_lagu`, `total_album`, `info`, `flag`) VALUES
(1, 'Nurko', 'nurko.jpg', 1, 0, 'Electronic Music Producer, DJ and Mix Engineer', '1'),
(2, 'DLMT', 'dlmt.jpg', 7, 0, 'From Toronto, DLMT is a 24 year old-old music producer and DJ; bringing a unique groovy and emotional sound, striving to push the genre in a new direction.', '1'),
(3, 'KSHMR', 'kshmr.jpg', 1, 0, 'Niles Hollowell-Dhar, known by his stage name KSHMR, produces big room electro-house that is heavily influenced by his Indian heritage.', '1'),
(4, 'ItaloBrothers', 'italobrothers.png', 1, 0, 'ItaloBrothers is a German dance project from Nordhorn, Germany. The band consists of vocalist Matthias Metten, who works in the studio with Zacharias Adrian (also known as Zac McCrack) and Christian MÃ¼ller (also known as Kristian Sandberg).', '1'),
(5, 'Sam Feldt', 'sam feldt.jpg', 3, 0, 'Sammy Renders (born 1 August 1993), better known by his stage name Sam Feldt, is a Dutch DJ, deep house producer and entrepreneur from Boxtel. He currently resides in Amsterdam.', '1'),
(6, 'Lucas & Steve', 'lucas & steve.jpg', 2, 1, 'Lucas & Steve is a Dutch DJ duo formed by house DJs Lucas de Wert and Steven Jansen from Maastricht.', '1'),
(7, 'Shallou', 'shallou.jpg', 1, 0, 'Joe Boston, professionally known as stage name Shallou, is a Los Angeles based producer, singer, and environmentalist, who produces ambient, house melodies and soulful vocals that have carved a niche in the Electronic and Indie scenes', '1'),
(8, 'Jonas Aden', 'jonas aden.jpg', 2, 0, 'Dance / electronic music dj from Norwegia', '1');

-- --------------------------------------------------------

--
-- Table structure for table `detail_playlist`
--

CREATE TABLE `detail_playlist` (
  `id_detail` int(11) NOT NULL,
  `id_playlist` int(11) NOT NULL,
  `id_lagu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_playlist`
--

INSERT INTO `detail_playlist` (`id_detail`, `id_playlist`, `id_lagu`) VALUES
(2, 1, 16),
(3, 1, 15),
(4, 2, 17);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `flag` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id_genre`, `nama`, `gambar`, `flag`) VALUES
(1, 'Electronic Dance Music', 'edm.png', '1'),
(2, 'Pop', 'pop.jpg', '1'),
(3, 'RnB Soul', 'rnbsoul.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

CREATE TABLE `label` (
  `id_label` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `flag` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`id_label`, `nama`, `id_user`, `flag`) VALUES
(6, 'Strange Fruit Music', 2, '1'),
(7, 'Lowly Palace', 3, '1'),
(8, 'Spinnin Records', 4, '1'),
(9, 'Dharma', 5, '1'),
(10, 'Future House Music', 6, '1'),
(11, 'AFTR:HRS', 7, '1');

-- --------------------------------------------------------

--
-- Table structure for table `lagu`
--

CREATE TABLE `lagu` (
  `id_lagu` int(11) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `file` varchar(100) NOT NULL,
  `durasi` float NOT NULL,
  `id_genre` int(11) NOT NULL,
  `tgl_rilis` date NOT NULL,
  `id_album` int(11) DEFAULT '0',
  `id_artis` int(11) NOT NULL,
  `id_label` int(11) NOT NULL,
  `cover` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lagu`
--

INSERT INTO `lagu` (`id_lagu`, `judul`, `file`, `durasi`, `id_genre`, `tgl_rilis`, `id_album`, `id_artis`, `id_label`, `cover`) VALUES
(4, 'The Light', 'The Light - DLMT & Vanrip ft. Deverano.mp3', 3, 1, '2018-12-20', NULL, 2, 10, 'the light.jpg'),
(5, 'Always Feels Like', 'Always Feels Like - Dave Winnel & DLMT.mp3', 2.9, 1, '2018-12-20', NULL, 2, 10, 'always feel like.png'),
(6, 'How Does It Feel', 'How Does It Feel - DLMT & Ellis ft. AWR.mp3', 3.6, 1, '2018-12-20', NULL, 2, 10, 'how does it feel.jpg'),
(7, 'Lets Chat', 'Lets Chat - Paris & Simo & DLMT ft. Pony.mp3', 3.3, 1, '2018-12-20', NULL, 2, 11, 'lets chat.jpg'),
(8, 'Carry Me Home', 'Carry Me Home - KSHMR ft. Jake Reese.mp3', 3.2, 1, '2018-12-20', NULL, 3, 9, 'carry me home.jpg'),
(9, 'Till You Drop', 'Till You Drop - ItaloBrothers.mp3', 3.8, 1, '2018-12-20', NULL, 4, 11, 'till you drop.jpg'),
(10, 'Safe', 'Safe - Nurko & Zack Gray.mp3', 3.7, 1, '2018-12-21', NULL, 1, 7, 'safe.jpg'),
(11, 'Count On', 'Count On - Shallou & Colin.mp3', 3.5, 1, '2018-12-21', NULL, 7, 7, 'count on.jpg'),
(12, 'Strangers Do', 'Strangers Do - Jonas Aden.mp3', 2.6, 1, '2018-12-21', NULL, 8, 11, 'strangers do.jpeg'),
(13, 'Where Have You Gone (Anywhere)', 'Where Have You Gone (Anywhere) - Lucas & Steve.mp3', 2.6, 1, '2018-12-21', 1, 6, 8, 'where have you gone.jpg'),
(14, 'Home', 'Home - Lucas & Steve.mp3', 3.1, 1, '2018-12-21', NULL, 6, 8, 'home.jpg'),
(15, 'Down For Anything', 'Down For Anything - Sam Feldt & MÃ–WE ft. KARRA.mp3', 2.6, 1, '2018-12-21', NULL, 5, 8, 'down for anything.jpg'),
(16, 'Heaven (Dont Have A Name)', 'Heaven (Dont Have A Name) - Sam Feldt ft. Jeremy Renner.mp3', 3, 1, '2018-12-21', NULL, 5, 8, 'heaven.jpeg'),
(17, 'Just To Feel Alive', 'Just To Feel Alive - Sam Feldt ft. JRM (Remix).mp3', 3.2, 1, '2018-12-21', NULL, 5, 8, 'just to feel alive.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id_playlist` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id_playlist`, `id_user`, `nama`, `tgl_buat`) VALUES
(1, 1, 'Tropical House', '2018-12-20'),
(2, 9, 'new', '2018-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id_subscribe` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_artis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `level` enum('user','label','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `foto`, `level`) VALUES
(1, 'chintyadewi', 'cbc64d3ebd5d04a08df78bc390b3530a', 'Chintya Puspa Dewi', 'chintyadewi437@gmail.com', 'default.jpg', 'admin'),
(2, 'strangefruit', '0615915af01f994a7b21433cddcb1fd1', 'Strange Fruit Music', 'strange@gmail.com', 'strange.jpg', 'label'),
(3, 'lowly', 'e805907102a668436f1276d2298c171f', 'Lowly Palace', 'lowly@gmail.com', 'lowly.jpg', 'label'),
(4, 'spinnin', '874cfedfe2f9a8307bd7e36644019deb', 'Spinnin Records', 'spinnin@gmail.com', 'spinnin.jpg', 'label'),
(5, 'dharma', '78947661afee90b0f2d7d300484e8712', 'Dharma', 'dharma@gmail.com', 'dharma.jpg', 'label'),
(6, 'futurehouse', 'd98c3df2b15ef8de9b05fb56dd0e5fd6', 'Future House Music', 'futurehouse@gmail.com', 'future house.jpg', 'label'),
(7, 'aftrhrs', '85115844ff13b66dbdeec8314ffa8e18', 'AFTR:HRS', 'aftrhrs@gmail.com', 'aftrhrs.jpg', 'label'),
(8, 'putri', '4093fed663717c843bea100d17fb67c8', 'Putri', 'putri@gmail.com', 'default.jpg', 'user'),
(9, 'chintya', 'cbc64d3ebd5d04a08df78bc390b3530a', 'Chintya', 'chintya@gmail.com', 'default.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`),
  ADD KEY `id_label` (`id_label`),
  ADD KEY `id_genre` (`id_genre`),
  ADD KEY `id_artis` (`id_artis`);

--
-- Indexes for table `artis`
--
ALTER TABLE `artis`
  ADD PRIMARY KEY (`id_artis`);

--
-- Indexes for table `detail_playlist`
--
ALTER TABLE `detail_playlist`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_playlist` (`id_playlist`),
  ADD KEY `id_lagu` (`id_lagu`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`id_label`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `lagu`
--
ALTER TABLE `lagu`
  ADD PRIMARY KEY (`id_lagu`),
  ADD KEY `id_genre` (`id_genre`),
  ADD KEY `id_album` (`id_album`),
  ADD KEY `id_artis` (`id_artis`),
  ADD KEY `id_label` (`id_label`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id_playlist`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id_subscribe`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_artis` (`id_artis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artis`
--
ALTER TABLE `artis`
  MODIFY `id_artis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_playlist`
--
ALTER TABLE `detail_playlist`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `label`
--
ALTER TABLE `label`
  MODIFY `id_label` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lagu`
--
ALTER TABLE `lagu`
  MODIFY `id_lagu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id_playlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id_subscribe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `fk_artis` FOREIGN KEY (`id_artis`) REFERENCES `artis` (`id_artis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_label` FOREIGN KEY (`id_label`) REFERENCES `label` (`id_label`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_playlist`
--
ALTER TABLE `detail_playlist`
  ADD CONSTRAINT `detail_playlist` FOREIGN KEY (`id_lagu`) REFERENCES `lagu` (`id_lagu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_playlist` FOREIGN KEY (`id_playlist`) REFERENCES `playlist` (`id_playlist`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `label`
--
ALTER TABLE `label`
  ADD CONSTRAINT `label_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lagu`
--
ALTER TABLE `lagu`
  ADD CONSTRAINT `lagu_ibfk_1` FOREIGN KEY (`id_album`) REFERENCES `album` (`id_album`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lagu_ibfk_2` FOREIGN KEY (`id_artis`) REFERENCES `artis` (`id_artis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lagu_ibfk_3` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lagu_ibfk_4` FOREIGN KEY (`id_label`) REFERENCES `label` (`id_label`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`id_artis`) REFERENCES `artis` (`id_artis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
