-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 05:27 PM
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
-- Database: `fkedusearch_module2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_type`) VALUES
(1, 'Web Engineering'),
(2, 'Object Oriented Programming'),
(3, 'Data Structure and Algorithms'),
(4, 'Human Computer Interaction'),
(5, 'Problem Solving'),
(6, 'Programming Techniques'),
(7, 'Software Design Workshop'),
(8, 'Operating Systems'),
(9, 'Software Engineering'),
(10, 'Software Testing'),
(11, 'Artificial Intelligence'),
(12, 'Software Requirement Workshop');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `comment_content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `discussion_id`, `comment_content`) VALUES
(1, 9, 'Please help us!'),
(2, 9, 'I also have the same problem :('),
(3, 10, 'Your port is 3306 or 3307'),
(4, 24, 'I also confuse with the definition :((('),
(5, 12, 'It seems so hard to construct the class diagram:('),
(6, 9, 'What should I do first ? I need to install Laravel first or did some command?'),
(7, 24, 'Another word for functional requirements?');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `discussion_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` varchar(100) NOT NULL,
  `tags` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `discussion_like` int(11) NOT NULL,
  `discussion_comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`discussion_id`, `category_id`, `title`, `content`, `tags`, `date`, `discussion_like`, `discussion_comment`) VALUES
(9, 7, 'How to set up Laravel', 'I got some error while setting up Laravel in my laptop', '#Laravel #SDW', '2023-06-07', 4, 3),
(10, 1, 'MySQL in XAMPP', 'Why MySQL in XAMPP is not working?', '#XAMPP', '2023-06-01', 2, 2),
(12, 2, 'UML Class Diagram', 'Why OOP so difficult?', '#OOP', '2023-05-18', 2, 1),
(24, 9, 'Functional Requirements', 'What is functional requirements? Can you give me a detail definition and also an example?', '#SE', '2023-06-05', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `discussion_id` (`discussion_id`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`discussion_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `discussion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`discussion_id`) REFERENCES `discussion` (`discussion_id`);

--
-- Constraints for table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `discussion_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
