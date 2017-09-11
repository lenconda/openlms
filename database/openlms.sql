-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-07-31 14:59:48
-- 服务器版本： 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1
/*
Copyright (c) 2017 Peng Hanlin.
The software is published under the Apache License v2.0.
Authorized by Peng Hanlin in Nanchang, China.
Monday, 11, September, 2017
*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(1, 'HTML5从入门到精通', '经典著作', '明日科技', '9787302287582', '清华大学出版社', '60', 771000, '2017-07-23', '0'),
(2, 'CentOS 7 系统管理与运维实战', '经典著作', '王亚飞、王刚', '9787302423959', '清华大学出版社', '79', 704000, '2017-07-23', '1'),
(3, '灿烂千阳', '经典著作', '卡勒德-胡塞尼', '9787208072107', '上海人民出版社', '28', 280000, '2017-07-23', '1'),
(4, 'Linux服务器架设指南', '经典著作', '林天峰、谭志彬', '9787302315973', '清华大学出版社', '80', 890000, '2017-07-23', '1'),
(5, '21天学通C++', '经典著作', 'Siddhartha Rao', '9787115296245', '人民邮电出版社', '59', 870000, '2017-07-31', '0'),
(6, '黑客攻防技术宝典 Web实战篇', '经典著作', 'Dafydd Stuttard,Marcus Pinto', '9787115283924', '人民邮电出版社', '99', 957000, '2017-07-31', '1'),
(7, '史蒂夫乔布斯传', '经典著作', '沃尔特-艾萨克森', '9787508643298', '中信出版社', '68', 560000, '2017-07-31', '0'),
(8, 'Kali Linux渗透测试的艺术', '经典著作', 'Lee Allen,Tedi Heriyanto,Shakeel Ali', '9787115378446', '人民邮电出版社', '69', 505000, '2017-07-31', '0'),
(9, 'Web渗透测试-使用Kali Linux', '经典著作', 'Joseph Muniz,Aamir Lakhani', '9787115363152', '人民邮电出版社', '59', 413000, '2017-07-31', '0'),
(10, 'Python基础教程', '经典著作', 'Magnus Lie Hetland', '9787115353528', '人民邮电出版社', '79', 727000, '2017-07-31', '0'),
(11, 'C程序设计', '经典著作', '谭浩强', '9787302108535', '清华大学出版社', '30', 592000, '2017-07-31', '0'),
(12, '咬文嚼字2013合订本', '中外文学', '《咬文嚼字》编辑部', '9787545212464', '上海锦绣文章出版社', '28', 592000, '2017-07-31', '0');

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
(4, 'Linux服务器架设指南', '9787302315973', '清华大学出版社', '李华', '36010130011231032X', '2017-11-30', '2018-01-31', 1),
(5, '黑客攻防技术宝典 Web实战篇', '9787115283924', '人民邮电出版社', '李华', '36010130011231032X', '2017-07-31', '2017-09-07', 1);

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
(1, '管理员', '102788120034', '360101300001014816', 'openlms123', 0),
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
  MODIFY `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '图书的唯一ID号', AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `lms_borrow`
--
ALTER TABLE `lms_borrow`
  MODIFY `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '借阅单号', AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `lms_delay`
--
ALTER TABLE `lms_delay`
  MODIFY `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `lms_user`
--
ALTER TABLE `lms_user`
  MODIFY `id` int(32) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户唯一ID号', AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
