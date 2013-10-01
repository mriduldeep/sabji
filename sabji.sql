-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 24, 2013 at 04:21 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sabji`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(4) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(12) NOT NULL,
  `admin_pass` varchar(12) NOT NULL,
  `attachment` varchar(100) NOT NULL DEFAULT 'profilephoto.jpg',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_name` (`admin_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_pass`, `attachment`) VALUES
(1, 'admin', 'admin', 'profilephoto.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(6) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(40) NOT NULL,
  `category_parent` int(11) NOT NULL DEFAULT '0',
  `category_desc` varchar(200) DEFAULT NULL,
  `category_img` varchar(100) DEFAULT 'no_thumb.jpg',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_parent`, `category_desc`, `category_img`) VALUES
(2, 'Fresh Fruits', 0, 'contains fresh fruits', 'images.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE IF NOT EXISTS `order_address` (
  `order_id` int(6) NOT NULL,
  `hno` varchar(10) NOT NULL,
  `street` int(30) DEFAULT NULL,
  `location` int(30) DEFAULT NULL,
  `city` int(20) NOT NULL,
  `state` int(20) NOT NULL,
  `pincode` int(6) NOT NULL,
  `landmark` int(100) DEFAULT NULL,
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_id` int(6) NOT NULL,
  `product_id` int(6) NOT NULL,
  `quantity` int(6) NOT NULL,
  `price` int(10) NOT NULL,
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE IF NOT EXISTS `order_master` (
  `order_id` int(6) NOT NULL AUTO_INCREMENT,
  `user_id` int(6) NOT NULL,
  `order_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `order_price` int(10) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_desc` varchar(200) DEFAULT NULL,
  `cust_phone` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `p_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(6) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_price` int(10) NOT NULL,
  `p_alias` varchar(100) DEFAULT NULL,
  `p_quantity` int(6) NOT NULL,
  `p_brand` varchar(50) DEFAULT NULL,
  `p_status` varchar(20) NOT NULL,
  `p_img` varchar(100) NOT NULL,
  `p_desc` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `category_id`, `p_name`, `p_price`, `p_alias`, `p_quantity`, `p_brand`, `p_status`, `p_img`, `p_desc`) VALUES
(1, 2, 'Green Apple', 70, 'seb', 5, NULL, 'available', '', 'Greeen Apple');

-- --------------------------------------------------------

--
-- Table structure for table `special_offer`
--

CREATE TABLE IF NOT EXISTS `special_offer` (
  `offer_id` int(6) NOT NULL AUTO_INCREMENT,
  `product_id` int(6) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `discount` int(8) DEFAULT NULL,
  `offer` varchar(100) DEFAULT NULL,
  `oimg` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`offer_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `special_offer`
--

INSERT INTO `special_offer` (`offer_id`, `product_id`, `description`, `discount`, `offer`, `oimg`) VALUES
(1, 1, 'Great Offer', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_mobile` bigint(10) NOT NULL,
  `hno` varchar(6) NOT NULL,
  `street` varchar(20) DEFAULT NULL,
  `location` varchar(20) NOT NULL,
  `city` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `special_offer`
--
ALTER TABLE `special_offer`
  ADD CONSTRAINT `special_offer_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`p_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
