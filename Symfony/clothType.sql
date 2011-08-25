-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2011 at 11:06 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `choumei`
--

-- --------------------------------------------------------

--
-- Table structure for table `ClothType`
--

CREATE TABLE `ClothType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CFF5F6C4727ACA70` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `ClothType`
--

INSERT INTO `ClothType` VALUES(1, '上身', NULL);
INSERT INTO `ClothType` VALUES(2, '下身', NULL);
INSERT INTO `ClothType` VALUES(3, '脚下', NULL);
INSERT INTO `ClothType` VALUES(4, '配饰', NULL);
INSERT INTO `ClothType` VALUES(5, '连身衣', 1);
INSERT INTO `ClothType` VALUES(6, '束腰上装', 1);
INSERT INTO `ClothType` VALUES(7, '衬衫', 1);
INSERT INTO `ClothType` VALUES(8, 'T-恤', 1);
INSERT INTO `ClothType` VALUES(9, '文胸', 1);
INSERT INTO `ClothType` VALUES(10, '泳装', 1);
INSERT INTO `ClothType` VALUES(11, '开禁羊毛衫', 1);
INSERT INTO `ClothType` VALUES(12, '毛衣', 1);
INSERT INTO `ClothType` VALUES(13, '高领套头衫', 1);
INSERT INTO `ClothType` VALUES(14, '马甲', 1);
INSERT INTO `ClothType` VALUES(15, '夹克/便装', 1);
INSERT INTO `ClothType` VALUES(16, '披肩', 1);
INSERT INTO `ClothType` VALUES(17, '大衣', 1);
INSERT INTO `ClothType` VALUES(18, '皮衣/裘皮', 1);
INSERT INTO `ClothType` VALUES(19, '休闲裤', 2);
INSERT INTO `ClothType` VALUES(20, '牛仔裤', 2);
INSERT INTO `ClothType` VALUES(21, '紧身裤', 2);
INSERT INTO `ClothType` VALUES(22, '连裤袜', 2);
INSERT INTO `ClothType` VALUES(23, '裙子', 2);
INSERT INTO `ClothType` VALUES(24, '短裤', 2);
INSERT INTO `ClothType` VALUES(25, '超短裙', 2);
INSERT INTO `ClothType` VALUES(26, '矮靴', 3);
INSERT INTO `ClothType` VALUES(27, '平底鞋', 3);
INSERT INTO `ClothType` VALUES(28, '高跟鞋', 3);
INSERT INTO `ClothType` VALUES(29, '坡跟鞋', 3);
INSERT INTO `ClothType` VALUES(30, '长靴', 3);
INSERT INTO `ClothType` VALUES(31, '运动鞋', 3);
INSERT INTO `ClothType` VALUES(32, '帽子', 4);
INSERT INTO `ClothType` VALUES(33, '腰带', 4);
INSERT INTO `ClothType` VALUES(34, '丝巾', 4);
INSERT INTO `ClothType` VALUES(35, '手套', 4);
INSERT INTO `ClothType` VALUES(36, '首饰', 4);
INSERT INTO `ClothType` VALUES(37, '眼镜', 4);
INSERT INTO `ClothType` VALUES(38, '手表', 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ClothType`
--
ALTER TABLE `ClothType`
  ADD CONSTRAINT `ClothType_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `ClothType` (`id`);

