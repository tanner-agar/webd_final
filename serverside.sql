-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 09:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(9) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `time`, `title`, `content`) VALUES
(1, '0000-00-00 00:00:00', 'test', 'aeeresgfsgerg'),
(2, '0000-00-00 00:00:00', 'test2', 'testsetest'),
(3, '0000-00-00 00:00:00', 'testset', 'tesest'),
(4, '0000-00-00 00:00:00', 'tessteest', 'tessetest'),
(5, '0000-00-00 00:00:00', 'tests', 'testes'),
(6, '0000-00-00 00:00:00', 'estestestest', 'estestestset'),
(7, '2024-02-26 23:13:03', 'estestestest', 'estestestset'),
(8, '2024-02-27 06:14:09', '1312312313', '123123123123123123'),
(9, '2024-02-29 04:54:15', 'newposttesting', 'wow its content in ehre'),
(10, '2024-02-29 04:55:31', 'newposttesting', '4wi84ogth409GHJP440J4W8Fj08f4jw0888888888888888888888888888888888888888888888888W8Fj08f4jw0888888888888888888888888888888888888888888888888888W8Fj08f4jw0888888888888888888888888888888888888888888888888888W8Fj08f4jw0888888888888888888888888888888888888888888888888888W8Fj08f4jw0888888888888888888888888888888888888888888888888888888888888888888'),
(11, '2024-03-02 04:02:41', 'testet', 'steest'),
(12, '2024-03-01 21:06:16', 'e1b45325b2345b24b56rwrwe', 'erb2313b2123b123123B!@#############bwer61erwerw'),
(13, '2024-03-01 21:13:06', 'testesetsetestsetde5hruy5u', '12teetet');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
