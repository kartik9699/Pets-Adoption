-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 08:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pets_adoption`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted`
--

CREATE TABLE `accepted` (
  `accept_ID` int(100) NOT NULL,
  `Requests_ID` int(100) NOT NULL,
  `Animal_ID` int(100) NOT NULL,
  `Stat` varchar(100) NOT NULL,
  `User_ID` int(100) NOT NULL,
  `Shelter_ID` int(20) NOT NULL,
  `Accept_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accepted`
--

INSERT INTO `accepted` (`accept_ID`, `Requests_ID`, `Animal_ID`, `Stat`, `User_ID`, `Shelter_ID`, `Accept_Date`) VALUES
(69, 209, 130, 'Seen', 45, 14, '2023-12-11 07:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `Animal_ID` int(20) NOT NULL,
  `Animal_Name` varchar(50) NOT NULL,
  `Animal_Age` varchar(50) NOT NULL,
  `Animal_Breed` varchar(50) NOT NULL,
  `Animal_Color` varchar(50) NOT NULL,
  `Animal_Type` varchar(50) NOT NULL,
  `Animal_Gender` varchar(50) NOT NULL,
  `Animal_Description` varchar(200) NOT NULL,
  `Shelter_ID` int(20) NOT NULL,
  `Animal_Img` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`Animal_ID`, `Animal_Name`, `Animal_Age`, `Animal_Breed`, `Animal_Color`, `Animal_Type`, `Animal_Gender`, `Animal_Description`, `Shelter_ID`, `Animal_Img`, `Status`) VALUES
(130, 'lio', '2 years', 'blacky', 'black', 'dog', 'Female', 'healhy', 14, 'images (1).jpg', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `Requests_ID` int(20) NOT NULL,
  `Shelter_ID` int(20) NOT NULL,
  `Animal_ID` int(20) NOT NULL,
  `User_ID` int(20) NOT NULL,
  `Stat` varchar(100) NOT NULL,
  `Requests_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`Requests_ID`, `Shelter_ID`, `Animal_ID`, `User_ID`, `Stat`, `Requests_Date`) VALUES
(209, 14, 130, 45, '', '2023-12-11 07:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `shelter`
--

CREATE TABLE `shelter` (
  `Shelter_ID` int(20) NOT NULL,
  `Shelter_Name` varchar(50) NOT NULL,
  `Shelter_Adress` varchar(200) NOT NULL,
  `Shelter_Email` varchar(50) NOT NULL,
  `Shelter_Password` varchar(50) NOT NULL,
  `Shelter_Contact` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`Shelter_ID`, `Shelter_Name`, `Shelter_Adress`, `Shelter_Email`, `Shelter_Password`, `Shelter_Contact`) VALUES
(14, 'rony', 'sawantwadi', 'rony@gmail.com', '121212', 8805401528);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(20) NOT NULL,
  `User_name` varchar(50) NOT NULL,
  `User_Address` varchar(200) NOT NULL,
  `User_Email` varchar(75) NOT NULL,
  `User_Mobile_No` bigint(15) NOT NULL,
  `User_Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `User_name`, `User_Address`, `User_Email`, `User_Mobile_No`, `User_Password`) VALUES
(45, 'kartik', 'sawantwadi', 'kartik@gmail.com', 8805401523, '121212');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted`
--
ALTER TABLE `accepted`
  ADD PRIMARY KEY (`accept_ID`),
  ADD KEY `animalidr_fk` (`Animal_ID`),
  ADD KEY `request_fk` (`Requests_ID`),
  ADD KEY `useri_fk` (`User_ID`),
  ADD KEY `shelteridi_fk` (`Shelter_ID`);

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`Animal_ID`),
  ADD UNIQUE KEY `Animal_Img` (`Animal_Img`),
  ADD KEY `shelter_fk` (`Shelter_ID`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`Requests_ID`),
  ADD KEY `animalid_fk` (`Animal_ID`),
  ADD KEY `shelterid_fk` (`Shelter_ID`),
  ADD KEY `userid_fk` (`User_ID`);

--
-- Indexes for table `shelter`
--
ALTER TABLE `shelter`
  ADD PRIMARY KEY (`Shelter_ID`),
  ADD UNIQUE KEY `Shelter_Email` (`Shelter_Email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `User_Email` (`User_Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepted`
--
ALTER TABLE `accepted`
  MODIFY `accept_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `Animal_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `Requests_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `shelter`
--
ALTER TABLE `shelter`
  MODIFY `Shelter_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accepted`
--
ALTER TABLE `accepted`
  ADD CONSTRAINT `animalidr_fk` FOREIGN KEY (`Animal_ID`) REFERENCES `animal` (`Animal_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_fk` FOREIGN KEY (`Requests_ID`) REFERENCES `requests` (`Requests_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shelteridi_fk` FOREIGN KEY (`Shelter_ID`) REFERENCES `shelter` (`Shelter_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `useri_fk` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `shelter_fk` FOREIGN KEY (`Shelter_ID`) REFERENCES `shelter` (`Shelter_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `animalid_fk` FOREIGN KEY (`Animal_ID`) REFERENCES `animal` (`Animal_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shelterid_fk` FOREIGN KEY (`Shelter_ID`) REFERENCES `shelter` (`Shelter_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid_fk` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
