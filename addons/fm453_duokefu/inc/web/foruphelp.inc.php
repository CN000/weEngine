<?php
/**
 * 客服助手模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 自助升级帮助说明
 */
defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '自助升级帮助文档';
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if (checksubmit('addentry_code_1')) {
$sql="
INSERT INTO `ims_modules_bindings` (`module`, `entry`, `call`, `title`, `do`, `state`, `direct`, `url`, `icon`, `displayorder`) VALUES
('fm453_duokefu', 'cover', '', '扫码管理入口', 'qrcode', '', 1, '', '', 0);
";
	pdo_query($sql);
	message('添加扫码管理入口成功！', url('home/welcome/ext',array('m'=>'fm453_duokefu')), 'success');
}
if (checksubmit('addentry_code_2')) {
$sql="
INSERT INTO `ims_modules_bindings` (`module`, `entry`, `call`, `title`, `do`, `state`, `direct`, `url`, `icon`, `displayorder`) VALUES
('fm453_duokefu', 'cover', '', '评论有礼活动入口', 'comment', '', 1, '', '', 0);
";
	pdo_query($sql);
	message('添加评论有礼活动入口成功！', url('home/welcome/ext',array('m'=>'fm453_duokefu')), 'success');
}
if (checksubmit('emptyentry_code')) {
$sql="
DELETE FROM `ims_modules_bindings` WHERE `module` LIKE '%fm453_duokefu%' AND `entry` LIKE '%cover%'  ;
";
	pdo_query($sql);
	message('清空入口成功！', url('home/welcome/ext',array('m'=>'fm453_duokefu')), 'success');
}
if (checksubmit('addentry_code_last')) {
 $sql ="
 	DELETE FROM `ims_modules_bindings` WHERE `module` LIKE '%fm453_duokefu%' AND `entry` LIKE '%menu%'  ;
INSERT INTO `ims_modules_bindings` (`module`, `entry`, `call`, `title`, `do`, `state`, `direct`, `url`, `icon`, `displayorder`) VALUES
('fm453_duokefu', 'menu', '', '使用指南', 'manual', '', 0, '', 'fa fa-question-circle', 0),
('fm453_duokefu', 'menu', '', '扩展配置', 'extset', '', 0, '', 'fa fa-cubes', 0),
('fm453_duokefu', 'menu', '', '关联二维码', 'qrcode', '', 0, '', 'fa fa-database', 0),
('fm453_duokefu', 'menu', '', '评论管理', 'comment', '', 0, '', 'fa fa-edit', 0);
 ";
	pdo_query($sql);
	message('修复业务功能菜单成功！', url('home/welcome/ext',array('m'=>'fm453_duokefu')), 'success');
}

if (checksubmit('20160217')) {
include_once MODULE_ROOT.'/resource/uphelpsql/20160217.php';

	message('升级成功！', url('home/welcome/ext',array('m'=>'fm453_duokefu')), 'success');
}
	include $this->template('web/foruphelp');