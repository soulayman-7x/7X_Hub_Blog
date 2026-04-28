-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2026 at 04:14 PM
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
-- Database: `x-core`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `color_tag` varchar(50) DEFAULT 'tag-blue'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `color_tag`) VALUES
(1, 'System Architecture', '2026-04-10 10:51:26', 'tag-blue'),
(2, 'Cybersecurity', '2026-04-27 09:17:50', 'tag-purple'),
(3, 'Neural Interfaces', '2026-04-27 09:17:50', 'tag-cyan'),
(4, 'AI Research', '2026-04-27 09:17:50', 'tag-magenta'),
(5, 'Cloud Core', '2026-04-27 09:17:50', 'tag-cobalt');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment_text`, `created_at`) VALUES
(1, 4, 1, 'hi', '2026-04-20 14:03:26'),
(2, 3, 4, 'hi', '2026-04-20 14:54:47'),
(3, 3, 4, 'jklflsd', '2026-04-20 14:54:52'),
(4, 3, 4, 'djflksqldfj', '2026-04-20 14:54:56'),
(5, 4, 1, 'JFSDLKJ', '2026-04-20 15:15:36'),
(6, 4, 1, 'تسيمنتمش', '2026-04-20 15:18:29'),
(7, 3, 6, 'jflksdajlfks', '2026-04-21 08:43:47'),
(8, 3, 5, 'fsdjlkjlaks', '2026-04-21 08:44:21'),
(9, 6, 4, 'Strict protocols are the only way. I have integrated this Beast Mode approach into my local firewall.', '2026-04-27 12:00:00'),
(10, 7, 6, 'Nested abstraction is key. Have you tested this structure against high-load multi-threading?', '2026-04-27 12:15:00'),
(11, 8, 5, 'Pure OOP without native browser popups makes the UI flow flawlessly. Great insights on synthetic cognition.', '2026-04-27 12:30:00'),
(12, 9, 3, 'Serverless deployment reduced our latency by 40%. The 7X ecosystem is scaling perfectly.', '2026-04-27 12:45:00'),
(13, 10, 1, 'Cognitive UI mapping is still experimental, but the early operational metrics are very promising.', '2026-04-27 13:00:00'),
(14, 9, 6, 'hi', '2026-04-27 11:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `content`, `image_path`, `created_at`) VALUES
(3, 1, 1, 'Implementing Glassmorphism and Bento Grids', '<p>The digital landscape is evolving. We are moving away from chaotic retro-futurism and stepping into an era of highly structured, premium digital experiences.</p>', 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=800&auto=format&fit=crop', '2026-04-10 10:51:26'),
(4, 1, 1, 'Securing the Core: Advanced PDO Strategies', '<p>Security is not an option; it is the foundation. Using PDO prevents 99% of SQL injection attacks automatically.</p>', 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=800&auto=format&fit=crop', '2026-04-10 10:51:26'),
(6, 1, 2, 'Zero-Day Exploits: The Beast Mode Protocol', 'Maintaining strict discipline in security protocols is the only way to survive the modern digital frontier. We examine high-frequency intrusion detection systems and how a relentless discipline approach to system monitoring prevents catastrophic breaches before they happen.', 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=800&auto=format&fit=crop', '2026-04-20 07:30:00'),
(7, 1, 1, 'Architecting the Dream: Multi-Layered Data Structures', 'Like a dream within a dream, modern system architecture requires nested layers of abstraction. Building scalable infrastructure is about understanding the deeper levels of memory allocation and threading, ensuring the core logic remains completely unaltered and stable under immense pressure.', 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=800&auto=format&fit=crop', '2026-04-22 13:15:00'),
(8, 1, 4, 'Synthetic Cognition in the Cyberpunk Era', 'The neon-lit corridors of tomorrow are built on the neural networks of today. We dive into the deployment of advanced AI models using raw object-oriented programming, stripping away bloatware for pure, unadulterated performance without relying on native browser interruptions.', 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?q=80&w=800&auto=format&fit=crop', '2026-04-24 21:45:00'),
(9, 1, 5, 'Deploying the Nexus: Cloud Foundations', 'Scaling a digital ecosystem requires a robust, high-performance cloud foundation. Exploring the bleeding edge of serverless deployments and edge computing, this protocol ensures our systems execute with absolute precision across all virtualized environments.', 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=800&auto=format&fit=crop', '2026-04-25 10:10:00'),
(10, 1, 3, 'Bridging the Gap: Neural UI/UX Synchronization', 'The next evolution in digital interaction involves direct cognitive mapping. By analyzing user interaction patterns, we can engineer single-page applications that predict intent seamlessly, creating a dark, minimalist experience that feels almost telepathic.', 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=800&auto=format&fit=crop', '2026-04-27 08:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'SOULAYMAN', 'soulayman@gmail.com', '$2y$10$zM9xdOQrq3fWJzmey00jLudWmKm3sZQx0HOre6WoFIzUO/f9Y872O', 'admin', '2026-04-09 10:51:52'),
(3, 'ss', 'ss@gmail', '$2y$10$SRUiR/P/nf5cXPIW2rwFKepFDtIf0wtwvd3aPfy5HQnA4Nz7Y8qje', 'user', '2026-04-09 11:00:11'),
(4, 'user', 'user@gmail.com', '$2y$10$x9WoGTwaKcsiiGgyliJPveWwCAmQEue0cJKNC9GHriBN70z4zqhN.', 'user', '2026-04-20 14:18:06'),
(5, 'test', 'test@gmail.com', '$2y$10$ocvu3DJhWOqpNan.1ULQWuwj4XWPBYKjW9bMlV1y593VK9MKVaIHu', 'user', '2026-04-21 08:42:53'),
(6, 'neo', 'neo@gmail.com', '$2y$10$xAqsqNTOthnEeWBtZ8zES.RyMx7DxK8Z9Z/2G4fkd24EDvlSNOj6a', 'user', '2026-04-21 08:43:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
