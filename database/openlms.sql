-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-07-26 16:02:27
-- 服务器版本： 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- 表的结构 `lms_books`
--

CREATE TABLE `lms_books` (
  `id` int(16) UNSIGNED NOT NULL COMMENT '图书的唯一ID号',
  `name` varchar(80) NOT NULL COMMENT '图书名称',
  `type` varchar(32) NOT NULL COMMENT '图书类型，例如：励志类型',
  `author` varchar(64) NOT NULL COMMENT '图书作者',
  `isbn` varchar(13) NOT NULL COMMENT 'ISBN',
  `publisher` varchar(80) NOT NULL COMMENT '出版商',
  `price` varchar(16) NOT NULL COMMENT '单价',
  `page` int(5) NOT NULL COMMENT '图书总页数',
  `intime` varchar(16) NOT NULL COMMENT '入库时间',
  `borrow` varchar(16) NOT NULL DEFAULT '0' COMMENT '被借阅 的次数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lms_books`
--

INSERT INTO `lms_books` (`id`, `name`, `type`, `author`, `isbn`, `publisher`, `price`, `page`, `intime`, `borrow`) VALUES
(1, 'HTML5从入门到精通', '计算机', '明日科技', '9787302287582', '清华大学出版社', '60', 430, '17-07-23', '0'),
(2, 'CentOS 7 系统管理与运维实战', '计算机', '王亚飞、王刚', '9787302423959', '清华大学出版社', '79', 426, '17-07-23', '1'),
(3, '灿烂千阳', '中外文学', '卡勒德-胡塞尼', '9787208072107', '上海人民出版社', '28', 428, '17-07-23', '1'),
(4, 'Linux服务器架设指南', '计算机', '林天峰、谭志彬', '9787302315973', '清华大学出版社', '80', 533, '17-07-23', '1');

-- --------------------------------------------------------

--
-- 表的结构 `lms_borrow`
--

CREATE TABLE `lms_borrow` (
  `id` int(16) UNSIGNED NOT NULL COMMENT '借阅单号',
  `book_name` varchar(80) NOT NULL COMMENT '图书名称',
  `book_isbn` varchar(13) NOT NULL COMMENT 'ISBN',
  `book_publisher` varchar(80) NOT NULL COMMENT '出版商',
  `stu_name` varchar(32) NOT NULL COMMENT '借阅人姓名',
  `stu_id` varchar(18) NOT NULL COMMENT '借阅人身份证号',
  `borrow_time` varchar(12) NOT NULL COMMENT '借出日期',
  `return_time` varchar(12) NOT NULL COMMENT '归还日期',
  `if_return` int(1) NOT NULL DEFAULT '1' COMMENT '是否归还：是0否1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lms_borrow`
--

INSERT INTO `lms_borrow` (`id`, `book_name`, `book_isbn`, `book_publisher`, `stu_name`, `stu_id`, `borrow_time`, `return_time`, `if_return`) VALUES
(1, 'CentOS 7 系统管理与运维实战', '9787302423959', '清华大学出版社', '李华', '36010130011231032X', '2017-07-24', '2017-10-25', 0),
(2, '追风筝的人', '9787208061644', '上海人民出版社', '李华', '36010130011231032X', '2017-09-30', '2017-12-31', 2),
(3, '灿烂千阳', '9787208072107', '上海人民出版社', '李华', '36010130011231032X', '2017-07-25', '2017-08-02', 1),
(4, 'Linux服务器架设指南', '9787302315973', '清华大学出版社', '李华', '36010130011231032X', '2017-11-30', '2018-01-31', 1);

-- --------------------------------------------------------

--
-- 表的结构 `lms_delay`
--

CREATE TABLE `lms_delay` (
  `id` int(16) UNSIGNED NOT NULL,
  `book_name` varchar(80) NOT NULL,
  `book_id` int(16) NOT NULL,
  `book_publisher` varchar(80) NOT NULL,
  `applicant_name` varchar(32) NOT NULL,
  `applicant_id` varchar(32) NOT NULL,
  `return_time` varchar(16) NOT NULL,
  `passed` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lms_delay`
--

INSERT INTO `lms_delay` (`id`, `book_name`, `book_id`, `book_publisher`, `applicant_name`, `applicant_id`, `return_time`, `passed`) VALUES
(1, '灿烂千阳', 3, '上海人民出版社', '李华', '36010130011231032X', '2017-10-31', 1);

-- --------------------------------------------------------

--
-- 表的结构 `lms_user`
--

CREATE TABLE `lms_user` (
  `id` int(32) UNSIGNED NOT NULL COMMENT '用户唯一ID号',
  `name` varchar(64) NOT NULL COMMENT '用户姓名',
  `gen_id` varchar(32) NOT NULL COMMENT '用户学号/工号',
  `id_card` varchar(18) NOT NULL COMMENT '用户身份证号',
  `password` varchar(80) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '1' COMMENT '判断是否为管理员，0真1假'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lms_user`
--

INSERT INTO `lms_user` (`id`, `name`, `gen_id`, `id_card`, `password`, `admin`) VALUES
(1, 'admin', '102788120034', '360101300001014816', 'openlms123', 0),
(2, '李华', '102788120035', '36010130011231032X', 'openlms123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lms_books`
--
ALTER TABLE `lms_books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `lms_borrow`
--
ALTER TABLE `lms_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_delay`
--
ALTER TABLE `lms_delay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_user`
--
ALTER TABLE `lms_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_card` (`id_card`),
  ADD UNIQUE KEY `gen_id` (`gen_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `lms_books`
--
ALTER TABLE `lms_books`
  MODIFY `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '图书的唯一ID号', AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `lms_borrow`
--
ALTER TABLE `lms_borrow`
  MODIFY `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '借阅单号', AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `lms_delay`
--
ALTER TABLE `lms_delay`
  MODIFY `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `lms_user`
--
ALTER TABLE `lms_user`
  MODIFY `id` int(32) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户唯一ID号', AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
