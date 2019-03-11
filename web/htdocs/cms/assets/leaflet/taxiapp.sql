-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2017 at 02:10 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxiapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `username` varchar(250) CHARACTER SET latin1 NOT NULL,
  `password` varchar(250) CHARACTER SET latin1 NOT NULL,
  `role` varchar(250) CHARACTER SET latin1 NOT NULL,
  `email` varchar(250) CHARACTER SET latin1 NOT NULL,
  `mobile` varchar(250) CHARACTER SET latin1 NOT NULL,
  `gender` varchar(250) CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `name`, `username`, `password`, `role`, `email`, `mobile`, `gender`, `image`) VALUES
(1, 'Reni Vodenicharska', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'sarju@techintegrity.in', '1452635874', 'male', 'adminimage/admin.png');

-- --------------------------------------------------------

--
-- Table structure for table `airport_details`
--

CREATE TABLE `airport_details` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airport_details`
--

INSERT INTO `airport_details` (`id`, `name`) VALUES
(7, '   Singapore'),
(10, 'Melbourne');

-- --------------------------------------------------------

--
-- Table structure for table `app_languages`
--

CREATE TABLE `app_languages` (
  `id` int(100) NOT NULL,
  `language_name` varchar(50) NOT NULL,
  `language_meta` longtext NOT NULL,
  `status` varchar(10) NOT NULL COMMENT '0->disabled, 1->Enaled'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_languages`
--

INSERT INTO `app_languages` (`id`, `language_name`, `language_meta`, `status`) VALUES
(8, 'Tamil', '{"New_user_Sign_Up_Now":"\\u0baa\\u0bc1\\u0ba4\\u0bbf\\u0baf \\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd ? \\u0b87\\u0baa\\u0bcd\\u0baa\\u0bc6\\u0bbe\\u0ba4\\u0bc1 \\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd !","Sign_In":"\\u0b89\\u0bb3\\u0bcd\\u0ba8\\u0bc1\\u0bb4\\u0bc8\\u0baf\\u0bb5\\u0bc1\\u0bae\\u0bcd","Forgot_Password":"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd \\u0bae\\u0bb1\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0bbf\\u0b9f\\u0bcd\\u0b9f\\u0bc0\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bbe","Or_sign_In_with":"\\u0b85\\u0bb2\\u0bcd\\u0bb2\\u0ba4\\u0bc1 \\u0b95\\u0bc6\\u0bbe\\u0ba3\\u0bcd\\u0b9f\\u0bc1 \\u0b89\\u0bb3\\u0bcd\\u0ba8\\u0bc1\\u0bb4\\u0bc8\\u0baf\\u0bb5\\u0bc1\\u0bae\\u0bcd","SIGN_UP":"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1","Name":"\\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bcd","User_Name":"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd\\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bcd","Mobile":"\\u0bae\\u0bc6\\u0bbe\\u0baa\\u0bc8\\u0bb2\\u0bcd","Mail":"\\u0bae\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0b9e\\u0bcd\\u0b9a\\u0bb2\\u0bcd","Password":"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd","Confirm_Password":"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\\u0bb2\\u0bc8 \\u0b89\\u0bb1\\u0bc1\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\\u0b95","Enter_your_name":"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd","Enter_user_name":"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd\\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bcd \\u0ba8\\u0bc1\\u0bb4\\u0bc8\\u0baf","Enter_your_number":"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b8e\\u0ba3\\u0bcd\\u0ba3\\u0bc8 \\u0b9a\\u0bc7\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd","Enter_valid_mobile_number":"\\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0bae\\u0bc6\\u0bbe\\u0baa\\u0bc8\\u0bb2\\u0bcd \\u0b8e\\u0ba3\\u0bcd\\u0ba3\\u0bc8 \\u0b9a\\u0bc7\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd","Enter_email":"\\u0bae\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0b9e\\u0bcd\\u0b9a\\u0bb2\\u0bcd \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd","Enter_valid_email":"\\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0bae\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0b9e\\u0bcd\\u0b9a\\u0bb2\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd","Enter_Password":"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd \\u0ba8\\u0bc1\\u0bb4\\u0bc8\\u0baf","Minimum_6_characters":"\\u0b95\\u0bc1\\u0bb1\\u0bc8\\u0ba8\\u0bcd\\u0ba4\\u0baa\\u0b9f\\u0bcd\\u0b9a\\u0bae\\u0bcd 6 \\u0b8e\\u0bb4\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1","Passwords_do_not_match":"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb1\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0ba8\\u0bcd\\u0ba4\\u0bb5\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bc8","Enter_user_name_email_mobile":"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd \\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bcd \\/ \\u0bae\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0b9e\\u0bcd\\u0b9a\\u0bb2\\u0bcd \\/ \\u0bae\\u0bc6\\u0bbe\\u0baa\\u0bc8\\u0bb2\\u0bcd \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd","My_Trips":"\\u0b8e\\u0ba9\\u0bcd \\u0baa\\u0baf\\u0ba3\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd","Logout":"\\u0bb5\\u0bc6\\u0bb3\\u0bbf\\u0baf\\u0bc7\\u0bb1\\u0bc1","My_Ride":"\\u0b8e\\u0ba9\\u0bcd \\u0bb0\\u0bc8\\u0b9f\\u0bc1","NEW_RIDES":"\\u0baa\\u0bc1\\u0ba4\\u0bbf\\u0baf \\u0b9a\\u0bb5\\u0bbe\\u0bb0\\u0bbf\\u0b95\\u0bb3\\u0bcd","COMPLETED":"\\u0ba8\\u0bbf\\u0bb1\\u0bc8\\u0bb5\\u0bc1","CANCELLED":"\\u0bb0\\u0ba4\\u0bcd\\u0ba4\\u0bc1","Trip_Details":"\\u0baa\\u0baf\\u0ba3\\u0bae\\u0bcd \\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd","BOOKING_ID":"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1 \\u0b90\\u0b9f\\u0bbf\\u0baf\\u0bc8","PICKUP_POINT":"\\u0b8e\\u0b9f\\u0bc1 \\u0baa\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0bbf","TO":"TO T","DROP_POINT":"DROP POINT T","VEHICLE_DETAILS":"VEHICLE DETAILS T","CAB_TYPE":"CAB TYPE T","DRIVER_DETAILS":"DRIVER DETAILS T","Payment_Details":"Payment Details T","Distance":"Details T","Total_Amount":"Total Amount T","Accept":"Accept T","SEND_YOUR_FEED_BACK":"SEND YOUR FEED BACK T","No_network_connection":"No network connection! T","GET_DIRECTIONS":"GET DIRECTIONS T","START_NOW":"START NOW T","Map_View":"Map View T","Rate_Card":"Rate Card T","RUNNING_DETAILES":"RUNNING DETAILES T","CURRENT_LOCATION":"CURRENT LOCATION T","MINIMUM_DISTANCE":"MINIMUM DISTANCE T","MINIMUM_RATE":"MINIMUM RATE T","STANDARD_RATE":"STANDARD RATE T","TRIP_TYPE":"TRIP TYPE T","TOTAL_TRAVELED":"TOTAL TRAVELED T","TOTAL_RATE":"TOTAL RATE T","CANCEL":"CANCEL T","STOP":"STOP T","hidden_lang":"Tamil"}', '1'),
(9, 'English', '', '0'),
(10, 'Malayalam', '', '0'),
(11, 'Telunk', '', '0'),
(12, 'Marathi ', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `block_name` text NOT NULL,
  `blog_content` text NOT NULL,
  `baner_car` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `block_name`, `blog_content`, `baner_car`) VALUES
(1, 'Quality&Reliability1', '<div class="clm-1"><div class="container"><div class="secssion3"><div class="row"><div class="col-md-3"><h3 class="head-sec3"><img src="#s#/assets/images/quality.png" alt="" /> Quality</h3><ul class="seclist3"><li>Pool of well maintained cars to choose from</li><li>Amenities for comfort and convenience</li><li>Well trained and experienced cab drivers</li></ul></div><div class="col-md-3"><h3 class="head-sec3"><img src="#s#/assets/images/reliability.png" alt="" /> Reliability</h3><ul class="seclist3"><li>24hr cab availability</li><li>Modern technologies for better experience and safety</li><li>Safe and reliable service at affordable pricing</li></ul></div><div class="col-md-6"><div class="right-section"><ul class="list-rightsec"><li><img class="left-symbol" src="#s#/assets/images/cashless-ride.png" alt="" /></li><li class="para-listright"><p class="para-right1">YOUR RIDE JUST MADE MORE COMFORTABLE.</p><p class="para-right2">INTRODUCING CASHLESS RIDE!</p></li><li><input class="refillbtn" type="button" value="Refill Your Wallet" data-target="#newwallet" data-toggle="modal" /></li></ul></div></div></div></div></div></div>', ''),
(2, 'Call us 24 hours available1', '<div class="clm-2">\n<div class="container">\n<div class="secssion4">\n<div class="row">\n<div class="col-md-3">\n<div class="image-secssion"><img src="#s#/assets/images/contact-image.png" alt="" /></div>\n</div>\n<div class="col-md-9">\n<ul class="right-clm2">\n<li>\n<h3 class="clm2-head3">Call us 24 hours available</h3>\n</li>\n<li>\n<h2 class="clm2-head2">800 666 7777</h2>\n</li>\n<li>\n<p class="clm2-paralast">Call My Cab is a taxi and cab service provider across India, we provide the most convenient and affordable taxi services in just a mouse click. Our cabs will be at your door steps within short time and this would save you from calling multiple cab companies for checking cab availability. We promise you a safer and affordable trip, experience an amazing journey at a smarter price.</p>\n</li>\n</ul>\n</div>\n</div>\n</div>\n</div>\n</div>', ''),
(3, 'It''s New and It''s Everywhere!', '<div class="clm-3">\n<div class="container">\n<div class="secssion5">\n<div class="row">\n<div class="col-md-5">\n<div class="clm3-sect">\n<h3 class="clm3h3">It''s New and It''s Everywhere!</h3>\n<p class="clm3p">India&rsquo;s quickest and most amazing and affordable way to book and track a cab is here. Download our free Call My Cab app now and make the most convenient and amazing cab service in your pockets, Be taxi ready always.</p>\n<h4 class="clm3h4">Get Call My Cab on your mobile.</h4>\n<p>+91 <input class="field5" name="email1" type="text" placeholder="" /> <input class="sentlinkbtn" type="button" value="Send me the link!" /></p>\n</div>\n</div>\n<div class="col-md-7">\n<ul class="image-right3">\n<li><img src="#s#/assets/images/mobile_app.png" alt="" /></li>\n</ul>\n</div>\n</div>\n</div>\n</div>\n</div>', ''),
(4, 'footer', '<div class="clm-4"><div class="container"><div class="secssion6"><div class="row"><div class="col-md-9"><h3 class="head-ourcities1">Our cities</h3><ul class="clm4-list"><li><p class="headlist-para">Bangalore</p><p>Bangalore City Cab Service</p><p>Bangalore Airport Cab Service</p></li><li><p class="headlist-para">Chennai</p><p>Chennai City Cab Service</p><p>Chennai Airport Cab Service</p></li><li><p class="headlist-para">Delhi</p><p>Delhi City Cab Service</p><p>Delhi Airport Cab Service</p></li><li class="marginright-none"><p class="headlist-para">Hyderabad</p><p>Hyderabad City Cab Service</p><p>Hyderabad Airport Cab Service</p></li></ul></div> <div class="col-md-3">       		  <h3 class="head-ourcities2">Follow Us</h3>                                        <ul class="social-media">                    	<a href="#"><li class="facebookicon"></li></a>                    	<a href="#"><li class="twittericon"></li></a>                        <a href="#"><li class="googleplusicon"></li></a>                        <a href="#"><li class="linkedinicon"></li></a>                    </ul>                                   </div></div></div></div></div><div class="footer"><div class="container"><div class="secssion7"><div class="row"><div class="col-md-5"><p class="footer-para">&copy; 2015 Callmycab Pvt. Ltd Privacy Policy Terms of Service</p></div><div class="col-md-7"><ul class="footer-list"><li><a href="#s#/callmycab/page_index/about_us">About Us</a> |</li><li><a>Blog</a> |</li><li><a>FAQ</a> |</li><li><a>Press</a> |</li><li><a>Careers</a> |</li><li><a>Our Partners</a> |</li><li><a>Contact Us</a> |</li><li><a>Sitemap Fares</a></li></ul></div></div></div></div></div>', ''),
(5, 'Banner Image', 'assets/images/images/banner-inner.png', 'assets/images/images/car.png');

-- --------------------------------------------------------

--
-- Table structure for table `bookingdetails`
--

