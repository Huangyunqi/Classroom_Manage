-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: Classroom_Manage
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Application`
--

DROP TABLE IF EXISTS `Application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Application` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` enum('s','p','e') NOT NULL,
  `user_id` int(11) NOT NULL,
  `size` enum('big','medium big','medium small','small') NOT NULL,
  `week` int(11) NOT NULL,
  `day` enum('mon','tue','wed','thu','fri','sat','sun') NOT NULL,
  `course_begin` int(11) NOT NULL,
  `course_end` int(11) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `vertify` tinyint(4) NOT NULL DEFAULT '0',
  `classroom_id` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`application_id`),
  UNIQUE KEY `application_id_UNIQUE` (`application_id`),
  KEY `fk_applocation_classroom_idx` (`classroom_id`),
  CONSTRAINT `fk_applocation_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `Classroom` (`classroom_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Application`
--

LOCK TABLES `Application` WRITE;
/*!40000 ALTER TABLE `Application` DISABLE KEYS */;
INSERT INTO `Application` (`application_id`, `user_type`, `user_id`, `size`, `week`, `day`, `course_begin`, `course_end`, `reason`, `vertify`, `classroom_id`) VALUES (1,'s',1,'big',1,'tue',12,15,'no',-1,NULL),(14,'p',1,'small',1,'sat',3,5,'hahaha',1,'A203');
/*!40000 ALTER TABLE `Application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Classroom`
--

DROP TABLE IF EXISTS `Classroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Classroom` (
  `classroom_id` varchar(5) NOT NULL,
  `size` enum('big','medium big','medium small','small') NOT NULL,
  `facility` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`classroom_id`),
  UNIQUE KEY `classroom_id_UNIQUE` (`classroom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Classroom`
--

LOCK TABLES `Classroom` WRITE;
/*!40000 ALTER TABLE `Classroom` DISABLE KEYS */;
INSERT INTO `Classroom` (`classroom_id`, `size`, `facility`) VALUES ('A101','small',1),('A202','medium small',1),('A203','medium small',1),('B101','big',1),('B201','big',0),('C202','medium big',1);
/*!40000 ALTER TABLE `Classroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Course`
--

DROP TABLE IF EXISTS `Course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(30) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `classroom_id` varchar(5) NOT NULL,
  `week_begin` int(11) NOT NULL,
  `week_end` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `course_begin` int(11) NOT NULL,
  `course_end` int(11) NOT NULL,
  PRIMARY KEY (`course_id`),
  UNIQUE KEY `course_id_UNIQUE` (`course_id`),
  KEY `fk_course_professor_idx` (`professor_id`),
  KEY `fk_course_classroom_idx` (`classroom_id`),
  CONSTRAINT `fk_course_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `Classroom` (`classroom_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_course_professor` FOREIGN KEY (`professor_id`) REFERENCES `Professor` (`professor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Course`
--

LOCK TABLES `Course` WRITE;
/*!40000 ALTER TABLE `Course` DISABLE KEYS */;
/*!40000 ALTER TABLE `Course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Manager`
--

DROP TABLE IF EXISTS `Manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Manager` (
  `manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL DEFAULT '000',
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`manager_id`),
  UNIQUE KEY `manager_id_UNIQUE` (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Manager`
--

LOCK TABLES `Manager` WRITE;
/*!40000 ALTER TABLE `Manager` DISABLE KEYS */;
INSERT INTO `Manager` (`manager_id`, `password`, `name`) VALUES (1,'111','aaa'),(2,'000','bbb'),(3,'000','ccc');
/*!40000 ALTER TABLE `Manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Professor`
--

DROP TABLE IF EXISTS `Professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Professor` (
  `professor_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL DEFAULT '000',
  `name` varchar(30) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`professor_id`),
  UNIQUE KEY `professor_id_UNIQUE` (`professor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Professor`
--

LOCK TABLES `Professor` WRITE;
/*!40000 ALTER TABLE `Professor` DISABLE KEYS */;
INSERT INTO `Professor` (`professor_id`, `password`, `name`, `email`) VALUES (1,'111','GYC','xxx'),(2,'222','WQ','xxx'),(3,'333','HWQ','xxx');
/*!40000 ALTER TABLE `Professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Report`
--

DROP TABLE IF EXISTS `Report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Report` (
  `report_id` int(11) NOT NULL,
  `statement` varchar(100) NOT NULL,
  `vertify` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Report`
--

LOCK TABLES `Report` WRITE;
/*!40000 ALTER TABLE `Report` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sparetime`
--

DROP TABLE IF EXISTS `Sparetime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sparetime` (
  `classroom_id` varchar(5) NOT NULL,
  `week` int(11) NOT NULL,
  `mon` int(11) NOT NULL DEFAULT '0',
  `tue` int(11) NOT NULL DEFAULT '0',
  `wed` int(11) NOT NULL DEFAULT '0',
  `thu` int(11) NOT NULL DEFAULT '0',
  `fri` int(11) NOT NULL DEFAULT '0',
  `sat` int(11) NOT NULL DEFAULT '0',
  `sun` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`classroom_id`,`week`),
  CONSTRAINT `fk_sparetime_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `Classroom` (`classroom_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sparetime`
--

LOCK TABLES `Sparetime` WRITE;
/*!40000 ALTER TABLE `Sparetime` DISABLE KEYS */;
INSERT INTO `Sparetime` (`classroom_id`, `week`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `sun`) VALUES ('A101',1,32240,32255,32240,32240,32240,0,32240),('A101',2,32240,32240,32240,32240,32240,0,32240),('A101',3,32240,32240,32240,32240,32240,0,32240),('A101',4,32240,32240,32240,32240,32240,0,32240),('A101',5,32240,32240,32240,32240,32240,0,32240),('A101',6,32240,32240,32240,32240,32240,0,32240),('A101',7,32240,32240,32240,32240,32240,0,32240),('A101',8,32240,32240,32240,32240,32240,0,32240),('A101',9,32240,32240,32240,32240,32240,0,32240),('A101',10,32240,32240,32240,32240,32240,0,32240),('A101',11,32240,32240,32240,32240,32240,0,32240),('A101',12,32240,32240,32240,32240,32240,0,32240),('A101',13,32240,32240,32240,32240,32240,0,32240),('A101',14,32240,32240,32240,32240,32240,0,32240),('A101',15,32240,32240,32240,32240,32240,0,32240),('A101',16,32240,32240,32240,32240,32240,0,32240),('A101',17,32240,32240,32240,32240,32240,0,32240),('A101',18,32240,32240,32240,32240,32240,0,32240),('A101',19,32240,32240,32240,32240,32240,0,32240),('A101',20,32240,32240,32240,32240,32240,0,32240),('A202',1,32240,32240,32240,32240,32240,0,32240),('A202',2,32240,32240,32240,32240,32240,0,32240),('A202',3,32240,32240,32240,32240,32240,0,32240),('A202',4,32240,32240,32240,32240,32240,0,32240),('A202',5,32240,32240,32240,32240,32240,0,32240),('A202',6,32240,32240,32240,32240,32240,0,32240),('A202',7,32240,32240,32240,32240,32240,0,32240),('A202',8,32240,32240,32240,32240,32240,0,32240),('A202',9,32240,32240,32240,32240,32240,0,32240),('A202',10,32240,32240,32240,32240,32240,0,32240),('A202',11,32240,32240,32240,32240,32240,0,32240),('A202',12,32240,32240,32240,32240,32240,0,32240),('A202',13,32240,32240,32240,32240,32240,0,32240),('A202',14,32240,32240,32240,32240,32240,0,32240),('A202',15,32240,32240,32240,32240,32240,0,32240),('A202',16,32240,32240,32240,32240,32240,0,32240),('A202',17,32240,32240,32240,32240,32240,0,32240),('A202',18,32240,32240,32240,32240,32240,0,32240),('A202',19,32240,32240,32240,32240,32240,0,32240),('A202',20,32240,32240,32240,32240,32240,0,32240),('A203',1,32240,32255,32240,32240,32240,7168,32240),('A203',2,32240,32240,32240,32240,32240,0,32240),('A203',3,32240,32240,32240,32240,32240,0,32240),('A203',4,32240,32240,32240,32240,32240,0,32240),('A203',5,32240,32240,32240,32240,32240,0,32240),('A203',6,32240,32240,32240,32240,32240,0,32240),('A203',7,32240,32240,32240,32240,32240,0,32240),('A203',8,32240,32240,32240,32240,32240,0,32240),('A203',9,32240,32240,32240,32240,32240,0,32240),('A203',10,32240,32240,32240,32240,32240,0,32240),('A203',11,32240,32240,32240,32240,32240,0,32240),('A203',12,32240,32240,32240,32240,32240,0,32240),('A203',13,32240,32240,32240,32240,32240,0,32240),('A203',14,32240,32240,32240,32240,32240,0,32240),('A203',15,32240,32240,32240,32240,32240,0,32240),('A203',16,32240,32240,32240,32240,32240,0,32240),('A203',17,32240,32240,32240,32240,32240,0,32240),('A203',18,32240,32240,32240,32240,32240,0,32240),('A203',19,32240,32240,32240,32240,32240,0,32240),('A203',20,32240,32240,32240,32240,32240,0,32240),('B101',1,32240,32255,32240,32240,32240,0,32240),('B101',2,32240,32240,32240,32240,32240,0,32240),('B101',3,32240,32240,32240,32240,32240,0,32240),('B101',4,32240,32240,32240,32240,32240,0,32240),('B101',5,32240,32240,32240,32240,32240,0,32240),('B101',6,32240,32240,32240,32240,32240,0,32240),('B101',7,32240,32240,32240,32240,32240,0,32240),('B101',8,32240,32240,32240,32240,32240,0,32240),('B101',9,32240,32240,32240,32240,32240,0,32240),('B101',10,32240,32240,32240,32240,32240,0,32240),('B101',11,32240,32240,32240,32240,32240,0,32240),('B101',12,32240,32240,32240,32240,32240,0,32240),('B101',13,32240,32240,32240,32240,32240,0,32240),('B101',14,32240,32240,32240,32240,32240,0,32240),('B101',15,32240,32240,32240,32240,32240,0,32240),('B101',16,32240,32240,32240,32240,32240,0,32240),('B101',17,32240,32240,32240,32240,32240,0,32240),('B101',18,32240,32240,32240,32240,32240,0,32240),('B101',19,32240,32240,32240,32240,32240,0,32240),('B101',20,32240,32240,32240,32240,32240,0,32240);
/*!40000 ALTER TABLE `Sparetime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL DEFAULT '000',
  `name` varchar(30) NOT NULL,
  `grade` enum('1','2','3','4') NOT NULL,
  `major` varchar(100) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `student_id_UNIQUE` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student`
--

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
INSERT INTO `Student` (`student_id`, `password`, `name`, `grade`, `major`, `email`) VALUES (1,'111','gyc','3','sc','xxx'),(2,'222','wq','3','sc','xxx'),(3,'333','hyq','3','sc','xxx');
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student_course`
--

DROP TABLE IF EXISTS `Student_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Student_course` (
  `s_c_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`s_c_id`),
  UNIQUE KEY `s_c_id_UNIQUE` (`s_c_id`),
  KEY `fk_s_c_student_idx` (`student_id`),
  KEY `fk_s_c_course_idx` (`course_id`),
  CONSTRAINT `fk_s_c_course` FOREIGN KEY (`course_id`) REFERENCES `Course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_s_c_student` FOREIGN KEY (`student_id`) REFERENCES `Student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student_course`
--

LOCK TABLES `Student_course` WRITE;
/*!40000 ALTER TABLE `Student_course` DISABLE KEYS */;
/*!40000 ALTER TABLE `Student_course` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-24 10:50:04
