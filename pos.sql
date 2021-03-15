-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for pos
DROP DATABASE IF EXISTS `pos`;
CREATE DATABASE IF NOT EXISTS `pos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pos`;

-- Dumping structure for table pos.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table pos.categories: ~5 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
REPLACE INTO `categories` (`id`, `category`, `date`) VALUES
	(1, 'Category 1', '2021-03-03 22:20:43'),
	(2, 'Category 2', '2021-03-03 22:20:53'),
	(3, 'Category 3', '2021-03-04 21:09:47'),
	(4, 'Category 4', '2021-03-04 21:09:55'),
	(5, 'Category 5', '2021-03-04 21:10:02');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table pos.clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` text,
  `birthdate` date DEFAULT NULL,
  `purchases` int(11) DEFAULT NULL,
  `last_purchase` datetime DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table pos.clients: ~3 rows (approximately)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
REPLACE INTO `clients` (`id`, `name`, `document_id`, `email`, `phone`, `address`, `birthdate`, `purchases`, `last_purchase`, `date`) VALUES
	(1, 'Gilmour', 123, 'test@tets.com', '(09-385234963)', 'asd', '2012-03-12', 32, '2021-03-14 01:14:26', '2021-03-14 01:14:26'),
	(2, 'test', 3333, '123@s.com', '(12-312312312)', '123123', '2012-03-31', 2, '2021-03-14 01:15:41', '2021-03-14 01:15:41'),
	(3, 'test2', 1234, '123@s.com', '(12-312312312)', '123', '2013-12-31', NULL, NULL, '2021-03-14 00:50:47');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Dumping structure for table pos.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `buy_price` float DEFAULT NULL,
  `sell_price` float DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id_idx` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- Dumping data for table pos.products: ~60 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
