-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2017 at 11:27 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carttocard`
--

-- --------------------------------------------------------

--
-- Table structure for table `mycart`
--

CREATE TABLE `mycart` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `number_of_item` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `order_destination` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `number_of_item` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `order_destination` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_sale_price` int(11) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_search_key1` varchar(255) NOT NULL,
  `product_search_key2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_category`, `product_image1`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_sale_price`, `product_stock`, `product_search_key1`, `product_search_key2`) VALUES
(1, 'iPhone 5S', 'iPhone 5S is lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Cellphone', '1640611460_374583171_674172065_1.jpg', '1640611460_374583171_674172065_2.jpg', '1640611460_374583171_674172065_3.png', '1640611460_374583171_674172065_4.png', 31000, 0, 80, 'all / any', 'Smartphone'),
(2, 'Samsung S6 Edge', 'Telefon mobil Samsung Galaxy S6 Edge Plus is lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Cellphone', '251521457_904311777_956556753_1.jpg', '251521457_904311777_956556753_2.png', '251521457_904311777_956556753_3.png', '251521457_904311777_956556753_4.jpg', 26900, 92, 85, 'all / any', 'Smartphone'),
(3, 'iPhone 5S Go Gris', 'iPhone 5S Go Gris is lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Cellphone', '1069567823_864396754_1360585338_1.jpg', '1069567823_864396754_1360585338_2.png', '1069567823_864396754_1360585338_3.jpg', '1069567823_864396754_1360585338_4.jpg', 28900, 0, 49, 'all / any', 'Smartphone'),
(4, 'Acer Aspire i5', 'Acer Aspire Timeline X laptops offer you 8hrs battery backup lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Laptop', '1320738421_806732076_418801350_1.png', '1320738421_806732076_418801350_2.jpg', '1320738421_806732076_418801350_3.jpg', '1320738421_806732076_418801350_4.png', 49000, 0, 22, 'all / any', ''),
(5, 'Razer BlackWidow', 'Battlefield 4â„¢ Razer BlackWidow Ultra lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Keyboard', '1224586330_1967079736_449506678_1.png', '1224586330_1967079736_449506678_2.png', '1224586330_1967079736_449506678_3.png', '1224586330_1967079736_449506678_4.jpg', 2400, 0, 31, 'all / any', ''),
(6, 'Blue Finger Keyboard', 'Gaming Keyboard and Mouse Combo-BlueFinger lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Keyboard', '131522_8311111_1943073191_1.jpg', '131522_8311111_1943073191_2.jpg', '131522_8311111_1943073191_3.jpg', '131522_8311111_1943073191_4.jpg', 33000, 0, 15, 'all / any', ''),
(7, 'Dell PC', 'Dell PC, lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'PC', '2021847817_550220065_174013307_1.jpeg', '2021847817_550220065_174013307_2.png', '2021847817_550220065_174013307_3.jpg', '2021847817_550220065_174013307_4.jpg', 44500, 72, 66, 'all / any', ''),
(8, 'Acer Apire Speaker ', 'Acer Apire Speaker lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Speaker', '20075225_27813857_1634916885_1.jpg', '20075225_27813857_1634916885_2.jpg', '20075225_27813857_1634916885_3.jpg', '20075225_27813857_1634916885_4.jpg', 1200, 88, 7, 'all / any', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `category`) VALUES
(1, 'Cellphone'),
(2, 'Laptop'),
(3, 'Keyboard'),
(4, 'Mouse'),
(5, 'Camera'),
(6, 'Headphone'),
(7, 'Speaker'),
(8, 'PC');

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`id`, `product_id`, `product_color`) VALUES
(4, 2, 'white'),
(5, 2, 'black'),
(6, 2, 'grey'),
(7, 2, 'red'),
(8, 2, 'orange'),
(9, 2, 'pink'),
(10, 3, 'white'),
(11, 3, 'black'),
(12, 3, 'red'),
(13, 3, 'orange'),
(14, 3, 'pink'),
(105, 1, 'White'),
(106, 1, 'Black'),
(107, 1, 'Grey'),
(108, 4, 'White'),
(109, 4, 'Black'),
(110, 4, 'Green'),
(111, 5, 'Black'),
(112, 5, 'Red'),
(113, 6, 'Black'),
(114, 6, 'Red'),
(121, 8, 'White'),
(122, 8, 'Black'),
(123, 7, 'White'),
(124, 7, 'Black');

-- --------------------------------------------------------

--
-- Table structure for table `product_data_color`
--

