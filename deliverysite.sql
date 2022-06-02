-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2022 at 10:27 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deliverysite`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Image_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id`, `Title`, `Image_name`) VALUES
(6, 'Ciorba', 'ciorba.jpg'),
(7, 'Pui', 'pui.jpg'),
(8, 'Porc', 'porc.jpg'),
(11, 'Vita', 'vita.jpg'),
(12, 'Peste', 'peste.jpg'),
(13, 'Paste', 'paste.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `Id` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Image_name` varchar(30) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Category_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`Id`, `Title`, `Description`, `Image_name`, `Price`, `Category_Id`) VALUES
(3, 'Ciorba radauteana', '(oase vită, pui, ou, smântână, morcovi, păstârnac, ţelină, usturoi, ardei iute, gogosar murat, ceapă, condimente)', 'radauteana.jpg', 20, 6),
(4, 'Ciorba de burta', '(oase vită, burtă vită, ou, smântână, morcovi, ţelină, păstârnac, usturoi, ardei iute, gogoşar murat, ceapă, condimente)', 'burta.jpg', 20, 6),
(5, 'Piept de pui la gratar cu ratatouille', '(piept pui, vinete, dovlecei, roşii, cartofi dulci, ceapă, usturoi, ierburi aromatice)', 'puiratatouille.jpg', 49, 7),
(6, 'Snitel din piept de pui cu ratatouille', '(piept pui, pesmet, ou, cartofi, unt, usturoi, ierburi aromatice)', 'snitelpui.jpg', 49, 7),
(7, 'Snitel porc cu cartofi prajiti si sos tartar', '(muşchiuleţ de porc, lapte, ou, pesmet, cartofi, maioneză, castraveţi muraţi, capere, ceapă)', 'snitelporc.jpg', 59, 8),
(8, 'Carne la garnita cu mamaliguta', '(piept porc, cârnaţi afumaţi, muchiuleţ porc, untură porc, făină de mălai, lapte, unt)', 'garnita.jpg', 45, 8);

-- --------------------------------------------------------

--
-- Table structure for table `orderedfood`
--

CREATE TABLE `orderedfood` (
  `Id` int(11) NOT NULL,
  `FoodId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `OrderId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderedfood`
--

INSERT INTO `orderedfood` (`Id`, `FoodId`, `Quantity`, `OrderId`) VALUES
(2, 3, 1, 5),
(3, 6, 1, 6),
(4, 6, 1, 7),
(5, 7, 1, 7),
(6, 8, 1, 7),
(7, 3, 1, 7),
(8, 6, 1, 8),
(9, 7, 1, 8),
(10, 8, 1, 8),
(11, 3, 1, 8),
(12, 4, 1, 9),
(13, 4, 1, 11),
(14, 3, 1, 12),
(15, 5, 1, 16),
(16, 6, 1, 16),
(17, 4, 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `ClientName` varchar(100) NOT NULL,
  `ClientPhone` varchar(14) NOT NULL,
  `ClientAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `OrderDate`, `ClientName`, `ClientPhone`, `ClientAddress`) VALUES
(5, '2022-05-26 19:20:17', 'Bogdan', '0759999999', 'Strada straziiiiiiiiiii'),
(6, '2022-05-26 19:21:40', 'Bogdan', '0759999999', 'Strada straziiiiiiiiiii'),
(7, '2022-05-26 19:22:13', 'Bogdan', '0759999999', 'Strada straziiiiiiiiiii'),
(8, '2022-05-26 19:23:55', 'Bogdan', '0759999999', 'Strada straziiiiiiiiiii'),
(9, '2022-05-26 19:24:10', 'Bogdan', '0759999999', 'Strada straziiiiiiiiiii'),
(10, '2022-05-26 19:24:20', 'Bogdan', '0759999999', 'Strada straziiiiiiiiiii'),
(11, '2022-05-30 19:12:42', 'Bogdan', '0759999999', 'Strada straziiiiiiiiiii'),
(12, '2022-05-31 12:26:09', 'adsad', 'sdasda', 'asdadsa'),
(13, '2022-05-31 12:28:10', 'adsad', 'sdasda', 'asdadsa'),
(14, '2022-05-31 12:28:23', 'adsad', 'sdasda', 'asdadsa'),
(15, '2022-05-31 12:29:39', 'adsad', 'sdasda', 'asdadsa'),
(16, '2022-05-31 12:46:45', 'Bogdan', '0759999999', 'Strada straziiiiiiiiiii');

-- --------------------------------------------------------

--
-- Table structure for table `ordertouser`
--

CREATE TABLE `ordertouser` (
  `IdUser` int(11) NOT NULL,
  `IdOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordertouser`
--

INSERT INTO `ordertouser` (`IdUser`, `IdOrder`) VALUES
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `address`, `phone`, `email`) VALUES
(1, 'BogdanR', '$2y$10$Yp9bV5tCmkwGyrA2ylkcbOTDg032zEMQ3LFCPGmLEj/ZNZljZznTq', '2022-04-12 14:06:22', NULL, NULL, NULL),
(2, 'Smecher', '$2y$10$If/zVsWnV8toUrC7dlp30ujp5CM5kolRned6KUMVZg3dAKf.hXoA.', '2022-04-12 14:36:27', 'Strada', '0711111111', 'smecher@mail.ro'),
(3, 'Bogdan', '$2y$10$.GKoVeqD0D77Ee45oEPdx.I.OmBlQbyygf6oIwys3BEorr1FhT37e', '2022-05-24 13:01:52', 'Strada straziiiiiiiiiii', '0759999999', 'bogdan@mail.com'),
(4, 'Bogdan2', '$2y$10$SsRZgfWEntlPrAIknWuYSunVLIb93AxdrtP7zn9UMGqRDdZL8URxi', '2022-05-30 20:12:06', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Category_Id` (`Category_Id`);

--
-- Indexes for table `orderedfood`
--
ALTER TABLE `orderedfood`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FoodId` (`FoodId`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `ordertouser`
--
ALTER TABLE `ordertouser`
  ADD PRIMARY KEY (`IdUser`,`IdOrder`),
  ADD KEY `IdOrder` (`IdOrder`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orderedfood`
--
ALTER TABLE `orderedfood`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ordertouser`
--
ALTER TABLE `ordertouser`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`Category_Id`) REFERENCES `categories` (`Id`);

--
-- Constraints for table `orderedfood`
--
ALTER TABLE `orderedfood`
  ADD CONSTRAINT `orderedfood_ibfk_1` FOREIGN KEY (`FoodId`) REFERENCES `food` (`Id`),
  ADD CONSTRAINT `orderedfood_ibfk_2` FOREIGN KEY (`OrderId`) REFERENCES `orders` (`Id`);

--
-- Constraints for table `ordertouser`
--
ALTER TABLE `ordertouser`
  ADD CONSTRAINT `ordertouser_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ordertouser_ibfk_3` FOREIGN KEY (`IdOrder`) REFERENCES `orders` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
