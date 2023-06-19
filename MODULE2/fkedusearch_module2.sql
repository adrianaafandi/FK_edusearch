-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2023 at 12:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `answer_content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 24, 'Another word for functional requirements?'),
(8, 9, 'I don\'t know too man'),
(9, 10, 'test'),
(10, 10, 'test123'),
(11, 10, 'test123'),
(12, 10, 'okay'),
(13, 10, 'okay'),
(14, 24, 'test test'),
(15, 24, 'testsss'),
(16, 10, 'testtttttt'),
(17, 10, 'second time'),
(18, 10, '12345'),
(25, 10, '12345'),
(26, 10, '12345'),
(27, 10, 'baiklah'),
(28, 10, 'i try'),
(29, 12, 'saya stress'),
(30, 36, 'C++ and C is a same language?'),
(31, 34, 'Me also!'),
(32, 9, 'warsena minta tolong');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `discussion_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
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

INSERT INTO `discussion` (`discussion_id`, `category_id`, `expert_id`, `title`, `content`, `tags`, `date`, `discussion_like`, `discussion_comment`) VALUES
(9, 7, 4, 'How to set up Laravel', 'I got some error while setting up Laravel in my laptop', '#Laravel', '2023-06-07', 23, 5),
(10, 1, 1, 'MySQL in XAMPP', 'Why MySQL in XAMPP is not working?', '#XAMPP', '2023-06-01', 12, 20),
(12, 2, 10, 'UML Class Diagram', 'Why OOP so difficult?', '#OOP', '2023-05-18', 6, 2),
(24, 9, 11, 'Functional Requirements', 'What is functional requirements? Can you give me a detail definition and also an example?', '#SE', '2023-06-05', 2, 2),
(29, 11, 2, 'Fuzzy Logic', 'How to create a membership function?', '#AI', '2023-06-19', 13, 0),
(31, 7, 4, 'Laragon', 'How to connect using Laragon?', '#Laragon', '2023-05-11', 16, 0),
(33, 8, 8, 'Command', 'Can you give me an example of the command used?', '#OS', '2023-03-16', 14, 0),
(34, 4, 3, 'Justinmind', 'How to use that application? or software? I am a newbie', '#HCI', '2023-01-19', 13, 1),
(35, 1, 1, 'PHP', 'Why I can\'t view my interface when I save the file as .php?', '#WE', '2023-02-15', 17, 1),
(36, 6, 0, 'C Language', 'Help! I don\'t know where to start', '#C', '2023-02-10', 8, 1),
(37, 12, 0, 'SRS', 'How to do Use Case Description?', '#SRW', '2023-01-06', 0, 0),
(38, 9, 11, 'Quality Requirement', 'What is Quality Requirement?', '#SE', '2023-06-07', 0, 0),
(39, 5, 0, 'IPO', 'What is IPO?', '#ProblemSolving', '2023-01-04', 0, 0),
(41, 2, 0, 'Sorting', 'What is Sorting? and how to do that in C language?', '#C', '2023-04-12', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `expert_id` int(11) NOT NULL,
  `expert_name` varchar(255) NOT NULL,
  `expert_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`expert_id`, `expert_name`, `expert_category`) VALUES
(1, 'DR. NOORLIN BINTI MOHD ALI', 'Web Engineering'),
(2, 'DR. ANIS FARIHAN BINTI MAT RAFFEI', 'Artificial Intelligence'),
(3, 'DR. SITI SUHAILA BINTI ABDUL HAMID', 'Human Computer Interaction'),
(4, 'TS. AZMA BINTI ABDULLAH', 'Software Design Workshop'),
(5, 'KU SAIMAH BINTI KU IBRAHIM', 'Software Requirement Workshop'),
(6, 'NURSHAFIQA SAFFAH BINTI MOHD SHARIF', 'Data Structure and Algorithms'),
(7, 'DR. AHMAD FAKHRIE BIN AB. NASIR', 'Programming Techniques'),
(8, 'DR. ZAHIAN BINTI ISMAIL', 'Operating Systems'),
(9, 'DR. ZAFRIL RIZAL BIN M AZMI', 'Problem Solving'),
(10, 'MOHD HAFIZ BIN MOHD HASSIN', 'Object Oriented Programming'),
(11, 'TS. DR. FAUZIAH BINTI ZAINUDDIN', 'Software Engineering'),
(12, 'TS. AZLINA BINTI ZAINUDDIN', 'Software Testing');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `education_level` varchar(255) NOT NULL,
  `current_academic_status` varchar(255) NOT NULL,
  `research_type` varchar(255) NOT NULL,
  `RA_desc` varchar(255) NOT NULL,
  `socmed_name` varchar(255) NOT NULL,
  `socmed_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `email`, `education_level`, `current_academic_status`, `research_type`, `RA_desc`, `socmed_name`, `socmed_type`) VALUES
(1, 'TENGKU FARISHA ELLIANA BINTI TENGKU HAMZAH', 'tengkufarisha10@gmail.com', 'Sijil Matrikulasi KPM Jurusan Sains (Modul II)', 'Bachelor of Computer Science (Software Engineering) with Honours', 'Project Based', 'Software Engineering', 'tgfarisha', 'Instagram'),
(2, 'WARSENA A/P EH CHUOI', 'dnaawarsena@gmail.com', 'Sijil Matrikulasi KPM Jurusan Sains (Modul III)', 'Bachelor of Computer Science (Software Engineering) with Honours', 'Research Based', 'EduTech', 'wwarsena_', 'Instagram'),
(3, 'NURUL ADRIANA BINTI MOHAMAD AFANDI', 'adrianaafandi@gmail.com', 'Sijil Matrikulasi KPM Jurusan Sains (Modul I)', 'Bachelor of Computer Science (Software Engineering) with Honours', 'IoT', 'EduTech', 'adrianaafandi', 'Instagram');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `discussion_id` (`discussion_id`);

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
-- Indexes for table `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`expert_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `discussion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `expert`
--
ALTER TABLE `expert`
  MODIFY `expert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`discussion_id`) REFERENCES `discussion` (`discussion_id`);

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
