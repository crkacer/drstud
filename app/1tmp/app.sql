-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2016 at 06:31 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exam_order2004`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

DROP TABLE IF EXISTS `advertisements`;
CREATE TABLE IF NOT EXISTS `advertisements` (
`id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `url_type` varchar(8) DEFAULT NULL,
  `url_target` varchar(6) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
CREATE TABLE IF NOT EXISTS `configurations` (
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

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `name`, `organization_name`, `domain_name`, `email`, `meta_title`, `meta_desc`, `timezone`, `author`, `sms_notification`, `email_notification`, `guest_login`, `front_end`, `slides`, `translate`, `paid_exam`, `leader_board`, `math_editor`, `certificate`, `contact`, `email_contact`, `currency`, `photo`, `signature`, `date_format`, `exam_expiry`, `exam_feedback`, `tolrance_count`, `min_limit`, `max_limit`, `captcha_type`, `dir_type`, `language`, `panel1`, `panel2`, `panel3`, `ads`, `testimonial`, `created`, `modified`) VALUES
(1, 'Order 2004', 'Order 2004', 'http://192.168.1.100:88/exam/order2004', 'root@localhost.com', 'Order 2004', 'Order 2004', 'Asia/Kolkata', 'Exam Solution', 0, 1, 0, 1, 1, 0, 0, 1, 0, 1, '0000-0000~info@eduexpression.com~http://facebook.com', 'Phone : 0000000000 Email : demo@demo.com', 21, '', '871d157c9c20f5f1a7ae1ae0dfe2c41a.jpg', 'd,m,Y,h,i,s,A,-,:', 1, 1, 3000, 20, 500, 1, 1, 'en', 1, 1, 1, 1, 1, '2014-04-08 20:56:04', '2016-11-03 17:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
`id` int(11) NOT NULL,
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
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
`id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short` varchar(3) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `short`, `photo`) VALUES
(1, 'Australia Dollar AUD', 'AUD', '64238c6d767ab034b04c4681295567a0.gif'),
(2, 'Brunei Darussalam Dollar BND', 'BND', '53e34059e7bfe4db945404e901c4f396.gif'),
(3, 'Cambodia Riel KHR', 'KHR', 'aaa57dd0012641cdee2c8d6484db8238.gif'),
(4, 'China Yuan Renminbi CNY ', 'CNY', '5586a267c542d0f49b6c22c5c978bf23.gif'),
(5, 'Hong Kong Dollar HKD', 'HKD', '200ec0145292d85b380d8c4f570f9aa9.gif'),
(6, 'India Rupee INR', 'INR', '537f17a76864d11438d25ff5af7641a5.gif'),
(7, 'Indonesia Rupiah IDR', 'IDR', '6d27b2f196ce9d74b10d12111d9838b0.gif'),
(8, 'Japan Yen JPY', 'JPY', '3a7f86a61af62ddab4737f3df6db4807.gif'),
(9, 'Korea (North) Won KPW', 'KPW', 'cc0ad4a7ba48bedd9cf57bc4125fc2c9.gif'),
(10, 'Korea (South) Won KRW', 'KRW', '28fdcdac33f7429afe6bce2e08dd47c2.gif'),
(11, 'Laos Kip LAK', 'LAK', 'f72da580f617ee32683202aeee564df0.gif'),
(12, 'Malaysia Ringgit MYR', 'MYR', 'e86af0a98bf7398c27a5ad30319d82ad.gif'),
(13, 'Nigeria Naira NGN', 'NGN', '2cdb9ceeae309e948c6bd0a90e30ffec.gif'),
(14, 'Pakistan Rupee PKR', 'PKR', 'bac3525bb97f15f806a74d248f71d6b2.gif'),
(15, 'Philippines Peso PHP', 'PHP', 'c46c38e2701d3c3bd6ee442c93befd04.gif'),
(16, 'Singapore Dollar SGD', 'SGD', '2c1e20836f56700b13a08477216a61fb.gif'),
(17, 'Sri Lanka Rupee LKR', 'LKR', '38bb6c10813d0a1eb9c878bcea2b7570.gif'),
(18, 'Taiwan New Dollar TWD', 'TWD', 'a558976f34bf485cb72f61656595536c.gif'),
(19, 'Thailand Baht THB', 'THB', '3c3bcc74de1fd038ec2d7e0dfe2965bf.gif'),
(20, 'United Kingdom Pound GBP', 'GBP', 'df773c6ce35993089139c888ec5a3210.gif'),
(21, 'United States Dollar USD', 'USD', 'ef1e801ee13715b41e55c16886597878.gif'),
(22, 'Viet Nam Dong VND', 'VND', '5a5b143e1685239abd85f0b367d4669b.gif');

