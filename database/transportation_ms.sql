-- phpMyAdmin SQL Dump
-- Server version: 10.4.32-MariaDB

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `transportation_ms`;
USE `transportation_ms`;

-- --------------------------------------------------------
-- Table structure for table `admins`
-- --------------------------------------------------------
CREATE TABLE `admins` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `admins` (`id`, `email`, `username`, `password`) VALUES
(1, 'admin@123', 'admin', 'admin123');

-- --------------------------------------------------------
-- Table structure for table `bill`
-- --------------------------------------------------------
CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fare` int NOT NULL,
  `other` int NOT NULL,
  `fuel` int NOT NULL,
  `tcost` int NOT NULL,
  `total_km` decimal(10,2) NOT NULL,
  `fuel_cost` decimal(10,2) NOT NULL,
  `extra_cost` decimal(10,2) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB;

INSERT INTO `bill` VALUES
(1,'15','ronak',1000,0,1500,2500,0,0,0,2500);

-- --------------------------------------------------------
-- Table structure for table `booking`
-- --------------------------------------------------------
CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pic_date` varchar(100) NOT NULL,
  `pic_time` varchar(100) NOT NULL,
  `dil_date` varchar(100) NOT NULL,
  `dil_time` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `pickup_point` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `confirmation` int NOT NULL,
  `veh_reg` varchar(255) NOT NULL,
  `driverid` int NOT NULL,
  `finished` int NOT NULL,
  `paid` int NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB;

INSERT INTO `booking` VALUES
(10,'user1','user1','2024-06-26','01:56','2024-06-28','15:00','Surat','DELHI','safe delivery','user1@gmail.com','985463127',1,'GJ-36-Z-0001',24,1,1);

-- --------------------------------------------------------
-- Table structure for table `buses`
-- --------------------------------------------------------
CREATE TABLE `buses` (
  `bus_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_name` varchar(100),
  `departure_city` varchar(100),
  `arrival_city` varchar(100),
  `departing_date` varchar(100),
  `returning_date` varchar(100),
  `schedule_type` enum('daily','custom'),
  `bus_type` varchar(50),
  `seats_available` int,
  PRIMARY KEY (`bus_id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- Table structure for table `bookings`
-- --------------------------------------------------------
CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_id` int NOT NULL,
  `seats_selected` varchar(255),
  `booking_date` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`booking_id`),
  FOREIGN KEY (`bus_id`) REFERENCES `buses`(`bus_id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- Table structure for table `driver`
-- --------------------------------------------------------
CREATE TABLE `driver` (
  `driverid` int(11) NOT NULL AUTO_INCREMENT,
  `drname` varchar(255),
  `drjoin` varchar(50),
  `drmobile` varchar(20),
  `drlicense` varchar(30),
  `drlicensevalid` varchar(50),
  `draddress` varchar(255),
  `drphoto` varchar(50),
  `dr_available` int,
  PRIMARY KEY (`driverid`)
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100),
  `email` varchar(100) UNIQUE,
  `password` varchar(255),
  `role` enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

COMMIT;
