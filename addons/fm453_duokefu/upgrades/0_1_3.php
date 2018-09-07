<?php
/**
 * 客服助手插件模块升级文件
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 说明：文件名根据被升级的版本命名；
 * 说明：最佳兼容服务器环境：php5.6.8 扩展mysqlli mysql5.6.24；
 */
$sql="
CREATE TABLE `ims_fm453_duokefu_menu` (
	`id` INT(11) UNSIGNED NOT NULL COMMENT '记录序号', 
	`uniacid` INT(11) UNSIGNED NULL DEFAULT '0' COMMENT '关联主公号', 
	`mname` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '导航名称', 
	`mlink` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '导航链接', 
	`micon` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '导航图标', 
	`enabled` INT(11) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否启用，1为启用，0为停用；默认启用', 
	`parentid` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '父ID', 
	`displayorder` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '排序', 
	FULLTEXT `按名称索引` (
		`mname`(10)
	)
) ENGINE = MyISAM CHARACTER SET utf8 COMMENT = '多客服插件模块模板页的菜单导航设置';

";

pdo_query($sql);
