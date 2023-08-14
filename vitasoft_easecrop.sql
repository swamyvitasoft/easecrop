-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2023 at 12:28 PM
-- Server version: 10.5.20-MariaDB
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
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `mobile`, `status`, `create_date`) VALUES
(10, 'Vijay', '7896543211', 1, '2023-04-29 12:23:45'),
(18, 'Swamy', '9490043228', 1, '2023-05-09 06:30:24'),
(13, 'Mohan', '9394990064', 1, '2023-04-29 17:51:01'),
(14, 'Easecrop ', '9052345670', 1, '2023-04-29 17:53:40'),
(15, 'Hari', '9866067899', 1, '2023-04-30 19:23:28'),
(16, 'Prudhvi ', '8186866888', 1, '2023-05-05 08:34:05'),
(19, 'Vishwa', '9849101015', 1, '2023-05-09 14:16:41'),
(20, 'Ankit ', '9160223333', 1, '2023-05-11 05:46:16'),
(21, 'Mounika', '9000790007', 1, '2023-05-12 08:16:39'),
(22, 'mohan', '9392643239', 1, '2023-05-13 08:59:01');

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
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `amount_type` varchar(50) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `details` varchar(500) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `amount_type`, `amount_paid`, `details`, `payment_id`, `login_id`, `create_date`) VALUES
(1, 'Cash', 2000, 'Cash Taken by Hand', 7, 25, '2023-05-09 09:17:47'),
(2, 'Cash', 4000, 'Cash Taken by Hand', 16, 26, '2023-05-09 09:17:47'),
(3, 'Cash', 5000, 'Cash Taken by Hand', 11, 27, '2023-05-09 09:17:47'),
(4, 'Cash', 2000, 'Cash Taken by Hand', 14, 27, '2023-05-09 09:17:47'),
(5, 'Cash', 500, 'Cash Taken by Hand', 15, 26, '2023-05-09 17:43:22'),
(6, 'Online', 500, '1683634812_7b14da78fb137a824376.ico', 15, 26, '2023-05-09 17:50:12'),
(7, 'Online', 1000, '1683635239_61c2a6273e839417edd8.jpeg', 15, 26, '2023-05-09 17:57:19'),
(8, 'Cash', 2000, 'Cash Taken by Hand', 10, 27, '2023-05-09 18:16:30'),
(9, 'Online', 5000, '1683641801_47ec69cc4f22885368a5.jpeg', 17, 25, '2023-05-09 19:46:41'),
(10, 'Cash', 1500, 'Cash Taken by Hand', 18, 25, '2023-05-09 19:49:34'),
(11, 'Cash', 4500, 'Cash Taken by Hand', 13, 27, '2023-05-10 21:57:25'),
(12, 'Cash', 5000, 'Cash Taken by Hand', 10, 27, '2023-05-10 21:58:38'),
(13, 'Cash', 4500, 'Cash Taken by Hand', 19, 27, '2023-05-11 11:16:16'),
(14, 'Cash', 2000, 'Cash Taken by Hand', 21, 27, '2023-05-12 20:56:41'),
(15, 'Cash', 2000, 'Cash Taken by Hand', 22, 27, '2023-05-13 14:30:12'),
(16, 'Cash', 4000, 'Cash Taken by Hand', 23, 27, '2023-05-18 14:35:01'),
(17, 'Cash', 3000, 'Cash Taken by Hand', 10, 27, '2023-05-18 14:37:17'),
(18, 'Cash', 200, 'Cash Taken by Hand', 22, 27, '2023-05-28 00:38:28');

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
  `due_amount` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `login_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_id`, `crop_place`, `reference_id`, `acre`, `service`, `crop`, `crop_age`, `fertilizer`, `estimated_date`, `estimated_fps`, `amount`, `due_amount`, `paid_amount`, `payment_type`, `login_id`, `status`, `create_date`) VALUES
