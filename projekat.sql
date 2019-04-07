-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2019 at 08:00 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(4) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `brand` varchar(50) CHARACTER SET utf8 NOT NULL,
  `year` int(4) NOT NULL,
  `price` int(7) NOT NULL,
  `type` enum('Klasicna','Elektricna','Bas','Pojacalo') NOT NULL,
  `size` int(4) NOT NULL,
  `dscount` int(3) DEFAULT NULL,
  `rating` enum('1','2','3','4','5') DEFAULT NULL,
  `descr` text CHARACTER SET utf8 NOT NULL,
  `imgurl` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `brand`, `year`, `price`, `type`, `size`, `dscount`, `rating`, `descr`, `imgurl`) VALUES
(1, 'Yamaha C40', 'Yamaha', 1986, 122, 'Klasicna', 1, NULL, NULL, 'The C40 shows in spectacular fashion that a tight budget doesn\'t have to be synonymous with settling for a second-choice guitar. The meranti (similar to mahogany) bottom and sides and the real rosewood fretboard and bridge are characteristics that not only lend the C40 a great sound, but also ensure an excellent playability and response. The precise chrome-plated machine heads guarantee consistently good tuning.', '1.jpg'),
(2, 'Alvarez CC7 Cadiz Concert Classical Guitar Natural\r\n', 'Alvarez', 1975, 399, 'Klasicna', 1, NULL, NULL, 'Alvarez\'s CC7 Cádiz Concert Classical acoustic guitar is a beautiful classical model made from Sitka and walnut with a flawless gloss finish and acacia binding. Besides giving you the chance to own and perfect your nylon string playing in a guitar inspired by real Spanish tradition, but it comes in at an exceptionally affordable price point.\r\n\r\nCádiz Series\r\nCádiz offers responsive and engaging nylon string guitars of solid quality and excellent playability. Everything about them is considered and chosen. They are a new shape, different from classical guitars Alvarez has made in the past, slightly taller, slightly narrower, more elegant.\r\n\r\nIn order to make the guitars as responsive as possible, Alvarez kept them as light as possible in construction while staying true to traditional design. So in the standard models there are no trussrods. The necks are three-piece and a solid ebony center rod gives them the strength and lightness needed.', '2.jpg'),
(3, 'Master series HM65-Z', 'Hofner', 1982, 1090, 'Klasicna', 1, NULL, NULL, 'These master built classical guitars feature the build quality and craftsmanship of the Hofner master series at an unbeatable price. Handmade by our Master Luthiers in Germany. The solid mahogany body with a spruce top (F) gives a clear, even balanced tone. The cedar top (Z) gives percussive mid range, coupled with an explosive projection. These oustanding instruments feature a satin finish to aid response.\r\n\r\nThe HM65-Z has a solid cedar top for brighter tones and excellent projection. It is an excellent instrument for entry to the Hofner Master series of guitars.', NULL),
(4, 'CLASSIC PLAYER JAGUAR® SPECIAL', 'Fender', 1985, 2599, 'Elektricna', 1, NULL, NULL, 'For the modern guitarist who wants classic Jaguar sound and style, the Classic Player Jaguar Special updates the timeless instrument with several thoroughly modern appointments. With great Classic Player sound and style, these include hotter pickups, a tone cut switch, an Adjusto-Matic™ bridge, a neck pocket with increased back-angle for improved stability and sustain, and more.\r\n\r\n', '4.jpg'),
(5, 'Firebird Tribute 2019', 'Gibson', 1980, 1300, 'Elektricna', 1, NULL, NULL, 'Retaining the original \'Reverse\' body and headstock the 2019 Gibson Firebird Tribute oozes vintage styling. Mahogany, slim taper set-neck with an unbound rosewood fingerboard is coupled with a mahogany body which guarantees classic Gibson sustain while the Firebird mini-humbuckers provide the tone. Chrome hardware, Grover mini-tuners and satin cherry finish complete this affordable package.', '5.jpg'),
(6, 'A Gig-Ready Classic', 'PRS', 1980, 800, 'Elektricna', 1, NULL, NULL, 'Perfect as a first guitar or the last guitar you’ll ever need, the PRS SE 245 Standard has a classic voice that is eminently recordable and gig-ready, thanks to its 245 “S” pickups and versatile control layout. Classic PRS appointments include a set Wide Fat mahogany neck, rosewood fretboard with bird inlays, PRS-Designed stoptail bridge and tuners. The 24.5” scale length makes this instrument instantly comfortable to players who prefer short-scale guitars. The all-mahogany body is reminiscent of Paul\'s first pre-factory instruments and offers a warm, woody tone.\r\n\r\n', '6.jpg'),
(7, 'AMERICAN PERFORMER PRECISION BASS®', 'Fender', 1980, 850, 'Bas', 1, NULL, NULL, 'Born in Corona, California, the American Performer Precision Bass delivers the exceptional tone and feel you expect from an authentic Fender—along with new, player-oriented features that make it even more inspiring to play.\r\n\r\n\r\n', '7.jpg'),
(8, 'SRF700', 'Ibanez', 1992, 999, 'Bas', 1, NULL, NULL, 'For 30 years the SR has given bass players a modern alternative. With its continued popularity, Ibanez is constantly endeavoring to answer the wider needs of a variety of players, at a variety of budgets. But no matter what the specs, the heart is the same-SR continues to excite with its smooth, fast neck, lightweight body, and perfectly matched electronics.', NULL),
(9, 'Model 330 ', 'Rickenbacker', 1983, 2550, 'Bas', 1, NULL, NULL, 'Careful acoustic research has resulted in the full, rich and warm sound of this popular model. Two single coil pickups on a full size body are accented by a traditionally shaped sound hole. The 24 fret Rosewood fingerboard is punctuated by dot inlay fret markers, with full double cutaways permitting access to all the frets. Standard output is monaural through a single jack plate. Also available with an additional pickup (Model 340) and as twelve string versions with either 2 or 3 pickups (Model 330/12 and Model 340/12 respectively).', '9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `items` text NOT NULL,
  `totalPrice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korpa`
--

INSERT INTO `korpa` (`id`, `user_id`, `items`, `totalPrice`) VALUES
(1, 16, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(3) NOT NULL,
  `msg_title` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `name` varchar(70) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(3) DEFAULT NULL,
  `isNotRead` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `address` varchar(60) NOT NULL,
  `name` varchar(80) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `cost` int(11) NOT NULL,
  `city` varchar(30) NOT NULL,
  `items` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` enum('admin','worker','user') NOT NULL DEFAULT 'user',
  `discount` int(3) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `password`, `email`, `status`, `discount`, `address`, `avatar`, `regDate`) VALUES
(16, 'Luka', '', 'laki', '$2y$10$V24EeU8K2Rkl1REh52mlUuG09cQfHnlfzpEOSkikozB1dUc9nrChi', 'lakslak@gmail.com', 'admin', NULL, NULL, NULL, '2019-04-01 23:50:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
