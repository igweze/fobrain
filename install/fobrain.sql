-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2024 at 07:47 PM
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
-- Database: `fobrain`
--

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_assignment`
--

CREATE TABLE `nur_fobrain_assignment` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `dDate` date DEFAULT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_assign_questions`
--

CREATE TABLE `nur_fobrain_assign_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text DEFAULT NULL,
  `qAnswer` varchar(100) DEFAULT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `q4` text NOT NULL,
  `ans` enum('1','2','3','4') DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class`
--

CREATE TABLE `nur_fobrain_class` (
  `cl_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `level` varchar(30) NOT NULL,
  `class` varchar(256) DEFAULT NULL,
  `class_type` varchar(256) DEFAULT NULL,
  `minCourse` varchar(5) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nur_fobrain_class`
--

INSERT INTO `nur_fobrain_class` (`cl_id`, `level`, `class`, `class_type`, `minCourse`, `status`) VALUES
(1, 'Nursery 1', 'a:5:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";}', NULL, NULL, '1'),
(2, 'Nursery 2', 'a:5:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";}', NULL, NULL, '1'),
(3, 'Nursery 3', 'a:5:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";}', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_one_comment`
--

CREATE TABLE `nur_fobrain_class_one_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_one_grade`
--

CREATE TABLE `nur_fobrain_class_one_grade` (
  `id_pfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_one_grand_score`
--

CREATE TABLE `nur_fobrain_class_one_grand_score` (
  `id_gfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fi` smallint(10) DEFAULT NULL,
  `jemji_gr_fi` float DEFAULT NULL,
  `jemji_po_fi` tinyint(5) DEFAULT NULL,
  `jiemj_to_fi` smallint(10) DEFAULT NULL,
  `jiemj_gr_fi` float DEFAULT NULL,
  `jiemj_po_fi` tinyint(5) DEFAULT NULL,
  `jmeji_to_fi` smallint(10) DEFAULT NULL,
  `jmeji_gr_fi` float DEFAULT NULL,
  `jmeji_po_fi` tinyint(5) DEFAULT NULL,
  `jgrand_to_fi` smallint(10) DEFAULT NULL,
  `jgrand_gr_fi` float DEFAULT NULL,
  `jgrand_po_fi` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_one_remark`
--

CREATE TABLE `nur_fobrain_class_one_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_one_score`
--

CREATE TABLE `nur_fobrain_class_one_score` (
  `id_fi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_one_sub_score`
--

CREATE TABLE `nur_fobrain_class_one_sub_score` (
  `id_sfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_three_comment`
--

CREATE TABLE `nur_fobrain_class_three_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_three_grade`
--

CREATE TABLE `nur_fobrain_class_three_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_three_grand_score`
--

CREATE TABLE `nur_fobrain_class_three_grand_score` (
  `id_gth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_th` smallint(10) DEFAULT NULL,
  `jemji_gr_th` float DEFAULT NULL,
  `jemji_po_th` tinyint(5) DEFAULT NULL,
  `jiemj_to_th` smallint(10) DEFAULT NULL,
  `jiemj_gr_th` float DEFAULT NULL,
  `jiemj_po_th` tinyint(5) DEFAULT NULL,
  `jmeji_to_th` smallint(10) DEFAULT NULL,
  `jmeji_gr_th` float DEFAULT NULL,
  `jmeji_po_th` tinyint(5) DEFAULT NULL,
  `jgrand_to_th` smallint(10) DEFAULT NULL,
  `jgrand_gr_th` float DEFAULT NULL,
  `jgrand_po_th` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_three_remark`
--

CREATE TABLE `nur_fobrain_class_three_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_three_score`
--

CREATE TABLE `nur_fobrain_class_three_score` (
  `id_th` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_three_sub_score`
--

CREATE TABLE `nur_fobrain_class_three_sub_score` (
  `id_sth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_two_comment`
--

CREATE TABLE `nur_fobrain_class_two_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_two_grade`
--

CREATE TABLE `nur_fobrain_class_two_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_two_grand_score`
--

CREATE TABLE `nur_fobrain_class_two_grand_score` (
  `id_gse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_se` smallint(10) DEFAULT NULL,
  `jemji_gr_se` float DEFAULT NULL,
  `jemji_po_se` tinyint(5) DEFAULT NULL,
  `jiemj_to_se` smallint(10) DEFAULT NULL,
  `jiemj_gr_se` float DEFAULT NULL,
  `jiemj_po_se` tinyint(5) DEFAULT NULL,
  `jmeji_to_se` smallint(10) DEFAULT NULL,
  `jmeji_gr_se` float DEFAULT NULL,
  `jmeji_po_se` tinyint(5) DEFAULT NULL,
  `jgrand_to_se` smallint(10) DEFAULT NULL,
  `jgrand_gr_se` float DEFAULT NULL,
  `jgrand_po_se` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_two_remark`
--

CREATE TABLE `nur_fobrain_class_two_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_two_score`
--

CREATE TABLE `nur_fobrain_class_two_score` (
  `id_se` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_class_two_sub_score`
--

CREATE TABLE `nur_fobrain_class_two_sub_score` (
  `id_sse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_config_rs`
--

CREATE TABLE `nur_fobrain_config_rs` (
  `s_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` int(4) DEFAULT NULL,
  `class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `term` enum('1','2','3') DEFAULT NULL,
  `t_info` text DEFAULT NULL,
  `staff_id` int(4) NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_daily_comments`
--

CREATE TABLE `nur_fobrain_daily_comments` (
  `id` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `title` VARCHAR(100) DEFAULT NULL,
  `attendance` enum('0','1','2','4') DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_courses`
--

CREATE TABLE `nur_fobrain_courses` (
  `cid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(255) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_course_chapter`
--

CREATE TABLE `nur_fobrain_course_chapter` (
  `hid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(40) DEFAULT NULL,
  `tid` int(40) NOT NULL,
  `chapter` text NOT NULL,
  `upload` varchar(30) DEFAULT NULL,
  `details` text NOT NULL,
  `ctype` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `link` text NOT NULL,
  `duration` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_course_quiz`
--

CREATE TABLE `nur_fobrain_course_quiz` (
  `qid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(40) DEFAULT NULL,
  `tid` int(40) NOT NULL,
  `hid` int(40) NOT NULL,
  `questions` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_course_review`
--

CREATE TABLE `nur_fobrain_course_review` (
  `rid` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(10) NOT NULL,
  `regnum` varchar(25) NOT NULL,
  `review` text DEFAULT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `program` tinyint(3) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `cstatus` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_course_topic`
--

CREATE TABLE `nur_fobrain_course_topic` (
  `tid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(40) DEFAULT NULL,
  `topic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_exams`
--

CREATE TABLE `nur_fobrain_exams` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_exams_config`
--

CREATE TABLE `nur_fobrain_exams_config` (
  `ex_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fi_ass` tinyint(3) DEFAULT NULL,
  `se_ass` tinyint(3) DEFAULT NULL,
  `th_ass` tinyint(3) DEFAULT NULL,
  `fo_ass` tinyint(3) DEFAULT NULL,
  `fif_ass` tinyint(3) DEFAULT NULL,
  `six_ass` tinyint(3) DEFAULT NULL,
  `exam` tinyint(3) DEFAULT NULL,
  `rsType` enum('1','2') DEFAULT '1',
  `status` enum('1','2','3','4') DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nur_fobrain_exams_config`
--

INSERT INTO `nur_fobrain_exams_config` (`ex_id`, `fi_ass`, `se_ass`, `th_ass`, `fo_ass`, `fif_ass`, `six_ass`, `exam`, `rsType`, `status`) VALUES
(1, 10, 10, 0, NULL, NULL, NULL, 80, '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_exams_review`
--

CREATE TABLE `nur_fobrain_exams_review` (
  `rid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `regnum` varchar(20) NOT NULL,
  `eid` varchar(20) NOT NULL,
  `course` varchar(100) NOT NULL,
  `level` enum('1','2','3','4','5','6') NOT NULL,
  `class` varchar(50) NOT NULL,
  `term` tinyint(1) NOT NULL,
  `etime` varchar(10) NOT NULL,
  `correct` varchar(10) NOT NULL,
  `quesno` varchar(10) NOT NULL,
  `yscore` varchar(10) NOT NULL,
  `tscore` varchar(10) NOT NULL,
  `aver` varchar(10) NOT NULL,
  `ttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_exam_ans`
--

CREATE TABLE `nur_fobrain_exam_ans` (
  `aID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `reg_id` int(10) NOT NULL,
  `regNo` varchar(14) DEFAULT NULL,
  `answers` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_exam_questions`
--

CREATE TABLE `nur_fobrain_exam_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text DEFAULT NULL,
  `qAnswer` varchar(100) DEFAULT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `q4` text NOT NULL,
  `ans` enum('1','2','3','4') DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_form_teachers`
--

CREATE TABLE `nur_fobrain_form_teachers` (
  `form_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `t_id` int(10) NOT NULL,
  `session` int(10) DEFAULT NULL,
  `level` tinyint(3) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_hm_review`
--

CREATE TABLE `nur_fobrain_hm_review` (
  `rid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `regnum` varchar(20) NOT NULL,
  `eid` varchar(20) NOT NULL,
  `course` varchar(100) NOT NULL,
  `level` enum('1','2','3','4','5','6') NOT NULL,
  `class` varchar(50) NOT NULL,
  `term` tinyint(1) NOT NULL,
  `etime` varchar(10) NOT NULL,
  `correct` varchar(10) NOT NULL,
  `quesno` varchar(10) NOT NULL,
  `yscore` varchar(10) NOT NULL,
  `tscore` varchar(10) NOT NULL,
  `aver` varchar(10) NOT NULL,
  `ttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_hostel`
--

CREATE TABLE `nur_fobrain_hostel` (
  `h_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `hostel` varchar(200) DEFAULT NULL,
  `h_limit` int(10) DEFAULT NULL,
  `h_desc` text DEFAULT NULL,
  `h_master` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_live_class`
--

CREATE TABLE `nur_fobrain_live_class` (
  `cid` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `meetid` varchar(50) NOT NULL,
  `participant` text NOT NULL,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `cTime` datetime NOT NULL,
  `sTime` varchar(30) NOT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_regno`
--

CREATE TABLE `nur_fobrain_regno` (
  `ireg_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nk_regno` varchar(16) NOT NULL DEFAULT '0',
  `class_1` varchar(10) DEFAULT NULL,
  `class_2` varchar(10) DEFAULT NULL,
  `class_3` varchar(10) DEFAULT NULL,
  `rs_1` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_2` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_3` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_4` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_5` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_6` varchar(10) NOT NULL DEFAULT '0,0,0',
  `jss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `sss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `current_class` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `s_dept` enum('1','2','3') DEFAULT NULL,
  `en_level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `en_term` enum('1','2','3') DEFAULT NULL,
  `session_id` tinyint(4) DEFAULT NULL,
  `date_regs` date NOT NULL,
  `active` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_student_record`
--

CREATE TABLE `nur_fobrain_student_record` (
  `stu_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `i_stupic` varchar(60) DEFAULT NULL,
  `i_accesspass` varchar(255) DEFAULT NULL,
  `i_salted` char(30) DEFAULT NULL,
  `i_firstname` varchar(40) DEFAULT NULL,
  `i_midname` varchar(30) DEFAULT NULL,
  `i_lastname` varchar(40) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_country` varchar(40) DEFAULT NULL,
  `i_state` varchar(30) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(30) DEFAULT NULL,
  `i_add_fi` varchar(60) DEFAULT NULL,
  `i_add_se` varchar(60) DEFAULT NULL,
  `i_stu_phone` varchar(20) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `sibling` longtext DEFAULT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(20) DEFAULT NULL,
  `i_spon_occup` varchar(100) DEFAULT NULL,
  `i_spo_add` varchar(60) DEFAULT NULL,
  `i_sponsor_ac` char(30) DEFAULT NULL,
  `i_sponsor_p` varchar(255) DEFAULT NULL,
  `sponsor2` varchar(100) DEFAULT NULL,
  `sponphone2` varchar(30) DEFAULT NULL,
  `soccup2` varchar(100) DEFAULT NULL,
  `sponadd2` text DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `disability` varchar(60) DEFAULT NULL,
  `hostel` tinyint(5) DEFAULT NULL,
  `route` tinyint(5) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `prevsch` varchar(200) DEFAULT NULL,
  `bcert` varchar(50) DEFAULT NULL,
  `guardid` varchar(50) DEFAULT NULL,
  `prevcert` varchar(50) DEFAULT NULL,
  `secuinfo` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nur_fobrain_timetb`
--

CREATE TABLE `nur_fobrain_timetb` (
  `id` int(18) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `title` VARCHAR(100) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_assignment`
--

CREATE TABLE `pri_fobrain_assignment` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `dDate` date DEFAULT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_assign_questions`
--

CREATE TABLE `pri_fobrain_assign_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text DEFAULT NULL,
  `qAnswer` varchar(100) DEFAULT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `q4` text NOT NULL,
  `ans` enum('1','2','3','4') DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class`
--

CREATE TABLE `pri_fobrain_class` (
  `cl_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `level` varchar(30) NOT NULL,
  `class` varchar(256) DEFAULT NULL,
  `class_type` varchar(256) DEFAULT NULL,
  `minCourse` varchar(5) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pri_fobrain_class`
--

INSERT INTO `pri_fobrain_class` (`cl_id`, `level`, `class`, `class_type`, `minCourse`, `status`) VALUES
(1, 'Primary 1', 'a:5:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";}', NULL, NULL, '1'),
(2, 'Primary 2', 'a:5:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";}', NULL, NULL, '1'),
(3, 'Primary 3', 'a:5:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";}', NULL, NULL, '1'),
(4, 'Primary 4', 'a:7:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";i:5;s:1:\"F\";i:6;s:1:\"G\";}', 'a:7:{i:0;s:1:\"4\";i:1;s:1:\"4\";i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"4\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', NULL, '2'),
(5, 'Primary 5', 'a:4:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";}', 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}', NULL, '2'),
(6, 'Primary 6', 'a:4:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";}', 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}', NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_five_comment`
--

CREATE TABLE `pri_fobrain_class_five_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_five_grade`
--

CREATE TABLE `pri_fobrain_class_five_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_five_grand_score`
--

CREATE TABLE `pri_fobrain_class_five_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fif` smallint(10) DEFAULT NULL,
  `jemji_gr_fif` float DEFAULT NULL,
  `jemji_po_fif` tinyint(5) DEFAULT NULL,
  `jiemj_to_fif` smallint(10) DEFAULT NULL,
  `jiemj_gr_fif` float DEFAULT NULL,
  `jiemj_po_fif` tinyint(5) DEFAULT NULL,
  `jmeji_to_fif` smallint(10) DEFAULT NULL,
  `jmeji_gr_fif` float DEFAULT NULL,
  `jmeji_po_fif` tinyint(5) DEFAULT NULL,
  `jgrand_to_fif` smallint(10) DEFAULT NULL,
  `jgrand_gr_fif` float DEFAULT NULL,
  `jgrand_po_fif` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_five_remark`
--

CREATE TABLE `pri_fobrain_class_five_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_five_score`
--

CREATE TABLE `pri_fobrain_class_five_score` (
  `id_se` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_five_sub_score`
--

CREATE TABLE `pri_fobrain_class_five_sub_score` (
  `id_sse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_four_comment`
--

CREATE TABLE `pri_fobrain_class_four_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_four_grade`
--

CREATE TABLE `pri_fobrain_class_four_grade` (
  `id_pfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_four_grand_score`
--

CREATE TABLE `pri_fobrain_class_four_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fo` smallint(10) DEFAULT NULL,
  `jemji_gr_fo` float DEFAULT NULL,
  `jemji_po_fo` tinyint(5) DEFAULT NULL,
  `jiemj_to_fo` smallint(10) DEFAULT NULL,
  `jiemj_gr_fo` float DEFAULT NULL,
  `jiemj_po_fo` tinyint(5) DEFAULT NULL,
  `jmeji_to_fo` smallint(10) DEFAULT NULL,
  `jmeji_gr_fo` float DEFAULT NULL,
  `jmeji_po_fo` tinyint(5) DEFAULT NULL,
  `jgrand_to_fo` smallint(10) DEFAULT NULL,
  `jgrand_gr_fo` float DEFAULT NULL,
  `jgrand_po_fo` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_four_remark`
--

CREATE TABLE `pri_fobrain_class_four_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_four_score`
--

CREATE TABLE `pri_fobrain_class_four_score` (
  `id_fi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_four_sub_score`
--

CREATE TABLE `pri_fobrain_class_four_sub_score` (
  `id_sfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_one_comment`
--

CREATE TABLE `pri_fobrain_class_one_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_one_grade`
--

CREATE TABLE `pri_fobrain_class_one_grade` (
  `id_pfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_one_grand_score`
--

CREATE TABLE `pri_fobrain_class_one_grand_score` (
  `id_gfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fi` smallint(10) DEFAULT NULL,
  `jemji_gr_fi` float DEFAULT NULL,
  `jemji_po_fi` tinyint(5) DEFAULT NULL,
  `jiemj_to_fi` smallint(10) DEFAULT NULL,
  `jiemj_gr_fi` float DEFAULT NULL,
  `jiemj_po_fi` tinyint(5) DEFAULT NULL,
  `jmeji_to_fi` smallint(10) DEFAULT NULL,
  `jmeji_gr_fi` float DEFAULT NULL,
  `jmeji_po_fi` tinyint(5) DEFAULT NULL,
  `jgrand_to_fi` smallint(10) DEFAULT NULL,
  `jgrand_gr_fi` float DEFAULT NULL,
  `jgrand_po_fi` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_one_remark`
--

CREATE TABLE `pri_fobrain_class_one_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_one_score`
--

CREATE TABLE `pri_fobrain_class_one_score` (
  `id_fi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_one_sub_score`
--

CREATE TABLE `pri_fobrain_class_one_sub_score` (
  `id_sfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_six_comment`
--

CREATE TABLE `pri_fobrain_class_six_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_six_grade`
--

CREATE TABLE `pri_fobrain_class_six_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_six_grand_score`
--

CREATE TABLE `pri_fobrain_class_six_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_six` smallint(10) DEFAULT NULL,
  `jemji_gr_six` float DEFAULT NULL,
  `jemji_po_six` tinyint(5) DEFAULT NULL,
  `jiemj_to_six` smallint(10) DEFAULT NULL,
  `jiemj_gr_six` float DEFAULT NULL,
  `jiemj_po_six` tinyint(5) DEFAULT NULL,
  `jmeji_to_six` smallint(10) DEFAULT NULL,
  `jmeji_gr_six` float DEFAULT NULL,
  `jmeji_po_six` tinyint(5) DEFAULT NULL,
  `jgrand_to_six` smallint(10) DEFAULT NULL,
  `jgrand_gr_six` float DEFAULT NULL,
  `jgrand_po_six` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_six_remark`
--

CREATE TABLE `pri_fobrain_class_six_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_six_score`
--

CREATE TABLE `pri_fobrain_class_six_score` (
  `id_th` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_six_sub_score`
--

CREATE TABLE `pri_fobrain_class_six_sub_score` (
  `id_sth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_three_comment`
--

CREATE TABLE `pri_fobrain_class_three_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_three_grade`
--

CREATE TABLE `pri_fobrain_class_three_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_three_grand_score`
--

CREATE TABLE `pri_fobrain_class_three_grand_score` (
  `id_gth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_th` smallint(10) DEFAULT NULL,
  `jemji_gr_th` float DEFAULT NULL,
  `jemji_po_th` tinyint(5) DEFAULT NULL,
  `jiemj_to_th` smallint(10) DEFAULT NULL,
  `jiemj_gr_th` float DEFAULT NULL,
  `jiemj_po_th` tinyint(5) DEFAULT NULL,
  `jmeji_to_th` smallint(10) DEFAULT NULL,
  `jmeji_gr_th` float DEFAULT NULL,
  `jmeji_po_th` tinyint(5) DEFAULT NULL,
  `jgrand_to_th` smallint(10) DEFAULT NULL,
  `jgrand_gr_th` float DEFAULT NULL,
  `jgrand_po_th` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_three_remark`
--

CREATE TABLE `pri_fobrain_class_three_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_three_score`
--

CREATE TABLE `pri_fobrain_class_three_score` (
  `id_th` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_three_sub_score`
--

CREATE TABLE `pri_fobrain_class_three_sub_score` (
  `id_sth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_two_comment`
--

CREATE TABLE `pri_fobrain_class_two_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_two_grade`
--

CREATE TABLE `pri_fobrain_class_two_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_two_grand_score`
--

CREATE TABLE `pri_fobrain_class_two_grand_score` (
  `id_gse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_se` smallint(10) DEFAULT NULL,
  `jemji_gr_se` float DEFAULT NULL,
  `jemji_po_se` tinyint(5) DEFAULT NULL,
  `jiemj_to_se` smallint(10) DEFAULT NULL,
  `jiemj_gr_se` float DEFAULT NULL,
  `jiemj_po_se` tinyint(5) DEFAULT NULL,
  `jmeji_to_se` smallint(10) DEFAULT NULL,
  `jmeji_gr_se` float DEFAULT NULL,
  `jmeji_po_se` tinyint(5) DEFAULT NULL,
  `jgrand_to_se` smallint(10) DEFAULT NULL,
  `jgrand_gr_se` float DEFAULT NULL,
  `jgrand_po_se` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_two_remark`
--

CREATE TABLE `pri_fobrain_class_two_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_two_score`
--

CREATE TABLE `pri_fobrain_class_two_score` (
  `id_se` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_class_two_sub_score`
--

CREATE TABLE `pri_fobrain_class_two_sub_score` (
  `id_sse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_config_rs`
--

CREATE TABLE `pri_fobrain_config_rs` (
  `s_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` int(4) DEFAULT NULL,
  `class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `term` enum('1','2','3') DEFAULT NULL,
  `t_info` text DEFAULT NULL,
  `staff_id` int(4) NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_daily_comments`
--

CREATE TABLE `pri_fobrain_daily_comments` (
  `id` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `title` VARCHAR(100) DEFAULT NULL,
  `attendance` enum('0','1','2','4') DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_courses`
--

CREATE TABLE `pri_fobrain_courses` (
  `cid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(255) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_course_chapter`
--

CREATE TABLE `pri_fobrain_course_chapter` (
  `hid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(40) DEFAULT NULL,
  `tid` int(40) NOT NULL,
  `chapter` text NOT NULL,
  `upload` varchar(30) DEFAULT NULL,
  `details` text NOT NULL,
  `ctype` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `link` text NOT NULL,
  `duration` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_course_quiz`
--

CREATE TABLE `pri_fobrain_course_quiz` (
  `qid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(40) DEFAULT NULL,
  `tid` int(40) NOT NULL,
  `hid` int(40) NOT NULL,
  `questions` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_course_review`
--

CREATE TABLE `pri_fobrain_course_review` (
  `rid` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(10) NOT NULL,
  `regnum` varchar(25) NOT NULL,
  `review` text DEFAULT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `program` tinyint(3) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `cstatus` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_course_topic`
--

CREATE TABLE `pri_fobrain_course_topic` (
  `tid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(40) DEFAULT NULL,
  `topic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_exams`
--

CREATE TABLE `pri_fobrain_exams` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_exams_config`
--

CREATE TABLE `pri_fobrain_exams_config` (
  `ex_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fi_ass` tinyint(3) DEFAULT NULL,
  `se_ass` tinyint(3) DEFAULT NULL,
  `th_ass` tinyint(3) DEFAULT NULL,
  `fo_ass` tinyint(3) DEFAULT NULL,
  `fif_ass` tinyint(3) DEFAULT NULL,
  `six_ass` tinyint(3) DEFAULT NULL,
  `exam` tinyint(3) DEFAULT NULL,
  `rsType` enum('1','2') DEFAULT '1',
  `status` enum('1','2','3','4') DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pri_fobrain_exams_config`
--

INSERT INTO `pri_fobrain_exams_config` (`ex_id`, `fi_ass`, `se_ass`, `th_ass`, `fo_ass`, `fif_ass`, `six_ass`, `exam`, `rsType`, `status`) VALUES
(1, 10, 10, 10, NULL, NULL, NULL, 70, '1', '3');

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_exams_review`
--

CREATE TABLE `pri_fobrain_exams_review` (
  `rid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `regnum` varchar(20) NOT NULL,
  `eid` varchar(20) NOT NULL,
  `course` varchar(100) NOT NULL,
  `level` enum('1','2','3','4','5','6') NOT NULL,
  `class` varchar(50) NOT NULL,
  `term` tinyint(1) NOT NULL,
  `etime` varchar(10) NOT NULL,
  `correct` varchar(10) NOT NULL,
  `quesno` varchar(10) NOT NULL,
  `yscore` varchar(10) NOT NULL,
  `tscore` varchar(10) NOT NULL,
  `aver` varchar(10) NOT NULL,
  `ttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_exam_ans`
--

CREATE TABLE `pri_fobrain_exam_ans` (
  `aID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `reg_id` int(10) NOT NULL,
  `regNo` varchar(14) DEFAULT NULL,
  `answers` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_exam_questions`
--

CREATE TABLE `pri_fobrain_exam_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text DEFAULT NULL,
  `qAnswer` varchar(100) DEFAULT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `q4` text NOT NULL,
  `ans` enum('1','2','3','4') DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_form_teachers`
--

CREATE TABLE `pri_fobrain_form_teachers` (
  `form_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `t_id` int(10) NOT NULL,
  `session` int(10) DEFAULT NULL,
  `level` tinyint(3) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_hm_review`
--

CREATE TABLE `pri_fobrain_hm_review` (
  `rid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `regnum` varchar(20) NOT NULL,
  `eid` varchar(20) NOT NULL,
  `course` varchar(100) NOT NULL,
  `level` enum('1','2','3','4','5','6') NOT NULL,
  `class` varchar(50) NOT NULL,
  `term` tinyint(1) NOT NULL,
  `etime` varchar(10) NOT NULL,
  `correct` varchar(10) NOT NULL,
  `quesno` varchar(10) NOT NULL,
  `yscore` varchar(10) NOT NULL,
  `tscore` varchar(10) NOT NULL,
  `aver` varchar(10) NOT NULL,
  `ttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_hostel`
--

CREATE TABLE `pri_fobrain_hostel` (
  `h_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `hostel` varchar(200) DEFAULT NULL,
  `h_limit` int(10) DEFAULT NULL,
  `h_desc` text DEFAULT NULL,
  `h_master` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_live_class`
--

CREATE TABLE `pri_fobrain_live_class` (
  `cid` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `meetid` varchar(50) NOT NULL,
  `participant` text NOT NULL,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `cTime` datetime NOT NULL,
  `sTime` varchar(30) NOT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_regno`
--

CREATE TABLE `pri_fobrain_regno` (
  `ireg_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nk_regno` varchar(16) NOT NULL DEFAULT '0',
  `class_1` varchar(10) DEFAULT NULL,
  `class_2` varchar(10) DEFAULT NULL,
  `class_3` varchar(10) DEFAULT NULL,
  `class_4` varchar(10) DEFAULT NULL,
  `class_5` varchar(10) DEFAULT NULL,
  `class_6` varchar(10) DEFAULT NULL,
  `rs_1` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_2` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_3` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_4` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_5` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_6` varchar(10) NOT NULL DEFAULT '0,0,0',
  `jss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `sss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `current_class` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `s_dept` enum('1','2','3') DEFAULT NULL,
  `en_level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `en_term` enum('1','2','3') DEFAULT NULL,
  `session_id` tinyint(4) DEFAULT NULL,
  `date_regs` date NOT NULL,
  `active` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_student_record`
--

CREATE TABLE `pri_fobrain_student_record` (
  `stu_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `i_stupic` varchar(60) DEFAULT NULL,
  `i_accesspass` varchar(255) DEFAULT NULL,
  `i_salted` char(30) DEFAULT NULL,
  `i_firstname` varchar(40) DEFAULT NULL,
  `i_midname` varchar(30) DEFAULT NULL,
  `i_lastname` varchar(40) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_country` varchar(40) DEFAULT NULL,
  `i_state` varchar(30) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(30) DEFAULT NULL,
  `i_add_fi` varchar(60) DEFAULT NULL,
  `i_add_se` varchar(60) DEFAULT NULL,
  `i_stu_phone` varchar(20) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `sibling` longtext DEFAULT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(20) DEFAULT NULL,
  `i_spon_occup` varchar(100) DEFAULT NULL,
  `i_spo_add` varchar(60) DEFAULT NULL,
  `i_sponsor_ac` char(30) DEFAULT NULL,
  `i_sponsor_p` varchar(255) DEFAULT NULL,
  `sponsor2` varchar(100) DEFAULT NULL,
  `sponphone2` varchar(30) DEFAULT NULL,
  `soccup2` varchar(100) DEFAULT NULL,
  `sponadd2` text DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `disability` varchar(60) DEFAULT NULL,
  `hostel` tinyint(5) DEFAULT NULL,
  `route` tinyint(5) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `prevsch` varchar(200) DEFAULT NULL,
  `bcert` varchar(50) DEFAULT NULL,
  `guardid` varchar(50) DEFAULT NULL,
  `prevcert` varchar(50) DEFAULT NULL,
  `secuinfo` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pri_fobrain_timetb`
--

CREATE TABLE `pri_fobrain_timetb` (
  `id` int(18) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `title` VARCHAR(100) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_assignment`
--

CREATE TABLE `sec_fobrain_assignment` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `dDate` date DEFAULT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_assign_questions`
--

CREATE TABLE `sec_fobrain_assign_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text DEFAULT NULL,
  `qAnswer` varchar(100) DEFAULT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `q4` text NOT NULL,
  `ans` enum('1','2','3','4') DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class`
--

CREATE TABLE `sec_fobrain_class` (
  `cl_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `level` varchar(30) NOT NULL,
  `class` varchar(256) DEFAULT NULL,
  `class_type` varchar(256) DEFAULT NULL,
  `minCourse` varchar(5) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sec_fobrain_class`
--

INSERT INTO `sec_fobrain_class` (`cl_id`, `level`, `class`, `class_type`, `minCourse`, `status`) VALUES
(1, 'Grade 1', 'a:4:{i:0;s:6:\"Amanda\";i:1;s:4:\"Hulk\";i:2;s:5:\"Eagle\";i:3;s:4:\"Gold\";}', NULL, '9', '1'),
(2, 'Grade 2', 'a:6:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";i:5;s:1:\"F\";}', NULL, '8', '1'),
(3, 'Grade 3', 'a:6:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";i:5;s:1:\"F\";}', NULL, 'All', '1'),
(4, 'Grade 4', 'a:6:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";i:5;s:1:\"F\";}', 'a:7:{i:0;s:1:\"4\";i:1;s:1:\"4\";i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"4\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', '7', '2'),
(5, 'Grade 5', 'a:6:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";i:5;s:1:\"F\";}', 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}', '8', '2'),
(6, 'Grade 6', 'a:6:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;s:1:\"C\";i:3;s:1:\"D\";i:4;s:1:\"E\";i:5;s:1:\"F\";}', 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}', '9', '2');

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_five_comment`
--

CREATE TABLE `sec_fobrain_class_five_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_five_grade`
--

CREATE TABLE `sec_fobrain_class_five_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_five_grand_score`
--

CREATE TABLE `sec_fobrain_class_five_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fif` smallint(10) DEFAULT NULL,
  `jemji_gr_fif` float DEFAULT NULL,
  `jemji_po_fif` tinyint(5) DEFAULT NULL,
  `jiemj_to_fif` smallint(10) DEFAULT NULL,
  `jiemj_gr_fif` float DEFAULT NULL,
  `jiemj_po_fif` tinyint(5) DEFAULT NULL,
  `jmeji_to_fif` smallint(10) DEFAULT NULL,
  `jmeji_gr_fif` float DEFAULT NULL,
  `jmeji_po_fif` tinyint(5) DEFAULT NULL,
  `jgrand_to_fif` smallint(10) DEFAULT NULL,
  `jgrand_gr_fif` float DEFAULT NULL,
  `jgrand_po_fif` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_five_remark`
--

CREATE TABLE `sec_fobrain_class_five_remark` (
`id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_five_score`
--

CREATE TABLE `sec_fobrain_class_five_score` (
  `id_se` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_five_sub_score`
--

CREATE TABLE `sec_fobrain_class_five_sub_score` (
  `id_sse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_four_comment`
--

CREATE TABLE `sec_fobrain_class_four_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_four_grade`
--

CREATE TABLE `sec_fobrain_class_four_grade` (
  `id_pfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_four_grand_score`
--

CREATE TABLE `sec_fobrain_class_four_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fo` smallint(10) DEFAULT NULL,
  `jemji_gr_fo` float DEFAULT NULL,
  `jemji_po_fo` tinyint(5) DEFAULT NULL,
  `jiemj_to_fo` smallint(10) DEFAULT NULL,
  `jiemj_gr_fo` float DEFAULT NULL,
  `jiemj_po_fo` tinyint(5) DEFAULT NULL,
  `jmeji_to_fo` smallint(10) DEFAULT NULL,
  `jmeji_gr_fo` float DEFAULT NULL,
  `jmeji_po_fo` tinyint(5) DEFAULT NULL,
  `jgrand_to_fo` smallint(10) DEFAULT NULL,
  `jgrand_gr_fo` float DEFAULT NULL,
  `jgrand_po_fo` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_four_remark`
--

CREATE TABLE `sec_fobrain_class_four_remark` (
`id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_four_score`
--

CREATE TABLE `sec_fobrain_class_four_score` (
  `id_fi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_four_sub_score`
--

CREATE TABLE `sec_fobrain_class_four_sub_score` (
  `id_sfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_one_comment`
--

CREATE TABLE `sec_fobrain_class_one_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_one_grade`
--

CREATE TABLE `sec_fobrain_class_one_grade` (
  `id_pfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_one_grand_score`
--

CREATE TABLE `sec_fobrain_class_one_grand_score` (
  `id_gfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fi` smallint(10) DEFAULT NULL,
  `jemji_gr_fi` float DEFAULT NULL,
  `jemji_po_fi` tinyint(5) DEFAULT NULL,
  `jiemj_to_fi` smallint(10) DEFAULT NULL,
  `jiemj_gr_fi` float DEFAULT NULL,
  `jiemj_po_fi` tinyint(5) DEFAULT NULL,
  `jmeji_to_fi` smallint(10) DEFAULT NULL,
  `jmeji_gr_fi` float DEFAULT NULL,
  `jmeji_po_fi` tinyint(5) DEFAULT NULL,
  `jgrand_to_fi` smallint(10) DEFAULT NULL,
  `jgrand_gr_fi` float DEFAULT NULL,
  `jgrand_po_fi` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_one_remark`
--

CREATE TABLE `sec_fobrain_class_one_remark` (
`id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_one_score`
--

CREATE TABLE `sec_fobrain_class_one_score` (
  `id_fi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_one_sub_score`
--

CREATE TABLE `sec_fobrain_class_one_sub_score` (
  `id_sfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_six_comment`
--

CREATE TABLE `sec_fobrain_class_six_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_six_grade`
--

CREATE TABLE `sec_fobrain_class_six_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_six_grand_score`
--

CREATE TABLE `sec_fobrain_class_six_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_six` smallint(10) DEFAULT NULL,
  `jemji_gr_six` float DEFAULT NULL,
  `jemji_po_six` tinyint(5) DEFAULT NULL,
  `jiemj_to_six` smallint(10) DEFAULT NULL,
  `jiemj_gr_six` float DEFAULT NULL,
  `jiemj_po_six` tinyint(5) DEFAULT NULL,
  `jmeji_to_six` smallint(10) DEFAULT NULL,
  `jmeji_gr_six` float DEFAULT NULL,
  `jmeji_po_six` tinyint(5) DEFAULT NULL,
  `jgrand_to_six` smallint(10) DEFAULT NULL,
  `jgrand_gr_six` float DEFAULT NULL,
  `jgrand_po_six` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_six_remark`
--

CREATE TABLE `sec_fobrain_class_six_remark` (
`id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_six_score`
--

CREATE TABLE `sec_fobrain_class_six_score` (
  `id_th` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_six_sub_score`
--

CREATE TABLE `sec_fobrain_class_six_sub_score` (
  `id_sth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_three_comment`
--

CREATE TABLE `sec_fobrain_class_three_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_three_grade`
--

CREATE TABLE `sec_fobrain_class_three_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_three_grand_score`
--

CREATE TABLE `sec_fobrain_class_three_grand_score` (
  `id_gth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_th` smallint(10) DEFAULT NULL,
  `jemji_gr_th` float DEFAULT NULL,
  `jemji_po_th` tinyint(5) DEFAULT NULL,
  `jiemj_to_th` smallint(10) DEFAULT NULL,
  `jiemj_gr_th` float DEFAULT NULL,
  `jiemj_po_th` tinyint(5) DEFAULT NULL,
  `jmeji_to_th` smallint(10) DEFAULT NULL,
  `jmeji_gr_th` float DEFAULT NULL,
  `jmeji_po_th` tinyint(5) DEFAULT NULL,
  `jgrand_to_th` smallint(10) DEFAULT NULL,
  `jgrand_gr_th` float DEFAULT NULL,
  `jgrand_po_th` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_three_remark`
--

CREATE TABLE `sec_fobrain_class_three_remark` (
`id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_three_score`
--

CREATE TABLE `sec_fobrain_class_three_score` (
  `id_th` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_three_sub_score`
--

CREATE TABLE `sec_fobrain_class_three_sub_score` (
  `id_sth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_two_comment`
--

CREATE TABLE `sec_fobrain_class_two_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_two_grade`
--

CREATE TABLE `sec_fobrain_class_two_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_two_grand_score`
--

CREATE TABLE `sec_fobrain_class_two_grand_score` (
  `id_gse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_se` smallint(10) DEFAULT NULL,
  `jemji_gr_se` float DEFAULT NULL,
  `jemji_po_se` tinyint(5) DEFAULT NULL,
  `jiemj_to_se` smallint(10) DEFAULT NULL,
  `jiemj_gr_se` float DEFAULT NULL,
  `jiemj_po_se` tinyint(5) DEFAULT NULL,
  `jmeji_to_se` smallint(10) DEFAULT NULL,
  `jmeji_gr_se` float DEFAULT NULL,
  `jmeji_po_se` tinyint(5) DEFAULT NULL,
  `jgrand_to_se` smallint(10) DEFAULT NULL,
  `jgrand_gr_se` float DEFAULT NULL,
  `jgrand_po_se` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_two_remark`
--

CREATE TABLE `sec_fobrain_class_two_remark` (
`id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text DEFAULT NULL,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text DEFAULT NULL,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text DEFAULT NULL,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_two_score`
--

CREATE TABLE `sec_fobrain_class_two_score` (
  `id_se` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_class_two_sub_score`
--

CREATE TABLE `sec_fobrain_class_two_sub_score` (
  `id_sse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_config_rs`
--

CREATE TABLE `sec_fobrain_config_rs` (
  `s_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` int(4) DEFAULT NULL,
  `class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `term` enum('1','2','3') DEFAULT NULL,
  `t_info` text DEFAULT NULL,
  `staff_id` int(4) NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_daily_comments`
--

CREATE TABLE `sec_fobrain_daily_comments` (
  `id` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `title` VARCHAR(100) DEFAULT NULL,
  `attendance` enum('0','1','2','3','4') DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_courses`
--

CREATE TABLE `sec_fobrain_courses` (
  `cid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(255) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_course_chapter`
--

CREATE TABLE `sec_fobrain_course_chapter` (
  `hid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(40) DEFAULT NULL,
  `tid` int(40) NOT NULL,
  `chapter` text NOT NULL,
  `upload` varchar(30) DEFAULT NULL,
  `details` text NOT NULL,
  `ctype` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `link` text NOT NULL,
  `duration` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_course_quiz`
--

CREATE TABLE `sec_fobrain_course_quiz` (
  `qid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(40) DEFAULT NULL,
  `tid` int(40) NOT NULL,
  `hid` int(40) NOT NULL,
  `questions` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_course_review`
--

CREATE TABLE `sec_fobrain_course_review` (
  `rid` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(10) NOT NULL,
  `regnum` varchar(25) NOT NULL,
  `review` text DEFAULT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `program` tinyint(3) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `cstatus` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_course_topic`
--

CREATE TABLE `sec_fobrain_course_topic` (
  `tid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cid` int(40) DEFAULT NULL,
  `topic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_exams`
--

CREATE TABLE `sec_fobrain_exams` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_exams_config`
--

CREATE TABLE `sec_fobrain_exams_config` (
  `ex_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fi_ass` tinyint(3) DEFAULT NULL,
  `se_ass` tinyint(3) DEFAULT NULL,
  `th_ass` tinyint(3) DEFAULT NULL,
  `fo_ass` tinyint(3) DEFAULT NULL,
  `fif_ass` tinyint(3) DEFAULT NULL,
  `six_ass` tinyint(3) DEFAULT NULL,
  `exam` tinyint(3) DEFAULT NULL,
  `rsType` enum('1','2') NOT NULL DEFAULT '1',
  `status` enum('1','2','3','4') DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sec_fobrain_exams_config`
--

INSERT INTO `sec_fobrain_exams_config` (`ex_id`, `fi_ass`, `se_ass`, `th_ass`, `fo_ass`, `fif_ass`, `six_ass`, `exam`, `rsType`, `status`) VALUES
(1, 10, 10, 10, 0, 0, 0, 70, '1', '3');

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_exams_review`
--

CREATE TABLE `sec_fobrain_exams_review` (
  `rid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `regnum` varchar(20) NOT NULL,
  `eid` varchar(20) NOT NULL,
  `course` varchar(100) NOT NULL,
  `level` enum('1','2','3','4','5','6') NOT NULL,
  `class` varchar(50) NOT NULL,
  `term` tinyint(1) NOT NULL,
  `etime` varchar(10) NOT NULL,
  `correct` varchar(10) NOT NULL,
  `quesno` varchar(10) NOT NULL,
  `yscore` varchar(10) NOT NULL,
  `tscore` varchar(10) NOT NULL,
  `aver` varchar(10) NOT NULL,
  `ttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_exam_ans`
--

CREATE TABLE `sec_fobrain_exam_ans` (
  `aID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `reg_id` int(10) NOT NULL,
  `regNo` varchar(14) DEFAULT NULL,
  `answers` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_exam_questions`
--

CREATE TABLE `sec_fobrain_exam_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text DEFAULT NULL,
  `qAnswer` varchar(100) DEFAULT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `q4` text NOT NULL,
  `ans` enum('1','2','3','4') DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_form_teachers`
--

CREATE TABLE `sec_fobrain_form_teachers` (
  `form_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `t_id` int(10) NOT NULL,
  `session` int(10) DEFAULT NULL,
  `level` tinyint(3) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_hm_review`
--

CREATE TABLE `sec_fobrain_hm_review` (
  `rid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `regnum` varchar(20) NOT NULL,
  `eid` varchar(20) NOT NULL,
  `course` varchar(100) NOT NULL,
  `level` enum('1','2','3','4','5','6') NOT NULL,
  `class` varchar(50) NOT NULL,
  `term` tinyint(1) NOT NULL,
  `etime` varchar(10) NOT NULL,
  `correct` varchar(10) NOT NULL,
  `quesno` varchar(10) NOT NULL,
  `yscore` varchar(10) NOT NULL,
  `tscore` varchar(10) NOT NULL,
  `aver` varchar(10) NOT NULL,
  `ttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_hostel`
--

CREATE TABLE `sec_fobrain_hostel` (
  `h_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `hostel` varchar(200) DEFAULT NULL,
  `h_limit` int(10) DEFAULT NULL,
  `h_desc` text DEFAULT NULL,
  `h_master` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_live_class`
--

CREATE TABLE `sec_fobrain_live_class` (
  `cid` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `meetid` varchar(50) NOT NULL,
  `participant` text NOT NULL,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `cTime` datetime NOT NULL,
  `sTime` varchar(30) NOT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_regno`
--

CREATE TABLE `sec_fobrain_regno` (
  `ireg_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nk_regno` varchar(16) NOT NULL DEFAULT '0',
  `class_1` varchar(10) DEFAULT NULL,
  `class_2` varchar(10) DEFAULT NULL,
  `class_3` varchar(10) DEFAULT NULL,
  `class_4` varchar(10) DEFAULT NULL,
  `class_5` varchar(10) DEFAULT NULL,
  `class_6` varchar(10) DEFAULT NULL,
  `rs_1` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_2` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_3` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_4` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_5` varchar(10) NOT NULL DEFAULT '0,0,0',
  `rs_6` varchar(10) NOT NULL DEFAULT '0,0,0',
  `jss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `sss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `current_class` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `s_dept` enum('1','2','3') DEFAULT NULL,
  `en_level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `en_term` enum('1','2','3') DEFAULT NULL,
  `session_id` tinyint(4) DEFAULT NULL,
  `date_regs` date NOT NULL,
  `active` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_student_record`
--

CREATE TABLE `sec_fobrain_student_record` (
  `stu_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `i_stupic` varchar(60) DEFAULT NULL,
  `i_accesspass` varchar(255) DEFAULT NULL,
  `i_salted` char(30) DEFAULT NULL,
  `i_firstname` varchar(50) DEFAULT NULL,
  `i_midname` varchar(50) DEFAULT NULL,
  `i_lastname` varchar(50) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_country` varchar(50) DEFAULT NULL,
  `i_state` varchar(50) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(50) DEFAULT NULL,
  `i_add_fi` varchar(100) DEFAULT NULL,
  `i_add_se` varchar(100) DEFAULT NULL,
  `i_stu_phone` varchar(30) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `sibling` longtext DEFAULT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(50) DEFAULT NULL,
  `i_spon_occup` varchar(100) DEFAULT NULL,
  `i_spo_add` varchar(100) DEFAULT NULL,
  `i_sponsor_ac` char(30) DEFAULT NULL,
  `i_sponsor_p` varchar(255) DEFAULT NULL,
  `sponsor2` varchar(100) DEFAULT NULL,
  `sponphone2` varchar(30) DEFAULT NULL,
  `soccup2` varchar(100) DEFAULT NULL,
  `sponadd2` text DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `disability` varchar(60) DEFAULT NULL,
  `hostel` tinyint(5) DEFAULT NULL,
  `route` tinyint(5) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `prevsch` varchar(200) DEFAULT NULL,
  `bcert` varchar(50) DEFAULT NULL,
  `guardid` varchar(50) DEFAULT NULL,
  `prevcert` varchar(50) DEFAULT NULL,
  `secuinfo` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_fobrain_timetb`
--

CREATE TABLE `sec_fobrain_timetb` (
  `id` int(18) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `title` VARCHAR(100) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_assign_subject_teachers`
--

CREATE TABLE `fobrain_assign_subject_teachers` (
  `assign_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `t_id` int(10) DEFAULT NULL,
  `sub_id` int(10) NOT NULL,
  `session` int(10) DEFAULT NULL,
  `level` tinyint(3) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_broadcast`
--

CREATE TABLE `fobrain_broadcast` (
  `bID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `bTitle` varchar(100) DEFAULT NULL,
  `broadcastMsg` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `bid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  `acc` varchar(150) DEFAULT NULL,
  `accno` varchar(150) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `balance` varchar(100) DEFAULT NULL,
  `edate` datetime DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_transaction`
--

CREATE TABLE `bank_transaction` (
  `tid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  `acc1` int(10) NOT NULL,
  `acc2` int(10) DEFAULT NULL,
  `amount` decimal(19,4) NOT NULL,
  `pbal` decimal(19,4) NOT NULL,
  `nbal` decimal(19,4) NOT NULL,
  `tdate` datetime NOT NULL,
  `descr` text DEFAULT NULL,
  `status` enum('0','1','2','3') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_transaction`
--

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_bursary`
--

CREATE TABLE `fobrain_bursary` (
  `b_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `account` INT(10) NOT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `bank` text DEFAULT NULL,
  `stax` varchar(10) DEFAULT NULL,
  `ptax` varchar(10) DEFAULT NULL,
  `allow` ENUM('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_bursary`
--

INSERT INTO `fobrain_bursary` (`b_id`, `currency`, `bank`, `stax`, `ptax`, `allow`) VALUES
(1, 'NGN', 'Igweze Ebele Mark\r\n101010101010\r\nfobrain Bank', '0.0912', '0.091355', '0');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_chart_accounts`
--

CREATE TABLE `fobrain_chart_accounts` (
  `cid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  `acc` varchar(150) DEFAULT NULL,
  `acc_type` ENUM('1','2','3','4','5','6','7','8','9') NOT NULL,
  `st_type` ENUM('1','2','3','4','5') NOT NULL,
  `st_group` ENUM('0','1','2','3','4','5')  NOT NULL DEFAULT '0',
  `balance` varchar(100) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `cstatus` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_chart_accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_chart_journal`
--

CREATE TABLE `fobrain_chart_journal` (
  `jid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  `transid` VARCHAR(100) NOT NULL, 
  `transact` ENUM('0', '1','2','3','4','5','6','7','8') NOT NULL,
  `account` mediumint(10) NOT NULL, 
  `credit` decimal(19,4) DEFAULT NULL,
  `debit` decimal(19,4) DEFAULT NULL,
  `balance` decimal(19,4) DEFAULT NULL,
  `jdate` date DEFAULT NULL,
  `jtime` datetime DEFAULT NULL,
  `descr` text DEFAULT NULL, 
  `jstatus` enum('0','1','2','3','4') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_chart_journal`
--

-- --------------------------------------------------------
--
-- Table structure for table `fobrain_club`
--

CREATE TABLE `fobrain_club` (
  `club_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `club` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_config_nur`
--

CREATE TABLE `fobrain_config_nur` (
  `cf_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cf_raw` varchar(15) DEFAULT NULL,
  `cf_code` varchar(10) DEFAULT NULL,
  `cf_tittle` varchar(80) DEFAULT NULL,
  `cf_staff` text DEFAULT NULL,
  `cf_tot` varchar(15) DEFAULT NULL,
  `cf_pos` varchar(15) DEFAULT NULL,
  `cf_com` varchar(15) DEFAULT NULL,
  `cf_level` tinyint(1) DEFAULT NULL,
  `cf_term` enum('1','2','3') DEFAULT NULL,
  `cf_program` tinyint(1) DEFAULT NULL,
  `cf_status` enum('0','1') NOT NULL DEFAULT '1',
  `sub_mpass` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_config_pri`
--

CREATE TABLE `fobrain_config_pri` (
  `cf_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cf_raw` varchar(15) DEFAULT NULL,
  `cf_code` varchar(10) DEFAULT NULL,
  `cf_tittle` varchar(80) DEFAULT NULL,
  `cf_staff` text DEFAULT NULL,
  `cf_tot` varchar(15) DEFAULT NULL,
  `cf_pos` varchar(15) DEFAULT NULL,
  `cf_com` varchar(15) DEFAULT NULL,
  `cf_level` tinyint(1) DEFAULT NULL,
  `cf_term` enum('1','2','3') DEFAULT NULL,
  `cf_program` tinyint(1) DEFAULT NULL,
  `cf_status` enum('0','1') NOT NULL DEFAULT '1',
  `sub_mpass` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_config_sec`
--

CREATE TABLE `fobrain_config_sec` (
  `cf_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cf_raw` varchar(15) DEFAULT NULL,
  `cf_code` varchar(10) DEFAULT NULL,
  `cf_tittle` varchar(80) DEFAULT NULL,
  `cf_staff` text DEFAULT NULL,
  `cf_tot` varchar(15) DEFAULT NULL,
  `cf_pos` varchar(15) DEFAULT NULL,
  `cf_com` varchar(15) DEFAULT NULL,
  `cf_level` tinyint(1) DEFAULT NULL,
  `cf_term` enum('1','2','3') DEFAULT NULL,
  `cf_program` tinyint(1) DEFAULT NULL,
  `cf_status` enum('0','1') NOT NULL DEFAULT '1',
  `sub_mpass` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_cpost`
--

CREATE TABLE `fobrain_cpost` (
  `club_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `club_post` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_cw_comments`
--

CREATE TABLE `fobrain_cw_comments` (
  `comment_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_title` text NOT NULL,
  `comment_pic` varchar(80) NOT NULL,
  `comment_date` int(11) NOT NULL,
  `comment_user` varchar(11) NOT NULL,
  `comment_ip` varchar(40) DEFAULT NULL,
  `delcom` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_cw_forum`
--

CREATE TABLE `fobrain_cw_forum` (
  `member_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `member_reg` varchar(20) NOT NULL,
  `member_mail` varchar(60) DEFAULT NULL,
  `profile_pic` varchar(40) DEFAULT NULL,
  `wall_pic` varchar(40) DEFAULT NULL,
  `member_name` varchar(50) NOT NULL,
  `member_sex` enum('0','1','2') NOT NULL,
  `member_dept` tinyint(3) NOT NULL,
  `member_faculty` tinyint(3) NOT NULL,
  `member_program` tinyint(3) DEFAULT NULL,
  `member_rank` enum('1','2','3') NOT NULL DEFAULT '1',
  `s_grade` enum('0','1','2','3','4','5','6','7','8','9') NOT NULL DEFAULT '0',
  `load_page` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_cw_ireport`
--

CREATE TABLE `fobrain_cw_ireport` (
  `report_id_idgsi` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `comment_id_idgsi` int(11) NOT NULL DEFAULT 0,
  `article_id_idgsi` int(11) NOT NULL DEFAULT 0,
  `report_idgsi` text NOT NULL,
  `reporting_user_idgsi` int(11) NOT NULL DEFAULT 0,
  `reported_user_idgsi` int(11) NOT NULL DEFAULT 0,
  `date_idgsi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_cw_likes_track`
--

CREATE TABLE `fobrain_cw_likes_track` (
  `likes_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_cw_mailbox`
--

CREATE TABLE `fobrain_cw_mailbox` (
  `msg_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `njnk_title` varchar(256) NOT NULL,
  `njnk_msg` text NOT NULL,
  `njnk_time` int(11) NOT NULL,
  `njnk_status` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `njnk_sender_id` int(10) NOT NULL,
  `njnk_reps_id` int(10) NOT NULL,
  `njnk_sender_ip` varchar(40) NOT NULL,
  `njnk_type` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `njnk_trash` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_cw_notification`
--

CREATE TABLE `fobrain_cw_notification` (
  `not_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  `senders_id` varchar(255) NOT NULL,
  `not_time` int(11) NOT NULL,
  `not_type` enum('1','2','3','4') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_cw_posts`
--

CREATE TABLE `fobrain_cw_posts` (
  `post_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `author_id` varchar(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_msg` text DEFAULT NULL,
  `post_img_fi` varchar(80) DEFAULT NULL,
  `post_img_se` varchar(80) DEFAULT NULL,
  `post_img_th` varchar(80) DEFAULT NULL,
  `post_img_fo` varchar(80) DEFAULT NULL,
  `post_url` text DEFAULT NULL,
  `post_date` int(11) DEFAULT NULL,
  `post_ip` varchar(40) DEFAULT NULL,
  `post_type` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `d_id` tinyint(4) DEFAULT NULL,
  `f_id` tinyint(4) DEFAULT NULL,
  `delpost` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_cw_temp_upload_pic`
--

CREATE TABLE `fobrain_cw_temp_upload_pic` (
  `upload_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `upload_pathp` varchar(30) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `upload_type` enum('1','2') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_disability`
--

CREATE TABLE `fobrain_disability` (
  `id_dis` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `disability` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_disability`
--

INSERT INTO `fobrain_disability` (`id_dis`, `disability`, `status`) VALUES
(1, ' Autism spectrum disorders', '1'),
(2, 'Hearing Loss and Deafness', '1'),
(3, 'Chronic Illness', '1'),
(4, 'Learning Disability', '1'),
(5, 'Memory Loss', '1'),
(6, 'Mental health and emotional disabilities', '1'),
(7, 'Physical Disability', '1'),
(8, 'Language Disorders', '1'),
(9, 'Intellectual Disability', '1'),
(10, 'Balance disorder', '1'),
(11, 'Developmental disability', '1'),
(12, 'Somatosensory impairment', '1'),
(13, 'Olfactory and gustatory impairment', '1'),
(14, 'Omar', '1');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_events_notification`
--

CREATE TABLE `fobrain_events_notification` (
  `id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_ewallet_nkiruka`
--

CREATE TABLE `fobrain_ewallet_nkiruka` (
  `iiii_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `iiii_pin_iiii` varchar(24) DEFAULT NULL,
  `iiii_serial_iiii` varchar(40) DEFAULT NULL,
  `iiii_reg` varchar(30) DEFAULT NULL,
  `iiii_reg_id` int(10) DEFAULT NULL,
  `iiii_level` tinyint(3) DEFAULT NULL,
  `iiii_term` tinyint(3) DEFAULT NULL,
  `iiii_time` int(11) DEFAULT NULL,
  `iiii_stype` enum('1','2','3','4') DEFAULT NULL,
  `iiii_status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_expense`
--

CREATE TABLE `fobrain_expense` (
  `eid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  `title` varchar(255) NOT NULL,
  `pid` varchar(255) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `acc` int(10) NOT NULL,
  `expense` text DEFAULT NULL,
  `method` ENUM('1','2','3','4','5') NOT NULL,
  `total` varchar(50) NOT NULL,
  `tags` text DEFAULT NULL,
  `edate` date NOT NULL,
  `rtime` datetime NOT NULL,
  `memo` text DEFAULT NULL,
  `transact` ENUM('1','2','3','4') NOT NULL DEFAULT '3',
  `status` enum('0','1','2','3') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_expense_category`
--

CREATE TABLE `fobrain_expense_category` (
  `e_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `expense` varchar(100) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_fees`
--
-- --------------------------------------------------------

--
-- Table structure for table `fobrain_expense_docs`
--

CREATE TABLE `fobrain_expense_docs` (
  `eid` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  `doc` varchar(150) NOT NULL,
  `pid` varchar(150) NOT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_expense_docs`
--

CREATE TABLE `fobrain_fees` (
  `fID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `acc` INT(10) NOT NULL,
  `feeCat` tinyint(3) NOT NULL,
  `feeAmount` decimal(19,4) DEFAULT NULL,
  `session` tinyint(3) DEFAULT NULL,
  `reg_id` int(10) NOT NULL,
  `regNo` varchar(14) DEFAULT NULL,
  `stype` enum('1','2','3') DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `class` varchar(2) DEFAULT NULL,
  `term` enum('1','2','3') DEFAULT NULL,
  `method` enum('1','2','3','4') DEFAULT NULL,
  `method2` enum('1','2','3','4') NOT NULL,
  `f_details` text DEFAULT NULL,
  `upload` varchar(50) NOT NULL,
  `amount` decimal(19,4) DEFAULT NULL,
  `upload2` varchar(50) NOT NULL,
  `amount2` decimal(19,4) NOT NULL,
  `balance` decimal(19,4) DEFAULT NULL,
  `waiver` varchar(20) NOT NULL,
  `efine` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `f_status` enum('0','1') DEFAULT '0',
  `pstatus` enum('0','1','2','3') NOT NULL DEFAULT '1',
  `pstatus2` ENUM('0', '1', '2', '3') NOT NULL DEFAULT '1',
  `n_pay` enum('1','2','3') NOT NULL DEFAULT '1',
  `transact` ENUM('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_fee_category`
--

CREATE TABLE `fobrain_fee_category` (
  `f_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fee` varchar(100) DEFAULT NULL,
  `amount` int(10) NOT NULL,
  `account` INT(10) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_grades`
--

CREATE TABLE `fobrain_grades` (
  `gID` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fromGrade` varchar(5) DEFAULT NULL,
  `toGrade` varchar(5) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_grades`
--

INSERT INTO `fobrain_grades` (`gID`, `fromGrade`, `toGrade`, `grade`) VALUES
(1, '0', '34', 'F'),
(2, '35', '39', 'E8'),
(3, '40', '49', 'D7'),
(4, '50', '54', 'C6'),
(5, '55', '59', 'C5'),
(6, '60', '64', 'C4'),
(7, '65', '69', 'B3'),
(8, '70', '74', 'B2'),
(9, '75', '100', 'A1');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_leave`
--

CREATE TABLE `fobrain_leave` (
  `lid` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `leave_c` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_library`
--

CREATE TABLE `fobrain_library` (
  `book_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `book_name` varchar(100) DEFAULT NULL,
  `book_author` varchar(100) DEFAULT NULL,
  `book_desc` varchar(255) DEFAULT NULL,
  `book_path` varchar(40) DEFAULT NULL,
  `book_price` varchar(15) DEFAULT NULL,
  `book_type` enum('1','2') DEFAULT NULL,
  `book_hits` int(10) NOT NULL DEFAULT 0,
  `book_copies` mediumint(5) DEFAULT NULL,
  `book_location` varchar(255) DEFAULT NULL,
  `stype` enum('1','2','3') NOT NULL,
  `sclass` enum('1','2','3','4','5','6','7') NOT NULL DEFAULT '7',
  `book_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_library_apply`
--

CREATE TABLE `fobrain_library_apply` (
  `b_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `book_id` int(10) NOT NULL,
  `lib_user` int(30) DEFAULT NULL,
  `lib_reg` varchar(30) DEFAULT NULL,
  `apply_date` datetime DEFAULT NULL,
  `d_reasons` varchar(150) DEFAULT NULL,
  `approve_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `stype` enum('1','2','3') DEFAULT NULL,
  `sclass` int(4) DEFAULT NULL,
  `b_status` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_library_configs`
--

CREATE TABLE `fobrain_library_configs` (
  `c_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `book_no_apply` tinyint(3) DEFAULT NULL,
  `book_no_borrow` tinyint(3) DEFAULT NULL,
  `book_dateline` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_library_configs`
--

INSERT INTO `fobrain_library_configs` (`c_id`, `book_no_apply`, `book_no_borrow`, `book_dateline`) VALUES
(1, 10, 5, '30 DAY');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_order_summ`
--

CREATE TABLE `fobrain_order_summ` (
  `s_id` int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `order_id` int(20) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `qty` tinyint(2) DEFAULT NULL,
  `price` decimal(19,4) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_parent_meet`
--

CREATE TABLE `fobrain_parent_meet` (
  `cid` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `meetid` varchar(50) NOT NULL,
  `participant` text NOT NULL,
  `school` varchar(5) NOT NULL,
  `info` varchar(30) NOT NULL,
  `session` tinyint(3) NOT NULL,
  `level` enum('1','2','3','4','5','6') NOT NULL,
  `eType` enum('1','2','3') NOT NULL,
  `allow` enum('0','1') NOT NULL DEFAULT '0',
  `class` varchar(3) NOT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `cTime` datetime NOT NULL,
  `sTime` varchar(30) NOT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `staffs` text NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_payment_gateway`
--

CREATE TABLE `fobrain_payment_gateway` (
  `gID` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `gateway` varchar(50) DEFAULT NULL,
  `gatewayVerb` varchar(30) DEFAULT NULL,
  `gateKey` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_payment_gateway`
--

INSERT INTO `fobrain_payment_gateway` (`gID`, `gateway`, `gatewayVerb`, `gateKey`) VALUES
(1, 'Paypal', 'Paypal Business Email', 'igweze@gmail.com'),
(2, '2Checkout', '2Checkout Account Key', '901342101'),
(3, 'Paystack', 'Paystack Public Key', 'pk_test_a4787362baf189d4bee36ce7047a25e32c938766');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_payroll`
--

CREATE TABLE `fobrain_payroll` (
  `pid` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `acc` INT(10) NOT NULL,
  `staff` mediumint(5) NOT NULL,
  `bursar` SMALLINT(10) NOT NULL,
  `transid` VARCHAR(100) DEFAULT NULL,
  `salary` varchar(20) NOT NULL,
  `nsalary` varchar(20) NOT NULL,
  `tax` varchar(10) DEFAULT NULL,
  `ded1` varchar(100) DEFAULT NULL,
  `earn1` varchar(100) DEFAULT NULL,
  `ded2` varchar(100) DEFAULT NULL,
  `earn2` varchar(100) DEFAULT NULL,
  `ded3` varchar(100) DEFAULT NULL,
  `earn3` varchar(100) DEFAULT NULL,
  `pmethod` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `details` text DEFAULT NULL,
  `upload` VARCHAR(100) DEFAULT NULL,
  `dpaid` date NOT NULL,
  `transact` ENUM('1','2','3','4') NOT NULL DEFAULT '4',
  `status` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_products`
--

CREATE TABLE `fobrain_products` (
  `pID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cat_id` tinyint(3) DEFAULT NULL,
  `p_title` varchar(255) DEFAULT NULL,
  `p_description` text DEFAULT NULL,
  `p_price` varchar(10) DEFAULT NULL,
  `x_price` varchar(10) DEFAULT NULL,
  `p_date` date DEFAULT NULL,
  `p_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_product_category`
--

CREATE TABLE `fobrain_product_category` (
  `p_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `product` varchar(100) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_product_order`
--

CREATE TABLE `fobrain_product_order` (
  `order_id` int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `acc` INT(10) NOT NULL,
  `reg_id` int(10) DEFAULT NULL,
  `regNo` varchar(14) DEFAULT NULL,
  `stype` enum('1','2','3') DEFAULT NULL,
  `orderIP` text DEFAULT NULL,
  `orderDate` date NULL DEFAULT NULL,
  `transact` ENUM('1','2','3','4') NOT NULL DEFAULT '2',
  `status` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_product_pic`
--

CREATE TABLE `fobrain_product_pic` (
  `pic_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_registration`
--

CREATE TABLE `fobrain_registration` (
  `stu_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `i_stupic` varchar(60) DEFAULT NULL,
  `i_school` enum('1','2','3') DEFAULT NULL,
  `i_level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `i_firstname` varchar(50) DEFAULT NULL,
  `i_midname` varchar(50) DEFAULT NULL,
  `i_lastname` varchar(50) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_country` varchar(50) DEFAULT NULL,
  `i_state` varchar(50) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(50) DEFAULT NULL,
  `i_add_fi` varchar(100) DEFAULT NULL,
  `i_add_se` varchar(100) DEFAULT NULL,
  `i_stu_phone` varchar(20) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(50) DEFAULT NULL,
  `i_spon_occup` varchar(50) NOT NULL,
  `i_spo_add` varchar(100) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `disability` varchar(60) DEFAULT NULL,
  `reg_date` int(11) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_remarks`
--

CREATE TABLE `fobrain_remarks` (
  `id_rem` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `remarks` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_remarks`
--

INSERT INTO `fobrain_remarks` (`id_rem`, `remarks`, `status`) VALUES
(1, 'A very obedient student', '1'),
(2, ' Very dull in class', '1'),
(3, 'Talks too much durin lessons', '1'),
(4, 'Reserved student', '1'),
(5, 'Has leadership abilities', '1'),
(6, 'Very innovative', '1'),
(7, 'Participates poorly in class and school activities', '1'),
(8, 'Participates actively in class and school activities', '1'),
(9, 'Shy in class', '1'),
(10, 'Too playful', '1'),
(11, 'Very careless', '1'),
(12, 'Steals from fellow students', '1'),
(13, 'Begs for food and other items from fellow students', '1'),
(14, 'Very jovial', '1'),
(15, 'Friendly and social', '1');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_route`
--

CREATE TABLE `fobrain_route` (
  `r_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `route` varchar(200) DEFAULT NULL,
  `r_amout` int(10) DEFAULT NULL,
  `r_desc` text DEFAULT NULL,
  `r_master` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_schoolinfo`
--

CREATE TABLE `fobrain_schoolinfo` (
  `school_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `school_name` varchar(256) DEFAULT NULL,
  `school_address` varchar(256) DEFAULT NULL,
  `reg_prefix` varchar(10) DEFAULT NULL,
  `school_cutoff` tinyint(3) NOT NULL,
  `school_head` varchar(100) DEFAULT NULL,
  `bursary` smallint(5) DEFAULT NULL,
  `libraian` smallint(5) DEFAULT NULL,
  `school_theme` varchar(10) DEFAULT NULL,
  `school_logo` varchar(30) DEFAULT NULL,
  `school_sub_cutoff` tinyint(3) NOT NULL,
  `translator` varchar(30) DEFAULT NULL,
  `screen_timer` varchar(10) DEFAULT NULL,
  `ewallet` enum('0','1','2') NOT NULL DEFAULT '2',
  `tzone` VARCHAR(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_schoolinfo`
--

INSERT INTO `fobrain_schoolinfo` (`school_id`, `school_name`, `school_address`, `reg_prefix`, `school_cutoff`, `school_head`, `bursary`, `libraian`, `school_theme`, `school_logo`, `school_sub_cutoff`, `translator`, `screen_timer`, `ewallet`) VALUES
(1, 'Your School Name', 'School Address', 'SDOSMS', 45, '17,6,2', 3, 5, '473C8B', '0776700001721396748WLPmLs.png', 40, 'en/en', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_school_subjects`
--

CREATE TABLE `fobrain_school_subjects` (
  `sub_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `subjects` varchar(100) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_session`
--

CREATE TABLE `fobrain_session` (
  `id_sess` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `year` int(4) NOT NULL,
  `fi_term` date NOT NULL,
  `se_term` date NOT NULL,
  `th_term` date NOT NULL,
  `rtf_fi` varchar(20) DEFAULT NULL,
  `rtf_se` varchar(20) DEFAULT NULL,
  `rtf_th` varchar(20) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `current` enum('0','1') NOT NULL DEFAULT '0',
  `cur_term` enum('1','2','3') DEFAULT NULL,
  `lastreg` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_session`
--

INSERT INTO `fobrain_session` (`id_sess`, `year`, `fi_term`, `se_term`, `th_term`, `rtf_fi`, `rtf_se`, `rtf_th`, `status`, `current`, `cur_term`, `lastreg`) VALUES
(10, 2009, '2024-06-20', '2024-06-21', '2024-06-22', NULL, NULL, NULL, '0', '0', '', NULL),
(11, 2010, '2024-06-20', '2024-06-21', '2024-06-23', NULL, NULL, NULL, '0', '0', NULL, NULL),
(12, 2011, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(13, 2012, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(14, 2013, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', '', NULL),
(15, 2014, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', '', NULL),
(16, 2015, '2024-06-20', '2024-06-21', '2024-06-23', NULL, NULL, NULL, '0', '0', '', NULL),
(17, 2016, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', '', NULL),
(18, 2017, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(19, 2018, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(20, 2019, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(21, 2020, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(22, 2021, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(23, 2022, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(24, 2023, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(25, 2024, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(26, 2025, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '1', '1', NULL),
(27, 2026, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(28, 2027, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(29, 2028, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(30, 2029, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL),
(31, 2030, '0000-00-00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '0', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_sms`
--

CREATE TABLE `fobrain_sms` (
  `sID` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `gateway` varchar(50) DEFAULT NULL,
  `senderID` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `api` varchar(500) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_sms`
--

INSERT INTO `fobrain_sms` (`sID`, `gateway`, `senderID`, `user`, `password`, `api`, `status`) VALUES
(1, '1s2u', NULL, NULL, NULL, NULL, '1'),
(2, 'BulkSMSNigeria', NULL, NULL, NULL, NULL, '0'),
(3, 'smsclone', NULL, '', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_mail`
--

CREATE TABLE `fobrain_mail` (
  `mID` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `send_name` varchar(100) DEFAULT NULL,
  `send_host` varchar(100) DEFAULT NULL,
  `send_mail` varchar(100) DEFAULT NULL,
  `send_pass` varchar(100) DEFAULT NULL,
  `footer` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 
-- Dumping data for table `fobrain_mail`
--

INSERT INTO `fobrain_mail` (`mID`, `send_name`, `send_host`, `send_mail`, `send_pass`, `footer`, `status`) VALUES
(1, 'FoBrain School', 'mail.fobrain.com', '', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_sports`
--

CREATE TABLE `fobrain_sports` (
  `sport_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `sport` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_sports`
--

INSERT INTO `fobrain_sports` (`sport_id`, `sport`, `status`) VALUES
(1, 'Foot ball ', '1'),
(2, 'Volleyball', '1'),
(3, 'Running', '1'),
(4, 'Handball', '1'),
(5, 'Long Jump', '1'),
(6, 'Swimming', '1'),
(7, 'High Jump', '1'),
(8, 'Basket Ball', '1'),
(9, ' Lawn Tennis ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_staff_leave`
--

CREATE TABLE `fobrain_staff_leave` (
  `l_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `staff` smallint(5) NOT NULL,
  `l_type` smallint(5) NOT NULL,
  `l_apply` varchar(100) NOT NULL,
  `l_days` varchar(10) NOT NULL,
  `l_date` datetime DEFAULT NULL,
  `status` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_staff_meet`
--

CREATE TABLE `fobrain_staff_meet` (
  `cid` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `meetid` varchar(50) NOT NULL,
  `participant` text NOT NULL,
  `eType` enum('1','2','3') NOT NULL,
  `allow` enum('0','1') NOT NULL DEFAULT '0',
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `cTime` datetime NOT NULL,
  `sTime` varchar(30) NOT NULL,
  `eDetail` text DEFAULT NULL,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `staffs` text NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_teacher_rank`
--

CREATE TABLE `fobrain_teacher_rank` (
  `rank_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ranking` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_teacher_rank`
--

INSERT INTO `fobrain_teacher_rank` (`rank_id`, `ranking`, `status`) VALUES
(1, 'Principal', '1'),
(2, 'Vice Principal', '1'),
(3, 'Head Master', '1'),
(4, 'Head Miss', '1'),
(5, 'Teacher', '1'),
(6, 'Lab Teacher', '1'),
(7, 'Sports Master', '1'),
(8, 'Sports Mistress', '1'),
(9, 'Dean of Studies', '1'),
(10, 'Computer Teacher', '1');

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_virtual_gateway`
--

CREATE TABLE `fobrain_virtual_gateway` (
  `gID` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `gateway` varchar(50) DEFAULT NULL,
  `gatewayVerb` varchar(30) DEFAULT NULL,
  `gateKey` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fobrain_virtual_gateway`
--

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_temp`
--

CREATE TABLE `fobrain_temp` (
  `tID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `genID` varchar(30) DEFAULT NULL,
  `staffID` smallint(5) DEFAULT NULL,
  `cCount` tinyint(5) DEFAULT NULL,
  `gTime` int(11) DEFAULT NULL,
  `tTitle` varchar(250) DEFAULT NULL,
  `temType` enum('1','2','3','4') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_temp_data`
--

CREATE TABLE `fobrain_temp_data` (
  `tdID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `genID` varchar(30) DEFAULT NULL,
  `regID` varchar(30) DEFAULT NULL,
  `userName` varchar(5) DEFAULT NULL,
  `temData` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fobrain_tem_student_record`
--

CREATE TABLE `fobrain_tem_student_record` (
  `stu_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `u_id` varchar(30) NOT NULL,
  `i_firstname` varchar(40) DEFAULT NULL,
  `i_midname` varchar(30) DEFAULT NULL,
  `i_lastname` varchar(40) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_country` varchar(40) DEFAULT NULL,
  `i_state` varchar(30) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(30) DEFAULT NULL,
  `i_add_fi` varchar(60) DEFAULT NULL,
  `i_add_se` varchar(60) DEFAULT NULL,
  `i_stu_phone` varchar(50) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `hostel_id` smallint(5) NOT NULL,
  `route_id` smallint(5) NOT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(50) DEFAULT NULL,
  `i_spo_add` varchar(60) DEFAULT NULL,
  `i_sponsor_ac` char(30) DEFAULT NULL,
  `i_sponsor_p` varchar(255) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `level` tinyint(1) NOT NULL,
  `class` varchar(3) DEFAULT NULL,
  `sessID` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nur_fobrain_class`
--
ALTER TABLE `nur_fobrain_class`
  MODIFY `cl_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nur_fobrain_exams_config`
--
ALTER TABLE `nur_fobrain_exams_config`
  MODIFY `ex_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pri_fobrain_class`
--
ALTER TABLE `pri_fobrain_class`
  MODIFY `cl_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pri_fobrain_exams_config`
--
ALTER TABLE `pri_fobrain_exams_config`
  MODIFY `ex_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sec_fobrain_class`
--
ALTER TABLE `sec_fobrain_class`
  MODIFY `cl_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sec_fobrain_exams_config`
--
ALTER TABLE `sec_fobrain_exams_config`
  MODIFY `ex_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fobrain_bursary`
--
ALTER TABLE `fobrain_bursary`
  MODIFY `b_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fobrain_disability`
--
ALTER TABLE `fobrain_disability`
  MODIFY `id_dis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fobrain_grades`
--
ALTER TABLE `fobrain_grades`
  MODIFY `gID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fobrain_library_configs`
--
ALTER TABLE `fobrain_library_configs`
  MODIFY `c_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fobrain_payment_gateway`
--
ALTER TABLE `fobrain_payment_gateway`
  MODIFY `gID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fobrain_remarks`
--
ALTER TABLE `fobrain_remarks`
  MODIFY `id_rem` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fobrain_schoolinfo`
--
ALTER TABLE `fobrain_schoolinfo`
  MODIFY `school_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fobrain_session`
--
ALTER TABLE `fobrain_session`
  MODIFY `id_sess` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `fobrain_sms`
--
ALTER TABLE `fobrain_sms`
  MODIFY `sID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fobrain_sports`
--
ALTER TABLE `fobrain_sports`
  MODIFY `sport_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fobrain_teacher_rank`
--
ALTER TABLE `fobrain_teacher_rank`
  MODIFY `rank_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

COMMIT;