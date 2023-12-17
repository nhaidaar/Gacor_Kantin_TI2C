-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2023 at 02:22 PM
-- Server version: 10.11.2-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkantin`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_product_log`
--

CREATE TABLE `add_product_log` (
  `id` int(11) NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `date` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(225) NOT NULL,
  `stocks` int(11) NOT NULL,
  `buying_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `status` enum('approved','pending','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_product_log`
--

INSERT INTO `add_product_log` (`id`, `product_name`, `date`, `category_id`, `description`, `stocks`, `buying_price`, `selling_price`, `status`) VALUES
(1, 'Pop Mie Rasa Ayam', '2023-12-01', 1, '', 50, 5000, 7000, 'approved'),
(2, 'Teh Pucuk Harum', '2023-12-10', 2, '', 100, 3000, 4000, 'approved');

--
-- Triggers `add_product_log`
--
DELIMITER $$
CREATE TRIGGER `after_approve_product` AFTER UPDATE ON `add_product_log` FOR EACH ROW BEGIN
    IF NEW.status = 'approved' THEN
        INSERT INTO product (product_name, category_id, description, stocks, buying_price, selling_price, isHidden)
        VALUES (NEW.product_name, NEW.category_id, NEW.description, NEW.stocks, NEW.buying_price, NEW.selling_price, FALSE);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `add_stock_log`
--

CREATE TABLE `add_stock_log` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stocks` int(11) NOT NULL,
  `status` enum('approved','pending','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `add_stock_log`
--
DELIMITER $$
CREATE TRIGGER `add_stock_trigger` AFTER INSERT ON `add_stock_log` FOR EACH ROW BEGIN
    DECLARE product_stock INT;

    -- Get the current stock of the product
    SELECT stocks INTO product_stock
    FROM product
    WHERE id = NEW.product_id;

    -- Update the product stock after adding new stock
    UPDATE product
    SET stocks = product_stock + NEW.stocks
    WHERE id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Snack'),
(2, 'Beverage'),
(3, 'Meal');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(225) NOT NULL,
  `stocks` int(100) NOT NULL,
  `buying_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `isHidden` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `category_id`, `description`, `stocks`, `buying_price`, `selling_price`, `isHidden`) VALUES
(1, 'Cheetos 15g', 1, '', 100, 1500, 2500, 0),
(2, 'Taro Net 32g', 1, '', 100, 3500, 5000, 0),
(3, 'Potabee Potato Chips 15g', 1, '', 100, 1500, 2500, 0),
(4, 'Garuda Rosta 25g', 1, '', 100, 4000, 5000, 0),
(5, 'Pop Mie Rasa Ayam', 1, '', 50, 5000, 7000, 0),
(6, 'Teh Pucuk Harum', 2, '', 100, 3000, 4000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `date`, `user_id`) VALUES
(1, '2023-12-01 12:30:00', 2),
(2, '2023-12-01 10:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` int(11) NOT NULL,
  `transactions_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transactions_id`, `product_id`, `qty`, `total_price`) VALUES
(1, 1, 4, 2, 10000),
(2, 1, 1, 2, 5000);

--
-- Triggers `transaction_items`
--
DELIMITER $$
CREATE TRIGGER `reduce_stock_trigger` AFTER INSERT ON `transaction_items` FOR EACH ROW BEGIN
    DECLARE product_stock INT;

    -- Get the current stock of the product
    SELECT stocks INTO product_stock
    FROM product
    WHERE id = NEW.product_id;

    -- Update the product stock after the purchase
    UPDATE product
    SET stocks = product_stock - NEW.qty
    WHERE id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `level`) VALUES
(1, 'admin', '1234', 'Kaprodi', 'admin'),
(2, 'user', '1357', 'Pak Kantin', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_product_log`
--
ALTER TABLE `add_product_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `add_stock_log`
--
ALTER TABLE `add_stock_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_id` (`transactions_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_product_log`
--
ALTER TABLE `add_product_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `add_stock_log`
--
ALTER TABLE `add_stock_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_product_log`
--
ALTER TABLE `add_product_log`
  ADD CONSTRAINT `add_product_log_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `add_stock_log`
--
ALTER TABLE `add_stock_log`
  ADD CONSTRAINT `add_stock_log_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transactions_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
