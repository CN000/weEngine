<?php
/**
 * 客服助手模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 模板消息设置页;设置成追加调整数据的方式，不会对其他数据有影响
 */
defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '模板消息设置';
global $_GPC,$_W;
load()->func('tpl');

$tasktplparamnum = $this->module['config']['tasktplparamnum'];
$tasktplid = $this->module['config']['tasktplid'];
$sumanopenids = $this->module['config']['sumanopenids'];
$taskurl = $this->module['config']['taskurl'];
$saveItem = array();
for ($i=0; $i <$tasktplparamnum; $i++) {
    	$colorValue=$_GPC['color'.$i];
    	$dicValue=$_GPC['value'.$i];
    	$dicKye=$_GPC['name'.$i];
    //保存数据
		$saveItem['color'.$i]=$colorValue;
		$saveItem['value'.$i]=$dicValue;
		$saveItem['name'.$i]=$dicKye;
}
   $this->module['config']['tasktpl']=$saveItem;

	if(checksubmit()) {
	$this->saveSettings($this->module['config']);
		if($_GPC['submit']=='保存') {
       	message('消息模板'.$tasktplid.'设置保存成功','referer','success');
       	return ;
        }
   }