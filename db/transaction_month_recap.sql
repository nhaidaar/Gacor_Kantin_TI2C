-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2023 at 10:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Structure for view `transaction_month_recap`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaction_month_recap`  AS SELECT `p`.`product_name` AS `product_name`, month(`t`.`date`) AS `month_sold`, year(`t`.`date`) AS `year_sold`, sum(`ti`.`qty`) AS `qty_sold`, sum(`ti`.`qty` * `p`.`selling_price`) AS `income` FROM ((`transactions` `t` join `transaction_items` `ti` on(`t`.`id` = `ti`.`id`)) join `product` `p` on(`p`.`id` = `ti`.`id`)) GROUP BY `p`.`product_name`, month(`t`.`date`), year(`t`.`date`)  ;

--
-- VIEW `transaction_month_recap`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
