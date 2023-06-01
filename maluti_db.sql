-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2023 at 02:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maluti_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `prescription` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `name`, `date`, `time`, `prescription`) VALUES
(4, ' Welcome Sibandze ', '2023-05-18', '03:20:00', 'i have a flue');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `image_type` varchar(50) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `product_name`, `quantity`, `price`, `image_type`, `status`) VALUES
(17, ' Welcome Sibandze ', 'Nopaine', 1, 80, 'panado3.jpeg', 'Delivered'),
(22, ' Welcome Sibandze ', 'Benzodiazepines', 1, 10, 'panado.jpg', 'Delivary Pending');

-- --------------------------------------------------------

--
-- Table structure for table `patiant`
--

CREATE TABLE `patiant` (
  `id` int(11) NOT NULL,
  `names` varchar(250) NOT NULL,
  `DOB` date NOT NULL,
  `Marital_status` enum('Single','Married','Divorced','Widowed') NOT NULL,
  `Number_of_Dependencies` int(11) NOT NULL,
  `Next_of_Kin` varchar(250) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `Phone_Numbers` int(11) NOT NULL,
  `Village` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patiant`
--

INSERT INTO `patiant` (`id`, `names`, `DOB`, `Marital_status`, `Number_of_Dependencies`, `Next_of_Kin`, `Address`, `Phone_Numbers`, `Village`) VALUES
(1, 'Welcome Sbandze', '2023-03-09', 'Single', 0, 'Mlondi', 'Manzini', 7856483, 'Maseru');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('PHARMACIST','PATIENT','ADMIN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`) VALUES
(1, 'Mlondi Dlamini', 'Mlondi', '$2y$10$GGvt7zFkfHHULZpxpfpHau6WF3AMVtrYI6aLoznY0gLxA.MDMWrpG', 'ADMIN'),
(2, 'Smith Wilson', 'Smith', '$2y$10$GGvt7zFkfHHULZpxpfpHau6WF3AMVtrYI6aLoznY0gLxA.MDMWrpG', 'PHARMACIST'),
(3, 'Welcome Sibandze', 'Welcome', '$2y$10$PHxJhf9trsAEGCqqaSxSK.W8/taA7lOTqF6t7jvAnwzesPv76mR.6', 'PATIENT'),
(4, 'Yandzisa Mkhonta', 'Yandzi', '$2y$10$8wxAyoXnMUgL6lfJXMtg1udjGMx9cpkY7pBbdVCcEI0PVx/NUWE7K', 'PHARMACIST');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patiant`
--
ALTER TABLE `patiant`
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
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patiant`
--
ALTER TABLE `patiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64363;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
