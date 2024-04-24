-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 01:15 AM
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
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `filename` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `post_id`, `filename`) VALUES
(1, 41, 'erd-assignment4_Tanner_Agar.png'),
(2, 45, 'Fr-quy_XsAI14Zx.png'),
(3, 46, 'erd-assignment4_Tanner_Agar.png');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `street_address` varchar(64) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `role_id`, `email_address`, `street_address`, `full_name`, `password`) VALUES
(33, 1, 'jesse@wwf.com', '1250 24th St', 'Jesse Dun', 'secure1$11$'),
(34, 2, 'sarah@isrelief.com', '456 Elm St', 'Nehaya Smith', 'isrelief99$'),
(35, 3, 'steven@hotmail.com', '789 Oak St', 'Steven Johnson', 'secretsteve!4d'),
(36, 4, 'tanner@gmail.com', '101 Pinecone St', 'Tanner William', 'charityp455$');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `org_id` int(11) NOT NULL,
  `rating_id` int(11) NOT NULL,
  `full_org_name` varchar(128) NOT NULL,
  `acronym` varchar(10) NOT NULL,
  `head_of_chair` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`org_id`, `rating_id`, `full_org_name`, `acronym`, `head_of_chair`) VALUES
(1, 1, 'Womensv', 'Wv', 'Ruth Darlene'),
(2, 2, 'Disabled American Veterans', 'DAV', 'J. Marc Burgess'),
(3, 3, 'WWF World Wildlife Fund', 'WWF', 'Carter Roberts'),
(4, 4, 'Doctors Without Borders', 'DWB', 'Dr. Christos Chirstou'),
(5, 5, 'Heart and Stroke Foundation', 'HSF', 'Doug Roth'),
(6, 6, 'Aga Khan Foundation', 'AgKh', 'Khalil Z. Shariff'),
(7, 7, 'National Urban League', 'NUL', 'Marc H. Morial'),
(8, 8, 'Islamic Relief', 'ISR', 'Waseem Ahmad'),
(9, 9, 'American Jewish Joint Distribution Committee', 'AJJDC', 'Ariel Zwang'),
(10, 10, 'Palestine Childrens Relief Fund', 'PCRF', 'Ms. Vivan Rasem Khalaf'),
(11, 1, 'Womensv', 'Wv', 'Ruth Darlene'),
(12, 2, 'Disabled American Veterans', 'DAV', 'J. Marc Burgess'),
(13, 3, 'WWF World Wildlife Fund', 'WWF', 'Carter Roberts'),
(14, 4, 'Doctors Without Borders', 'DWB', 'Dr. Christos Chirstou'),
(15, 5, 'Heart and Stroke Foundation', 'HSF', 'Doug Roth'),
(16, 6, 'Aga Khan Foundation', 'AgKh', 'Khalil Z. Shariff'),
(17, 7, 'National Urban League', 'NUL', 'Marc H. Morial'),
(18, 8, 'Islamic Relief', 'ISR', 'Waseem Ahmad'),
(19, 9, 'American Jewish Joint Distribution Committee', 'AJJDC', 'Ariel Zwang'),
(20, 10, 'Palestine Childrens Relief Fund', 'PCRF', 'Ms. Vivan Rasem Khalaf');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(9) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `date_created`, `updated_at`, `title`, `content`, `member_id`) VALUES
(17, '2024-04-21 00:48:32', '2024-04-20 19:22:46', 'Doctors Without Borders', 'Doctor&#039;s Without Borders is an organization that was founded in 1990 to field doctors, and other staff, create awareness, and to raise money to be used on the international scale serving countries that are unable to provide for themselves, as well as advocate wit the United Nations, and the American government on various humanity concerns. Doctor&#039;s Without Borders provides aid in close to 60 countries, to people who struggle with conflict, natural disaster, or neglect. Generally, the main problem is due to armed conflict, epidemics like malaria, and food security, or health care exclusion.', 0),
(18, '2024-04-21 00:53:22', '2024-04-20 19:22:46', 'World Wildlife Fund', 'The World Wildlife Fund also known as WWF, our mission is to conserve nature. We use evidence from scientific method, and use that knowledge to further advance where possible. Our work is done on ecosystems, fragile or not, preserving the abundance and the diversity of life on the planet. The health of the ecosystems is always our primary objective, by the protection of natural areas, and wild populations of plants and animals, which include endangered species, or species that are at risk. Sustainability is embedded in our mission, and with that comes the discussion and activism on behalf of renewable energy. Awareness of such is important, as we are committed to the complete reversal of the environment degradation across the planet. We recognize the critical evidence needed to do so, in terms of human population, poverty, and the consumption patterns associated to meeting goals of reversal.', 0),
(19, '2024-04-21 00:55:58', '2024-04-20 19:22:46', 'UNICEF', 'United Nations Children&#039;s Fund, has been around for over eight decades. Our goal at UNICEF is a global support system for Earth&#039;s children. We work relentlessly around the block to provide for the children of the world, giving out essentials: health care, immunizations, safe water, and sanitation, nutrition, education, emergency relief, and much more. Here at UNICEF we are advancing the global mission, we rally the public to support the world&#039;s vulnerable children. We have saved more children&#039;s lives than any other organization, with your support.', 0),
(20, '2024-04-21 01:00:18', '2024-04-20 19:22:46', 'Disabled American Veterans (DAV)', 'At DAV we believe that all veterans have the right to flourish after their service. We provide physical, psychological services, critical programs for veterans who are ill, injured, or wounded veterans. The programs include the following: food security, shelter, and any other key items to the homeless or veterans at risk. We provide accessibility or mobility items for veterans with vision or hearing impairments, and necessary therapeutic activities for recovery. Direct servicing is our goal for our veterans and their families, in the path to recovery or a high quality of living.', 0),
(21, '2024-04-21 01:07:38', '2024-04-20 19:22:46', 'Dress for Success', 'We&#039;re an international not-for-profit organization that is dedicated to the empowerment of women in economic parity. Our direct is to provide a network of support, professional fittings in the development of women, giving them the ability to thrive and proliferate in the workplace and furthermore in life, beyond. We&#039;ve been active since 1997, and operate in 150 cities, and in 30 countries. We&#039;ve helped more than one million women work towards their self-determination, self-sufficiency', 0),
(22, '2024-04-21 01:14:43', '2024-04-20 19:22:46', 'Womensv', 'Our mission is to serve women and children and children whose lives have been affected by domestic abuse or violence. We focus on not only the more explicit events, but also the subtle, covert control that can isolate individuals, and make them continually misunderstood and under supported in cyclical pattern. Our support groups are offered virtual and provide the necessary validation, education, and support to plan effective tactics and aids to survivors of domestic abuse. Coercive control is when a pattern of control that isolates, threatens, and is controlling such that it deprives an intimate partner of their identity, including their safety, self-sufficiency.\r\n\r\nFind us on the web at https://womensv.org/', 0),
(23, '2024-04-21 01:26:48', '2024-04-24 21:12:14', 'Heart and Stroke Foundation Canada', 'Our mission at Heart and Stroke Foundation, is to perform key research in advancing science, that will ultimately save numerous lives. By preventing disability, supporting diagnostics and the recovery process, with your continued support we improve the overall health of people in Canada.\r\n\r\nOver the years, we&#039;ve invested a total of $32.5 million in promotional programs about health, as well as general advocacy. Programs included school education, and fundraising programs like &quot;Jump Rope for Heart.&quot; Which is a fundraising event taking place across schools nationwide. Fun for everybody, or in our words an event &quot;no one wants to skip.&quot; Participants fundraise for the cause, and the event culminates with a day long celebration of activities, and prizes handed out. All in the name of skipping, and healthy living. We look forward to hearing from you.', 0),
(24, '2024-04-21 01:38:16', '2024-04-20 19:22:46', 'Aga Khan Foundation', 'Established in 1981, Aga Khan foundation&#039;s mission is to promote social development in low income countries, by providing funding for programs in multiple fields, such as health, education, and development in rural areas, also including civil society and the environment. The principal finance supports are of grants, and contributions made from government agencies, individuals like you, and corporations, other foundations.', 0),
(25, '2024-04-21 01:44:13', '2024-04-20 19:22:46', 'National Urban League', 'The National Urban League&#039;s inception was in 1910, which makes it one of the oldest, largest community based movements that is dedicated to empowering African Americans to enter the work force and thrive in the economy, and the social mainstream. Our framework spearheads a non-partisan effort of local affiliated, with over 100 local affiliates on board, and located in 35 states, with the District of Columbia providing these services directly to over two million nationwide. With our programs, advocacy, and research, our mission is clear: to enable African America securing economic self-sufficiency, reliance and along with that, parity, power and subsequent civil rights that are implicit, and asserted with adequate representation.', 0),
(26, '2024-04-21 01:48:58', '2024-04-20 19:31:49', 'Islamic Relief', 'Islamic Relief is a provider of relief and the development of humanity regardless of gender, race, or religion. Despite the seemingly religion centered name, it is our mission to develop all people in a dignified manner. We empower individuals in communities, giving them a voice in the world they otherwise wouldn&#039;t have. Our goal is to unite all for a world rid of pervasive poverty. Timeless values guide us, and teachings that are contained in the Qur&#039;an. Revelations, and the prophetic example. These tenets encompass excellence in operations, conduct, a convicted obligation to respond to 1poverty, as well as every life being paramount of importance to the world.', 0),
(46, '2024-04-25 05:10:04', '2024-04-24 22:10:04', 'erd', 'This is test post for uploading an image', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `total_ratings` int(11) DEFAULT NULL,
  `time_rated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `role_status` varchar(24) DEFAULT NULL,
  `role_name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `org_id`, `role_status`, `role_name`) VALUES
(5, 1, 'trusted', 'Organization'),
(6, 2, 'safe', 'Member'),
(7, 3, 'trusted', 'Community Moderator'),
(8, 4, 'under observation', 'Member'),
(9, 1, 'trusted', 'Organization'),
(10, 2, 'safe', 'Member'),
(11, 3, 'trusted', 'Community Moderator'),
(12, 4, 'under observation', 'Member'),
(13, 1, 'trusted', 'Organization'),
(14, 2, 'safe', 'Member'),
(15, 3, 'trusted', 'Community Moderator'),
(16, 4, 'under observation', 'Member'),
(17, 1, 'trusted', 'Organization'),
(18, 2, 'safe', 'Member'),
(19, 3, 'trusted', 'Community Moderator'),
(20, 4, 'under observation', 'Member'),
(21, 1, 'trusted', 'Organization'),
(22, 2, 'safe', 'Member'),
(23, 3, 'trusted', 'Community Moderator'),
(24, 4, 'under observation', 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `FK_posts_images` (`post_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `org_id` (`org_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_posts_images` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organization` (`org_id`);

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organization` (`org_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
