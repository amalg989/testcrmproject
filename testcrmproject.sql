/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.24 : Database - project_crm_dms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`project_crm_dms` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `project_crm_dms`;

/*Table structure for table `activities` */

DROP TABLE IF EXISTS `activities`;

CREATE TABLE `activities` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `cusId` int(15) DEFAULT NULL,
  `staffId` int(15) DEFAULT NULL,
  `date` date NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `outcome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cusId` (`cusId`),
  KEY `staffId` (`staffId`),
  CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`cusId`) REFERENCES `customers` (`id`),
  CONSTRAINT `activities_ibfk_2` FOREIGN KEY (`staffId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `cusId` int(15) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` text,
  `contactNo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cusId` (`cusId`),
  CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`cusId`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `staffId` int(15) DEFAULT NULL,
  `companyName` text,
  `regNo` text,
  `address` text,
  `website` text,
  PRIMARY KEY (`id`),
  KEY `staffId` (`staffId`),
  CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`staffId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `fullname` text,
  `username` text,
  `password` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