REPLACE INTO `products` (`id`, `category_id`, `code`, `description`, `image`, `stock`, `buy_price`, `sell_price`, `sales`, `date`) VALUES
	(1, 1, '101', 'Industrial vacuum cleaner', '', 10, 1500, 2100, 10, '2021-03-13 23:15:36'),
	(2, 1, '102', 'Float Plate for Palletizer', '', 15, 4500, 6300, 5, '2021-03-14 01:14:26'),
	(3, 1, '103', 'Air Compressor for painting', '', 13, 3000, 4200, 7, '2021-03-13 23:16:34'),
	(4, 1, '104', 'Adobe Cutter without Disk', '', 18, 4000, 5600, 2, '2021-03-14 01:15:41'),
	(5, 1, '105', 'Floor Cutter without Disk', '', 20, 1540, 2156, NULL, '2021-03-04 20:16:06'),
	(6, 1, '106', 'Diamond Tip Disk', '', 20, 1100, 1540, NULL, '2021-03-04 20:16:06'),
	(7, 1, '107', 'Air extractor', '', 20, 1540, 2156, NULL, '2021-03-04 20:16:06'),
	(8, 1, '108', 'Mower', '', 20, 1540, 2156, NULL, '2021-03-04 20:16:07'),
	(9, 1, '109', 'Electric Water Washer', '', 20, 2600, 3640, NULL, '2021-03-04 20:16:07'),
	(10, 1, '110', 'Petrol pressure washer', '', 10, 2210, 3094, 10, '2021-03-13 23:15:36'),
	(11, 1, '111', 'Gasoline motor pump', '', 20, 2860, 4004, NULL, '2021-03-04 20:16:07'),
	(12, 1, '112', 'Electric motor pump', '', 20, 2400, 3360, NULL, '2021-03-04 20:16:07'),
	(13, 1, '113', 'Circular saw', '', 20, 1100, 1540, NULL, '2021-03-04 20:16:07'),
	(14, 1, '114', 'Tungsten disc for circular saw', '', 20, 4500, 6300, NULL, '2021-03-04 20:16:07'),
	(15, 1, '115', 'Electric welder', '', 20, 1980, 2772, NULL, '2021-03-04 20:16:07'),
	(16, 1, '116', 'Welders face', '', 20, 4200, 5880, NULL, '2021-03-04 20:16:07'),
	(17, 1, '117', 'Illumination tower', '', 20, 1800, 2520, NULL, '2021-03-04 20:16:07'),
	(18, 2, '201', 'Floor Demolishing Hammer 110V', '', 20, 5600, 7840, NULL, '2021-03-04 20:16:07'),
	(19, 2, '202', 'Muela or chisel hammer demolishing floor', '', 20, 9600, 13440, NULL, '2021-03-04 20:16:07'),
	(20, 2, '203', 'Wall Wrecking Drill 110V', '', 20, 3850, 5390, NULL, '2021-03-04 20:16:07'),
	(21, 2, '204', 'Muela or chisel hammer demolition wall', '', 20, 9600, 13440, NULL, '2021-03-04 20:16:07'),
	(22, 2, '205', '1/2 Hammer Drill Wood and Metal', '', 20, 8000, 11200, NULL, '2021-03-04 20:16:07'),
	(23, 2, '206', 'Drill Percussion SDS Plus 110V', '', 20, 3900, 5460, NULL, '2021-03-04 20:16:07'),
	(24, 2, '207', 'Drill Percussion SDS Max 110V (Mining)', '', 20, 4600, 6440, NULL, '2021-03-04 20:16:07'),
	(25, 3, '301', 'Hanging scaffolding', '', 20, 1440, 2016, NULL, '2021-03-04 20:16:07'),
	(26, 3, '302', 'Scaffolding hanging spacer', '', 20, 1600, 2240, NULL, '2021-03-04 20:16:07'),
	(27, 3, '303', 'Modular scaffolding frame', '', 20, 900, 1260, NULL, '2021-03-04 20:16:07'),
	(28, 3, '304', 'Frame scaffolding scissors', '', 20, 100, 140, NULL, '2021-03-04 20:16:07'),
	(29, 3, '305', 'Scaffolding scissors', '', 20, 162, 226.8, NULL, '2021-03-04 20:16:07'),
	(30, 3, '306', 'Internal ladder for scaffolding', '', 20, 270, 378, NULL, '2021-03-04 20:16:07'),
	(31, 3, '307', 'Security handrails', '', 20, 75, 105, NULL, '2021-03-04 20:16:07'),
	(32, 3, '308', 'Rotating wheel for scaffolding', '', 20, 168, 235.2, NULL, '2021-03-04 20:16:07'),
	(33, 3, '309', 'safety harness', '', 20, 1750, 2450, NULL, '2021-03-04 20:16:07'),
	(34, 3, '310', 'Sling for harness', '', 20, 175, 245, NULL, '2021-03-04 20:16:07'),
	(35, 3, '311', 'Metallic Platform', '', 20, 420, 588, NULL, '2021-03-04 20:16:07'),
	(36, 4, '401', '6 Kva Diesel Power Plant', '', 20, 3500, 4900, NULL, '2021-03-04 20:16:07'),
	(37, 4, '402', '10 Kva Diesel Power Plant', '', 20, 3550, 4970, NULL, '2021-03-04 20:16:07'),
	(38, 4, '403', '20 Kva Diesel Power Plant', '', 20, 3600, 5040, NULL, '2021-03-04 20:16:07'),
	(39, 4, '404', '30 Kva Diesel Power Plant', '', 20, 3650, 5110, NULL, '2021-03-04 20:16:07'),
	(40, 4, '405', '60 Kva Diesel Power Plant', '', 20, 3700, 5180, NULL, '2021-03-04 20:16:07'),
	(41, 4, '406', '75 Kva Diesel Power Plant', '', 20, 3750, 5250, NULL, '2021-03-04 20:16:07'),
	(42, 4, '407', '100 Kva Diesel Power Plant', '', 20, 3800, 5320, NULL, '2021-03-04 20:16:07'),
	(43, 4, '408', '120 Kva Diesel Power Plant', '', 20, 3850, 5390, NULL, '2021-03-04 20:16:07'),
	(44, 5, '501', 'Aluminum Scissor Ladder', '', 20, 350, 490, NULL, '2021-03-04 20:16:07'),
	(45, 5, '502', 'Electric extension', '', 20, 370, 518, NULL, '2021-03-04 20:16:07'),
	(46, 5, '503', 'Tensioner cat', '', 20, 380, 532, NULL, '2021-03-04 20:16:07'),
	(47, 5, '504', 'Lamina Covers Gap', '', 20, 380, 532, NULL, '2021-03-04 20:16:08'),
	(48, 5, '505', 'Pipe wrench', '', 20, 480, 672, NULL, '2021-03-04 20:16:08'),
	(49, 5, '506', 'Manila by Metro', '', 20, 600, 840, NULL, '2021-03-04 20:16:08'),
	(50, 5, '507', '2-channel pulley', '', 20, 900, 1260, NULL, '2021-03-04 20:16:08'),
	(51, 5, '508', 'Tensor', '', 20, 100, 140, NULL, '2021-03-04 20:16:08'),
	(52, 5, '509', 'Weighing machine', '', 20, 130, 182, NULL, '2021-03-04 20:16:08'),
	(53, 5, '510', 'Hydrostatic pump', '', 20, 770, 1078, NULL, '2021-03-04 20:16:08'),
	(54, 5, '511', 'Chapeta', '', 20, 660, 924, NULL, '2021-03-04 20:16:08'),
	(55, 5, '512', 'Concrete sample cylinder', '', 20, 400, 560, NULL, '2021-03-04 20:16:08'),
	(56, 5, '513', 'Lever Shear', '', 20, 450, 630, NULL, '2021-03-04 20:16:08'),
	(57, 5, '514', 'Scissor Shear', '', 20, 580, 812, NULL, '2021-03-04 20:16:08'),
	(58, 5, '515', 'Pneumatic tire car', '', 20, 420, 588, NULL, '2021-03-04 20:16:08'),
	(59, 5, '516', 'Cone slump', '', 20, 140, 196, NULL, '2021-03-04 20:16:08'),
	(60, 5, '517', 'Baldosin cutter', '', 20, 930, 1302, NULL, '2021-03-04 20:16:08');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table pos.sales
DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `tax` int(11) DEFAULT NULL,
  `net_price` float DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `payment_method` varchar(200) DEFAULT NULL,
  `sale_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `client_id_idx` (`client_id`),
  KEY `seller_id_idx` (`seller_id`),
  CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `seller_id` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table pos.sales: ~4 rows (approximately)
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
REPLACE INTO `sales` (`id`, `code`, `client_id`, `seller_id`, `products`, `tax`, `net_price`, `total_price`, `payment_method`, `sale_date`) VALUES
	(1, 10001, 1, 1, '[{"id":"1","description":"Industrial vacuum cleaner","quantity":"10","stock":"10","net_price":"2100","total_price":"21000"},{"id":"10","description":"Petrol pressure washer","quantity":"10","stock":"10","net_price":"3094","total_price":"30940"}]', 5194, 51940, 57134, 'cash', '2021-03-13 23:15:36'),
	(2, 10002, 1, 1, '[{"id":"2","description":"Float Plate for Palletizer","quantity":"3","stock":"17","net_price":"6300","total_price":"18900"},{"id":"3","description":"Air Compressor for painting","quantity":"7","stock":"13","net_price":"4200","total_price":"29400"}]', 483, 48300, 48783, 'cash', '2021-03-13 23:16:34'),
	(3, 10002, 1, 1, '[{"id":"2","description":"Float Plate for Palletizer","quantity":"2","stock":"15","net_price":"6300","total_price":"12600"}]', 252, 12600, 12852, 'cash', '2021-03-14 01:14:26'),
	(4, 10002, 2, 1, '[{"id":"4","description":"Adobe Cutter without Disk","quantity":"2","stock":"18","net_price":"5600","total_price":"11200"}]', 224, 11200, 11424, 'cash', '2021-03-14 01:15:41');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;

-- Dumping structure for table pos.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` enum('administrator','special','seller') NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table pos.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `username`, `password`, `role`, `picture`, `status`, `last_login`, `date`) VALUES
	(1, 'User Admin', 'admin', '$2a$07$K3k123lMaO54LtYstringeuNXplzhKSU9ypCNowekq3vf95uhVpmi', 'administrator', '', 1, '2021-03-03 19:54:00', '2021-03-01 12:21:43');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
