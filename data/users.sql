-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2016 at 03:13 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE DATABASE IF NOT EXISTS db;
USE db;

CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT,
  is_admin BOOLEAN,
  first_name varchar(100) NOT NULL,
  sir_name varchar(100) NOT NULL,
  title ENUM('Mr.', 'Mrs.'),
  country varchar(100),
  city varchar(100),
  email varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (email)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


INSERT IGNORE INTO users (id, is_admin, first_name, sir_name, email, password) 
VALUES 
(1, true, 'Admin', 'Automation', 'admin@automation.com', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c');

INSERT IGNORE INTO users (is_admin, first_name, sir_name, email, title, country, city, password) 
VALUES 
(false, 'Ivan', 'Dimotrov', 'idimitrov@automation.com', 'Mr.', 'Bulgaria', 'Sofia', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c'),
(false, 'Yoana', 'Ivanova', 'yivanova@automation.com', 'Mrs.', 'Bulgaria', 'Sopot', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c'),
(false, 'Zdravka', 'Petrova', 'zpetrova@automation.com', 'Mrs.', 'Bulgaria', 'Elin Pelin', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c'),
(false, 'Todor', 'Ivanov', 'tivanov@automation.com', 'Mr.', 'Bulgaria', 'Pravets', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c'),
(false, 'Zahari', 'Avramov', 'zavramov@automation.com', 'Mr.', 'Bulgaria', 'Kardjali', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c');



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
