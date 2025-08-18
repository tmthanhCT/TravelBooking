-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2025 at 06:22 PM
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
-- Database: `jettravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `booking_at` datetime NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `num_people` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `STATUS` enum('pending','confirmed','cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `package_id`, `booking_at`, `start_date`, `end_date`, `num_people`, `price`, `subtotal`, `STATUS`) VALUES
(7, 10, 5, '2025-08-05 03:28:00', '2025-08-03', '2025-08-04', 4, 122.00, 427.00, 'confirmed'),
(9, 10, 7, '2025-08-06 18:57:20', '2025-08-05', '2025-08-06', 2, 999.00, 1998.00, 'confirmed'),
(10, 7, 5, '2025-08-06 19:05:20', '2025-08-13', '2025-08-14', 2, 122.00, 244.00, 'confirmed'),
(11, 7, 7, '2025-08-06 19:11:00', '2025-08-03', '2025-08-05', 4, 999.00, 3496.50, 'confirmed'),
(12, 7, 9, '2025-08-10 20:10:00', '2025-08-01', '2025-08-04', 4, 799.00, 3196.00, 'confirmed'),
(13, 10, 8, '2025-08-05 07:57:00', '2025-05-08', '2025-09-08', 3, 899.00, 2247.50, 'cancelled'),
(15, 10, 4, '2025-08-06 08:10:00', '2025-08-05', '2025-08-07', 3, 329.00, 822.50, 'pending'),
(21, 10, 7, '2025-08-11 18:01:24', '2025-08-11', '2025-08-12', 2, 699.00, 1398.00, 'pending'),
(22, 10, 7, '2025-08-11 18:05:37', '2025-08-11', '2025-08-13', 2, 699.00, 1398.00, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_tours` varchar(255) DEFAULT NULL,
  `img_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_tours`, `img_id`) VALUES
(4, 'Can Tho - HCM', 1),
(5, 'Da Nang - Hoi An', 3),
(6, 'Beach Tour', 4),
(7, 'Da Lat - Sapa', 5),
(8, 'Hue - Phong Nha', 6),
(9, 'Ha Noi - Ha Long', 7);

-- --------------------------------------------------------

--
-- Table structure for table `images_url`
--

CREATE TABLE `images_url` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images_url`
--

INSERT INTO `images_url` (`id`, `image_url`, `title`) VALUES
(1, 'img/Feature_CT-HCM.jpg', 'Cần Thơ - TP.HCM'),
(3, 'img/Feature_DaNang-HoiAn.jpg', 'Đà Nẵng - Hội An'),
(4, 'img/Feature_NhaTrang-PhuQuoc.jpg', 'Nha Trang - Phú Quốc'),
(5, 'img/Feature_DaLat-SaPa.jpg', 'Đà Lạt - Sa Pa'),
(6, 'img/Feature_Hue-PhongNha.jpg', 'Huế - Phong Nha'),
(7, 'img/Featured_HaNoi-HaLongBay.jpg', 'Hà Nội - Hạ Long Bay');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `Name_Package` text DEFAULT NULL,
  `Destination` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `max_people` int(11) DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `img_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `Name_Package`, `Destination`, `category_id`, `max_people`, `duration`, `price`, `img_id`) VALUES
(4, 'Mekong to Metropolis', 'Can Tho - HCM', 4, 4, 3, 329.00, 1),
(5, 'Twin Island Escape', 'Nha Trang - Phu Quoc', 6, 2, 4, 122.00, 4),
(6, 'Heritage Coastline', 'Da Nang - Hoi An', 5, 3, 5, 333.00, 3),
(7, 'Capital to Cruise', 'Ha Noi - Ha Long', 9, 3, 2, 699.00, 7),
(8, 'Misty Highlands Adventure', 'Da Lat - Sapa', 7, 7, 7, 899.00, 5),
(9, 'Imperial & Underground Wonders', 'Hue - Phong Nha', 8, 5, 5, 799.00, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `NAME` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `role` enum('admin','client') DEFAULT 'client',
  `wallet` decimal(10,2) DEFAULT 0.00,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `NAME`, `email`, `city`, `phone`, `PASSWORD`, `role`, `wallet`, `rating`, `review`, `created_at`) VALUES
(7, 'admin', 'admin@gmail.com', NULL, '1230231000', '$2y$10$K/zni03WHm6LGbbnUjoNQ./sEy4zaWW43jgT4OSF0HDpLIiyPT38u', 'client', 4041.20, 4, 'Good', '2025-08-06 20:16:26'),
(8, 'Admin', 'admin@admin.com', 'Can Tho', '0123456798', '$2y$10$X6K8CVT5aq502Oo/Su9NxuqfIGCyXYP7v1.pP.0A15iYReheV0oVm', 'admin', 0.00, NULL, NULL, '2025-08-06 19:25:07'),
(10, 'Minh Thanh', 'client@user.com', 'Vinh Long', '123231312', '$2y$10$zGfseMFnRpO7u1cJkM6Q0OP50nNxvv0qQG3ksSRHfXPS9roWzWr1y', 'client', 4161.20, 5, 'Wonderfulllll', '2025-08-08 08:29:41'),
(11, 'Thanh', 'thanh@tran.com', NULL, '0123123123', '$2y$10$mwzZtJYkDxYXLpItCpU6r./5YNHE7YXS9QLMzATwxyzCatmeeZLCS', '', 0.00, NULL, NULL, '2025-08-08 04:06:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_img` (`img_id`);

--
-- Indexes for table `images_url`
--
ALTER TABLE `images_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_img_id` (`img_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `images_url`
--
ALTER TABLE `images_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_img` FOREIGN KEY (`img_id`) REFERENCES `images_url` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `fk_img_id` FOREIGN KEY (`img_id`) REFERENCES `images_url` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
