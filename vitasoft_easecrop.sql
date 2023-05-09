-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2023 at 10:43 AM
-- Server version: 10.5.19-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vitasoft_easecrop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `mobile`, `reference_id`, `login_id`, `status`, `create_date`) VALUES
(4, 'Srinu CH', '8976543212', 2, 24, 1, '2023-04-29 12:21:35'),
(2, 'Joy', '8976543211', 0, 24, 1, '2023-04-29 12:12:39'),
(3, 'Srikanth', '9876543212', 2, 24, 1, '2023-04-29 12:05:21'),
(6, 'Sham', '9966466675', 0, 24, 1, '2023-04-28 16:57:27'),
(5, 'Mahi', '9876543213', 4, 24, 1, '2023-04-29 12:05:29'),
(7, 'Ankit ', '9160223333', 6, 24, 1, '2023-04-28 16:57:27'),
(8, 'Srinu B', '8976543213', 2, 24, 1, '2023-04-29 12:21:55'),
(9, 'Sanjeev', '8976543214', 2, 24, 1, '2023-04-29 12:22:02'),
(10, 'Vijay', '7896543211', 2, 25, 1, '2023-04-29 12:23:45'),
(11, 'Sujatha ', '996646675', 6, 24, 1, '2023-04-29 15:03:48'),
(12, 'Mounika', '8142666662', 6, 24, 1, '2023-04-29 15:06:10'),
(13, 'Mohan', '9394990064', 6, 27, 1, '2023-04-29 17:51:01'),
(14, 'Easecrop ', '9052345670', 6, 27, 1, '2023-04-29 17:53:40'),
(15, 'Hari', '9866067899', 6, 27, 1, '2023-04-30 19:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `drone`
--

CREATE TABLE `drone` (
  `drone_id` int(11) NOT NULL,
  `drone_number` varchar(250) NOT NULL,
  `pilot_operator` varchar(250) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `login_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `drone`
--

INSERT INTO `drone` (`drone_id`, `drone_number`, `pilot_operator`, `mobile`, `login_id`, `created_by`, `status`, `create_date`) VALUES
(1, '123456', 'Swamy', '9490043228', 25, 24, 1, '2023-04-29 11:48:56'),
(2, '1122', 'Srinu', '7995408080', 26, 24, 1, '2023-04-29 11:54:30'),
(3, 'Fm1', 'Prudhvi ', '8142666662', 27, 24, 1, '2023-04-29 15:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `role`, `name`, `username`, `password`, `create_date`) VALUES
(27, 'Drone', 'Prudhvi ', '8142666662', '$2y$10$66sfWIx3z/sBLwl3vtCslO6UyJrcTmh4ogYMczMcVynZgpOU4P/2u', '2023-04-29 15:19:21'),
(26, 'Drone', 'Srinu', '7995408080', '$2y$10$fnJBWJUPnf9z3ypz0nZZ/uGvrIx79h9tkXqA4PHU1zn1MEcGVbS7e', '2023-04-29 11:54:30'),
(25, 'Drone', 'Swamy', '9490043228', '$2y$10$FSonaKyWWtY17iKulNQoT.rhQk/dyHZffgMQ04sK9HfdXgYmDU6UK', '2023-04-28 07:17:50'),
(24, 'Admin', 'Ease Crop', 'easecrop', '$2y$10$FSonaKyWWtY17iKulNQoT.rhQk/dyHZffgMQ04sK9HfdXgYmDU6UK', '2023-04-28 07:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `crop_place` varchar(250) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `acre` int(11) NOT NULL,
  `service` varchar(100) NOT NULL,
  `crop` varchar(100) NOT NULL,
  `crop_age` int(11) NOT NULL,
  `fertilizer` varchar(100) NOT NULL,
  `estimated_date` date NOT NULL,
  `estimated_fps` varchar(500) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `login_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_id`, `crop_place`, `reference_id`, `acre`, `service`, `crop`, `crop_age`, `fertilizer`, `estimated_date`, `estimated_fps`, `amount`, `payment_type`, `login_id`, `status`, `create_date`) VALUES
(1, 3, 'Karimnagar', 2, 2, 'Spray', 'Rice', 6, 'Fertilizer', '2023-04-28', 'Fertilizer', 500, 'Cash', 24, 1, '2023-04-28 03:22:26'),
(2, 5, 'Knr', 4, 2, 'Spread', 'Corn', 3, 'Fertilizer', '2023-04-29', 'Fertilizer', 1000, 'Cash', 24, 1, '2023-04-28 03:22:28'),
(3, 3, 'Kpl', 2, 1, 'Spread', 'Rice', 4, 'Fertilizer', '2023-04-30', 'Fertilizer', 600, 'Cash', 24, 1, '2023-04-28 03:22:31'),
(4, 7, 'Khammam', 6, 10, 'Spray', 'Paddy', 20, 'Pesticides', '2023-05-10', 'Fertilizer', 4500, 'Cash', 24, 1, '2023-04-28 03:22:17'),
(5, 2, 'Wgl', 8, 5, 'Seeding', 'Vegetables', 2, 'Pesticides', '2023-05-06', 'Fertilizer', 1000, 'Cash', 24, 1, '2023-04-29 16:58:16'),
(6, 4, 'Khm', 9, 1, 'Spray', 'Vegetables', 1, 'Seeds', '2023-04-30', 'Fertilizer', 800, 'Cash', 24, 1, '2023-04-29 17:03:53'),
(7, 10, 'Karim Nagar', 2, 2, 'Seeding', 'Cotton', 4, 'Fertilizer', '2023-05-01', 'Fertilizer', 2000, 'Cash', 25, 1, '2023-04-29 17:53:45'),
(8, 11, 'Kusumanchi', 6, 5, 'Spray', 'Chilly', 28, 'Pesticides', '2023-05-08', 'Fertilizer', 2500, 'Cash', 24, 1, '2023-04-29 20:33:48'),
(9, 12, 'Khammam', 6, 6, 'Spread', 'Paddy', 45, 'Pesticides', '2023-05-10', 'Fertilizer', 3000, 'Cash', 24, 1, '2023-04-29 20:36:10'),
(10, 13, 'Manugur', 6, 20, 'Spray', 'Sugar cane ', 50, 'Pesticides', '2023-05-30', 'Fertilizer', 10000, 'Credit', 27, 1, '2023-04-29 23:21:01'),
(11, 14, 'Hyd', 6, 5, 'Spread', 'Paddy seed', 5, 'Pesticides', '2023-04-30', 'Fertilizer', 5000, 'Cash', 27, 1, '2023-04-29 23:23:40'),
(12, 7, 'Khammam', 6, 10, 'Spray', 'Paddy', 25, 'Pesticides', '2023-05-16', 'Gi', 4000, 'Credit', 27, 1, '2023-05-01 00:50:43'),
(13, 15, 'Warangal ', 6, 10, 'Spread', 'Chilli ', 55, 'Pesticides', '2023-05-02', 'Gi', 4500, 'Credit', 27, 1, '2023-05-01 00:53:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `drone`
--
ALTER TABLE `drone`
  ADD PRIMARY KEY (`drone_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `drone`
--
ALTER TABLE `drone`
  MODIFY `drone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
