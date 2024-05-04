-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 07:32 AM
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
-- Database: `ncas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_list`
--

CREATE TABLE `application_list` (
  `id` int(30) NOT NULL,
  `club_id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` text NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `year_level` text NOT NULL,
  `section` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Confirmed, 2 = Approved, 3 = Denied',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_list`
--

INSERT INTO `application_list` (`id`, `club_id`, `firstname`, `middlename`, `lastname`, `student_id`, `gender`, `year_level`, `section`, `message`, `email`, `contact`, `address`, `status`, `date_created`, `date_updated`) VALUES
(8, 2, 'Nidosan', '', 'Mohanaraj', '28177', 'Male', '22.2', 'Computer Networks', 'twhetjyrmut', 'mohan.nidosan@gmail.com', '0765519233', 'fdsgfhn', 2, '2023-11-25 23:36:37', '2023-11-26 18:18:03'),
(9, 4, 'Nidosan', '', 'Mohanaraj', '28177', 'Male', '22.2', 'Computer Networks', 'To Improve Knowledge and networking', 'mohan.nidosan@gmail.com', '0765519233', 'Jaffna', 0, '2024-01-21 13:17:08', '2024-01-21 13:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `club_list`
--

CREATE TABLE `club_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `logo_path` text DEFAULT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club_list`
--

INSERT INTO `club_list` (`id`, `name`, `description`, `status`, `logo_path`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Drama Club', 'We are the Drama club of NSBM Green University Town: According to us – “Behind every mask there is a face, behind that face there is a story” As the Drama club of NSBM, we are engaged to do our main annual events to entertain the university students and staff. We normally present our talents to the university as per the requirements in specific events like Orientation, Open week, and other particular events conducted by the students.', 1, 'uploads/club-logos/1.png?v=1649308690', 0, '2022-04-07 10:16:48', '2024-01-21 13:04:46'),
(2, 'Chess Club', 'The NSBM Green University Chess club embarked on their illustrious journey in 2017, led by the visionary presidency of Yomal Hewasinghe and the captaincy of Niroshan Chathuranga. Their dedication and passion for the game set the foundation for remarkable achievements and a legacy that continues to thrive.', 1, 'uploads/club-logos/2.png?v=1649308837', 0, '2022-04-07 10:17:58', '2024-01-21 13:03:47'),
(3, 'test', 'test', 2, NULL, 1, '2022-04-07 10:27:02', '2022-04-07 10:27:07'),
(4, 'AIESEC', 'AIESEC is the world’s largest youth led organization advocating for youth leadership through global affairs. As one of our organization’s functions, we facilitate global Internship opportunities in local organizations which are focusing on UN Sustainable Development Goals.In 2017 AIESEC was initiated in the National School of Business Management as “AIESEC in NSBM”. AIESEC in NSBM was able to host two global villages in the university premises in 2018 and 2019 with over 200 international students from over 25 different countries. Today, AIESEC in NSBM has over 90+ active global-minded and culturally sensitive members from across the island. As an Ofﬁcial Expansion, we have won the Most Outstanding Award and Most Progressive Expansion Award in 2018 & 2019, respectively.', 1, 'uploads/club-logos/4.png?v=1705822587', 0, '2022-04-07 13:38:03', '2024-01-21 13:06:27'),
(5, 'BUDDHIST SOCIETY', 'In the serene ambiance of our society, we seek to create a sanctuary for self-reflection and inner peace, where students can find solace amidst the challenges of academic life. Our gatherings provide a safe space to explore the profound teachings of the Buddha and apply them to our daily experiences. As we delve into the wisdom of mindfulness and compassion, we strive to cultivate not only personal growth but also a sense of interconnectedness with all living beings. Let us join hands as a community, supporting and uplifting each other, as we navigate the journey towards a more compassionate and enlightened existence. Welcome to the Buddhist Society at NSBM, where the path of self-discovery and spiritual awakening awaits us all.', 1, 'uploads/club-logos/5.png?v=1705822692', 0, '2022-04-07 14:33:27', '2024-01-21 13:08:12'),
(6, ' DANCING CLUB', 'NSBM dancing club is a lively and energetic group that shares a passion for dance. The club is open to all students, regardless of their dance experience or skill level. The club’s main goal is to create a fun and supportive environment where students can come together to learn, practice, and enjoy different styles of dance.', 1, 'uploads/club-logos/6.png?v=1705822795', 0, '2022-04-07 14:39:09', '2024-01-21 13:09:55'),
(7, 'ATHLETICS CLUB', 'The Athletics Club at NSBM Green University is a prominent sports club within the Sri Lankan university community. Throughout its history, the NSBM Athletic Club has served as a training ground for many skilled and accomplished athletes, many of whom have achieved national recognition and earned gold medals. The club supports both elite and emerging athletes in the NSBM community to achieve sporting and academic excellence.', 1, 'uploads/club-logos/7.png?v=1705822366', 0, '2022-04-07 14:39:18', '2024-01-21 13:02:46'),
(8, 'VOLUNTEERS CLUB', 'Student Volunteer Club at NSBM Green University plays a vital role at all times. As student volunteers, club members are engaging with a multitude of events that are organized by the university. At most events, volunteers are responsible for crowd and event handling at the university. Therefore, students in volunteer club are capable of multitasking at these events. Currently, many talented students that represent different kinds of clubs at the university are helping us to succeed the tasks assigned to us.\r\n\r\n', 1, 'uploads/club-logos/8.png?v=1705822886', 0, '2024-01-21 13:11:18', '2024-01-21 13:11:26'),
(9, 'NETBALL CLUB', 'NSBM Netball club was formed in 2016 and has reached greater heights over the past years. It is also known for being one of the active sports club at NSBM. Being a women centric sport, netball offers students opportunities to to excel in their life and develop major skills such as teamwork, self- esteem, perseverance, discipline, time management etc. This club is open to undergraduates of all levels and creates paths to compete at university and isalnd level. The Netball club offers its members ample opportunities to utlize gym area, swimming pool and all other necessary sports equipment. While the club celebrates the ongoing achievement and success of its performance it remains committed to fostering a welcoming environment for all NSBM students', 1, 'uploads/club-logos/9.png?v=1705822961', 0, '2024-01-21 13:12:41', '2024-01-21 13:12:41'),
(10, 'MEDIA & PHOTOGRAPHY CLUB', 'NSBM Media is the place where art meets technology, where imagination fuses with innovation, and where the power of visuals and sounds takes center stage. \r\nNSBM media consists of several different teams which are photography , videography , announcing and editing.', 1, 'uploads/club-logos/10.png?v=1705823050', 0, '2024-01-21 13:14:01', '2024-01-21 13:14:10'),
(11, ' CATHOLIC & CHRISTIAN SOCIETY', '“See what great love the Father has lavished on us, that we should be called children of God! And that is what we are! The reason the world does not know us is that it did not know him” 1 John 3:1\r\nWith the sole intention of the club is to serve the catholic and the Christian community at NSBM. Events were organized to enhance the unity, love among the students and to cultivate faith towards god through spirituallity.', 1, 'uploads/club-logos/11.png?v=1705823480', 0, '2024-01-21 13:21:19', '2024-01-21 13:21:20'),
(12, 'BADMINTON CLUB', 'The NSBM Badminton Club is one of the well-established and active sports club at NSBM with over 150 regular members inclusive from absolute beginners to representative level. This club is open to undergraduates of all levels for the purpose of recreation, physical fitness, and development of skills in the sport. This is also a progressive club providing strong participation opportunities in local, inter university, national and international level competitions. As one of the fastest sports in the world, badminton is a great way for students to develop and improve their reflexes, hand-eye coordination, as well as mental alertness. Aside from the athletic aspect of the club, a wide range of social occasions arranged throughout the year give players an opportunity to get to know each other both on and off the court.', 1, 'uploads/club-logos/12.png?v=1705904375', 0, '2024-01-22 11:49:35', '2024-01-22 11:49:35'),
(13, 'CRICKET CLUB', 'The NSBM University Cricket Team is a talented and enthusiastic group of students representing the NSBM Green University Town, an esteemed educational institution located in Sri Lanka. Known for its dedication to academic excellence and extracurricular activities, NSBM University boasts a thriving cricket team that actively participates in inter-university tournaments and competitions. NSBM Cricket Club is one of the active sports clubs at NSBM with over 50 regular members and alumni members.', 1, 'uploads/club-logos/13.png?v=1705904453', 0, '2024-01-22 11:50:53', '2024-01-22 11:50:53'),
(14, 'RUGBY CLUB', 'That is the code NSBM Rugby club follows and it has earned many achievements because of that. Thus, the rugby club is one of the most highlighted clubs in the university since its non-stop victories under the NSBM name.\r\nThe club emerged as winners in many platforms in the tournaments held last year including Mora 7s, ICBT 7s, KDU 10s, and one international tournament, the UiTM international sports tournament organized by the University of Technology MARA, Shah Alam, Malaysia. Under the captaincy of Kasun Wimalasuriya and his deputy Selaka Molligoda. This year the club won its first championship at the Mora 7s which was held on the 19th of February at Havelock park.\r\nThe second win this year was a huge one, the last year’s bowl champions at UiTM international sports tournament have bounced back to become the runners-up at the cup stage defeating many offshore universities in Asia. “Success isn’t always about greatness. It’s about consistency. Consistent hard work leads to success. Greatness will come” as a wise man once said, players, work hard for these achievements. It’s not just a game, it’s a way of life. Rugby is a 100% physical game, so you must have both mental and physical endurance.\r\nIf you’re tough and you want it to be contested, this is the place for you because only the toughest will make it to the end. Practice dates are Monday, Wednesday and Friday from 3pm – 5pm. Once you step onto the field you may not back down because everyone has their role to play in the team. It requires a lot of determination and passion and luckily the mighty Greens of NSBM have what it takes to shine bright at the end of the day.', 1, 'uploads/club-logos/14.png?v=1705904559', 0, '2024-01-22 11:52:34', '2024-01-22 11:52:39'),
(15, ' WELLBEING CLUB (STUDENTS\' WELLBEING ASSOCIATION)', 'The Students’ Wellbeing Association of NSBM is the first and the only students’ club initiated in Sri Lankan University that expects to develop the wellbeing of individuals for the betterment of the younger generation. The club was initiated at the beginning of the year 2018 with the intention of advocating the mental, physical, social, and spiritual wellbeing among the undergraduates of the university, as well as to pave a path towards the betterment of the entire Sri Lankan nation in terms of ultimate features of wellbeing.', 1, 'uploads/club-logos/15.png?v=1705904636', 0, '2024-01-22 11:53:54', '2024-01-22 11:53:56'),
(16, 'MUSIC CLUB', 'The Music Club of NSBM is the most dynamic and active club in the university that embraces musicians of all genres and talents. The enthusiasm and talent that we have among our members is what makes this club special. Our aim is to nurture the talent within the club and create a platform for future artists to reach the international standard in performance.', 1, 'uploads/club-logos/16.png?v=1705904767', 0, '2024-01-22 11:56:06', '2024-01-22 11:56:07'),
(17, 'LITERATURE CLUB', 'The NSBM Literature Club is a vibrant and inclusive community dedicated to the appreciation and exploration of literature.\r\nThe club provides a platform for avid readers, writers, and literary enthusiasts to come together and engage in thoughtful discussions about literature. Members have the opportunity to share their insights, perspectives, and interpretations of different literary works. The club encourages open-mindedness and welcomes diverse viewpoints, fostering a rich and intellectually stimulating environment for all participants.', 1, NULL, 0, '2024-01-22 11:56:42', '2024-01-22 11:56:42'),
(18, 'ROTARACT CLUB', 'The Rotaract Club of National NSBM is a youth-led service organization that operates under the auspices of Rotary International. The club is based in the National School of Business Management (NSBM) in Sri Lanka and aims to promote leadership, professional development, and community service among its members. The club is composed of young adults who are passionate about making a positive impact in their communities. They organize a range of activities and events throughout the year, including blood donation campaigns, environmental conservation projects, and educational workshops for disadvantaged youth. One of the main goals of the Rotaract Club of National NSBM is to provide its members with opportunities to develop their leadership skills. To achieve this, the club organizes regular training sessions, seminars, and workshops on various topics such as public speaking, project management, and teamwork. In addition to its community service and leadership development initiatives, the club also focuses on building international connections and fostering cultural understanding. The Rotaract Club of National NSBM participates in a range of international projects and exchange programs with other Rotaract clubs around the world. Overall, the Rotaract Club of National NSBM is a dynamic and active organization that provides its members with valuable opportunities for personal and professional growth, while also making a positive impact in the local and global community.', 1, NULL, 0, '2024-01-22 11:57:23', '2024-01-22 11:57:23'),
(19, 'ENTREPRENEURSHIP CIRCLE', 'The NSBM Entrepreneurship Circle is a club that helps individuals who wish to grow or start up their businesses. We provide the students with the necessary skills, training, help, and support needed for them to succeed as entrepreneurs.\r\n', 1, 'uploads/club-logos/19.png?v=1705904896', 0, '2024-01-22 11:58:15', '2024-01-22 11:58:16'),
(20, 'STUDENT CIRCLE OF ACCOUNTING AND FINANCE', 'The Student Circle of Accounting and Finance (SCAF) is the very first subject circle of the Faculty of Business which is attached to the esteemed Department of Accounting and Finance.\r\n\r\nSCAF prides itself on being more than just a student body. It is a close-knit and supportive community where students help one another grow academically, professionally, and personally. The culture of collaboration and knowledge-sharing is at the heart of SCAF’s success.', 1, NULL, 0, '2024-01-22 11:59:06', '2024-01-22 11:59:06'),
(21, 'PUBLIC RELATIONS TEAM', 'The Public Relations team consists of a team of dedicated and driven department undergraduates. The formation of the team was the first-ever initiative of its kind in the history of the Department of Management. Since its formation in October 2021, the PR team continues to carry out a plethora of projects for the department, always dedicated to promoting goodwill for the department in the eyes of the public.\r\n\r\n', 1, 'uploads/club-logos/21.png?v=1705905009', 0, '2024-01-22 12:00:00', '2024-01-22 12:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(20) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `club_id` int(11) DEFAULT NULL,
  `registrations_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `attendees` int(11) NOT NULL,
  `event_date` date DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `club_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'NSBM Club Management System'),
(6, 'short_name', 'NCMS'),
(11, 'logo', 'uploads/system-logo.png?v=1700644792'),
(14, 'cover', 'uploads/system-cover.png?v=1700644925');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `student_id` int(50) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `year_level` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Admin, 2= Club''s Admin, 3 = Student',
  `club_id` int(30) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `student_id`, `gender`, `year_level`, `grade`, `password`, `avatar`, `type`, `club_id`, `last_login`, `date_added`, `date_updated`) VALUES
(22, 'Nidosan', 'Admin', 'Mohanaraj', 'shan', 28177, NULL, NULL, NULL, '$2y$10$UQaKIk0uImS0i9oDLmT.VeuEP3PmkMdOWdyro8.6tZFcnjFXmDwuO', 'uploads/users/avatar-22.png?v=1700985221', 1, NULL, NULL, '2023-11-26 13:23:40', '2023-11-26 13:23:41'),
(29, 'Nidosan', '', 'Mohanaraj', 'mnidosan', 28177, 'Male', '22.2', 'Computer Networks', '$2y$10$sPcye5ILkeDX1TR.l3zuteG6MVg8omb2EeXZpZ85Q8.dJJxgMF99y', NULL, 3, NULL, NULL, '2024-01-21 13:15:26', '2024-01-21 13:15:26'),
(30, 'Nidosan', '', 'Mohanaraj', 'nido', 28177, 'Male', '22.2', 'Computer Networks', '$2y$10$v5xMLkNBDI3bzhet5xYATei0/b./uZuq0ksmEUWXspKido.1Ceb0m', NULL, 2, 4, NULL, '2024-01-21 13:15:55', '2024-01-21 13:15:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_list`
--
ALTER TABLE `application_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `club_list`
--
ALTER TABLE `club_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`),
  ADD KEY `registrations_id` (`registrations_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_list`
--
ALTER TABLE `application_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `club_list`
--
ALTER TABLE `club_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_list`
--
ALTER TABLE `application_list`
  ADD CONSTRAINT `application_club_id_fk` FOREIGN KEY (`club_id`) REFERENCES `club_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club_list` (`id`),
  ADD CONSTRAINT `event_registrations_ibfk_2` FOREIGN KEY (`registrations_id`) REFERENCES `registrations` (`id`);

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club_list` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_club_id_fk` FOREIGN KEY (`club_id`) REFERENCES `club_list` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
