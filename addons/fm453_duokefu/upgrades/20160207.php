<?php
/**
 * 多客服插件模块升级文件
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 说明：文件名根据被升级的版本命名；
 * 说明：最佳兼容服务器环境：php5.6.8 扩展mysqlli mysql5.6.24；
 */
$sql="
CREATE TABLE `ims_fm453_duokefu_qrandfan` ( `id` INT(10) UNSIGNED NOT NULL , `uniacid` INT(10) UNSIGNED NOT NULL , `qrcodeid` INT(10) UNSIGNED NOT NULL COMMENT '关联二维码ID' , `qrcodename` VARCHAR(255) NOT NULL , `openid` VARCHAR(255) NOT NULL COMMENT '关联粉丝openid' ) ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT = '将粉丝与指定二维码进行关联以统计其推广效果';
ALTER TABLE `ims_fm453_duokefu_qrandfan` ADD PRIMARY KEY(`id`);
";
$sql .="
ALTER TABLE `ims_fm453_duokefu_qrandfan` ADD `ischecked` INT(1) NOT NULL DEFAULT '1' COMMENT '是否审核通过(前台申请关联时)' AFTER `openid`, ADD `isavailable` INT(1) NOT NULL DEFAULT '1' COMMENT '是否有效' AFTER `ischecked`;
ALTER TABLE `ims_fm453_duokefu_qrandfan` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;
";

pdo_query($sql);