CREATE TABLE `bookingdetails` (
  `id` int(10) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `user_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `purpose` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pickup_area` varchar(100) CHARACTER SET utf8 NOT NULL,
  `drop_area` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pickup_date_time` datetime NOT NULL,
  `taxi_type` varchar(100) CHARACTER SET utf8 NOT NULL,
  `taxi_id` int(5) NOT NULL,
  `departure_date_time` datetime NOT NULL,
  `package` varchar(50) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `status_code` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT 'pending',
  `promo_code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `book_create_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `distance` int(11) NOT NULL,
  `isdevice` varchar(50) CHARACTER SET utf8 NOT NULL,
  `approx_time` varchar(255) CHARACTER SET utf8 NOT NULL,
  `amount` int(11) NOT NULL,
  `final_amount` int(11) NOT NULL,
  `pickup_address` text CHARACTER SET utf8 NOT NULL,
  `transfer` varchar(50) CHARACTER SET utf8 NOT NULL,
  `assigned_for` int(10) NOT NULL,
  `person` int(11) NOT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `km` int(11) NOT NULL,
  `timetype` varchar(50) CHARACTER SET utf8 NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL,
  `driver_status` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pickup_lat` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pickup_long` varchar(255) CHARACTER SET utf8 NOT NULL,
  `drop_lat` varchar(255) CHARACTER SET utf8 NOT NULL,
  `drop_long` varchar(255) CHARACTER SET utf8 NOT NULL,
  `flag` varchar(10) CHARACTER SET utf8 NOT NULL,
  `reason` text CHARACTER SET utf8 NOT NULL,
  `area_id` int(11) NOT NULL,
  `website_commision` int(11) NOT NULL,
  `driver_commision` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `adult_13plus` int(11) NOT NULL,
  `child_13less` int(11) NOT NULL,
  `child_7less` int(11) NOT NULL,
  `infant_1less` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookingdetails`
--

INSERT INTO `bookingdetails` (`id`, `username`, `user_id`, `purpose`, `pickup_area`, `drop_area`, `pickup_date_time`, `taxi_type`, `taxi_id`, `departure_date_time`, `package`, `status`, `status_code`, `promo_code`, `book_create_date_time`, `distance`, `isdevice`, `approx_time`, `amount`, `final_amount`, `pickup_address`, `transfer`, `assigned_for`, `person`, `payment_type`, `transaction_id`, `km`, `timetype`, `comment`, `driver_status`, `pickup_lat`, `pickup_long`, `drop_lat`, `drop_long`, `flag`, `reason`, `area_id`, `website_commision`, `driver_commision`, `payment_status`, `adult_13plus`, `child_13less`, `child_7less`, `infant_1less`) VALUES
(137, 'danail_christoff@yahoo.de', '206', 'Point to Point Transfer', ' Industrie Hardwald,8951,Fahrweid,Zürich,Schweiz', 'Wirtwisstrasse 9, 8951 Fahrweid, Schweiz', '2017-01-26 19:03:10', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-01-26 18:03:18', 0, '0', '2 mins', 10, 0, '', '', 0, 1, 'cash', '', 1, 'night', '', '', '47.406378', '8.414363', '47.406574', '8.413031', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(138, 'danail_christoff@yahoo.de', '206', 'Point to Point Transfer', ' Industrie Hardwald,8951,Fahrweid,Zürich,Schweiz', 'Wirtwisstrasse 9, 8951 Fahrweid, Schweiz', '2017-01-26 19:04:37', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-01-26 18:04:42', 0, '0', '2 mins', 10, 11, '', '', 44, 1, 'card', '', 1, 'night', '', '', '47.406368', '8.414345', '47.406574', '8.413031', '0', '', 0, 1, 10, 2, 0, 0, 0, 0),
(139, 'danail_christoff@yahoo.de', '206', 'Point to Point Transfer', ' Industrie Hardwald,8951,Fahrweid,Zürich,Schweiz', 'Wirtwisstrasse 9, 8951 Fahrweid, Schweiz', '2017-01-26 20:11:09', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-01-26 19:11:12', 0, '0', '2 mins', 10, 11, '', '', 44, 1, 'cash', '', 1, 'night', 'Kokoschka', '', '47.406367', '8.414343', '47.406574', '8.413031', '0', '', 0, 1, 10, 2, 0, 0, 0, 0),
(140, 'danail_christoff@yahoo.de', '206', 'Point to Point Transfer', '14,Hardwaldstrasse,8951,Fahrweid,Zürich,Schweiz', 'Wirtwisstrasse 9, 8951 Fahrweid, Schweiz', '2017-01-26 21:22:56', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-01-26 20:23:24', 0, '0', '2 mins', 10, 11, '', '', 44, 1, 'cash', '', 1, 'night', '', '', '47.406838', '8.414411', '47.406574', '8.413031', '0', '', 0, 1, 10, 2, 0, 0, 0, 0),
(141, 'danail_christoff@yahoo.de', '206', 'Point to Point Transfer', '14,Hardwaldstrasse,8951,Fahrweid,Zürich,Schweiz', 'Wirtwisstrasse 9, 8951 Fahrweid, Schweiz', '2017-01-26 21:24:30', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-01-26 20:24:36', 0, '0', '2 mins', 10, 11, '', '', 44, 1, 'card', '', 1, 'night', '', '', '47.406741', '8.414478', '47.406574', '8.413031', '0', '', 0, 1, 10, 2, 0, 0, 0, 0),
(143, 'danail_christoff@yahoo.de', '206', 'Point to Point Transfer', '43,Limmattalstrasse,8954,Geroldswil,Zürich,Schweiz', 'Dietikon, Schweiz', '2017-01-28 22:10:20', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-01-28 21:10:52', 0, '0', '6 mins', 14, 0, '', '', 0, 1, 'cash', '', 3, 'night', '', '', '47.419812', '8.413306', '47.405389', '8.399770', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(144, 'danail_christoff@yahoo.de', '206', 'Point to Point Transfer', '43,Limmattalstrasse,8954,Geroldswil,Zürich,Schweiz', '8001 Zürich, Schweiz', '2017-01-28 22:11:54', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-01-28 21:12:44', 0, '0', '23 mins', 48, 0, '', '', 0, 1, 'cash', '', 16, 'night', '', '', '47.419819', '8.413288', '47.378355', '8.540691', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(145, 'danail_christoff@yahoo.de', '206', 'Point to Point Transfer', '43,Limmattalstrasse,8954,Geroldswil,Zürich,Schweiz', '8001 Zürich, Schweiz', '2017-01-28 22:14:06', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-01-28 21:14:13', 0, '0', '23 mins', 48, 0, '', '', 0, 1, 'cash', '', 16, 'night', '', '', '47.419763', '8.413454', '47.378355', '8.540691', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(146, 'viresh@cloudusout.com', '209', 'Point to Point Transfer', ' Veilingboulevard,1432,Aalsmeer,Noord-Holland,Nederland', 'Slingerduin, 1187 Amstelveen, Nederland', '2017-01-30 16:23:21', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-01-30 15:23:46', 0, '0', '10 mins', 18, 0, '', '', 0, 1, 'cash', '', 5, 'day', '', '', '52.261956', '4.787363', '52.284804', '4.827314', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(148, 'srinivasdadi9000@gmail.com', '213', 'Point to Point Transfer', 'vizag', 'dwaraka nagar vizah', '2017-02-04 12:10:00', 'Family Van', 60, '0000-00-00 00:00:00', '', 4, 'user-cancelled', '', '2017-02-04 06:39:12', 0, '1', '36 mins', 84, 0, '', '', 0, 1, '', '', 18, 'day', '', '', '17.6868159', '83.2184815', '17.7307042', '83.308702', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(161, 'webuser', '225', 'Point to Point Transfer', 'ZÃ¼rich HB, ZÃ¼rich, Schweiz', 'Bern, Schweiz', '2017-02-22 18:45:04', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-02-15 23:53:00', 0, '0', '1 hour 27 mins', 882, 0, '', '', 0, 3, '', '', 123, 'night', '', '', '47.377938', '8.5401898', '46.9479739', '7.4474468', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(162, 'webuser', '226', 'Point to Point Transfer', 'ZÃ¼rich, Schweiz', 'Basel-Landschaft, Schweiz', '2017-02-17 14:15:56', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-02-16 16:42:34', 0, '0', '1 hour 0 mins', 648, 0, '', '', 0, 3, '', '', 84, 'day', '', '', '47.3768866', '8.541694', '47.4418122', '7.7644002', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(163, 'webuser', '223', 'Point to Point Transfer', 'Sofia, Ð‘ÑŠÐ»Ð³Ð°Ñ€Ð¸Ñ', 'Burgas, Ð‘ÑŠÐ»Ð³Ð°Ñ€Ð¸Ñ', '2017-02-16 13:10:42', 'Family Van', 60, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-02-16 16:52:50', 0, '0', '3 hours 33 mins', 3522, 0, '', '', 0, 3, '', '', 383, 'day', '', '', '42.6977082', '23.3218675', '42.5047926', '27.4626361', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(173, 'tismember3@gmail.com', '224', 'Point to Point Transfer', 'Street Number 1,Bharatvan Society, Nalanda Society,Rajkot, Gujarat 360001,Rajkot,360001,India', '150 Feet Ring Road, Giranar Society, Jamuna Park, Rajkot, Gujarat, India', '2017-02-24 17:28:00', 'Economy', 62, '0000-00-00 00:00:00', '', 4, 'user-cancelled', '', '2017-02-23 11:59:08', 0, '1', '6 mins', 14, 0, '', '', 0, 1, '', '', 2, 'day', '', '', '22.2883965', '70.7772195', '22.2901051', '70.7709785', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(178, 'enonchev@gmail.com', '199', 'Point to Point Transfer', '   Burgas,Burgas,Bulgaria', 'sofia', '2017-02-24 10:13:38', 'Economy', 62, '0000-00-00 00:00:00', '', 4, 'user-cancelled', '', '2017-02-24 08:13:53', 0, '0', '3 hours 38 mins', 978, 0, '', '', 0, 1, 'cash', '', 384, 'day', '', '', '42.494086', '27.457512', '42.697376', '23.324039', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(179, 'enonchev@gmail.com', '199', 'Point to Point Transfer', '   Burgas,Burgas,Bulgaria', 'Pomorie, Bulgaria', '2017-02-24 10:22:09', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-02-24 08:22:12', 0, '0', '23 mins', 58, 61, '', '', 20, 1, 'cash', '', 21, 'day', '', '', '42.494086', '27.457512', '42.568049', '27.615570', '0', '', 0, 3, 58, 2, 0, 0, 0, 0),
(180, 'Evgeny', '229', 'Point to Point Transfer', '   Burgas,Burgas,Bulgaria', 'Sofia, Bulgaria', '2017-02-24 10:37:07', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-02-24 08:37:12', 0, '0', '3 hours 40 mins', 980, 981, '', '', 20, 1, 'cash', '', 384, 'day', '', '', '42.494086', '27.457513', '42.697715', '23.321870', '0', '', 0, 49, 932, 2, 0, 0, 0, 0),
(219, 'user@sharklasers.com', '182', 'Point to Point Transfer', 'ulitsa Knyaz Boris I 25–35,Burgas,Burgas,Bulgaria', '8016 Burgas, Bulgaria', '2017-02-25 12:00:25', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-02-25 10:00:32', 0, '0', '16 mins', 31, 35, '', '', 20, 1, 'card', '', 12, 'day', '', '', '42.496954', '27.465505', '42.564930', '27.516515', '0', '', 0, 2, 33, 2, 0, 0, 0, 0),
(220, 'user@sharklasers.com', '182', 'Point to Point Transfer', 'ulitsa Aleksandar Veliki 41–46,Burgas,Burgas,Bulgaria', 'ulitsa Gen. Mayor Lermontov 15,Burgas,Burgas,Bulgaria', '2017-02-25 12:15:42', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-02-25 10:15:55', 0, '0', '7 mins', 15, 16, '', '', 20, 1, 'card', '', 2, 'day', '', '', '42.494724', '27.466424', '42.493352', '27.474179', '0', '', 0, 1, 15, 2, 0, 0, 0, 0),
(223, 'tismember2@gmail.com', '228', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot, Gujarat, India', '2017-02-25 17:29:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-02-25 11:59:33', 0, '1', '13 mins', 13, 13, '', '', 60, 1, 'cash', '', 5, 'day', '', '', '22.2814036', '70.7763142', '22.3038945', '70.8021599', '0', '', 0, 1, 12, 2, 0, 0, 0, 0),
(224, 'tismember2@gmail.com', '228', 'Point to Point Transfer', ' Ring Road,360005,Rajkot,Gujarat,India', 'Ring Rd, Jala Ram Nagar, Rajkot, Gujarat 360007, India', '2017-02-27 07:50:43', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-02-27 04:52:03', 0, '0', '5 mins', 10, 0, '', '', 0, 1, 'cash', '', 3, 'night', '', '', '22.281336', '70.775570', '22.288545', '70.771341', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(225, 'tismember2@gmail.com', '228', 'Point to Point Transfer', 'Ring Rd, Jala Ram Nagar, Rajkot, Gujarat 360007, India', 'Kotecha Cir, Nutan Nagar, Rajkot, Gujarat 360001, India', '2017-02-28 07:45:30', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-02-28 04:45:33', 0, '0', '5 mins', 10, 10, '', '', 60, 1, 'cash', '', 2, 'night', '', '', '22.288545', '70.771341', '22.290376', '70.778637', '0', '', 0, 1, 9, 2, 0, 0, 0, 0),
(226, 'tismember3@gmail.com', '224', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'rajkot', '2017-02-28 10:16:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-02-28 04:46:32', 0, '1', '13 mins', 13, 0, '', '', 0, 1, '', '', 5, 'day', '', '', '22.2814036', '70.7763142', '22.3038945', '70.8021599', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(227, 'tismember2@gmail.com', '228', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot', '2017-02-28 11:57:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-02-28 06:27:30', 0, '1', '13 mins', 13, 7, '', '', 45, 1, 'cash', '', 5, 'day', '', '', '22.2814036', '70.7763142', '22.3038945', '70.8021599', '0', '', 0, 0, 7, 2, 0, 0, 0, 0),
(228, 'tismember2@gmail.com', '228', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot', '2017-02-28 11:58:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-02-28 06:28:57', 0, '1', '13 mins', 13, 13, '', '', 60, 1, 'cash', '', 5, 'day', '', '', '22.2814036', '70.7763142', '22.3038945', '70.8021599', '0', '', 0, 1, 12, 2, 0, 0, 0, 0),
(229, 'user@sharklasers.com', '182', 'Point to Point Transfer', '6254 Opalchenets, Bulgaria', 'Burgas, Bulgaria', '2017-03-01 18:09:18', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-01 16:09:27', 0, '0', '1 hour 59 mins', 382, 383, '', '', 20, 1, 'cash', '', 212, 'night', 'test', '', '42.206475', '25.123182', '42.504787', '27.462647', '0', '', 0, 19, 364, 2, 0, 0, 0, 0),
(230, 'user@sharklasers.com', '182', 'Point to Point Transfer', 'A1, Stara Zagora,Bulgaria', 'Burgas, Bulgaria', '2017-03-01 18:16:22', 'Economy', 62, '0000-00-00 00:00:00', '', 3, 'accepted', '', '2017-03-01 16:16:28', 0, '0', '1 hour 43 mins', 348, 0, '', '', 20, 1, 'cash', '', 195, 'night', '', '', '42.210813', '25.310292', '42.504787', '27.462647', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(231, 'tismember2@gmail.com', '228', 'Point to Point Transfer', 'Raiya Chokdi, Naval Nagar, Sardar Nagar, Rajkot, Gujarat 360004, India', 'Big Bazar, BRTS, Karan Park, Rajkot, Gujarat 360005, India', '2017-03-02 10:57:35', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-02 05:27:41', 0, '0', '8 mins', 11, 11, '', '', 60, 1, 'cash', '', 3, 'day', '', '', '22.270410', '70.790602', '22.280426', '70.775852', '0', '', 0, 1, 10, 2, 0, 0, 0, 0),
(243, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-02 19:25:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-02 18:57:07', 0, '0', '1 hour 20 mins', 158, 0, '', '', 0, 1, '', '', 67, 'night', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 0, 0, 0),
(244, 'webuser', '232', 'Point to Point Transfer', 'Sofia, Ð‘ÑŠÐ»Ð³Ð°Ñ€Ð¸Ñ', 'Burgas, Ð‘ÑŠÐ»Ð³Ð°Ñ€Ð¸Ñ', '2017-03-02 15:05:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-02 19:01:23', 0, '0', '3 hours 36 mins', 2656, 0, '', '', 0, 4, '', '', 383, 'day', '', '', '42.6977082', '23.3218675', '42.5047926', '27.4626361', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(245, 'Christoff', '235', 'Point to Point Transfer', 'hardwalstrasse 14, 8951 Fahrweid ', '8058 Zürich-Flughafen, Schweiz', '2017-03-02 23:34:42', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-02 22:35:49', 0, '0', '20 mins', 29, 0, '', '', 0, 4, 'cash', '', 16, 'night', '', '', '47.406848', '8.414405', '47.452659', '8.548307', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(246, 'Christoff', '235', 'Point to Point Transfer', '170–174,Brunaustrasse,8951,Fahrweid,Zürich,Schweiz', '8058 Zürich-Flughafen, Schweiz', '2017-03-03 07:20:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-02 23:16:50', 0, '0', '20 mins', 29, 0, '', '', 0, 1, 'cash', '', 16, 'night', 'Не е вярно позиционирането - намери ме ако можеш', '', '47.413205', '8.417378', '47.452659', '8.548307', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(250, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 16:50:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 16:21:28', 0, '0', '1 hour 20 mins', 634, 0, '', '', 0, 4, '', '', 67, 'day', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(251, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 17:05:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 16:35:07', 0, '0', '1 hour 20 mins', 634, 0, '', '', 0, 4, '', '', 67, 'day', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(252, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 17:10:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 16:41:40', 0, '0', '1 hour 20 mins', 634, 0, '', '', 0, 4, '', '', 67, 'day', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(253, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 17:20:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 16:53:43', 0, '0', '1 hour 20 mins', 317, 0, '', '', 0, 2, '', '', 67, 'day', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 0, 0),
(254, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 17:30:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 16:59:25', 0, '0', '1 hour 20 mins', 634, 0, '', '', 0, 4, '', '', 67, 'day', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(255, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 17:35:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 17:06:55', 0, '0', '1 hour 20 mins', 158, 0, '', '', 0, 1, '', '', 67, 'day', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 0, 0, 0),
(256, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 17:40:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 17:12:38', 0, '0', '1 hour 20 mins', 634, 0, '', '', 0, 4, '', '', 67, 'day', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(257, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 17:50:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 17:21:24', 0, '0', '1 hour 20 mins', 158, 0, '', '', 0, 1, '', '', 67, 'day', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 0, 0, 0),
(258, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 17:50:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 17:23:09', 0, '0', '1 hour 20 mins', 158, 0, '', '', 0, 1, '', '', 67, 'day', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 0, 0, 0),
(259, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 17:55:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 17:25:17', 0, '0', '1 hour 20 mins', 158, 0, '', '', 0, 1, '', '', 67, 'day', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 0, 0, 0),
(260, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 18:00:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 17:31:33', 0, '0', '1 hour 20 mins', 158, 0, '', '', 0, 1, '', '', 67, 'night', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 0, 0, 0),
(261, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 18:10:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 17:38:55', 0, '0', '1 hour 20 mins', 634, 0, '', '', 0, 4, '', '', 67, 'night', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(262, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 18:15:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 17:44:50', 0, '0', '1 hour 20 mins', 634, 0, '', '', 0, 4, '', '', 67, 'night', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(263, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 18:35:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 18:06:46', 0, '0', '1 hour 20 mins', 158, 0, '', '', 0, 1, '', '', 67, 'night', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 0, 0, 0),
(264, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 19:00:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 18:32:36', 0, '0', '1 hour 20 mins', 158, 0, '', '', 0, 1, '', '', 67, 'night', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 0, 0, 0),
(265, 'webuser', '231', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 19:15:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 18:44:49', 0, '0', '1 hour 20 mins', 634, 0, '', '', 0, 4, '', '', 67, 'night', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(266, 'webuser', '232', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 19:25:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 18:57:59', 0, '0', '1 hour 20 mins', 634, 0, '', '', 0, 4, '', '', 67, 'night', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(267, 'webuser', '232', 'Point to Point Transfer', 'Rajkot, Gujarat, India', 'Morbi, Gujarat, India', '2017-03-03 19:35:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-03 19:04:37', 0, '0', '1 hour 20 mins', 634, 0, '', '', 0, 4, '', '', 67, 'night', '', '', '22.3038945', '70.8021599', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 1, 1, 1),
(268, 'tismember2@gmail.com', '228', 'Point to Point Transfer', ' Ring Road,360005,Rajkot,Gujarat,India', 'Railway Station Rd, Junction Plot, Rajkot, Gujarat 360001, India', '2017-03-04 13:05:58', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-04 12:06:04', 0, '0', '15 mins', 14, 0, '', '', 0, 1, 'cash', '', 6, 'day', '', '', '22.281377', '70.775550', '22.311676', '70.802339', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(269, 'tismember2@gmail.com', '228', 'Point to Point Transfer', ' Silwar Stand Road 2,360005,Rajkot,Gujarat,India', 'Dhebar Rd S, Karanpara, Rajkot, Gujarat 360001, India', '2017-03-04 13:15:40', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-04 12:15:51', 0, '0', '12 mins', 13, 0, '', '', 0, 1, 'cash', '', 3, 'day', '', '', '22.281847', '70.776563', '22.291412', '70.801842', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(270, 'tismember2@gmail.com', '228', 'Point to Point Transfer', ' Ring Road,360005,Rajkot,Gujarat,India', 'Railway Station Rd, Junction Plot, Rajkot, Gujarat 360001, India', '2017-03-06 05:58:38', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 04:58:41', 0, '0', '15 mins', 14, 14, '', '', 60, 1, 'cash', '', 6, 'night', '', '', '22.281300', '70.775587', '22.311676', '70.802339', '0', '', 0, 1, 13, 2, 0, 0, 0, 0),
(271, 'tismember2@gmail.com', '228', 'Point to Point Transfer', ' Ring Road,360005,Rajkot,Gujarat,India', 'Rajkot, Gujarat, India', '2017-03-06 08:06:13', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-06 07:10:47', 0, '0', '13 mins', 13, 0, '', '', 0, 1, 'cash', '', 5, 'night', '', '', '22.281292', '70.775591', '22.303885', '70.802128', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(272, 'tismember2@gmail.com', '228', 'Point to Point Transfer', ' Ring Road,360005,Rajkot,Gujarat,India', 'Ring Rd, Jala Ram Nagar, Rajkot, Gujarat 360007, India', '2017-03-06 08:15:11', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 07:15:16', 0, '0', '5 mins', 10, 8, '', '', 60, 1, 'cash', '', 3, 'night', '', '', '22.281281', '70.775597', '22.288545', '70.771341', '0', '', 0, 0, 8, 2, 0, 0, 0, 0),
(273, 'tismember2@gmail.com', '228', 'Point to Point Transfer', ' Ring Road,360005,Rajkot,Gujarat,India', 'Dhebar Rd S, Karanpara, Rajkot, Gujarat 360001, India', '2017-03-06 08:36:42', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 07:36:43', 0, '0', '12 mins', 13, 8, '', '', 60, 1, 'cash', '', 4, 'night', '', '', '22.281306', '70.775584', '22.291412', '70.801842', '0', '', 0, 0, 8, 2, 0, 0, 0, 0),
(274, 'tismember2@gmail.com', '228', 'Point to Point Transfer', ' Ring Road,360005,Rajkot,Gujarat,India', 'Dhebar Rd S, Karanpara, Rajkot, Gujarat 360001, India', '2017-03-06 08:36:42', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-06 07:38:33', 0, '0', '12 mins', 13, 0, '', '', 0, 1, 'cash', '', 4, 'night', '', '', '22.281306', '70.775584', '22.291412', '70.801842', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(275, 'tismember2@gmail.com', '228', 'Point to Point Transfer', ' Ring Road,360005,Rajkot,Gujarat,India', 'Jamnagar, Gujarat, India', '2017-03-06 10:42:13', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 09:42:14', 0, '0', '1 hour 42 mins', 183, 142, '', '', 60, 1, 'cash', '', 92, 'day', '', '', '22.281327', '70.775574', '22.470955', '70.057714', '0', '', 0, 7, 135, 2, 0, 0, 0, 0),
(276, 'tismember2@gmail.com', '228', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot, Gujarat, India', '2017-03-06 16:26:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 10:57:10', 0, '1', '13 mins', 13, 7, '', '', 60, 1, 'cash', '', 5, 'day', '', '', '22.2814036', '70.7763142', '22.3038945', '70.8021599', '0', '', 0, 0, 7, 2, 0, 0, 0, 0),
(277, 'tismember2@gmail.com', '228', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot Bus Station, Dhebar Road South, Karanpara, Rajkot, Gujarat, India', '2017-03-06 12:09:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 11:09:56', 0, '1', '12 mins', 13, 8, '', '', 60, 1, 'cash', '', 3, 'day', '', '', '22.2815208', '70.7761827', '22.291327', '70.8021689', '0', '', 0, 0, 8, 2, 0, 0, 0, 0),
(278, 'tismember9@gmail.com', '236', 'Point to Point Transfer', '10, Kalavad Road,Vaishali Nagar,Rajkot, Gujarat 360007,Rajkot,360007,India', 'Rajkot Road, Jai Bhimnagar, Rajkot, Gujarat, India', '2017-03-06 12:39:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 11:39:54', 0, '1', '9 mins', 12, 1, '', '', 62, 1, 'cash', '', 4, 'day', '', '', '22.2951133', '70.7843459', '22.2738849', '70.7572345', '0', '', 0, 0, 1, 2, 0, 0, 0, 0),
(279, 'tismember9@gmail.com', '236', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot Road, Jai Bhimnagar, Rajkot, Gujarat, India', '2017-03-06 13:12:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 12:12:21', 0, '1', '7 mins', 11, 8, '', '', 60, 1, 'cash', '', 3, 'day', '', '', '22.2814036', '70.7763142', '22.2738849', '70.7572345', '0', '', 0, 0, 8, 2, 0, 0, 0, 0),
(280, 'tismember9@gmail.com', '236', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot Airport, Gandhigram, Rajkot, Gujarat, India', '2017-03-06 13:20:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 12:20:47', 0, '1', '12 mins', 13, 1, '', '', 62, 1, 'cash', '', 4, 'day', '', '', '22.2814036', '70.7763142', '22.3088669', '70.7822639', '0', '', 0, 0, 1, 2, 0, 0, 0, 0),
(281, 'tismember9@gmail.com', '236', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot Bus Station, Dhebar Road South, Karanpara, Rajkot, Gujarat, India', '2017-03-06 13:29:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-06 12:30:09', 0, '1', '12 mins', 13, 0, '', '', 0, 1, '', '', 3, 'day', '', '', '22.2814036', '70.7763142', '22.291327', '70.8021689', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(282, 'tismember9@gmail.com', '236', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot Bus Station, Dhebar Road South, Karanpara, Rajkot, Gujarat, India', '2017-03-06 13:43:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 12:44:01', 0, '1', '12 mins', 13, 8, '', '', 62, 1, 'cash', '', 3, 'day', '', '', '22.2814036', '70.7763142', '22.291327', '70.8021689', '0', '', 0, 0, 8, 2, 0, 0, 0, 0),
(283, 'tismember9@gmail.com', '236', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot Road, Jai Bhimnagar, Rajkot, Gujarat, India', '2017-03-06 13:46:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 12:46:40', 0, '1', '7 mins', 11, 8, '', '', 60, 1, 'cash', '', 3, 'day', '', '', '22.2814036', '70.7763142', '22.2738849', '70.7572345', '0', '', 0, 0, 8, 2, 0, 0, 0, 0),
(284, 'tismember9@gmail.com', '236', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot Airport, Gandhigram, Rajkot, Gujarat, India', '2017-03-06 13:53:00', 'Economy', 62, '0000-00-00 00:00:00', '', 6, 'driver-unavailable', '', '2017-03-06 12:53:09', 0, '1', '12 mins', 13, 0, '', '', 0, 1, '', '', 4, 'day', '', '', '22.2814036', '70.7763142', '22.3088669', '70.7822639', '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(285, 'tismember9@gmail.com', '236', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot Bus Station, Dhebar Road South, Karanpara, Rajkot, Gujarat, India', '2017-03-06 14:02:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 13:02:34', 0, '1', '12 mins', 13, 8, '', '', 60, 1, 'cash', '', 3, 'day', '', '', '22.2814036', '70.7763142', '22.291327', '70.8021689', '0', '', 0, 0, 8, 2, 0, 0, 0, 0),
(286, 'tismember9@gmail.com', '236', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot, Gujarat, India', '2017-03-06 14:06:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 13:06:56', 0, '1', '13 mins', 13, 13, '', '', 62, 1, 'cash', '', 5, 'day', '', '', '22.2814036', '70.7763142', '22.3038945', '70.8021599', '0', '', 0, 1, 12, 2, 0, 0, 0, 0),
(287, 'tismember9@gmail.com', '236', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Rajkot Junction, Railway Station Road, Junction Plot, Rajkot, Gujarat, India', '2017-03-06 14:13:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-06 13:14:00', 0, '1', '15 mins', 14, 14, '', '', 62, 1, 'cash', '', 5, 'day', '', '', '22.2814036', '70.7763142', '22.3117482', '70.8027354', '0', '', 0, 1, 13, 2, 0, 0, 0, 0),
(288, 'Uttamm', '237', 'Point to Point Transfer', 'Raiya Rd, Mangal Park, Nagrik Bank Society, Gulab Nagar, Rajkot, Gujarat 360007, India', 'Kotecha Nagar, Rajkot, Gujarat 360001, India', '2017-03-07 11:42:20', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-07 06:12:37', 0, '0', '7 mins', 11, 11, '', '', 60, 1, 'cash', '', 2, 'day', '', '', '22.300017', '70.776306', '22.288133', '70.783665', '0', '', 0, 1, 10, 2, 0, 0, 0, 0),
(289, 'tismember7@gmail.com', '237', 'Point to Point Transfer', 'Krishna Con-arch,3, 150 Feet Ring Road,Gangdev Park, Chandra Park-2, Raval Nagar,Rajkot, Gujarat 360', 'Jamnagar, Gujarat, India', '2017-03-07 07:40:00', 'Economy', 62, '0000-00-00 00:00:00', '', 9, 'completed', '', '2017-03-07 06:39:46', 0, '1', '1 hour 43 mins', 184, 185, '', '', 60, 1, 'cash', '', 92, 'night', '', '', '22.2814036', '70.7763142', '22.4707019', '70.05773', '0', '', 0, 9, 176, 2, 0, 0, 0, 0),
(290, 'webuser', '218', 'Point to Point Transfer', 'Krishna Con-arch, 3, 150 Feet Ring Rd, Gangdev Park, Chandra Park-2, Raval Nagar, Rajkot, Gujarat 36', 'Morbi, Gujarat, India', '2017-03-07 13:35:00', 'Economy', 62, '0000-00-00 00:00:00', '', 1, 'pending', '', '2017-03-07 13:08:15', 0, '0', '1 hour 22 mins', 160, 0, '', '', 0, 1, '', '', 68, 'day', '', '', '22.2814036', '70.7763142', '22.8119895', '70.8236195', '', '', 0, 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cabdetails`
--

CREATE TABLE `cabdetails` (
  `cab_id` int(10) NOT NULL,
  `cartype` varchar(100) NOT NULL,
  `cartype_arabic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `transfertype_arabic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `car_rate` varchar(255) NOT NULL,
  `transfertype` varchar(30) NOT NULL,
  `intialkm` float(10,2) NOT NULL,
  `intailrate` float(10,2) NOT NULL,
  `standardrate` float(10,2) NOT NULL,
  `fromintialkm` float(10,2) NOT NULL,
  `fromintailrate` float(10,2) NOT NULL,
  `fromstandardrate` float(10,2) NOT NULL,
  `night_fromintialkm` float(10,2) NOT NULL,
  `night_fromintailrate` float(10,2) NOT NULL,
  `extrahour` int(10) NOT NULL,
  `extrakm` int(10) NOT NULL,
  `timetype` varchar(222) NOT NULL,
  `package` varchar(250) NOT NULL,
  `night_package` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `description_arabic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ride_time_rate` float(10,2) NOT NULL,
  `night_ride_time_rate` float(10,2) NOT NULL,
  `daystarttime` varchar(255) NOT NULL,
  `day_end_time` varchar(255) NOT NULL,
  `night_start_time` varchar(255) NOT NULL,
  `night_end_time` varchar(255) NOT NULL,
  `night_intailrate` float(10,2) NOT NULL,
  `night_standardrate` float(10,2) NOT NULL,
  `seat_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cabdetails`
--

INSERT INTO `cabdetails` (`cab_id`, `cartype`, `cartype_arabic`, `transfertype_arabic`, `car_rate`, `transfertype`, `intialkm`, `intailrate`, `standardrate`, `fromintialkm`, `fromintailrate`, `fromstandardrate`, `night_fromintialkm`, `night_fromintailrate`, `extrahour`, `extrakm`, `timetype`, `package`, `night_package`, `icon`, `description`, `description_arabic`, `ride_time_rate`, `night_ride_time_rate`, `daystarttime`, `day_end_time`, `night_start_time`, `night_end_time`, `night_intailrate`, `night_standardrate`, `seat_capacity`) VALUES
(62, 'Economy', 'الدرجة السياحية', 'حخهدف فخ حخهدف فقشدسبثق', '8.00', 'Point to Point Transfer', 8.00, 0.00, 0.00, 1.00, 1.60, 0.00, 0.00, 1.60, 0, 0, 'day and night', '', '', 'taxi.png', 'Economy class', 'الدرجة السياحية', 0.40, 0.40, '', '', '', '', 8.00, 0.00, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cabdetails_old`
--

CREATE TABLE `cabdetails_old` (
  `cab_id` int(10) NOT NULL,
  `cartype` varchar(100) NOT NULL,
  `car_rate` float(10,2) NOT NULL,
  `transfertype` varchar(30) NOT NULL,
  `intialkm` float(10,2) NOT NULL,
  `intailrate` float(10,2) NOT NULL,
  `standardrate` float(10,2) NOT NULL,
  `fromintialkm` float(10,2) NOT NULL,
  `fromintailrate` float(10,2) NOT NULL,
  `fromstandardrate` float(10,2) NOT NULL,
  `night_fromintialkm` float(10,2) NOT NULL,
  `night_fromintailrate` float(10,2) NOT NULL,
  `extrahour` int(10) NOT NULL,
  `extrakm` int(10) NOT NULL,
  `timetype` varchar(222) NOT NULL,
  `package` varchar(250) NOT NULL,
  `night_package` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ride_time_rate` float(10,2) NOT NULL,
  `night_ride_time_rate` float(10,2) NOT NULL,
  `daystarttime` varchar(255) NOT NULL,
  `day_end_time` varchar(255) NOT NULL,
  `night_start_time` varchar(255) NOT NULL,
  `night_end_time` varchar(255) NOT NULL,
  `night_intailrate` float(10,2) NOT NULL,
  `night_standardrate` float(10,2) NOT NULL,
  `seat_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cabdetails_old`
--

INSERT INTO `cabdetails_old` (`cab_id`, `cartype`, `car_rate`, `transfertype`, `intialkm`, `intailrate`, `standardrate`, `fromintialkm`, `fromintailrate`, `fromstandardrate`, `night_fromintialkm`, `night_fromintailrate`, `extrahour`, `extrakm`, `timetype`, `package`, `night_package`, `icon`, `description`, `ride_time_rate`, `night_ride_time_rate`, `daystarttime`, `day_end_time`, `night_start_time`, `night_end_time`, `night_intailrate`, `night_standardrate`, `seat_capacity`) VALUES
(60, 'Truck with fridge (for meat)', 50.00, 'Point to Point Transfer', 5.00, 0.00, 0.00, 5.00, 25.00, 0.00, 0.00, 22.00, 0, 0, 'day', '', '', 'truckwithfredgeandmeat-icon.png', 'meat transport refrigerated truck Volvo FM12 420', 6.00, 7.00, '', '', '', '', 45.00, 0.00, 8),
(61, 'Truck with Fridge', 45.00, 'Point to Point Transfer', 5.00, 0.00, 0.00, 5.00, 20.00, 0.00, 0.00, 15.00, 0, 0, 'day', '', '', 'truckwithfredge-icon.png', 'Light Duty truck , Medium Duty trucks , Heavy Duty trucks', 5.00, 6.00, '', '', '', '', 50.00, 0.00, 6),
(62, 'Truck', 40.00, 'Point to Point Transfer', 5.00, 0.00, 0.00, 5.00, 12.00, 0.00, 0.00, 13.00, 0, 0, 'day', '', '', 'truck-icon.png', 'Volvo , Renault , Mercedes-Benz Actros', 3.00, 5.00, '', '', '', '', 55.00, 0.00, 8);

-- --------------------------------------------------------

--
-- Table structure for table `callback`
--

CREATE TABLE `callback` (
  `id` int(11) NOT NULL,
  `phone` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `callback`
--

INSERT INTO `callback` (`id`, `phone`) VALUES
(68, '7559848609'),
(70, '5555555555'),
(72, '2124440653');

-- --------------------------------------------------------

--
-- Table structure for table `Car_Type`
--

CREATE TABLE `Car_Type` (
  `car_id` int(11) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `car_rate` int(11) NOT NULL,
  `seating_capecity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Car_Type`
--

INSERT INTO `Car_Type` (`car_id`, `car_type`, `icon`, `car_rate`, `seating_capecity`) VALUES
(6, 'Hatchback', 'Type-Hatchback.png', 50, 4),
(7, 'Sedans', 'Type-Sedans.png', 45, 6),
(8, 'Suv', 'Type-SUV.png', 25, 8),
(9, 'Truck', 'Type-Truck.png', 30, 7),
(10, 'Van', 'Type-Van.png', 45, 15),
(11, 'Zeep', 'Type-Zeep.png', 45, 7);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id_countries` int(3) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `iso_alpha2` varchar(2) DEFAULT NULL,
  `iso_alpha3` varchar(3) DEFAULT NULL,
  `iso_numeric` int(11) DEFAULT NULL,
  `currency_code` char(3) DEFAULT NULL,
  `currency_name` varchar(32) DEFAULT NULL,
  `currrency_symbol` varchar(3) DEFAULT NULL,
  `flag` varchar(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id_countries`, `name`, `iso_alpha2`, `iso_alpha3`, `iso_numeric`, `currency_code`, `currency_name`, `currrency_symbol`, `flag`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 4, 'AFN', 'Afghani', '؋', 'AF.png'),
(2, 'Albania', 'AL', 'ALB', 8, 'ALL', 'Lek', 'Lek', 'AL.png'),
(3, 'Algeria', 'DZ', 'DZA', 12, 'DZD', 'Dinar', NULL, 'DZ.png'),
(4, 'American Samoa', 'AS', 'ASM', 16, 'USD', 'Dollar', '$', 'AS.png'),
(5, 'Andorra', 'AD', 'AND', 20, 'EUR', 'Euro', '€', 'AD.png'),
(6, 'Angola', 'AO', 'AGO', 24, 'AOA', 'Kwanza', 'Kz', 'AO.png'),
(7, 'Anguilla', 'AI', 'AIA', 660, 'XCD', 'Dollar', '$', 'AI.png'),
(8, 'Antarctica', 'AQ', 'ATA', 10, '', '', NULL, 'AQ.png'),
(9, 'Antigua and Barbuda', 'AG', 'ATG', 28, 'XCD', 'Dollar', '$', 'AG.png'),
(10, 'Argentina', 'AR', 'ARG', 32, 'ARS', 'Peso', '$', 'AR.png'),
(11, 'Armenia', 'AM', 'ARM', 51, 'AMD', 'Dram', NULL, 'AM.png'),
(12, 'Aruba', 'AW', 'ABW', 533, 'AWG', 'Guilder', 'ƒ', 'AW.png'),
(13, 'Australia', 'AU', 'AUS', 36, 'AUD', 'Dollar', '$', 'AU.png'),
(14, 'Austria', 'AT', 'AUT', 40, 'EUR', 'Euro', '€', 'AT.png'),
(15, 'Azerbaijan', 'AZ', 'AZE', 31, 'AZN', 'Manat', 'ман', 'AZ.png'),
(16, 'Bahamas', 'BS', 'BHS', 44, 'BSD', 'Dollar', '$', 'BS.png'),
(17, 'Bahrain', 'BH', 'BHR', 48, 'BHD', 'Dinar', NULL, 'BH.png'),
(18, 'Bangladesh', 'BD', 'BGD', 50, 'BDT', 'Taka', NULL, 'BD.png'),
(19, 'Barbados', 'BB', 'BRB', 52, 'BBD', 'Dollar', '$', 'BB.png'),
(20, 'Belarus', 'BY', 'BLR', 112, 'BYR', 'Ruble', 'p.', 'BY.png'),
(21, 'Belgium', 'BE', 'BEL', 56, 'EUR', 'Euro', '€', 'BE.png'),
(22, 'Belize', 'BZ', 'BLZ', 84, 'BZD', 'Dollar', 'BZ$', 'BZ.png'),
(23, 'Benin', 'BJ', 'BEN', 204, 'XOF', 'Franc', NULL, 'BJ.png'),
(24, 'Bermuda', 'BM', 'BMU', 60, 'BMD', 'Dollar', '$', 'BM.png'),
(25, 'Bhutan', 'BT', 'BTN', 64, 'BTN', 'Ngultrum', NULL, 'BT.png'),
(26, 'Bolivia', 'BO', 'BOL', 68, 'BOB', 'Boliviano', '$b', 'BO.png'),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', 70, 'BAM', 'Marka', 'KM', 'BA.png'),
(28, 'Botswana', 'BW', 'BWA', 72, 'BWP', 'Pula', 'P', 'BW.png'),
(29, 'Bouvet Island', 'BV', 'BVT', 74, 'NOK', 'Krone', 'kr', 'BV.png'),
(30, 'Brazil', 'BR', 'BRA', 76, 'BRL', 'Real', 'R$', 'BR.png'),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', 86, 'USD', 'Dollar', '$', 'IO.png'),
(32, 'British Virgin Islands', 'VG', 'VGB', 92, 'USD', 'Dollar', '$', 'VG.png'),
(33, 'Brunei', 'BN', 'BRN', 96, 'BND', 'Dollar', '$', 'BN.png'),
(34, 'Bulgaria', 'BG', 'BGR', 100, 'BGN', 'Lev', 'лв', 'BG.png'),
(35, 'Burkina Faso', 'BF', 'BFA', 854, 'XOF', 'Franc', NULL, 'BF.png'),
(36, 'Burundi', 'BI', 'BDI', 108, 'BIF', 'Franc', NULL, 'BI.png'),
(37, 'Cambodia', 'KH', 'KHM', 116, 'KHR', 'Riels', '៛', 'KH.png'),
(38, 'Cameroon', 'CM', 'CMR', 120, 'XAF', 'Franc', 'FCF', 'CM.png'),
(39, 'Canada', 'CA', 'CAN', 124, 'CAD', 'Dollar', '$', 'CA.png'),
(40, 'Cape Verde', 'CV', 'CPV', 132, 'CVE', 'Escudo', NULL, 'CV.png'),
(41, 'Cayman Islands', 'KY', 'CYM', 136, 'KYD', 'Dollar', '$', 'KY.png'),
(42, 'Central African Republic', 'CF', 'CAF', 140, 'XAF', 'Franc', 'FCF', 'CF.png'),
(43, 'Chad', 'TD', 'TCD', 148, 'XAF', 'Franc', NULL, 'TD.png'),
(44, 'Chile', 'CL', 'CHL', 152, 'CLP', 'Peso', NULL, 'CL.png'),
(45, 'China', 'CN', 'CHN', 156, 'CNY', 'Yuan Renminbi', '¥', 'CN.png'),
(46, 'Christmas Island', 'CX', 'CXR', 162, 'AUD', 'Dollar', '$', 'CX.png'),
(47, 'Cocos Islands', 'CC', 'CCK', 166, 'AUD', 'Dollar', '$', 'CC.png'),
(48, 'Colombia', 'CO', 'COL', 170, 'COP', 'Peso', '$', 'CO.png'),
(49, 'Comoros', 'KM', 'COM', 174, 'KMF', 'Franc', NULL, 'KM.png'),
(50, 'Cook Islands', 'CK', 'COK', 184, 'NZD', 'Dollar', '$', 'CK.png'),
(51, 'Costa Rica', 'CR', 'CRI', 188, 'CRC', 'Colon', '₡', 'CR.png'),
(52, 'Croatia', 'HR', 'HRV', 191, 'HRK', 'Kuna', 'kn', 'HR.png'),
(53, 'Cuba', 'CU', 'CUB', 192, 'CUP', 'Peso', '₱', 'CU.png'),
(54, 'Cyprus', 'CY', 'CYP', 196, 'CYP', 'Pound', NULL, 'CY.png'),
(55, 'Czech Republic', 'CZ', 'CZE', 203, 'CZK', 'Koruna', 'KĿ', 'CZ.png'),
(56, 'Democratic Republic of the Congo', 'CD', 'COD', 180, 'CDF', 'Franc', NULL, 'CD.png'),
(57, 'Denmark', 'DK', 'DNK', 208, 'DKK', 'Krone', 'kr', 'DK.png'),
(58, 'Djibouti', 'DJ', 'DJI', 262, 'DJF', 'Franc', NULL, 'DJ.png'),
(59, 'Dominica', 'DM', 'DMA', 212, 'XCD', 'Dollar', '$', 'DM.png'),
(60, 'Dominican Republic', 'DO', 'DOM', 214, 'DOP', 'Peso', 'RD$', 'DO.png'),
(61, 'East Timor', 'TL', 'TLS', 626, 'USD', 'Dollar', '$', 'TL.png'),
(62, 'Ecuador', 'EC', 'ECU', 218, 'USD', 'Dollar', '$', 'EC.png'),
(63, 'Egypt', 'EG', 'EGY', 818, 'EGP', 'Pound', '£', 'EG.png'),
(64, 'El Salvador', 'SV', 'SLV', 222, 'SVC', 'Colone', '$', 'SV.png'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', 226, 'XAF', 'Franc', 'FCF', 'GQ.png'),
(66, 'Eritrea', 'ER', 'ERI', 232, 'ERN', 'Nakfa', 'Nfk', 'ER.png'),
(67, 'Estonia', 'EE', 'EST', 233, 'EEK', 'Kroon', 'kr', 'EE.png'),
(68, 'Ethiopia', 'ET', 'ETH', 231, 'ETB', 'Birr', NULL, 'ET.png'),
(69, 'Falkland Islands', 'FK', 'FLK', 238, 'FKP', 'Pound', '£', 'FK.png'),
(70, 'Faroe Islands', 'FO', 'FRO', 234, 'DKK', 'Krone', 'kr', 'FO.png'),
(71, 'Fiji', 'FJ', 'FJI', 242, 'FJD', 'Dollar', '$', 'FJ.png'),
(72, 'Finland', 'FI', 'FIN', 246, 'EUR', 'Euro', '€', 'FI.png'),
(73, 'France', 'FR', 'FRA', 250, 'EUR', 'Euro', '€', 'FR.png'),
(74, 'French Guiana', 'GF', 'GUF', 254, 'EUR', 'Euro', '€', 'GF.png'),
(75, 'French Polynesia', 'PF', 'PYF', 258, 'XPF', 'Franc', NULL, 'PF.png'),
(76, 'French Southern Territories', 'TF', 'ATF', 260, 'EUR', 'Euro  ', '€', 'TF.png'),
(77, 'Gabon', 'GA', 'GAB', 266, 'XAF', 'Franc', 'FCF', 'GA.png'),
(78, 'Gambia', 'GM', 'GMB', 270, 'GMD', 'Dalasi', 'D', 'GM.png'),
(79, 'Georgia', 'GE', 'GEO', 268, 'GEL', 'Lari', NULL, 'GE.png'),
(80, 'Germany', 'DE', 'DEU', 276, 'EUR', 'Euro', '€', 'DE.png'),
(81, 'Ghana', 'GH', 'GHA', 288, 'GHC', 'Cedi', '¢', 'GH.png'),
(82, 'Gibraltar', 'GI', 'GIB', 292, 'GIP', 'Pound', '£', 'GI.png'),
(83, 'Greece', 'GR', 'GRC', 300, 'EUR', 'Euro', '€', 'GR.png'),
(84, 'Greenland', 'GL', 'GRL', 304, 'DKK', 'Krone', 'kr', 'GL.png'),
(85, 'Grenada', 'GD', 'GRD', 308, 'XCD', 'Dollar', '$', 'GD.png'),
(86, 'Guadeloupe', 'GP', 'GLP', 312, 'EUR', 'Euro', '€', 'GP.png'),
(87, 'Guam', 'GU', 'GUM', 316, 'USD', 'Dollar', '$', 'GU.png'),
(88, 'Guatemala', 'GT', 'GTM', 320, 'GTQ', 'Quetzal', 'Q', 'GT.png'),
(89, 'Guinea', 'GN', 'GIN', 324, 'GNF', 'Franc', NULL, 'GN.png'),
(90, 'Guinea-Bissau', 'GW', 'GNB', 624, 'XOF', 'Franc', NULL, 'GW.png'),
(91, 'Guyana', 'GY', 'GUY', 328, 'GYD', 'Dollar', '$', 'GY.png'),
(92, 'Haiti', 'HT', 'HTI', 332, 'HTG', 'Gourde', 'G', 'HT.png'),
(93, 'Heard Island and McDonald Islands', 'HM', 'HMD', 334, 'AUD', 'Dollar', '$', 'HM.png'),
(94, 'Honduras', 'HN', 'HND', 340, 'HNL', 'Lempira', 'L', 'HN.png'),
(95, 'Hong Kong', 'HK', 'HKG', 344, 'HKD', 'Dollar', '$', 'HK.png'),
(96, 'Hungary', 'HU', 'HUN', 348, 'HUF', 'Forint', 'Ft', 'HU.png'),
(97, 'Iceland', 'IS', 'ISL', 352, 'ISK', 'Krona', 'kr', 'IS.png'),
(98, 'India', 'IN', 'IND', 356, 'INR', 'Rupee', '₹', 'IN.png'),
(99, 'Indonesia', 'ID', 'IDN', 360, 'IDR', 'Rupiah', 'Rp', 'ID.png'),
(100, 'Iran', 'IR', 'IRN', 364, 'IRR', 'Rial', '﷼', 'IR.png'),
(101, 'Iraq', 'IQ', 'IRQ', 368, 'IQD', 'Dinar', NULL, 'IQ.png'),
(102, 'Ireland', 'IE', 'IRL', 372, 'EUR', 'Euro', '€', 'IE.png'),
(103, 'Israel', 'IL', 'ISR', 376, 'ILS', 'Shekel', '₪', 'IL.png'),
(104, 'Italy', 'IT', 'ITA', 380, 'EUR', 'Euro', '€', 'IT.png'),
(105, 'Ivory Coast', 'CI', 'CIV', 384, 'XOF', 'Franc', NULL, 'CI.png'),
(106, 'Jamaica', 'JM', 'JAM', 388, 'JMD', 'Dollar', '$', 'JM.png'),
(107, 'Japan', 'JP', 'JPN', 392, 'JPY', 'Yen', '¥', 'JP.png'),
(108, 'Jordan', 'JO', 'JOR', 400, 'JOD', 'Dinar', NULL, 'JO.png'),
(109, 'Kazakhstan', 'KZ', 'KAZ', 398, 'KZT', 'Tenge', 'лв', 'KZ.png'),
(110, 'Kenya', 'KE', 'KEN', 404, 'KES', 'Shilling', NULL, 'KE.png'),
(111, 'Kiribati', 'KI', 'KIR', 296, 'AUD', 'Dollar', '$', 'KI.png'),
(112, 'Kuwait', 'KW', 'KWT', 414, 'KWD', 'Dinar', NULL, 'KW.png'),
(113, 'Kyrgyzstan', 'KG', 'KGZ', 417, 'KGS', 'Som', 'лв', 'KG.png'),
(114, 'Laos', 'LA', 'LAO', 418, 'LAK', 'Kip', '₭', 'LA.png'),
(115, 'Latvia', 'LV', 'LVA', 428, 'LVL', 'Lat', 'Ls', 'LV.png'),
(116, 'Lebanon', 'LB', 'LBN', 422, 'LBP', 'Pound', '£', 'LB.png'),
(117, 'Lesotho', 'LS', 'LSO', 426, 'LSL', 'Loti', 'L', 'LS.png'),
(118, 'Liberia', 'LR', 'LBR', 430, 'LRD', 'Dollar', '$', 'LR.png'),
(119, 'Libya', 'LY', 'LBY', 434, 'LYD', 'Dinar', NULL, 'LY.png'),
(120, 'Liechtenstein', 'LI', 'LIE', 438, 'CHF', 'Franc', 'CHF', 'LI.png'),
(121, 'Lithuania', 'LT', 'LTU', 440, 'LTL', 'Litas', 'Lt', 'LT.png'),
(122, 'Luxembourg', 'LU', 'LUX', 442, 'EUR', 'Euro', '€', 'LU.png'),
(123, 'Macao', 'MO', 'MAC', 446, 'MOP', 'Pataca', 'MOP', 'MO.png'),
(124, 'Macedonia', 'MK', 'MKD', 807, 'MKD', 'Denar', 'ден', 'MK.png'),
(125, 'Madagascar', 'MG', 'MDG', 450, 'MGA', 'Ariary', NULL, 'MG.png'),
(126, 'Malawi', 'MW', 'MWI', 454, 'MWK', 'Kwacha', 'MK', 'MW.png'),
(127, 'Malaysia', 'MY', 'MYS', 458, 'MYR', 'Ringgit', 'RM', 'MY.png'),
(128, 'Maldives', 'MV', 'MDV', 462, 'MVR', 'Rufiyaa', 'Rf', 'MV.png'),
(129, 'Mali', 'ML', 'MLI', 466, 'XOF', 'Franc', NULL, 'ML.png'),
(130, 'Malta', 'MT', 'MLT', 470, 'MTL', 'Lira', NULL, 'MT.png'),
(131, 'Marshall Islands', 'MH', 'MHL', 584, 'USD', 'Dollar', '$', 'MH.png'),
(132, 'Martinique', 'MQ', 'MTQ', 474, 'EUR', 'Euro', '€', 'MQ.png'),
(133, 'Mauritania', 'MR', 'MRT', 478, 'MRO', 'Ouguiya', 'UM', 'MR.png'),
(134, 'Mauritius', 'MU', 'MUS', 480, 'MUR', 'Rupee', '₨', 'MU.png'),
(135, 'Mayotte', 'YT', 'MYT', 175, 'EUR', 'Euro', '€', 'YT.png'),
(136, 'Mexico', 'MX', 'MEX', 484, 'MXN', 'Peso', '$', 'MX.png'),
(137, 'Micronesia', 'FM', 'FSM', 583, 'USD', 'Dollar', '$', 'FM.png'),
(138, 'Moldova', 'MD', 'MDA', 498, 'MDL', 'Leu', NULL, 'MD.png'),
(139, 'Monaco', 'MC', 'MCO', 492, 'EUR', 'Euro', '€', 'MC.png'),
(140, 'Mongolia', 'MN', 'MNG', 496, 'MNT', 'Tugrik', '₮', 'MN.png'),
(141, 'Montserrat', 'MS', 'MSR', 500, 'XCD', 'Dollar', '$', 'MS.png'),
(142, 'Morocco', 'MA', 'MAR', 504, 'MAD', 'Dirham', NULL, 'MA.png'),
(143, 'Mozambique', 'MZ', 'MOZ', 508, 'MZN', 'Meticail', 'MT', 'MZ.png'),
(144, 'Myanmar', 'MM', 'MMR', 104, 'MMK', 'Kyat', 'K', 'MM.png'),
(145, 'Namibia', 'NA', 'NAM', 516, 'NAD', 'Dollar', '$', 'NA.png'),
(146, 'Nauru', 'NR', 'NRU', 520, 'AUD', 'Dollar', '$', 'NR.png'),
(147, 'Nepal', 'NP', 'NPL', 524, 'NPR', 'Rupee', '₨', 'NP.png'),
(148, 'Netherlands', 'NL', 'NLD', 528, 'EUR', 'Euro', '€', 'NL.png'),
(149, 'Netherlands Antilles', 'AN', 'ANT', 530, 'ANG', 'Guilder', 'ƒ', 'AN.png'),
(150, 'New Caledonia', 'NC', 'NCL', 540, 'XPF', 'Franc', NULL, 'NC.png'),
(151, 'New Zealand', 'NZ', 'NZL', 554, 'NZD', 'Dollar', '$', 'NZ.png'),
(152, 'Nicaragua', 'NI', 'NIC', 558, 'NIO', 'Cordoba', 'C$', 'NI.png'),
(153, 'Niger', 'NE', 'NER', 562, 'XOF', 'Franc', NULL, 'NE.png'),
(154, 'Nigeria', 'NG', 'NGA', 566, 'NGN', 'Naira', '₦', 'NG.png'),
(155, 'Niue', 'NU', 'NIU', 570, 'NZD', 'Dollar', '$', 'NU.png'),
(156, 'Norfolk Island', 'NF', 'NFK', 574, 'AUD', 'Dollar', '$', 'NF.png'),
(157, 'North Korea', 'KP', 'PRK', 408, 'KPW', 'Won', '₩', 'KP.png'),
(158, 'Northern Mariana Islands', 'MP', 'MNP', 580, 'USD', 'Dollar', '$', 'MP.png'),
(159, 'Norway', 'NO', 'NOR', 578, 'NOK', 'Krone', 'kr', 'NO.png'),
(160, 'Oman', 'OM', 'OMN', 512, 'OMR', 'Rial', '﷼', 'OM.png'),
(161, 'Pakistan', 'PK', 'PAK', 586, 'PKR', 'Rupee', '₨', 'PK.png'),
(162, 'Palau', 'PW', 'PLW', 585, 'USD', 'Dollar', '$', 'PW.png'),
(163, 'Palestinian Territory', 'PS', 'PSE', 275, 'ILS', 'Shekel', '₪', 'PS.png'),
(164, 'Panama', 'PA', 'PAN', 591, 'PAB', 'Balboa', 'B/.', 'PA.png'),
(165, 'Papua New Guinea', 'PG', 'PNG', 598, 'PGK', 'Kina', NULL, 'PG.png'),
(166, 'Paraguay', 'PY', 'PRY', 600, 'PYG', 'Guarani', 'Gs', 'PY.png'),
(167, 'Peru', 'PE', 'PER', 604, 'PEN', 'Sol', 'S/.', 'PE.png'),
(168, 'Philippines', 'PH', 'PHL', 608, 'PHP', 'Peso', 'Php', 'PH.png'),
(169, 'Pitcairn', 'PN', 'PCN', 612, 'NZD', 'Dollar', '$', 'PN.png'),
(170, 'Poland', 'PL', 'POL', 616, 'PLN', 'Zloty', 'zł', 'PL.png'),
(171, 'Portugal', 'PT', 'PRT', 620, 'EUR', 'Euro', '€', 'PT.png'),
(172, 'Puerto Rico', 'PR', 'PRI', 630, 'USD', 'Dollar', '$', 'PR.png'),
(173, 'Qatar', 'QA', 'QAT', 634, 'QAR', 'Rial', '﷼', 'QA.png'),
(174, 'Republic of the Congo', 'CG', 'COG', 178, 'XAF', 'Franc', 'FCF', 'CG.png'),
(175, 'Reunion', 'RE', 'REU', 638, 'EUR', 'Euro', '€', 'RE.png'),
(176, 'Romania', 'RO', 'ROU', 642, 'RON', 'Leu', 'lei', 'RO.png'),
(177, 'Russia', 'RU', 'RUS', 643, 'RUB', 'Ruble', 'руб', 'RU.png'),
(178, 'Rwanda', 'RW', 'RWA', 646, 'RWF', 'Franc', NULL, 'RW.png'),
(179, 'Saint Helena', 'SH', 'SHN', 654, 'SHP', 'Pound', '£', 'SH.png'),
(180, 'Saint Kitts and Nevis', 'KN', 'KNA', 659, 'XCD', 'Dollar', '$', 'KN.png'),
(181, 'Saint Lucia', 'LC', 'LCA', 662, 'XCD', 'Dollar', '$', 'LC.png'),
(182, 'Saint Pierre and Miquelon', 'PM', 'SPM', 666, 'EUR', 'Euro', '€', 'PM.png'),
(183, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 670, 'XCD', 'Dollar', '$', 'VC.png'),
(184, 'Samoa', 'WS', 'WSM', 882, 'WST', 'Tala', 'WS$', 'WS.png'),
(185, 'San Marino', 'SM', 'SMR', 674, 'EUR', 'Euro', '€', 'SM.png'),
(186, 'Sao Tome and Principe', 'ST', 'STP', 678, 'STD', 'Dobra', 'Db', 'ST.png'),
(187, 'Saudi Arabia', 'SA', 'SAU', 682, 'SAR', 'Rial', '﷼', 'SA.png'),
(188, 'Senegal', 'SN', 'SEN', 686, 'XOF', 'Franc', NULL, 'SN.png'),
(189, 'Serbia and Montenegro', 'CS', 'SCG', 891, 'RSD', 'Dinar', 'Дин', 'CS.png'),
(190, 'Seychelles', 'SC', 'SYC', 690, 'SCR', 'Rupee', '₨', 'SC.png'),
(191, 'Sierra Leone', 'SL', 'SLE', 694, 'SLL', 'Leone', 'Le', 'SL.png'),
(192, 'Singapore', 'SG', 'SGP', 702, 'SGD', 'Dollar', '$', 'SG.png'),
(193, 'Slovakia', 'SK', 'SVK', 703, 'SKK', 'Koruna', 'Sk', 'SK.png'),
(194, 'Slovenia', 'SI', 'SVN', 705, 'EUR', 'Euro', '€', 'SI.png'),
(195, 'Solomon Islands', 'SB', 'SLB', 90, 'SBD', 'Dollar', '$', 'SB.png'),
(196, 'Somalia', 'SO', 'SOM', 706, 'SOS', 'Shilling', 'S', 'SO.png'),
(197, 'South Africa', 'ZA', 'ZAF', 710, 'ZAR', 'Rand', 'R', 'ZA.png'),
(198, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 239, 'GBP', 'Pound', '£', 'GS.png'),
(199, 'South Korea', 'KR', 'KOR', 410, 'KRW', 'Won', '₩', 'KR.png'),
(200, 'Spain', 'ES', 'ESP', 724, 'EUR', 'Euro', '€', 'ES.png'),
(201, 'Sri Lanka', 'LK', 'LKA', 144, 'LKR', 'Rupee', '₨', 'LK.png'),
(202, 'Sudan', 'SD', 'SDN', 736, 'SDD', 'Dinar', NULL, 'SD.png'),
(203, 'Suriname', 'SR', 'SUR', 740, 'SRD', 'Dollar', '$', 'SR.png'),
(204, 'Svalbard and Jan Mayen', 'SJ', 'SJM', 744, 'NOK', 'Krone', 'kr', 'SJ.png'),
(205, 'Swaziland', 'SZ', 'SWZ', 748, 'SZL', 'Lilangeni', NULL, 'SZ.png'),
(206, 'Sweden', 'SE', 'SWE', 752, 'SEK', 'Krona', 'kr', 'SE.png'),
(207, 'Switzerland', 'CH', 'CHE', 756, 'CHF', 'Franc', 'CHF', 'CH.png'),
(208, 'Syria', 'SY', 'SYR', 760, 'SYP', 'Pound', '£', 'SY.png'),
(209, 'Taiwan', 'TW', 'TWN', 158, 'TWD', 'Dollar', 'NT$', 'TW.png'),
(210, 'Tajikistan', 'TJ', 'TJK', 762, 'TJS', 'Somoni', NULL, 'TJ.png'),
(211, 'Tanzania', 'TZ', 'TZA', 834, 'TZS', 'Shilling', NULL, 'TZ.png'),
(212, 'Thailand', 'TH', 'THA', 764, 'THB', 'Baht', '฿', 'TH.png'),
(213, 'Togo', 'TG', 'TGO', 768, 'XOF', 'Franc', NULL, 'TG.png'),
(214, 'Tokelau', 'TK', 'TKL', 772, 'NZD', 'Dollar', '$', 'TK.png'),
(215, 'Tonga', 'TO', 'TON', 776, 'TOP', 'Pa''anga', 'T$', 'TO.png'),
(216, 'Trinidad and Tobago', 'TT', 'TTO', 780, 'TTD', 'Dollar', 'TT$', 'TT.png'),
(217, 'Tunisia', 'TN', 'TUN', 788, 'TND', 'Dinar', NULL, 'TN.png'),
(218, 'Turkey', 'TR', 'TUR', 792, 'TRY', 'Lira', 'YTL', 'TR.png'),
(219, 'Turkmenistan', 'TM', 'TKM', 795, 'TMM', 'Manat', 'm', 'TM.png'),
(220, 'Turks and Caicos Islands', 'TC', 'TCA', 796, 'USD', 'Dollar', '$', 'TC.png'),
(221, 'Tuvalu', 'TV', 'TUV', 798, 'AUD', 'Dollar', '$', 'TV.png'),
(222, 'U.S. Virgin Islands', 'VI', 'VIR', 850, 'USD', 'Dollar', '$', 'VI.png'),
(223, 'Uganda', 'UG', 'UGA', 800, 'UGX', 'Shilling', NULL, 'UG.png'),
(224, 'Ukraine', 'UA', 'UKR', 804, 'UAH', 'Hryvnia', '₴', 'UA.png'),
(225, 'United Arab Emirates', 'AE', 'ARE', 784, 'AED', 'Dirham', NULL, 'AE.png'),
(226, 'United Kingdom', 'GB', 'GBR', 826, 'GBP', 'Pound', '£', 'GB.png'),
(227, 'United States', 'US', 'USA', 840, 'USD', 'Dollar', '$', 'US.png'),
(228, 'United States Minor Outlying Islands', 'UM', 'UMI', 581, 'USD', 'Dollar ', '$', 'UM.png'),
(229, 'Uruguay', 'UY', 'URY', 858, 'UYU', 'Peso', '$U', 'UY.png'),
(230, 'Uzbekistan', 'UZ', 'UZB', 860, 'UZS', 'Som', 'лв', 'UZ.png'),
(231, 'Vanuatu', 'VU', 'VUT', 548, 'VUV', 'Vatu', 'Vt', 'VU.png'),
(232, 'Vatican', 'VA', 'VAT', 336, 'EUR', 'Euro', '€', 'VA.png'),
(233, 'Venezuela', 'VE', 'VEN', 862, 'VEF', 'Bolivar', 'Bs', 'VE.png'),
(234, 'Vietnam', 'VN', 'VNM', 704, 'VND', 'Dong', '₫', 'VN.png'),
(235, 'Wallis and Futuna', 'WF', 'WLF', 876, 'XPF', 'Franc', NULL, 'WF.png'),
(236, 'Western Sahara', 'EH', 'ESH', 732, 'MAD', 'Dirham', NULL, 'EH.png'),
(237, 'Yemen', 'YE', 'YEM', 887, 'YER', 'Rial', '﷼', 'YE.png'),
(238, 'Zambia', 'ZM', 'ZMB', 894, 'ZMK', 'Kwacha', 'ZK', 'ZM.png'),
(239, 'Zimbabwe', 'ZW', 'ZWE', 716, 'ZWD', 'Dollar', 'Z$', 'ZW.png');

-- --------------------------------------------------------

--
-- Table structure for table `delay_reasons`
--

CREATE TABLE `delay_reasons` (
  `reason_id` int(5) NOT NULL,
  `reason_title` varchar(255) NOT NULL,
  `reason_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delay_reasons`
--

INSERT INTO `delay_reasons` (`reason_id`, `reason_title`, `reason_text`) VALUES
(5, 'Loading Delay', 'loading delay');

-- --------------------------------------------------------

--
-- Table structure for table `driver_details`
--

CREATE TABLE `driver_details` (
  `id` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `user_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(122) CHARACTER SET utf8 NOT NULL,
  `address` varchar(250) CHARACTER SET utf8 NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `license_no` varchar(252) CHARACTER SET utf8 NOT NULL,
  `car_type` int(10) NOT NULL DEFAULT '0',
  `car_no` varchar(250) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dob` varchar(255) CHARACTER SET utf8 NOT NULL,
  `wallet_amount` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_status` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `rating` int(11) NOT NULL,
  `Lieasence_Expiry_Date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `license_plate` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Insurance` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Seating_Capacity` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Car_Model` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Car_Make` varchar(255) CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 NOT NULL,
  `socket_status` varchar(10) CHARACTER SET utf8 NOT NULL,
  `flag` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'no',
  `is_featured` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_details`
--

INSERT INTO `driver_details` (`id`, `name`, `user_name`, `password`, `phone`, `address`, `email`, `license_no`, `car_type`, `car_no`, `gender`, `dob`, `wallet_amount`, `user_status`, `type`, `rating`, `Lieasence_Expiry_Date`, `license_plate`, `Insurance`, `Seating_Capacity`, `Car_Model`, `Car_Make`, `image`, `status`, `socket_status`, `flag`, `is_featured`) VALUES
(4, 'Test Test', 'studioweb', '', '09876545678765', 'address', 'k.dragnev@studioweb.bg', '0987656787', 0, '132132', 'male', '2.7.1991', '', '', '', 0, '02.12.2030', '132213', '213231', '', '132132', '123213', 'person.PNG', 'Active', '', 'no', 0),
(5, 'Test Test', 'studiowebbg', '', '0989989876876', 'sofia, Bulgaria', 'khwpvveg@sharklasers.com', '321231213', 0, '1223', 'male', '2.7.1991', '', '', '', 0, '02.07.2030', 'A11231AA', '312123123', '', 'E322', 'benz', 'person1.PNG', 'Active', '', 'no', 0),
(10, 'Test', 'Testttt', '', '098798465421', 'Burgas, Bulgaria', 'iwagumi@sharklasers.com', '3221232133223', 0, '12311332', 'male', '02.07.1991', '', '', '', 0, '20.12.2020', '132132101', '12120121', '', 'e320', 'Mercedes', 'Koala.jpg', 'Active', '', 'no', 0),
(18, 'Ivan Tanovski', 'ivantanovski', 'Ivan123!', '0041798627228', 'zurich', 'Ivan.t@ok-taxi.ch', '1234', 62, 'ZH328023', 'Male', '4-1-1990', '', '', '', 0, '4-1-2020', 'ZH328023', '1234', '4', 'Octavia', 'Skoda', 'driver149877503979-20170104_130900.jpg', 'Active', 'Inactive', 'yes', 0),
(20, 'Andon Petrov', 'andonpetrov', '!Studi0web@00', '0041791564912', 'Zurich', 'andon@ok-taxi.ch', '123456', 62, 'ZH903466', 'Male', '5-1-1988', '', '', '', 0, '5-1-2020', 'ZH903466', '1234', '4', 'Octavia', 'Skoda', 'driver138490581419-2017-01-24_06:01:47_img.png', 'Active', 'Active', 'yes', 0),
(22, 'Ivo Marinov', 'ivomarinov', 'Ivo_123!', '0041798905303', 'Zürich', 'Ivo.m@ok-taxi.ch', '1234567890', 63, 'ZH422824', 'Male', '5-1-1986', '', '', '', 0, '5-1-2017', 'ZH422824', '1234', '4', 'B Class', 'Mercedes-Benz', 'driver954648319166-2017-01-26_03:21:32_img.png', 'Active', 'Inactive', 'yes', 0),
(41, 'Evgeny Nonchev', 'enonchev', '1q2w3e4r', '00359888532456', 'Zurich Switzerland', 'en@mail.bg', '1223323', 63, 'a1234ta', 'Male', '24-1-1987', '', '', '', 0, '2-2-2020', '133w4we', 'q423ees', '5', 'ML500', 'Mercedes', 'driver134949731640-20170124_115219.jpg', 'Active', 'Active', 'no', 0),
(42, 'Testdriver', 'testdriver', 'testdriver123', '9712993486', 'dfafasasfg', 'testdriver@gmail.com', 'fsdfsad01231', 60, 'sdfasdf12', 'male', '24-01-1941', '', '', '', 0, '24-01-2023', 'sfasdf121', 'asdfasdf', '12', 'fasdf21212', 'faasfd42132', 'driver710158740635-2017-01-24_11:04:50_img.png', 'Active', 'Inactive', 'no', 0),
(43, 'Rony', 'rony', 'Welcometis1', '7405646099', 'rajkot', 'tismember7@gmail.com', 'jedbubedubde', 62, 'gj3ap685', 'male', '24-01-1993', '', '', '', 0, '24-01-2043', 'hfhfhhf', 'bajaj', '2', '2012', 'TATA', 'driver751865589059-2017-01-25_12:42:29_img.png', 'Active', 'Inactive', 'yes', 0),
(44, 'Denny', 'dani', '1q2w3e4r', '7405646090', 'hi BC BCBS', 'dennu@gmail.com', 'dddet', 62, 'gd54', 'Male', '25-1-1994', '', '', '', 0, '25-1-2041', 'FGhehe', 'Hfjsjfjd', '2', 'hfd', 'BHD', 'driver660655841697-2017-01-28_10:12:38_img.png', 'Active', 'Active', 'yes', 0),
(45, 'Lucky', 'lucky', 'Welcometis1@', '7405646097', 'sssaaa', 'Lucky@gmail.com', 'fFFFFgHFf', 62, 'HD233', 'Male', '26-1-1985', '', '', '', 0, '26-1-2033', 'Dgjfjjjfsa', 'Ddjsjsj', '2', 'HDsss', 'gfff', 'driver886410895735-20170126_175002.jpg', 'Active', 'Active', 'yes', 0),
(46, 'Bigg', 'bigg', 'Welcometis1', '7874123561', 'ussshsh', 'bigg@gmail.com', 'jdjsjs', 62, 'xxdd11', 'Male', '26-1-1995', '', '', '', 0, '26-1-2034', 'ususus', 'djjdjd', '1', 'dhhdhs', 'hxhdhd', 'driver191890734247-20170126_132544.jpg', 'Active', 'Inactive', 'yes', 0),
(47, 'Jimmy', 'jimmy', 'Welcometis1', '7405646000', 'Ha ha', 'jimmy@gmail.com', 'dsssss', 62, 'xxd11', 'Male', '26-1-1993', '', '', '', 0, '26-1-2038', 'ssssssjjjj', 'sjsssjjjj', '1', 'Hdsaws', 'Hahshdh', 'driver627062052488-20170126_180523.jpg', 'Active', 'Inactive', 'yes', 0),
(48, 'Sherwin Test', 'test1', 'access1', '12687848783', 'ndjdjdnfjj', 'sherwincook@yahoo.com', '384848', 62, '384p', 'male', '26-01-1994', '', '', '', 0, '26-01-2018', 'u74849', '384848', '6', '4848', 'toyota', 'driver593919233419-2017-01-26_12:29:17_img.png', 'Active', 'Active', 'no', 0),
(49, 'Sherwin Jupiter', 'testtest', 'access1', '12687848781', 'antigua and burbuda', 'sherwincool@yahoo.com', '56567', 62, '3456g', 'male', '26-01-1992', '', '', '', 0, '26-01-2019', 'u7484848', '8484848', '6', 'Zggh', 'toyota', 'driver300403497181-2017-01-26_03:11:17_img.png', 'Active', 'Active', 'no', 0),
(50, 'Karam', 'karaam', '112233', '971507471937', 'dubai', 'karam@kr.ckm', '12455', 62, '1234', 'Male', '31-1-1993', '', '', '', 0, '30-3-2017', 'kfjfnd', 'ajdjjd', '2', 'fjfj', 'tyhh', 'driver400174713227-20170131_010319.jpg', 'Active', 'Inactive', 'no', 0),
(51, 'Dadi', 'dadi', 'leeladadi', '8885270193', 'orisssa', 'srinivasdadi9000@gmail.com', '123579', 62, '123456', 'Male', '4-2-1986', '', '', '', 0, '4-2-2034', '257857', 'yes36', '5', '2000', 'dadi', 'driver662611152511-20170204_121828.jpg', 'Active', 'Active', 'no', 0),
(58, 'Tismembe2', 'tismembe2', 'test123', '9987777899', 'Rajkot Gujarat', 'tismember2@gmail.com', 'test2', 62, 'test2', 'Male', '15-2-1977', '', '', '', 0, '15-2-2031', 'test2', 'test', '5', 'test', 'test', 'driver715816872660-20170215_064844.jpg', 'Active', 'Inactive', 'no', 0),
(59, 'Testlimo', 'testlimo', 'Welcometis1', '2133242524', 'jddi', 'uttamgajjar@techintegrity.in', 'scg324', 64, 'jgsgu424', 'male', '20-02-1956', '', '', '', 0, '20-02-2031', 'gshggus144', 'fshv314', '32', 'shgsbh3242', 'bhvdhv324', 'driver663256504572-2017-02-20_09:53:55_img.png', 'Active', 'Active', 'no', 0),
(60, 'Rocky', 'rocky', 'Welcometis1', '7016673072', 'rajkot', 'tismember9@gmail.com', 'wewdsdw', 62, 'fege433', 'male', '27-10-1994', '', '', '', 0, '29-05-2037', 'fesdsd', 'sfvefvefvfev', '2', 'vfev', 'fevvvs', '0', 'Active', 'Active', 'yes', 0),
(61, 'Taxi Scaletta, Chur', 'Daniel Sägesser', 'chur2013', '0763237320', '7004 Chur', 'allianz_2010@hotmail.com', 'BPT121', 62, 'GR172857', 'male', '20-09-1983', '', '', '', 0, '06-09-2030', '144', 'Zurich', '4', 'BLS', 'Cadillac', '0', 'Active', '', 'no', 0),
(62, 'Happy', 'happy', 'Welcometis11', '74056460000', 'hdjdjdjx', 'tismember8@gmail.com', 'djjx', 62, 'xjjx2', 'Male', '6-3-1994', '', '', '', 0, '6-3-2033', 'hxhxjx', 'jxjxjx', '2', 'xhhx', 'jdjdjd', '0', 'Active', 'Active', 'no', 1);

-- --------------------------------------------------------

--
-- Table structure for table `driver_location`
--

CREATE TABLE `driver_location` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `driver_lat` float NOT NULL,
  `driver_long` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_rate`
--

CREATE TABLE `driver_rate` (
  `driver_rate_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_comment` varchar(255) NOT NULL,
  `driver_rate` float NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_rate`
--

INSERT INTO `driver_rate` (`driver_rate_id`, `driver_id`, `user_id`, `book_id`, `user_comment`, `driver_rate`, `create_date`, `update_date`) VALUES
(3, 45, 228, 227, 'Nice trip and nice service. Thanks ', 3.8, '2017-02-28 12:22:42', '0000-00-00 00:00:00'),
(6, 60, 228, 270, 'good service 6march 11:51am', 3, '2017-03-06 07:22:26', '0000-00-00 00:00:00'),
(7, 62, 236, 278, 'nice service......happy', 3.5, '2017-03-06 13:17:18', '0000-00-00 00:00:00'),
(8, 62, 236, 280, 'bad SERVICE..HAPPY BAD guyssssss', 2, '2017-03-06 13:24:00', '0000-00-00 00:00:00'),
(9, 62, 236, 286, 'nice', 5, '2017-03-06 14:11:29', '0000-00-00 00:00:00'),
(10, 62, 236, 287, 'it is android comments...', 5, '2017-03-06 14:17:24', '0000-00-00 00:00:00'),
(11, 60, 237, 288, 'Good services', 3.5, '2017-03-07 07:30:23', '0000-00-00 00:00:00'),
(12, 60, 237, 289, 'Good services 12pm', 3.5, '2017-03-07 07:51:46', '0000-00-00 00:00:00'),
(13, 60, 237, 289, 'good service 1248', 4, '2017-03-07 08:19:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `driver_rating`
--

CREATE TABLE `driver_rating` (
  `id` int(11) NOT NULL,
  `username` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_status`
--

CREATE TABLE `driver_status` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL DEFAULT '0',
  `booking_id` int(11) NOT NULL DEFAULT '0',
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `driver_flag` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_status`
--

INSERT INTO `driver_status` (`id`, `driver_id`, `booking_id`, `start_time`, `end_time`, `driver_flag`) VALUES
(1, 22, 3, '2017-01-24 17:30:11', '2017-01-24 17:31:11', 2),
(2, 22, 4, '2017-01-24 17:32:42', '2017-01-24 17:33:42', 3),
(3, 22, 5, '2017-01-24 17:39:44', '2017-01-24 17:40:44', 3),
(4, 22, 6, '2017-01-24 17:42:32', '2017-01-24 17:43:32', 3),
(5, 24, 10, '2017-01-24 17:48:42', '2017-01-24 17:49:42', 2),
(6, 18, 10, '2017-01-24 17:50:01', '2017-01-24 17:51:01', 2),
(7, 19, 13, '2017-01-24 17:57:01', '2017-01-24 17:58:01', 3),
(8, 19, 14, '2017-01-24 17:59:10', '2017-01-24 18:00:10', 3),
(9, 22, 15, '2017-01-24 18:02:26', '2017-01-24 18:03:26', 3),
(10, 43, 18, '2017-01-25 06:45:56', '2017-01-25 06:46:56', 2),
(11, 43, 19, '2017-01-25 06:47:56', '2017-01-25 06:48:56', 3),
(12, 43, 20, '2017-01-25 06:58:35', '2017-01-25 06:59:35', 3),
(13, 43, 21, '2017-01-25 07:04:56', '2017-01-25 07:05:56', 3),
(14, 43, 30, '2017-01-25 08:18:23', '2017-01-25 08:19:23', 3),
(15, 43, 31, '2017-01-25 08:21:04', '2017-01-25 08:22:04', 3),
(16, 43, 32, '2017-01-25 08:23:20', '2017-01-25 08:24:20', 3),
(17, 43, 17, '2017-01-25 08:26:09', '2017-01-25 08:27:09', 3),
(18, 43, 33, '2017-01-25 08:26:09', '2017-01-25 08:27:09', 3),
(19, 43, 34, '2017-01-25 08:30:17', '2017-01-25 08:31:17', 3),
(20, 43, 35, '2017-01-25 08:31:35', '2017-01-25 08:32:35', 3),
(21, 43, 37, '2017-01-25 08:34:43', '2017-01-25 08:35:43', 3),
(22, 43, 38, '2017-01-25 08:37:12', '2017-01-25 08:38:12', 3),
(23, 43, 39, '2017-01-25 08:38:39', '2017-01-25 08:39:39', 2),
(24, 43, 40, '2017-01-25 08:39:53', '2017-01-25 08:40:53', 2),
(25, 43, 44, '2017-01-25 08:55:49', '2017-01-25 08:56:49', 2),
(26, 43, 45, '2017-01-25 08:57:25', '2017-01-25 08:58:25', 2),
(27, 43, 46, '2017-01-25 08:58:51', '2017-01-25 08:59:51', 2),
(28, 43, 47, '2017-01-25 09:00:56', '2017-01-25 09:01:56', 2),
(29, 43, 48, '2017-01-25 09:05:17', '2017-01-25 09:06:17', 2),
(30, 43, 49, '2017-01-25 09:06:03', '2017-01-25 09:07:03', 2),
(31, 43, 50, '2017-01-25 09:08:05', '2017-01-25 09:09:05', 2),
(32, 43, 51, '2017-01-25 12:43:05', '2017-01-25 12:44:05', 2),
(33, 43, 52, '2017-01-25 12:48:12', '2017-01-25 12:49:12', 2),
(34, 43, 53, '2017-01-25 12:58:06', '2017-01-25 12:59:06', 2),
(35, 43, 54, '2017-01-25 13:00:08', '2017-01-25 13:01:08', 2),
(36, 43, 55, '2017-01-25 13:05:08', '2017-01-25 13:06:08', 2),
(37, 43, 56, '2017-01-25 13:10:45', '2017-01-25 13:11:45', 2),
(38, 43, 57, '2017-01-25 13:21:25', '2017-01-25 13:22:25', 2),
(39, 43, 58, '2017-01-25 13:45:03', '2017-01-25 13:46:03', 2),
(40, 43, 59, '2017-01-25 14:00:49', '2017-01-25 14:01:49', 2),
(41, 43, 60, '2017-01-25 14:08:59', '2017-01-25 14:09:59', 2),
(42, 43, 61, '2017-01-25 14:18:07', '2017-01-25 14:19:07', 2),
(43, 43, 63, '2017-01-25 15:26:00', '2017-01-25 15:27:00', 2),
(44, 43, 65, '2017-01-25 15:41:43', '2017-01-25 15:42:43', 3),
(45, 43, 66, '2017-01-25 15:45:17', '2017-01-25 15:46:17', 2),
(46, 43, 68, '2017-01-26 07:31:43', '2017-01-26 07:32:43', 2),
(47, 43, 69, '2017-01-26 07:32:33', '2017-01-26 07:33:33', 2),
(48, 43, 71, '2017-01-26 07:36:35', '2017-01-26 07:37:35', 2),
(49, 43, 73, '2017-01-26 07:38:59', '2017-01-26 07:39:59', 2),
(50, 43, 74, '2017-01-26 07:39:47', '2017-01-26 07:40:47', 2),
(51, 43, 75, '2017-01-26 07:40:39', '2017-01-26 07:41:39', 2),
(52, 43, 76, '2017-01-26 07:41:57', '2017-01-26 07:42:57', 3),
(53, 43, 77, '2017-01-26 08:16:40', '2017-01-26 08:17:40', 2),
(54, 43, 78, '2017-01-26 08:41:45', '2017-01-26 08:42:45', 3),
(55, 43, 80, '2017-01-26 09:19:52', '2017-01-26 09:20:52', 2),
(56, 43, 81, '2017-01-26 09:21:31', '2017-01-26 09:22:31', 2),
(57, 43, 82, '2017-01-26 09:22:37', '2017-01-26 09:23:37', 2),
(58, 43, 84, '2017-01-26 09:24:34', '2017-01-26 09:25:34', 2),
(59, 43, 86, '2017-01-26 09:30:52', '2017-01-26 09:31:52', 2),
(60, 43, 87, '2017-01-26 09:32:21', '2017-01-26 09:33:21', 2),
(61, 43, 88, '2017-01-26 09:34:01', '2017-01-26 09:35:01', 2),
(62, 43, 89, '2017-01-26 09:41:43', '2017-01-26 09:42:43', 2),
(63, 43, 90, '2017-01-26 09:55:23', '2017-01-26 09:56:23', 2),
(64, 43, 93, '2017-01-26 10:11:11', '2017-01-26 10:12:11', 2),
(65, 43, 95, '2017-01-26 10:26:56', '2017-01-26 10:27:56', 2),
(66, 43, 96, '2017-01-26 10:59:44', '2017-01-26 11:00:44', 2),
(67, 43, 97, '2017-01-26 11:02:53', '2017-01-26 11:03:53', 2),
(68, 43, 98, '2017-01-26 11:25:18', '2017-01-26 11:26:18', 2),
(69, 43, 100, '2017-01-26 11:46:31', '2017-01-26 11:47:31', 2),
(70, 43, 101, '2017-01-26 11:48:22', '2017-01-26 11:49:22', 3),
(71, 43, 103, '2017-01-26 13:40:47', '2017-01-26 13:41:47', 2),
(72, 44, 103, '2017-01-26 13:41:50', '2017-01-26 13:42:50', 2),
(73, 45, 103, '2017-01-26 13:42:56', '2017-01-26 13:43:56', 2),
(74, 46, 103, '2017-01-26 13:44:01', '2017-01-26 13:45:01', 2),
(75, 44, 104, '2017-01-26 13:44:02', '2017-01-26 13:45:02', 3),
(76, 46, 105, '2017-01-26 13:46:36', '2017-01-26 13:47:36', 2),
(77, 45, 105, '2017-01-26 13:47:16', '2017-01-26 13:48:16', 2),
(78, 44, 106, '2017-01-26 13:48:22', '2017-01-26 13:49:22', 2),
(79, 43, 106, '2017-01-26 13:48:48', '2017-01-26 13:49:48', 2),
(80, 45, 106, '2017-01-26 13:49:17', '2017-01-26 13:50:17', 3),
(81, 43, 107, '2017-01-26 13:53:18', '2017-01-26 13:54:18', 2),
(82, 47, 107, '2017-01-26 13:53:55', '2017-01-26 13:54:55', 2),
(83, 46, 107, '2017-01-26 13:55:01', '2017-01-26 13:56:01', 2),
(84, 44, 107, '2017-01-26 13:56:01', '2017-01-26 13:57:01', 2),
(85, 45, 107, '2017-01-26 13:57:01', '2017-01-26 13:58:01', 2),
(86, 43, 108, '2017-01-26 14:03:57', '2017-01-26 14:04:57', 2),
(87, 47, 109, '2017-01-26 14:06:00', '2017-01-26 14:07:00', 2),
(88, 44, 110, '2017-01-26 14:06:25', '2017-01-26 14:07:25', 2),
(89, 46, 109, '2017-01-26 14:07:01', '2017-01-26 14:08:01', 2),
(90, 43, 110, '2017-01-26 14:07:33', '2017-01-26 14:08:33', 2),
(91, 45, 109, '2017-01-26 14:08:01', '2017-01-26 14:09:01', 2),
(92, 44, 109, '2017-01-26 14:09:01', '2017-01-26 14:10:01', 3),
(93, 46, 110, '2017-01-26 14:09:01', '2017-01-26 14:10:01', 1),
(94, 44, 111, '2017-01-26 14:20:47', '2017-01-26 14:21:47', 2),
(95, 45, 111, '2017-01-26 14:21:58', '2017-01-26 14:22:58', 2),
(96, 47, 111, '2017-01-26 14:23:01', '2017-01-26 14:24:01', 2),
(97, 43, 111, '2017-01-26 14:24:01', '2017-01-26 14:25:01', 2),
(98, 22, 112, '2017-01-26 14:24:37', '2017-01-26 14:25:37', 2),
(99, 44, 116, '2017-01-26 14:30:59', '2017-01-26 14:31:59', 3),
(100, 45, 116, '2017-01-26 14:32:18', '2017-01-26 14:33:18', 2),
(101, 44, 117, '2017-01-26 14:34:53', '2017-01-26 14:35:53', 3),
(102, 44, 119, '2017-01-26 14:38:42', '2017-01-26 14:39:42', 2),
(103, 45, 119, '2017-01-26 14:39:07', '2017-01-26 14:40:07', 2),
(104, 43, 119, '2017-01-26 14:39:24', '2017-01-26 14:40:24', 2),
(105, 47, 119, '2017-01-26 14:39:55', '2017-01-26 14:40:55', 2),
(106, 19, 121, '2017-01-26 15:09:38', '2017-01-26 15:10:38', 3),
(107, 19, 122, '2017-01-26 15:11:16', '2017-01-26 15:12:16', 3),
(108, 20, 123, '2017-01-26 15:26:17', '2017-01-26 15:27:17', 3),
(109, 20, 124, '2017-01-26 15:27:57', '2017-01-26 15:28:57', 3),
(110, 20, 125, '2017-01-26 15:46:47', '2017-01-26 15:47:47', 2),
(111, 23, 125, '2017-01-26 15:47:49', '2017-01-26 15:48:49', 2),
(112, 24, 125, '2017-01-26 15:48:50', '2017-01-26 15:49:50', 2),
(113, 20, 126, '2017-01-26 15:53:44', '2017-01-26 15:54:44', 2),
(114, 23, 126, '2017-01-26 15:53:55', '2017-01-26 15:54:55', 2),
(115, 24, 126, '2017-01-26 15:54:06', '2017-01-26 15:55:06', 3),
(116, 44, 102, '2017-01-26 17:57:46', '2017-01-26 17:58:46', 2),
(117, 40, 130, '2017-01-26 17:57:46', '2017-01-26 17:58:46', 2),
(118, 45, 102, '2017-01-26 17:59:01', '2017-01-26 18:00:01', 2),
(119, 47, 102, '2017-01-26 18:00:01', '2017-01-26 18:01:01', 2),
(120, 46, 102, '2017-01-26 18:01:01', '2017-01-26 18:02:01', 2),
(121, 40, 131, '2017-01-26 18:02:00', '2017-01-26 18:03:00', 2),
(122, 40, 132, '2017-01-26 18:05:27', '2017-01-26 18:06:27', 2),
(123, 40, 133, '2017-01-26 18:19:22', '2017-01-26 18:20:22', 2),
(124, 40, 134, '2017-01-26 18:35:59', '2017-01-26 18:36:59', 2),
(125, 41, 134, '2017-01-26 18:37:01', '2017-01-26 18:38:01', 2),
(126, 40, 135, '2017-01-26 18:40:58', '2017-01-26 18:41:58', 2),
(127, 41, 135, '2017-01-26 18:42:01', '2017-01-26 18:43:01', 2),
(128, 44, 136, '2017-01-26 18:51:41', '2017-01-26 18:52:41', 3),
(129, 44, 138, '2017-01-26 19:04:42', '2017-01-26 19:05:42', 3),
(130, 44, 139, '2017-01-26 20:11:12', '2017-01-26 20:12:12', 3),
(131, 44, 140, '2017-01-26 21:23:24', '2017-01-26 21:24:24', 3),
(132, 44, 141, '2017-01-26 21:24:36', '2017-01-26 21:25:36', 3),
(133, 44, 142, '2017-01-27 13:34:44', '2017-01-27 13:35:44', 1),
(134, 42, 155, '2017-02-13 11:19:09', '2017-02-13 11:20:09', 3),
(135, 52, 157, '2017-02-15 11:15:01', '2017-02-15 11:16:01', 2),
(136, 52, 158, '2017-02-15 15:00:01', '2017-02-15 15:01:01', 2),
(137, 45, 160, '2017-02-15 15:00:01', '2017-02-15 15:01:01', 2),
(138, 47, 160, '2017-02-15 15:01:03', '2017-02-15 15:02:03', 2),
(139, 46, 160, '2017-02-15 15:03:01', '2017-02-15 15:04:01', 2),
(140, 59, 165, '2017-02-21 05:59:09', '2017-02-21 06:00:09', 3),
(141, 59, 166, '2017-02-22 06:12:55', '2017-02-22 06:13:55', 3),
(142, 59, 167, '2017-02-22 06:37:51', '2017-02-22 06:38:51', 3),
(143, 59, 168, '2017-02-22 07:02:11', '2017-02-22 07:03:11', 3),
(144, 59, 169, '2017-02-22 07:45:25', '2017-02-22 07:46:25', 3),
(145, 59, 170, '2017-02-22 07:52:33', '2017-02-22 07:53:33', 3),
(146, 59, 171, '2017-02-22 07:57:20', '2017-02-22 07:58:20', 3),
(147, 59, 172, '2017-02-22 10:08:58', '2017-02-22 10:09:58', 3),
(148, 60, 174, '2017-02-24 07:03:33', '2017-02-24 07:04:33', 3),
(149, 52, 175, '2017-02-24 07:18:37', '2017-02-24 07:19:37', 2),
(150, 60, 175, '2017-02-24 07:19:33', '2017-02-24 07:20:33', 3),
(151, 59, 176, '2017-02-24 08:01:27', '2017-02-24 08:02:27', 3),
(152, 59, 177, '2017-02-24 08:21:15', '2017-02-24 08:22:15', 1),
(153, 20, 179, '2017-02-24 09:26:59', '2017-02-24 09:27:59', 3),
(154, 20, 180, '2017-02-24 09:38:15', '2017-02-24 09:39:15', 3),
(155, 60, 182, '2017-02-24 11:27:19', '2017-02-24 11:28:19', 3),
(156, 60, 195, '2017-02-24 12:18:47', '2017-02-24 12:19:47', 3),
(157, 52, 208, '2017-02-24 12:53:52', '2017-02-24 12:54:52', 2),
(158, 60, 208, '2017-02-24 12:55:01', '2017-02-24 12:56:01', 2),
(159, 52, 209, '2017-02-24 12:57:36', '2017-02-24 12:58:36', 2),
(160, 52, 210, '2017-02-24 13:02:12', '2017-02-24 13:03:12', 2),
(161, 60, 210, '2017-02-24 13:03:30', '2017-02-24 13:04:30', 3),
(162, 52, 211, '2017-02-24 13:09:51', '2017-02-24 13:10:51', 2),
(163, 60, 211, '2017-02-24 13:11:01', '2017-02-24 13:12:01', 3),
(164, 52, 212, '2017-02-24 13:14:24', '2017-02-24 13:15:24', 2),
(165, 60, 213, '2017-02-24 13:16:43', '2017-02-24 13:17:43', 3),
(166, 60, 216, '2017-02-24 13:45:01', '2017-02-24 13:46:01', 3),
(167, 52, 217, '2017-02-24 14:00:01', '2017-02-24 14:01:01', 2),
(168, 52, 218, '2017-02-24 14:10:28', '2017-02-24 14:11:28', 2),
(169, 60, 218, '2017-02-24 14:10:55', '2017-02-24 14:11:55', 3),
(170, 20, 219, '2017-02-25 11:04:42', '2017-02-25 11:05:42', 3),
(171, 20, 220, '2017-02-25 11:16:21', '2017-02-25 11:17:21', 3),
(172, 60, 221, '2017-02-25 11:45:01', '2017-02-25 11:46:01', 2),
(173, 52, 221, '2017-02-25 11:46:01', '2017-02-25 11:47:01', 2),
(174, 60, 223, '2017-02-25 13:00:29', '2017-02-25 13:01:29', 3),
(175, 60, 225, '2017-02-28 05:46:26', '2017-02-28 05:47:26', 3),
(176, 45, 227, '2017-02-28 07:27:57', '2017-02-28 07:28:57', 3),
(177, 60, 228, '2017-02-28 07:29:18', '2017-02-28 07:30:18', 3),
(178, 45, 226, '2017-02-28 10:15:01', '2017-02-28 10:16:01', 2),
(179, 60, 226, '2017-02-28 10:16:01', '2017-02-28 10:17:01', 2),
(180, 20, 229, '2017-03-01 17:10:47', '2017-03-01 17:11:47', 3),
(181, 20, 230, '2017-03-01 17:16:45', '2017-03-01 17:17:45', 1),
(182, 60, 231, '2017-03-02 06:29:26', '2017-03-02 06:30:26', 3),
(183, 60, 231, '2017-03-02 06:29:29', '2017-03-02 06:30:29', 3),
(184, 45, 243, '2017-03-02 19:15:01', '2017-03-02 19:16:01', 2),
(185, 0, 243, '2017-03-02 19:16:01', '2017-03-02 19:17:01', 2),
(186, 45, 250, '2017-03-03 16:45:01', '2017-03-03 16:46:01', 2),
(187, 45, 251, '2017-03-03 17:00:01', '2017-03-03 17:01:01', 2),
(188, 45, 252, '2017-03-03 17:00:01', '2017-03-03 17:01:01', 2),
(189, 45, 253, '2017-03-03 17:15:01', '2017-03-03 17:16:01', 2),
(190, 45, 254, '2017-03-03 17:15:01', '2017-03-03 17:16:01', 2),
(191, 45, 255, '2017-03-03 17:30:01', '2017-03-03 17:31:01', 2),
(192, 45, 256, '2017-03-03 17:30:01', '2017-03-03 17:31:01', 2),
(193, 45, 257, '2017-03-03 17:45:01', '2017-03-03 17:46:01', 2),
(194, 45, 258, '2017-03-03 17:45:01', '2017-03-03 17:46:01', 2),
(195, 45, 259, '2017-03-03 17:45:01', '2017-03-03 17:46:01', 2),
(196, 45, 260, '2017-03-03 17:45:01', '2017-03-03 17:46:01', 2),
(197, 45, 261, '2017-03-03 18:00:01', '2017-03-03 18:01:01', 2),
(198, 45, 262, '2017-03-03 18:00:01', '2017-03-03 18:01:01', 2),
(199, 45, 263, '2017-03-03 18:30:01', '2017-03-03 18:31:01', 2),
(200, 45, 264, '2017-03-03 18:45:01', '2017-03-03 18:46:01', 2),
(201, 45, 265, '2017-03-03 19:00:01', '2017-03-03 19:01:01', 2),
(202, 45, 266, '2017-03-03 19:15:01', '2017-03-03 19:16:01', 2),
(203, 45, 267, '2017-03-03 19:30:01', '2017-03-03 19:31:01', 2),
(204, 45, 268, '2017-03-04 13:06:04', '2017-03-04 13:07:04', 2),
(205, 45, 269, '2017-03-04 13:15:51', '2017-03-04 13:16:51', 2),
(206, 60, 269, '2017-03-04 13:17:01', '2017-03-04 13:18:01', 2),
(207, 60, 270, '2017-03-06 05:58:41', '2017-03-06 05:59:41', 3),
(208, 45, 271, '2017-03-06 08:10:47', '2017-03-06 08:11:47', 2),
(209, 60, 271, '2017-03-06 08:12:01', '2017-03-06 08:13:01', 2),
(210, 45, 272, '2017-03-06 08:15:16', '2017-03-06 08:16:16', 2),
(211, 60, 272, '2017-03-06 08:17:01', '2017-03-06 08:18:01', 3),
(212, 45, 273, '2017-03-06 08:38:33', '2017-03-06 08:39:33', 2),
(213, 45, 274, '2017-03-06 08:38:33', '2017-03-06 08:39:33', 2),
(214, 60, 273, '2017-03-06 08:40:01', '2017-03-06 08:41:01', 3),
(215, 45, 275, '2017-03-06 10:42:14', '2017-03-06 10:43:14', 2),
(216, 60, 275, '2017-03-06 10:44:01', '2017-03-06 10:45:01', 3),
(217, 60, 276, '2017-03-06 11:57:34', '2017-03-06 11:58:34', 3),
(218, 45, 277, '2017-03-06 12:09:56', '2017-03-06 12:10:56', 2),
(219, 60, 277, '2017-03-06 12:11:01', '2017-03-06 12:12:01', 3),
(220, 62, 278, '2017-03-06 12:39:54', '2017-03-06 12:40:54', 3),
(221, 62, 279, '2017-03-06 13:12:21', '2017-03-06 13:13:21', 2),
(222, 60, 279, '2017-03-06 13:12:33', '2017-03-06 13:13:33', 3),
(223, 62, 280, '2017-03-06 13:20:47', '2017-03-06 13:21:47', 3),
(224, 62, 281, '2017-03-06 13:30:09', '2017-03-06 13:31:09', 2),
(225, 45, 281, '2017-03-06 13:30:25', '2017-03-06 13:31:25', 2),
(226, 62, 282, '2017-03-06 13:44:01', '2017-03-06 13:45:01', 3),
(227, 62, 283, '2017-03-06 13:46:40', '2017-03-06 13:47:40', 2),
(228, 45, 283, '2017-03-06 13:46:45', '2017-03-06 13:47:45', 2),
(229, 60, 283, '2017-03-06 13:48:01', '2017-03-06 13:49:01', 3),
(230, 62, 284, '2017-03-06 13:53:09', '2017-03-06 13:54:09', 2),
(231, 45, 284, '2017-03-06 13:53:29', '2017-03-06 13:54:29', 2),
(232, 45, 285, '2017-03-06 14:02:34', '2017-03-06 14:03:34', 2),
(233, 60, 285, '2017-03-06 14:04:01', '2017-03-06 14:05:01', 3),
(234, 45, 286, '2017-03-06 14:06:56', '2017-03-06 14:07:56', 2),
(235, 62, 286, '2017-03-06 14:08:01', '2017-03-06 14:09:01', 3),
(236, 45, 287, '2017-03-06 14:14:00', '2017-03-06 14:15:00', 2),
(237, 62, 287, '2017-03-06 14:15:01', '2017-03-06 14:16:01', 3),
(238, 60, 288, '2017-03-07 07:24:23', '2017-03-07 07:25:23', 3),
(239, 60, 289, '2017-03-07 07:40:52', '2017-03-07 07:41:52', 3);

-- --------------------------------------------------------

--
-- Table structure for table `fix_price_area`
--

CREATE TABLE `fix_price_area` (
  `area_id` int(10) NOT NULL,
  `area_title` varchar(255) NOT NULL,
  `pincode` int(7) NOT NULL,
  `area_range` int(10) NOT NULL,
  `price` varchar(255) NOT NULL,
  `car_type_id` int(11) NOT NULL,
  `car_type_name` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fix_price_area`
--

INSERT INTO `fix_price_area` (`area_id`, `area_title`, `pincode`, `area_range`, `price`, `car_type_id`, `car_type_name`, `latitude`, `longitude`) VALUES
(5, 'Zürich Flughafen, Kloten, Schweiz', 0, 15, '80', 64, 'Limousine', '47.4582165', '8.5554755');

-- --------------------------------------------------------

--
-- Table structure for table `language_set`
--

CREATE TABLE `language_set` (
  `id` int(11) NOT NULL,
  `languages` varchar(250) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `code` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_formate`
--

CREATE TABLE `mail_formate` (
  `id` int(11) NOT NULL,
  `email_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_formate` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_formate`
--

INSERT INTO `mail_formate` (`id`, `email_name`, `subject`, `email_formate`) VALUES
(1, 'Register', 'User Register Mail', '<table style="width:49%">\n    <tbody>\n    <tr>\n        <td><img src="http://v1technology.co.uk/demo/naqil/naqilcom/Source/upload/logo.png" style="height:100px; width:250px" /></td>\n    </tr>\n    <tr>\n    </tr>\n    <tr>\n        <td>\n            <table cellpadding="5">\n                <tbody>\n                <tr>\n                    <td colspan="4">&nbsp;</td>\n                </tr>\n                <tr>\n                    <td colspan="4" style="text-align:left">Welcome To naqil !</td>\n                </tr>\n                <tr>\n                    <td colspan="4">Please Find Below Your Login Details</td>\n                </tr>\n                <tr>\n                    <td colspan="4">\n                        <table style="height:30px; width:600px">\n                            <tbody>\n                            <tr>\n                                <th style="background-color:#cdcdcd !important; text-align:left">User Name</th>\n                                <th style="background-color:#cdcdcd !important; text-align:left">{username}</th>\n                            </tr>\n                            <tr>\n                                <th style="background-color:#cdcdcd !important; text-align:left">Password</th>\n                                <th style="background-color:#cdcdcd !important; text-align:left">{password}</th>\n                            </tr>\n                            </tbody>\n                        </table>\n                    </td>\n                </tr>\n                <tr>\n                    <td colspan="4" style="text-align:left">Thank You,</td>\n                </tr>\n                <tr>\n                    <td colspan="4" style="text-align:left">{SITE_NAME} Team</td>\n                </tr>\n                </tbody>\n            </table>\n        </td>\n    </tr>\n    </tbody>\n</table>\n'),
(2, 'Forgot  Password', 'Somebody requested a new password for your Indiaries', '<table style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td><img src="http://www.techintegrity.in/indiaries/cms/img/logo.png" style="height:100px; width:200px" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<table cellpadding="5" style="height:242px; width:100%">\r\n				<tbody>\r\n					<tr>\r\n						<td colspan="4">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td colspan="4" style="text-align:left"><strong>Hi,</strong><br />\r\n						<br />\r\n						We received a request that you forgot your password.</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Your login email is :</td>\r\n						<td>{email}</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Your new password is :</td>\r\n						<td>{password}</td>\r\n					</tr>\r\n					<tr>\r\n						<td colspan="4" style="text-align:left">{SITE_NAME} Team</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE `package_details` (
  `id` int(11) NOT NULL,
  `package` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`id`, `package`) VALUES
(1, '4hrs 40Kms'),
(6, '9hrs 90kms');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `p_id` int(11) NOT NULL,
  `pages` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`p_id`, `pages`) VALUES
(1, 'adduser'),
(2, 'promocode'),
(3, 'add_driver'),
(4, 'add_settings'),
(5, 'taxi_details_air'),
(6, 'taxi_details'),
(7, 'taxi_details_hourly'),
(8, 'taxi_details_outstation'),
(9, 'userlist'),
(10, 'airportview'),
(11, 'dashboard'),
(12, 'edit_user'),
(13, 'hourlyview'),
(14, 'outstationview'),
(15, 'pointview'),
(16, 'edit_airport'),
(17, 'edit_taxi'),
(18, 'edit_driver'),
(19, 'edit_hourly'),
(20, 'edit_outstation'),
(21, 'edit_point'),
(22, 'edit_promocode'),
(23, 'edit_airport_taxi'),
(24, 'edit_hourly_taxi'),
(25, 'edit_outstation_taxi'),
(26, 'role_management'),
(27, 'taxi_airport'),
(28, 'taxi_view'),
(29, 'taxi_hourly'),
(30, 'taxi_outstation'),
(31, 'view_driver'),
(32, 'view_promocode'),
(33, 'backened_user'),
(34, 'add_backend_user'),
(35, 'edit_bakend_user'),
(36, 'addpoint'),
(37, 'addair'),
(38, 'addhourly'),
(39, 'addout'),
(40, 'view_airmanage'),
(41, 'add_airmanage'),
(42, 'edit_air_manage'),
(43, 'view_package'),
(44, 'add_package'),
(45, 'edit_package'),
(46, 'view_places'),
(47, 'places_add'),
(48, 'edit_places'),
(49, 'view_language'),
(50, 'add_language'),
(51, 'edit_language'),
(52, 'view_page'),
(53, 'add_page'),
(54, 'add_banner'),
(55, 'view_pages'),
(56, 'edit_pages'),
(57, 'pointdriver'),
(58, 'airportdriver'),
(59, 'hourlydriver'),
(60, 'outdriver'),
(61, 'wallet_list'),
(62, 'callback_list');

-- --------------------------------------------------------

--
-- Table structure for table `payment_nonce`
--

CREATE TABLE `payment_nonce` (
  `payment_user_id` int(11) NOT NULL,
  `payment_nonce` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_nonce`
--

INSERT INTO `payment_nonce` (`payment_user_id`, `payment_nonce`) VALUES
(243, 'dabc0c13-6b16-0bc0-22fb-dafb796561f9');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `location`) VALUES
(1, 'qwqwqww'),
(2, 'qwqwqw'),
(3, 'vamanapuramd'),
(4, 'Heraklion');

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE `promocode` (
  `id` int(100) NOT NULL,
  `promocode` varchar(100) NOT NULL,
  `type` varchar(25) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promocode`
--

INSERT INTO `promocode` (`id`, `promocode`, `type`, `amount`, `startdate`, `enddate`) VALUES
(3, 'eeeeeeee', 'Fixed', '55', '2015-11-26 17:16:00', '2015-11-27 17:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `r_id` int(11) NOT NULL,
  `rolename` varchar(250) NOT NULL,
  `created_date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`r_id`, `rolename`, `created_date`) VALUES
(1, 'admin', '2015-05-19 13:02:37'),
(6, 'user', '2015-05-25 09:13:48'),
(40, 'asd', '');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `r_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `page_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`r_id`, `role_id`, `page_id`) VALUES
(1, 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62'),
(2, 2, '14,2,27,29,26,'),
(3, 3, '15,10,13,14,32,2,4,'),
(5, 90, '1,'),
(6, 92, '1,2,'),
(7, 6, '15,57,10,58,'),
(8, 5, '15,10,13,14,32,2,31,3,4,26,26,33,34,35,40,41,42,'),
(9, 23, '51,');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `favicon` varchar(250) NOT NULL,
  `smtp_username` varchar(250) NOT NULL,
  `smtp_host` varchar(250) NOT NULL,
  `smtp_password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `places` varchar(245) NOT NULL,
  `country` varchar(255) NOT NULL,
  `communication` varchar(205) NOT NULL,
  `sender_id` varchar(208) NOT NULL,
  `sms_username` varchar(204) NOT NULL,
  `sms_password` varchar(204) NOT NULL,
  `languages` varchar(250) NOT NULL,
  `sidebar` varchar(250) NOT NULL,
  `paypal` varchar(250) NOT NULL,
  `paypalid` varchar(250) NOT NULL,
  `serv_secret_key` text NOT NULL,
  `analatic_code` text NOT NULL,
  `measurements` varchar(250) NOT NULL,
  `currency` varchar(250) CHARACTER SET utf8 NOT NULL,
  `paypal_option` varchar(250) NOT NULL,
  `verification` varchar(250) NOT NULL,
  `mechanic_assigned` varchar(25) NOT NULL,
  `authorize_net_url` varchar(250) NOT NULL,
  `authorize_key` varchar(250) NOT NULL,
  `authorize_id` varchar(250) NOT NULL,
  `braintree_merchant_id` varchar(250) NOT NULL,
  `braintree_public_key` varchar(250) NOT NULL,
  `braintree_private_key` varchar(250) NOT NULL,
  `commision_type` varchar(255) NOT NULL,
  `commision_value` int(11) NOT NULL DEFAULT '0',
  `languagetr` varchar(255) NOT NULL,
  `driver_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `logo`, `favicon`, `smtp_username`, `smtp_host`, `smtp_password`, `email`, `places`, `country`, `communication`, `sender_id`, `sms_username`, `sms_password`, `languages`, `sidebar`, `paypal`, `paypalid`, `serv_secret_key`, `analatic_code`, `measurements`, `currency`, `paypal_option`, `verification`, `mechanic_assigned`, `authorize_net_url`, `authorize_key`, `authorize_id`, `braintree_merchant_id`, `braintree_public_key`, `braintree_private_key`, `commision_type`, `commision_value`, `languagetr`, `driver_status`) VALUES
(1, 'naqilcom', 'upload/logo.png', 'upload/favicon.png', 'admin', 'localhost', 'admin', 'techware@co.in', 'google', 'Switzerland', 'email', 'TWSMSG', 'nixon', '968808', '', 'Horizontal', 'https://www.sandbox.paypal.com/cgi-bin/webscr', 'shajeermhmmd@gmail.com', 'My_key', 'UA-66794740-1', 'km', 'CHF', 'PayPal,By hand,Authorize.Net', 'on', 'on', 'https://www.paypal.com/cgi-bin/webscr', '6Wxf5863CD67gCrh', '5PvGS4m8s', 'gngrm93xnb5xsqx7', 'j2295fzc7jvdr68t', '2130762be87849cc0750228f0e94ca88', '1', 20, '1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `static_pages`
--

CREATE TABLE `static_pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(50) NOT NULL,
  `page_title` text NOT NULL,
  `page_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `static_pages`
--

INSERT INTO `static_pages` (`id`, `page_name`, `page_title`, `page_content`) VALUES
(1, 'about_us', 'About Us', '<p class="para-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p class="para-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<h3 class="sub-head"><strong>Lorem Ipsum</strong></h3>\n<p class="para-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<h3 class="sub-head"><strong>Lorem Ipsum</strong></h3>\n<p class="para-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p class="para-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<h3 class="sub-head"><strong>Lorem Ipsum</strong></h3>\n<p class="para-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p class="para-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<ul class="list-para">\n<li>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</li>\n<li>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</li>\n<li>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</li>\n<li>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</li>\n<li>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</li>\n</ul>\n<p class="para-content">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>'),
(2, 'contact_us', 'Contact', '<div class="col-lg-12 myTabContent" id="myTabContent">              		 			 <hr>		                           								 		                          <div class="col-lg-6">								  <p class="hed_fiel">Your Name*</p>                                  <input  name="name" required type="text" class="fields" id="name12" placeholder="Your Name">                                  								  								  					              <p class="hed_fiel">Phone</p>                                  <input name="phone" type="text" class="fields" required id="name12" placeholder="Phone">                                  								  		                                </div>								  								  					              <div class="col-lg-6">                                  <p class="hed_fiel">Email</p>                                  <input name="email" type="email"required class="fields" id="name12" placeholder="Email">								  								  								  <p class="hed_fiel">Suggestion / Feedback*</p>								  <textarea class="textareas" name="message" required class="words" rows="1" cols="50"></textarea>                                  </div>		 		                          <br><input class="findtaxibtn sel_taxi movestep2" type="button" id="button"value="Submit">	          </div><div class="col-lg-6">   <p>Techware Solution, Heavenly Plaza ES&FS 7th Floor,Kakkanad, Cochin, Kerala – 682021  or contact us by sending us mail on support@site.in</p><br></div>');

-- --------------------------------------------------------

--
-- Table structure for table `time_detail`
--

CREATE TABLE `time_detail` (
  `tid` int(11) NOT NULL,
  `day_start_time` varchar(255) NOT NULL,
  `day_end_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_detail`
--

INSERT INTO `time_detail` (`tid`, `day_start_time`, `day_end_time`) VALUES
(1, '09:00', '18:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `transaction_id` int(11) NOT NULL,
  `t_driver_id` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL,
  `description` text NOT NULL,
  `comment` text NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(50) NOT NULL,
  `pickupadd` varchar(250) NOT NULL,
  `user_status` varchar(11) NOT NULL,
  `wallet_amount` varchar(250) NOT NULL,
  `device_id` longtext CHARACTER SET latin1 NOT NULL,
  `type` varchar(250) NOT NULL,
  `facebook_id` text CHARACTER SET latin1 NOT NULL,
  `twitter_id` text CHARACTER SET latin1 NOT NULL,
  `isdevice` varchar(255) CHARACTER SET latin1 NOT NULL,
  `device_token` varchar(255) CHARACTER SET latin1 NOT NULL,
  `flag` varchar(10) CHARACTER SET latin1 NOT NULL DEFAULT 'no',
  `braintree_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `image`, `name`, `username`, `mobile`, `email`, `gender`, `dob`, `password`, `pickupadd`, `user_status`, `wallet_amount`, `device_id`, `type`, `facebook_id`, `twitter_id`, `isdevice`, `device_token`, `flag`, `braintree_id`) VALUES
(182, 'user179347767494-2017-01-23_06:30:28_img.png', 'Nicolas Colin', 'user@sharklasers.com', '0896619991', 'user@sharklasers.com', '0', '0000-00-00', '516176af0f02217459821bda1b03d87f', '', 'Active', '', '', '', '', '0', '0', '', 'yes', ''),
(193, 'user124919541180-20170120_100538.jpg', 'TIs1', 'tismember1@gmail.com', '91 9712993486', 'tismember1@gmail.com', 'Gender', '0000-00-00', '2529f32ba99ed5470c0075dd8f8c2977', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(195, '', 'Test', 'akashreddy360@gmail.com', '91 8985077127', 'akashreddy360@gmail.com', 'gender', '0000-00-00', 'cb7c5f69ff356ecca55b7d08df877991', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(196, '', 'New Twit', 'twit@gmail.com', '91 8160301611', 'twit@gmail.com', '', '0000-00-00', 'a2b80686c9ff19e1e53425f3ea54adb4', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(197, '', 'Rishi', 'getme_rishi@yahoo.com', '91 9554453444', 'getme_rishi@yahoo.com', 'Gender', '0000-00-00', 'f6644330515b224cbcbc9dfa7f01aa7c', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(198, '', 'Noor', 'noor@rtsit.com', '221 776409379', 'noor@rtsit.com', 'gender', '0000-00-00', 'd1edbb595b567db7689355f546b2b0b2', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(199, 'user365707350894-2017-01-23_05:26:10_img.png', 'Evgeny Nonchev', 'enonchev@gmail.com', '0888532456', 'enonchev@gmail.com', '0', '0000-00-00', '3fde6bb0541387e4ebdadf7c2ff31123', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(200, '', 'TestUser', 'testuser@gmail.com', '91 7405619131', 'testuser@gmail.com', '', '0000-00-00', 'e4b4efd20ada72c6f7708b0c1cc78469', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(203, '', 'Eugene', 'e.chaplin@bluewin.ch', '41 796235447', 'e.chaplin@bluewin.ch', 'gender', '0000-00-00', 'b2a78198a2c63dcc38492576ccdd498b', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(206, '', 'Danail', 'danail_christoff@yahoo.de', '41 788000788', 'danail_christoff@yahoo.de', '', '0000-00-00', 'a3e17f3b36eed680b815f02976aee758', '', 'Active', '', '', '', '', '0', '0', '', 'yes', ''),
(207, '', 'Thomas', 'thomaschunyu@yahoo.com', '86 13318953081', 'thomaschunyu@yahoo.com', '', '0000-00-00', '391efce7bb1745d9b772b764af5ad77e', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(208, '', 'Ricardo', 'ricardooliveirafilho@gmail.com', '41 792355054', 'ricardooliveirafilho@gmail.com', '', '0000-00-00', '88c850477d729e24ce24b953a8d4bb71', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(209, 'user169205558951-2017-01-30_04:21:49_img.png', 'Viresh Kewalbansing', 'viresh@cloudusout.com', '0681933222', 'viresh@cloudusout.com', '0', '0000-00-00', '3e9f80e4f655c2fbd024bab114eac71f', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(210, '', 'Ashwin28', 'ashh2804@gmail.com', '31 0623063061', 'ashh2804@gmail.com', '', '0000-00-00', '288116504f5e303e4be4ff1765b81f5d', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(211, '', 'Karam', 'karamraed94@gmail.com', '971 507471937', 'karamraed94@gmail.com', 'gender', '0000-00-00', '76fc03810aeb863126673940c07bbfc5', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(212, '', 'Rupen', 'rupen@techintegrity.in', '8866045386', 'rupen@techintegrity.in', '0', '0000-00-00', '620fc1ac144e7f854032c528615efa59', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(213, '', 'Testme', 'srinivasdadi9000@gmail.com', '91 8885270193', 'srinivasdadi9000@gmail.com', 'gender', '0000-00-00', '948afc30076609dbf5325985df3a02be', '', 'Active', '', '', '', '205925759870063', '', '1', '', 'no', ''),
(214, '', 'Suresh Talabattula', 'tsuresh.media3@gmail.com', '91 9985030396', 'tsuresh.media3@gmail.com', 'gender', '0000-00-00', '0487cc982f7db39c51695026e4bdc692', '', 'Active', '', '', '', '1459509247392420', '', '1', '', 'no', ''),
(215, '', 'Aleksei', '20aa88@zoho.com', '370 68634130', '20aa88@zoho.com', 'gender', '0000-00-00', 'b26986ceee60f744534aaab928cc12df', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(216, '', 'Mohamed-Adnane Ach', 'adnaneachirou@gmail.com', '33  33658690821', 'adnaneachirou@gmail.com', '', '0000-00-00', '89324503565843bbf1a36e9efc9edcc0', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(217, '', 'Vanessa Wong', 'vanessa.wsm@gmail.com', '852  85296774432', 'vanessa.wsm@gmail.com', '', '0000-00-00', '1d9bda4b87df40c60f58fe2f86c70c96', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(218, '', 'Web User', 'webuser', '918980349978', '', '', '0000-00-00', '25a86af5b93b0fa9fc7c3a37e9f91113', '', '', '', '', '', '', '', '0', '', 'no', ''),
(219, '', 'Web User', 'webuser', '911234567890', '', '', '0000-00-00', 'f074c9aa23271db907587e9364190b77', '', 'Active', '', '', '', '', '', '0', '', 'no', ''),
(220, '', 'shalawaras90@gmail.com', 'shalawaras90@gmail.com', '359 0896344566', 'shalawaras90@gmail.com', '', '0000-00-00', '584c7fc739d7b6a87cd896614768715a', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(221, '', 'Veronika', 'v.pachaly@gmail.com', '56 994524660', 'v.pachaly@gmail.com', '', '0000-00-00', '727461f2af97b586cc93457354d6110d', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(222, '', 'Web User', 'webuser', '918866045386', '', '', '0000-00-00', 'fb66cdf31cd1a2f8bbfc1842d29cfa0b', '', 'Active', '', '', '', '', '', '0', '', 'no', ''),
(223, '', 'Web User', 'webuser', '359888532456', '', '', '0000-00-00', '85cb844bf4189fbbf4baefa08cd3fd01', '', 'Active', '', '', '', '', '', '0', '', 'no', ''),
(224, 'user461992147844-20170223_172804.jpg', 'Tismember3', 'tismember3@gmail.com', '91 7265951793', 'tismember3@gmail.com', 'Gender', '0000-00-00', '457d0ed243305b44205078c0bb358171', '', 'Active', '', '', '', '', '0', '1', '', 'yes', ''),
(225, '', 'Web User', 'webuser', '41788000788', '', '', '0000-00-00', '05c0ea1f2f90deeece1a7ef28186ca41', '', 'Active', '', '', '', '', '', '0', '', 'no', ''),
(226, '', 'Web User', 'webuser', '41799000799', '', '', '0000-00-00', '0147d67eca0921cf2f8c057bfda55d13', '', 'Active', '', '', '', '', '', '0', '', 'no', ''),
(227, '', 'Venad', 'harievenad@gmail.com', '91 9567354492', 'harievenad@gmail.com', 'gender', '0000-00-00', '070b3f49a64c40016f8c75605b14a92e', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(229, '', 'Evgeny', 'en@mail.bg', '359 0888532456', 'en@mail.bg', '', '0000-00-00', '3fde6bb0541387e4ebdadf7c2ff31123', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(230, '', 'Test', 'webuser', '917698217974', 'tismember1@gmail.com', '', '0000-00-00', 'f079f5c9c6b44957da630c60875f1e2b', '', 'Active', '', '', '', '', '', '0', '', 'no', ''),
(231, '', 'test', 'webuser', '411234567890', 'test@abc.com', '', '0000-00-00', 'dc840317efc16b60e0f1b8c1ea8a6d78', '', 'Active', '', '', '', '', '', '0', '', 'no', ''),
(233, '', 'Mark', 'zoorich69@gmail.com', '41 0779468592', 'zoorich69@gmail.com', 'gender', '0000-00-00', '7e6454ebedf8c48ed36653ebc2accf00', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(234, '', 'Veronika Alexander', 'v.pachaly@outlook.com', '49 15237615219', 'v.pachaly@outlook.com', 'gender', '0000-00-00', 'cbdcf8616c0160b78a93ec13206a494f', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(235, '0', 'Christoff', 'danail.christoff@gmx.ch', '41 799000799', 'danail.christoff@gmx.ch', '', '0000-00-00', '14b40cf845cab91fbe70bf7be9824d04', '', 'Active', '', '', '', '', '0', '0', '', 'no', ''),
(236, '0', 'Harshil surani', 'tismember9@gmail.com', '91 7405646092', 'tismember9@gmail.com', 'Gender', '0000-00-00', '54e0f9edf4055b19dc23650e3dbcc6de', '', 'Active', '', '', '', '', '', '1', '', 'no', ''),
(237, 'user519341934937-20170307_090915.jpg', 'Uttamm', 'tismember7@gmail.com', '91 9510674872', 'tismember7@gmail.com', 'Gender', '0000-00-00', '79181a7d6a1531bb101d94e7b0703071', '', 'Active', '', '', '', '', '0', '1', '', 'no', ''),
(238, '', '', 'braintree', '9712993486', 'tismember8@gmail.com', '', '0000-00-00', '79181a7d6a1531bb101d94e7b0703071', '', 'Active', '', '', '', '', '', '1', '', 'no', '24090602'),
(239, '', '', 'braintree1', '1234567890', 'tismember10@gmail.com', '', '0000-00-00', '79181a7d6a1531bb101d94e7b0703071', '', 'Active', '', '', '', '', '', '1', '', 'no', '72688958');

-- --------------------------------------------------------

--
-- Table structure for table `user_app_language`
--

CREATE TABLE `user_app_language` (
  `id` int(100) NOT NULL,
  `language_name` varchar(100) NOT NULL,
  `language_meta` longtext NOT NULL,
  `status` varchar(10) NOT NULL COMMENT '0-> disabled, 1->Enabled'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_app_language`
--

INSERT INTO `user_app_language` (`id`, `language_name`, `language_meta`, `status`) VALUES
(1, 'English', '{"Newuser_SignUp_now":"New user SignUp now","Or_sign_In_with":"Or sign In with","Forgot_Password":"Forgot Password","No_network_connection":"No network connection","Sign_In":"Sign In","SIGN_UP":"SIGN UP","Enter_your_name":"Enter your name","Name":"Name","Enter_user_name":"Enter user name","Enter_your_number":"Enter your number","Enter_valid_mobile_number":"Enter valid mobile number","Mobile":"Mobile","Enter_email":"Enter email","Enter_valid_email":"Enter valid email","Enter_Password":"Enter Password","Mail":"Mail","SIGN_IN":"SIGN IN","Enter_username_email_mobile":"Enter user name \\/ email \\/ mobile","Mobile_User_Name_Email":"Mobile \\/ User Name \\/ Email","password":"password","CallMy_Cab":"CallMyCab","Enter_Pickup_location":"Enter Pickup location","Enter_Drop_location":"Enter Drop location","Toyota_etios_tata_indigo_maruti_dezire":"Toyota etios \\/ tata indigo \\/ maruti dezire","Fare_Breakup":"Fare Breakup","First":"First","After":"After","Ridetime_rate":"Ride time rate","Airport_rate_may_differ_peaktime_chargesmayapply":"Airport rate may differ peak time charges may apply","RIDE_LATER":"RIDE LATER","RIDE_NOW":"RIDE NOW","Cancel":"Cancel","Book":"Book","Book_My_Ride":"Book My Ride","My_Trips":"My Trips","Rate_Card":"Rate Card","Logout":"Logout","My_Trip":"My Trip","Profile":"Profile","User_Name":"User Name","MAIL":"MAIL","CHANEGE_PASSWORD":"CHANEGE PASSWORD","Enter_new_Password":"Enter new Password","Minimum_6_characters":"Minimum 6 characters","Passwords_do_not_match":"Passwords do not match","Conform_password":"Conform password","RESET_PASSWORD":"RESET PASSWORD","Trip_Details":"Trip Details","BOOKING_ID":"BOOKING ID","PICKUP_POINT":"PICKUP POINT","TO":"TO","DROP_POINT":"DROP POINT","VEHICLE_DETAILS":"VEHICLE DETAILS","CAB_TYPE":"CAB TYPE","DRIVER_DETAILS":"DRIVER DETAILS","Payment_Details":" Distance Total Amount SEND YOUR FEED BACK","Distance":"Distance","Total_Amount":"Total Amount","SEND_YOUR_FEED_BACK":"SEND YOUR FEED BACK","hidden_lang":"English"}', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_rate`
--

CREATE TABLE `user_rate` (
  `user_rate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `driver_comment` varchar(255) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_rate` float NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rate`
--

INSERT INTO `user_rate` (`user_rate_id`, `user_id`, `driver_id`, `driver_comment`, `book_id`, `user_rate`, `create_date`, `update_date`) VALUES
(1, 228, 60, 'Thanks for nice trip. Good experience.\n', 223, 2.9, '2017-02-25 13:01:54', '0000-00-00 00:00:00'),
(2, 228, 60, 'Good experience , no time wast , over all nice trip. Thanks :-).', 223, 4.9, '2017-02-27 13:45:22', '0000-00-00 00:00:00'),
(3, 228, 60, 'Average trip ...... sorrryyy....but need to improve service. ', 225, 2.5, '2017-02-28 06:10:26', '0000-00-00 00:00:00'),
(4, 228, 60, 'Good experience and thanks to rating me average. I will take care about service in next time. Thanks again. :-)\n', 225, 3.6, '2017-02-28 06:12:27', '0000-00-00 00:00:00'),
(5, 228, 60, '', 228, 3.8, '2017-02-28 07:57:25', '0000-00-00 00:00:00'),
(6, 182, 20, '', 229, 5.1, '2017-03-01 17:14:43', '0000-00-00 00:00:00'),
(7, 228, 60, 'Dhdhfjdjdhddhshshdhfhdddjdhhdhdhdhfhdhdhddhdhdhsbahsgshshshshdhshdjf\n', 231, 0, '2017-03-04 12:26:49', '0000-00-00 00:00:00'),
(8, 228, 60, 'Nice ', 231, 4, '2017-03-04 13:14:36', '0000-00-00 00:00:00'),
(9, 228, 60, 'Nsw2§ice sdkfasajfdkjjk ksdsfj sfjksfjksjf kasf', 269, 2.8, '2017-03-04 15:01:02', '0000-00-00 00:00:00'),
(10, 224, 60, 'test', 50, 5, '2017-03-06 05:53:00', '0000-00-00 00:00:00'),
(11, 224, 60, 'test', 50, 5, '2017-03-06 06:12:39', '0000-00-00 00:00:00'),
(12, 224, 60, 'test', 50, 5.5, '2017-03-06 06:12:46', '0000-00-00 00:00:00'),
(13, 224, 60, 'test test', 50, 5.5, '2017-03-06 06:12:52', '0000-00-00 00:00:00'),
(14, 224, 60, 'test test', 50, 5.5, '2017-03-06 06:13:15', '0000-00-00 00:00:00'),
(15, 224, 60, 'test test', 226, 5.5, '2017-03-06 06:13:16', '0000-00-00 00:00:00'),
(16, 228, 60, 'Good service', 270, 4.3, '2017-03-06 06:30:10', '0000-00-00 00:00:00'),
(17, 228, 60, 'Good service', 270, 4, '2017-03-06 06:31:00', '0000-00-00 00:00:00'),
(18, 228, 60, 'asdmgngjfj bhdhd fbdbdbdbdbdhdhd fbdbdbdbdbdhdhd dhdhdh\n', 272, 3.5, '2017-03-06 08:19:03', '0000-00-00 00:00:00'),
(19, 236, 62, 'thank you Harshill surani ... he was nice guys.....', 278, 5, '2017-03-06 13:10:45', '0000-00-00 00:00:00'),
(20, 236, 62, 'bad harshil...', 280, 1, '2017-03-06 13:27:14', '0000-00-00 00:00:00'),
(21, 236, 60, 'good services', 279, 3.5, '2017-03-06 13:39:47', '0000-00-00 00:00:00'),
(22, 236, 62, 'good', 282, 3, '2017-03-06 13:45:02', '0000-00-00 00:00:00'),
(23, 236, 60, 'Good', 283, 4, '2017-03-06 14:00:46', '0000-00-00 00:00:00'),
(24, 236, 62, 'Nice one job.... he was amaging....', 286, 5, '2017-03-06 14:10:54', '0000-00-00 00:00:00'),
(25, 236, 62, 'Bad service ... it is iphone comments', 287, 1, '2017-03-06 14:16:17', '0000-00-00 00:00:00'),
(26, 236, 60, 'good services ', 285, 4, '2017-03-06 14:24:46', '0000-00-00 00:00:00'),
(27, 237, 60, 'Gfjgfjgfjfg vb fhnggn fbnfhnthjgfjhh fgntgjgfjfh fjfhjfhng fgnghngmghn gbmghmfhnfgn dgndgndgb fgnfhnghnghmhgmhgmhg', 288, 3.2, '2017-03-07 07:29:13', '0000-00-00 00:00:00'),
(28, 237, 60, 'Dfhfdn. Bfgngrnrgnrghrgsnnth tehnehtnthenetunetuntehmeuymryumuym. Dhymethmethmehtmethmhetmeyhmehtmethmtmjeymeyumuy gdhmdthmdtujetujtdhmmsthnnhdtn dtujstymetumhdtm', 289, 4.6, '2017-03-07 07:59:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `ip`, `country`) VALUES
(1, '192.168.138.31', 'EU'),
(2, '192.168.1.31', 'IN'),
(3, '192.168.138.6', ''),
(4, '192.168.1.16', ''),
(5, '192.168.138.19', ''),
(6, '192.168.138.17', ''),
(7, '192.168.1.6', ''),
(8, '192.168.138.9', '');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `item_no` varchar(250) NOT NULL,
  `amount` varchar(250) NOT NULL COMMENT 'in $',
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `username`, `item_no`, `amount`, `status`) VALUES
(2, 'baby', '4YL9241607693264Y', '11.00', 'Completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airport_details`
--
ALTER TABLE `airport_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_languages`
--
ALTER TABLE `app_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookingdetails`
--
ALTER TABLE `bookingdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cabdetails`
--
ALTER TABLE `cabdetails`
  ADD PRIMARY KEY (`cab_id`);

--
-- Indexes for table `cabdetails_old`
--
ALTER TABLE `cabdetails_old`
  ADD PRIMARY KEY (`cab_id`);

--
-- Indexes for table `callback`
--
ALTER TABLE `callback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Car_Type`
--
ALTER TABLE `Car_Type`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id_countries`);

--
-- Indexes for table `delay_reasons`
--
ALTER TABLE `delay_reasons`
  ADD PRIMARY KEY (`reason_id`);

--
-- Indexes for table `driver_details`
--
ALTER TABLE `driver_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_location`
--
ALTER TABLE `driver_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_rate`
--
ALTER TABLE `driver_rate`
  ADD PRIMARY KEY (`driver_rate_id`);

--
-- Indexes for table `driver_rating`
--
ALTER TABLE `driver_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_status`
--
ALTER TABLE `driver_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fix_price_area`
--
ALTER TABLE `fix_price_area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `language_set`
--
ALTER TABLE `language_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_formate`
--
ALTER TABLE `mail_formate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_details`
--
ALTER TABLE `package_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocode`
--
ALTER TABLE `promocode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_pages`
--
ALTER TABLE `static_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_detail`
--
ALTER TABLE `time_detail`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_app_language`
--
ALTER TABLE `user_app_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rate`
--
ALTER TABLE `user_rate`
  ADD PRIMARY KEY (`user_rate_id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `airport_details`
--
ALTER TABLE `airport_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `app_languages`
--
ALTER TABLE `app_languages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bookingdetails`
--
ALTER TABLE `bookingdetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;
--
-- AUTO_INCREMENT for table `cabdetails`
--
ALTER TABLE `cabdetails`
  MODIFY `cab_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `cabdetails_old`
--
ALTER TABLE `cabdetails_old`
  MODIFY `cab_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `callback`
--
ALTER TABLE `callback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `Car_Type`
--
ALTER TABLE `Car_Type`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id_countries` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `delay_reasons`
--
ALTER TABLE `delay_reasons`
  MODIFY `reason_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `driver_details`
--
ALTER TABLE `driver_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `driver_location`
--
ALTER TABLE `driver_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `driver_rate`
--
ALTER TABLE `driver_rate`
  MODIFY `driver_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `driver_rating`
--
ALTER TABLE `driver_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `driver_status`
--
ALTER TABLE `driver_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `fix_price_area`
--
ALTER TABLE `fix_price_area`
  MODIFY `area_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `language_set`
--
ALTER TABLE `language_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail_formate`
--
ALTER TABLE `mail_formate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `package_details`
--
ALTER TABLE `package_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `static_pages`
--
ALTER TABLE `static_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `time_detail`
--
ALTER TABLE `time_detail`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `user_app_language`
--
ALTER TABLE `user_app_language`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_rate`
--
ALTER TABLE `user_rate`
  MODIFY `user_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
