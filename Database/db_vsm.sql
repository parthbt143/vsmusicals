-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2019 at 02:53 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_vsm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `ad_id` int(5) NOT NULL,
  `ad_name` varchar(25) NOT NULL,
  `ad_email` varchar(30) NOT NULL,
  `ad_password` varchar(20) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`ad_id`, `ad_name`, `ad_email`, `ad_password`, `is_delete`) VALUES
(1, 'Parth B   ', 'parthbt143@gmail.com', '1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admission`
--

CREATE TABLE `tbl_admission` (
  `adm_id` int(5) NOT NULL,
  `stud_id` int(5) NOT NULL,
  `batch_id` int(5) NOT NULL,
  `fees_paid` int(5) NOT NULL,
  `fees_remaining` int(5) NOT NULL,
  `fees_total` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admission`
--

INSERT INTO `tbl_admission` (`adm_id`, `stud_id`, `batch_id`, `fees_paid`, `fees_remaining`, `fees_total`, `is_delete`) VALUES
(1, 1, 2, 4000, 500, 4500, 0),
(2, 2, 2, 3500, 1000, 4500, 0),
(3, 1, 4, 5500, 1000, 6500, 0),
(4, 3, 2, 3000, 1500, 4500, 0),
(5, 4, 3, 4500, 500, 5000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `area_id` int(5) NOT NULL,
  `area_name` varchar(25) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`area_id`, `area_name`, `is_delete`) VALUES
(1, 'None of Above', 0),
(2, 'Isanpur', 0),
(3, 'Vatva', 0),
(4, 'Maninagar', 0),
(5, 'Ghodasar', 0),
(6, 'Odhav', 0),
(7, 'Chandkheda', 0),
(8, 'Nikol', 0),
(9, 'Naroda', 0),
(10, 'Vastrapur', 0),
(11, 'Jodhpur', 0),
(12, 'Saraspur', 0),
(13, 'Vastral', 0),
(14, 'CTM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

CREATE TABLE `tbl_batch` (
  `batch_id` int(5) NOT NULL,
  `batch_name` varchar(30) NOT NULL,
  `course_id` int(5) NOT NULL,
  `emp_id` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_batch`
--

INSERT INTO `tbl_batch` (`batch_id`, `batch_name`, `course_id`, `emp_id`, `is_delete`) VALUES
(1, 'Guitar B1', 1, 1, 0),
(2, 'Guitar B2', 1, 1, 0),
(3, 'Kryboard B1', 2, 4, 0),
(4, 'Drum B1', 3, 9, 0),
(5, 'Drum B2', 3, 9, 0),
(6, 'Tabla B1', 4, 4, 0),
(7, 'Tabla B2', 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(5) NOT NULL,
  `cat_name` varchar(25) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `is_delete`) VALUES
(1, 'Guitar', 0),
(2, 'Key Board', 0),
(3, 'Drum', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `com_id` int(5) NOT NULL,
  `com_name` varchar(20) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`com_id`, `com_name`, `is_delete`) VALUES
(6, 'Henrix', 0),
(7, 'Alesis', 0),
(8, 'Vault', 0),
(9, 'Ibanez', 0),
(10, 'Fender', 0),
(11, 'Cort', 0),
(12, 'Netkar', 0),
(13, 'Casio', 0),
(14, 'Havana', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` int(5) NOT NULL,
  `course_name` varchar(25) NOT NULL,
  `course_duration` int(2) NOT NULL,
  `course_fee` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `course_name`, `course_duration`, `course_fee`, `is_delete`) VALUES
(1, 'Guitar', 4, 4500, 0),
(2, 'Keyboard', 3, 5000, 0),
(3, 'Drum', 6, 6500, 0),
(4, 'Tabla', 5, 4000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cust_id` int(5) NOT NULL,
  `cust_fname` varchar(25) NOT NULL,
  `cust_lname` varchar(25) NOT NULL,
  `cust_gender` varchar(6) NOT NULL,
  `cust_mobile` bigint(10) NOT NULL,
  `cust_email` varchar(30) NOT NULL,
  `cust_address` varchar(250) NOT NULL,
  `area_id` int(5) NOT NULL,
  `cust_password` varchar(20) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cust_id`, `cust_fname`, `cust_lname`, `cust_gender`, `cust_mobile`, `cust_email`, `cust_address`, `area_id`, `cust_password`, `is_delete`) VALUES
(1, '', '', '-', 0, '', '-', 0, '-', 0),
(2, 'Parth', 'Thakkar', 'Male', 8735055104, 'parthbt143@gmail.com', '31 Picnic Park Society , Nr Tankar Recidency', 3, '5520', 0),
(3, 'Neel', 'Gajjar', 'Male', 9624496658, 'neelgajjar15@gmail.com', 'A 401 Gopalanandan Recidency ', 7, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designation`
--

CREATE TABLE `tbl_designation` (
  `des_id` int(5) NOT NULL,
  `des_name` varchar(25) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_designation`
--

INSERT INTO `tbl_designation` (`des_id`, `des_name`, `is_delete`) VALUES
(1, 'Worker', 0),
(2, 'Delivery', 0),
(3, 'Shopkeeper', 0),
(4, 'Trainer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `emp_id` int(5) NOT NULL,
  `emp_name` varchar(25) NOT NULL,
  `emp_gender` varchar(6) NOT NULL,
  `des_id` int(5) NOT NULL,
  `emp_mobile` bigint(10) NOT NULL,
  `emp_address` varchar(250) NOT NULL,
  `area_id` int(5) NOT NULL,
  `salary` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `emp_name`, `emp_gender`, `des_id`, `emp_mobile`, `emp_address`, `area_id`, `salary`, `is_delete`) VALUES
(1, 'Akash Malaviya', 'Male', 4, 8735055104, 'G-43,Aman complex', 5, 25000, 0),
(2, 'Kishor Patel', 'Male', 2, 6353330586, 'A-23,Ananya Society', 2, 10000, 0),
(3, 'Manisha Dave', 'Female', 1, 8735055103, 'D-8,Adarsh Apartment', 4, 15000, 0),
(4, 'Jatin Parekh', 'Female', 4, 8347372411, 'H-12,Mangalam Society', 6, 15000, 0),
(5, 'Shilpa Thakre', 'Female', 3, 9169904336, 'O-5,Chitra Society', 4, 20000, 0),
(6, 'Manan Desai', 'Male', 2, 8200287734, 'N-23,Aman Apartment', 6, 10000, 0),
(7, 'Abhishek', 'Male', 4, 8141243453, 'B-12,Rama Complex', 2, 25000, 8),
(8, 'Jaymin Vyas', 'Male', 3, 7043627726, 'A-5,Darshan Society', 5, 15000, 0),
(9, 'Dishant Kariya', 'Male', 4, 6324512548, '65 Giridhar Society ', 4, 14500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimation`
--

CREATE TABLE `tbl_estimation` (
  `est_id` int(5) NOT NULL,
  `cust_id` int(5) NOT NULL,
  `pro_id` int(5) NOT NULL,
  `est_title` varchar(50) NOT NULL,
  `est_description` varchar(250) NOT NULL,
  `est_photo1` varchar(200) NOT NULL,
  `est_photo2` varchar(200) NOT NULL,
  `est_reply` varchar(500) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_estimation`
--

INSERT INTO `tbl_estimation` (`est_id`, `cust_id`, `pro_id`, `est_title`, `est_description`, `est_photo1`, `est_photo2`, `est_reply`, `is_delete`) VALUES
(1, 1, 1, '1', '1', '', '', '', 0),
(2, 1, 1, '1', '1', '', '', '', 0),
(3, 1, 1, '1', '1', 'estimages/15517687951.jpg', '', '', 0),
(4, 1, 1, '1', '1', '', '', '', 0),
(5, 1, 1, '1', '1', 'estimages/15517688571.jpg', '', '', 0),
(6, 1, 1, '1', '1', 'API/15517690301.jpg', '', '', 0),
(7, 1, 1, '1', '1', 'admin/estimages/15517697451.jpg', '', '', 0),
(8, 1, 1, '1', '1', 'estimages/15517697821.jpg', '', '', 0),
(9, 1, 1, '1', '1', '../estimages/15517698121.jpg', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `faq_id` int(5) NOT NULL,
  `pro_id` int(5) NOT NULL,
  `faq_que` varchar(50) NOT NULL,
  `faq_ans` varchar(300) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fees`
--

CREATE TABLE `tbl_fees` (
  `fee_id` int(5) NOT NULL,
  `adm_id` int(5) NOT NULL,
  `fee_instalment_amt` int(5) NOT NULL,
  `fee_date` date NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fees`
--

INSERT INTO `tbl_fees` (`fee_id`, `adm_id`, `fee_instalment_amt`, `fee_date`, `is_delete`) VALUES
(1, 1, 1500, '2019-02-01', 0),
(2, 1, 2000, '2019-02-15', 0),
(3, 3, 2500, '2019-02-01', 0),
(4, 2, 3500, '2019-02-02', 0),
(5, 3, 500, '2019-02-03', 0),
(6, 3, 2500, '2019-02-18', 0),
(7, 1, 500, '2019-02-22', 0),
(8, 4, 3000, '2019-02-20', 0),
(9, 5, 2500, '2019-02-15', 0),
(10, 5, 2000, '2019-03-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer`
--

CREATE TABLE `tbl_offer` (
  `of_id` int(5) NOT NULL,
  `of_name` varchar(25) NOT NULL,
  `of_details` varchar(250) NOT NULL,
  `of_discount` int(2) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_offer`
--

INSERT INTO `tbl_offer` (`of_id`, `of_name`, `of_details`, `of_discount`, `is_delete`) VALUES
(1, 'None', '', 0, 0),
(2, 'Diwali Discount', '20  % Discount', 40, 0),
(3, 'New Year New Offer', '20 % Discount', 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(5) NOT NULL,
  `order_date` date NOT NULL,
  `cust_id` int(5) NOT NULL,
  `receiver_name` varchar(25) NOT NULL,
  `receiver_address` varchar(250) NOT NULL,
  `area_id` int(5) NOT NULL,
  `receiver_mobile` bigint(10) NOT NULL,
  `order_is_offline` tinyint(1) NOT NULL,
  `order_status` varchar(10) NOT NULL,
  `order_total` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_date`, `cust_id`, `receiver_name`, `receiver_address`, `area_id`, `receiver_mobile`, `order_is_offline`, `order_status`, `order_total`, `is_delete`) VALUES
(1, '2019-07-18', 1, 'Parth', '31 Picnic Park Society ,', 1, 8735055104, 1, 'Confirmed', 0, 0),
(2, '2019-03-02', 1, 'Parth', '31 Picnic Park Society ,', 1, 8735055104, 1, 'Pending', 0, 1),
(3, '2019-03-03', 1, 'Neel', '31 Picnic Park Society ,', 13, 8735055104, 1, 'Delivered', 3000, 0),
(4, '2019-03-16', 1, 'Parth', '31 Picnic Park Society ,', 13, 8735055104, 1, 'Delivered', 29000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `od_id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  `pro_id` int(5) NOT NULL,
  `pro_quantity` int(3) NOT NULL,
  `pro_price` int(5) NOT NULL,
  `sn_id` int(5) NOT NULL,
  `pro_discount` int(5) NOT NULL,
  `od_total` int(5) NOT NULL,
  `emp_id` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`od_id`, `order_id`, `pro_id`, `pro_quantity`, `pro_price`, `sn_id`, `pro_discount`, `od_total`, `emp_id`, `is_delete`) VALUES
(1, 3, 1, 1, 3000, 0, 0, 3000, 0, 0),
(2, 4, 1, 1, 3000, 0, 0, 3000, 0, 0),
(3, 4, 4, 1, 13000, 0, 0, 13000, 0, 0),
(4, 4, 4, 1, 13000, 0, 0, 13000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photo`
--

CREATE TABLE `tbl_photo` (
  `photo_id` int(5) NOT NULL,
  `pro_id` int(5) NOT NULL,
  `photo_path` varchar(200) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_photo`
--

INSERT INTO `tbl_photo` (`photo_id`, `pro_id`, `photo_path`, `is_delete`) VALUES
(1, 1, 'productpics/15513480937.jpg', 0),
(2, 1, 'productpics/15513481048.jpg', 0),
(3, 1, 'productpics/15513481179.jpg', 0),
(4, 2, 'productpics/155134813435.jpg', 0),
(9, 2, 'productpics/155134860025.jpg', 0),
(10, 3, 'productpics/155134864127.jpg', 0),
(11, 3, 'productpics/155134865028.jpg', 0),
(12, 4, 'productpics/155134867229.jpeg', 0),
(13, 5, 'productpics/155134869057.jpg', 0),
(14, 5, 'productpics/155134870158.jpg', 0),
(15, 5, 'productpics/155134871259.jpg', 0),
(16, 5, 'productpics/155134872260.jpg', 0),
(17, 6, 'productpics/155134874053.jpg', 0),
(18, 6, 'productpics/155134874954.jpg', 0),
(19, 6, 'productpics/155134875955.jpg', 0),
(20, 7, 'productpics/15513488552.jpg', 0),
(21, 7, 'productpics/15513488651.jpg', 0),
(22, 7, 'productpics/15513488743.jpg', 0),
(23, 7, 'productpics/15513490064.jpg', 0),
(24, 7, 'productpics/15513490286.jpg', 0),
(25, 8, 'productpics/155134910250.jpg', 0),
(26, 8, 'productpics/155134912549.jpg', 0),
(27, 8, 'productpics/155134914551.jpg', 0),
(28, 8, 'productpics/155134916452.jpg', 0),
(29, 9, 'productpics/155134918622.jpg', 0),
(30, 9, 'productpics/155134919723.jpg', 0),
(31, 10, 'productpics/155134922516.jpg', 0),
(32, 10, 'productpics/155134923617.jpg', 0),
(33, 10, 'productpics/155134925018.jpg', 0),
(34, 10, 'productpics/155134927419.jpg', 0),
(35, 11, 'productpics/155134932811.jpg', 0),
(36, 11, 'productpics/155134934612.jpg', 0),
(37, 11, 'productpics/155134936613.jpg', 0),
(38, 11, 'productpics/155134937814.jpg', 0),
(39, 11, 'productpics/155134938815.jpg', 0),
(40, 12, 'productpics/155134944330.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pro_id` int(5) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_details` text NOT NULL,
  `com_id` int(5) NOT NULL,
  `pro_price` int(5) NOT NULL,
  `pro_warranty` int(2) NOT NULL,
  `sc_id` int(5) NOT NULL,
  `pro_service` int(1) NOT NULL,
  `pro_service_price` int(4) NOT NULL,
  `pro_stock` int(3) NOT NULL,
  `pro_photo` varchar(200) NOT NULL,
  `of_id` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `pro_name`, `pro_details`, `com_id`, `pro_price`, `pro_warranty`, `sc_id`, `pro_service`, `pro_service_price`, `pro_stock`, `pro_photo`, `of_id`, `is_delete`) VALUES
(1, '38C Cutaway', '', 6, 3000, 12, 1, 0, 300, 4, 'productpics/15508179807.jpg', 2, 1),
(2, 'MD39C', '', 9, 6400, 12, 1, 1, 450, 8, 'productpics/155134830625.jpg', 1, 0),
(3, 'FA - 125 Dreadnought', '', 10, 10500, 12, 1, 2, 500, 12, 'productpics/155081817427.jpg', 3, 0),
(4, 'X - 100  ', '', 11, 13000, 12, 2, 1, 450, 12, 'productpics/155081829429.jpeg', 2, 0),
(5, 'EC3900YW  Premium', '', 8, 7000, 0, 3, 0, 250, 9, 'productpics/155081877057.jpg', 2, 0),
(6, 'EC39CE With Pickup', '', 8, 7500, 3, 3, 0, 200, 0, 'productpics/155081885153.jpg', 1, 0),
(7, 'Impact LX61', '', 12, 16500, 6, 7, 1, 450, 0, 'productpics/15508189286.jpg', 1, 0),
(8, 'APEX 49 USB With RGB Pads ', '', 8, 17300, 12, 7, 2, 350, 0, 'productpics/155081914749.jpg', 1, 0),
(9, 'MA150 49 Keys', '', 13, 5000, 0, 8, 0, 150, 0, 'productpics/155081921642.jpg', 3, 0),
(10, 'Sample Pad Pro 8-Pad ', '', 7, 35000, 12, 10, 2, 350, 0, 'productpics/155081927716.jpg', 2, 0),
(11, 'DM Lite', '', 7, 30000, 12, 10, 2, 0, 14, 'productpics/155081931811.jpg', 1, 0),
(12, 'HV 522 5 Pcs ', '', 14, 24000, 9, 9, 1, 400, 0, 'productpics/155081940930.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `pur_id` int(5) NOT NULL,
  `sup_id` int(5) NOT NULL,
  `pur_invoice_no` int(5) NOT NULL,
  `pur_date` date NOT NULL,
  `pur_amt` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`pur_id`, `sup_id`, `pur_invoice_no`, `pur_date`, `pur_amt`, `is_delete`) VALUES
(1, 1, 1, '2019-03-02', 12000, 0),
(2, 1, 1, '2019-03-02', 53000, 0),
(3, 1, 9, '2019-03-16', 20000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_detail`
--

CREATE TABLE `tbl_purchase_detail` (
  `pd_id` int(5) NOT NULL,
  `pur_id` int(5) NOT NULL,
  `pro_id` int(5) NOT NULL,
  `pro_quantity` int(3) NOT NULL,
  `pro_serial_number` varchar(10) NOT NULL,
  `pro_price` int(5) NOT NULL,
  `pd_total` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_detail`
--

INSERT INTO `tbl_purchase_detail` (`pd_id`, `pur_id`, `pro_id`, `pro_quantity`, `pro_serial_number`, `pro_price`, `pd_total`, `is_delete`) VALUES
(1, 1, 1, 1, '', 2000, 2000, 0),
(2, 1, 2, 2, '', 5000, 10000, 0),
(11, 2, 11, 2, '', 26500, 53000, 0),
(12, 3, 4, 2, '', 10000, 20000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ratings_and_review`
--

CREATE TABLE `tbl_ratings_and_review` (
  `rr_id` int(5) NOT NULL,
  `cust_id` int(5) NOT NULL,
  `pro_id` int(5) NOT NULL,
  `rating` int(2) NOT NULL,
  `review` varchar(200) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `s_id` int(5) NOT NULL,
  `batch_id` int(5) NOT NULL,
  `s_day` varchar(9) NOT NULL,
  `s_start` time NOT NULL,
  `s_end` time NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`s_id`, `batch_id`, `s_day`, `s_start`, `s_end`, `is_delete`) VALUES
(1, 1, 'Monday', '10:00:00', '12:00:00', 0),
(2, 1, 'Wensday', '10:00:00', '12:00:00', 0),
(3, 1, 'Saturday', '16:00:00', '18:00:00', 0),
(4, 2, 'Tuesday', '10:00:00', '12:00:00', 0),
(5, 2, 'Thursday', '10:00:00', '12:00:00', 0),
(6, 2, 'Friday', '10:00:00', '12:00:00', 0),
(7, 3, 'Sunday', '09:00:00', '11:00:00', 0),
(8, 3, 'Tuesday', '12:15:00', '14:30:00', 0),
(9, 4, 'Monday', '12:15:00', '14:15:00', 0),
(10, 4, 'Wensday', '12:15:00', '14:15:00', 0),
(11, 5, 'Thursday', '12:15:00', '14:15:00', 0),
(12, 5, 'Friday', '12:15:00', '14:15:00', 0),
(13, 6, 'Monday', '16:00:00', '18:00:00', 0),
(14, 6, 'Wensday', '16:00:00', '18:00:00', 0),
(15, 7, 'Tuesday', '16:00:00', '18:00:00', 0),
(16, 7, 'Thursday', '16:00:00', '18:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_serial_no`
--

CREATE TABLE `tbl_serial_no` (
  `sn_id` int(5) NOT NULL,
  `sn_num` varchar(10) NOT NULL,
  `pro_id` int(5) NOT NULL,
  `sn_sold` tinyint(1) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE `tbl_service` (
  `ser_id` int(5) NOT NULL,
  `ser_date` date NOT NULL,
  `ser_description` varchar(300) NOT NULL,
  `owner_name` varchar(25) NOT NULL,
  `owner_mobile` int(10) NOT NULL,
  `pro_id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  `ser_is_free` tinyint(1) NOT NULL,
  `ser_amt` int(5) NOT NULL,
  `emp_id` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `stud_id` int(5) NOT NULL,
  `stud_fname` varchar(25) NOT NULL,
  `stud_lname` varchar(25) NOT NULL,
  `stud_gender` varchar(6) NOT NULL,
  `stud_dob` varchar(10) NOT NULL,
  `stud_mobile` bigint(10) NOT NULL,
  `stud_email` varchar(30) NOT NULL,
  `stud_address` varchar(250) NOT NULL,
  `area_id` int(5) NOT NULL,
  `stud_password` varchar(20) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`stud_id`, `stud_fname`, `stud_lname`, `stud_gender`, `stud_dob`, `stud_mobile`, `stud_email`, `stud_address`, `area_id`, `stud_password`, `is_delete`) VALUES
(1, 'Parth', 'Thakkar', 'Male', '07/18/1999', 8735055104, 'parthbt143@gmail.com', '31 Picnic Park Soc , Nr Tankar Recidency ', 3, '9355', 0),
(2, 'Neel', 'Gajjar', 'Male', '05/15/1997', 9624496658, 'neelgajar15@gmail.com', 'A 104 Gopalanandan Recidency ', 7, '', 0),
(3, 'Namarta', 'Patel', 'Female', '08/13/1998', 9865321545, 'npatel138@gmail.com', '302 Krishna Flats', 2, '', 0),
(4, 'Piyush', 'Devani', 'Male', '12/08/1994', 96655125485, 'piyushdevani128@gmail.com', '12 Tankar Recidency ', 3, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_category`
--

CREATE TABLE `tbl_sub_category` (
  `sc_id` int(5) NOT NULL,
  `cat_id` int(5) NOT NULL,
  `sc_name` varchar(25) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sub_category`
--

INSERT INTO `tbl_sub_category` (`sc_id`, `cat_id`, `sc_name`, `is_delete`) VALUES
(1, 1, 'Acoustic Guitar', 0),
(2, 1, 'Electric Guitar', 0),
(3, 1, 'Classical Guitar', 0),
(4, 2, 'Electric Key Board', 0),
(7, 2, 'Midi Key Board', 0),
(8, 2, 'Digital Key Board', 0),
(9, 3, 'Acoustic Drum', 0),
(10, 3, 'Electronic Drum', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `sup_id` int(5) NOT NULL,
  `sup_name` varchar(25) NOT NULL,
  `sup_address` varchar(250) NOT NULL,
  `area_id` int(5) NOT NULL,
  `is_delete` int(1) NOT NULL,
  `sup_mobile` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`sup_id`, `sup_name`, `sup_address`, `area_id`, `is_delete`, `sup_mobile`) VALUES
(1, 'Parth B ', '31 Picnic Park Society ,', 1, 0, 8735055104);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`ad_id`),
  ADD UNIQUE KEY `ad_email` (`ad_email`);

--
-- Indexes for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  ADD PRIMARY KEY (`adm_id`),
  ADD KEY `stud_id` (`stud_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `cust_email` (`cust_email`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  ADD PRIMARY KEY (`des_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_mobile` (`emp_mobile`),
  ADD KEY `des_id` (`des_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `tbl_estimation`
--
ALTER TABLE `tbl_estimation`
  ADD PRIMARY KEY (`est_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`faq_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `tbl_fees`
--
ALTER TABLE `tbl_fees`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `tbl_offer`
--
ALTER TABLE `tbl_offer`
  ADD PRIMARY KEY (`of_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `sn_id` (`sn_id`);

--
-- Indexes for table `tbl_photo`
--
ALTER TABLE `tbl_photo`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `sc_id` (`sc_id`),
  ADD KEY `com_id` (`com_id`),
  ADD KEY `of_id` (`of_id`);

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`pur_id`),
  ADD KEY `sup_id` (`sup_id`);

--
-- Indexes for table `tbl_purchase_detail`
--
ALTER TABLE `tbl_purchase_detail`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `pur_id` (`pur_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `tbl_ratings_and_review`
--
ALTER TABLE `tbl_ratings_and_review`
  ADD PRIMARY KEY (`rr_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `tbl_serial_no`
--
ALTER TABLE `tbl_serial_no`
  ADD PRIMARY KEY (`sn_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`ser_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`stud_id`),
  ADD UNIQUE KEY `stud_email` (`stud_email`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `tbl_sub_category`
--
ALTER TABLE `tbl_sub_category`
  ADD PRIMARY KEY (`sc_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`sup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `ad_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  MODIFY `adm_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `area_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  MODIFY `batch_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `com_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cust_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  MODIFY `des_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `emp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_estimation`
--
ALTER TABLE `tbl_estimation`
  MODIFY `est_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `faq_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_fees`
--
ALTER TABLE `tbl_fees`
  MODIFY `fee_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_offer`
--
ALTER TABLE `tbl_offer`
  MODIFY `of_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `od_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_photo`
--
ALTER TABLE `tbl_photo`
  MODIFY `photo_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pro_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `pur_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_purchase_detail`
--
ALTER TABLE `tbl_purchase_detail`
  MODIFY `pd_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_ratings_and_review`
--
ALTER TABLE `tbl_ratings_and_review`
  MODIFY `rr_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `s_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_serial_no`
--
ALTER TABLE `tbl_serial_no`
  MODIFY `sn_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_service`
--
ALTER TABLE `tbl_service`
  MODIFY `ser_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `stud_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_sub_category`
--
ALTER TABLE `tbl_sub_category`
  MODIFY `sc_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `sup_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  ADD CONSTRAINT `tbl_admission_ibfk_1` FOREIGN KEY (`stud_id`) REFERENCES `tbl_student` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_admission_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `tbl_batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD CONSTRAINT `tbl_batch_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD CONSTRAINT `tbl_employee_ibfk_1` FOREIGN KEY (`des_id`) REFERENCES `tbl_designation` (`des_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_employee_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `tbl_area` (`area_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_estimation`
--
ALTER TABLE `tbl_estimation`
  ADD CONSTRAINT `tbl_estimation_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `tbl_customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD CONSTRAINT `tbl_faq_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `tbl_product` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `tbl_customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `tbl_order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_photo`
--
ALTER TABLE `tbl_photo`
  ADD CONSTRAINT `tbl_photo_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `tbl_product` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`sc_id`) REFERENCES `tbl_sub_category` (`sc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD CONSTRAINT `tbl_purchase_ibfk_1` FOREIGN KEY (`sup_id`) REFERENCES `tbl_supplier` (`sup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_purchase_detail`
--
ALTER TABLE `tbl_purchase_detail`
  ADD CONSTRAINT `tbl_purchase_detail_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `tbl_product` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_purchase_detail_ibfk_3` FOREIGN KEY (`pur_id`) REFERENCES `tbl_purchase` (`pur_id`);

--
-- Constraints for table `tbl_ratings_and_review`
--
ALTER TABLE `tbl_ratings_and_review`
  ADD CONSTRAINT `tbl_ratings_and_review_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `tbl_customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD CONSTRAINT `tbl_schedule_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `tbl_batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_serial_no`
--
ALTER TABLE `tbl_serial_no`
  ADD CONSTRAINT `tbl_serial_no_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `tbl_product` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `tbl_student_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `tbl_area` (`area_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sub_category`
--
ALTER TABLE `tbl_sub_category`
  ADD CONSTRAINT `tbl_sub_category_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