-- --------------------------------------------------------

--
-- Table structure for table `diffs`
--

DROP TABLE IF EXISTS `diffs`;
CREATE TABLE IF NOT EXISTS `diffs` (
`id` int(11) NOT NULL,
  `diff_level` varchar(15) DEFAULT NULL,
  `type` char(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `diffs`
--

INSERT INTO `diffs` (`id`, `diff_level`, `type`) VALUES
(1, 'Easy', 'E'),
(2, 'Medium', 'M'),
(3, 'Hard', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `emailsettings`
--

DROP TABLE IF EXISTS `emailsettings`;
CREATE TABLE IF NOT EXISTS `emailsettings` (
  `id` int(11) NOT NULL,
  `type` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `host` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `port` varchar(10) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emailsettings`
--

INSERT INTO `emailsettings` (`id`, `type`, `host`, `username`, `password`, `port`) VALUES
(1, 'Mail', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

DROP TABLE IF EXISTS `emailtemplates`;
CREATE TABLE IF NOT EXISTS `emailtemplates` (
`id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `status` varchar(11) DEFAULT 'Published',
  `type` varchar(3) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `emailtemplates`
--

INSERT INTO `emailtemplates` (`id`, `name`, `description`, `status`, `type`) VALUES
(1, 'Student Registration', '<p>Hi, $studentName</p><p>Your signup email: $email</p><p>Your password: $password</p><p>Please click the following link to finish up registration:</p><p><a href="$url" target="_blank">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'SRN'),
(2, 'Re-send Verification', '<p>Hi, $studentName</p><p>Your signup email: $email</p><p>Please click the following link to finish up registration:</p><p><a href="$url" target="_blank">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'RVN'),
(4, 'Student Forgot Password', '<p>Dear $studentName,</p><p>Please click the following link to finish forgot password:</p><p><a href="$url" target="_blank">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'SFP'),
(5, 'Admin Forgot Password', '<p>Dear $name,</p><p>Please click the following link to finish forgot password:</p><p><a href="$url" target="_blank">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'AFP'),
(6, 'Admin Forgot Username', '<p>Dear $name,</p><p>You have forgot User Name. your username is $userName</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'AFU'),
(7, 'Student Login Credentials', '<p>Dear $studentName,</p><p>Congratulations! Your $siteName account is now active.</p><p>Email Address : $email</p><p>Password: $password</p><p>If you need, you can reset your password at any time.</p><p>To get started, log on:<a href="$url" target="_blank">$url</a></p><p>If you have any questions or need assistance, please contact us.</p><p> </p><p>Best Regards,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'SLC'),
(8, 'User Login Credentials', '<p>Dear $name,</p><p>Congratulations! Your $siteName account is now active.</p><p>Email Address : $email</p><p>Username : $userName</p><p>Password: $password</p><p>If you need, you can reset your password at any time.</p><p>To get started, log on:<a href="$url" target="_blank">$url</a></p><p>If you have any questions or need assistance, please contact us.</p><p> </p><p>Best Regards,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'ULC'),
(9, 'Exam Activation', '<p>Dear $studentName,</p><p>Exam Name $examName Type $type is active and start on $startDate end on $endDate</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'EAN'),
(10, 'Exam Finalized', '<p>Dear $studentName,</p><p>Name: $examName</p><p>Result: $result</p><p>Rank: $rank</p><p>Obtained Marks: $obtainedMarks</p><p>Question Attempt: $questionAttempt</p><p>Time Taken: $timeTaken</p><p>Percentage: $percent</p><p> </p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'EFD'),
(11, 'Exam Result', '<p>Dear $studentName,</p><p>Name: $examName</p><p>Result: $result</p><p>Obtained Marks: $obtainedMarks</p><p>Question Attempt: $questionAttempt</p><p>Time Taken: $timeTaken</p><p>Percentage: $percent %</p><p> </p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'ERT'),
(12, 'Package Purchased', '<p>Dear $studentName,</p><p>We thank you for choosing $siteName for your career, professional and educational needs.</p><p>Your group details are as follows:-</p><p>$packageDetail</p><p><strong>Total Amount: <img src="http://192.168.1.100:88/exam/order2004/img/currencies/ef1e801ee13715b41e55c16886597878.gif" alt="" width="9" height="16" /> $totalAmount</strong></p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'PPD');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
CREATE TABLE IF NOT EXISTS `exams` (
`id` int(11) NOT NULL,
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
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_feedbacks`
--

DROP TABLE IF EXISTS `exam_feedbacks`;
CREATE TABLE IF NOT EXISTS `exam_feedbacks` (
`id` int(11) NOT NULL,
  `exam_result_id` int(11) NOT NULL,
  `comments` mediumtext,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_groups`
--

DROP TABLE IF EXISTS `exam_groups`;
CREATE TABLE IF NOT EXISTS `exam_groups` (
`id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_maxquestions`
--

DROP TABLE IF EXISTS `exam_maxquestions`;
CREATE TABLE IF NOT EXISTS `exam_maxquestions` (
`id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `max_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_orders`
--

DROP TABLE IF EXISTS `exam_orders`;
CREATE TABLE IF NOT EXISTS `exam_orders` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_preps`
--

DROP TABLE IF EXISTS `exam_preps`;
CREATE TABLE IF NOT EXISTS `exam_preps` (
`id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `ques_no` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

DROP TABLE IF EXISTS `exam_questions`;
CREATE TABLE IF NOT EXISTS `exam_questions` (
`id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

DROP TABLE IF EXISTS `exam_results`;
CREATE TABLE IF NOT EXISTS `exam_results` (
`id` int(11) NOT NULL,
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
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_stats`
--

DROP TABLE IF EXISTS `exam_stats`;
CREATE TABLE IF NOT EXISTS `exam_stats` (
`id` int(11) NOT NULL,
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
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_warns`
--

DROP TABLE IF EXISTS `exam_warns`;
CREATE TABLE IF NOT EXISTS `exam_warns` (
`id` int(11) NOT NULL,
  `exam_result_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `description`, `price`, `day`, `photo`, `created`, `modified`) VALUES
(1, 'IIT', '', '10.00', 3, NULL, '2015-11-09 18:19:44', '2016-03-21 16:57:05'),
(2, 'CPMT', NULL, '32.00', 4, NULL, '2015-11-09 18:19:47', '2016-03-15 15:42:30'),
(3, 'CAT', NULL, '32.00', 201, NULL, '2016-03-11 15:48:33', '2016-03-15 15:46:00'),
(4, 'FIIT-JEE', 'Demo Is Best', '0.00', 30, '6b474b730e5118afdaef7ed5f1b2ba56.jpg', '2016-03-15 14:52:12', '2016-03-18 11:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `groups_payments`
--

DROP TABLE IF EXISTS `groups_payments`;
CREATE TABLE IF NOT EXISTS `groups_payments` (
`id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `expiry_days` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `last_payment_date` varchar(50) DEFAULT NULL,
  `status` varchar(8) DEFAULT 'Approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `helpcontents`
--

DROP TABLE IF EXISTS `helpcontents`;
CREATE TABLE IF NOT EXISTS `helpcontents` (
`id` int(11) NOT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `link_desc` longtext,
  `status` varchar(8) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `helpcontents`
--

INSERT INTO `helpcontents` (`id`, `link_title`, `link_desc`, `status`, `created`, `modified`) VALUES
(1, 'Help 1', '<p>Suspendisse mattis magna augue, sed pretium lacus pellentesque nec. Nullam tincidunt lacinia urna sit amet tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras consequat justo ac diam aliquet adipiscing. Ut orci nibh, viverra quis luctus id, lacinia quis purus. Vestibulum pharetra diam non nulla pretium scelerisque. Fusce posuere tellus vel mollis auctor.</p>', 'Active', '2014-12-19 14:45:19', '2015-10-26 11:52:48'),
(2, 'Help2', '<p>Aenean pretium nunc lectus, quis viverra metus accumsan vestibulum. Mauris vulputate urna nec leo viverra, at dictum nulla suscipit. Sed id pretium lectus, vitae egestas turpis. Quisque metus tortor, tristique in diam sit amet, suscipit facilisis augue. Nunc vel leo vitae ligula auctor tristique ut nec tortor. Aliquam nibh ligula, tristique non pharetra in, congue ac sem. Donec odio nulla, lobortis vitae risus in, porttitor pretium mauris. Nullam fringilla tortor eu quam luctus, eget bibendum lectus eleifend. Nam facilisis libero tempor rhoncus consequat.</p>', 'Active', '2014-12-19 14:45:43', '2015-11-09 16:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
`id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `status` varchar(10) DEFAULT 'Active',
  `ordering` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

DROP TABLE IF EXISTS `mails`;
CREATE TABLE IF NOT EXISTS `mails` (
`id` int(11) NOT NULL,
  `to_email` varchar(100) DEFAULT NULL,
  `from_email` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` longtext,
  `date` datetime DEFAULT NULL,
  `status` varchar(5) DEFAULT 'Live',
  `type` varchar(10) DEFAULT 'Unread',
  `mail_type` varchar(4) DEFAULT 'To'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `news_title` varchar(255) DEFAULT NULL,
  `news_desc` longtext,
  `status` varchar(7) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) NOT NULL,
  `model_name` varchar(100) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `controller_name` varchar(100) DEFAULT NULL,
  `action_name` varchar(100) DEFAULT NULL,
  `icon` varchar(30) DEFAULT NULL,
  `parent_id` int(1) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `published` varchar(3) DEFAULT 'Yes',
  `sel_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `model_name`, `page_name`, `controller_name`, `action_name`, `icon`, `parent_id`, `ordering`, `published`, `sel_name`) VALUES
(1, 'Dashboard', 'Dashboard', 'Dashboards', 'index', 'fa fa-dashboard fa-fw', 0, 1, 'Yes', NULL),
(2, 'Subject', 'Subjects', 'Subjects', 'index', 'fa fa-book fa-fw', 0, 4, 'Yes', NULL),
(3, 'Quiz', 'Add Question', 'Addquestions', 'add', '', 2, 66, 'No', NULL),
(4, 'Students', 'Students', 'Students', 'index', 'fa fa-graduation-cap fa-fw', 0, 8, 'Yes', 'Iestudents'),
(5, 'Quiz', 'Quiz', 'Exams', 'index', 'fa fa-list-alt fa-fw', 0, 6, 'Yes', 'Attemptedpapers,Addquestions'),
(6, 'Quiz', 'Attempted Papers', 'Attemptedpapers', 'index', '', 5, 67, 'No', NULL),
(7, 'Result', 'Results', 'Results', 'index', 'fa fa-trophy fa-fw', 0, 7, 'Yes', NULL),
(8, 'Configuration', 'Configurations', NULL, NULL, 'fa fa-wrench fa-fw', 0, 10, 'Yes', NULL),
(9, 'Help', 'Help', 'Helps', 'index', 'fa fa-support fa-fw', 0, 11, 'No', NULL),
(10, 'User/Teacher', 'Users/Teachers', 'Users', 'index', 'fa fa-user fa-fw', 0, 3, 'Yes', NULL),
(11, 'Group', 'Groups', 'Groups', 'index', 'fa fa-users fa-fw', 0, 2, 'Yes', NULL),
(12, 'Content', 'Contents', NULL, NULL, 'fa fa-newspaper-o fa-fw', 0, 11, 'Yes', NULL),
(13, 'Contents', 'Slides', 'Slides', 'index', '', 12, 3, 'Yes', NULL),
(14, 'Configuration', 'Organisation Logo', 'Weblogos', 'index', '', 8, 4, 'Yes', NULL),
(15, 'Content', 'News', 'News', 'index', '', 12, 1, 'Yes', NULL),
(17, 'Content', 'Help Content', 'Helpcontents', 'index', '', 12, 5, 'Yes', NULL),
(18, 'Question', 'Questions', 'Questions', 'index', 'fa fa-question fa-fw', 0, 5, 'Yes', 'Iequestions'),
(19, 'Question', 'Question Import/Export', 'Iequestions', 'index', '', 18, 99, 'No', NULL),
(20, 'Configuration', 'Paypal Payment', 'Payments', 'index', '', 8, 2, 'Yes', NULL),
(21, 'Mailbox', 'Mailbox', 'Mails', 'index', 'fa fa-envelope fa-fw', 0, 9, 'Yes', NULL),
(22, 'Student', 'Student Import/Export', 'Iestudents', 'index', '', 4, 99, 'No', NULL),
(23, 'Configuration', 'General', 'Configurations', 'index', NULL, 8, 1, 'Yes', NULL),
(24, 'Configuration', 'Currency', 'Currencies', 'index', NULL, 8, 3, 'Yes', NULL),
(25, 'Content', 'Testimonial', 'Testimonials', 'index', NULL, 12, 6, 'Yes', NULL),
(26, 'Content', 'Advertisement', 'Advertisements', 'index', NULL, 12, 7, 'Yes', NULL),
(27, 'Content', 'Pages', 'Contents', 'pages', NULL, 12, 2, 'Yes', NULL),
(28, 'Configuration', 'Certificate Signature', 'Signatures', 'index', NULL, 8, 5, 'Yes', NULL),
(29, 'DiffcultyLevel', 'Diffculty Level', 'Diffs', 'index', NULL, 8, 6, 'Yes', NULL),
(30, 'QuestionType', 'Question Type', 'qtypes', 'index', '', 8, 7, 'Yes', NULL),
(31, 'Menuname', 'Menu Name', 'Menunames', 'index', NULL, 8, 8, 'Yes', NULL),
(32, 'Email & SMS', 'Email & SMS', NULL, NULL, 'fa fa-shield', 0, 12, 'Yes', NULL),
(33, 'Email & SMS', 'Email Setting', 'Emailsettings', 'index', NULL, 32, 1, 'Yes', NULL),
(34, 'Email & SMS', 'Email Templates', 'Emailtemplates', 'index', NULL, 32, 2, 'Yes', NULL),
(35, 'Email & SMS', 'Send Emails', 'Sendemails', 'index', NULL, 32, 3, 'Yes', NULL),
(36, 'Email & SMS', 'SMS Setting', 'Smssettings', 'index', NULL, 32, 4, 'Yes', NULL),
(37, 'Email & SMS', 'SMS Templates', 'Smstemplates', NULL, 'index', 32, 5, 'Yes', NULL),
(38, 'Email & SMS', 'Send SMS', 'Sendsms', 'index', NULL, 32, 6, 'Yes', NULL),
(39, 'Subject', 'Lesson', 'Lessons', 'index', 'fa fa-list', 0, 4, 'Yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_rights`
--

DROP TABLE IF EXISTS `page_rights`;
CREATE TABLE IF NOT EXISTS `page_rights` (
`id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `ugroup_id` int(11) NOT NULL,
  `save_right` int(1) DEFAULT NULL,
  `update_right` int(1) DEFAULT NULL,
  `view_right` int(1) DEFAULT NULL,
  `search_right` int(1) DEFAULT NULL,
  `delete_right` int(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=126 ;

--
-- Dumping data for table `page_rights`
--

INSERT INTO `page_rights` (`id`, `page_id`, `ugroup_id`, `save_right`, `update_right`, `view_right`, `search_right`, `delete_right`) VALUES
(114, 1, 2, 1, 1, 1, 1, 1),
(115, 5, 2, 1, 1, 1, 1, 1),
(116, 3, 2, 1, 1, 1, 1, 1),
(117, 6, 2, 1, 1, 1, 1, 1),
(118, 11, 2, 0, 0, 1, 0, 0),
(119, 9, 2, 0, 0, 1, 0, 0),
(120, 21, 2, 1, 1, 1, 1, 1),
(121, 18, 2, 1, 1, 1, 1, 1),
(122, 19, 2, 1, 1, 1, 1, 1),
(123, 7, 2, 1, 1, 1, 1, 1),
(124, 4, 2, 0, 0, 1, 1, 0),
(125, 39, 2, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
`id` int(11) NOT NULL,
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
  `payment_type` varchar(15) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_configs`
--

DROP TABLE IF EXISTS `paypal_configs`;
CREATE TABLE IF NOT EXISTS `paypal_configs` (
`id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `sandbox_mode` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `paypal_configs`
--

INSERT INTO `paypal_configs` (`id`, `username`, `password`, `signature`, `sandbox_mode`) VALUES
(1, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `qtypes`
--

DROP TABLE IF EXISTS `qtypes`;
CREATE TABLE IF NOT EXISTS `qtypes` (
`id` int(11) NOT NULL,
  `question_type` varchar(20) DEFAULT NULL,
  `type` char(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `qtypes`
--

INSERT INTO `qtypes` (`id`, `question_type`, `type`) VALUES
(1, 'Objective', 'M'),
(2, 'True / False', 'T'),
(3, 'Fill in the blanks', 'F'),
(4, 'Subjective', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
`id` int(11) NOT NULL,
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
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question_groups`
--

DROP TABLE IF EXISTS `question_groups`;
CREATE TABLE IF NOT EXISTS `question_groups` (
`id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE IF NOT EXISTS `slides` (
`id` int(11) NOT NULL,
  `slide_name` varchar(255) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `slide_name`, `ordering`, `photo`, `dir`, `status`, `created`, `modified`) VALUES
(1, 'Slide1', 1, 'd96b90f325f1ebae362cec34ead77f65.jpg', '', 'Active', '2014-12-19 14:42:37', '2015-11-03 12:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `smssettings`
--

DROP TABLE IF EXISTS `smssettings`;
CREATE TABLE IF NOT EXISTS `smssettings` (
`id` int(11) NOT NULL,
  `api` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `senderid` varchar(10) DEFAULT NULL,
  `husername` varchar(100) DEFAULT NULL,
  `hpassword` varchar(100) DEFAULT NULL,
  `hsenderid` varchar(100) DEFAULT NULL,
  `hmobile` varchar(100) DEFAULT NULL,
  `hmessage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `smssettings`
--

INSERT INTO `smssettings` (`id`, `api`, `username`, `password`, `senderid`, `husername`, `hpassword`, `hsenderid`, `hmobile`, `hmessage`) VALUES
(1, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `smstemplates`
--

DROP TABLE IF EXISTS `smstemplates`;
CREATE TABLE IF NOT EXISTS `smstemplates` (
`id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `status` varchar(11) DEFAULT 'Published',
  `type` varchar(3) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `smstemplates`
--

INSERT INTO `smstemplates` (`id`, `name`, `description`, `status`, `type`) VALUES
(1, 'Student Registration', 'Hi, $studentName Email: $email Password: $password Website: $url Verification Code: $code Sincerely, $siteName', 'Published', 'SRN'),
(2, 'Re-send Verification', 'Hi, $studentName Email: $email Website: $url Verification Code: $code Sincerely, $siteName', 'Published', 'RVN'),
(4, 'Student Forgot Password', 'Dear $studentName, Website: $url Verification Code: $code Sincerely, $siteName', 'Published', 'SFP'),
(5, 'Admin Forgot Password', 'Dear $name, Website: $url Verification Code: $code Sincerely, $siteName', 'Published', 'AFP'),
(6, 'Admin Forgot Username', 'Dear $name, You have forgot User Name. Your username is $userName Sincerely, $siteName', 'Published', 'AFU'),
(7, 'Student Login Credentials', 'Dear $studentName, Your $siteName account is now active. Email: $email Password: $password Website:$url Best Regards, $siteName', 'Published', 'SLC'),
(8, 'User Login Credentials', 'Dear $name, Your $siteName account is now active. Email: $email Uername: $userName Password: $password Website:$url Best Regards, $siteName', 'Published', 'ULC'),
(9, 'Exam Activation', 'Dear $studentName, Exam Name $examName Type $type is active and start on $startDate end on $endDate Sincerely, $siteName', 'Published', 'EAN'),
(10, 'Exam Finalized', 'Dear $studentName, Name: $examName Result: $result Rank: $rank Obtained Marks: $obtainedMarks Question Attempt: $questionAttempt Time Taken: $timeTaken Percentage: $percent % Sincerely, $siteName', 'Published', 'EFD'),
(11, 'Exam Result', 'Dear $studentName, Name: $examName Result: $result Obtained Marks: $obtainedMarks Question Attempt: $questionAttempt Time Taken: $timeTaken Percentage: $percent % Sincerely, $siteName', 'Published', 'ERT'),
(12, 'Package Purchased', 'Dear, $studentName $packageDetail, Total Amount:  $totalAmount Sincerely, $siteName', 'Published', 'PPD');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
`id` int(11) NOT NULL,
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
  `auto_renewal` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `students_lessons`
--

DROP TABLE IF EXISTS `students_lessons`;
CREATE TABLE IF NOT EXISTS `students_lessons` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_groups`
--

DROP TABLE IF EXISTS `student_groups`;
CREATE TABLE IF NOT EXISTS `student_groups` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
`id` int(11) NOT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject_groups`
--

DROP TABLE IF EXISTS `subject_groups`;
CREATE TABLE IF NOT EXISTS `subject_groups` (
`id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Active'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `ugroups`
--

DROP TABLE IF EXISTS `ugroups`;
CREATE TABLE IF NOT EXISTS `ugroups` (
`id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ugroups`
--

INSERT INTO `ugroups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrator', '2012-07-05 17:16:24', '2012-07-05 17:16:24'),
(2, 'Teacher', '2014-12-12 12:03:23', '2014-12-12 12:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
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
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `mobile`, `ugroup_id`, `status`, `deleted`, `presetcode`, `created`, `modified`) VALUES
(1, 'admin', 'dfb37faf99ffd691383e054541f1a3fd1966273d359d85aa419562fc26bf4427', 'root@localhost.com', 'Administrator', '0000000002', 1, 'Active', NULL, NULL, '2014-04-01 21:08:06', '2015-11-14 15:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE IF NOT EXISTS `user_groups` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(6, 1, 3),
(7, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `in_amount` decimal(18,2) DEFAULT NULL,
  `out_amount` decimal(18,2) DEFAULT NULL,
  `balance` decimal(18,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  `remarks` tinytext,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diffs`
--
ALTER TABLE `diffs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailsettings`
--
ALTER TABLE `emailsettings`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
 ADD PRIMARY KEY (`id`), ADD KEY `lesson_id` (`lesson_id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `lesson_id_2` (`lesson_id`);

--
-- Indexes for table `exam_feedbacks`
--
ALTER TABLE `exam_feedbacks`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `exam_result_id` (`exam_result_id`);

--
-- Indexes for table `exam_groups`
--
ALTER TABLE `exam_groups`
 ADD PRIMARY KEY (`id`), ADD KEY `exam_id` (`exam_id`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `exam_maxquestions`
--
ALTER TABLE `exam_maxquestions`
 ADD PRIMARY KEY (`id`), ADD KEY `exam_id` (`exam_id`), ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `exam_orders`
--
ALTER TABLE `exam_orders`
 ADD PRIMARY KEY (`id`), ADD KEY `exam_id` (`exam_id`), ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exam_preps`
--
ALTER TABLE `exam_preps`
 ADD PRIMARY KEY (`id`), ADD KEY `exam_id` (`exam_id`), ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
 ADD PRIMARY KEY (`id`), ADD KEY `exam_id` (`exam_id`), ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
 ADD PRIMARY KEY (`id`), ADD KEY `exam_id` (`exam_id`), ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exam_stats`
--
ALTER TABLE `exam_stats`
 ADD PRIMARY KEY (`id`), ADD KEY `exam_id` (`exam_id`), ADD KEY `student_id` (`student_id`), ADD KEY `question_id` (`question_id`), ADD KEY `exam_result_id` (`exam_result_id`);

--
-- Indexes for table `exam_warns`
--
ALTER TABLE `exam_warns`
 ADD PRIMARY KEY (`id`), ADD KEY `exam_result_id` (`exam_result_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `group_name` (`group_name`);

--
-- Indexes for table `groups_payments`
--
ALTER TABLE `groups_payments`
 ADD PRIMARY KEY (`id`), ADD KEY `payment_id` (`payment_id`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `helpcontents`
--
ALTER TABLE `helpcontents`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
 ADD PRIMARY KEY (`id`), ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_rights`
--
ALTER TABLE `page_rights`
 ADD PRIMARY KEY (`id`), ADD KEY `page_id` (`page_id`), ADD KEY `ugroup_id` (`ugroup_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
 ADD PRIMARY KEY (`id`), ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `paypal_configs`
--
ALTER TABLE `paypal_configs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qtypes`
--
ALTER TABLE `qtypes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
 ADD PRIMARY KEY (`id`), ADD KEY `qtype_id` (`qtype_id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `diff_id` (`diff_id`);

--
-- Indexes for table `question_groups`
--
ALTER TABLE `question_groups`
 ADD PRIMARY KEY (`id`), ADD KEY `question_id` (`question_id`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smssettings`
--
ALTER TABLE `smssettings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smstemplates`
--
ALTER TABLE `smstemplates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `presetcode` (`presetcode`);

--
-- Indexes for table `students_lessons`
--
ALTER TABLE `students_lessons`
 ADD PRIMARY KEY (`id`), ADD KEY `student_id` (`student_id`,`lesson_id`), ADD KEY `student_id_2` (`student_id`), ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `student_groups`
--
ALTER TABLE `student_groups`
 ADD PRIMARY KEY (`id`), ADD KEY `student_id` (`student_id`,`group_id`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- Indexes for table `subject_groups`
--
ALTER TABLE `subject_groups`
 ADD PRIMARY KEY (`id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ugroups`
--
ALTER TABLE `ugroups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `presetcode` (`presetcode`), ADD KEY `ugroup_id` (`ugroup_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
 ADD PRIMARY KEY (`id`), ADD KEY `student_id` (`student_id`), ADD KEY `student_id_2` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `diffs`
--
ALTER TABLE `diffs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_feedbacks`
--
ALTER TABLE `exam_feedbacks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_groups`
--
ALTER TABLE `exam_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_maxquestions`
--
ALTER TABLE `exam_maxquestions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_orders`
--
ALTER TABLE `exam_orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_preps`
--
ALTER TABLE `exam_preps`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_stats`
--
ALTER TABLE `exam_stats`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_warns`
--
ALTER TABLE `exam_warns`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `groups_payments`
--
ALTER TABLE `groups_payments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `helpcontents`
--
ALTER TABLE `helpcontents`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `page_rights`
--
ALTER TABLE `page_rights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `paypal_configs`
--
ALTER TABLE `paypal_configs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `qtypes`
--
ALTER TABLE `qtypes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question_groups`
--
ALTER TABLE `question_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `smssettings`
--
ALTER TABLE `smssettings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `smstemplates`
--
ALTER TABLE `smstemplates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students_lessons`
--
ALTER TABLE `students_lessons`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_groups`
--
ALTER TABLE `student_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subject_groups`
--
ALTER TABLE `subject_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ugroups`
--
ALTER TABLE `ugroups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
ADD CONSTRAINT `exams_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`);

--
-- Constraints for table `exam_feedbacks`
--
ALTER TABLE `exam_feedbacks`
ADD CONSTRAINT `exam_feedbacks_ibfk_1` FOREIGN KEY (`exam_result_id`) REFERENCES `exam_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_groups`
--
ALTER TABLE `exam_groups`
ADD CONSTRAINT `exam_groups_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `exam_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_maxquestions`
--
ALTER TABLE `exam_maxquestions`
ADD CONSTRAINT `exam_maxquestions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `exam_maxquestions_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_orders`
--
ALTER TABLE `exam_orders`
ADD CONSTRAINT `exam_orders_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `exam_orders_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_preps`
--
ALTER TABLE `exam_preps`
ADD CONSTRAINT `exam_preps_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `exam_preps_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
ADD CONSTRAINT `exam_questions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `exam_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
ADD CONSTRAINT `exam_results_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `exam_results_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_stats`
--
ALTER TABLE `exam_stats`
ADD CONSTRAINT `exam_stats_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `exam_stats_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `exam_stats_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
ADD CONSTRAINT `exam_stats_ibfk_4` FOREIGN KEY (`exam_result_id`) REFERENCES `exam_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_warns`
--
ALTER TABLE `exam_warns`
ADD CONSTRAINT `exam_warns_ibfk_1` FOREIGN KEY (`exam_result_id`) REFERENCES `exam_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups_payments`
--
ALTER TABLE `groups_payments`
ADD CONSTRAINT `groups_payments_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `groups_payments_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `page_rights`
--
ALTER TABLE `page_rights`
ADD CONSTRAINT `page_rights_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `page_rights_ibfk_2` FOREIGN KEY (`ugroup_id`) REFERENCES `ugroups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `questions_ibfk_3` FOREIGN KEY (`qtype_id`) REFERENCES `qtypes` (`id`),
ADD CONSTRAINT `questions_ibfk_4` FOREIGN KEY (`diff_id`) REFERENCES `diffs` (`id`);

--
-- Constraints for table `question_groups`
--
ALTER TABLE `question_groups`
ADD CONSTRAINT `question_groups_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `question_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students_lessons`
--
ALTER TABLE `students_lessons`
ADD CONSTRAINT `students_lessons_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `students_lessons_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_groups`
--
ALTER TABLE `student_groups`
ADD CONSTRAINT `student_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `student_groups_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_groups`
--
ALTER TABLE `subject_groups`
ADD CONSTRAINT `subject_groups_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `subject_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ugroup_id`) REFERENCES `ugroups` (`id`);

--
-- Constraints for table `user_groups`
--
ALTER TABLE `user_groups`
ADD CONSTRAINT `user_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
ADD CONSTRAINT `wallets_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
