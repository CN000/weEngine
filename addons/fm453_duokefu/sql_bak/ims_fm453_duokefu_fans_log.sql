# Host: 127.0.0.1  (Version: 5.6.24)
# Date: 2015-11-22 09:36:11
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "ims_fm453_duokefu_fans_log"
#

DROP TABLE IF EXISTS `ims_fm453_duokefu_fans_log`;
CREATE TABLE `ims_fm453_duokefu_fans_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `realname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '真实姓名',
  `kefu_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '编辑客服名称',
  `uniacid` int(11) DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `credit1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit6` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qq` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthyear` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthmonth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `constellation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zodiac` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idcard` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `studentid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resideprovince` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `residecity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `residedist` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduateschool` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `revenue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `affectivestatus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lookingfor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bloodtype` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `height` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alipay` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `taobao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `interest` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='多客服用户编辑记录表';

#
# Data for table "ims_fm453_duokefu_fans_log"
#

