-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2026 at 01:23 AM
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
-- Database: `primefieldcourse`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('prime-field-and-course-solutions-llc-cache-sportsdata:current-season', 'a:4:{s:8:\"SeasonID\";i:2026;s:11:\"Description\";s:4:\"2026\";s:9:\"StartDate\";s:19:\"2026-01-01T00:00:00\";s:7:\"EndDate\";s:19:\"2026-12-31T00:00:00\";}', 1785957275);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('prime-field-and-course-solutions-llc-cache-sportsdata:tournaments:2026', 'a:48:{i:0;a:23:{s:12:\"TournamentID\";i:738;s:4:\"Name\";s:20:\"Hero World Challenge\";s:9:\"StartDate\";s:19:\"2026-12-03T00:00:00\";s:7:\"EndDate\";s:19:\"2026-12-06T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:9:\"Albany GC\";s:8:\"Location\";s:11:\"Albany, Bah\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7309;s:5:\"Purse\";d:5000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:6:\"Albany\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"BAH\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:738;s:7:\"RoundID\";i:34704;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-12-03T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:738;s:7:\"RoundID\";i:34705;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-12-04T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:738;s:7:\"RoundID\";i:34706;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-12-05T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:738;s:7:\"RoundID\";i:34707;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-12-06T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:1;a:23:{s:12:\"TournamentID\";i:737;s:4:\"Name\";s:15:\"The RSM Classic\";s:9:\"StartDate\";s:19:\"2026-11-19T00:00:00\";s:7:\"EndDate\";s:19:\"2026-11-22T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:37:\"Sea Island Golf Club (Seaside Course)\";s:8:\"Location\";s:21:\"St. Simons Island, GA\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7005;s:5:\"Purse\";d:7400000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:17:\"St. Simons Island\";s:5:\"State\";s:2:\"GA\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:737;s:7:\"RoundID\";i:34700;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-11-19T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:737;s:7:\"RoundID\";i:34701;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-11-20T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:737;s:7:\"RoundID\";i:34702;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-11-21T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:737;s:7:\"RoundID\";i:34703;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-11-22T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:2;a:23:{s:12:\"TournamentID\";i:736;s:4:\"Name\";s:22:\"Good Good Championship\";s:9:\"StartDate\";s:19:\"2026-11-12T00:00:00\";s:7:\"EndDate\";s:19:\"2026-11-15T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:53:\"Omni Barton Creek Resort & Spa (Fazio Canyons Course)\";s:8:\"Location\";s:10:\"Austin, TX\";s:3:\"Par\";N;s:5:\"Yards\";N;s:5:\"Purse\";d:6000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:6:\"Austin\";s:5:\"State\";s:2:\"TX\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:736;s:7:\"RoundID\";i:34696;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-11-12T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:736;s:7:\"RoundID\";i:34697;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-11-13T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:736;s:7:\"RoundID\";i:34698;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-11-14T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:736;s:7:\"RoundID\";i:34699;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-11-15T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:3;a:23:{s:12:\"TournamentID\";i:735;s:4:\"Name\";s:34:\"World Wide Technology Championship\";s:9:\"StartDate\";s:19:\"2026-11-05T00:00:00\";s:7:\"EndDate\";s:19:\"2026-11-08T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:23:\"El Cardonal at Diamante\";s:8:\"Location\";s:14:\"Los Cabos, Mex\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7452;s:5:\"Purse\";d:6000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:9:\"Los Cabos\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"MEX\";s:8:\"TimeZone\";s:15:\"America/Phoenix\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:735;s:7:\"RoundID\";i:34692;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-11-05T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:735;s:7:\"RoundID\";i:34693;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-11-06T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:735;s:7:\"RoundID\";i:34694;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-11-07T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:735;s:7:\"RoundID\";i:34695;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-11-08T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:4;a:23:{s:12:\"TournamentID\";i:734;s:4:\"Name\";s:24:\"VidantaWorld Mexico Open\";s:9:\"StartDate\";s:19:\"2026-10-29T00:00:00\";s:7:\"EndDate\";s:19:\"2026-11-01T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:16:\"Vidanta Vallarta\";s:8:\"Location\";s:13:\"Vallarta, Mex\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7456;s:5:\"Purse\";d:6000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:8:\"Vallarta\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"MEX\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:734;s:7:\"RoundID\";i:34689;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-10-30T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:734;s:7:\"RoundID\";i:34690;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-10-31T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:734;s:7:\"RoundID\";i:34691;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-11-01T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:734;s:7:\"RoundID\";i:34688;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-10-29T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:5;a:23:{s:12:\"TournamentID\";i:733;s:4:\"Name\";s:32:\"Butterfield Bermuda Championship\";s:9:\"StartDate\";s:19:\"2026-10-22T00:00:00\";s:7:\"EndDate\";s:19:\"2026-10-25T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:22:\"Port Royal Golf Course\";s:8:\"Location\";s:16:\"Southampton, Ber\";s:3:\"Par\";i:71;s:5:\"Yards\";i:6828;s:5:\"Purse\";d:6000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:11:\"Southampton\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"BER\";s:8:\"TimeZone\";s:16:\"Atlantic/Bermuda\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:733;s:7:\"RoundID\";i:34687;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-10-25T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:733;s:7:\"RoundID\";i:34684;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-10-22T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:733;s:7:\"RoundID\";i:34685;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-10-23T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:733;s:7:\"RoundID\";i:34686;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-10-24T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:6;a:23:{s:12:\"TournamentID\";i:732;s:4:\"Name\";s:18:\"Baycurrent Classic\";s:9:\"StartDate\";s:19:\"2026-10-08T00:00:00\";s:7:\"EndDate\";s:19:\"2026-10-11T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:21:\"Yokohama Country Club\";s:8:\"Location\";s:13:\"Yokohama, Jpn\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7315;s:5:\"Purse\";d:8000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:8:\"Yokohama\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"JPN\";s:8:\"TimeZone\";s:10:\"Asia/Tokyo\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:732;s:7:\"RoundID\";i:34680;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-10-08T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:732;s:7:\"RoundID\";i:34681;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-10-09T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:732;s:7:\"RoundID\";i:34682;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-10-10T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:732;s:7:\"RoundID\";i:34683;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-10-11T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:7;a:23:{s:12:\"TournamentID\";i:731;s:4:\"Name\";s:25:\"Bank of Utah Championship\";s:9:\"StartDate\";s:19:\"2026-10-01T00:00:00\";s:7:\"EndDate\";s:19:\"2026-10-04T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:19:\"Black Desert Resort\";s:8:\"Location\";s:9:\"Ivins, UT\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7421;s:5:\"Purse\";d:6000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:5:\"Ivins\";s:5:\"State\";s:2:\"UT\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:14:\"America/Denver\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:731;s:7:\"RoundID\";i:34676;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-10-01T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:731;s:7:\"RoundID\";i:34677;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-10-02T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:731;s:7:\"RoundID\";i:34678;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-10-03T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:731;s:7:\"RoundID\";i:34679;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-10-04T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:8;a:23:{s:12:\"TournamentID\";i:686;s:4:\"Name\";s:14:\"Presidents Cup\";s:9:\"StartDate\";s:19:\"2026-09-24T00:00:00\";s:7:\"EndDate\";s:19:\"2026-09-27T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:18:\"Medinah CC (No. 3)\";s:8:\"Location\";s:11:\"Chicago, IL\";s:3:\"Par\";N;s:5:\"Yards\";N;s:5:\"Purse\";d:0;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:0;s:4:\"City\";s:7:\"Chicago\";s:5:\"State\";s:2:\"IL\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:9:\"TeamMatch\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:7:\"Limited\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:686;s:7:\"RoundID\";i:33300;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-09-24T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:686;s:7:\"RoundID\";i:33301;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-09-25T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:686;s:7:\"RoundID\";i:33302;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-09-26T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:686;s:7:\"RoundID\";i:33303;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-09-27T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:9;a:23:{s:12:\"TournamentID\";i:730;s:4:\"Name\";s:31:\"Biltmore Championship Asheville\";s:9:\"StartDate\";s:19:\"2026-09-17T00:00:00\";s:7:\"EndDate\";s:19:\"2026-09-20T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:25:\"The Cliffs at Walnut Cove\";s:8:\"Location\";s:13:\"Asheville, NC\";s:3:\"Par\";N;s:5:\"Yards\";N;s:5:\"Purse\";d:5000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:9:\"Asheville\";s:5:\"State\";s:2:\"NC\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:730;s:7:\"RoundID\";i:34672;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-09-17T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:730;s:7:\"RoundID\";i:34673;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-09-18T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:730;s:7:\"RoundID\";i:34674;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-09-19T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:730;s:7:\"RoundID\";i:34675;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-09-20T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:10;a:23:{s:12:\"TournamentID\";i:694;s:4:\"Name\";s:17:\"TOUR Championship\";s:9:\"StartDate\";s:19:\"2026-08-27T00:00:00\";s:7:\"EndDate\";s:19:\"2026-08-30T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:19:\"East Lake Golf Club\";s:8:\"Location\";s:11:\"Atlanta, GA\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7440;s:5:\"Purse\";d:40000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:7:\"Atlanta\";s:5:\"State\";s:2:\"GA\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:694;s:7:\"RoundID\";i:32960;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-08-27T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:694;s:7:\"RoundID\";i:32961;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-08-28T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:694;s:7:\"RoundID\";i:32962;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-08-29T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:694;s:7:\"RoundID\";i:32963;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-08-30T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:11;a:23:{s:12:\"TournamentID\";i:726;s:4:\"Name\";s:16:\"BMW Championship\";s:9:\"StartDate\";s:19:\"2026-08-20T00:00:00\";s:7:\"EndDate\";s:19:\"2026-08-23T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:22:\"Bellerive Country Club\";s:8:\"Location\";s:13:\"St. Louis, MO\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7448;s:5:\"Purse\";d:20000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:9:\"St. Louis\";s:5:\"State\";s:2:\"MO\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:726;s:7:\"RoundID\";i:32956;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-08-20T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:726;s:7:\"RoundID\";i:32957;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-08-21T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:726;s:7:\"RoundID\";i:32958;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-08-22T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:726;s:7:\"RoundID\";i:32959;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-08-23T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:12;a:23:{s:12:\"TournamentID\";i:725;s:4:\"Name\";s:27:\"FedEx St. Jude Championship\";s:9:\"StartDate\";s:19:\"2026-08-13T00:00:00\";s:7:\"EndDate\";s:19:\"2026-08-16T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:13:\"TPC Southwind\";s:8:\"Location\";s:11:\"Memphis, TN\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7288;s:5:\"Purse\";d:20000000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:7:\"Memphis\";s:5:\"State\";s:2:\"TN\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:725;s:7:\"RoundID\";i:32952;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-08-13T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:725;s:7:\"RoundID\";i:32953;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-08-14T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:725;s:7:\"RoundID\";i:32954;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-08-15T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:725;s:7:\"RoundID\";i:32955;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-08-16T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:13;a:23:{s:12:\"TournamentID\";i:724;s:4:\"Name\";s:20:\"Wyndham Championship\";s:9:\"StartDate\";s:19:\"2026-08-06T00:00:00\";s:7:\"EndDate\";s:19:\"2026-08-09T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:23:\"Sedgefield Country Club\";s:8:\"Location\";s:14:\"Greensboro, NC\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7131;s:5:\"Purse\";d:8500000;s:13:\"StartDateTime\";s:19:\"2026-08-06T06:50:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:10:\"Greensboro\";s:5:\"State\";s:2:\"NC\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:724;s:7:\"RoundID\";i:32948;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-08-06T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:724;s:7:\"RoundID\";i:32949;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-08-07T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:724;s:7:\"RoundID\";i:32950;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-08-08T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:724;s:7:\"RoundID\";i:32951;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-08-09T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:14;a:23:{s:12:\"TournamentID\";i:723;s:4:\"Name\";s:14:\"Rocket Classic\";s:9:\"StartDate\";s:19:\"2026-07-30T00:00:00\";s:7:\"EndDate\";s:19:\"2026-08-02T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:17:\"Detroit Golf Club\";s:8:\"Location\";s:11:\"Detroit, MI\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7328;s:5:\"Purse\";d:10000000;s:13:\"StartDateTime\";s:19:\"2026-07-30T07:00:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:7:\"Detroit\";s:5:\"State\";s:2:\"MI\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:723;s:7:\"RoundID\";i:32944;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-07-30T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:723;s:7:\"RoundID\";i:32945;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-07-31T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:723;s:7:\"RoundID\";i:32946;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-08-01T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:723;s:7:\"RoundID\";i:32947;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-08-02T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:15;a:23:{s:12:\"TournamentID\";i:722;s:4:\"Name\";s:7:\"3M Open\";s:9:\"StartDate\";s:19:\"2026-07-23T00:00:00\";s:7:\"EndDate\";s:19:\"2026-07-26T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:15:\"TPC Twin Cities\";s:8:\"Location\";s:10:\"Blaine, MN\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7431;s:5:\"Purse\";d:8800000;s:13:\"StartDateTime\";s:19:\"2026-07-23T07:45:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:6:\"Blaine\";s:5:\"State\";s:2:\"MN\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:722;s:7:\"RoundID\";i:32940;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-07-23T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:722;s:7:\"RoundID\";i:32941;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-07-24T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:722;s:7:\"RoundID\";i:32942;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-07-25T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:722;s:7:\"RoundID\";i:32943;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-07-26T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:16;a:23:{s:12:\"TournamentID\";i:692;s:4:\"Name\";s:8:\"The Open\";s:9:\"StartDate\";s:19:\"2026-07-16T00:00:00\";s:7:\"EndDate\";s:19:\"2026-07-19T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:24:\"Royal Birkdale Golf Club\";s:8:\"Location\";s:14:\"Southport, Eng\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7223;s:5:\"Purse\";d:17750000;s:13:\"StartDateTime\";s:19:\"2026-07-16T01:35:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:9:\"Southport\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"ENG\";s:8:\"TimeZone\";s:13:\"Europe/London\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:692;s:7:\"RoundID\";i:32932;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-07-16T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:692;s:7:\"RoundID\";i:32933;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-07-17T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:692;s:7:\"RoundID\";i:32934;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-07-18T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:692;s:7:\"RoundID\";i:32935;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-07-19T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:17;a:23:{s:12:\"TournamentID\";i:721;s:4:\"Name\";s:30:\"Corales Puntacana Championship\";s:9:\"StartDate\";s:19:\"2026-07-16T00:00:00\";s:7:\"EndDate\";s:19:\"2026-07-19T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:45:\"Puntacana Resort & Club (Corales Golf Course)\";s:8:\"Location\";s:15:\"Punta Cana, Dom\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7670;s:5:\"Purse\";d:4000000;s:13:\"StartDateTime\";s:19:\"2026-07-16T06:45:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:10:\"Punta Cana\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"DOM\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:721;s:7:\"RoundID\";i:32936;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-07-16T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:721;s:7:\"RoundID\";i:32937;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-07-17T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:721;s:7:\"RoundID\";i:32938;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-07-18T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:721;s:7:\"RoundID\";i:32939;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-07-19T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:18;a:23:{s:12:\"TournamentID\";i:719;s:4:\"Name\";s:21:\"Genesis Scottish Open\";s:9:\"StartDate\";s:19:\"2026-07-09T00:00:00\";s:7:\"EndDate\";s:19:\"2026-07-12T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:20:\"The Renaissance Club\";s:8:\"Location\";s:18:\"North Berwick, Sco\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7282;s:5:\"Purse\";d:9000000;s:13:\"StartDateTime\";s:19:\"2026-07-09T02:00:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:13:\"North Berwick\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"SCO\";s:8:\"TimeZone\";s:13:\"Europe/London\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:719;s:7:\"RoundID\";i:32924;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-07-09T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:719;s:7:\"RoundID\";i:32925;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-07-10T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:719;s:7:\"RoundID\";i:32926;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-07-11T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:719;s:7:\"RoundID\";i:32927;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-07-12T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:19;a:23:{s:12:\"TournamentID\";i:720;s:4:\"Name\";s:17:\"ISCO Championship\";s:9:\"StartDate\";s:19:\"2026-07-09T00:00:00\";s:7:\"EndDate\";s:19:\"2026-07-12T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:24:\"Hurstbourne Country Club\";s:8:\"Location\";s:14:\"Louisville, KY\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7056;s:5:\"Purse\";d:4000000;s:13:\"StartDateTime\";s:19:\"2026-07-09T07:00:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:10:\"Louisville\";s:5:\"State\";s:2:\"KY\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:720;s:7:\"RoundID\";i:32928;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-07-09T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:720;s:7:\"RoundID\";i:32929;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-07-10T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:720;s:7:\"RoundID\";i:32930;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-07-11T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:720;s:7:\"RoundID\";i:32931;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-07-12T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:20;a:23:{s:12:\"TournamentID\";i:718;s:4:\"Name\";s:18:\"John Deere Classic\";s:9:\"StartDate\";s:19:\"2026-07-02T00:00:00\";s:7:\"EndDate\";s:19:\"2026-07-05T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:13:\"TPC Deere Run\";s:8:\"Location\";s:10:\"Silvis, IL\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7327;s:5:\"Purse\";d:8800000;s:13:\"StartDateTime\";s:19:\"2026-07-02T07:40:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:6:\"Silvis\";s:5:\"State\";s:2:\"IL\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:718;s:7:\"RoundID\";i:32920;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-07-02T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:718;s:7:\"RoundID\";i:32921;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-07-03T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:718;s:7:\"RoundID\";i:32922;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-07-04T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:718;s:7:\"RoundID\";i:32923;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-07-05T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:21;a:23:{s:12:\"TournamentID\";i:717;s:4:\"Name\";s:22:\"Travelers Championship\";s:9:\"StartDate\";s:19:\"2026-06-25T00:00:00\";s:7:\"EndDate\";s:19:\"2026-06-28T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:19:\"TPC River Highlands\";s:8:\"Location\";s:12:\"Cromwell, CT\";s:3:\"Par\";i:70;s:5:\"Yards\";i:6844;s:5:\"Purse\";d:20000000;s:13:\"StartDateTime\";s:19:\"2026-06-25T08:15:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:8:\"Cromwell\";s:5:\"State\";s:2:\"CT\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:717;s:7:\"RoundID\";i:32916;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-06-25T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:717;s:7:\"RoundID\";i:32917;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-06-26T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:717;s:7:\"RoundID\";i:32918;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-06-27T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:717;s:7:\"RoundID\";i:32919;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-06-28T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:22;a:23:{s:12:\"TournamentID\";i:690;s:4:\"Name\";s:9:\"U.S. Open\";s:9:\"StartDate\";s:19:\"2026-06-18T00:00:00\";s:7:\"EndDate\";s:19:\"2026-06-21T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:26:\"Shinnecock Hills Golf Club\";s:8:\"Location\";s:15:\"Southampton, NY\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7440;s:5:\"Purse\";d:22500000;s:13:\"StartDateTime\";s:19:\"2026-06-18T06:35:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:11:\"Southampton\";s:5:\"State\";s:2:\"NY\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:690;s:7:\"RoundID\";i:32912;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-06-18T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:690;s:7:\"RoundID\";i:32913;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-06-19T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:690;s:7:\"RoundID\";i:32914;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-06-20T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:690;s:7:\"RoundID\";i:32915;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-06-21T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:23;a:23:{s:12:\"TournamentID\";i:716;s:4:\"Name\";s:17:\"RBC Canadian Open\";s:9:\"StartDate\";s:19:\"2026-06-11T00:00:00\";s:7:\"EndDate\";s:19:\"2026-06-14T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:43:\"TPC Toronto at Osprey Valley - North Course\";s:8:\"Location\";s:21:\"Caledon, Ontario, Can\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7389;s:5:\"Purse\";d:9800000;s:13:\"StartDateTime\";s:19:\"2026-06-11T07:00:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:16:\"Caledon, Ontario\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"CAN\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:716;s:7:\"RoundID\";i:32908;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-06-11T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:716;s:7:\"RoundID\";i:32909;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-06-12T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:716;s:7:\"RoundID\";i:32910;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-06-13T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:716;s:7:\"RoundID\";i:32911;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-06-14T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:24;a:23:{s:12:\"TournamentID\";i:715;s:4:\"Name\";s:40:\"the Memorial Tournament pres. by Workday\";s:9:\"StartDate\";s:19:\"2026-06-04T00:00:00\";s:7:\"EndDate\";s:19:\"2026-06-07T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:27:\"Muirfield Village Golf Club\";s:8:\"Location\";s:10:\"Dublin, OH\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7569;s:5:\"Purse\";d:20000000;s:13:\"StartDateTime\";s:19:\"2026-06-04T07:45:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:6:\"Dublin\";s:5:\"State\";s:2:\"OH\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:715;s:7:\"RoundID\";i:32904;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-06-04T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:715;s:7:\"RoundID\";i:32905;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-06-05T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:715;s:7:\"RoundID\";i:32906;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-06-06T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:715;s:7:\"RoundID\";i:32907;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-06-07T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:25;a:23:{s:12:\"TournamentID\";i:714;s:4:\"Name\";s:24:\"Charles Schwab Challenge\";s:9:\"StartDate\";s:19:\"2026-05-28T00:00:00\";s:7:\"EndDate\";s:19:\"2026-05-31T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:21:\"Colonial Country Club\";s:8:\"Location\";s:14:\"Fort Worth, TX\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7289;s:5:\"Purse\";d:9900000;s:13:\"StartDateTime\";s:19:\"2026-05-28T08:00:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:10:\"Fort Worth\";s:5:\"State\";s:2:\"TX\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:714;s:7:\"RoundID\";i:32900;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-05-28T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:714;s:7:\"RoundID\";i:32901;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-05-29T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:714;s:7:\"RoundID\";i:32902;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-05-30T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:714;s:7:\"RoundID\";i:32903;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-05-31T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:26;a:23:{s:12:\"TournamentID\";i:713;s:4:\"Name\";s:23:\"THE CJ CUP Byron Nelson\";s:9:\"StartDate\";s:19:\"2026-05-21T00:00:00\";s:7:\"EndDate\";s:19:\"2026-05-24T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:15:\"TPC Craig Ranch\";s:8:\"Location\";s:12:\"McKinney, TX\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7385;s:5:\"Purse\";d:10300000;s:13:\"StartDateTime\";s:19:\"2026-05-21T08:00:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:8:\"McKinney\";s:5:\"State\";s:2:\"TX\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:713;s:7:\"RoundID\";i:32896;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-05-21T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:713;s:7:\"RoundID\";i:32897;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-05-22T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:713;s:7:\"RoundID\";i:32898;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-05-23T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:713;s:7:\"RoundID\";i:32899;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-05-24T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:27;a:23:{s:12:\"TournamentID\";i:689;s:4:\"Name\";s:16:\"PGA Championship\";s:9:\"StartDate\";s:19:\"2026-05-14T00:00:00\";s:7:\"EndDate\";s:19:\"2026-05-17T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:19:\"Aronimink Golf Club\";s:8:\"Location\";s:18:\"Newtown Square, PA\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7394;s:5:\"Purse\";d:20500000;s:13:\"StartDateTime\";s:19:\"2026-05-14T06:45:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:14:\"Newtown Square\";s:5:\"State\";s:2:\"PA\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:689;s:7:\"RoundID\";i:32892;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-05-14T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:689;s:7:\"RoundID\";i:32893;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-05-15T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:689;s:7:\"RoundID\";i:32894;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-05-16T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:689;s:7:\"RoundID\";i:32895;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-05-17T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:28;a:23:{s:12:\"TournamentID\";i:711;s:4:\"Name\";s:19:\"Truist Championship\";s:9:\"StartDate\";s:19:\"2026-05-07T00:00:00\";s:7:\"EndDate\";s:19:\"2026-05-10T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:17:\"Quail Hollow Club\";s:8:\"Location\";s:13:\"Charlotte, NC\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7583;s:5:\"Purse\";d:20000000;s:13:\"StartDateTime\";s:19:\"2026-05-07T11:00:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:9:\"Charlotte\";s:5:\"State\";s:2:\"NC\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:711;s:7:\"RoundID\";i:32884;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-05-07T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:711;s:7:\"RoundID\";i:32885;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-05-08T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:711;s:7:\"RoundID\";i:32886;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-05-09T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:711;s:7:\"RoundID\";i:32887;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-05-10T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:29;a:23:{s:12:\"TournamentID\";i:712;s:4:\"Name\";s:30:\"ONEflight Myrtle Beach Classic\";s:9:\"StartDate\";s:19:\"2026-05-07T00:00:00\";s:7:\"EndDate\";s:19:\"2026-05-10T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:25:\"Dunes Golf and Beach Club\";s:8:\"Location\";s:16:\"Myrtle Beach, SC\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7347;s:5:\"Purse\";d:4000000;s:13:\"StartDateTime\";s:19:\"2026-05-07T06:50:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:12:\"Myrtle Beach\";s:5:\"State\";s:2:\"SC\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:712;s:7:\"RoundID\";i:32888;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-05-07T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:712;s:7:\"RoundID\";i:32889;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-05-08T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:712;s:7:\"RoundID\";i:32890;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-05-09T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:712;s:7:\"RoundID\";i:32891;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-05-10T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:30;a:23:{s:12:\"TournamentID\";i:710;s:4:\"Name\";s:21:\"Cadillac Championship\";s:9:\"StartDate\";s:19:\"2026-04-30T00:00:00\";s:7:\"EndDate\";s:19:\"2026-05-03T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:42:\"Trump National Doral - Blue Monster Course\";s:8:\"Location\";s:9:\"Miami, FL\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7739;s:5:\"Purse\";d:20000000;s:13:\"StartDateTime\";s:19:\"2026-04-30T08:40:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:5:\"Miami\";s:5:\"State\";s:2:\"FL\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:710;s:7:\"RoundID\";i:32880;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-04-30T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:710;s:7:\"RoundID\";i:32881;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-05-01T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:710;s:7:\"RoundID\";i:32882;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-05-02T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:710;s:7:\"RoundID\";i:32883;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-05-03T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:31;a:23:{s:12:\"TournamentID\";i:709;s:4:\"Name\";s:29:\"Zurich Classic of New Orleans\";s:9:\"StartDate\";s:19:\"2026-04-23T00:00:00\";s:7:\"EndDate\";s:19:\"2026-04-26T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:13:\"TPC Louisiana\";s:8:\"Location\";s:12:\"Avondale, LA\";s:3:\"Par\";N;s:5:\"Yards\";N;s:5:\"Purse\";d:9500000;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:0;s:7:\"Covered\";b:0;s:4:\"City\";s:8:\"Avondale\";s:5:\"State\";s:2:\"LA\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:4:\"Team\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:7:\"Limited\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:709;s:7:\"RoundID\";i:32876;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-04-23T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:709;s:7:\"RoundID\";i:32877;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-04-24T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:709;s:7:\"RoundID\";i:32878;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-04-25T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:709;s:7:\"RoundID\";i:32879;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-04-26T00:00:00\";s:11:\"IsRoundOver\";N;}}}i:32;a:23:{s:12:\"TournamentID\";i:708;s:4:\"Name\";s:12:\"RBC Heritage\";s:9:\"StartDate\";s:19:\"2026-04-16T00:00:00\";s:7:\"EndDate\";s:19:\"2026-04-19T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:23:\"Harbour Town Golf Links\";s:8:\"Location\";s:22:\"Hilton Head Island, SC\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7243;s:5:\"Purse\";d:20000000;s:13:\"StartDateTime\";s:19:\"2026-04-16T07:05:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:18:\"Hilton Head Island\";s:5:\"State\";s:2:\"SC\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:708;s:7:\"RoundID\";i:32872;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-04-16T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:708;s:7:\"RoundID\";i:32873;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-04-17T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:708;s:7:\"RoundID\";i:32874;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-04-18T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:708;s:7:\"RoundID\";i:32875;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-04-19T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:33;a:23:{s:12:\"TournamentID\";i:688;s:4:\"Name\";s:18:\"Masters Tournament\";s:9:\"StartDate\";s:19:\"2026-04-09T00:00:00\";s:7:\"EndDate\";s:19:\"2026-04-12T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:26:\"Augusta National Golf Club\";s:8:\"Location\";s:11:\"Augusta, GA\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7565;s:5:\"Purse\";d:0;s:13:\"StartDateTime\";s:19:\"2026-04-09T07:40:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:7:\"Augusta\";s:5:\"State\";s:2:\"GA\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:688;s:7:\"RoundID\";i:32868;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-04-09T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:688;s:7:\"RoundID\";i:32869;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-04-10T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:688;s:7:\"RoundID\";i:32870;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-04-11T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:688;s:7:\"RoundID\";i:32871;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-04-12T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:34;a:23:{s:12:\"TournamentID\";i:707;s:4:\"Name\";s:17:\"Valero Texas Open\";s:9:\"StartDate\";s:19:\"2026-04-02T00:00:00\";s:7:\"EndDate\";s:19:\"2026-04-05T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:33:\"TPC San Antonio - The Oaks Course\";s:8:\"Location\";s:15:\"San Antonio, TX\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7438;s:5:\"Purse\";d:9800000;s:13:\"StartDateTime\";s:19:\"2026-04-02T08:30:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:11:\"San Antonio\";s:5:\"State\";s:2:\"TX\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:707;s:7:\"RoundID\";i:32864;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-04-02T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:707;s:7:\"RoundID\";i:32865;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-04-03T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:707;s:7:\"RoundID\";i:32866;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-04-04T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:707;s:7:\"RoundID\";i:32867;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-04-05T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:35;a:23:{s:12:\"TournamentID\";i:706;s:4:\"Name\";s:29:\"Texas Children\'s Houston Open\";s:9:\"StartDate\";s:19:\"2026-03-26T00:00:00\";s:7:\"EndDate\";s:19:\"2026-03-29T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:25:\"Memorial Park Golf Course\";s:8:\"Location\";s:11:\"Houston, TX\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7475;s:5:\"Purse\";d:9900000;s:13:\"StartDateTime\";s:19:\"2026-03-26T08:20:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:7:\"Houston\";s:5:\"State\";s:2:\"TX\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Chicago\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:706;s:7:\"RoundID\";i:32860;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-03-26T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:706;s:7:\"RoundID\";i:32861;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-03-27T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:706;s:7:\"RoundID\";i:32862;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-03-28T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:706;s:7:\"RoundID\";i:32863;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-03-29T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:36;a:23:{s:12:\"TournamentID\";i:705;s:4:\"Name\";s:20:\"Valspar Championship\";s:9:\"StartDate\";s:19:\"2026-03-19T00:00:00\";s:7:\"EndDate\";s:19:\"2026-03-22T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:51:\"Innisbrook Resort and Golf Club - Copperhead Course\";s:8:\"Location\";s:15:\"Palm Harbor, FL\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7352;s:5:\"Purse\";d:9100000;s:13:\"StartDateTime\";s:19:\"2026-03-19T07:35:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:11:\"Palm Harbor\";s:5:\"State\";s:2:\"FL\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:705;s:7:\"RoundID\";i:32856;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-03-19T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:705;s:7:\"RoundID\";i:32857;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-03-20T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:705;s:7:\"RoundID\";i:32858;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-03-21T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:705;s:7:\"RoundID\";i:32859;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-03-22T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:37;a:23:{s:12:\"TournamentID\";i:693;s:4:\"Name\";s:24:\"THE PLAYERS Championship\";s:9:\"StartDate\";s:19:\"2026-03-12T00:00:00\";s:7:\"EndDate\";s:19:\"2026-03-15T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:41:\"TPC Sawgrass - THE PLAYERS Stadium Course\";s:8:\"Location\";s:21:\"Ponte Vedra Beach, FL\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7352;s:5:\"Purse\";d:25000000;s:13:\"StartDateTime\";s:19:\"2026-03-12T07:40:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:17:\"Ponte Vedra Beach\";s:5:\"State\";s:2:\"FL\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:693;s:7:\"RoundID\";i:32852;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-03-12T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:693;s:7:\"RoundID\";i:32853;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-03-13T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:693;s:7:\"RoundID\";i:32854;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-03-14T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:693;s:7:\"RoundID\";i:32855;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-03-15T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:38;a:23:{s:12:\"TournamentID\";i:703;s:4:\"Name\";s:46:\"Arnold Palmer Invitational pres. by Mastercard\";s:9:\"StartDate\";s:19:\"2026-03-05T00:00:00\";s:7:\"EndDate\";s:19:\"2026-03-08T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:37:\"Arnold Palmer\'s Bay Hill Club & Lodge\";s:8:\"Location\";s:11:\"Orlando, FL\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7466;s:5:\"Purse\";d:20000000;s:13:\"StartDateTime\";s:19:\"2026-03-05T07:40:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:7:\"Orlando\";s:5:\"State\";s:2:\"FL\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:703;s:7:\"RoundID\";i:32844;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-03-05T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:703;s:7:\"RoundID\";i:32845;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-03-06T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:703;s:7:\"RoundID\";i:32846;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-03-07T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:703;s:7:\"RoundID\";i:32847;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-03-08T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:39;a:23:{s:12:\"TournamentID\";i:704;s:4:\"Name\";s:16:\"Puerto Rico Open\";s:9:\"StartDate\";s:19:\"2026-03-05T00:00:00\";s:7:\"EndDate\";s:19:\"2026-03-08T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:23:\"Grand Reserve Golf Club\";s:8:\"Location\";s:15:\"Rio Grande, Pur\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7506;s:5:\"Purse\";d:4000000;s:13:\"StartDateTime\";s:19:\"2026-03-05T05:45:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:10:\"Rio Grande\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"PUR\";s:8:\"TimeZone\";s:19:\"America/Puerto Rico\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:704;s:7:\"RoundID\";i:32848;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-03-05T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:704;s:7:\"RoundID\";i:32849;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-03-06T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:704;s:7:\"RoundID\";i:32850;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-03-07T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:704;s:7:\"RoundID\";i:32851;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-03-08T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:40;a:23:{s:12:\"TournamentID\";i:702;s:4:\"Name\";s:37:\"Cognizant Classic in The Palm Beaches\";s:9:\"StartDate\";s:19:\"2026-02-26T00:00:00\";s:7:\"EndDate\";s:19:\"2026-03-01T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:31:\"PGA National  - Champion Course\";s:8:\"Location\";s:22:\"Palm Beach Gardens, FL\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7223;s:5:\"Purse\";d:9600000;s:13:\"StartDateTime\";s:19:\"2026-02-26T06:45:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:18:\"Palm Beach Gardens\";s:5:\"State\";s:2:\"FL\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"America/New York\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:702;s:7:\"RoundID\";i:32840;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-02-26T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:702;s:7:\"RoundID\";i:32841;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-02-27T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:702;s:7:\"RoundID\";i:32842;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-02-28T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:702;s:7:\"RoundID\";i:32843;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-03-01T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:41;a:23:{s:12:\"TournamentID\";i:701;s:4:\"Name\";s:24:\"The Genesis Invitational\";s:9:\"StartDate\";s:19:\"2026-02-19T00:00:00\";s:7:\"EndDate\";s:19:\"2026-02-22T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:24:\"The Riviera Country Club\";s:8:\"Location\";s:21:\"Pacific Palisades, CA\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7383;s:5:\"Purse\";d:20000000;s:13:\"StartDateTime\";s:19:\"2026-02-19T10:15:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:17:\"Pacific Palisades\";s:5:\"State\";s:2:\"CA\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:19:\"America/Los Angeles\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:701;s:7:\"RoundID\";i:32836;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-02-19T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:701;s:7:\"RoundID\";i:32837;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-02-20T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:701;s:7:\"RoundID\";i:32838;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-02-21T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:701;s:7:\"RoundID\";i:32839;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-02-22T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:42;a:23:{s:12:\"TournamentID\";i:700;s:4:\"Name\";s:24:\"AT&T Pebble Beach Pro-Am\";s:9:\"StartDate\";s:19:\"2026-02-12T00:00:00\";s:7:\"EndDate\";s:19:\"2026-02-15T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:23:\"Pebble Beach Golf Links\";s:8:\"Location\";s:16:\"Pebble Beach, CA\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7071;s:5:\"Purse\";d:20000000;s:13:\"StartDateTime\";s:19:\"2026-02-12T11:45:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:12:\"Pebble Beach\";s:5:\"State\";s:2:\"CA\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:19:\"America/Los Angeles\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:700;s:7:\"RoundID\";i:32832;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-02-12T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:700;s:7:\"RoundID\";i:32833;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-02-13T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:700;s:7:\"RoundID\";i:32834;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-02-14T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:700;s:7:\"RoundID\";i:32835;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-02-15T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:43;a:23:{s:12:\"TournamentID\";i:699;s:4:\"Name\";s:15:\"WM Phoenix Open\";s:9:\"StartDate\";s:19:\"2026-02-05T00:00:00\";s:7:\"EndDate\";s:19:\"2026-02-08T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:31:\"TPC Scottsdale (Stadium Course)\";s:8:\"Location\";s:14:\"Scottsdale, AZ\";s:3:\"Par\";i:71;s:5:\"Yards\";i:7261;s:5:\"Purse\";d:9600000;s:13:\"StartDateTime\";s:19:\"2026-02-05T09:20:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:10:\"Scottsdale\";s:5:\"State\";s:2:\"AZ\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:15:\"America/Phoenix\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:699;s:7:\"RoundID\";i:32828;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-02-05T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:699;s:7:\"RoundID\";i:32829;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-02-06T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:699;s:7:\"RoundID\";i:32830;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-02-07T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:699;s:7:\"RoundID\";i:32831;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-02-08T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:44;a:23:{s:12:\"TournamentID\";i:698;s:4:\"Name\";s:22:\"Farmers Insurance Open\";s:9:\"StartDate\";s:19:\"2026-01-29T00:00:00\";s:7:\"EndDate\";s:19:\"2026-02-01T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:39:\"Torrey Pines Golf Course (South Course)\";s:8:\"Location\";s:13:\"San Diego, CA\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7258;s:5:\"Purse\";d:9600000;s:13:\"StartDateTime\";s:19:\"2026-01-29T12:10:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:9:\"San Diego\";s:5:\"State\";s:2:\"CA\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:19:\"America/Los Angeles\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:698;s:7:\"RoundID\";i:32824;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-01-29T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:698;s:7:\"RoundID\";i:32825;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-01-30T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:698;s:7:\"RoundID\";i:32826;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-01-31T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:698;s:7:\"RoundID\";i:32827;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-02-01T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:45;a:23:{s:12:\"TournamentID\";i:697;s:4:\"Name\";s:20:\"The American Express\";s:9:\"StartDate\";s:19:\"2026-01-22T00:00:00\";s:7:\"EndDate\";s:19:\"2026-01-25T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:23:\"Pete Dye Stadium Course\";s:8:\"Location\";s:13:\"La Quinta, CA\";s:3:\"Par\";i:72;s:5:\"Yards\";i:7060;s:5:\"Purse\";d:9200000;s:13:\"StartDateTime\";s:19:\"2026-01-22T11:30:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:9:\"La Quinta\";s:5:\"State\";s:2:\"CA\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:19:\"America/Los Angeles\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:697;s:7:\"RoundID\";i:32820;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-01-22T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:697;s:7:\"RoundID\";i:32821;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-01-23T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:697;s:7:\"RoundID\";i:32822;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-01-24T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:697;s:7:\"RoundID\";i:32823;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-01-25T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:46;a:23:{s:12:\"TournamentID\";i:696;s:4:\"Name\";s:19:\"Sony Open in Hawaii\";s:9:\"StartDate\";s:19:\"2026-01-15T00:00:00\";s:7:\"EndDate\";s:19:\"2026-01-18T00:00:00\";s:6:\"IsOver\";b:1;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:20:\"Waialae Country Club\";s:8:\"Location\";s:12:\"Honolulu, HI\";s:3:\"Par\";i:70;s:5:\"Yards\";i:7044;s:5:\"Purse\";d:9100000;s:13:\"StartDateTime\";s:19:\"2026-01-15T12:10:00\";s:8:\"Canceled\";b:0;s:7:\"Covered\";b:1;s:4:\"City\";s:8:\"Honolulu\";s:5:\"State\";s:2:\"HI\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"Pacific/Honolulu\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"Full\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:696;s:7:\"RoundID\";i:32816;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-01-15T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:1;a:5:{s:12:\"TournamentID\";i:696;s:7:\"RoundID\";i:32817;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-01-16T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:2;a:5:{s:12:\"TournamentID\";i:696;s:7:\"RoundID\";i:32818;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-01-17T00:00:00\";s:11:\"IsRoundOver\";b:1;}i:3;a:5:{s:12:\"TournamentID\";i:696;s:7:\"RoundID\";i:32819;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-01-18T00:00:00\";s:11:\"IsRoundOver\";b:1;}}}i:47;a:23:{s:12:\"TournamentID\";i:695;s:4:\"Name\";s:10:\"The Sentry\";s:9:\"StartDate\";s:19:\"2026-01-08T00:00:00\";s:7:\"EndDate\";s:19:\"2026-01-11T00:00:00\";s:6:\"IsOver\";b:0;s:12:\"IsInProgress\";b:0;s:5:\"Venue\";s:3:\"TBD\";s:8:\"Location\";s:8:\"TBD, Usa\";s:3:\"Par\";i:73;s:5:\"Yards\";i:7596;s:5:\"Purse\";d:0;s:13:\"StartDateTime\";N;s:8:\"Canceled\";b:1;s:7:\"Covered\";b:0;s:4:\"City\";s:3:\"TBD\";s:5:\"State\";s:0:\"\";s:7:\"ZipCode\";N;s:7:\"Country\";s:3:\"USA\";s:8:\"TimeZone\";s:16:\"Pacific/Honolulu\";s:6:\"Format\";s:6:\"Stroke\";s:22:\"SportRadarTournamentID\";s:0:\"\";s:12:\"OddsCoverage\";s:4:\"None\";s:6:\"Rounds\";a:4:{i:0;a:5:{s:12:\"TournamentID\";i:695;s:7:\"RoundID\";i:32812;s:6:\"Number\";i:1;s:3:\"Day\";s:19:\"2026-01-08T00:00:00\";s:11:\"IsRoundOver\";N;}i:1;a:5:{s:12:\"TournamentID\";i:695;s:7:\"RoundID\";i:32813;s:6:\"Number\";i:2;s:3:\"Day\";s:19:\"2026-01-09T00:00:00\";s:11:\"IsRoundOver\";N;}i:2;a:5:{s:12:\"TournamentID\";i:695;s:7:\"RoundID\";i:32814;s:6:\"Number\";i:3;s:3:\"Day\";s:19:\"2026-01-10T00:00:00\";s:11:\"IsRoundOver\";N;}i:3;a:5:{s:12:\"TournamentID\";i:695;s:7:\"RoundID\";i:32815;s:6:\"Number\";i:4;s:3:\"Day\";s:19:\"2026-01-11T00:00:00\";s:11:\"IsRoundOver\";N;}}}}', 1785957276);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_modules`
--

CREATE TABLE `cms_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `route_name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_modules`
--

