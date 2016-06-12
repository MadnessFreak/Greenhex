/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : greenhex

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-06-13 00:08:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ghex_post`
-- ----------------------------
DROP TABLE IF EXISTS `ghex_post`;
CREATE TABLE `ghex_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `message` varchar(512) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ghex_post
-- ----------------------------
INSERT INTO `ghex_post` VALUES ('1', '1', 'Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', '2016-06-10 20:50:23', null);
INSERT INTO `ghex_post` VALUES ('2', '2', 'Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.', '2016-06-10 21:06:04', null);
INSERT INTO `ghex_post` VALUES ('3', '3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.', '2016-06-10 21:06:12', null);
INSERT INTO `ghex_post` VALUES ('4', '1', 'The #weather is really nice today! How about you, @marc?', '2016-06-10 21:46:08', '2016-06-10 21:49:06');

-- ----------------------------
-- Table structure for `ghex_tag`
-- ----------------------------
DROP TABLE IF EXISTS `ghex_tag`;
CREATE TABLE `ghex_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ghex_tag
-- ----------------------------

-- ----------------------------
-- Table structure for `ghex_user`
-- ----------------------------
DROP TABLE IF EXISTS `ghex_user`;
CREATE TABLE `ghex_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idname` varchar(64) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `tmp_key` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ghex_user
-- ----------------------------

-- ----------------------------
-- Table structure for `ghex_user_follower`
-- ----------------------------
DROP TABLE IF EXISTS `ghex_user_follower`;
CREATE TABLE `ghex_user_follower` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_a` int(10) unsigned NOT NULL,
  `user_id_b` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ghex_user_follower
-- ----------------------------
