-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2022 at 03:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_technologies_ass2`
--

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL,
  `offer_title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `offer_description` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offer_id`, `offer_title`, `offer_description`) VALUES
(1, 'Christmas Stock Clearance', 'All Christmas related items are 50% off. Discounts will be applied at checkout.'),
(2, 'T-Shirts Buy 1 Get 1 Free', 'All T-shirts are Buy 1 Get 1 Free. Promotion will be applied during checkout.'),
(3, 'Graduation Promotion', 'Graduating this year? Then you are entitled to 25% off your total shop! Just add items to your cart and use the discount code GRAD2022 to receive the discount.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `product_ids` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `user_id`, `product_ids`) VALUES
(1, '2022-02-28 18:19:06', 2, '1 71 72'),
(2, '2022-02-28 18:19:38', 2, '72 73'),
(3, '2022-02-28 23:26:14', 2, '2 2 6 6'),
(20, '2022-03-09 12:49:26', 2, '5 8 7 48 49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `colour` varchar(255) NOT NULL,
  `product_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `product_type` enum('UCLan Hoodie','UCLan Logo T-Shirt','UCLan Logo Jumper') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `colour`, `product_image`, `product_type`) VALUES
(1, 'Lava', '../Images/Hoodie/Lava.jpg', 'UCLan Hoodie'),
(2, 'Atlantic', '../Images/Hoodie/Atlantic.jpg', 'UCLan Hoodie'),
(3, 'Black Melangee', '../Images/Hoodie/Black Melangee.jpg', 'UCLan Hoodie'),
(4, 'Blush Pink', '../Images/Hoodie/Blush Pink.jpg', 'UCLan Hoodie'),
(5, 'Peapod', '../Images/Hoodie/Peapod.jpg', 'UCLan Hoodie'),
(6, 'Flint Grey', '../Images/Hoodie/Flint Grey.jpg', 'UCLan Hoodie'),
(7, 'Not White', '../Images/Hoodie/Not White.jpg', 'UCLan Hoodie'),
(8, 'Caribbean Blue', '../Images/Hoodie/Caribbean Blue.jpg', 'UCLan Hoodie'),
(9, 'Maroon', '../Images/Hoodie/Maroon.jpg', 'UCLan Hoodie'),
(10, 'Vintage Royal', '../Images/Hoodie/Vintage Royal.jpg', 'UCLan Hoodie'),
(11, 'Sage', '../Images/Hoodie/Sage.jpg', 'UCLan Hoodie'),
(12, 'Dusty Black', '../Images/Hoodie/Dusty Black.jpg', 'UCLan Hoodie'),
(13, 'Cerisee', '../Images/Hoodie/Cerisee.jpg', 'UCLan Hoodie'),
(14, 'Lisa', '../Images/Hoodie/Lisa.jpg', 'UCLan Hoodie'),
(15, 'Midnight', '../Images/Hoodie/Midnight.jpg', 'UCLan Hoodie'),
(16, 'Stone Blue', '../Images/Hoodie/Stone Blue.jpg', 'UCLan Hoodie'),
(17, 'Black', '../Images/Hoodie/Black.jpg', 'UCLan Hoodie'),
(18, 'Gumdrop Green', '../Images/Hoodie/Gumdrop Green.jpg', 'UCLan Hoodie'),
(19, 'Bordeaux', '../Images/Hoodie/Bordeaux.jpg', 'UCLan Hoodie'),
(20, 'Graphite', '../Images/Hoodie/Graphite.jpg', 'UCLan Hoodie'),
(21, 'Bottle Green', '../Images/Hoodie/Bottle Green.jpg', 'UCLan Hoodie'),
(22, 'Dusty Red', '../Images/Hoodie/Dusty Red.jpg', 'UCLan Hoodie'),
(23, 'Insignia Blue', '../Images/Hoodie/Insignia Blue.jpg', 'UCLan Hoodie'),
(24, 'Allure Blue', '../Images/Hoodie/Allure Blue.jpg', 'UCLan Hoodie'),
(25, 'Coral Rose', '../Images/Hoodie/Coral Rose.jpg', 'UCLan Hoodie'),
(26, 'Mustard', '../Images/Hoodie/Mustard.jpg', 'UCLan Hoodie'),
(27, 'Honeysuckle', '../Images/Hoodie/Honeysuckle.jpg', 'UCLan Hoodie'),
(28, 'Grey Melange', '../Images/Hoodie/Grey Melange.jpg', 'UCLan Hoodie'),
(29, 'Dusty Grey', '../Images/Hoodie/Dusty Grey.jpg', 'UCLan Hoodie'),
(30, 'Midnight Blue', '../Images/Hoodie/Midnight Blue.jpg', 'UCLan Hoodie'),
(31, 'Forest Green', '../Images/Jumper/Forest Green.jpg', 'UCLan Logo Jumper'),
(32, 'Heather Sport Scarlet Red', '../Images/Jumper/Heather Sport Scarlet Red.jpg', 'UCLan Logo Jumper'),
(33, 'Ash', '../Images/Jumper/Ash.jpg', 'UCLan Logo Jumper'),
(34, 'Irish Green', '../Images/Jumper/Irish Green.jpg', 'UCLan Logo Jumper'),
(35, 'Carolina Blue', '../Images/Jumper/Carolina Blue.jpg', 'UCLan Logo Jumper'),
(36, 'Light Pink', '../Images/Jumper/Light Pink.jpg', 'UCLan Logo Jumper'),
(37, 'Light Blue', '../Images/Jumper/Light Blue.jpg', 'UCLan Logo Jumper'),
(38, 'Orchid', '../Images/Jumper/Orchid.jpg', 'UCLan Logo Jumper'),
(39, 'Legion Blue', '../Images/Jumper/Legion Blue.jpg', 'UCLan Logo Jumper'),
(40, 'Maroon', '../Images/Jumper/Maroon.jpg', 'UCLan Logo Jumper'),
(41, 'Antique Cherry Red', '../Images/Jumper/Antique Cherry Red.jpg', 'UCLan Logo Jumper'),
(42, 'Sports Grey', '../Images/Jumper/Sports Grey.jpg', 'UCLan Logo Jumper'),
(43, 'Black', '../Images/Jumper/Black.jpg', 'UCLan Logo Jumper'),
(44, 'Cherry Red', '../Images/Jumper/Cherry Red.jpg', 'UCLan Logo Jumper'),
(45, 'Indigo Blue', '../Images/Jumper/Indigo Blue.jpg', 'UCLan Logo Jumper'),
(46, 'Sapphire', '../Images/Jumper/Sapphire.jpg', 'UCLan Logo Jumper'),
(47, 'Dark Chocolate', '../Images/Jumper/Dark Chocolate.jpg', 'UCLan Logo Jumper'),
(48, 'Orange', '../Images/Jumper/Orange.jpg', 'UCLan Logo Jumper'),
(49, 'Azalea', '../Images/Jumper/Azalea.jpg', 'UCLan Logo Jumper'),
(50, 'Heather Sport Dark Navy', '../Images/Jumper/Heather Sport Dark Navy.jpg', 'UCLan Logo Jumper'),
(51, 'Violet', '../Images/Jumper/Violet.jpg', 'UCLan Logo Jumper'),
(52, 'Royal', '../Images/Jumper/Royal.jpg', 'UCLan Logo Jumper'),
(53, 'Heather Sport Dark Maroon', '../Images/Jumper/Heather Sport Dark Maroon.jpg', 'UCLan Logo Jumper'),
(54, 'Garnet', '../Images/Jumper/Garnet.jpg', 'UCLan Logo Jumper'),
(55, 'Mint Green', '../Images/Jumper/Mint Green.jpg', 'UCLan Logo Jumper'),
(56, 'Heliconia', '../Images/Jumper/Heliconia.jpg', 'UCLan Logo Jumper'),
(57, 'Military Green', '../Images/Jumper/Military Green.jpg', 'UCLan Logo Jumper'),
(58, 'Plum', '../Images/Jumper/Plum.jpg', 'UCLan Logo Jumper'),
(59, 'Antique Sapphire', '../Images/Jumper/Antique Sapphire.jpg', 'UCLan Logo Jumper'),
(60, 'Navy', '../Images/Jumper/Navy.jpg', 'UCLan Logo Jumper'),
(61, 'Heather Sport Graphite', '../Images/Jumper/Heather Sport Graphite.jpg', 'UCLan Logo Jumper'),
(62, 'Sand', '../Images/Jumper/Sand.jpg', 'UCLan Logo Jumper'),
(63, 'Charcoal', '../Images/Jumper/Charcoal.jpg', 'UCLan Logo Jumper'),
(64, 'Paprika', '../Images/Jumper/Paprika.jpg', 'UCLan Logo Jumper'),
(65, 'Heather Sport Royal', '../Images/Jumper/Heather Sport Royal.jpg', 'UCLan Logo Jumper'),
(66, 'Heather Sport Dark Green', '../Images/Jumper/Heather Sport Dark Green.jpg', 'UCLan Logo Jumper'),
(67, 'Purple', '../Images/Jumper/Purple.jpg', 'UCLan Logo Jumper'),
(68, 'Old Gold', '../Images/Jumper/Old Gold.jpg', 'UCLan Logo Jumper'),
(69, 'Gold', '../Images/Jumper/Gold.jpg', 'UCLan Logo Jumper'),
(70, 'Red', '../Images/Jumper/Red.jpg', 'UCLan Logo Jumper'),
(71, 'Forest Green', '../Images/Tshirt/Forest Green.jpg', 'UCLan Logo T-Shirt'),
(72, 'Daisy', '../Images/Tshirt/Daisy.jpg', 'UCLan Logo T-Shirt'),
(73, 'Dark Heather', '../Images/Tshirt/Dark Heather.jpg', 'UCLan Logo T-Shirt'),
(74, 'Irish Green', '../Images/Tshirt/Irish Green.jpg', 'UCLan Logo T-Shirt'),
(75, 'Light Blue', '../Images/Tshirt/Light Blue.jpg', 'UCLan Logo T-Shirt'),
(76, 'Maroon', '../Images/Tshirt/Maroon.jpg', 'UCLan Logo T-Shirt'),
(77, 'Antique Cherry Red', '../Images/Tshirt/Antique Cherry Red.jpg', 'UCLan Logo T-Shirt'),
(78, 'Heather Navy', '../Images/Tshirt/Heather Navy.jpg', 'UCLan Logo T-Shirt'),
(79, 'Heather Military Green', '../Images/Tshirt/Heather Military Green.jpg', 'UCLan Logo T-Shirt'),
(80, 'Black', '../Images/Tshirt/Black.jpg', 'UCLan Logo T-Shirt'),
(81, 'Cherry Red', '../Images/Tshirt/Cherry Red.jpg', 'UCLan Logo T-Shirt'),
(82, 'Cheshnut', '../Images/Tshirt/Cheshnut.jpg', 'UCLan Logo T-Shirt'),
(83, 'Sapphire', '../Images/Tshirt/Sapphire.jpg', 'UCLan Logo T-Shirt'),
(84, 'Dark Chocolate', '../Images/Tshirt/Dark Chocolate.jpg', 'UCLan Logo T-Shirt'),
(85, 'Orange', '../Images/Tshirt/Orange.jpg', 'UCLan Logo T-Shirt'),
(86, 'Cobalt', '../Images/Tshirt/Cobalt.jpg', 'UCLan Logo T-Shirt'),
(87, 'Royal', '../Images/Tshirt/Royal.jpg', 'UCLan Logo T-Shirt'),
(88, 'Heather Purple', '../Images/Tshirt/Heather Purple.jpg', 'UCLan Logo T-Shirt'),
(89, 'Heliconia', '../Images/Tshirt/Heliconia.jpg', 'UCLan Logo T-Shirt'),
(90, 'Heather Royal', '../Images/Tshirt/Heather Royal.jpg', 'UCLan Logo T-Shirt'),
(91, 'Military Green', '../Images/Tshirt/Military Green.jpg', 'UCLan Logo T-Shirt'),
(92, 'Cardinal Red', '../Images/Tshirt/Cardinal Red.jpg', 'UCLan Logo T-Shirt'),
(93, 'Antique Sapphire', '../Images/Tshirt/Antique Sapphire.jpg', 'UCLan Logo T-Shirt'),
(94, 'Navy', '../Images/Tshirt/Navy.jpg', 'UCLan Logo T-Shirt'),
(95, 'Heather Irish Green', '../Images/Tshirt/Heather Irish Green.jpg', 'UCLan Logo T-Shirt'),
(96, 'Heather Orange', '../Images/Tshirt/Heather Orange.jpg', 'UCLan Logo T-Shirt'),
(97, 'Sand', '../Images/Tshirt/Sand.jpg', 'UCLan Logo T-Shirt'),
(98, 'Charcoal', '../Images/Tshirt/Charcoal.jpg', 'UCLan Logo T-Shirt'),
(99, 'Antique Heliconia', '../Images/Tshirt/Antique Heliconia.jpg', 'UCLan Logo T-Shirt'),
(100, 'White', '../Images/Tshirt/White.jpg', 'UCLan Logo T-Shirt'),
(101, 'Kiwi', '../Images/Tshirt/Kiwi.jpg', 'UCLan Logo T-Shirt'),
(102, 'Purple', '../Images/Tshirt/Purple.jpg', 'UCLan Logo T-Shirt'),
(103, 'Red', '../Images/Tshirt/Red.jpg', 'UCLan Logo T-Shirt');

