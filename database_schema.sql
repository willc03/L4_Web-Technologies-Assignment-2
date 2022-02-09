-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2021 at 10:19 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `co1706_cwk2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offers`
--

DROP TABLE IF EXISTS `tbl_offers`;
CREATE TABLE IF NOT EXISTS `tbl_offers` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_title` varchar(255) NOT NULL,
  `offer_dec` varchar(255) NOT NULL,
  PRIMARY KEY (`offer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_offers`
--

INSERT INTO `tbl_offers` (`offer_id`, `offer_title`, `offer_dec`) VALUES
(1, 'Christmas stock clearance ', 'All Christmas related items are 50% off. Discounts will be applied at checkout'),
(2, 'T-shirts Buy 1 get 1 free', 'All T-shirts are buy 1 get 1 free. Promotion will be applied during checkout'),
(3, 'Graduation promo', 'Graduating this year? then you are entitled to 25% your total shop. Just add items to your cart and use the discount code GRAD2022 to receive the discount');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `product_ids` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_title` varchar(255) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_type` enum('UCLan Hoodie','UCLan Logo Tshirt','UCLan Logo Jumper') NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_title`, `product_desc`, `product_image`, `product_price`, `product_type`) VALUES
(1, 'Purple UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (1).jpg', '39.99', 'UCLan Hoodie'),
(2, 'Light Blue UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (2).jpg', '39.99', 'UCLan Hoodie'),
(3, 'Green UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (3).jpg', '39.99', 'UCLan Hoodie'),
(4, 'Dark Grey UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (4).jpg', '39.99', 'UCLan Hoodie'),
(5, 'Black UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (5).jpg', '39.99', 'UCLan Hoodie'),
(6, 'Salmon UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (6).jpg', '39.99', 'UCLan Hoodie'),
(7, 'Burgundy UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (7).jpg', '39.99', 'UCLan Hoodie'),
(8, 'Light Grey UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (8).jpg', '39.99', 'UCLan Hoodie'),
(9, 'Slate Blue UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (9).jpg', '39.99', 'UCLan Hoodie'),
(10, 'Orange UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (10).jpg', '39.99', 'UCLan Hoodie'),
(11, 'Teal UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (11).jpg', '39.99', 'UCLan Hoodie'),
(12, 'Navy UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (12).jpg', '39.99', 'UCLan Hoodie'),
(13, 'Orange UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (13).jpg', '39.99', 'UCLan Hoodie'),
(14, 'Creame UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (14).jpg', '39.99', 'UCLan Hoodie'),
(15, 'Lime UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (15).jpg', '39.99', 'UCLan Hoodie'),
(16, 'Off Blue UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (16).jpg', '39.99', 'UCLan Hoodie'),
(17, 'Red UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (17).jpg', '39.99', 'UCLan Hoodie'),
(18, 'Charcoal UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (18).jpg', '39.99', 'UCLan Hoodie'),
(19, 'Navy Blue UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (19).jpg', '39.99', 'UCLan Hoodie'),
(20, 'Lighter Grey UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (20).jpg', '39.99', 'UCLan Hoodie'),
(21, 'New Blue UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (21).jpg', '39.99', 'UCLan Hoodie'),
(22, 'Forest Green UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (22).jpg', '39.99', 'UCLan Hoodie'),
(23, 'Ocean Blue UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (23).jpg', '39.99', 'UCLan Hoodie'),
(24, 'Pink UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (24).jpg', '39.99', 'UCLan Hoodie'),
(25, 'Orange New UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (25).jpg', '39.99', 'UCLan Hoodie'),
(26, 'Black UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (26).jpg', '39.99', 'UCLan Hoodie'),
(27, 'Light Off Grey UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (27).jpg', '39.99', 'UCLan Hoodie'),
(28, 'Rusty Red UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (28).jpg', '39.99', 'UCLan Hoodie'),
(29, 'Slate Grey UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (29).jpg', '39.99', 'UCLan Hoodie'),
(30, 'Bright Green UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (30).jpg', '39.99', 'UCLan Hoodie'),
(31, 'Bright Pink UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (31).jpg', '39.99', 'UCLan Hoodie'),
(32, 'Burgundy New UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (32).jpg', '39.99', 'UCLan Hoodie'),
(33, 'Navy New UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (33).jpg', '39.99', 'UCLan Hoodie'),
(34, 'Bright Green UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', 'images/items/hoodies/hoodie (34).jpg', '39.99', 'UCLan Hoodie'),
(35, 'Purple UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (1).jpg', '29.99', 'UCLan Logo Jumper'),
(36, 'Rusty Red UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (2).jpg', '29.99', 'UCLan Logo Jumper'),
(37, 'Water Blue UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (3).jpg', '29.99', 'UCLan Logo Jumper'),
(38, 'White UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (4).jpg', '29.99', 'UCLan Logo Jumper'),
(39, 'Pink UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (5).jpg', '29.99', 'UCLan Logo Jumper'),
(40, 'Black UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (6).jpg', '29.99', 'UCLan Logo Jumper'),
(41, 'Old Blue UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (7).jpg', '29.99', 'UCLan Logo Jumper'),
(42, 'Dark Grey  UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (8).jpg', '29.99', 'UCLan Logo Jumper'),
(43, 'Red UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (9).jpg', '29.99', 'UCLan Logo Jumper'),
(44, 'Brown UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (10).jpg', '29.99', 'UCLan Logo Jumper'),
(45, 'Green UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (11).jpg', '29.99', 'UCLan Logo Jumper'),
(46, 'Dark Red UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (12).jpg', '29.99', 'UCLan Logo Jumper'),
(47, 'Yellow UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (13).jpg', '29.99', 'UCLan Logo Jumper'),
(48, 'Light Grey UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (14).jpg', '29.99', 'UCLan Logo Jumper'),
(49, 'Light Green UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (15).jpg', '29.99', 'UCLan Logo Jumper'),
(50, 'Old Red UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (16).jpg', '29.99', 'UCLan Logo Jumper'),
(51, 'Light Purple UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (17).jpg', '29.99', 'UCLan Logo Jumper'),
(52, 'Slate Blue UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (18).jpg', '29.99', 'UCLan Logo Jumper'),
(53, 'Real Red UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (19).jpg', '29.99', 'UCLan Logo Jumper'),
(54, 'Old Pink UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (20).jpg', '29.99', 'UCLan Logo Jumper'),
(55, 'Slate Grey UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (21).jpg', '29.99', 'UCLan Logo Jumper'),
(56, 'Bright Green UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (22).jpg', '29.99', 'UCLan Logo Jumper'),
(57, 'Teal UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (23).jpg', '29.99', 'UCLan Logo Jumper'),
(58, 'Sky Blue UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (24).jpg', '29.99', 'UCLan Logo Jumper'),
(59, 'Sunshine Pink UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (25).jpg', '29.99', 'UCLan Logo Jumper'),
(60, 'Bronze UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (26).jpg', '29.99', 'UCLan Logo Jumper'),
(61, 'Olive Green UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (27).jpg', '29.99', 'UCLan Logo Jumper'),
(62, 'Bright White Green UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (28).jpg', '29.99', 'UCLan Logo Jumper'),
(63, 'Navy Blue UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (29).jpg', '29.99', 'UCLan Logo Jumper'),
(64, 'Rusty Orange UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (30).jpg', '29.99', 'UCLan Logo Jumper'),
(65, 'Bright Orange UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (31).jpg', '29.99', 'UCLan Logo Jumper'),
(66, 'Sky Purple UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (32).jpg', '29.99', 'UCLan Logo Jumper'),
(67, 'Really Red UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (33).jpg', '29.99', 'UCLan Logo Jumper'),
(68, 'Plum Purple UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (34).jpg', '29.99', 'UCLan Logo Jumper'),
(69, 'Dark Purple UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (35).jpg', '29.99', 'UCLan Logo Jumper'),
(70, 'Vibrant Red UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (36).jpg', '29.99', 'UCLan Logo Jumper'),
(71, 'Ocean Blue UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (37).jpg', '29.99', 'UCLan Logo Jumper'),
(72, 'Creame UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (38).jpg', '29.99', 'UCLan Logo Jumper'),
(73, 'Lighter Blue UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (39).jpg', '29.99', 'UCLan Logo Jumper'),
(74, 'Light Grey UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', 'images/items/jumpers/jumper (40).jpg', '29.99', 'UCLan Logo Jumper'),
(75, 'Navy Blue New UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (1).jpg', '19.99', 'UCLan Logo Tshirt'),
(76, 'Rusty Red New UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (2).jpg', '19.99', 'UCLan Logo Tshirt'),
(77, 'Burgundy UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (3).jpg', '19.99', 'UCLan Logo Tshirt'),
(78, 'Pink UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (4).jpg', '19.99', 'UCLan Logo Tshirt'),
(79, 'Teal UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (5).jpg', '19.99', 'UCLan Logo Tshirt'),
(80, 'Black UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (6).jpg', '19.99', 'UCLan Logo Tshirt'),
(81, 'Old Red UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (7).jpg', '19.99', 'UCLan Logo Tshirt'),
(82, 'Grey UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (8).jpg', '19.99', 'UCLan Logo Tshirt'),
(83, 'Red UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (9).jpg', '19.99', 'UCLan Logo Tshirt'),
(84, 'Brown UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (10).jpg', '19.99', 'UCLan Logo Tshirt'),
(85, 'Pdark Purple UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (11).jpg', '19.99', 'UCLan Logo Tshirt'),
(86, 'Yellow UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (12).jpg', '19.99', 'UCLan Logo Tshirt'),
(87, 'Mustard Yellow UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (13).jpg', '19.99', 'UCLan Logo Tshirt'),
(88, 'Dark Grey UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (14).jpg', '19.99', 'UCLan Logo Tshirt'),
(89, 'Dark Green UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (15).jpg', '19.99', 'UCLan Logo Tshirt'),
(90, 'Bright Green UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (16).jpg', '19.99', 'UCLan Logo Tshirt'),
(91, 'Olive Green UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (17).jpg', '19.99', 'UCLan Logo Tshirt'),
(92, 'Dark Grey UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (18).jpg', '19.99', 'UCLan Logo Tshirt'),
(93, 'Orange UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (19).jpg', '19.99', 'UCLan Logo Tshirt'),
(94, 'Purple UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (20).jpg', '19.99', 'UCLan Logo Tshirt'),
(95, 'Slate Blue UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (21).jpg', '19.99', 'UCLan Logo Tshirt'),
(96, 'Bright Pink UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (22).jpg', '19.99', 'UCLan Logo Tshirt'),
(97, 'Brightly Green UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (23).jpg', '19.99', 'UCLan Logo Tshirt'),
(98, 'Lime Green UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (24).jpg', '19.99', 'UCLan Logo Tshirt'),
(99, 'Ocean Blue UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (25).jpg', '19.99', 'UCLan Logo Tshirt'),
(100, 'Dark Red UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (26).jpg', '19.99', 'UCLan Logo Tshirt'),
(101, 'Another Green UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (27).jpg', '19.99', 'UCLan Logo Tshirt'),
(102, 'Slate Grey UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (28).jpg', '19.99', 'UCLan Logo Tshirt'),
(103, 'Bright Orange UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (29).jpg', '19.99', 'UCLan Logo Tshirt'),
(104, 'Another Purple UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (30).jpg', '19.99', 'UCLan Logo Tshirt'),
(105, 'Real Red UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (31).jpg', '19.99', 'UCLan Logo Tshirt'),
(106, 'Brilliant Blue UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (32).jpg', '19.99', 'UCLan Logo Tshirt'),
(107, 'Creame UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (33).jpg', '19.99', 'UCLan Logo Tshirt'),
(108, 'Teal Blue UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (34).jpg', '19.99', 'UCLan Logo Tshirt'),
(109, 'White UCLan Logo Tshirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', 'images/items/tshirts/tshirt (35).jpg', '19.99', 'UCLan Logo Tshirt');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

DROP TABLE IF EXISTS `tbl_reviews`;
CREATE TABLE IF NOT EXISTS `tbl_reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review_title` varchar(255) NOT NULL,
  `review_desc` text NOT NULL,
  `review_rating` enum('1','2','3','4','5') NOT NULL,
  `review_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_full_name` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_full_name`, `user_address`, `user_email`, `user_pass`, `user_timestamp`) VALUES
(1, 'Mark Lochrie', 'CM218, C&T Building, University of Central Lancashire, Preston, PR1 2HE', 'MLochrie@uclan.ac.uk', '$2y$11$qb1ntDRbEvqsXK9It8WUTON/tm4/yNdJcYNWhOAC7VtSCsRCZCUJy', '2021-11-26 10:07:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
