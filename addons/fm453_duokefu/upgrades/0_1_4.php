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
CREATE TABLE `ims_fm453_duokefu_settingslog` (
	`id` INT(11) UNSIGNED NOT NULL COMMENT '记录序号', 
	`uniacid` INT(11) UNSIGNED NULL DEFAULT '0' COMMENT '关联主公号', 
	`operatorid` INT(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作人UID', 	
	`operatorname` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作人用户名', 
	`settings` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '设置内容', 
	`dotime` TIMESTAMP CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作时间', 
	PRIMARY KEY (`id`)
) ENGINE = MyISAM CHARACTER SET utf8 COMMENT = '多客服插件模块设置日志';

"

pdo_query($sql);
