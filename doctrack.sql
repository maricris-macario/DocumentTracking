-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2018 at 12:17 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

DROP TABLE IF EXISTS `office`;
CREATE TABLE IF NOT EXISTS `office` (
  `officeID` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `officeName` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `location` varchar(75) NOT NULL,
  PRIMARY KEY (`officeID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`officeID`, `officeName`, `description`, `location`) VALUES
(001, 'a', 'a', 'op'),
(002, 'OMA2', 'OMA2 office', 'Headquarters'),
(003, 'OMA3', 'OMA3 office', 'Headquarters'),
(004, 'OMA4', 'OMA4 office', 'Headquarters'),
(005, 'OMA5', 'OMA5 office', 'Headquarters'),
(006, 'OMA6', 'OMA6 office', 'ppp'),
(007, 'OMA7', 'OMA7 office', 'Headquarters'),
(008, 'MFO', 'MFO', 'op'),
(009, 'OAA', 'OAA', 'PMA'),
(041, 'office', 'office', 'office'),
(042, 'new', 'new', 'new'),
(043, 'hi', 'hi', 'hi'),
(044, 'newwww', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `office_user`
--

DROP TABLE IF EXISTS `office_user`;
CREATE TABLE IF NOT EXISTS `office_user` (
  `userID` int(4) UNSIGNED ZEROFILL NOT NULL,
  `officeID` int(3) UNSIGNED ZEROFILL NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `userID` (`userID`),
  KEY `officeID` (`officeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office_user`
--

INSERT INTO `office_user` (`userID`, `officeID`) VALUES
(0005, 002),
(0002, 004);

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
CREATE TABLE IF NOT EXISTS `priority` (
  `priorityID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `priorityLvl` enum('rush','regular') NOT NULL,
  PRIMARY KEY (`priorityID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`priorityID`, `priorityLvl`) VALUES
(1, 'rush'),
(2, 'regular');

-- --------------------------------------------------------

--
-- Table structure for table `routing`
--

DROP TABLE IF EXISTS `routing`;
CREATE TABLE IF NOT EXISTS `routing` (
  `routingID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `slipID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `officeID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `dateIn` date NOT NULL,
  `dateOut` date NOT NULL,
  `status` enum('Not Yet Recorded','In','Out','Returned','Approval','Canceled') NOT NULL,
  `priorityNum` enum('1 - SUPT','2 - ASUPT','3 - CAS','4 - Other office') NOT NULL,
  PRIMARY KEY (`routingID`),
  KEY `slipID` (`slipID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routing`
--

INSERT INTO `routing` (`routingID`, `slipID`, `officeID`, `dateIn`, `dateOut`, `status`, `priorityNum`) VALUES
(0000000001, 0000000001, 006, '2018-06-18', '2018-06-18', 'In', '2 - ASUPT'),
(0000000002, 0000000002, 003, '2018-06-18', '2018-06-19', 'Out', '2 - ASUPT');

-- --------------------------------------------------------

--
-- Table structure for table `slip`
--

DROP TABLE IF EXISTS `slip`;
CREATE TABLE IF NOT EXISTS `slip` (
  `slipID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `priorityID` int(10) UNSIGNED NOT NULL,
  `documentNum` int(10) UNSIGNED NOT NULL,
  `typeID` int(10) UNSIGNED NOT NULL,
  `subject` varchar(50) NOT NULL,
  `details` varchar(250) NOT NULL,
  `officeID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`slipID`),
  KEY `typeID` (`typeID`),
  KEY `priorityID` (`priorityID`),
  KEY `officeID` (`officeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slip`
--

INSERT INTO `slip` (`slipID`, `priorityID`, `documentNum`, `typeID`, `subject`, `details`, `officeID`, `date`) VALUES
(0000000001, 2, 1234, 4, 'basta', 'yeah', 003, '2018-06-18'),
(0000000002, 1, 6789, 2, 'ya', 'as', 008, '2018-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `typeID` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `docType` varchar(50) NOT NULL,
  PRIMARY KEY (`typeID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`typeID`, `docType`) VALUES
(01, 'Disposition Form'),
(02, 'Letter Order'),
(03, 'Letter Directives'),
(04, 'Special Order'),
(05, 'General Order'),
(11, 'a'),
(12, 'o'),
(13, 'm');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(250) NOT NULL,
  `userLevel` varchar(1) NOT NULL,
  `status` varchar(10) NOT NULL,
  `completeName` varchar(75) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `pwd`, `userLevel`, `status`, `completeName`) VALUES
(0001, 'lolol', 'system', '', '', 'lplp'),
(0002, 'walt', 'doctrack', '', '', 'Michael L. Walton'),
(0003, 'popo', 'doctrack', '1', 'active', 'Scott P. Saunders'),
(0004, 'popo', 'doctrack', '1', 'active', 'Frank E. Francis'),
(0005, 'popo', 'doctrack', '2', 'active', 'Gray Fullbuster'),
(0017, 'popo', 'r', '2', 'active', 'r'),
(0018, 'popo', 's', '1', 'active', 's'),
(0019, 'popo', 'q', '1', 'active', 'q');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `office_user`
--
ALTER TABLE `office_user`
  ADD CONSTRAINT `ou_officeID` FOREIGN KEY (`officeID`) REFERENCES `office` (`officeID`),
  ADD CONSTRAINT `ou_userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `routing`
--
ALTER TABLE `routing`
  ADD CONSTRAINT `ro_slipID` FOREIGN KEY (`slipID`) REFERENCES `slip` (`slipID`);

--
-- Constraints for table `slip`
--
ALTER TABLE `slip`
  ADD CONSTRAINT `sl_officeID` FOREIGN KEY (`officeID`) REFERENCES `office` (`officeID`),
  ADD CONSTRAINT `sl_priorityID` FOREIGN KEY (`priorityID`) REFERENCES `priority` (`priorityID`),
  ADD CONSTRAINT `sl_typeID` FOREIGN KEY (`typeID`) REFERENCES `type` (`typeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