(7, 10, 'Karim Nagar', 1, 2, 'Seeding', 'Cotton', 4, 'Fertilizer', '2023-05-01', 'Fertilizer', 2000, 0, 2000, 'Paid', 25, 1, '2023-04-29 21:53:45'),
(16, 18, 'KNR', 8, 3, 'Spread', 'Paddy', 60, 'Pesticides', '2023-05-11', 'Hydro', 4000, 0, 4000, 'Paid', 26, 1, '2023-05-09 16:30:20'),
(10, 13, 'Manugur', 2, 20, 'Spray', 'Sugar cane ', 50, 'Pesticides', '2023-05-30', 'Fertilizer', 10000, 0, 10000, 'Paid', 27, 1, '2023-05-18 09:07:17'),
(11, 14, 'Hyd', 2, 5, 'Spread', 'Paddy seed', 5, 'Pesticides', '2023-04-30', 'Fertilizer', 5000, 0, 5000, 'Paid', 27, 1, '2023-04-30 03:23:40'),
(15, 18, 'Karimnagar', 8, 2, 'Spread', 'pady', 60, 'Pesticides', '2023-05-10', 'Hydro', 3500, 1500, 2000, 'Pending', 26, 1, '2023-05-09 12:27:19'),
(13, 15, 'Warangal ', 2, 10, 'Spread', 'Chilli ', 55, 'Pesticides', '2023-05-02', 'Gi', 4500, 0, 4500, 'Paid', 27, 1, '2023-05-10 16:27:25'),
(14, 16, 'Manugur', 3, 5, 'Spray', 'Paddy', 30, 'Pesticides', '2023-05-06', 'Hydro', 2000, 0, 2000, 'Paid', 27, 1, '2023-05-05 18:04:05'),
(17, 19, 'Karimnagar', 9, 2, 'Spread', 'Paddy', 45, 'Fertilizer', '2023-05-11', 'Ferti', 5000, 0, 5000, 'Paid', 25, 1, '2023-05-09 23:46:41'),
(18, 19, 'KNR', 8, 5, 'Spray', 'Chilli', 50, 'Fertilizer', '2023-05-10', 'Fertilizer', 8000, 6500, 1500, 'Pending', 25, 1, '2023-05-09 14:19:34'),
(19, 20, 'Warangal ', 2, 10, 'Spray', 'Chilli ', 60, 'Fertilizer', '2023-05-12', 'hydro', 4500, 0, 4500, 'Paid', 27, 1, '2023-05-11 15:16:16'),
(20, 21, 'Bmc', 2, 10, 'Spray', 'Paddy', 50, 'Pesticides', '2023-05-13', 'Gi', 4000, 4000, 0, 'Pending', 27, 1, '2023-05-12 17:46:39'),
(21, 16, 'Warangal ', 2, 5, 'Spray', 'Paddy', 40, 'Pesticides', '2023-05-13', 'gi', 2000, 0, 2000, 'Paid', 27, 1, '2023-05-13 00:56:41'),
(22, 22, 'bcm', 2, 10, 'Spray', 'Paddy', 20, 'Pesticides', '2023-05-14', 'gia', 4000, 1800, 2200, 'Pending', 27, 1, '2023-05-27 19:08:28'),
(23, 20, 'Manugur', 2, 20, 'Spray', 'Paddy ', 20, 'Pesticides', '2023-05-20', 'Gi', 4000, 0, 4000, 'Paid', 27, 1, '2023-05-18 18:35:01'),
(24, 21, 'Bcm', 3, 50, 'Spray', 'Chilly', 50, 'Pesticides', '2023-05-19', 'Hydro', 2000, 2000, 0, 'Pending', 27, 1, '2023-05-18 18:35:50');

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `reference_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`reference_id`, `name`, `mobile`, `status`, `create_date`) VALUES
(1, 'Joy', '8976543211', 1, '2023-05-09 07:16:32'),
(2, 'Sham', '9966466675', 1, '2023-05-09 07:16:35'),
(3, 'Ankit', '9160223333', 1, '2023-05-09 07:16:40'),
(8, 'SS', '7995408080', 1, '2023-05-09 07:17:02'),
(9, 'Solutions', '9490043228', 1, '2023-05-09 14:16:41');

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
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

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
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`reference_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `drone`
--
ALTER TABLE `drone`
  MODIFY `drone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
