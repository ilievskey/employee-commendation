-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 12:56 PM
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
-- Database: `employee_commendation`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Makes Work Fun'),
(2, 'Team Player'),
(3, 'Culture Champion'),
(4, 'Difference Maker');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `mwf` int(11) DEFAULT 0,
  `tp` int(11) DEFAULT 0,
  `cc` int(11) DEFAULT 0,
  `dm` int(11) DEFAULT 0,
  `votes_given` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `pass`, `mwf`, `tp`, `cc`, `dm`, `votes_given`) VALUES
(1, 'Tom Clancy', 'tom@company.com', '$2y$10$DmayQsub7VGr9nYKrYlqXuFfcXPggP.xIIKqFB.dkFn9OGShR3NxG', 0, 2, 0, 0, 2),
(2, 'Alice Sunderland', 'alice@company.com', '$2y$10$/ZOhHof/Xym4bg3kAzw9fOvf8orRwyoZICL1uAFU1KBVAo0HaDwBK', 0, 1, 0, 1, 1),
(3, 'John Smith', 'john@company.com', '$2y$10$DO6NQ6.qi83aD2fNR7N2w.Z7Wq4o69kzrCVdCvM/Iv08YHTDrqDoW', 0, 1, 0, 0, 1),
(4, 'Anna White', 'anna@company.com', '$2y$10$OgG4D4R3ioFlJr/iBEunkeV7x.XWW6qVy/gONCmJ5ZLILLIWOyplm', 0, 1, 0, 0, 2),
(5, 'Diana Burnwood', 'diana@company.com', '$2y$10$QgKSi.iilYtRGbRhPwZwl.ru7gPLy0lhYhSqt0MF4YByWlu0xOJHC', 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `nominee_id`, `category_id`, `comment`, `timestamp`) VALUES
(22, 1, 4, 2, 'anna is the best!', '2024-11-29 09:55:11'),
(23, 1, 2, 4, 'alice is the sun in my land', '2024-11-29 10:58:57'),
(24, 2, 1, 2, 'com clancy is an excellent writer and designer!', '2024-11-29 11:11:07'),
(25, 3, 5, 1, 'she is one hell of a person!', '2024-11-29 11:11:54'),
(26, 4, 2, 2, 'she is great!', '2024-11-29 11:12:35'),
(27, 4, 1, 2, 'awesome dude!', '2024-11-29 11:12:49'),
(28, 5, 3, 2, 'john is a hard worker', '2024-11-29 11:13:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_id` (`voter_id`),
  ADD KEY `nominee_id` (`nominee_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`voter_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`nominee_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
