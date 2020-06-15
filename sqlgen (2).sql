-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2020 at 12:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sqlgen`
--

-- --------------------------------------------------------

--
-- Table structure for table `confirmation`
--

CREATE TABLE `confirmation` (
  `id` varchar(100) NOT NULL,
  `data_id` varchar(100) NOT NULL,
  `default_name` text NOT NULL,
  `proc_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `extract`
--

CREATE TABLE `extract` (
  `id` varchar(100) NOT NULL,
  `proc_id` varchar(100) NOT NULL,
  `data_id` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `id` varchar(100) NOT NULL,
  `templates` text NOT NULL,
  `stage` int(2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `row_id` varchar(100) NOT NULL,
  `query` text NOT NULL,
  `param` text NOT NULL,
  `loop_opt` varchar(100) NOT NULL,
  `col_ch` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`row_id`, `query`, `param`, `loop_opt`, `col_ch`) VALUES
('1', 'query1(%NAME%)', 'NAME|str', '', ''),
('query-5ee4a49c7af64', 'Query2(%NAME%, %LOOP%);', 'NAME|str,LOOP|str', 'col,LOOP', 'LOOP'),
('query-5ee4a49c7c3eb', 'Query2(%NAME%, %CONTENT%);', 'NAME|str,CONTENT|str', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `queries` text NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `name`, `queries`, `created`, `last_updated`) VALUES
('1', 'tmplt_test', '1', '2020-06-13 16:51:14', '2020-06-13 09:51:57'),
('tmplt-5ee4a3776a430', 'tmplt_12', 'query-5ee4a49c7af64,query-5ee4a49c7c3eb', '2020-06-13 17:01:09', '2020-06-13 10:04:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `confirmation`
--
ALTER TABLE `confirmation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extract`
--
ALTER TABLE `extract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