CREATE TABLE `product_data_color` (
  `id` int(11) NOT NULL,
  `data_color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_data_color`
--

INSERT INTO `product_data_color` (`id`, `data_color`) VALUES
(1, 'White'),
(2, 'Black'),
(3, 'Grey'),
(4, 'Blue'),
(5, 'Red'),
(6, 'Green'),
(7, 'Yellow'),
(8, 'Orange'),
(9, 'Violet'),
(10, 'Pink');

-- --------------------------------------------------------

--
-- Table structure for table `product_feedback`
--

CREATE TABLE `product_feedback` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_comment` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `date_comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_feedback`
--

INSERT INTO `product_feedback` (`id`, `product_id`, `user_comment`, `user_name`, `date_comment`) VALUES
(1, 3, 'ok lang tong item na to bumili nga ako nito ng 3pcs a skldjf ksdjak lsalk ksl daf lkas klsdkl jklsaj klfjsd aklj klsadj kl jkldasj fkljkl j klsjkl jakl j klasjkld fjklsdj kl sjld jlsdj sld', 'bLLmes', '2017-08-06 08:25:40am'),
(2, 3, ' a ksf klask as kljk ls klk l k kljkl  jk klj kjd kj kasf weroq[w ;laj asd j;lfs ;lwotit as;l ;l ;lsa ;lsakdg ask;dj lksadj akfjl kasbitllajsl jlsakfj lkaslkrjkla slk l a laskdj lkjsdal lks lksjklf slkadj klsdj weriopweqrpi kalsj flkjsa lkjkl jkl sa vklva', 'bLLmes', '2017-08-06 08:49:50am'),
(3, 3, 'qwe qwe qwe qw', 'bLLmes', '2017-08-06 08:50:08am'),
(4, 1, 'this product is blaHHh blaHHHh alksjdfk sda js kljwr wieu owieu roiaksjflj .mx,v .,zj kljsdklfj la ioweru i iru oiwueri ouwior uialk asklfj laksj zmf.zjlkahlai erwuwiopuriwe uior uiwur eiowu ioru w jrklajsfkljasi uewioeur iuw r kasljdfkl jwoieur oiwu lkjk', 'mylz', '2017-08-06 11:57:07am');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_account` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_account`, `user_password`, `user_email`, `user_address`, `user_phone`, `user_status`) VALUES
(1, 'Admin', '6ce2a004dbd3046477fd25701db4f1fa', 'martebillyjames@gmail.com', 'Western Bicutan, Taguig City', '09061976864', 1),
(2, 'bLLmes', '6ce2a004dbd3046477fd25701db4f1fa', 'martebillyjames@gmail.com', 'Western Bicutan, Taguig City', '09061976864', 0),
(3, 'mylz', '6ce2a004dbd3046477fd25701db4f1fa', 'mylz@gmail.com', 'Taguig City', '09242343234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_conversation`
--

CREATE TABLE `users_conversation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_conversation` varchar(255) NOT NULL,
  `convo_user_type` int(11) NOT NULL,
  `convo_status` int(11) NOT NULL,
  `convo_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_conversation`
--

INSERT INTO `users_conversation` (`id`, `user_id`, `user_conversation`, `convo_user_type`, `convo_status`, `convo_date`) VALUES
(1, 2, 'Good day Mr/Ms. bLLmes, how may i help you?', 1, 0, '2017-07-31 12:08:32'),
(2, 2, 'Hi i want to ask something.', 0, 0, '2017-07-31 12:09:32'),
(3, 2, 'pag sure dinhaa besh og mo send ba ka plss', 0, 0, '2017-07-31 12:12:32'),
(4, 2, 'beshHhh ma scroll down baka?', 0, 0, '2017-07-31 12:18:53'),
(5, 2, 'hai nako unsaon naman ni nga mq scroll ba kaha.', 0, 0, '2017-07-31 12:20:14'),
(6, 2, 'ok ra ba ni besh?', 0, 0, '2017-07-31 12:22:22'),
(7, 2, 'besh unsaon naman ni', 0, 0, '2017-07-31 12:24:07'),
(8, 3, 'Good day Mr/Ms. Myla Marte, how may i help you?', 1, 0, '2017-08-01 04:56:00'),
(9, 3, 'Hi admin, will you help me to fix my problem?', 0, 0, '2017-08-01 05:07:38'),
(10, 3, 'Hi again, will you please help me.', 0, 0, '2017-08-01 05:13:11'),
(11, 2, 'mag send ako ulit ngayon sana gumana :)', 0, 0, '2017-08-03 09:18:31'),
(12, 2, 'besh gagana bayang days ago minutes ago secs ago?', 0, 0, '2017-08-06 11:06:07'),
(13, 2, 'wala parin hai naku', 0, 0, '2017-08-06 11:13:08'),
(14, 2, 'kaya pala besh kasi yung format date ng pag send mo magkaiba ayan tuloy hindi tumogma', 0, 0, '2017-08-06 17:20:05'),
(15, 3, 'is my condition work fine?', 0, 0, '2017-08-06 17:45:57'),
(16, 3, 'did i miss something?', 0, 0, '2017-08-06 17:49:19'),
(17, 3, 'hey php do you want me to get angry with you?', 0, 0, '2017-08-06 17:50:38'),
(18, 2, 'thank you god my code is now working.', 0, 0, '2017-08-06 17:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `users_convo_date`
--

CREATE TABLE `users_convo_date` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latest_convo_date` datetime NOT NULL,
  `convo_read` int(11) NOT NULL,
  `convo_unread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_convo_date`
--

INSERT INTO `users_convo_date` (`id`, `user_id`, `latest_convo_date`, `convo_read`, `convo_unread`) VALUES
(1, 2, '2017-08-06 17:55:11', 8, 0),
(2, 3, '2017-08-06 17:50:38', 6, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mycart`
--
ALTER TABLE `mycart`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_data_color`
--
ALTER TABLE `product_data_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_feedback`
--
ALTER TABLE `product_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_conversation`
--
ALTER TABLE `users_conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_convo_date`
--
ALTER TABLE `users_convo_date`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mycart`
--
ALTER TABLE `mycart`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `product_data_color`
--
ALTER TABLE `product_data_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_feedback`
--
ALTER TABLE `product_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_conversation`
--
ALTER TABLE `users_conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users_convo_date`
--
ALTER TABLE `users_convo_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
