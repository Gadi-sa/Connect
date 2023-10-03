-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 12:24 PM
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
-- Database: `backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `story_id` int(11) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `story_id`, `comment`, `created_at`) VALUES
(28, 1, 57, 'hello this is me\r\n', '2023-03-28 15:21:03'),
(29, 1, 57, 'hola jo soy hodidamente el rey\r\n', '2023-03-28 15:25:33'),
(31, 11, 59, '    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error vel odit velit incidunt qui libero fugit hic tempora. Commodi quod accusamus reiciendis obcaecati et quam enim expedita eligendi. Laborum, perferendis!    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error vel odit velit incidunt qui libero fugit hic tempora. Commodi quod accusamus reiciendis obcaecati et quam enim expedita eligendi. Laborum, perferendis!', '2023-03-28 17:12:21'),
(32, 11, 59, '    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error vel odit velit incidunt qui libero fugit hic tempora. Commodi quod accusamus reiciendis obcaecati et quam enim expedita eligendi. Laborum, perferendis!', '2023-03-28 17:12:53'),
(33, 11, 59, '    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error vel odit velit incidunt qui libero fugit hic tempora. Commodi quod accusamus reiciendis obcaecati et quam enim expedita eligendi. Laborum, perferendis!    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error vel odit velit incidunt qui libero fugit hic tempora. Commodi quod accusamus reiciendis obcaecati et quam enim expedita eligendi. Laborum, perferendis!    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error vel odit velit incidunt qui libero fugit hic tempora. Commodi quod accusamus reiciendis obcaecati et quam enim expedita eligendi. Laborum, perferendis!    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error vel odit velit incidunt qui libero fugit hic tempora. Commodi quod accusamus reiciendis obcaecati et quam enim expedita eligendi. Laborum, perferendis!', '2023-03-28 17:14:11'),
(34, 1, 59, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae numquam totam, harum rem ratione expedita necessitatibus dolor laudantium consequuntur dolorum. Quos et autem placeat commodi dolorem facere recusandae labore praesentium.Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae numquam totam, harum rem ratione expedita necessitatibus dolor laudantium consequuntur dolorum. Quos et autem placeat commodi dolorem facere recusandae labore praesentium.', '2023-03-28 19:48:44'),
(35, 12, 57, 'well done ❤️', '2023-03-29 12:22:27'),
(36, 12, 57, 'its done!', '2023-03-31 13:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `story_title` varchar(255) DEFAULT NULL,
  `story_content` text DEFAULT NULL,
  `story_image` varchar(255) DEFAULT NULL,
  `story_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `user_id`, `story_title`, `story_content`, `story_image`, `story_created_at`) VALUES
(51, 12, 'akkam', 'akkam nagahaa', 'story_image/logo2.png', '2023-03-23 17:04:20'),
(57, 11, 'this title', 'the content of the post', 'story_image/favicon-32x32.jpg', '2023-03-27 09:19:00'),
(59, 11, 'How to fix the Lorem ipsum dolor sit amet consectetur?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error vel odit velit incidunt qui libero fugit hic tempora. Commodi quod accusamus reiciendis obcaecati et quam enim expedita eligendi. Laborum, perferendis!    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error vel odit velit incidunt qui libero fugit hic tempora. Commodi quod accusamus reiciendis obcaecati et quam enim expedita eligendi. Laborum, perferendis!', 'story_image/logo2.png', '2023-03-28 17:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(75) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bio` varchar(800) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `joined_day` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `bio`, `profile_picture`, `joined_day`) VALUES
(1, 'Gadisa Ahmed', '$2y$10$hUD6iAr/LH6n/weT4hyc.OHktriWL54w12/FwSWwoUrH/GJW1aiY2', 'gadisa@connect.nl', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae numquam totam, harum rem ratione expedita necessitatibus dolor laudantium consequuntur dolorum. Quos et autem placeat ', 'gadisa.jpg', '2023-03-23'),
(11, 'Alison Burger', '$2y$10$D0h.ZuNFbd1T0TZRDKHpL.oMnMfylsgWnarvlrXpH2rQ78VxTGi/6', 'alison@connect.nl', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo quos nulla sed ut quas fuga possimus consectetur tempora est ullam suscipit eveniet ipsam, \r\n', 'default_profile.jpeg', '2023-03-23'),
(12, 'Akkam Nagaha', '$2y$10$b38B05rQAbrf2FHdz9noke7IdTMGqHCAoQu7XEOu/mJpS2vTZS5j.', 'akkam@connect.nl', '', 'random2.png', '2023-03-23'),
(15, 'Coach Fons', '$2y$10$toAyGH1b8xfslBgJp60PIOFUUDto0mqA1rIWKpL3PehgpFXadS.VS', 'fons@connect.nl', NULL, 'profile_642d62577f2bf5.93531633.jpeg', '2023-04-05'),
(19, 'Connect User', '$2y$10$wpbfeS7O4r7ObN/Km2031uzalYY4rT9cK9P62Vkv8bYJ7EbmVn0pC', 'user@connect.nl', 'Connect is a responsive social networking website that allows users to easily create profiles, share their stories, and connect with others. The platform features a simple user registration, login system, and forget password, enabling users to quickly customize their profiles with personal information, profile picture, and a short biography.', 'random3.jpg', '2023-04-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_users` (`user_id`),
  ADD KEY `fk_comments_stories` (`story_id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stories_users` (`user_id`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_stories` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `fk_stories_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
