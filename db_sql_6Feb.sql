CREATE DATABASE  IF NOT EXISTS `devdrstud` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `devdrstud`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: devdrstud
-- ------------------------------------------------------
-- Server version	5.6.24

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
-- Table structure for table `advertisements`
--

DROP TABLE IF EXISTS `advertisements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `url_type` varchar(8) DEFAULT NULL,
  `url_target` varchar(6) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertisements`
--

LOCK TABLES `advertisements` WRITE;
/*!40000 ALTER TABLE `advertisements` DISABLE KEYS */;
INSERT INTO `advertisements` (`id`, `name`, `photo`, `ordering`, `url`, `url_type`, `url_target`, `status`) VALUES (1,'Ads1','2bfaa6769fd29edb8be4f3f3701f6cbd.jpg',1,'','Internal','_self','Active'),(2,'Ads2','331e26308194e93cdfc545ab1708a0a1.jpg',2,'','Internal','_self','Active'),(3,'Ads3','3778e5b590da1e691b86985d9636518f.jpg',3,'','Internal','_self','Active'),(4,'Ads4','0bdfeb82960f3057c8309c8a739cda84.jpg',4,'','Internal','_self','Active');
/*!40000 ALTER TABLE `advertisements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configurations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `domain_name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `meta_title` text,
  `meta_desc` text,
  `timezone` varchar(100) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `sms_notification` tinyint(1) DEFAULT NULL,
  `email_notification` tinyint(1) DEFAULT NULL,
  `guest_login` tinyint(1) DEFAULT NULL,
  `front_end` tinyint(1) DEFAULT NULL,
  `slides` tinyint(4) DEFAULT NULL,
  `translate` tinyint(4) DEFAULT '0',
  `paid_exam` tinyint(4) DEFAULT '1',
  `leader_board` tinyint(1) DEFAULT '1',
  `math_editor` tinyint(1) DEFAULT '0',
  `certificate` tinyint(1) DEFAULT '1',
  `contact` text,
  `email_contact` text,
  `currency` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `signature` varchar(100) DEFAULT NULL,
  `date_format` varchar(25) DEFAULT NULL,
  `exam_expiry` int(11) NOT NULL DEFAULT '1',
  `exam_feedback` tinyint(1) NOT NULL DEFAULT '1',
  `tolrance_count` int(1) DEFAULT NULL,
  `min_limit` int(11) DEFAULT NULL,
  `max_limit` int(11) DEFAULT NULL,
  `captcha_type` tinyint(4) DEFAULT NULL,
  `dir_type` tinyint(4) DEFAULT NULL,
  `language` varchar(6) DEFAULT NULL,
  `panel1` tinyint(1) DEFAULT '1',
  `panel2` tinyint(1) DEFAULT '1',
  `panel3` tinyint(1) DEFAULT '1',
  `ads` tinyint(1) DEFAULT '1',
  `testimonial` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configurations`
--

LOCK TABLES `configurations` WRITE;
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;
INSERT INTO `configurations` (`id`, `name`, `organization_name`, `domain_name`, `email`, `meta_title`, `meta_desc`, `timezone`, `author`, `sms_notification`, `email_notification`, `guest_login`, `front_end`, `slides`, `translate`, `paid_exam`, `leader_board`, `math_editor`, `certificate`, `contact`, `email_contact`, `currency`, `photo`, `signature`, `date_format`, `exam_expiry`, `exam_feedback`, `tolrance_count`, `min_limit`, `max_limit`, `captcha_type`, `dir_type`, `language`, `panel1`, `panel2`, `panel3`, `ads`, `testimonial`, `created`, `modified`) VALUES (1,'DEVDRSTUD','IZ-Intellizens','http://dev.drstud.com','asif.m@intellizens.com','Useful SEP','META SETP','America/Toronto','Exam Solution',0,1,0,1,1,0,0,1,0,1,'0000-0000~info@eduexpression.com~http://facebook.com','Phone : 0000000000 Email : demo@demo.com',21,'','871d157c9c20f5f1a7ae1ae0dfe2c41a.jpg','d,m,Y,h,i,s,A,-,:',1,1,3000,20,500,1,1,'en',1,1,1,0,1,'2014-04-08 20:56:04','2016-12-25 11:16:16');
/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `is_url` varchar(8) DEFAULT 'Internal',
  `url` varchar(255) DEFAULT NULL,
  `url_target` varchar(6) DEFAULT NULL,
  `main_content` longtext,
  `page_url` varchar(255) DEFAULT NULL,
  `cols` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT '1',
  `published` varchar(11) DEFAULT 'Published',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `short` varchar(3) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` (`id`, `name`, `short`, `photo`) VALUES (1,'Australia Dollar AUD','AUD','64238c6d767ab034b04c4681295567a0.gif'),(2,'Brunei Darussalam Dollar BND','BND','53e34059e7bfe4db945404e901c4f396.gif'),(3,'Cambodia Riel KHR','KHR','aaa57dd0012641cdee2c8d6484db8238.gif'),(4,'China Yuan Renminbi CNY ','CNY','5586a267c542d0f49b6c22c5c978bf23.gif'),(5,'Hong Kong Dollar HKD','HKD','200ec0145292d85b380d8c4f570f9aa9.gif'),(6,'India Rupee INR','INR','537f17a76864d11438d25ff5af7641a5.gif'),(7,'Indonesia Rupiah IDR','IDR','6d27b2f196ce9d74b10d12111d9838b0.gif'),(8,'Japan Yen JPY','JPY','3a7f86a61af62ddab4737f3df6db4807.gif'),(9,'Korea (North) Won KPW','KPW','cc0ad4a7ba48bedd9cf57bc4125fc2c9.gif'),(10,'Korea (South) Won KRW','KRW','28fdcdac33f7429afe6bce2e08dd47c2.gif'),(11,'Laos Kip LAK','LAK','f72da580f617ee32683202aeee564df0.gif'),(12,'Malaysia Ringgit MYR','MYR','e86af0a98bf7398c27a5ad30319d82ad.gif'),(13,'Nigeria Naira NGN','NGN','2cdb9ceeae309e948c6bd0a90e30ffec.gif'),(14,'Pakistan Rupee PKR','PKR','bac3525bb97f15f806a74d248f71d6b2.gif'),(15,'Philippines Peso PHP','PHP','c46c38e2701d3c3bd6ee442c93befd04.gif'),(16,'Singapore Dollar SGD','SGD','2c1e20836f56700b13a08477216a61fb.gif'),(17,'Sri Lanka Rupee LKR','LKR','38bb6c10813d0a1eb9c878bcea2b7570.gif'),(18,'Taiwan New Dollar TWD','TWD','a558976f34bf485cb72f61656595536c.gif'),(19,'Thailand Baht THB','THB','3c3bcc74de1fd038ec2d7e0dfe2965bf.gif'),(20,'United Kingdom Pound GBP','GBP','df773c6ce35993089139c888ec5a3210.gif'),(21,'United States Dollar USD','USD','ef1e801ee13715b41e55c16886597878.gif'),(22,'Viet Nam Dong VND','VND','5a5b143e1685239abd85f0b367d4669b.gif');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diffs`
--

DROP TABLE IF EXISTS `diffs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diffs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diff_level` varchar(15) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diffs`
--

LOCK TABLES `diffs` WRITE;
/*!40000 ALTER TABLE `diffs` DISABLE KEYS */;
INSERT INTO `diffs` (`id`, `diff_level`, `type`) VALUES (1,'Easy','E'),(2,'Medium','M'),(3,'Hard','D');
/*!40000 ALTER TABLE `diffs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emailsettings`
--

DROP TABLE IF EXISTS `emailsettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emailsettings` (
  `id` int(11) NOT NULL,
  `type` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `host` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `port` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emailsettings`
--

LOCK TABLES `emailsettings` WRITE;
/*!40000 ALTER TABLE `emailsettings` DISABLE KEYS */;
INSERT INTO `emailsettings` (`id`, `type`, `host`, `username`, `password`, `port`) VALUES (1,'Mail',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `emailsettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emailtemplates`
--

DROP TABLE IF EXISTS `emailtemplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emailtemplates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `status` varchar(11) DEFAULT 'Published',
  `type` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emailtemplates`
--

LOCK TABLES `emailtemplates` WRITE;
/*!40000 ALTER TABLE `emailtemplates` DISABLE KEYS */;
INSERT INTO `emailtemplates` (`id`, `name`, `description`, `status`, `type`) VALUES (1,'Student Registration','<p>Hi, $studentName</p><p>Your signup email: $email</p><p>Your password: $password</p><p>Please click the following link to finish up registration:</p><p><a href=\"$url\" target=\"_blank\">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','SRN'),(2,'Re-send Verification','<p>Hi, $studentName</p><p>Your signup email: $email</p><p>Please click the following link to finish up registration:</p><p><a href=\"$url\" target=\"_blank\">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','RVN'),(4,'Student Forgot Password','<p>Dear $studentName,</p><p>Please click the following link to finish forgot password:</p><p><a href=\"$url\" target=\"_blank\">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','SFP'),(5,'Admin Forgot Password','<p>Dear $name,</p><p>Please click the following link to finish forgot password:</p><p><a href=\"$url\" target=\"_blank\">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','AFP'),(6,'Admin Forgot Username','<p>Dear $name,</p><p>You have forgot User Name. your username is $userName</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','AFU'),(7,'Student Login Credentials','<p>Dear $studentName,</p><p>Congratulations! Your $siteName account is now active.</p><p>Email Address : $email</p><p>Password: $password</p><p>If you need, you can reset your password at any time.</p><p>To get started, log on:<a href=\"$url\" target=\"_blank\">$url</a></p><p>If you have any questions or need assistance, please contact us.</p><p> </p><p>Best Regards,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','SLC'),(8,'User Login Credentials','<p>Dear $name,</p><p>Congratulations! Your $siteName account is now active.</p><p>Email Address : $email</p><p>Username : $userName</p><p>Password: $password</p><p>If you need, you can reset your password at any time.</p><p>To get started, log on:<a href=\"$url\" target=\"_blank\">$url</a></p><p>If you have any questions or need assistance, please contact us.</p><p> </p><p>Best Regards,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','ULC'),(9,'Exam Activation','<p>Dear $studentName,</p><p>Exam Name $examName Type $type is active and start on $startDate end on $endDate</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','EAN'),(10,'Exam Finalized','<p>Dear $studentName,</p><p>Name: $examName</p><p>Result: $result</p><p>Rank: $rank</p><p>Obtained Marks: $obtainedMarks</p><p>Question Attempt: $questionAttempt</p><p>Time Taken: $timeTaken</p><p>Percentage: $percent</p><p> </p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','EFD'),(11,'Exam Result','<p>Dear $studentName,</p><p>Name: $examName</p><p>Result: $result</p><p>Obtained Marks: $obtainedMarks</p><p>Question Attempt: $questionAttempt</p><p>Time Taken: $timeTaken</p><p>Percentage: $percent %</p><p> </p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','ERT'),(12,'Package Purchased','<p>Dear $studentName,</p><p>We thank you for choosing $siteName for your career, professional and educational needs.</p><p>Your group details are as follows:-</p><p>$packageDetail</p><p><strong>Total Amount: <img src=\"http://192.168.1.100:88/exam/order2004/img/currencies/ef1e801ee13715b41e55c16886597878.gif\" alt=\"\" width=\"9\" height=\"16\" /> $totalAmount</strong></p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>','Published','PPD');
/*!40000 ALTER TABLE `emailtemplates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_feedbacks`
--

DROP TABLE IF EXISTS `exam_feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_result_id` int(11) NOT NULL,
  `comments` mediumtext,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `exam_result_id` (`exam_result_id`),
  CONSTRAINT `exam_feedbacks_ibfk_1` FOREIGN KEY (`exam_result_id`) REFERENCES `exam_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_feedbacks`
--

LOCK TABLES `exam_feedbacks` WRITE;
/*!40000 ALTER TABLE `exam_feedbacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_feedbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_groups`
--

DROP TABLE IF EXISTS `exam_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `exam_groups_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_groups`
--

LOCK TABLES `exam_groups` WRITE;
/*!40000 ALTER TABLE `exam_groups` DISABLE KEYS */;
INSERT INTO `exam_groups` (`id`, `exam_id`, `group_id`) VALUES (3,1,2),(4,1,4),(5,1,1);
/*!40000 ALTER TABLE `exam_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_maxquestions`
--

DROP TABLE IF EXISTS `exam_maxquestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_maxquestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `max_question` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `exam_maxquestions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_maxquestions_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_maxquestions`
--

LOCK TABLES `exam_maxquestions` WRITE;
/*!40000 ALTER TABLE `exam_maxquestions` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_maxquestions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_orders`
--

DROP TABLE IF EXISTS `exam_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `exam_orders_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_orders_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_orders`
--

LOCK TABLES `exam_orders` WRITE;
/*!40000 ALTER TABLE `exam_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_preps`
--

DROP TABLE IF EXISTS `exam_preps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_preps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `ques_no` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `exam_preps_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_preps_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_preps`
--

LOCK TABLES `exam_preps` WRITE;
/*!40000 ALTER TABLE `exam_preps` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_preps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_questions`
--

DROP TABLE IF EXISTS `exam_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `exam_questions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_questions`
--

LOCK TABLES `exam_questions` WRITE;
/*!40000 ALTER TABLE `exam_questions` DISABLE KEYS */;
INSERT INTO `exam_questions` (`id`, `exam_id`, `question_id`) VALUES (2,1,6),(3,1,5),(4,1,4),(5,1,3),(6,1,2),(7,1,1);
/*!40000 ALTER TABLE `exam_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_results`
--

DROP TABLE IF EXISTS `exam_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `resume_time` int(11) DEFAULT NULL,
  `total_question` int(11) DEFAULT NULL,
  `total_attempt` int(11) DEFAULT NULL,
  `total_answered` int(11) DEFAULT NULL,
  `total_marks` decimal(5,2) DEFAULT NULL,
  `obtained_marks` decimal(5,2) DEFAULT NULL,
  `result` varchar(10) DEFAULT NULL,
  `percent` decimal(5,2) DEFAULT NULL,
  `finalized_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `exam_results_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_results_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_results`
--

LOCK TABLES `exam_results` WRITE;
/*!40000 ALTER TABLE `exam_results` DISABLE KEYS */;
INSERT INTO `exam_results` (`id`, `exam_id`, `student_id`, `start_time`, `end_time`, `resume_time`, `total_question`, `total_attempt`, `total_answered`, `total_marks`, `obtained_marks`, `result`, `percent`, `finalized_time`, `user_id`) VALUES (1,1,1,'2017-01-03 14:03:55','2017-01-03 14:04:05',NULL,6,6,0,24.00,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `exam_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_stats`
--

DROP TABLE IF EXISTS `exam_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_result_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `ques_no` int(11) DEFAULT NULL,
  `options` varchar(30) DEFAULT NULL,
  `attempt_time` datetime DEFAULT NULL,
  `opened` char(1) DEFAULT '0',
  `answered` char(1) DEFAULT '0',
  `review` char(1) DEFAULT '0',
  `option_selected` varchar(15) DEFAULT NULL,
  `answer` text,
  `true_false` varchar(5) DEFAULT NULL,
  `fill_blank` text,
  `correct_answer` text,
  `marks` decimal(5,2) DEFAULT NULL,
  `marks_obtained` decimal(5,2) DEFAULT NULL,
  `ques_status` char(1) DEFAULT NULL,
  `closed` char(1) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `checking_time` datetime DEFAULT NULL,
  `time_taken` int(11) DEFAULT NULL,
  `bookmark` char(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`),
  KEY `student_id` (`student_id`),
  KEY `question_id` (`question_id`),
  KEY `exam_result_id` (`exam_result_id`),
  CONSTRAINT `exam_stats_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_stats_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_stats_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `exam_stats_ibfk_4` FOREIGN KEY (`exam_result_id`) REFERENCES `exam_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_stats`
--

LOCK TABLES `exam_stats` WRITE;
/*!40000 ALTER TABLE `exam_stats` DISABLE KEYS */;
INSERT INTO `exam_stats` (`id`, `exam_result_id`, `exam_id`, `student_id`, `question_id`, `ques_no`, `options`, `attempt_time`, `opened`, `answered`, `review`, `option_selected`, `answer`, `true_false`, `fill_blank`, `correct_answer`, `marks`, `marks_obtained`, `ques_status`, `closed`, `user_id`, `checking_time`, `time_taken`, `bookmark`, `created`, `modified`) VALUES (1,1,1,1,1,1,'5,1,2,4,6,3','2017-01-03 14:03:55','1','0','0',NULL,NULL,NULL,NULL,'2',4.00,NULL,NULL,'1',NULL,NULL,10,NULL,'2017-01-03 14:03:56','2017-01-03 14:04:05'),(2,1,1,1,2,2,'3,1,2,4,5,6',NULL,'0','0','0',NULL,NULL,NULL,NULL,'2',4.00,NULL,NULL,'1',NULL,NULL,NULL,NULL,'2017-01-03 14:03:56','2017-01-03 14:03:56'),(3,1,1,1,5,3,'3,4,6,2,1,5',NULL,'0','0','0',NULL,NULL,NULL,NULL,'3',4.00,NULL,NULL,'1',NULL,NULL,NULL,NULL,'2017-01-03 14:03:56','2017-01-03 14:03:56'),(4,1,1,1,6,4,'3,5,6,1,2,4',NULL,'0','0','0',NULL,NULL,NULL,NULL,'3',4.00,NULL,NULL,'1',NULL,NULL,NULL,NULL,'2017-01-03 14:03:56','2017-01-03 14:03:56'),(5,1,1,1,3,5,'4,2,5,3,6,1',NULL,'0','0','0',NULL,NULL,NULL,NULL,'2',4.00,NULL,NULL,'1',NULL,NULL,NULL,NULL,'2017-01-03 14:03:56','2017-01-03 14:03:56'),(6,1,1,1,4,6,'4,1,5,6,2,3',NULL,'0','0','0',NULL,NULL,NULL,NULL,'3',4.00,NULL,NULL,'1',NULL,NULL,NULL,NULL,'2017-01-03 14:03:56','2017-01-03 14:03:56');
/*!40000 ALTER TABLE `exam_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_warns`
--

DROP TABLE IF EXISTS `exam_warns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_warns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_result_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_result_id` (`exam_result_id`),
  CONSTRAINT `exam_warns_ibfk_1` FOREIGN KEY (`exam_result_id`) REFERENCES `exam_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_warns`
--

LOCK TABLES `exam_warns` WRITE;
/*!40000 ALTER TABLE `exam_warns` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_warns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `instruction` text,
  `duration` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `passing_percent` int(11) DEFAULT NULL,
  `negative_marking` varchar(3) DEFAULT NULL,
  `attempt_count` int(11) DEFAULT NULL,
  `declare_result` varchar(3) DEFAULT 'Yes',
  `finish_result` char(1) DEFAULT '0',
  `ques_random` char(1) DEFAULT '0',
  `paid_exam` char(1) DEFAULT '0',
  `browser_tolrance` char(1) DEFAULT '1',
  `instant_result` char(1) NOT NULL DEFAULT '0',
  `option_shuffle` char(1) DEFAULT '1',
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'Inactive',
  `type` varchar(10) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `expiry` int(11) DEFAULT '0',
  `finalized_time` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson_id` (`lesson_id`),
  KEY `subject_id` (`subject_id`),
  KEY `lesson_id_2` (`lesson_id`),
  CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  CONSTRAINT `exams_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exams`
--

LOCK TABLES `exams` WRITE;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
INSERT INTO `exams` (`id`, `name`, `subject_id`, `lesson_id`, `instruction`, `duration`, `start_date`, `end_date`, `passing_percent`, `negative_marking`, `attempt_count`, `declare_result`, `finish_result`, `ques_random`, `paid_exam`, `browser_tolrance`, `instant_result`, `option_shuffle`, `amount`, `status`, `type`, `user_id`, `expiry`, `finalized_time`, `created`, `modified`) VALUES (1,'Fiit JEE Exam 1',2,1,'Demo',0,'2016-08-03 12:00:00','2017-02-23 12:00:00',30,'Yes',0,'Yes','0','0','0','1','0','1',NULL,'Active','Exam',0,NULL,NULL,'2016-08-08 19:26:49','2016-11-03 18:28:04');
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_name` (`group_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `group_name`, `description`, `price`, `day`, `photo`, `created`, `modified`) VALUES (1,'IIT','',10.00,3,NULL,'2015-11-09 18:19:44','2016-03-21 16:57:05'),(2,'CPMT',NULL,32.00,4,NULL,'2015-11-09 18:19:47','2016-03-15 15:42:30'),(3,'CAT','',0.00,201,NULL,'2016-03-11 15:48:33','2016-12-25 11:13:46'),(4,'FIIT-JEE','Demo Is Best',0.00,30,'6b474b730e5118afdaef7ed5f1b2ba56.jpg','2016-03-15 14:52:12','2016-03-18 11:01:51'),(5,'DRStudents','',0.00,0,NULL,'2017-01-04 19:16:05','2017-01-04 19:16:05');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_payments`
--

DROP TABLE IF EXISTS `groups_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `expiry_days` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `last_payment_date` varchar(50) DEFAULT NULL,
  `status` varchar(8) DEFAULT 'Approved',
  PRIMARY KEY (`id`),
  KEY `payment_id` (`payment_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `groups_payments_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `groups_payments_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_payments`
--

LOCK TABLES `groups_payments` WRITE;
/*!40000 ALTER TABLE `groups_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpcontents`
--

DROP TABLE IF EXISTS `helpcontents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helpcontents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_title` varchar(255) DEFAULT NULL,
  `link_desc` longtext,
  `status` varchar(8) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpcontents`
--

LOCK TABLES `helpcontents` WRITE;
/*!40000 ALTER TABLE `helpcontents` DISABLE KEYS */;
INSERT INTO `helpcontents` (`id`, `link_title`, `link_desc`, `status`, `created`, `modified`) VALUES (1,'Help 1','<p>Suspendisse mattis magna augue, sed pretium lacus pellentesque nec. Nullam tincidunt lacinia urna sit amet tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras consequat justo ac diam aliquet adipiscing. Ut orci nibh, viverra quis luctus id, lacinia quis purus. Vestibulum pharetra diam non nulla pretium scelerisque. Fusce posuere tellus vel mollis auctor.</p>','Active','2014-12-19 14:45:19','2015-10-26 11:52:48'),(2,'Help2','<p>Aenean pretium nunc lectus, quis viverra metus accumsan vestibulum. Mauris vulputate urna nec leo viverra, at dictum nulla suscipit. Sed id pretium lectus, vitae egestas turpis. Quisque metus tortor, tristique in diam sit amet, suscipit facilisis augue. Nunc vel leo vitae ligula auctor tristique ut nec tortor. Aliquam nibh ligula, tristique non pharetra in, congue ac sem. Donec odio nulla, lobortis vitae risus in, porttitor pretium mauris. Nullam fringilla tortor eu quam luctus, eget bibendum lectus eleifend. Nam facilisis libero tempor rhoncus consequat.</p>','Active','2014-12-19 14:45:43','2015-11-09 16:56:24');
/*!40000 ALTER TABLE `helpcontents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `status` varchar(10) DEFAULT 'Active',
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` (`id`, `subject_id`, `name`, `description`, `status`, `ordering`) VALUES (1,2,'Periodic Table','<p>1<iframe title=\"\" src=\"http://www.youtube.com/embed/hfTjXYUXd2c?wmode=opaque&amp;theme=dark\" width=\"640\" height=\"385\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></p>','Active',1),(2,4,'Lesson1','<p><video width=\"300\" height=\"150\" controls=\"controls\">\r\n<source src=\"/img/Uploads/flowhub-201405-720.mp4\" type=\"video/mp4\" />\r\n</video>New Lesson</p>','Active',NULL),(3,6,'Phonics_Lesson1','<p><video width=\"300\" height=\"150\" controls=\"controls\">\r\n<source src=\"/img/Uploads/flowhub-201405-720.mp4\" type=\"video/mp4\" />\r\n</video></p>','Active',NULL);
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mails`
--

DROP TABLE IF EXISTS `mails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(100) DEFAULT NULL,
  `from_email` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` longtext,
  `date` datetime DEFAULT NULL,
  `status` varchar(5) DEFAULT 'Live',
  `type` varchar(10) DEFAULT 'Unread',
  `mail_type` varchar(4) DEFAULT 'To',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mails`
--

LOCK TABLES `mails` WRITE;
/*!40000 ALTER TABLE `mails` DISABLE KEYS */;
INSERT INTO `mails` (`id`, `to_email`, `from_email`, `email`, `subject`, `message`, `date`, `status`, `type`, `mail_type`) VALUES (1,'student@student.com','Administrator','student@student.com','Demo Subject','Demo Content','2015-02-24 18:33:49','Live','Read','To'),(2,'student@student.com','Administrator','Administrator','Demo Subject','Demo Content','2015-02-24 18:33:49','Live','Read','From'),(3,'Administrator','student@student.com','Administrator','Demo Subject','Demo Content User','2015-02-24 18:34:49','Live','Read','To'),(4,'Administrator','student@student.com','student@student.com','Demo Subject','Demo Content User','2015-02-24 18:34:49','Live','Read','From');
/*!40000 ALTER TABLE `mails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) DEFAULT NULL,
  `news_desc` longtext,
  `status` varchar(7) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `news_title`, `news_desc`, `status`, `created`, `modified`) VALUES (1,'Lorem ipsum dolor sit amet','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis eleifend ligula. Cras porttitor accumsan arcu. Morbi id arcu scelerisque dolor condimentum viverra vel sit amet magna. Donec nunc elit, sodales a neque et, rutrum tincidunt leo. Cras id risus sed est vehicula consequat. Morbi in vehicula nunc, nec sodales magna. Integer convallis viverra massa eget varius. Ut eu scelerisque ante. Duis venenatis quam turpis, tincidunt suscipit velit varius ut. In hac habitasse platea dictumst. Mauris ut elit sed erat hendrerit feugiat a gravida lorem. Nulla ut eleifend sem.</p>','Active','2014-12-19 14:44:09','2015-10-26 11:44:22'),(2,'Sed in leo vel justo commodo facilisis ac gravida','<p>Sed  in leo vel justo commodo facilisis ac gravida risus. Cras arcu lectus, malesuada in tincidunt id, faucibus quis leo. Curabitur tincidunt ac turpis at auctor. Cras rhoncus lorem id augue blandit pulvinar. Sed adipiscing posuere nunc non ornare. Quisque accumsan purus nibh, rhoncus rutrum justo ornare eget. Suspendisse mollis libero nec tempus eleifend. Sed nec lacus sit amet mauris faucibus tempus vel non justo. Donec sit amet metus a nisl congue sagittis. Duis quis turpis elementum, volutpat massa sed, dictum mi. Fusce non tincidunt metus, et facilisis libero. Etiam in interdum sem, non accumsan justo.</p>','Active','2014-12-19 14:44:58','2015-11-07 13:39:17');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_rights`
--

DROP TABLE IF EXISTS `page_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `ugroup_id` int(11) NOT NULL,
  `save_right` int(1) DEFAULT NULL,
  `update_right` int(1) DEFAULT NULL,
  `view_right` int(1) DEFAULT NULL,
  `search_right` int(1) DEFAULT NULL,
  `delete_right` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  KEY `ugroup_id` (`ugroup_id`),
  CONSTRAINT `page_rights_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `page_rights_ibfk_2` FOREIGN KEY (`ugroup_id`) REFERENCES `ugroups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_rights`
--

LOCK TABLES `page_rights` WRITE;
/*!40000 ALTER TABLE `page_rights` DISABLE KEYS */;
INSERT INTO `page_rights` (`id`, `page_id`, `ugroup_id`, `save_right`, `update_right`, `view_right`, `search_right`, `delete_right`) VALUES (114,1,2,1,1,1,1,1),(115,5,2,1,1,1,1,1),(116,3,2,1,1,1,1,1),(117,6,2,1,1,1,1,1),(118,11,2,0,0,1,0,0),(119,9,2,0,0,1,0,0),(120,21,2,1,1,1,1,1),(121,18,2,1,1,1,1,1),(122,19,2,1,1,1,1,1),(123,7,2,1,1,1,1,1),(124,4,2,0,0,1,1,0),(125,39,2,1,1,1,1,1);
/*!40000 ALTER TABLE `page_rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(100) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `controller_name` varchar(100) DEFAULT NULL,
  `action_name` varchar(100) DEFAULT NULL,
  `icon` varchar(30) DEFAULT NULL,
  `parent_id` int(1) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `published` varchar(3) DEFAULT 'Yes',
  `sel_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `model_name`, `page_name`, `controller_name`, `action_name`, `icon`, `parent_id`, `ordering`, `published`, `sel_name`) VALUES (1,'Dashboard','Dashboard','Dashboards','index','fa fa-dashboard fa-fw',0,1,'Yes',NULL),(2,'Subject','Subjects','Subjects','index','fa fa-book fa-fw',0,4,'Yes',NULL),(3,'Quiz','Add Question','Addquestions','add','',2,66,'No',NULL),(4,'Students','Students','Students','index','fa fa-graduation-cap fa-fw',0,8,'Yes','Iestudents'),(5,'Quiz','Quiz','Exams','index','fa fa-list-alt fa-fw',0,6,'Yes','Attemptedpapers,Addquestions'),(6,'Quiz','Attempted Papers','Attemptedpapers','index','',5,67,'No',NULL),(7,'Result','Results','Results','index','fa fa-trophy fa-fw',0,7,'Yes',NULL),(8,'Configuration','Configurations',NULL,NULL,'fa fa-wrench fa-fw',0,10,'Yes',NULL),(9,'Help','Help','Helps','index','fa fa-support fa-fw',0,11,'No',NULL),(10,'User/Teacher','Users/Teachers','Users','index','fa fa-user fa-fw',0,3,'Yes',NULL),(11,'Group','Groups','Groups','index','fa fa-users fa-fw',0,2,'Yes',NULL),(12,'Content','Contents',NULL,NULL,'fa fa-newspaper-o fa-fw',0,11,'Yes',NULL),(13,'Contents','Slides','Slides','index','',12,3,'Yes',NULL),(14,'Configuration','Organisation Logo','Weblogos','index','',8,4,'Yes',NULL),(15,'Content','News','News','index','',12,1,'Yes',NULL),(17,'Content','Help Content','Helpcontents','index','',12,5,'Yes',NULL),(18,'Question','Questions','Questions','index','fa fa-question fa-fw',0,5,'Yes','Iequestions'),(19,'Question','Question Import/Export','Iequestions','index','',18,99,'No',NULL),(20,'Configuration','Paypal Payment','Payments','index','',8,2,'Yes',NULL),(21,'Mailbox','Mailbox','Mails','index','fa fa-envelope fa-fw',0,9,'Yes',NULL),(22,'Student','Student Import/Export','Iestudents','index','',4,99,'No',NULL),(23,'Configuration','General','Configurations','index',NULL,8,1,'Yes',NULL),(24,'Configuration','Currency','Currencies','index',NULL,8,3,'Yes',NULL),(25,'Content','Testimonial','Testimonials','index',NULL,12,6,'Yes',NULL),(26,'Content','Advertisement','Advertisements','index',NULL,12,7,'Yes',NULL),(27,'Content','Pages','Contents','pages',NULL,12,2,'Yes',NULL),(28,'Configuration','Certificate Signature','Signatures','index',NULL,8,5,'Yes',NULL),(29,'DiffcultyLevel','Diffculty Level','Diffs','index',NULL,8,6,'Yes',NULL),(30,'QuestionType','Question Type','qtypes','index','',8,7,'Yes',NULL),(31,'Menuname','Menu Name','Menunames','index',NULL,8,8,'Yes',NULL),(32,'Email & SMS','Email & SMS',NULL,NULL,'fa fa-shield',0,12,'Yes',NULL),(33,'Email & SMS','Email Setting','Emailsettings','index',NULL,32,1,'Yes',NULL),(34,'Email & SMS','Email Templates','Emailtemplates','index',NULL,32,2,'Yes',NULL),(35,'Email & SMS','Send Emails','Sendemails','index',NULL,32,3,'Yes',NULL),(36,'Email & SMS','SMS Setting','Smssettings','index',NULL,32,4,'Yes',NULL),(37,'Email & SMS','SMS Templates','Smstemplates',NULL,'index',32,5,'Yes',NULL),(38,'Email & SMS','Send SMS','Sendsms','index',NULL,32,6,'Yes',NULL),(39,'Subject','Lesson','Lessons','index','fa fa-list',0,4,'Yes',NULL);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `transaction_id` varchar(20) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `correlation_id` varchar(50) DEFAULT NULL,
  `timestamp` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Pending',
  `date` datetime DEFAULT NULL,
  `type` varchar(13) DEFAULT NULL,
  `payment_type` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paypal_configs`
--

DROP TABLE IF EXISTS `paypal_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paypal_configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `sandbox_mode` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paypal_configs`
--

LOCK TABLES `paypal_configs` WRITE;
/*!40000 ALTER TABLE `paypal_configs` DISABLE KEYS */;
INSERT INTO `paypal_configs` (`id`, `username`, `password`, `signature`, `sandbox_mode`) VALUES (1,'','','',0);
/*!40000 ALTER TABLE `paypal_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qtypes`
--

DROP TABLE IF EXISTS `qtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_type` varchar(20) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qtypes`
--

LOCK TABLES `qtypes` WRITE;
/*!40000 ALTER TABLE `qtypes` DISABLE KEYS */;
INSERT INTO `qtypes` (`id`, `question_type`, `type`) VALUES (1,'Objective','M'),(2,'True / False','T'),(3,'Fill in the blanks','F'),(4,'Subjective','S');
/*!40000 ALTER TABLE `qtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_groups`
--

DROP TABLE IF EXISTS `question_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `question_groups_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `question_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_groups`
--

LOCK TABLES `question_groups` WRITE;
/*!40000 ALTER TABLE `question_groups` DISABLE KEYS */;
INSERT INTO `question_groups` (`id`, `question_id`, `group_id`) VALUES (1,1,2),(2,1,1),(5,3,2),(6,3,1),(7,4,2),(8,4,1),(9,2,2),(10,2,1),(11,5,1),(13,6,1),(28,15,5),(29,16,5),(31,17,5);
/*!40000 ALTER TABLE `question_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qtype_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `diff_id` int(11) NOT NULL,
  `question` text,
  `option1` text,
  `option2` text,
  `option3` text,
  `option4` text,
  `option5` text,
  `option6` text,
  `marks` decimal(5,2) DEFAULT NULL,
  `negative_marks` decimal(5,2) DEFAULT NULL,
  `hint` text,
  `explanation` text,
  `answer` varchar(15) DEFAULT NULL,
  `true_false` varchar(5) DEFAULT NULL,
  `fill_blank` text,
  `status` varchar(3) DEFAULT 'Yes',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `category` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qtype_id` (`qtype_id`),
  KEY `subject_id` (`subject_id`),
  KEY `diff_id` (`diff_id`),
  CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `questions_ibfk_3` FOREIGN KEY (`qtype_id`) REFERENCES `qtypes` (`id`),
  CONSTRAINT `questions_ibfk_4` FOREIGN KEY (`diff_id`) REFERENCES `diffs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`id`, `qtype_id`, `subject_id`, `diff_id`, `question`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `marks`, `negative_marks`, `hint`, `explanation`, `answer`, `true_false`, `fill_blank`, `status`, `created`, `modified`, `category`) VALUES (1,1,2,1,'The mass number of a nucleus is','always less than its atomic number','the sum of the number of protons and neutrons present in the nucleus','always more than the atomic weight','a fraction','','',4.00,1.00,'','No answer description available for this question.','2',NULL,'','Yes','2015-11-09 18:24:53','2015-11-09 18:24:53',NULL),(2,1,2,2,'The material which can be deformed permanently by heat and pressure is called a','thermoplastic','thermoset','chemical compound','polymer','','',4.00,1.00,'','','2',NULL,NULL,'Yes','2015-11-09 18:25:41','2015-11-09 18:29:03',NULL),(3,1,1,1,'Identify the vector quantity from the following','Heat','Angular momentum','Time','Work','','',4.00,1.00,'','','2',NULL,'','Yes','2015-11-09 18:27:48','2015-11-09 18:27:48',NULL),(4,1,1,3,'Natural radioactivity was discovered by','Marie Curie','Ernest Rutherfor','Henri Becquerel','Enrico Fermi','','',4.00,1.00,'','','3',NULL,'','Yes','2015-11-09 18:28:48','2015-11-09 18:28:48',NULL),(5,1,3,1,'The percentage increase in the area of a rectangle, if each of its sides is increased by 20% is:','40%','42%','44%','46%','','',4.00,1.00,'','','3',NULL,'','Yes','2015-11-09 18:31:53','2015-11-09 18:31:53',NULL),(6,1,3,3,'Find the odd man out.\r\n10, 25, 45, 54, 60, 75, 80','10','45','54','75','','',4.00,1.00,'','Each of the numbers except 54 is multiple of 5.','3',NULL,NULL,'Yes','2015-11-09 18:33:51','2015-11-17 19:02:52',NULL),(15,1,7,1,'What is the meaning of irksome? ','Friendly\r\n','Handsome','Disagreeable','','','',0.00,0.00,'','','3',NULL,'','Yes','2017-01-04 19:18:00','2017-01-04 19:18:00','Homework'),(16,1,7,2,'what is many choices','choice 1','choice 2','choice 3','choice 4','','',0.00,0.00,'','','1,2,3,4',NULL,'','Yes','2017-01-17 18:49:40','2017-01-17 18:49:40','Homework'),(17,1,8,1,'What is a question for typing practice','Option 2','Option 3','Option 4','Option 5','Option 6','',0.00,0.00,'','','3',NULL,NULL,'Yes','2017-02-01 20:17:41','2017-02-01 20:19:01','Homework');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_name` varchar(255) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slides`
--

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
INSERT INTO `slides` (`id`, `slide_name`, `ordering`, `photo`, `dir`, `status`, `created`, `modified`) VALUES (1,'Slide1',1,'d96b90f325f1ebae362cec34ead77f65.jpg','','Active','2014-12-19 14:42:37','2015-11-03 12:37:54');
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smssettings`
--

DROP TABLE IF EXISTS `smssettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smssettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `senderid` varchar(10) DEFAULT NULL,
  `husername` varchar(100) DEFAULT NULL,
  `hpassword` varchar(100) DEFAULT NULL,
  `hsenderid` varchar(100) DEFAULT NULL,
  `hmobile` varchar(100) DEFAULT NULL,
  `hmessage` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smssettings`
--

LOCK TABLES `smssettings` WRITE;
/*!40000 ALTER TABLE `smssettings` DISABLE KEYS */;
INSERT INTO `smssettings` (`id`, `api`, `username`, `password`, `senderid`, `husername`, `hpassword`, `hsenderid`, `hmobile`, `hmessage`) VALUES (1,'','','','','','','','','');
/*!40000 ALTER TABLE `smssettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smstemplates`
--

DROP TABLE IF EXISTS `smstemplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smstemplates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `status` varchar(11) DEFAULT 'Published',
  `type` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smstemplates`
--

LOCK TABLES `smstemplates` WRITE;
/*!40000 ALTER TABLE `smstemplates` DISABLE KEYS */;
INSERT INTO `smstemplates` (`id`, `name`, `description`, `status`, `type`) VALUES (1,'Student Registration','Hi, $studentName Email: $email Password: $password Website: $url Verification Code: $code Sincerely, $siteName','Published','SRN'),(2,'Re-send Verification','Hi, $studentName Email: $email Website: $url Verification Code: $code Sincerely, $siteName','Published','RVN'),(4,'Student Forgot Password','Dear $studentName, Website: $url Verification Code: $code Sincerely, $siteName','Published','SFP'),(5,'Admin Forgot Password','Dear $name, Website: $url Verification Code: $code Sincerely, $siteName','Published','AFP'),(6,'Admin Forgot Username','Dear $name, You have forgot User Name. Your username is $userName Sincerely, $siteName','Published','AFU'),(7,'Student Login Credentials','Dear $studentName, Your $siteName account is now active. Email: $email Password: $password Website:$url Best Regards, $siteName','Published','SLC'),(8,'User Login Credentials','Dear $name, Your $siteName account is now active. Email: $email Uername: $userName Password: $password Website:$url Best Regards, $siteName','Published','ULC'),(9,'Exam Activation','Dear $studentName, Exam Name $examName Type $type is active and start on $startDate end on $endDate Sincerely, $siteName','Published','EAN'),(10,'Exam Finalized','Dear $studentName, Name: $examName Result: $result Rank: $rank Obtained Marks: $obtainedMarks Question Attempt: $questionAttempt Time Taken: $timeTaken Percentage: $percent % Sincerely, $siteName','Published','EFD'),(11,'Exam Result','Dear $studentName, Name: $examName Result: $result Obtained Marks: $obtainedMarks Question Attempt: $questionAttempt Time Taken: $timeTaken Percentage: $percent % Sincerely, $siteName','Published','ERT'),(12,'Package Purchased','Dear, $studentName $packageDetail, Total Amount:  $totalAmount Sincerely, $siteName','Published','PPD');
/*!40000 ALTER TABLE `smstemplates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_groups`
--

DROP TABLE IF EXISTS `student_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`,`group_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `student_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_groups_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_groups`
--

LOCK TABLES `student_groups` WRITE;
/*!40000 ALTER TABLE `student_groups` DISABLE KEYS */;
INSERT INTO `student_groups` (`id`, `student_id`, `group_id`, `date`, `expiry_date`) VALUES (5,1,5,NULL,NULL);
/*!40000 ALTER TABLE `student_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `guardian_phone` varchar(15) DEFAULT NULL,
  `enroll` varchar(50) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Pending',
  `reg_code` varchar(6) DEFAULT NULL,
  `reg_status` varchar(4) DEFAULT 'Live',
  `expiry_days` int(11) DEFAULT NULL,
  `renewal_date` date DEFAULT NULL,
  `presetcode` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `auto_renewal` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `presetcode` (`presetcode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`id`, `email`, `password`, `name`, `address`, `phone`, `guardian_phone`, `enroll`, `photo`, `status`, `reg_code`, `reg_status`, `expiry_days`, `renewal_date`, `presetcode`, `created`, `modified`, `last_login`, `auto_renewal`) VALUES (1,'student@student.com','e41f2b7320732d52cbc55c70a7e96844259d512d9087dde5ff830723b2aa82dc','Demo Student','Demo Address','000000000','','1234',NULL,'Active','','Done',0,'2015-11-09',NULL,'2015-11-09 18:35:38','2017-02-06 19:22:14','2017-02-06 19:22:14',NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_lessons`
--

DROP TABLE IF EXISTS `students_lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students_lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`,`lesson_id`),
  KEY `student_id_2` (`student_id`),
  KEY `lesson_id` (`lesson_id`),
  CONSTRAINT `students_lessons_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `students_lessons_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_lessons`
--

LOCK TABLES `students_lessons` WRITE;
/*!40000 ALTER TABLE `students_lessons` DISABLE KEYS */;
INSERT INTO `students_lessons` (`id`, `student_id`, `lesson_id`, `status`) VALUES (1,1,2,'Pending');
/*!40000 ALTER TABLE `students_lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject_groups`
--

DROP TABLE IF EXISTS `subject_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `subject_groups_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subject_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_groups`
--

LOCK TABLES `subject_groups` WRITE;
/*!40000 ALTER TABLE `subject_groups` DISABLE KEYS */;
INSERT INTO `subject_groups` (`id`, `subject_id`, `group_id`) VALUES (1,1,2),(2,1,1),(5,3,1),(8,2,2),(9,2,1),(12,5,4),(13,4,3),(14,4,2),(19,7,5),(20,6,5),(22,8,5);
/*!40000 ALTER TABLE `subject_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subject_name` (`subject_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` (`id`, `subject_name`, `created`, `modified`) VALUES (1,'Physics','2015-11-09 18:20:46','2015-11-09 18:20:46'),(2,'Chemistry','2015-11-09 18:20:58','2015-11-30 17:20:20'),(3,'Maths','2015-11-09 18:21:05','2015-11-09 18:21:05'),(4,'Accounts','2016-03-11 15:49:07','2016-12-25 13:06:34'),(5,'Mental Ability','2016-03-16 14:16:11','2016-03-16 16:47:55'),(6,'Phonics','2016-12-31 16:50:59','2017-02-01 20:05:40'),(7,'Vocabulary','2017-01-04 19:16:27','2017-01-04 19:16:27'),(8,'TypingPractice','2017-02-01 20:18:03','2017-02-01 20:18:17');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` (`id`, `name`, `description`, `photo`, `status`) VALUES (1,'Joseph','This website helped me prepare extremely well for my exams. Highly recommended !','','Active'),(2,'Manish Paul','The question bank of this website is extensive and prepared me completely for my exam.','','Active'),(3,'Ajit','Site has useful hints and explanation for questions which is not available on other sites. ','','Active'),(4,'Rahul','The packages of the site offer more for less money. VALUE FOR MONEY AND TIME. ','','Active'),(5,'Pritam','Thank you. You were like messiah. Saved time and effort. I could prepare on move and with just my mobile. GREAT. ','','Active');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ugroups`
--

DROP TABLE IF EXISTS `ugroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ugroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ugroups`
--

LOCK TABLES `ugroups` WRITE;
/*!40000 ALTER TABLE `ugroups` DISABLE KEYS */;
INSERT INTO `ugroups` (`id`, `name`, `created`, `modified`) VALUES (1,'Administrator','2012-07-05 17:16:24','2012-07-05 17:16:24'),(2,'Teacher','2014-12-12 12:03:23','2014-12-12 12:03:23');
/*!40000 ALTER TABLE `ugroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `user_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` (`id`, `user_id`, `group_id`) VALUES (1,1,1),(2,1,2),(6,1,3),(7,1,4),(8,1,5);
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `ugroup_id` int(11) NOT NULL DEFAULT '2',
  `status` enum('Active','Suspend') DEFAULT 'Active',
  `deleted` char(1) DEFAULT NULL,
  `presetcode` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `presetcode` (`presetcode`),
  KEY `ugroup_id` (`ugroup_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ugroup_id`) REFERENCES `ugroups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `mobile`, `ugroup_id`, `status`, `deleted`, `presetcode`, `created`, `modified`) VALUES (1,'admin','dfb37faf99ffd691383e054541f1a3fd1966273d359d85aa419562fc26bf4427','root@localhost.com','Administrator','0000000002',1,'Active',NULL,NULL,'2014-04-01 21:08:06','2015-11-14 15:48:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `in_amount` decimal(18,2) DEFAULT NULL,
  `out_amount` decimal(18,2) DEFAULT NULL,
  `balance` decimal(18,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  `remarks` tinytext,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `student_id_2` (`student_id`),
  CONSTRAINT `wallets_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'devdrstud'
--

--
-- Dumping routines for database 'devdrstud'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-06 20:32:42
