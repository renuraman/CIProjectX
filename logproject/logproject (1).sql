-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2017 at 06:57 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;


--
-- Database: `logproject`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `spLogData` (IN `project` INT, IN `devname` INT, IN `date` VARCHAR(100))  BEGIN
    if project = '' then set project = null;
  end if;
  if devname = '' then set devname = null;
  end if;
    if date = '' then set date = null;
  end if;
  
  select l.entry_date, u.username, p.proname,l.task_desc,l.time_used
  from logtbl l
  join project p ON p.pro_id = l.pro_id
  join users u ON u.user_id = l.user_id
  where (l.pro_id = project or project is null) and
   (l.user_id = devname or devname is null) and 
   (l.entry_date = date or date is null)
   order by l.entry_date desc, u.username, p.proname; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchbyProjectName` (IN `id` INT)  BEGIN
	select sum(l.time_used) as tot_time, u.username
  from logtbl l
  join users u 
  on l.user_id=u.user_id
  where l.pro_id=id
  group by l.user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchbyUserName` (IN `id` INT)  BEGIN
select p.proname, sum(l.time_used) as time_used, l.entry_date
from project p 
join logtbl l
on p.pro_id=l.pro_id
where l.user_id=id
group by l.entry_date;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spSelectFromDate` (IN `fromdt` VARCHAR(20), IN `todt` VARCHAR(20))  BEGIN
	select u.username, p.proname, l.task_desc, l.task_desc
  from logtbl l 
  join project p ON p.pro_id = l.pro_id
  join users u ON u.user_id = l.user_id
  where l.entry_date between fromdt and todt;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserEmailExists` (IN `emailname` VARCHAR(100))  BEGIN
	DECLARE cnt INT DEFAULT 0;
    select count(user_id) into cnt from users where email = emailname;
    IF cnt>0
    THEN
    select 1 as useremailexists;
    ELSE
    select 0 as useremailexists;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserNameExists` (IN `name` VARCHAR(500))  BEGIN
    DECLARE cnt INT DEFAULT 0;
    select count(user_id) into cnt from users where username = name;
    IF cnt>0
    THEN
    select 1 as usernameexists;
    ELSE
    select 0 as usernameexists;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `logtbl`
--

CREATE TABLE `logtbl` (
  `log_id` int(11) NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `task_desc` varchar(500) DEFAULT NULL,
  `entry_date` varchar(10) NOT NULL,
  `time_used` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logtbl`
--

INSERT INTO `logtbl` (`log_id`, `pro_id`, `task_desc`, `entry_date`, `time_used`, `user_id`) VALUES
(60, 7, 'daily log  180 mins 21/07', '07/20/2017', '731 mins', 1),
(62, 9, 'corrections', '07/22/2017', '750 mins', 1),
(64, 12, 'asdfgghjeee', '07/25/2017', '178 mins', 6),
(65, 7, 'replacing the time used', '07/26/2017', '190 mins', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `pro_id` int(11) NOT NULL,
  `proname` varchar(100) NOT NULL,
  `clientname` varchar(300) NOT NULL,
  `start_date` varchar(10) DEFAULT NULL,
  `end_date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pro_id`, `proname`, `clientname`, `start_date`, `end_date`) VALUES
(7, 'Car', 'fabcoders', '07/13/2017', '07/25/2017'),
(8, 'DailyLog', 'Fabcoders', '07/03/2017', '07/24/2017'),
(9, 'bike', 'fabcoders', '07/21/2017', '07/25/2017'),
(10, 'reviews', 'fabcoders123', '07/25/2017', '07/26/2017'),
(11, 'deals', 'fabcoders', '07/31/2017', ''),
(12, 'club', 'ryan', '07/01/2017', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`, `email`, `status`) VALUES
(1, 'renuka', '202cb962ac59075b964b07152d234b70', 0, 'renuraman1j@gmail.com', 0),
(2, 'admin', '202cb962ac59075b964b07152d234b70', 1, 'renuraman1j@gmail.com', 0),
(3, 'Nanda', '202cb962ac59075b964b07152d234b70', 0, 'nan@gmail.com', 0),
(4, 'Aniket', '202cb962ac59075b964b07152d234b70', 0, 'ani@gmail.com', 0),
(5, 'user', '202cb962ac59075b964b07152d234b70', 0, 'user@gmail.com', 1),
(6, 'Nikita', 'd8578edf8458ce06fbc5bb76a58c5ca4', 0, 'webteam@fabcoders.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logtbl`
--
ALTER TABLE `logtbl`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logtbl`
--
ALTER TABLE `logtbl`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `logtbl`
--
ALTER TABLE `logtbl`
  ADD CONSTRAINT `logtbl_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `project` (`pro_id`),
  ADD CONSTRAINT `logtbl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
