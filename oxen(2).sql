-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2017 at 02:45 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oxen`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_watch`(IN `user` INT, IN `rule` INT, OUT `result` VARCHAR(100))
    NO SQL
begin
insert into watch values (rule, user, 0, NOW());
set result = 'Watch added.';
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `new_bid`(IN `user` INT, IN `rule` INT, OUT `status_id` INT, IN `bid` INT, OUT `comment` VARCHAR(50))
    NO SQL
begin 


	if (now() <= (select end_date from rules r inner join auction a on a.auction_id=r.auction_id where rule_id=rule)) THEN 
 
	    set @highest_bid = (select price from h_bid where rule_id=rule);
    
 		if (@highest_bid IS NULL) THEN
        	set status_id = 1;
            set comment = 'Bid pertamax.';
            
        elseif (bid <= @highest_bid) THEN
            set status_id = 4; 
            set comment = concat('Bid terlalu kecil (sekarang: Rp ',@highest_bid,')');
    	
        else
    		set status_id=2; 
            set comment='Bid diterima.';
    	
        end if;  
         
	else 	
	
    	set status_id=9; set comment='Sorry, waktu lelang telah tutup.';
    
end if;

insert into bids value ('',user,rule,now(),bid,status_id);

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `remove_watch`(IN `user` INT, IN `rule` INT, OUT `result` VARCHAR(30))
    NO SQL
