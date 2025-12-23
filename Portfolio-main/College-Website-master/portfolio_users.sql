-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 08:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `portfolio_users`
--

-- --------------------------------------------------------
CREATE TABLE gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    src VARCHAR(255) NOT NULL,
    caption TEXT NOT NULL,
    category VARCHAR(50) NOT NULL
);

INSERT INTO gallery (src, caption, category) VALUES
('image/gallery_pics/1.jpg', 'Sunset Over Mountains', 'coal'),
('image/gallery_pics/2.jpg', 'Blooming Spring', 'aquarelle'),
('image/gallery_pics/3.jpg', 'Coal Study 2022', 'aquarelle'),
('image/gallery_pics/4.jpeg', 'Mystic Forest', 'coal'),
('image/gallery_pics/5.jpg', 'Golden Horizon', 'aquarelle'),
('image/gallery_pics/6.jpg', 'Morning Dew', 'oil'),
('image/gallery_pics/7.jpg', 'Charcoal Sketch', 'oil'),
('image/gallery_pics/8.jpeg', 'Evening Glow', 'coal'),
('image/gallery_pics/9.jpg', 'Ocean Breeze', 'oil'),
('image/gallery_pics/10.jpg', 'Sunlit Path', 'oil'),
('image/gallery_pics/11.jpg', 'Coal Study 2014', 'oil'),
('image/gallery_pics/12.jpg', 'Gentle River', 'aquarelle'),
('image/gallery_pics/13.jpg', 'Winter Calm', 'aquarelle'),
('image/gallery_pics/14.jpg', 'Autumn Leaves', 'oil'),
('image/gallery_pics/15.jpg', 'Coal Study 2010', 'oil'),
('image/gallery_pics/16.jpg', 'Misty Morning', 'oil'),
('image/gallery_pics/17.jpg', 'Sunset Glory', 'coal'),
('image/gallery_pics/18.jpg', 'Spring Fields', 'oil'),
('image/gallery_pics/19.jpg', 'Coal Study 2006', 'oil'),
('image/gallery_pics/20.jpg', 'Evening Mist', 'coal'),
('image/gallery_pics/21.jpg', 'Ocean Waves', 'oil'),
('image/gallery_pics/22.jpg', 'Morning Light', 'aquarelle'),
('image/gallery_pics/23.jpg', 'Coal Study 2002', 'aquarelle'),
('image/gallery_pics/24.jpg', 'Forest Walk', 'mixed'),
('image/gallery_pics/25.jpg', 'Sunrise Glory', 'oil'),
('image/gallery_pics/26.jpg', 'Aquarelle Study 1999', 'oil'),
('image/gallery_pics/27.jpg', 'Coal Study 1998', 'aquarelle'),
('image/gallery_pics/28.jpg', 'Mixed Media 1997', 'aquarelle'),
('image/gallery_pics/29.jpg', 'Sunset Fields 1996', 'aquarelle'),
('image/gallery_pics/30.jpg', 'Morning Mist 1995', 'aquarelle'),
('image/gallery_pics/31.jpg', 'Coal Sketch 1994', 'aquarelle'),
('image/gallery_pics/32.jpg', 'Mixed Study 1993', 'aquarelle'),
('image/gallery_pics/33.jpeg', 'Final Coal Study 1992', 'coal');
--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` enum('male','female','others') NOT NULL,
  `dob` date NOT NULL,
  `course` varchar(50) NOT NULL,
  `file` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `gender`, `dob`, `course`, `file`, `password`, `role`, `created_at`) VALUES
(1, 'gaga', 'f@f', '535253', 'male', '2025-12-13', '', '', 'asdf', 'user', '2025-12-10 15:43:40'),
(2, 'Admin', 'admin@admin.com', '0000', 'male', '2000-01-01', 'none', 'none', 'admin', 'admin', '2025-12-10 15:45:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
