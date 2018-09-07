<?php
/**
 * 客服助手模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 模块开关设置保存（更新方式，非清空后覆盖）
 */
 defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '客服助手模块功能开关设置';
global $_GPC,$_W;
$onoffs=array();
$issafe = $_GPC['issafe'];
$isnavmenu = $_GPC['isnavmenu'];
$isnavs = $_GPC['isnavs'];
$fm453_shopping = $_GPC['fm453_shopping'];//嗨旅行微商城
	$onoffs['fm453_shopping']=$fm453_shopping;
$ewei_shopping = $_GPC['ewei_shopping'];//人人商城
	$onoffs['ewei_shopping']=$ewei_shopping;
$ewei_shop = $_GPC['ewei_shop'];//微擎微商城
	$onoffs['ewei_shop']=$ewei_shop;
$ewei_hotels = $_GPC['ewei_hotels'];//微擎微酒店
	$onoffs['ewei_hotels']=$ewei_hotels;
$quick_shop = $_GPC['quick_shop'];//人人赚商城
	$onoffs['quick_shop']=$quick_shop;
$fengyixin_pintuan = $_GPC['fengyixin_pintuan'];//拼团[封遗鑫版]
	$onoffs['fengyixin_pintuan']=$fengyixin_pintuan;
	$yunmall = $_GPC['yunmall'];//水池分销商城（由开发群友19.3cm提供）
	$onoffs['yunmall']=$yunmall;
if(!empty($_GPC['issafe'])) {
	if(is_numeric( $issafe) && ($issafe ==0 || $issafe ==1)) {
	$onoffs['issafe']=$issafe;
	}else{
		message('安全设置参数应为数字1或0，请检查是否输入正确','','error');
	}
}
if(!empty($_GPC['isnavmenu'])) {
	if($isnavmenu ==0 or $isnavmenu ==1) {
	$onoffs['isnavmenu']=$isnavmenu;
	}else{
		message('导航条自定义设置参数应为数字1或0，请检查是否输入正确','','error');
	}
}
if(!empty($this->module['config']['shouquan']['sufm453code'])) {
	if(is_numeric( $isnavs) && ($isnavs ==0 || $isnavs ==1)) {
	$onoffs['isnavs']=$isnavs;
	}else{
		message('高级导航条参数应为数字1或0，请检查是否输入正确','','error');
	}
}else{
		message('您还没有获取授权，请先联系我们进行授权操作','','error');
}
$this->module['config']['onoffs']=$onoffs;
if($this->saveSettings($this->module['config'])) {
	message('模块开关设置成功','referer','success');
}else{
	message('模块开关设置失败','','error');
}