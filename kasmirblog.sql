-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2022 at 05:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasmirblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_verification`
--

CREATE TABLE `account_verification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verification_code` int(10) NOT NULL,
  `otp_expiry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_verification`
--

INSERT INTO `account_verification` (`id`, `user_id`, `verification_code`, `otp_expiry`) VALUES
(22, 32, 150293, '2022-06-15'),
(23, 33, 479353, '2022-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `image`, `created_at`) VALUES
(2235, 32, 'Roadmap to be successful laravel web developer', 'HTML, CSS, JAVASCRIPT, PHP, and Laravel. These are the five languages you should learn to become a successful web developer. You&#39;ll need to know these languages if you want to build web pages that look good and work well.\r\n\r\n\r\n\r\nIf you&#39;re a beginner, start with HTML. It&#39;s the language of the web, and learning it will give you a solid foundation for creating websites. Once you&#39;ve got that down, move on to CSS. This will help you make your pages look better with images and colors.\r\n\r\nAfter that, learn Javascript so that you can add interactivity features like buttons or drop-down menus to your website. Then pick up PHP since it&#39;s used for server-side scripting—meaning it can run code on an actual server instead of just in your browser like in Javascript. Finally learn Laravel because it is a framework that makes building an app easier by providing features like routing and user authentication out of the box!', 'LdUntUoT/html.png', '2022-06-15 05:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `profile_picture` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_verify` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `description`, `profile_picture`, `email`, `password`, `is_verify`) VALUES
(32, 'JestherCostinar', 'I am currently a senior in college, majoring in Computer Science. I am highly proficient in PHP and am able to create websites using PHP frameworks such as Laravel. I have experience with PHP, Laravel HTML5, CSS3, JavaScript,jQuery, GIT, and other open-source frameworks.', 'BAy3at71/1652951966294.jfif', 'jesther.costinar@my.jru.edu', '$2y$10$s3oZdqJyfWjTZqTaTP2Yx.7SrdD325xiB8M.B/1we7ADra/2JoI9y', 1),
(33, 'JestherCostinar', '', '', 'jesth2er.costinar@my.jru.edu', '$2y$10$oMYUb3XOY7VWdgHHcqPYxe45weBNifbSzFiLJtZxLy18RbWDmrIjC', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_verification`
--
ALTER TABLE `account_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_verification`
--
ALTER TABLE `account_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2236;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
