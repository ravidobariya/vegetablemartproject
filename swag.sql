-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2013 at 11:11 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `swag`
--
CREATE DATABASE IF NOT EXISTS `swag` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `swag`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `display_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `display_id` (`display_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='categories of items for the top menu' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `display_id`) VALUES
(1, 'boats', 1),
(2, 'motors', 2),
(3, 'accessories', 3);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `sequence_id` int(11) NOT NULL,
  `url` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='took images out as could have multiple of same item' AUTO_INCREMENT=26 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `item_id`, `sequence_id`, `url`) VALUES
(1, 1, 1, 'DSCF0029.JPG'),
(2, 1, 2, 'DSCF0059.JPG'),
(3, 3, 1, 'DSC02922.JPG'),
(4, 3, 2, 'DSC02934.JPG'),
(5, 3, 3, 'DSC02938.JPG'),
(6, 3, 4, 'DSC02942.JPG'),
(9, 3, 5, 'DSC02944.JPG'),
(10, 3, 6, 'DSC02947.JPG'),
(11, 2, 1, 'DSC01595.JPG'),
(12, 2, 2, 'DSC01596.JPG'),
(13, 4, 1, 'DSC08434a.JPG'),
(14, 4, 2, 'DSC08435a.JPG'),
(15, 5, 1, 'DSC08508.JPG'),
(16, 5, 2, 'DSC08511.JPG'),
(17, 6, 1, 'DSC08641.JPG'),
(18, 6, 2, 'DSC08643.JPG'),
(19, 7, 1, 'DSC08693.JPG'),
(20, 7, 2, 'DSC08703.JPG'),
(21, 8, 1, 'DSC08725.JPG'),
(22, 8, 2, 'DSC08723.JPG'),
(23, 9, 1, 'DSC08770.JPG'),
(24, 9, 2, 'DSC08773.JPG'),
(25, 1, 3, 'CabinCruzerTowing1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `paypal_url` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='individual items for sale' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `paypal_url`) VALUES
(1, 1, 'Cabin Cruiser', 'I got this with the idea of doing the Trent Canal', '2500.00', 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SM2GNBLAULSMQ'),
(2, 1, 'Cedar Strip With Seats in Front', 'This one was at the Gravenhurst Boat Show and is not for sale', '0.00', ''),
(3, 1, 'FeatherCraft Aluminum With Front Steering', 'I borrowed this one from Al to go exploring on Georgian Bay. It isn''t for sale either ', '0.00', ''),
(4, 1, 'Cedar Strip under construction', 'This is being custom built for some lucky person in a cedar strip boat shop in Powassan. It is already sold.', '0.00', ''),
(5, 1, 'Just Finished', 'And just about ready to head out of the shop to it''s new home.', '0.00', ''),
(6, 1, 'Turquoise Runabout', 'This is cool because of it''s fins.', '2500.00', ''),
(7, 1, 'Tiller Cedar Strip', 'Finally a Giesler that is for sale!', '2500.00', ''),
(8, 1, 'Aluminum with Front Steering', 'This one needs a good home, but cleaned up will be fun.', '1500.00', ''),
(9, 1, 'Plywood and Fibreglass Runabout', 'Sweet looking fun little boat.', '2500.00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
