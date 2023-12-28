-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2023 at 05:04 PM
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
-- Table structure for table `notification_activities_log`
--

CREATE TABLE `notification_activities_log` (
  `id` int(11) NOT NULL,
  `request_product_id` int(11) DEFAULT NULL,
  `request_stock_id` int(11) DEFAULT NULL,
  `description` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_activities_log`
--

INSERT INTO `notification_activities_log` (`id`, `request_product_id`, `request_stock_id`, `description`, `status`, `date`) VALUES
(1, 1, NULL, 'request new product', 'pending', '2023-12-27 22:21:33'),
(2, 1, NULL, 'confirmation product', 'approved', '2023-12-27 22:22:06'),
(3, NULL, 6, 'request stock', 'pending', '2023-12-27 22:23:21'),
(4, NULL, 6, 'confirmation stock', 'approved', '2023-12-27 22:23:31');

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
(1, 'Cheetos 15g', 1, '', 250, 1500, 2500, 0),
(2, 'Taro Net 32g', 1, '', 100, 3500, 5000, 0),
(3, 'Potabee Potato Chips 15g', 1, '', 99, 1500, 2500, 0),
(4, 'Garuda Rosta 25g', 1, '', 100, 4000, 5000, 0),
(5, 'Pop Mie Rasa Ayam', 1, '', 50, 5000, 7000, 0),
(6, 'Teh Pucuk Harum', 2, '', 125, 3000, 4000, 0),
(28, 'jancok', 2, 'jancoooookkk', 100, 1000, 10000, 0),
(29, 'lemper', 2, 'cihuy', 50, 1000, 2500, 0);

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `log_new_product` AFTER INSERT ON `product` FOR EACH ROW BEGIN
    -- Log new product
    INSERT INTO product_activities_log (product_name, added_stocks, description)
    VALUES (NEW.product_name, NEW.stocks, 'new product');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_product_changes` AFTER UPDATE ON `product` FOR EACH ROW BEGIN
    -- Log added stocks
    IF NEW.stocks > OLD.stocks THEN        
        INSERT INTO product_activities_log (product_name, added_stocks, description)
        VALUES (NEW.product_name, (NEW.stocks - OLD.stocks), 'restock');
    
    -- Log renew product
    ELSEIF NEW.isHidden = 0 AND OLD.isHidden = 1 THEN
        INSERT INTO product_activities_log (product_name, added_stocks, description)
        VALUES (NEW.product_name, NEW.stocks, 'renew product');
    END IF;
    
    -- Log deleted product
    IF NEW.isHidden = 1 THEN
        INSERT INTO product_activities_log (product_name, description)
        VALUES (NEW.product_name, 'delete product');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_activities_log`
--

CREATE TABLE `product_activities_log` (
  `id` int(11) NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `added_stocks` int(11) DEFAULT NULL,
  `description` varchar(225) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_activities_log`
--

INSERT INTO `product_activities_log` (`id`, `product_name`, `added_stocks`, `description`, `date`) VALUES
(22, 'jancok', 100, 'new product', '2023-12-27 22:16:59'),
(23, 'lemper', 25, 'new product', '2023-12-27 22:22:06'),
(24, 'lemper', 25, 'restock', '2023-12-27 22:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `request_product`
--

CREATE TABLE `request_product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `date` datetime NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(225) NOT NULL,
  `stocks` int(11) NOT NULL,
  `buying_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `status` enum('approved','pending','rejected') NOT NULL DEFAULT 'pending',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_product`
--

INSERT INTO `request_product` (`id`, `product_name`, `date`, `category_id`, `description`, `stocks`, `buying_price`, `selling_price`, `status`, `user_id`) VALUES
(1, 'lemper', '2023-12-27 15:20:12', 2, 'cihuy', 25, 1000, 2500, 'approved', 2);

--
-- Triggers `request_product`
--
DELIMITER $$
CREATE TRIGGER `add_product` AFTER UPDATE ON `request_product` FOR EACH ROW BEGIN
    IF NEW.status = 'approved' THEN
        INSERT INTO product (product_name, category_id, description, stocks, buying_price, selling_price, isHidden)
        VALUES (NEW.product_name, NEW.category_id, NEW.description, NEW.stocks, NEW.buying_price, NEW.selling_price, FALSE);
        -- Log request product
    INSERT INTO notification_activities_log (request_product_id, description, status)
    VALUES (NEW.id, 'confirmation product', NEW.status);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_request_product` AFTER INSERT ON `request_product` FOR EACH ROW BEGIN
    -- Log request product
    INSERT INTO notification_activities_log (request_product_id, description, status)
    VALUES (NEW.id, 'request new product', NEW.status);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `request_stock`
--

CREATE TABLE `request_stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `stocks` int(11) NOT NULL,
  `status` enum('approved','pending','rejected') NOT NULL DEFAULT 'pending',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_stock`
--

INSERT INTO `request_stock` (`id`, `product_id`, `date`, `stocks`, `status`, `user_id`) VALUES
(3, 1, '2023-12-19 20:54:05', 100, 'approved', 2),
(4, 1, '2023-12-24 08:52:22', 50, 'approved', 2),
(5, 6, '2023-12-24 08:59:06', 25, 'approved', 2),
(6, 29, '2023-12-27 15:23:02', 25, 'approved', 2);

--
-- Triggers `request_stock`
--
DELIMITER $$
CREATE TRIGGER `add_stock` AFTER UPDATE ON `request_stock` FOR EACH ROW BEGIN
    IF NEW.status = 'approved' THEN
        UPDATE product
        SET stocks = stocks + NEW.stocks
        WHERE id = NEW.product_id;
        
    -- Log request stock
    INSERT INTO notification_activities_log (request_stock_id, description, status)
    VALUES (NEW.id, 'confirmation stock', NEW.status);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_request_stock` AFTER INSERT ON `request_stock` FOR EACH ROW BEGIN
    -- Log request stock
    INSERT INTO notification_activities_log (request_stock_id, description, status)
    VALUES (NEW.id, 'request stock', NEW.status);
END
$$
DELIMITER ;

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
(2, '2023-12-01 10:00:00', 2),
(3, '2023-12-19 20:26:14', 2),
(5, '2023-12-28 17:03:48', 2);

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `log_transactions` AFTER INSERT ON `transactions` FOR EACH ROW INSERT INTO transactions_activities_log (transaction_id) VALUES (NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions_activities_log`
--

CREATE TABLE `transactions_activities_log` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions_activities_log`
--

INSERT INTO `transactions_activities_log` (`id`, `transaction_id`, `date`) VALUES
(1, 5, '2023-12-29 00:03:52');

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
(2, 1, 1, 2, 5000),
(3, 3, 3, 1, 2500);

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
-- Stand-in structure for view `transaction_month_recap`
-- (See below for the actual view)
--
CREATE TABLE `transaction_month_recap` (
`product_name` varchar(225)
,`month` int(2)
,`year` int(4)
,`qty_sold` decimal(32,0)
,`income` double
);

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

-- --------------------------------------------------------

--
-- Structure for view `transaction_month_recap`
--
DROP TABLE IF EXISTS `transaction_month_recap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`akfalah`@`localhost` SQL SECURITY DEFINER VIEW `transaction_month_recap`  AS SELECT `p`.`product_name` AS `product_name`, month(`t`.`date`) AS `month`, year(`t`.`date`) AS `year`, sum(`ti`.`qty`) AS `qty_sold`, sum(`ti`.`qty` * `p`.`selling_price`) AS `income` FROM ((`transactions` `t` join `transaction_items` `ti` on(`t`.`id` = `ti`.`id`)) join `product` `p` on(`p`.`id` = `ti`.`id`)) GROUP BY `p`.`product_name`, month(`t`.`date`), year(`t`.`date`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_activities_log`
--
ALTER TABLE `notification_activities_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notification_log2` (`request_stock_id`),
  ADD KEY `fk_notification_log1` (`request_product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_activities_log`
--
ALTER TABLE `product_activities_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_product`
--
ALTER TABLE `request_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `request_stock`
--
ALTER TABLE `request_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions_activities_log`
--
ALTER TABLE `transactions_activities_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification_activities_log`
--
ALTER TABLE `notification_activities_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_activities_log`
--
ALTER TABLE `product_activities_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `request_product`
--
ALTER TABLE `request_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request_stock`
--
ALTER TABLE `request_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions_activities_log`
--
ALTER TABLE `transactions_activities_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notification_activities_log`
--
ALTER TABLE `notification_activities_log`
  ADD CONSTRAINT `fk_notification_log1` FOREIGN KEY (`request_product_id`) REFERENCES `request_product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_notification_log2` FOREIGN KEY (`request_stock_id`) REFERENCES `request_stock` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `request_product`
--
ALTER TABLE `request_product`
  ADD CONSTRAINT `request_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `request_product_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `request_stock`
--
ALTER TABLE `request_stock`
  ADD CONSTRAINT `request_stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `request_stock_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `transactions_activities_log`
--
ALTER TABLE `transactions_activities_log`
  ADD CONSTRAINT `transactions_activities_log_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

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
