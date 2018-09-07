<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 前台模拟测试
 */
global $_GPC,$_W;
$_W['page']['title'] = '模拟测试';
load()->func('tpl');
	$siteroot=$_W['siteroot'];
	//$uniacid=$_W['uniacid'];
	$uniacid=$_GPC['i'];
	//print_r($uniacid);
	//if(checkauth()) {
//		$ishidden="hidden";//未登陆
	//}
$development = 1;
$account = pdo_fetch('SELECT acid,token,name FROM ' . tablename('account_wechats') . ' WHERE uniacid = :uniacid ORDER BY level DESC LIMIT 1', array(':uniacid' => $uniacid));
//print_r($account);
$timestamp = TIMESTAMP;
$nonce = random(5);
$token = $account['token'];
$signkey = array($token, TIMESTAMP, $nonce);
sort($signkey, SORT_STRING);
$signString = implode($signkey);
$signString = sha1($signString);
$apivalue= "../api.php?id=".$account['acid']."&timestamp=".$timestamp.'&nonce='.$nonce.'&signature='.$signString;//用于从系统获取查询返回的api接口
include $this->template('syskwdquery');
