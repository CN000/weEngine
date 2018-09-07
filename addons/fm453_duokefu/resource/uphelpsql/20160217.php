<?php
$sql =" CREATE TABLE `ims_fm453_duokefu_qrandfan` (
 `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `uniacid` INT(10) UNSIGNED NOT NULL ,
  `qrcodeid` INT(10) UNSIGNED NOT NULL COMMENT '关联二维码ID' ,
  `qrcodename` VARCHAR(255) NOT NULL ,
  `openid` VARCHAR(255) NOT NULL COMMENT '关联粉丝openid',
  PRIMARY KEY(`id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT= '将粉丝与指定二维码进行关联以统计其推广效果';

ALTER TABLE `ims_fm453_duokefu_qrandfan` ADD `ischecked` INT(1) NOT NULL DEFAULT '1' COMMENT '是否审核通过(前台申请关联时)' AFTER `openid`;
ALTER TABLE `ims_fm453_duokefu_qrandfan` ADD `isavailable` INT(1) NOT NULL DEFAULT '1' COMMENT '是否有效' AFTER `ischecked`;
";