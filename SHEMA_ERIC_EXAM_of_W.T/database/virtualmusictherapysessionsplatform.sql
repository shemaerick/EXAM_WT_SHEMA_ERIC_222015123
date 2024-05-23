-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 03:59 PM
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
-- Database: `virtualmusictherapysessionsplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ClientID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Gender` enum('Male','Female','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ClientID`, `UserID`, `Age`, `Gender`) VALUES
(1, 3, 35, 'Female'),
(2, 4, 42, 'Male'),
(3, 2, 28, 'Other'),
(4, 1, 19, 'Female'),
(5, 2, 56, 'Male'),
(6, 3, 30, 'Female'),
(7, 4, 45, 'Male'),
(8, 2, 33, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `SessionID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Comment` varchar(400) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `SessionID`, `UserID`, `Comment`, `Date`) VALUES
(1, 6, 2, 'The session was very helpful in managing my anxiety.', '2024-05-01 11:30:00'),
(2, 2, 3, 'Great insights into family dynamics. Thank you!', '2024-05-02 17:00:00'),
(3, 3, 1, 'Art therapy helped me express emotions I couldnt put into words.', '2024-05-03 13:00:00'),
(4, 4, 1, 'It was tough revisiting past traumas, but I feel hopeful.', '2024-05-04 15:30:00'),
(5, 5, 2, 'Talking about addiction triggers was eye-opening.', '2024-05-05 11:00:00'),
(6, 3, 3, 'We are making progress in communication. Feeling optimistic.', '2024-05-06 14:00:00'),
(7, 1, 4, 'Insightful assessment of my child. Looking forward to the next session.', '2024-05-07 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `LikeID` int(11) NOT NULL,
  `CommentID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`LikeID`, `CommentID`, `UserID`) VALUES
(1, 6, 4),
(2, 2, 2),
(3, 1, 1),
(4, 4, 2),
(5, 3, 3),
(6, 6, 1),
(7, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `PlaylistID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PlaylistName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`PlaylistID`, `UserID`, `PlaylistName`) VALUES
(1, 1, 'Relaxation Mix'),
(2, 2, 'Motivational Tunes'),
(3, 4, 'Expressive Melodies'),
(4, 3, 'Healing Harmonies'),
(5, 1, 'Recovery Rhythms'),
(6, 2, 'Couples Connection'),
(7, 4, 'Childhood Favorites');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `SessionID` int(11) NOT NULL,
  `TherapistID` int(11) DEFAULT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `DurationMinutes` int(11) DEFAULT NULL,
  `Notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`SessionID`, `TherapistID`, `ClientID`, `Date`, `DurationMinutes`, `Notes`) VALUES
(1, 6, 2, '2024-05-01 10:00:00', 60, 'Focused on anxiety management techniques.'),
(2, 1, 4, '2024-05-02 15:30:00', 90, 'Explored family dynamics and communication patterns.'),
(3, 3, 6, '2024-05-03 11:15:00', 75, 'Engaged in art activities to express emotions.'),
(4, 2, 2, '2024-05-04 14:00:00', 60, 'Addressed past traumas and coping strategies.'),
(5, 5, 3, '2024-05-05 09:30:00', 120, 'Discussed addiction triggers and relapse prevention.'),
(6, 3, 5, '2024-05-06 12:45:00', 60, 'Worked on improving communication and resolving conflicts.'),
(7, 7, 1, '2024-05-07 13:00:00', 90, 'Assessed childs behavioral patterns and emotional well-being.');

-- --------------------------------------------------------

--
-- Table structure for table `session_playlist`
--

CREATE TABLE `session_playlist` (
  `SessionID` int(11) DEFAULT NULL,
  `PlaylistID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_playlist`
--

INSERT INTO `session_playlist` (`SessionID`, `PlaylistID`) VALUES
(1, 3),
(1, 4),
(2, 1),
(2, 5),
(3, 6),
(5, 7),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `session_songs`
--

CREATE TABLE `session_songs` (
  `SessionID` int(11) NOT NULL,
  `SongID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_songs`
--

INSERT INTO `session_songs` (`SessionID`, `SongID`) VALUES
(1, 4),
(2, 2),
(3, 7),
(4, 1),
(5, 5),
(6, 3),
(7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `SongID` int(11) NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Artist` varchar(100) DEFAULT NULL,
  `DurationSeconds` int(11) DEFAULT NULL,
  `Genre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`SongID`, `Title`, `Artist`, `DurationSeconds`, `Genre`) VALUES
(1, 'Calming Waves', 'Nature Sounds', 300, 'Ambient'),
(2, 'Rise Up', 'Andra Day', 240, 'Soul'),
(3, 'Colors of the Wind', 'Vanessa Williams', 210, 'Disney'),
(4, 'Healing Piano', 'Instrumental Music', 180, 'Classical'),
(5, 'I Will Survive', 'Gloria Gaynor', 270, 'Disco'),
(6, 'Love and Marriage', 'Frank Sinatra', 220, 'Jazz'),
(7, 'You Are My Sunshine', 'Johnny Cash', 190, 'Country');

-- --------------------------------------------------------

--
-- Table structure for table `therapists`
--

CREATE TABLE `therapists` (
  `TherapistID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `therapists`
--

INSERT INTO `therapists` (`TherapistID`, `UserID`, `Specialization`, `Description`) VALUES
(1, 4, 'Cognitive Behavioral Therapy', 'Specializes in treating anxiety and depression.'),
(2, 2, 'Family Therapy', 'Expert in resolving family conflicts and improving communication.'),
(3, 3, 'Art Therapy', 'Utilizes art as a means of expression and healing.'),
(4, 1, 'Trauma Therapy', 'Works with clients dealing with past traumas.'),
(5, 2, 'Substance Abuse Counseling', 'Helps individuals overcome addiction challenges.'),
(6, 3, 'Marriage Counseling', 'Supports couples in strengthening their relationships.'),
(7, 2, 'Child Therapy', 'Focuses on addressing behavioral and emotional issues in children.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'SHEMA ', 'ERIC', 'SHEMA09', 'E@GMAIL.COM', '+250782437086', '$2y$10$7GXSBEJEwGN3gHoUfwIQ5OzEVIWzwZcZuk7aANkban9phNsHDI.lq', '2024-05-11 07:02:01', '8', 0),
(2, 'elyse', 'ntawiheba', 'elyse22', 'ntawelyse@gmail.com', '08788833334', '$2y$10$VxOpuXfzmslOjun1tsI0fu2JRt1WBy.ZFLYc3BxzelOb6QucA42jS', '2024-05-11 15:45:09', '7766', 0),
(3, 'ishimwe', 'himbaza', 'shimwehimbazwa', 'himbashimwe@gmail.com', '073221167666', '$2y$10$Jg3vDzK1PKpPcfNiOYIviuRmAWd5/4bc.3mx7EN6xz4EwWIL6FqVW', '2024-05-11 15:46:01', '5432', 0),
(4, 'dushime', 'felix', 'felixd33', 'felixdush@gmail.com', '07256444478', '$2y$10$mTrvRQH1zySRe1UACWbQU.rzz3TcvhjL/tsn5gHxmrICIIdWTaTxG', '2024-05-11 15:47:02', '221111', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ClientID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `SessionID` (`SessionID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`LikeID`),
  ADD KEY `CommentID` (`CommentID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`PlaylistID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`SessionID`),
  ADD KEY `TherapistID` (`TherapistID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `session_playlist`
--
ALTER TABLE `session_playlist`
  ADD PRIMARY KEY (`PlaylistID`),
  ADD KEY `SessionID` (`SessionID`);

--
-- Indexes for table `session_songs`
--
ALTER TABLE `session_songs`
  ADD PRIMARY KEY (`SessionID`,`SongID`),
  ADD KEY `SongID` (`SongID`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`SongID`);

--
-- Indexes for table `therapists`
--
ALTER TABLE `therapists`
  ADD PRIMARY KEY (`TherapistID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ClientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `PlaylistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `SongID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `therapists`
--
ALTER TABLE `therapists`
  MODIFY `TherapistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`SessionID`) REFERENCES `sessions` (`SessionID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`CommentID`) REFERENCES `comments` (`CommentID`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`TherapistID`) REFERENCES `therapists` (`TherapistID`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `session_playlist`
--
ALTER TABLE `session_playlist`
  ADD CONSTRAINT `session_playlist_ibfk_1` FOREIGN KEY (`SessionID`) REFERENCES `sessions` (`SessionID`),
  ADD CONSTRAINT `session_playlist_ibfk_2` FOREIGN KEY (`PlaylistID`) REFERENCES `playlist` (`PlaylistID`);

--
-- Constraints for table `session_songs`
--
ALTER TABLE `session_songs`
  ADD CONSTRAINT `session_songs_ibfk_1` FOREIGN KEY (`SessionID`) REFERENCES `sessions` (`SessionID`),
  ADD CONSTRAINT `session_songs_ibfk_2` FOREIGN KEY (`SongID`) REFERENCES `songs` (`SongID`);

--
-- Constraints for table `therapists`
--
ALTER TABLE `therapists`
  ADD CONSTRAINT `therapists_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
