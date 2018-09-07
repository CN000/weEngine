<?php
/**
 * 客服助手插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 模块公用参数设置保存（更新方式，非清空后覆盖）
 */
 defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '客服助手模块设置';
global $_GPC,$_W;
load()->func('tpl');
$tasktplparamnum = $_GPC['tasktplparamnum'];
$tasktplid = $_GPC['tasktplid'];
$welink = $_GPC['welink'];
$navmenusnum = $_GPC['navmenusnum'];
$navsnum= $_GPC['navsnum'];
$kefuqq = $_GPC['kefuqq'];
$smsapi = $_GPC['smsapi'];
if(!empty($_GPC['tasktplparamnum'])) {
	if(is_numeric( $tasktplparamnum )) {
	$this->module['config']['tasktplparamnum']=$tasktplparamnum;
	}else{
		message('消息模板的参数个数应为数字，请检查是否输入正确','','error');
	}
}
if(!empty($_GPC['navsnum'])) {
    if(!empty($this->module['config']['shouquan']['sufm453code']) && $this->module['config']['onoffs']['isnavs']==1) {
	   if(is_numeric($navsnum)) {
	       $this->module['config']['navsnum']=$navsnum;
	   }else{
		  message('导航条的参数个数应为数字，请检查是否输入正确','','error');
	   }
	}else{
		  message('请确认您已经获得模块授权且开启了高级导航条功能','','error');
	   }
}
$this->module['config']['tasktplid']=$tasktplid;
$this->module['config']['welink']=$welink;
$this->module['config']['navmenusnum']=$navmenusnum;
$this->module['config']['kefuqq']=$kefuqq;
$this->module['config']['smsapi']=$smsapi;

if($this->saveSettings($this->module['config'])) {
	message('模块设置成功','referer','success');
}else{
	message('模块设置失败','','error');
}