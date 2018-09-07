# Host: 127.0.0.1  (Version: 5.6.24)
# Date: 2015-11-22 09:35:05
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "ims_fm453_duokefu_fanslistkey"
#

DROP TABLE IF EXISTS `ims_fm453_duokefu_fanslistkey`;
CREATE TABLE `ims_fm453_duokefu_fanslistkey` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `show_order` int(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '显示排序',
  `column_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '字段名',
  `column_show_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '字段展示名称',
  `is_show` int(1) NOT NULL DEFAULT '0' COMMENT '是否显示0否1可以',
  `is_edit` int(1) NOT NULL DEFAULT '0' COMMENT '是否可修改0否1可以',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='多客服字段表';

#
# Data for table "ims_fm453_duokefu_fanslistkey"
#

INSERT INTO `ims_fm453_duokefu_fanslistkey` VALUES (1,0,0,'uid','用户ID',0,0),(2,0,0,'uniacid','所属公众号ID',0,0),(3,0,0,'mobile','电话',1,0),(4,0,0,'email','邮箱',0,0),(5,0,0,'password','密码',0,0),(6,0,0,'salt','系统生成后缀',0,0),(7,0,0,'groupid','微信粉丝分组ID',0,0),(8,0,0,'credit1','系统默认积分',0,0),(9,0,0,'credit2','系统默认余额',0,0),(10,0,0,'credit3','',0,0),(11,0,0,'credit4','',0,0),(12,0,0,'credit5','',0,0),(13,0,0,'createtime','关注时间',0,0),(14,0,0,'realname','姓名',1,0),(15,0,0,'nickname','昵称',1,0),(16,0,0,'avatar','头像',0,0),(17,0,0,'qq','QQ号',0,0),(18,0,0,'vip','VIP等级',0,0),(19,0,0,'gender','性别',0,0),(20,0,0,'birthyear','生日年份',0,0),(21,0,0,'birthmonth','生日月份',0,0),(22,0,0,'birthday','生日',0,0),(23,0,0,'constellation','星座',0,0),(24,0,0,'zodiac','生肖',0,0),(25,0,0,'telephone','手机号',0,0),(26,0,0,'idcard','身份证号',0,0),(27,0,0,'studentid','学校',0,0),(28,0,0,'grade','班级',0,0),(29,0,0,'address','地址',0,0),(30,0,0,'zipcode','邮编',0,0),(31,0,0,'nationality','国籍',0,0),(32,0,0,'resideprovince','居住省份',0,0),(33,0,0,'residecity','居住城市',0,0),(34,0,0,'residedist','居住区域',0,0),(35,0,0,'graduateschool','毕业学校',0,0),(36,0,0,'company','城市',0,0),(37,0,0,'education','学校',0,0),(38,0,0,'occupation','职业',0,0),(39,0,0,'position','职位',0,0),(40,0,0,'revenue','年收入',0,0),(41,0,0,'affectivestatus','情感状态',0,0),(42,0,0,'lookingfor','交友目的',0,0),(43,0,0,'bloodtype','血型',0,0),(44,0,0,'height','身高',0,0),(45,0,0,'weight','体重',0,0),(46,0,0,'alipay','支付宝帐号',0,0),(47,0,0,'msn','msn',0,0),(48,0,0,'taobao','淘宝帐号',0,0),(49,0,0,'site','主页',0,0),(50,0,0,'bio','自我介绍',0,0),(51,0,0,'interest','兴趣爱好',0,0),(52,0,0,'credit6','credit6',0,0);
