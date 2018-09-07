<?php
/**
 * 客服助手模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 模块公用参数设置保存（更新方式，非清空后覆盖）
 */
 defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '客服助手模块设置';
global $_GPC,$_W;
load()->func('tpl');

$urlsafecode = $_GPC['urlsafecode'];
$kefucodes = $_GPC['kefucodes'];
$sumanopenids = $_GPC['sumanopenids'];
$mainuser = $_GPC['mainuser'];
$devopenids = $_GPC['devopenids'];

$this->module['config']['urlsafecode']=$urlsafecode;
$this->module['config']['kefucodes']=$kefucodes;
$this->module['config']['sumanopenids']=$sumanopenids;
$this->module['config']['mainuser']=$mainuser;
$this->module['config']['devopenids']=$devopenids;


if($this->saveSettings($this->module['config'])) {
	message('模块设置成功','referer','success');
}else{
	message('模块设置失败','','error');
}