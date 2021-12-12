-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 02, 2021 at 02:50 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alldrivedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` longtext NOT NULL,
  `password` longtext NOT NULL,
  `name` text NOT NULL,
  `post` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `name`, `post`, `email`) VALUES
(1, 'alldrive', '6c7d095771d47b5d0e3541960ec7745c', 'Imesh Jeewantha', 'Manager', 'imesh562@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `location_id` int(4) NOT NULL,
  `booked_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `pickup_time` tinytext NOT NULL,
  `pickup_date` date NOT NULL,
  `booked_period` int(11) NOT NULL,
  `estimated_km` int(11) NOT NULL,
  `driver` int(11) NOT NULL DEFAULT 0,
  `customer_id` int(11) DEFAULT NULL,
  `login_id` bigint(11) DEFAULT NULL,
  `vehicle_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `return_id` int(11) DEFAULT NULL,
  `pickup_status` text DEFAULT 'No',
  `driver_id` int(11) DEFAULT NULL,
  `service` int(11) DEFAULT NULL,
  `review_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `location_id`, `booked_date`, `pickup_time`, `pickup_date`, `booked_period`, `estimated_km`, `driver`, `customer_id`, `login_id`, `vehicle_id`, `payment_id`, `return_id`, `pickup_status`, `driver_id`, `service`, `review_id`) VALUES
(1, 1, '2021-06-02 12:31:48', '07:00 AM', '2021-06-03', 5, 50, 1, NULL, 9915, 1, 98379, 2, 'Yes', 1, NULL, NULL),
(2, 1, '2021-06-02 12:33:14', '08:00 AM', '2021-06-03', 4, 40, 1, NULL, 9915, 4, 8584, 1, 'Yes', 1, NULL, NULL),
(3, 1, '2021-06-02 12:36:01', '08:30 AM', '2021-06-23', 3, 35, 0, NULL, 9915, 3, 7629, NULL, 'No', NULL, NULL, NULL),
(4, 1, '2021-06-02 12:39:58', '08:00 AM', '2021-06-08', 4, 60, 1, 2, NULL, 5, 70955, NULL, 'No', NULL, NULL, NULL),
(5, 1, '2021-06-02 12:40:47', '07:00 AM', '2021-06-10', 5, 90, 1, 3, NULL, 6, 48257, NULL, 'No', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `address` text NOT NULL,
  `tel_no` bigint(11) NOT NULL,
  `login_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `email`, `f_name`, `l_name`, `address`, `tel_no`, `login_id`) VALUES
(1, 'imesh562@gmail.com', 'Imesh', 'Gunathilaka', '53/C Aladeniya road, Muruthalawa.', 123456788, 9915),
(2, 'imesh562@gmail.com', 'Kasun', 'Ranathunga', '53/C aladeniya rd, Muruthalawa.', 765281872, NULL),
(3, 'imesh562@gmail.com', 'Nadun', 'Rathnayake', '53/C aladeniya rd, Muruthalawa.', 721230425, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `login_id` bigint(20) NOT NULL,
  `password` tinytext DEFAULT NULL,
  `username` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_login`
--

INSERT INTO `customer_login` (`login_id`, `password`, `username`) VALUES
(9915, '0180fe10fe03e15648379a992a6bfbe4', 'imesh562');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `tel_no` int(11) NOT NULL,
  `address` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `f_name`, `tel_no`, `address`, `username`, `password`) VALUES
(1, 'I.J Gunathilake', 721230488, '53/C Aladeniya road, Muruthlawa.', 'imesh562', '0180fe10fe03e15648379a992a6bfbe4'),
(2, 'Lahiru Thilakaratne', 721234567, 'Matale', 'lahiru123', '2619ebb53f52d3a7b93bab08a93d1228'),
(3, 'Thilina Wickramasinghe', 789456123, 'Kandy', 'thilina123', 'f2e925a27762084715b77373ddc813e6');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location`) VALUES
(1, 'AllDrive Kandy HQ'),
(2, 'Peradeniya Botanical Garden'),
(3, 'Kandy Dalada Maligawa');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `total_lkr` int(11) NOT NULL,
  `total_usd` float NOT NULL,
  `paying_email` tinytext NOT NULL DEFAULT 'Cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `total_lkr`, `total_usd`, `paying_email`) VALUES
(7629, 3875, 19.63, 'sb-43glpv4804533@personal.example.com'),
(8584, 10800, 54.7, 'sb-43glpv4804533@personal.example.com'),
(48257, 15100, 76.48, 'Cash'),
(70955, 11600, 58.75, 'sb-43glpv4804533@personal.example.com'),
(98379, 12750, 64.58, 'sb-43glpv4804533@personal.example.com');

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

CREATE TABLE `refund` (
  `refund_id` int(11) NOT NULL,
  `login_id` bigint(11) DEFAULT NULL,
  `dateStamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_lkr` int(11) NOT NULL,
  `total_usd` float NOT NULL,
  `paying_email` text NOT NULL,
  `admin_approval` text NOT NULL DEFAULT 'No',
  `booked_date` text NOT NULL,
  `payment_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_recieve` int(11) DEFAULT NULL,
  `refund_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `content` text NOT NULL,
  `booking_id` int(11) NOT NULL,
  `approval` int(11) DEFAULT NULL,
  `vehicle_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_type` tinytext NOT NULL,
  `vehicle_name` tinytext NOT NULL,
  `license_no` tinytext NOT NULL,
  `availability` int(11) NOT NULL,
  `day_price` int(11) NOT NULL,
  `km_price` int(11) NOT NULL,
  `description_1` text NOT NULL,
  `description_2` text NOT NULL,
  `description_3` text NOT NULL,
  `description_4` text NOT NULL,
  `description_5` text NOT NULL,
  `description_6` text NOT NULL,
  `img1` text NOT NULL,
  `img2` text NOT NULL,
  `img3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_type`, `vehicle_name`, `license_no`, `availability`, `day_price`, `km_price`, `description_1`, `description_2`, `description_3`, `description_4`, `description_5`, `description_6`, `img1`, `img2`, `img3`) VALUES
