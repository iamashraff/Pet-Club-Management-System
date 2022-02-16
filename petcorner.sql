-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2021 at 11:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petcorner`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '51eac6b471a284d3341d8c0c63d0f1a286262a18');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(6) NOT NULL,
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `area_code` varchar(5) NOT NULL,
  `mobilehp` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `f_name`, `l_name`, `email`, `area_code`, `mobilehp`, `birth_date`, `username`, `password`) VALUES
(20, 'Muhamad', 'Ashraff', 'muhamadashraff@email.com', '011', '23192237', '1990-01-01', 'muhamadashraff', '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(21, 'Muhammad', 'Hadif', 'hadif@gmail.com', '012', '3320933', '2001-05-01', 'muhammadhadif', '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(22, 'Siti', 'Nabilah', 'nabilah@gmail.com', '019', '2438933', '1999-07-01', 'sitinabilah', '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(23, 'Sharifah', 'Fatihah', 'fatihah@gmail.com', '017', '2743933', '1999-12-31', 'fatihah', '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(24, 'Hariz', 'Ahmad', 'hariz@yahoo.com', '018', '2273321', '2003-10-22', 'hariz', '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(25, 'Ahmad', 'Abu', 'ahmadabu@yahoo.com', '017', '23723733', '1997-01-22', 'ahmadabu', '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(26, 'Muhd', 'Hadi', 'hadi@yahoo.com', '016', '26372211', '1998-06-28', 'hadi', '51eac6b471a284d3341d8c0c63d0f1a286262a18');

-- --------------------------------------------------------

--
-- Table structure for table `pet_info`
--

CREATE TABLE `pet_info` (
  `pet_id` int(6) NOT NULL,
  `pet_type` varchar(20) NOT NULL,
  `pet_name` varchar(50) NOT NULL,
  `pet_gender` varchar(20) NOT NULL,
  `pet_partnership_pro` varchar(255) NOT NULL,
  `member_id` int(6) NOT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet_info`
--

INSERT INTO `pet_info` (`pet_id`, `pet_type`, `pet_name`, `pet_gender`, `pet_partnership_pro`, `member_id`, `date_added`) VALUES
(57, 'Cat', 'Milo', 'Male', 'Shelter Program,Breeder Program,Pet Care Academy,Animal Welfare', 21, '2021-12-09 02:54:30'),
(58, 'Cat', 'Meow', 'Male', 'Shelter Program,Pet Care Academy,Animal Welfare', 20, '2021-12-09 02:54:48'),
(59, 'Dog', 'Black', 'Male', 'Shelter Program,Pet Care Academy,Animal Welfare', 20, '2021-12-11 12:52:20'),
(60, 'Cat', 'Blacky', 'Female', 'Shelter Program,Breeder Program,Pet Care Academy,Animal Welfare', 24, '2021-12-11 12:52:38'),
(61, 'Dog', 'Milo', 'Male', 'Shelter Program,Pet Care Academy', 21, '2021-12-11 12:54:57'),
(62, 'Rabbit', 'Oscar', 'Male', 'Pet Care Academy,Animal Welfare', 23, '2021-12-11 12:55:37'),
(63, 'Fish', 'Coco', 'Female', 'Breeder Program,Pet Care Academy', 22, '2021-12-11 12:56:15'),
(64, 'Rabbit', 'Teddy', 'Female', 'Shelter Program,Breeder Program,Pet Care Academy', 22, '2021-12-11 12:57:07'),
(65, 'Cat', 'Mickey', 'Male', 'Shelter Program,Breeder Program', 23, '2021-12-11 12:57:36'),
(66, 'Fish', 'Lola', 'Female', 'Shelter Program,Breeder Program,Animal Welfare', 21, '2021-12-11 12:58:13'),
(67, 'Rabbit', 'Loki', 'Female', 'Shelter Program,Breeder Program,Animal Welfare', 24, '2021-12-11 12:58:41'),
(68, 'Dog', 'Luna', 'Female', 'Shelter Program,Breeder Program,Pet Care Academy', 21, '2021-12-11 12:59:02'),
(69, 'Fish', 'Leo', 'Male', 'Shelter Program,Breeder Program,Pet Care Academy,Animal Welfare', 22, '2021-12-11 13:00:03'),
(70, 'Rabbit', 'Max', 'Female', 'Shelter Program,Breeder Program,Animal Welfare', 23, '2021-12-11 13:00:59'),
(71, 'Dog', 'Chico', 'Male', 'Shelter Program,Breeder Program,Pet Care Academy,Animal Welfare,Pet Physiotherapy', 24, '2021-12-11 13:01:37'),
(72, 'Cat', 'Acik', 'Male', 'Pet Care Academy', 20, '2021-12-11 13:02:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `pet_info`
--
ALTER TABLE `pet_info`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pet_info`
--
ALTER TABLE `pet_info`
  MODIFY `pet_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_info`
--
ALTER TABLE `pet_info`
  ADD CONSTRAINT `member_id` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
