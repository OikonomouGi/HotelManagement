-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2023 at 10:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `Username` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `TotalPrice` int(50) NOT NULL,
  `Checkin` date NOT NULL,
  `Checkout` date NOT NULL,
  `ResID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`Username`, `Type`, `TotalPrice`, `Checkin`, `Checkout`, `ResID`) VALUES
('Nikos', 'Executive Double Room', 500, '2023-02-10', '2023-02-15', 10),
('Nikos', 'Executive Double Room', 400, '2023-02-16', '2023-02-20', 13);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `Type` varchar(75) NOT NULL,
  `Price` int(30) NOT NULL,
  `Photo` varchar(50) NOT NULL,
  `Capacity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`Type`, `Price`, `Photo`, `Capacity`) VALUES
('Standard', 50, 'photos/room-for-1.jpg', 1),
('Executive-Double', 100, 'photos/room1.jpg', 2),
('Deluxe-Double', 130, 'photos/deluxe-double-room.jpg', 2),
('Suite', 300, 'photos/suites1.jfif', 4),
('Penthouse-Suite', 400, 'photos/penthouse-suite.jfif', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Surname`, `Country`, `City`, `Address`, `email`, `Username`, `Password`) VALUES
('admin', 'admin', 'admin', 'admin', 'admin', 'admin@mail.com', 'admin', 'admin'),
('Giannis', 'Oikonomou', 'Greece', 'Athens', 'test', 'test@mail.com', 'Giannis', 'Giannis'),
('Stamatis', 'Stroumpakis', 'Greece', 'Chios', 'test', 'test1@mail.com', 'Stamatis', 'STamatis'),
('Periklis', 'Tsaoushs', 'Peru', 'Peru', 'test', 'peri@mail.com', 'Periklis', 'Periklis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ResID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ResID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