-- --------------------------------------------------------

--
-- Table structure for table `productTypes`
--

CREATE TABLE `productTypes` (
  `productType` varchar(25) NOT NULL,
  `productTypeDescription` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productTypes`
--

INSERT INTO `productTypes` (`productType`, `productTypeDescription`, `price`) VALUES
('UCLan Hoodie', 'cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks', '39.99'),
('UCLan Logo Jumper', 'cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks', '29.99'),
('UCLan Logo T-Shirt', 'cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days', '19.99');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review_title` varchar(255) NOT NULL,
  `review_desc` text NOT NULL,
  `review_rating` enum('1','2','3','4','5') NOT NULL,
  `review_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `product_id`, `review_title`, `review_desc`, `review_rating`, `review_timestamp`) VALUES
(1, 2, 17, 'An excellent quality product', 'The product was delivered quickly and the quality of the material is excellent', '4', '2022-02-20 12:00:00'),
(3, 2, 17, 'Terrible product', 'The product is overpriced and the quality of the material is terrible', '2', '2022-02-20 12:00:00'),
(4, 2, 17, 'Not an outstanding product', 'The product is nothing special and could be considered overpriced.', '3', '2022-02-20 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_full_name` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_full_name`, `user_address`, `user_email`, `user_pass`, `user_timestamp`) VALUES
(1, 'Mark Lochrie', 'CM218, C&T Building, University of Central Lancashire, Preston, PR1 2HE', 'MLochrie@uclan.ac.uk', '$2y$11$qb1ntDRbEvqsXK9It8WUTON/tm4/yNdJcYNWhOAC7VtSCsRCZCUJy', '2021-11-26 10:07:11'),
(2, 'Will Corkill', '123 Park Road', '40019692@student.furness.ac.uk', '$2y$10$5p7ptleRNdEWUFJLRoYoZuPxDTTqBYTrb4jhu.W8BIJwZtk.2jPcS', '2022-02-20 12:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `productTypes`
--
ALTER TABLE `productTypes`
  ADD PRIMARY KEY (`productType`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
