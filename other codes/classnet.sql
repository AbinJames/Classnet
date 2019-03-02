-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2017 at 03:03 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `eventname` varchar(50) NOT NULL,
  `eventdate` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `eventname`, `eventdate`, `userid`) VALUES
(1, 'qwerty', '2017-03-02', 0),
(2, 'helooo', '2017-03-09', 14),
(3, '123123123', '2017-03-08', 14),
(4, 'welcome', '2017-03-15', 14),
(5, 'qwaw', '2017-03-10', 14),
(6, 'try', '2017-04-06', 14);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `tid` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `ntitle` text,
  `ncontent` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`tid`, `id`, `ntitle`, `ncontent`) VALUES
(14, 14, 'asad', 'sdasdasdasdasd<div> \n                                                       \n  </div>\n'),
(13, 14, 'ggg', 'ggggg<div> \n                                                       \n  </div>\n'),
(12, 14, 'sa', 'hjgjgj<div> \n                                                       \n  </div>\n'),
(11, 14, 'qw', 'bmb mbnb m<div> \n                                                       \n  </div>\n'),
(10, 14, 'qw', 'asadasdasdasd<div> \n                                                       \n  </div>\n'),
(9, 14, 'a', 'jhhhhh<div> \n                                                       \n  </div>\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `gender` varchar(1) NOT NULL,
  `dobmonth` varchar(20) NOT NULL,
  `dobday` varchar(2) NOT NULL,
  `dobyear` varchar(4) NOT NULL,
  `S_T` varchar(1) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profile` varchar(200) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `gender`, `dobmonth`, `dobday`, `dobyear`, `S_T`, `password`, `profile`, `created_at`, `updated_at`) VALUES
(14, 'abin', 'james', 'james.abin@yahoo.in', '9544104914', 'm', 'March', '14', '1980', 's', '123456789', 'index.png', '2023-03-17', '2023-03-17'),
(15, 'anto', 'bose', 'antobose@cs.ajce.in', '8086171434', 'm', 'June', '20', '1995', 's', '123456', NULL, '2023-03-17', '2023-03-17'),
(16, 'amal', 'jacob', 'amaljacobmathew@cs.ajce.in', '7559034403', 'm', 'Febuary', '10', '1996', 's', '123456', NULL, '2023-03-17', '2023-03-17'),
(17, 'ann', 'alex', 'annmariaalex@cs.ajce.in', '8547902725', 'f', 'May', '1', '1996', 's', '123456', NULL, '2023-03-17', '2023-03-17'),
(18, 'dona', 'saji', 'donasaji@cs.ajce.in', '8606638774', 'f', 'May', '11', '1996', 's', 'qwerty', NULL, '2023-03-17', '2023-03-17'),
(19, 'Abin', 'James', 'abinjames6792@yahoo.in', '9544104914', 'm', 'Febuary', '4', '1996', 's', '123456', NULL, '2030-03-17', '2030-03-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
