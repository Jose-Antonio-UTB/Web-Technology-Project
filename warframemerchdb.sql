-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2025 at 08:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warframemerchdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`) VALUES
(1201, 'Tees', 'T-Shirts '),
(1202, 'Accessories', 'Accessories'),
(1204, 'Featured', 'Bundles and Collectibles');

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `stocks` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `price`, `description`, `image_url`, `stocks`) VALUES
(3010, 1201, 'Styanax T-Shirt', 5.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/VeilbreakerStoreImages_StyanaxShirt_Front_1080x1080_164abb3d-1ce8-4915-8095-6b72c533a092_540x.png?v=1662508000', 100),
(3011, 1201, 'Mesa T-Shirt', 5.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/Tennocon-Store-Images-Mesa-T-Front_540x.png?v=1657904526', 98),
(3012, 1201, 'New War Lotus T-Shirt', 3.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/TNW-Merch-Tee-Front_540x.png?v=1727964188', 96),
(3013, 1201, 'Nezha and Wukong T-Shirt', 5.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/Nezha_WukongT-Shirt_Front_900x.png?v=1741803080', 94),
(3014, 1201, 'Rhino T-Shirt', 5.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/RhinoT-Shirt_Front_540x.png?v=1632350047', 97),
(3015, 1201, 'Excalibur T-Shirt', 5.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/ExcaliburT-Shirt_Mockup_Front_540x.png?v=1626226596', 97),
(3016, 1201, '1999 Graffiti T-Shirt - Aoi', 5.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/Aoi-Shirt-Front_540x.png?v=1734028873', 50),
(3017, 1201, 'Mirage & Loki T-Shirt', 5.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/TC2021-TShirts-Mirage_Loki_Front_900x.png?v=1624994513', 100),
(3018, 1201, '11 Year Anniversary T-Shirt', 10.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/11-Yr-T-Shirt-FRONT_585a2a77-462b-4ea3-9daf-e02e3da281a3_900x.png?v=1710438901', 30),
(3019, 1201, 'Villains Shirt 2.0', 5.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/Villains-collection-T-FRONT_540x.png?v=1602793227', 99),
(3020, 1201, '1999 Graffiti T-Shirt - The Major', 10.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/Rusalkai-Shirt-Back_540x.png?v=1734029691', 30),
(3021, 1201, 'Lotus Navy T-Shirt 3.0', 5.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/TC2021-TShirts-Lotus_Front_540x.png?v=1624994615', 100),
(3022, 1202, 'Atomicycle Key', 10.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/Key-Necklace_540x.png?v=1734028038', 50),
(3023, 1202, 'Alignment Pin Set', 10.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/Alignment_Pin_Box_REV_1_540x.png?v=1739292105', 30),
(3024, 1202, 'Operator Umbra Earrings', 20.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/Umbra-Earrings_1080x.png?v=1692282299', 27),
(3025, 1202, 'Conquera Tumbler Cup', 15.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/QTCC-All-Product-Images_Tumbler_1_540x.png?v=1695316467', 29),
(3026, 1202, 'The New War PVC Patch Set', 10.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/TNW-Product-Images-All-Patches_540x.png?v=1639453446', 49),
(3027, 1202, 'Warframe x Champion Cotton Twill Hat', 10.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/TC-2024-New-ProductChampion_Cap-Front_540x.png?v=1720646496', 30),
(3028, 1202, 'Stalker Hat', 7.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/Dad-Hat-Front_de1784fd-a420-4e2f-93f7-d981beeefe5f_900x.png?v=1718395435', 20),
(3029, 1202, 'Dr. Entrati Hat', 7.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/TC-2024-New-Product-Entrati_Hat_Side_900x.png?v=1720646107', 20),
(3030, 1204, '1999 Mega Bundle - The Major', 40.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/WF1999-Collection-General-Grouping_1800x1800.png?v=1734031945', 20),
(3031, 1204, '1999 Mega Bundle - Aoi', 40.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/WF1999-Collection-Aoi-Grouping_900x.png?v=1734032013', 20),
(3032, 1204, '1999 Mega Bundle - Big Bytes Pizza', 40.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/WF1999-Collection-BBPizza-Grouping_1_900x.png?v=1734106507', 15),
(3033, 1204, 'Warframe: 1999 Official Soundtrack 2xLP', 20.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/WF-1999-Album_720x.png?v=1734726705', 17),
(3034, 1204, 'Warframe Portrait Pin Collection 1', 15.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/Pins-4800v2_540x.png?v=1626226431', 11),
(3035, 1204, 'Warframe Portrait Pin Collection 2', 15.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/Warframe_Portrait_Pin_Collection_2_540x.png?v=1632350712', 15),
(3036, 1204, 'Duviri Paradox Pin', 5.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/products/Duviri-Pin_720x.png?v=1681764185', 100),
(3037, 1204, 'Ordis Embodied Floof Plush', 10.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'https://store.warframe.com/cdn/shop/files/QTCC-Ordis-Floof-In-Game-BONUS_540x.png?v=1727729171', 30);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `item_cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `user_role`) VALUES
(1000, 'AdminUser', 'admin@gmail.com', 'adminpassword', 'Admin'),
(1001, 'John Order', 'john.o@gmail.com', 'johnorderpass', 'Customer'),
(1002, 'Bob Buys', 'bob.b@gmail.com', 'bobbuyspass', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`item_cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1205;

--
-- AUTO_INCREMENT for table `orderlist`
--
ALTER TABLE `orderlist`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3038;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `item_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD CONSTRAINT `orderlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
