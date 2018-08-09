-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 24 juil. 2018 à 16:01
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  projet
--

--
-- Déchargement des données de la table utilisateur
--

INSERT INTO utilisateur (ID_USER, LOGIN, NOM, PRENOM, DATENAIS, SEXE, SERVICE, ADRESSE, TEL1, PW) VALUES
(1, 'Madachri', 'Chris', 'Madachri', '1957-08-01', 'M', 'ADMINISTRATION', 'BlaBlabla', '0348482458', 'madachri2017'),
(9, 'ZAHIA', 'LARROUSSI', 'ZAHIA', '1981-03-05', 'M', 'ADMINISTRATION', '5 RUE HAJ JILLALI EL OUFIR CASABLANCA MAROC', '0663346677', 'DRISSBOUCHRA'),
(10, 'James', 'James', 'James', '1990-01-01', 'M', 'EMPLOYE', 'blabla', '0340000000', 'lsb*scieries'),
(11, 'Gabriella', 'Gabriella', 'Gabriella', '1990-01-01', 'F', 'EMPLOYE', '', '0301000000', 'lsb*scieries');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