INSERT INTO `cms_modules` (`id`, `parent_id`, `name`, `route_name`, `icon`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dashboard', 'admin.dashboard', 'fa-solid fa-house', 1, 'active', '2026-08-05 12:46:07', '2026-08-05 16:21:21'),
(2, 0, 'Users', 'users.index', 'fa-solid fa-users', 2, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(3, 0, 'Site Settings', 'site-settings.edit', 'fa-solid fa-gear', 3, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(4, 0, 'Tips Management', 'admin.tips-management', 'fa-solid fa-lightbulb', 4, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(5, 4, 'Tip', 'admin.tips.index', 'fa-solid fa-lightbulb', 1, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(6, 4, 'Tips Category', 'admin.tips-categories.index', 'fa-solid fa-tags', 2, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(7, 0, 'Promos', 'admin.promos.index', 'fa-solid fa-gift', 5, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `cms_module_permissions`
--

CREATE TABLE `cms_module_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `module_id` int(11) NOT NULL,
  `is_add` tinyint(1) NOT NULL DEFAULT 1,
  `is_view` tinyint(1) NOT NULL DEFAULT 1,
  `is_update` tinyint(1) NOT NULL DEFAULT 1,
  `is_delete` tinyint(1) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_module_permissions`
--

INSERT INTO `cms_module_permissions` (`id`, `role`, `module_id`, `is_add`, `is_view`, `is_update`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, 1, 1, 1, 1, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(2, 'admin', 2, 1, 1, 1, 1, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(3, 'admin', 3, 0, 1, 1, 0, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(4, 'admin', 4, 0, 1, 0, 0, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(5, 'admin', 5, 1, 1, 1, 1, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(6, 'admin', 6, 1, 1, 1, 1, 'active', '2026-08-05 12:46:07', '2026-08-05 12:46:07'),
(7, 'admin', 7, 1, 1, 1, 1, 'active', '2026-08-05 12:46:08', '2026-08-05 12:46:08'),
(8, 'user', 1, 0, 1, 0, 0, 'active', '2026-08-05 12:46:08', '2026-08-05 12:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_28_230800_create_cms_modules_table', 1),
(5, '2026_04_28_230924_create_cms_module_permissions_table', 1),
(6, '2026_06_19_000001_create_site_settings_table', 1),
(7, '2026_06_19_000002_create_tips_table', 1),
(8, '2026_07_03_000001_create_tips_category_table', 1),
(9, '2026_07_03_000002_update_tips_table_add_category_remove_slogan', 1),
(10, '2026_07_03_000003_create_promos_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `footer_copyright` varchar(255) DEFAULT NULL,
  `footer_description` text DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_logo`, `footer_logo`, `favicon`, `footer_copyright`, `footer_description`, `contact_email`, `contact_phone`, `address`, `facebook_url`, `instagram_url`, `linkedin_url`, `youtube_url`, `twitter_url`, `created_at`, `updated_at`) VALUES
(1, 'Prime Field & Course', NULL, NULL, NULL, '© 2026 Prime Field & Course Solutions LLC. All rights reserved.', 'Expert picks, exclusive bonuses, smart strategies for serious golf bettors.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-05 12:46:07', '2026-08-05 12:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE `tips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tips_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `slug`, `title`, `tips_category_id`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fade-the-field-finding-value-longshots', 'Fade the Field: Finding Value Longshots', 1, 'assets/images/tips/fade-the-field-finding-value-longshots.jpg', 'How sharp bettors find value by analyzing strokes gained data.', 1, '2026-08-05 12:46:08', '2026-08-05 18:14:17'),
(2, 'strokes-gained-the-key-metric', 'Strokes Gained: The Key Metric', 2, 'assets/images/tips/strokes-gained-the-key-metric.jpg', 'Translated into betting edges every week.', 1, '2026-08-05 12:46:08', '2026-08-05 18:14:18'),
(3, 'the-players-championship-2025-preview', 'The Players Championship 2025 Preview', 3, 'assets/images/tips/the-players-championship-2025-preview.jpg', 'Full field breakdown with course fits & projections.', 1, '2026-08-05 12:46:08', '2026-08-05 18:14:19'),
(4, 'weather-wind-the-hidden-variable', 'Weather & Wind: The Hidden Variable', 4, 'assets/images/tips/weather-wind-the-hidden-variable.jpg', 'Create systematic edges across all PGA Tour venues.', 1, '2026-08-05 12:46:08', '2026-08-05 18:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `tips_category`
--

CREATE TABLE `tips_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tips_category`
--

INSERT INTO `tips_category` (`id`, `title`, `slug`, `description`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'Strategy', 'strategy', 'In-depth strategy guides and course management tips from professional golf analysts.', NULL, '2026-08-05 12:46:08', '2026-08-05 12:46:08'),
(2, 'Handicapping', 'handicapping', 'Strokes gained breakdowns, form analysis, and data-driven handicapping methods.', NULL, '2026-08-05 12:46:08', '2026-08-05 12:46:08'),
(3, 'Tournament', 'tournament', 'Tournament previews, field breakdowns, and weekly event coverage.', NULL, '2026-08-05 12:46:08', '2026-08-05 12:46:08'),
(4, 'Advanced', 'advanced', 'Weather edges, live betting tactics, and advanced line-shopping strategies.', NULL, '2026-08-05 12:46:08', '2026-08-05 12:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin@admin.com', NULL, '$2y$12$E3GceXB0Cr0a0VyHa/4uo.cqr6t.2qZFMKZPT3e37iHJFs8NzR0O2', NULL, '2026-08-05 12:46:06', '2026-08-05 12:46:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `cms_modules`
--
ALTER TABLE `cms_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_module_permissions`
--
ALTER TABLE `cms_module_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promos_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tips_slug_unique` (`slug`),
  ADD KEY `tips_tips_category_id_foreign` (`tips_category_id`);

--
-- Indexes for table `tips_category`
--
ALTER TABLE `tips_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tips_category_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_modules`
--
ALTER TABLE `cms_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cms_module_permissions`
--
ALTER TABLE `cms_module_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tips`
--
ALTER TABLE `tips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tips_category`
--
ALTER TABLE `tips_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tips`
--
ALTER TABLE `tips`
  ADD CONSTRAINT `tips_tips_category_id_foreign` FOREIGN KEY (`tips_category_id`) REFERENCES `tips_category` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
