-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2020 at 10:49 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `postchan`
--

-- --------------------------------------------------------

--
-- Table structure for table `dis_likes`
--

CREATE TABLE `dis_likes` (
  `IdDL` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdPost` int(11) NOT NULL,
  `isLike` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dis_likes`
--

INSERT INTO `dis_likes` (`IdDL`, `IdUser`, `IdPost`, `isLike`) VALUES
(31, 1, 2, 0),
(37, 1, 16, 0),
(38, 16, 25, 0),
(39, 12, 24, 1),
(40, 12, 23, 1),
(41, 12, 22, 1),
(42, 12, 21, 1),
(43, 12, 20, 1),
(44, 12, 19, 1),
(45, 12, 18, 1),
(46, 12, 17, 1),
(47, 12, 16, 1),
(48, 12, 15, 0),
(49, 12, 14, 1),
(50, 12, 13, 1),
(51, 12, 12, 1),
(52, 12, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `IdFollow` int(11) NOT NULL,
  `Follow` int(11) NOT NULL,
  `FollowedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`IdFollow`, `Follow`, `FollowedBy`) VALUES
(15, 6, 1),
(16, 7, 1),
(17, 8, 1),
(21, 11, 1),
(22, 4, 1),
(23, 3, 1),
(24, 10, 1),
(25, 3, 16),
(26, 1, 16),
(27, 5, 16),
(28, 11, 16),
(29, 12, 16),
(30, 14, 16),
(31, 15, 16),
(32, 3, 12),
(33, 1, 12),
(34, 7, 12),
(36, 15, 12);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `IdPost` int(11) NOT NULL,
  `text` text NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdImg` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `isVisible` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`IdPost`, `text`, `IdUser`, `IdImg`, `date`, `isVisible`) VALUES
(1, 'This is the first of many posts.', 1, 1, '2020-03-18 19:35:11', 1),
(2, 'A second post is in order.', 1, 2, '2020-03-18 19:36:31', 1),
(9, 'aaaaa', 1, 9, '2020-03-19 01:45:19', 0),
(10, 'aaa', 1, 10, '2020-03-25 23:30:57', 0),
(11, 'aaaaa', 1, 11, '2020-03-25 23:35:01', 0),
(12, 'bbbbb', 1, 19, '2020-03-25 23:36:22', 1),
(13, 'Another post from this person', 1, 20, '2020-03-27 16:13:22', 1),
(14, 'I have posted another post :)', 1, 21, '2020-03-27 16:14:04', 1),
(15, 'Here\'s some more of my posting', 1, 22, '2020-03-27 16:14:25', 1),
(16, 'This is a post, yes it is', 1, 23, '2020-03-27 16:14:50', 1),
(17, 'This is a post regarding a british warrior', 12, 24, '2020-03-27 16:22:43', 1),
(18, 'The detective is looking for something, will he find it? It\'s unclear, but he will continue to look until he does.', 12, 25, '2020-03-27 16:23:09', 1),
(19, 'I\'ve made a flag of the Roman Empire, in the regular red color but a slightly more orangy color for the eagle itself.', 12, 26, '2020-03-27 16:24:02', 1),
(20, 'Here\'s another flag of the Roman Empire i\'ve found, it looks more like a standard than a flag.', 12, 27, '2020-03-27 16:24:31', 1),
(21, 'Nothing special, just a smiley face flag :^)', 12, 28, '2020-03-27 16:24:54', 1),
(22, 'And this is just a purple lemon. Not sure why a lemon would be purple, but it is.', 12, 29, '2020-03-27 16:25:27', 1),
(23, 'the joe rogan experience is a good podcast', 12, 30, '2020-03-27 16:25:47', 1),
(24, 'I found a nice picture of a cool looking Roman legionary\'s shield, it\'s shiny.', 12, 31, '2020-03-27 16:26:23', 1),
(25, 'hi im the admin', 16, 32, '2020-03-27 21:25:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `IdImg` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_images`
--

INSERT INTO `post_images` (`IdImg`, `path`, `alt`) VALUES
(1, 'img/p-elmo.png-1584560110.png', 'elmo.png post picture'),
(2, 'img/p-pepecheers.png-1584560191.png', 'pepecheers.png post picture'),
(3, 'img/p-45 blok.jpg-1584560239.jpg', '45 blok.jpg post picture'),
(4, 'img/p-(China)_Chinese_People\'s_Republic_Flag.png-1584580868.png', '(China)_Chinese_People\'s_Republic_Flag.png post picture'),
(5, 'img/p-1f5ff.png-1584580935.png', '1f5ff.png post picture'),
(6, 'img/p-10k fists.jpg-1584580960.jpg', '10k fists.jpg post picture'),
(7, 'img/p-137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg-1584581091.jpg', '137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg post picture'),
(8, 'img/p-1f5ff.png-1584581263.png', '1f5ff.png post picture'),
(9, 'img/p-20-512.png-1584582319.png', '20-512.png post picture'),
(10, 'img/p-(China)_Chinese_People\'s_Republic_Flag.png-1585179055.png', '(China)_Chinese_People\'s_Republic_Flag.png post picture'),
(11, 'img/p-45 blok.jpg-1585179301.jpg', '45 blok.jpg post picture'),
(12, 'img/p-(China)_Chinese_People\'s_Republic_Flag.png-1585179382.png', '(China)_Chinese_People\'s_Republic_Flag.png post picture'),
(13, 'img/p-137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg-1585180861.jpg', '137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg post picture'),
(14, 'img/p-137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg-1585180909.jpg', '137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg post picture'),
(15, 'img/p-137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg-1585181067.jpg', '137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg post picture'),
(16, 'img/p-137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg-1585181223.jpg', '137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg post picture'),
(17, 'img/p-100px-Eastern_roman_empire_flag.png-1585182422.png', '100px-Eastern_roman_empire_flag.png post picture'),
(18, 'img/p-100px-Hun_flag.png-1585184135.png', '100px-Hun_flag.png post picture'),
(19, 'img/p-100px-Eastern_roman_empire_flag.png-1585184159.png', '100px-Eastern_roman_empire_flag.png post picture'),
(20, 'img/p-bolognese.jpg-1585325602.jpg', 'bolognese.jpg post picture'),
(21, 'img/p-pc principal.jpg-1585325643.jpg', 'pc principal.jpg post picture'),
(22, 'img/p-dabeull.png-1585325665.png', 'dabeull.png post picture'),
(23, 'img/p-126882757_134.jpg-1585325689.jpg', '126882757_134.jpg post picture'),
(24, 'img/p-british warrior.jpg-1585326163.jpg', 'british warrior.jpg post picture'),
(25, 'img/p-hmmm.png-1585326189.png', 'hmmm.png post picture'),
(26, 'img/p-cropped flag.png-1585326242.png', 'cropped flag.png post picture'),
(27, 'img/p-137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg-1585326271.jpg', '137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg post picture'),
(28, 'img/p-hehe flag.png-1585326294.png', 'hehe flag.png post picture'),
(29, 'img/p-purple lemon.png-1585326326.png', 'purple lemon.png post picture'),
(30, 'img/p-rogan1.png-1585326346.png', 'rogan1.png post picture'),
(31, 'img/p-roman lion shield.jpg-1585326383.jpg', 'roman lion shield.jpg post picture'),
(32, 'img/p-kazakh.png-1585344345.png', 'kazakh.png post picture');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `IdRole` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`IdRole`, `name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `sent`
--

CREATE TABLE `sent` (
  `IdSent` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `num` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sent`
--

INSERT INTO `sent` (`IdSent`, `name`, `surname`, `num`, `email`, `gender`, `text`) VALUES
(1, 'Mirko', 'Mirkovic', 'mirko@gmail.com', '069 777 7777', 'Male', 'asdfasdfasdfasdf'),
(2, 'Jovan', 'Mirkovic', 'mirko@gmail.com', '069 222 1111', 'Male', 'ovo je jos jedna poruka'),
(3, 'Milena', 'Stefanovic', 'mirko@gmail.com', '062 141 2233', 'Female', 'ovo je poruka za kontakt'),
(4, 'Stefana', 'Hrebljanovic', 'stefana.hre@gmail.com', '062 555 2626', 'Female', 'poruka za kontakt koja je poslata'),
(5, 'Milos', 'Petrovic', 'milpet@gmail.com', '062 464 3391', 'Male', 'ja sam milos i saljem vam poruku'),
(6, 'Dragan', 'Draganovic', 'dragaan@gmail.com', '062 155 121', 'Male', 'ja sam dragan i saljem vam poruku'),
(7, 'Milos', 'Draganovic', 'mildrag@gmail.com', '062 222 121', 'Male', 'ja sam milos i saljem vam poruku'),
(8, 'Jovan', 'Despotovic', 'jovdesp@gmail.com', '062 555 6777', 'Male', 'ja sam jovan i saljem vam poruku'),
(9, 'Marko', 'Markovic', 'markomarko@gmail.com', '062 525 454', 'Male', 'ja sam marko, dobar dan'),
(10, 'Petar', 'Petrovic', 'pet55@gmail.com', '062 332 5333', 'Male', 'ovo je moj post'),
(11, 'Isidora', 'Petrovic', 'isipet@gmail.com', '062 377 3334', 'Female', 'ovo je moj post, mozete li odgovoriti?'),
(12, 'Dragana', 'Jovanovic', 'drajov@gmail.com', '062 666 6788', 'Female', 'dobar dan, ja sam dragana, ovo je moj post'),
(13, 'Uros', 'Milosevic', 'milosevic.uki@gmail.com', '062 131 6600', 'Male', 'uros ovde, jos jedan post'),
(14, 'Lazno', 'Ime', 'laz.njak@gmail.com', '062 111 1111', 'Male', 'ovo je lazni post haha'),
(15, 'Marjan', 'Marjanovic', 'marjan.ovic@gmail.com', '062 556 787', 'Male', 'dobar dan, ja sam marjan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `IdUser` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `IdRole` int(11) NOT NULL,
  `IdImg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`IdUser`, `username`, `email`, `password`, `IdRole`, `IdImg`) VALUES
(1, 'asdf', 'mirko@gmail.com', '4093f08daa965cc74dd367d662f5ee59', 1, 17),
(3, 'asdfa', 'uaaaa@gmail.com', '720baaae86e8adf328731fe7b091781b', 2, 18),
(4, 'aaaaa', 'jovana.mik@yahoo.co', '89faa05de29504c27b7b18a539915507', 2, 19),
(5, 'aaaaaaaa', 'jovana.mikaa@yahoo.co', '89faa05de29504c27b7b18a539915507', 2, NULL),
(6, 'asdf123', 'lorem@ipsum.com', 'eee0f3c319c7bdaf6311559eec5058e1', 2, NULL),
(7, 'uuuaaa', 'uuuaa@gmail.com', 'eee0f3c319c7bdaf6311559eec5058e1', 2, NULL),
(8, 'jovan', 'jovan@gmail.com', '8bfdc4df7279a396ee0745807fc90964', 2, NULL),
(9, 'awe', 'auh@gmail.com', 'f9e988bfc80a172f686295767a953119', 2, NULL),
(10, 'ooo', 'ooo@gmail.com', '19ae8c212f56e67e837d6c7542679714', 2, NULL),
(11, 'ohoho', 'ohoho@gmail.com', 'b0eadf6853e3d3d0b73fabd8c040463d', 2, NULL),
(12, 'bigname', 'bigmail@gmail.com', '281351ff5941896e2ab6c58e14944db1', 2, 9),
(13, 'insertedman', 'inserted@gmail.com', '7f3894d744f79a169f66b0c4df1a234f', 2, NULL),
(14, 'Peperoni', 'peperoni@gmail.com', 'dfeb7e90b642cd6411f2354bf7afdf34', 2, NULL),
(15, 'MrPeep', 'peep123@gmail.com', '1ae435c70806a5993cbd623ee1a0dba5', 2, NULL),
(16, 'Admin', 'admin@gmail.com', '172eee54aa664e9dd0536b063796e54e', 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `IdImg` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`IdImg`, `path`, `alt`) VALUES
(1, 'img/p-100px-Eastern_roman_empire_flag.png-1585182422.png', 'aaaa'),
(2, 'img/u-100px-Hun_flag.png-1585262022.png', '100px-Hun_flag.png user picture'),
(3, 'img/u-100px-Hun_flag.png-1585262075.png', '100px-Hun_flag.png user picture'),
(4, 'img/u-100px-Hun_flag.png-1585262223.png', '100px-Hun_flag.png user picture'),
(5, 'img/u-100px-Hun_flag.png-1585262248.png', '100px-Hun_flag.png user picture'),
(6, 'img/u-100px-Eastern_roman_empire_flag.png-1585262427.png', '100px-Eastern_roman_empire_flag.png user picture'),
(7, 'img/u-100px-Hun_flag.png-1585262640.png', '100px-Hun_flag.png user picture'),
(8, 'img/u-100px-Hun_flag.png-1585262657.png', '100px-Hun_flag.png user picture'),
(9, 'img/u-bird glare.png-1585319770.png', 'bird glare.png user picture'),
(10, 'img/u-200px-Roman_shield.svg.png-1585336591.png', '200px-Roman_shield.svg.png user picture'),
(11, 'img/u-20-512.png-1585336655.png', '20-512.png user picture'),
(12, 'img/u-anime face 1.png-1585336732.png', 'anime face 1.png user picture'),
(13, 'img/u-anime face 3.png-1585336791.png', 'anime face 3.png user picture'),
(14, 'img/u-mastodon2.png-1585336949.png', 'mastodon2.png user picture'),
(15, 'img/u-20-512.png-1585337020.png', '20-512.png user picture'),
(16, 'img/u-20-512.png-1585337050.png', '20-512.png user picture'),
(17, 'img/u-137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg-1585337418.jpg', '137da4a392085a9499cba12700d0bc83--just-a-game-flags.jpg user picture'),
(18, 'img/u-1557768060469.png-1585337483.png', '1557768060469.png user picture'),
(19, 'img/u-1f5ff.png-1585340756.png', '1f5ff.png user picture'),
(20, 'img/u-aaaaaaaaaa.png-1585344280.png', 'aaaaaaaaaa.png user picture');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dis_likes`
--
ALTER TABLE `dis_likes`
  ADD PRIMARY KEY (`IdDL`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`IdFollow`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`IdPost`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`IdImg`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdRole`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `sent`
--
ALTER TABLE `sent`
  ADD PRIMARY KEY (`IdSent`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`IdImg`),
  ADD UNIQUE KEY `path` (`path`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dis_likes`
--
ALTER TABLE `dis_likes`
  MODIFY `IdDL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `IdFollow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `IdPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `IdImg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `IdRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sent`
--
ALTER TABLE `sent`
  MODIFY `IdSent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `IdImg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