(1, 'Luxury Car', 'NISSAN LEAF 2021', 'CCA-1265', 1, 1000, 25, '4 PASSENGER CAPACITY.', '4 GOLF BAGS CAPACITY', '6 STANDARD AIRBAGS.', 'MAXIMUM RANGE OF 175KM IN ONE CHARGE.', 'VEHICLE DYNAMIC CONTROL.', '5 STAR SAFETY RATING.', 'leaf1.jpg', 'leaf2.jpg', 'leaf3.jpg'),
(2, 'Luxury Car', 'NISSAN LEAF 2021', 'CCA-1287', 1, 1000, 25, '4 PASSENGER CAPACITY.', '4 GOLF BAGS CAPACITY', '6 STANDARD AIRBAGS.', 'MAXIMUM RANGE OF 175KM IN ONE CHARGE.', 'VEHICLE DYNAMIC CONTROL.', '5 STAR SAFETY RATING.', 'leaf1.jpg', 'leaf2.jpg', 'leaf3.jpg'),
(3, 'Luxury Car', 'NISSAN LEAF 2021', 'CCA-1212', 1, 1000, 25, '4 PASSENGER CAPACITY.', '4 GOLF BAGS CAPACITY', '6 STANDARD AIRBAGS.', 'MAXIMUM RANGE OF 175KM IN ONE CHARGE.', 'VEHICLE DYNAMIC CONTROL.', '5 STAR SAFETY RATING.', 'leaf1.jpg', 'leaf2.jpg', 'leaf3.jpg'),
(4, 'Luxury Car', 'TOYOTA GT86', 'CCA-2564', 1, 1000, 40, '4 PASSENGER CAPACITY.', '2 GOLF BAGS CAPACITY.', '2 STANDARD AIRBAGS.', 'MAXIMUM RANGE OF 175KM IN ONE CHARGE.', 'VEHICLE DYNAMIC CONTROL.', '5 STAR SAFETY RATING.', 'gt86_1.jpg', 'gt86_2.jpg', 'gt86_3.jpeg'),
(5, 'Luxury Car', 'TOYOTA GT86', 'CCA-2598', 1, 1000, 40, '4 PASSENGER CAPACITY.', '2 GOLF BAGS CAPACITY.', '2 GOLF BAGS CAPACITY.', 'MAXIMUM RANGE OF 175KM IN ONE CHARGE.', 'VEHICLE DYNAMIC CONTROL.', '5 STAR SAFETY RATING.', 'gt86_1.jpg', 'gt86_2.jpg', 'gt86_3.jpeg'),
(6, 'Luxury Car', 'TOYOTA GT86', 'CCA-2532', 1, 1000, 40, '4 PASSENGER CAPACITY.', '2 GOLF BAGS CAPACITY.', '2 GOLF BAGS CAPACITY.', 'MAXIMUM RANGE OF 175KM IN ONE CHARGE.', 'VEHICLE DYNAMIC CONTROL.', '5 STAR SAFETY RATING.', 'gt86_1.jpg', 'gt86_2.jpg', 'gt86_3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_return`
--

CREATE TABLE `vehicle_return` (
  `return_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `return_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `driven_km` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `payment_status` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_return`
--

INSERT INTO `vehicle_return` (`return_id`, `book_id`, `return_date`, `driven_km`, `balance`, `payment_status`) VALUES
(1, 2, '2021-06-02 12:47:39', 35, 1200, 'Completed'),
(2, 1, '2021-06-02 12:47:57', 60, -2250, 'Completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `login_id` (`login_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `date` (`pickup_date`) USING BTREE,
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `return_id` (`return_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_ibfk_1` (`login_id`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `refund`
--
ALTER TABLE `refund`
  ADD PRIMARY KEY (`refund_id`),
  ADD KEY `refund_ibfk_1` (`login_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `vehicle_return`
--
ALTER TABLE `vehicle_return`
  ADD PRIMARY KEY (`return_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `refund`
--
ALTER TABLE `refund`
  MODIFY `refund_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicle_return`
--
ALTER TABLE `vehicle_return`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `customer` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_6` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_7` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `customer_login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
