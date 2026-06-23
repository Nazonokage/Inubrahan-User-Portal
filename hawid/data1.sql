-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2024 at 10:22 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data1`
--

-- --------------------------------------------------------

--
-- Table structure for table `thistable1`
--

DROP TABLE IF EXISTS `thistable1`;
CREATE TABLE IF NOT EXISTS `thistable1` (
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` text NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `age` int NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `profile_picture` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `thistable1`
--

INSERT INTO `thistable1` (`username`, `password`, `firstname`, `middlename`, `lastname`, `age`, `name`, `email`, `profile_picture`) VALUES
('violet', '$2y$10$.fpLpaANdH/dQH89coq/ReuKBVZoPyHdkWhoVUU8Bp6kesxlEIl2O', 'violet', 'v', 'sing', 24, '', '', 0),
('321', '$2y$10$1u1yKcmajvazRCkuHYcpyOQrhG3BagWwxtazZF3FzXA1p73UDGuUK', '321', '321', '321', 321, '', '', 0),
('555', '$2y$10$SYee6K1MfFdqnsASndwT6e3DwBPjYTx6TqRnBdEadNwmAdxPaQuCq', '555', '555', '555', 23, '', '', 0),
('321', '$2y$10$8xzbI0wcWVO8RIiRLD8oFugwtXN5MeE08YleUPT30sGhbnkJfJSUa', '321', '321', '321', 23, '', '', 0),
('fish', '$2y$10$m0HIfmj0btljZvhbWRlpJOorHPwCK6DjuL/x2.VzJFDL6fz1Qm4fa', 'fish', 'fash', 'fash', 23, '', '', 0),
('6161', '$2y$10$.s1P6Ivs/J9dYdQkOSHSIuOIwE1KIihw7K52RCWAATvVmB8Z6j1Zu', '6161', '6161', '6161', 66, '', '', 0),
('gang', '$2y$10$J6BbsWFcecw/nL285H4.lecRqf4xdKPSuTl7/2fpm.QlOUNuKgEpO', 'ging', 'gang', 'gang', 18, '', '', 0),
('421', '$2y$10$jEHG6o10kLrjFVSuiJ1onOi5HRzTkPla0OR8Kj.B1uhFbj0q/7LLG', '421', '421', '421', 33, '', '', 0),
('421', '$2y$10$nRRNktekuKIW7gbOUrnNJe.IxzPpubU1PFxOgmBwDG66niWnHhD8C', '421', '421', '421', 33, '', '', 0),
('vio', '$2y$10$BTwaksEWQSeHkNbnOyE1h.IEzX8F5RqlYdC5My/8DXLyOFed2pt9y', '123', '123', '123', 123, '', '', 0),
('666', '$2y$10$HWOIFFxLbgBbeNGqNQUrN.b1vNjPFqnfh3jonOh8Q23J.mdQWzirG', '666', '666', '666', 66, '', '', 0),
('666', '$2y$10$E8mvP4jzGFKtfAA2yF9i.ON0q6X6zdQdYzfIhYA2wJToJjR/dgscG', '666', '666', '666', 66, '', '', 0),
('', '', '', '', '', 0, '', '', 0),
('', '', '', '', '', 0, '', '', 0),
('', '', '', '', '', 0, '', '', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
