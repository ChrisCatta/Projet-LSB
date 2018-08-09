-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2016 at 08:44 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sql_tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `plus2_city`
--

CREATE TABLE IF NOT EXISTS `plus2_city` (
  `city_id` int(4) NOT NULL AUTO_INCREMENT,
  `state_id` int(3) NOT NULL DEFAULT '0',
  `city` char(35) NOT NULL DEFAULT '',
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=147 ;

--
-- Dumping data for table `plus2_city`
--

INSERT INTO `plus2_city` (`city_id`, `state_id`, `city`) VALUES
(1, 1, 'Mumbai (Bombay)'),
(2, 1, 'Nagpur'),
(3, 2, 'Delhi'),
(4, 3, 'Calcutta [Kolkata]'),
(5, 4, 'Chennai (Madras)'),
(6, 5, 'Hyderabad'),
(7, 6, 'Ahmedabad'),
(8, 7, 'Bangalore'),
(9, 8, 'Kanpur'),
(10, 8, 'Lucknow'),
(11, 9, 'Mumbai (Bombay)'),
(12, 9, 'Nagpur'),
(15, 11, 'Kabul'),
(16, 12, 'Qandahar'),
(17, 13, 'Herat'),
(18, 14, 'Mazar-e-Sharif'),
(19, 15, 'New York'),
(20, 16, 'Los Angeles'),
(21, 16, 'San Diego'),
(22, 17, 'Chicago'),
(23, 18, 'Houston'),
(24, 18, 'Dallas'),
(25, 18, 'San Antonio'),
(26, 19, 'Philadelphia'),
(27, 20, 'Phoenix'),
(28, 21, 'Los Angeles'),
(29, 21, 'San Diego'),
(36, 24, 'Detroit'),
(37, 25, 'Montréal'),
(38, 26, 'Calgary'),
(39, 26, 'Edmonton'),
(40, 27, 'Toronto'),
(41, 27, 'North York'),
(42, 27, 'Mississauga'),
(43, 27, 'Scarborough'),
(44, 27, 'Etobicoke'),
(50, 29, 'Winnipeg'),
(63, 33, 'Vancouver'),
(69, 35, 'London'),
(70, 35, 'Birmingham'),
(71, 35, 'Liverpool'),
(72, 35, 'Sheffield'),
(73, 35, 'Manchester'),
(74, 35, 'Leeds'),
(75, 35, 'Bristol'),
(83, 37, 'Glasgow'),
(84, 37, 'Edinburgh'),
(122, 44, 'Cardiff'),
(127, 46, 'Melbourne'),
(130, 48, 'Perth'),
(131, 49, 'Adelaide'),
(132, 50, 'Canberra'),
(133, 51, 'Brisbane'),
(134, 51, 'Gold Coast');

-- --------------------------------------------------------

--
-- Table structure for table `plus2_country`
--

CREATE TABLE IF NOT EXISTS `plus2_country` (
  `country_code` char(3) NOT NULL DEFAULT '',
  `country` varchar(20) NOT NULL,
  UNIQUE KEY `country_code` (`country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plus2_country`
--

INSERT INTO `plus2_country` (`country_code`, `country`) VALUES
('IND', 'INDIA'),
('AFG', 'AFGHANISTAN'),
('USA', 'USA'),
('CAN', 'CANADA'),
('GBR', 'GREAT BRITAIN'),
('AUS', 'AUSTRALIA');

-- --------------------------------------------------------

--
-- Table structure for table `plus2_state`
--

CREATE TABLE IF NOT EXISTS `plus2_state` (
  `state_id` int(3) NOT NULL AUTO_INCREMENT,
  `state` char(20) NOT NULL DEFAULT '',
  `country_code` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `plus2_state`
--

INSERT INTO `plus2_state` (`state_id`, `state`, `country_code`) VALUES
(1, 'Maharashtra', 'IND'),
(2, 'Delhi', 'IND'),
(3, 'West Bengali', 'IND'),
(4, 'Tamil Nadu', 'IND'),
(5, 'Andhra Pradesh', 'IND'),
(6, 'Gujarat', 'IND'),
(7, 'Karnataka', 'IND'),
(8, 'Uttar Pradesh', 'IND'),
(9, 'Maharashtra', 'IND'),
(12, 'Qandahar', 'AFG'),
(13, 'Herat', 'AFG'),
(14, 'Balkh', 'AFG'),
(15, 'New York', 'USA'),
(16, 'California', 'USA'),
(17, 'Illinois', 'USA'),
(18, 'Texas', 'USA'),
(19, 'Pennsylvania', 'USA'),
(20, 'Arizona', 'USA'),
(21, 'California', 'USA'),
(24, 'Michigan', 'USA'),
(25, 'Québec', 'CAN'),
(26, 'Alberta', 'CAN'),
(27, 'Ontario', 'CAN'),
(29, 'Manitoba', 'CAN'),
(33, 'British Columbia', 'CAN'),
(35, 'England', 'GBR'),
(37, 'Scotland', 'GBR'),
(44, 'Wales', 'GBR'),
(46, 'Victoria', 'AUS'),
(48, 'West Australia', 'AUS'),
(49, 'South Australia', 'AUS'),
(50, 'Capital Region', 'AUS'),
(51, 'Queensland', 'AUS');
