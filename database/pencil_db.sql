-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2018 at 11:18 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pencil_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pencil_db_categories`
--

CREATE TABLE `pencil_db_categories` (
  `pencil_db_categories_id` int(11) NOT NULL,
  `pencil_db_categories_user_id` int(11) NOT NULL,
  `pencil_db_categories_name` varchar(255) NOT NULL,
  `pencil_db_categories_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pencil_db_comments`
--

CREATE TABLE `pencil_db_comments` (
  `pencil_db_comments_id` int(11) NOT NULL,
  `pencil_db_comments_post_id` int(11) NOT NULL,
  `pencil_db_comments_name` varchar(255) NOT NULL,
  `pencil_db_comments_email` varchar(255) NOT NULL,
  `pencil_db_comments_body` text NOT NULL,
  `pencil_db_comments_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pencil_db_posts`
--

CREATE TABLE `pencil_db_posts` (
  `pencil_db_posts_id` int(11) NOT NULL,
  `pencil_db_posts_category_id` int(11) NOT NULL,
  `pencil_db_posts_user_id` int(11) NOT NULL,
  `pencil_db_posts_title` varchar(255) NOT NULL,
  `pencil_db_posts_slug` varchar(255) NOT NULL,
  `pencil_db_posts_body` text NOT NULL,
  `pencil_db_posts_post_image` varchar(255) NOT NULL,
  `pencil_db_posts_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pencil_db_users`
--

CREATE TABLE `pencil_db_users` (
  `pencil_db_users_id` int(11) NOT NULL,
  `pencil_db_users_image` varchar(255) NOT NULL,
  `pencil_db_users_name` varchar(255) NOT NULL,
  `pencil_db_users_email` varchar(255) NOT NULL,
  `pencil_db_users_username` varchar(255) NOT NULL,
  `pencil_db_users_bio` text NOT NULL,
  `pencil_db_users_password` varchar(255) NOT NULL,
  `pencil_db_users_is_admin` varchar(3) NOT NULL DEFAULT 'no',
  `pencil_db_users_is_active` varchar(3) NOT NULL DEFAULT 'yes',
  `pencil_db_users_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pencil_db_categories`
--
ALTER TABLE `pencil_db_categories`
  ADD PRIMARY KEY (`pencil_db_categories_id`);

--
-- Indexes for table `pencil_db_comments`
--
ALTER TABLE `pencil_db_comments`
  ADD PRIMARY KEY (`pencil_db_comments_id`);

--
-- Indexes for table `pencil_db_posts`
--
ALTER TABLE `pencil_db_posts`
  ADD PRIMARY KEY (`pencil_db_posts_id`);

--
-- Indexes for table `pencil_db_users`
--
ALTER TABLE `pencil_db_users`
  ADD PRIMARY KEY (`pencil_db_users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pencil_db_categories`
--
ALTER TABLE `pencil_db_categories`
  MODIFY `pencil_db_categories_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pencil_db_comments`
--
ALTER TABLE `pencil_db_comments`
  MODIFY `pencil_db_comments_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pencil_db_posts`
--
ALTER TABLE `pencil_db_posts`
  MODIFY `pencil_db_posts_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pencil_db_users`
--
ALTER TABLE `pencil_db_users`
  MODIFY `pencil_db_users_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
