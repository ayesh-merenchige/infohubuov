-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 08:50 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uovinfohubdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `pageadmin`
--

CREATE TABLE `pageadmin` (
  `pageID` varchar(255) NOT NULL,
  `pageName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pageadmin`
--

INSERT INTO `pageadmin` (`pageID`, `pageName`, `password`) VALUES
('p001', 'Faculty of Applied Science', '1111'),
('p002', 'Department of Physical Science', '1111'),
('p003', 'Department of Bio Science', '1111'),
('p004', 'IEEE', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postID` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `image` varchar(255) NOT NULL,
  `pageID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postID`, `description`, `date`, `time`, `image`, `pageID`) VALUES
('6576bbd7c9c12', 'test post', '2023-12-11', '08:35:51', '', 'p002'),
('6591acbc1ae79', 'test post from IEEE', '2023-12-31', '19:02:36', '6591acbc1ae79_1694984952137.gif', 'p004'),
('post002', 'this is post #2', '2023-11-06', '01:17:49', 'post002img.jpg', 'p002'),
('post003', 'this is post #3', '2023-11-06', '01:17:50', 'post003img.jpg', 'p003'),
('post005', 'this is post #5', '2023-11-06', '01:17:55', '', 'p002');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `enrolmentNum` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subList` varchar(255) NOT NULL,
  `emailNotofo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`enrolmentNum`, `password`, `email`, `subList`, `emailNotofo`) VALUES
('1', '$2y$10$ptVSIQqBc3SRWJYrCLUj2eM6gMCPlDqNWRndDwpndKuzh4LWPbehy', '1@mail.com', 'p003,p004', 0),
('2', '$2y$10$01OCorKkcjmAIlupFPmAkOeXzl14JjqFylLUKucwebXMNkwqTNSNO', '2@mail.com', 'p001,p003', 0),
('4', '4444', '4@gmail.com', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pageadmin`
--
ALTER TABLE `pageadmin`
  ADD PRIMARY KEY (`pageID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `post_ibfk_1` (`pageID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`enrolmentNum`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`pageID`) REFERENCES `pageadmin` (`pageID`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`pageID`) REFERENCES `pageadmin` (`pageID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
