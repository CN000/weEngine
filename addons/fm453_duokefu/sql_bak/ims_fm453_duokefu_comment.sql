SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `ims_fm453_duokefu_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `adm_openid` text NOT NULL COMMENT '管理员的openid',
  `from_openid` varchar(50) NOT NULL COMMENT '粉丝openid',
  `from_uid` int(11) DEFAULT NULL COMMENT '会员id',
  `from_channel` VARCHAR(255) NOT NULL COMMENT '被点评对象的来源渠道，比如OTA',
  `username` varchar(100) NOT NULL COMMENT '姓名',
  `mobile` varchar(50) NOT NULL COMMENT '手机',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `rnumber` int(11) NOT NULL COMMENT '补充号码，如房号',
  `thumb` text NOT NULL COMMENT '单图片/首图链接',
  `images` text NOT NULL COMMENT '多图片链接',
  `remark` text NOT NULL COMMENT '备注',
  `ischecked` INT(11) NOT NULL DEFAULT '-1' COMMENT '是否通过审核,-1待0否1是',
  `why_failure` text NOT NULL COMMENT '点评审核失败原因',
  `ispayed` int(11) NOT NULL COMMENT '是否支付,0否1是',
  `reply` text NOT NULL COMMENT '商户回复',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `paytime` int(11) NOT NULL COMMENT '确认奖励发放时间',
  `pay_no` VARCHAR(255) NOT NULL COMMENT '奖励支付时的流水号',
  `pay_money` DECIMAL(10,2) NOT NULL COMMENT '已奖励支付金额',
  `displayorder` int(11) NOT NULL COMMENT '排序，数字大的靠前',
  `ispublic` int(11) NOT NULL COMMENT '是否公开',
  `up_count` int(11) NOT NULL COMMENT '支持数',
  `down_count` int(11) NOT NULL COMMENT '不支持数量',
  `view_count` int(11) NOT NULL COMMENT '浏览量',
  `isapi` int(11) NOT NULL DEFAULT '0' COMMENT '是否为其他模块调用，0否1是',
  `api_module` varchar(50) NOT NULL DEFAULT 'fm453_duokefu' COMMENT '调用该评论的模块',
  `api_id` int(11) NOT NULL COMMENT '被评论的模块传入的关联id值',
  `api_info` text NOT NULL COMMENT '被评论的模块传入更多信息',
  `deleted` int(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `log` TEXT NOT NULL COMMENT '操作记录',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论记录表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