begin
delete from watch where user_Id=user and rule_id=rule;
set result = 'Not watched anymore.';
End$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE IF NOT EXISTS `auction` (
  `auction_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `auction_title` varchar(150) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `create_date` datetime NOT NULL,
  `active` int(1) NOT NULL,
  `injury_time` int(2) NOT NULL,
  `extension_period` int(2) NOT NULL,
  `extension_count` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`auction_id`, `seller_id`, `auction_title`, `start_date`, `end_date`, `create_date`, `active`, `injury_time`, `extension_period`, `extension_count`) VALUES
(1, 1, 'Lelang OP Buang Sial', '2017-05-29 00:00:00', '2017-07-16 02:13:00', '2017-05-29 00:00:00', 1, 0, 0, 0),
(2, 1, 'Lelang Sipatogelang', '2017-05-27 00:00:00', '2017-06-05 00:00:00', '2017-05-27 00:00:00', 0, 0, 0, 0),
(3, 2, 'Lelang Aneka Rupa', '2017-07-12 00:00:00', '2017-07-19 00:00:00', '2017-07-12 00:00:00', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE IF NOT EXISTS `bids` (
`Bid_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Rule_Id` int(11) NOT NULL,
  `Bid_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Bid_Value` int(11) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`Bid_Id`, `User_Id`, `Rule_Id`, `Bid_Date`, `Bid_Value`, `Status`) VALUES
(1, 100, 1, '2017-05-29 11:29:12', 10000, 1),
(2, 500, 2, '2017-05-29 15:40:42', 25000, 9),
(3, 275, 1, '2017-05-29 15:41:08', 10000, 4),
(4, 223, 1, '2017-05-29 15:41:32', 15000, 1),
(7, 212, 1, '2017-05-29 16:13:26', 20000, 1),
(8, 287, 1, '2017-05-29 16:16:06', 20000, 4),
(9, 298, 1, '2017-05-29 16:16:24', 25000, 1),
(10, 279, 2, '2017-05-29 16:22:04', 5000, 9),
(14, 134, 2, '2017-05-29 16:32:32', 5000, 1),
(15, 210, 2, '2017-05-29 16:33:26', 10000, 9),
(16, 275, 1, '2017-05-30 14:36:54', 15000, 4),
(17, 241, 1, '2017-05-30 14:55:26', 17500, 4),
(18, 79, 1, '2017-05-30 14:56:22', 19000, 4),
(19, 104, 1, '2017-05-30 14:57:53', 21000, 4),
(20, 236, 2, '2017-05-30 14:58:31', 21000, 9),
(21, 18, 2, '2017-05-30 14:58:59', 21000, 9),
(22, 179, 2, '2017-05-30 14:59:18', 21000, 9),
(23, 233, 2, '2017-05-30 14:59:30', 21000, 9),
(24, 317, 1, '2017-05-30 14:59:36', 22000, 4),
(25, 210, 2, '2017-05-30 15:00:22', 19500, 9),
(26, 22, 1, '2017-05-30 15:01:45', 22500, 4),
(27, 216, 1, '2017-05-30 15:03:14', 24500, 4),
(28, 9, 2, '2017-05-30 15:03:25', 24500, 9),
(29, 8, 1, '2017-05-30 15:07:25', 30000, 2),
(30, 28, 3, '2017-05-30 15:08:35', 5000, 1),
(31, 123, 2, '2017-05-31 16:08:11', 15000, 9),
(32, 313, 2, '2017-05-31 16:10:55', 15000, 9),
(33, 229, 2, '2017-05-31 16:11:08', 15000, 9),
(34, 159, 2, '2017-05-31 16:11:49', 15000, 9),
(35, 236, 1, '2017-05-31 16:12:00', 15000, 9),
(36, 63, 3, '2017-05-31 16:12:12', 15000, 9),
(41, 21, 1, '2017-05-31 16:15:36', 15000, 4),
(44, 287, 1, '2017-05-31 16:18:32', 15000, 4),
(45, 331, 2, '2017-05-31 16:18:38', 15000, 9),
(58, 258, 2, '2017-05-31 16:21:54', 15000, 9),
(59, 90, 2, '2017-05-31 16:22:35', 15000, 9),
(60, 146, 2, '2017-05-31 16:23:51', 15000, 9),
(61, 181, 2, '2017-05-31 16:24:14', 15000, 9),
(62, 82, 2, '2017-05-31 16:26:21', 15000, 9),
(63, 318, 2, '2017-05-31 16:26:42', 15000, 9),
(64, 49, 2, '2017-05-31 16:27:11', 15000, 9),
(65, 140, 2, '2017-05-31 16:27:23', 15000, 9),
(66, 301, 2, '2017-05-31 16:27:38', 15000, 9),
(67, 60, 1, '2017-05-31 16:27:58', 15000, 4),
(68, 126, 1, '2017-05-31 16:30:41', 15000, 4),
(70, 23, 1, '2017-05-31 16:34:47', 16000, 4),
(71, 25, 3, '2017-05-31 16:39:12', 5000, 4),
(72, 25, 3, '2017-05-31 16:39:34', 5000, 4),
(73, 6, 3, '2017-05-31 16:40:14', 5000, 4),
(74, 324, 1, '2017-05-31 16:41:31', 10000, 4),
(79, 1, 1, '2017-05-31 16:47:26', 25000, 4),
(81, 22, 1, '2017-05-31 16:56:17', 25000, 4),
(82, 1, 1, '2017-05-31 16:56:27', 35000, 2),
(83, 121, 1, '2017-05-31 16:56:44', 35000, 4),
(84, 105, 3, '2017-05-31 16:58:17', 10000, 2),
(85, 105, 2, '2017-06-01 01:22:05', 9000, 9),
(86, 139, 1, '2017-06-01 13:34:44', 30000, 4),
(87, 23, 1, '2017-06-04 11:46:49', 15000, 9),
(88, 2, 2, '2017-06-04 11:48:54', 17500, 9),
(89, 2, 33, '2017-06-04 12:27:57', 25000, 9),
(92, 23, 2, '2017-06-04 12:31:53', 10000, 1),
(93, 22, 2, '2017-06-04 12:33:08', 10000, 1),
(94, 211, 2, '2017-06-04 12:34:16', 10000, 1),
(95, 190, 1, '2017-06-29 22:38:35', 5000, 9),
(96, 164, 1, '2017-06-29 22:38:55', 5000, 4),
(97, 29, 0, '2017-06-29 22:53:07', 30000, 9),
(98, 246, 0, '2017-06-29 22:53:14', 30000, 9),
(99, 285, 0, '2017-06-29 22:53:24', 30000, 9),
(100, 205, 1, '2017-06-29 22:55:51', 30000, 4),
(101, 104, 1, '2017-06-29 22:57:58', 30000, 4),
(102, 215, 1, '2017-06-29 22:58:19', 30000, 4),
(103, 326, 1, '2017-06-29 23:00:13', 30000, 4),
(104, 93, 1, '2017-06-29 23:00:55', 30000, 4),
(105, 40, 1, '2017-06-29 23:01:56', 30000, 4),
(106, 25, 1, '2017-06-29 23:02:26', 30000, 4),
(107, 180, 1, '2017-06-29 23:02:57', 30000, 4),
(108, 195, 1, '2017-06-29 23:03:23', 30000, 4),
(109, 315, 1, '2017-06-29 23:03:42', 30000, 4),
(110, 164, 1, '2017-06-29 23:04:45', 30000, 4),
(111, 331, 1, '2017-06-29 23:05:23', 30000, 4),
(112, 187, 1, '2017-06-29 23:06:36', 30000, 4),
(113, 106, 1, '2017-06-29 23:07:10', 30000, 4),
(114, 141, 1, '2017-06-29 23:07:34', 30000, 4),
(115, 303, 1, '2017-06-29 23:08:05', 30000, 4),
(116, 20, 1, '2017-06-29 23:08:19', 30000, 4),
(117, 115, 1, '2017-06-29 23:08:51', 40000, 2),
(118, 265, 1, '2017-06-29 23:10:52', 40000, 4),
(119, 185, 1, '2017-06-29 23:11:10', 40000, 4),
(120, 267, 1, '2017-06-29 23:11:22', 40000, 4),
(121, 37, 1, '2017-06-29 23:11:37', 40000, 4),
(122, 44, 1, '2017-06-29 23:13:16', 45000, 2),
(123, 97, 1, '2017-06-29 23:13:22', 45000, 4),
(124, 196, 1, '2017-06-29 23:13:38', 45000, 4),
(125, 307, 1, '2017-06-29 23:14:03', 50000, 2),
(126, 29, 1, '2017-06-29 23:14:07', 50000, 4),
(127, 247, 1, '2017-06-29 23:14:22', 50000, 4),
(128, 89, 1, '2017-06-29 23:14:38', 50000, 4),
(129, 129, 1, '2017-06-29 23:14:47', 50000, 4),
(130, 321, 1, '2017-06-29 23:19:23', 50000, 4),
(131, 229, 1, '2017-06-29 23:19:41', 50000, 4),
(132, 3456, 1, '2017-06-29 23:35:22', 55000, 2),
(133, 3456, 1, '2017-06-29 23:35:36', 55000, 4),
(134, 3456, 1, '2017-06-29 23:36:30', 0, 4),
(135, 3456, 1, '2017-06-29 23:38:04', 0, 4),
(136, 3456, 1, '2017-06-29 23:38:29', 60000, 2),
(137, 3456, 1, '2017-06-29 23:40:23', 65000, 2),
(138, 3456, 1, '2017-06-29 23:40:40', 70000, 2),
(139, 3456, 1, '2017-06-29 23:42:01', 75000, 2),
(140, 3456, 1, '2017-06-29 23:44:54', 80000, 2),
(141, 3456, 1, '2017-06-29 23:45:10', 85000, 2),
(142, 3456, 1, '2017-06-29 23:45:17', 85000, 4),
(143, 3456, 1, '2017-06-29 23:45:28', 90000, 2),
(144, 3456, 1, '2017-06-29 23:45:33', 90000, 4),
(145, 3456, 1, '2017-06-29 23:45:38', 90000, 4),
(146, 3456, 1, '2017-06-29 23:46:42', 95000, 2),
(147, 100000, 3456, '2017-06-29 23:54:07', 0, 9),
(148, 3456, 1, '2017-06-29 23:54:54', 100000, 2),
(149, 3456, 1, '2017-06-29 23:55:56', 105000, 2),
(150, 3456, 1, '2017-06-30 00:02:29', 110000, 9),
(151, 3456, 1, '2017-06-30 00:03:19', 110000, 9),
(152, 3456, 1, '2017-06-30 00:04:50', 110000, 2),
(153, 3456, 1, '2017-06-30 00:06:51', 115000, 2),
(154, 3456, 1, '2017-06-30 00:08:28', 120000, 2),
(155, 3456, 1, '2017-06-30 00:10:41', 125000, 2),
(156, 3456, 1, '2017-06-30 00:11:34', 130000, 2),
(157, 3456, 1, '2017-06-30 00:11:43', 135000, 2),
(158, 3456, 1, '2017-06-30 00:24:16', 140000, 2),
(159, 3456, 1, '2017-06-30 00:32:10', 145000, 2),
(160, 3456, 1, '2017-06-30 00:32:39', 150000, 2),
(161, 3456, 1, '2017-06-30 00:34:37', 155000, 2),
(162, 3456, 1, '2017-06-30 00:36:51', 160000, 2),
(163, 3456, 1, '2017-06-30 00:38:49', 165000, 2),
(164, 3456, 1, '2017-06-30 00:39:13', 170000, 2),
(165, 3456, 1, '2017-06-30 00:41:13', 175000, 2),
(166, 3456, 1, '2017-06-30 00:42:35', 180000, 2),
(167, 3456, 1, '2017-06-30 00:42:53', 185000, 2),
(168, 3456, 1, '2017-06-30 00:44:34', 190000, 2),
(169, 3456, 1, '2017-06-30 00:45:12', 195000, 2),
(170, 3456, 1, '2017-06-30 00:47:53', 200000, 2),
(171, 3456, 1, '2017-06-30 00:48:14', 205000, 2),
(172, 3456, 1, '2017-06-30 00:49:04', 210000, 2),
(173, 3456, 1, '2017-06-30 00:49:12', 215000, 2),
(174, 3456, 1, '2017-06-30 00:49:34', 220000, 2),
(175, 3456, 1, '2017-06-30 00:49:40', 225000, 2),
(176, 3456, 1, '2017-06-30 00:49:54', 230000, 2),
(177, 3456, 1, '2017-06-30 00:50:11', 235000, 2),
(178, 3456, 1, '2017-06-30 00:50:28', 240000, 2),
(179, 3456, 1, '2017-06-30 00:50:54', 245000, 2),
(180, 3456, 1, '2017-06-30 00:51:06', 250000, 2),
(181, 3456, 1, '2017-06-30 00:51:30', 255000, 2),
(182, 3456, 1, '2017-06-30 00:51:48', 260000, 2),
(183, 3456, 1, '2017-06-30 00:51:58', 265000, 2),
(184, 3456, 1, '2017-06-30 00:52:09', 270000, 2),
(185, 3456, 1, '2017-06-30 00:52:38', 275000, 2),
(186, 3456, 1, '2017-06-30 00:52:52', 280000, 2),
(187, 3456, 1, '2017-06-30 00:53:00', 285000, 2),
(188, 3456, 1, '2017-06-30 00:53:29', 290000, 2),
(189, 3456, 1, '2017-06-30 00:53:36', 295000, 2),
(190, 3456, 1, '2017-06-30 00:53:59', 300000, 2),
(191, 3456, 1, '2017-06-30 00:54:08', 300000, 4),
(192, 3456, 1, '2017-06-30 00:54:31', 305000, 2),
(193, 3456, 1, '2017-06-30 00:54:39', 310000, 2),
(194, 3456, 1, '2017-06-30 00:54:57', 315000, 2),
(195, 3456, 1, '2017-06-30 00:55:04', 305000, 4),
(196, 3456, 1, '2017-06-30 00:55:42', 320000, 2),
(197, 3456, 1, '2017-06-30 00:55:47', 320000, 4),
(198, 3456, 1, '2017-06-30 00:55:55', 320000, 4),
(199, 3456, 1, '2017-06-30 00:56:07', 320000, 4),
(200, 3456, 1, '2017-06-30 00:56:30', 325000, 2),
(201, 3456, 1, '2017-06-30 00:57:15', 330000, 2),
(202, 3456, 1, '2017-06-30 00:57:30', 335000, 2),
(203, 3456, 1, '2017-06-30 00:57:36', 335000, 4),
(204, 3456, 1, '2017-06-30 00:57:53', 340000, 2),
(205, 3456, 1, '2017-06-30 00:57:58', 345000, 2),
(206, 3456, 1, '2017-06-30 00:58:03', 340000, 4),
(207, 3456, 1, '2017-06-30 00:58:28', 350000, 2),
(208, 3456, 1, '2017-06-30 00:58:35', 355000, 2),
(209, 3456, 1, '2017-06-30 00:58:44', 350000, 4),
(210, 3456, 1, '2017-06-30 00:59:07', 360000, 2),
(211, 3456, 1, '2017-06-30 00:59:25', 365000, 2),
(212, 3456, 1, '2017-06-30 00:59:32', 370000, 2),
(213, 3456, 1, '2017-06-30 01:00:01', 375000, 2),
(214, 3456, 1, '2017-06-30 01:00:05', 375000, 4),
(215, 3456, 1, '2017-06-30 01:00:19', 380000, 2),
(216, 3456, 1, '2017-06-30 01:00:51', 380000, 4),
(217, 3456, 1, '2017-06-30 01:02:23', 385000, 2),
(218, 3456, 1, '2017-06-30 01:02:32', 385000, 4),
(219, 3456, 1, '2017-06-30 01:03:41', 390000, 2),
(220, 3456, 1, '2017-06-30 01:03:53', 395000, 2),
(221, 3456, 1, '2017-06-30 01:04:10', 400000, 2),
(222, 3456, 1, '2017-06-30 01:04:24', 405000, 2),
(223, 3456, 1, '2017-06-30 01:05:15', 410000, 2),
(224, 3456, 1, '2017-06-30 01:06:46', 415000, 2),
(225, 3456, 1, '2017-06-30 01:08:20', 420000, 2),
(226, 3456, 1, '2017-06-30 01:08:29', 420000, 4),
(227, 3456, 1, '2017-06-30 01:08:40', 425000, 2),
(228, 3456, 1, '2017-06-30 01:08:43', 425000, 4),
(229, 3456, 1, '2017-06-30 01:08:53', 430000, 2),
(230, 3456, 1, '2017-06-30 01:08:59', 435000, 2),
(231, 3456, 1, '2017-06-30 01:09:05', 440000, 2),
(232, 3456, 1, '2017-06-30 01:09:19', 445000, 2),
(233, 3456, 1, '2017-06-30 01:09:27', 450000, 2),
(234, 3456, 1, '2017-06-30 01:10:04', 455000, 2),
(235, 3456, 1, '2017-06-30 01:10:16', 460000, 2),
(236, 3456, 1, '2017-06-30 01:10:23', 465000, 2),
(237, 3456, 1, '2017-06-30 01:10:31', 470000, 2),
(238, 3456, 1, '2017-06-30 01:10:39', 475000, 2),
(239, 3456, 1, '2017-06-30 01:10:48', 480000, 2),
(240, 3456, 1, '2017-06-30 01:10:57', 485000, 2),
(241, 3456, 1, '2017-06-30 01:11:04', 490000, 2),
(242, 3456, 1, '2017-06-30 01:11:48', 495000, 2),
(243, 3456, 1, '2017-06-30 01:15:09', 500000, 2),
(244, 3456, 1, '2017-06-30 01:15:20', 505000, 2),
(245, 3456, 1, '2017-06-30 01:15:42', 510000, 2),
(246, 3456, 1, '2017-06-30 01:16:14', 515000, 2),
(247, 3456, 1, '2017-06-30 01:16:35', 520000, 2),
(248, 3456, 1, '2017-06-30 01:22:22', 525000, 2),
(249, 3456, 1, '2017-06-30 01:31:12', 530000, 2),
(250, 3456, 1, '2017-06-30 07:26:14', 535000, 2),
(251, 3456, 1, '2017-06-30 07:43:15', 540000, 2),
(253, 3456, 1, '2017-06-30 07:43:19', 540000, 4),
(254, 23, 1, '2017-06-30 22:55:48', 45000, 4),
(255, 3456, 1, '2017-07-01 15:40:20', 545000, 2),
(256, 9929, 1, '2017-07-01 18:31:49', 550000, 2),
(257, 38172, 1, '2017-07-01 18:32:55', 555000, 2),
(258, 9929, 1, '2017-07-01 18:33:03', 560000, 2),
(259, 38172, 1, '2017-07-01 18:33:16', 565000, 2),
(260, 38172, 1, '2017-07-01 18:50:45', 570000, 2),
(261, 92818, 1, '2017-07-01 19:00:10', 575000, 2),
(262, 92818, 1, '2017-07-01 19:02:01', 580000, 2),
(263, 218, 1, '2017-07-01 19:02:12', 580000, 4),
(264, 218, 1, '2017-07-01 19:02:57', 585000, 2),
(265, 92818, 1, '2017-07-01 19:03:07', 590000, 2),
(266, 218, 1, '2017-07-01 19:03:12', 590000, 4),
(267, 92818, 1, '2017-07-01 19:04:41', 595000, 2),
(268, 218, 1, '2017-07-01 19:04:49', 600000, 2),
(269, 92818, 1, '2017-07-01 19:05:02', 605000, 2),
(270, 218, 1, '2017-07-01 19:05:04', 605000, 4),
(271, 125, 1, '2017-07-12 15:28:16', 610000, 9),
(272, 487, 1, '2017-07-12 15:29:41', 610000, 9),
(273, 125, 1, '2017-07-12 15:29:45', 610000, 9),
(274, 1231, 1, '2017-07-12 16:24:44', 5000, 9),
(275, 875, 1, '2017-07-15 19:35:51', 610000, 2),
(276, 995, 1, '2017-07-15 19:57:52', 615000, 2),
(277, 995, 1, '2017-07-15 20:07:52', 620000, 2),
(278, 995, 1, '2017-07-15 20:19:55', 625000, 2),
(279, 995, 1, '2017-07-15 20:28:36', 630000, 2),
(280, 995, 1, '2017-07-15 20:29:06', 635000, 2),
(281, 995, 1, '2017-07-15 20:32:03', 640000, 2),
(282, 995, 1, '2017-07-15 20:32:17', 645000, 2),
(283, 995, 1, '2017-07-15 20:32:26', 650000, 2),
(284, 995, 1, '2017-07-15 20:32:39', 655000, 2),
(285, 995, 1, '2017-07-15 20:32:41', 655000, 4),
(286, 995, 1, '2017-07-15 20:32:54', 660000, 2),
(287, 995, 1, '2017-07-15 20:33:00', 660000, 4),
(288, 995, 1, '2017-07-15 20:34:30', 665000, 2),
(289, 995, 1, '2017-07-15 20:34:40', 670000, 2),
(290, 995, 1, '2017-07-15 20:42:09', 675000, 2),
(291, 995, 1, '2017-07-15 20:42:18', 680000, 2),
(292, 995, 1, '2017-07-15 20:42:24', 685000, 2),
(293, 995, 1, '2017-07-15 20:42:30', 685000, 4),
(294, 65, 1, '2017-07-15 21:33:48', 690000, 2),
(295, 65, 1, '2017-07-15 21:35:45', 695000, 2),
(296, 65, 6, '2017-07-15 22:38:05', 150000, 1),
(297, 65, 6, '2017-07-15 22:44:13', 155000, 2),
(298, 65, 6, '2017-07-15 22:44:27', 160000, 2),
(299, 65, 6, '2017-07-15 22:44:41', 165000, 2),
(300, 65, 6, '2017-07-15 22:44:42', 165000, 4),
(301, 65, 6, '2017-07-15 22:48:17', 170000, 2),
(302, 65, 6, '2017-07-15 22:51:25', 175000, 2),
(303, 65, 6, '2017-07-15 22:52:30', 180000, 2),
(304, 65, 6, '2017-07-15 22:52:37', 185000, 2),
(305, 685, 6, '2017-07-15 23:01:31', 190000, 2),
(306, 6875, 6, '2017-07-15 23:24:12', 195000, 2),
(307, 6875, 6, '2017-07-15 23:26:00', 200000, 2),
(308, 6875, 6, '2017-07-15 23:41:52', 205000, 2),
(309, 6875, 6, '2017-07-15 23:42:45', 210000, 2),
(310, 6875, 6, '2017-07-15 23:42:49', 210000, 4),
(311, 6875, 6, '2017-07-15 23:42:54', 210000, 4),
(312, 6875, 6, '2017-07-15 23:43:01', 215000, 2),
(313, 6875, 6, '2017-07-15 23:44:52', 220000, 2),
(314, 6875, 6, '2017-07-15 23:46:20', 225000, 2),
(315, 6875, 6, '2017-07-15 23:47:54', 230000, 2),
(316, 6875, 6, '2017-07-15 23:48:25', 235000, 2),
(317, 6875, 6, '2017-07-15 23:51:23', 240000, 2),
(318, 655, 6, '2017-07-15 23:52:14', 245000, 2),
(319, 655, 6, '2017-07-15 23:53:01', 250000, 2),
(320, 6875, 5, '2017-07-16 00:44:21', 300000, 1),
(321, 655, 6, '2017-07-16 00:45:01', 255000, 2),
(322, 654, 6, '2017-07-16 00:47:54', 260000, 2),
(323, 654, 6, '2017-07-16 00:50:47', 265000, 2),
(324, 654, 6, '2017-07-16 00:51:36', 270000, 2),
(325, 654, 6, '2017-07-16 00:51:59', 275000, 2),
(326, 75, 6, '2017-07-16 00:52:31', 280000, 2),
(327, 6875, 5, '2017-07-16 00:54:25', 310000, 2),
(328, 6875, 5, '2017-07-16 00:54:32', 320000, 2),
(329, 6875, 5, '2017-07-16 00:54:41', 330000, 2),
(330, 654, 5, '2017-07-16 00:54:49', 340000, 2),
(331, 6875, 5, '2017-07-16 00:58:45', 350000, 2),
(332, 6875, 5, '2017-07-16 00:59:01', 360000, 2),
(333, 654, 6, '2017-07-16 08:50:27', 285000, 2),
(334, 6875, 5, '2017-07-16 09:08:08', 370000, 2),
(335, 6875, 5, '2017-07-16 09:10:39', 380000, 2),
(336, 6875, 5, '2017-07-16 09:12:21', 390000, 2),
(337, 6875, 5, '2017-07-16 09:12:33', 400000, 2),
(338, 6875, 5, '2017-07-16 09:13:11', 410000, 2),
(339, 6875, 5, '2017-07-16 09:13:16', 420000, 2),
(340, 6875, 6, '2017-07-16 09:17:20', 290000, 2),
(341, 6875, 6, '2017-07-16 09:17:26', 295000, 2),
(342, 6875, 6, '2017-07-16 09:17:32', 300000, 2),
(343, 6875, 5, '2017-07-16 09:17:46', 430000, 2),
(344, 6875, 5, '2017-07-16 09:36:47', 440000, 2),
(345, 6875, 5, '2017-07-16 09:36:48', 440000, 4),
(346, 6875, 5, '2017-07-16 09:36:49', 440000, 4),
(347, 6875, 5, '2017-07-16 09:36:49', 440000, 4),
(348, 6875, 6, '2017-07-16 09:37:12', 305000, 2),
(349, 6875, 6, '2017-07-16 09:37:17', 310000, 2),
(350, 6875, 5, '2017-07-16 09:38:30', 450000, 2),
(351, 6875, 5, '2017-07-16 09:38:47', 460000, 2),
(352, 6875, 5, '2017-07-16 09:39:49', 470000, 2),
(353, 6875, 5, '2017-07-16 09:40:08', 480000, 2),
(354, 6875, 4, '2017-07-16 18:46:34', 175000, 1),
(355, 6875, 4, '2017-07-16 18:46:56', 185000, 2),
(356, 654, 6, '2017-07-16 19:11:02', 315000, 2),
(357, 654, 6, '2017-07-16 19:11:24', 320000, 2),
(358, 654, 6, '2017-07-16 20:19:19', 325000, 2),
(359, 654, 6, '2017-07-16 20:19:28', 330000, 2),
(360, 654, 6, '2017-07-16 20:19:33', 335000, 2),
(361, 654, 6, '2017-07-16 21:19:52', 340000, 2),
(362, 654, 6, '2017-07-16 21:20:05', 345000, 2),
(363, 654, 2, '2017-07-17 00:10:02', 15000, 9),
(364, 654, 2, '2017-07-17 00:10:08', 15000, 9),
(365, 654, 2, '2017-07-17 00:10:14', 15000, 9),
(366, 654, 2, '2017-07-17 00:10:18', 15000, 9);

--
-- Triggers `bids`
--
DELIMITER //
CREATE TRIGGER `mirror_highest` AFTER INSERT ON `bids`
 FOR EACH ROW IF(NEW.Status = 1 || NEW.Status = 2)

THEN 

insert into h_bid Values
		(NEW.Rule_Id, NEW.Bid_Id, NEW.Bid_Value,(select count(*) from bids where rule_id = NEW.rule_id),NULL)
	ON DUPLICATE KEY 
		UPDATE Bid_Id = VALUES(Bid_Id),
	    	   Price = VALUES(Price),
               Bid_Count = (select count(*) from bids where rule_id = NEW.rule_id);
               
END IF
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bids2`
--

CREATE TABLE IF NOT EXISTS `bids2` (
  `Bid_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids2`
--

INSERT INTO `bids2` (`Bid_Id`, `User_Id`) VALUES
(0, 21);

-- --------------------------------------------------------

--
-- Table structure for table `h_bid`
--

CREATE TABLE IF NOT EXISTS `h_bid` (
  `Rule_Id` int(11) NOT NULL,
  `Bid_Id` int(11) NOT NULL,
  `Price` int(11) DEFAULT NULL,
  `Bid_Count` int(11) NOT NULL DEFAULT '0',
  `invoice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_bid`
--

INSERT INTO `h_bid` (`Rule_Id`, `Bid_Id`, `Price`, `Bid_Count`, `invoice`) VALUES
(1, 295, 695000, 223, NULL),
(2, 94, 10000, 29, NULL),
(3, 84, 10000, 6, NULL),
(4, 355, 185000, 2, NULL),
(5, 353, 480000, 22, NULL),
(6, 362, 345000, 43, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
`inv_id` int(11) NOT NULL,
  `issued` datetime NOT NULL,
  `expired` datetime NOT NULL,
  `seller_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_detail`
--

CREATE TABLE IF NOT EXISTS `inv_detail` (
  `inv_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL,
  `item_title` varchar(125) NOT NULL,
  `item_condition` int(1) NOT NULL,
  `item_detail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_title`, `item_condition`, `item_detail`) VALUES
(1, 'Bandai SHF Figuarts Luffy Bouncing-Man', 1, 'Very good Condition - Asia Ver.'),
(2, 'Banpresto MSP Haikyuu! Hinata Shoyo', 1, 'BIB - open for Photo..'),
(3, 'Neca Predator Jungle Hunter 1/4 ', 1, 'New In Box (never opened)'),
(4, 'Gachapon 12 in box Haikyuu vol1', 1, 'Blind Box complete series Volume 1 (release 2013)'),
(5, 'Neca Private Vasquez (ALIENS)', 1, 'New MIB original');

-- --------------------------------------------------------

--
-- Table structure for table `item_img`
--

CREATE TABLE IF NOT EXISTS `item_img` (
`img_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `img_URL` varchar(300) NOT NULL,
  `thumb_URL` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_img`
--

INSERT INTO `item_img` (`img_id`, `item_id`, `img_URL`, `thumb_URL`) VALUES
(1, 1, 'http://139.59.114.246:8093/s-l1605.jpg', 'http://139.59.114.246:8093/s-l1605.jpg'),
(2, 2, 'http://139.59.114.246:8093/s-l1605.jpg', 'http://139.59.114.246:8093/s-l1605.jpg'),
(3, 3, 'http://139.59.114.246:8093/s-l1605.jpg', 'http://139.59.114.246:8093/s-l1605.jpg'),
(4, 4, 'http://139.59.114.246:8093/otoyomi1448376844.jpeg', 'http://139.59.114.246:8093/otoyomi1448376844.jpeg'),
(5, 5, 'http://139.59.114.246:8093/CsSznw3VIAAK6EH.jpg', 'http://139.59.114.246:8093/CsSznw3VIAAK6EH.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `item_ladang`
--

CREATE TABLE IF NOT EXISTS `item_ladang` (
  `rule_id` int(11) NOT NULL,
  `ladang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_ladang`
--

INSERT INTO `item_ladang` (`rule_id`, `ladang_id`) VALUES
(1, 1),
(1, 2),
(2, 4),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ladang`
--

CREATE TABLE IF NOT EXISTS `ladang` (
  `ladang_id` int(11) NOT NULL,
  `ladang_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ladang`
--

INSERT INTO `ladang` (`ladang_id`, `ladang_name`) VALUES
(3, 'haikyuu'),
(1, 'luffy'),
(2, 'onepiece'),
(4, 'shf');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`m_id` int(11) NOT NULL,
  `m_username` varchar(30) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `m_profpic` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`m_id`, `m_username`, `m_name`, `m_profpic`) VALUES
(1, 'bobeng', 'Bobeng', '-'),
(2, 'kobeng', 'Bebong', '-'),
(3, 'mbobeng', 'Mbobeng', '-\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`pay_id` int(11) NOT NULL,
  `unique_code` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `exp_date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_detail`
--

CREATE TABLE IF NOT EXISTS `pay_detail` (
  `pay_id` int(11) NOT NULL,
  `inv_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
`Rule_Id` int(11) NOT NULL,
  `Auction_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Start_Price` int(11) NOT NULL,
  `Kelipatan` int(11) NOT NULL,
  `BIN` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`Rule_Id`, `Auction_Id`, `Item_Id`, `Start_Price`, `Kelipatan`, `BIN`) VALUES
(1, 1, 1, 10000, 5000, 100000),
(2, 2, 1, 5000, 5000, 50000),
(3, 1, 2, 225000, 5000, 275000),
(4, 3, 3, 175000, 10000, 300000),
(5, 3, 4, 300000, 10000, 750000),
(6, 3, 5, 150000, 5000, 350000);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE IF NOT EXISTS `sellers` (
`s_id` int(11) NOT NULL,
  `s_username` varchar(30) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `s_profpic` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`s_id`, `s_username`, `s_name`, `s_profpic`) VALUES
(1, 'juragan_figure', 'Anto Hoek', 'http://139.59.114.246:8093/angga.jpg'),
(2, 'Sultan_Khilaf', 'David H', 'http://139.59.114.246:8093/lohan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `watch`
--

CREATE TABLE IF NOT EXISTS `watch` (
  `rule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bidded` int(1) NOT NULL DEFAULT '0',
  `watch_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `watch`
--

INSERT INTO `watch` (`rule_id`, `user_id`, `bidded`, `watch_date`) VALUES
(1, 1, 0, '2017-07-12 17:21:02'),
(1, 2, 0, '2017-07-12 17:21:02'),
(1, 65, 0, '2017-07-15 20:44:00'),
(1, 100, 0, '2017-07-12 17:21:02'),
(1, 109, 0, '2017-07-12 23:20:11'),
(1, 110, 0, '2017-07-12 23:32:59'),
(1, 111, 0, '2017-07-13 07:48:34'),
(1, 112, 0, '2017-07-13 20:39:34'),
(1, 137, 0, '2017-07-12 18:23:03'),
(1, 138, 0, '2017-07-12 18:45:14'),
(1, 501, 0, '2017-07-12 17:21:02'),
(1, 502, 0, '2017-07-12 17:21:02'),
(1, 503, 0, '2017-07-12 17:21:02'),
(1, 555, 0, '2017-07-12 17:21:02'),
(1, 557, 0, '2017-07-12 17:21:02'),
(1, 558, 0, '2017-07-12 17:21:02'),
(1, 786, 0, '2017-07-12 22:11:20'),
(1, 875, 0, '2017-07-15 18:40:33'),
(1, 995, 0, '2017-07-15 19:53:24'),
(1, 998, 0, '2017-07-15 12:58:18'),
(1, 1009, 0, '2017-07-12 17:22:34'),
(1, 1121, 0, '2017-07-12 17:37:40'),
(1, 1321, 0, '2017-07-12 17:39:39'),
(1, 1322, 0, '2017-07-12 17:48:44'),
(1, 1324, 0, '2017-07-12 17:40:42'),
(1, 1325, 0, '2017-07-12 17:44:27'),
(2, 1, 0, '2017-07-12 17:21:02'),
(2, 2, 0, '2017-07-12 17:21:02'),
(2, 654, 0, '2017-07-16 21:46:51'),
(3, 2, 0, '2017-07-12 17:21:02'),
(3, 3, 0, '2017-07-12 17:21:02'),
(4, 122, 0, '2017-07-12 17:21:02'),
(4, 123, 0, '2017-07-12 17:21:02'),
(4, 654, 0, '2017-07-16 01:00:11'),
(5, 654, 0, '2017-07-16 00:53:16'),
(5, 6875, 0, '2017-07-16 09:12:51'),
(6, 654, 0, '2017-07-16 19:11:14'),
(6, 6875, 0, '2017-07-15 23:21:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
 ADD PRIMARY KEY (`auction_id`), ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
 ADD PRIMARY KEY (`Bid_Id`), ADD KEY `User_Id` (`User_Id`,`Rule_Id`);

--
-- Indexes for table `bids2`
--
ALTER TABLE `bids2`
 ADD PRIMARY KEY (`Bid_Id`);

--
-- Indexes for table `h_bid`
--
ALTER TABLE `h_bid`
 ADD PRIMARY KEY (`Rule_Id`), ADD KEY `Rule_Id` (`Rule_Id`,`Bid_Id`), ADD KEY `Bid_Id` (`Bid_Id`), ADD KEY `Rule_Id_2` (`Rule_Id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
 ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `inv_detail`
--
ALTER TABLE `inv_detail`
 ADD KEY `inv_id` (`inv_id`,`rule_id`), ADD KEY `rule_id` (`rule_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_img`
--
ALTER TABLE `item_img`
 ADD PRIMARY KEY (`img_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `item_ladang`
--
ALTER TABLE `item_ladang`
 ADD KEY `ladang_id` (`ladang_id`), ADD KEY `rule_id` (`rule_id`,`ladang_id`);

--
-- Indexes for table `ladang`
--
ALTER TABLE `ladang`
 ADD PRIMARY KEY (`ladang_id`), ADD UNIQUE KEY `ladang_name` (`ladang_name`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `pay_detail`
--
ALTER TABLE `pay_detail`
 ADD KEY `pay_id` (`pay_id`,`inv_id`), ADD KEY `inv_id` (`inv_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
 ADD PRIMARY KEY (`Rule_Id`), ADD KEY `Auction_Id` (`Auction_Id`,`Item_Id`), ADD KEY `Item_Id` (`Item_Id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
 ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `watch`
--
ALTER TABLE `watch`
 ADD PRIMARY KEY (`rule_id`,`user_id`), ADD KEY `rule_id` (`rule_id`), ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
MODIFY `Bid_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=367;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_img`
--
ALTER TABLE `item_img`
MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
MODIFY `Rule_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auction`
--
ALTER TABLE `auction`
ADD CONSTRAINT `auction_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `h_bid`
--
ALTER TABLE `h_bid`
ADD CONSTRAINT `h_bid_ibfk_1` FOREIGN KEY (`Rule_Id`) REFERENCES `rules` (`Rule_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inv_detail`
--
ALTER TABLE `inv_detail`
ADD CONSTRAINT `inv_detail_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `invoice` (`inv_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `inv_detail_ibfk_2` FOREIGN KEY (`rule_id`) REFERENCES `h_bid` (`Rule_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_img`
--
ALTER TABLE `item_img`
ADD CONSTRAINT `item_img_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_ladang`
--
ALTER TABLE `item_ladang`
ADD CONSTRAINT `item_ladang_ibfk_2` FOREIGN KEY (`ladang_id`) REFERENCES `ladang` (`ladang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `item_ladang_ibfk_3` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`Rule_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pay_detail`
--
ALTER TABLE `pay_detail`
ADD CONSTRAINT `pay_detail_ibfk_1` FOREIGN KEY (`pay_id`) REFERENCES `payment` (`pay_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `pay_detail_ibfk_2` FOREIGN KEY (`inv_id`) REFERENCES `invoice` (`inv_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
ADD CONSTRAINT `rules_ibfk_1` FOREIGN KEY (`Item_Id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `rules_ibfk_2` FOREIGN KEY (`Auction_Id`) REFERENCES `auction` (`auction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `watch`
--
ALTER TABLE `watch`
ADD CONSTRAINT `watch_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`Rule_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
