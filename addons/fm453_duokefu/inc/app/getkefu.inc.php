<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 通过客服会话接口获取客户的会话状态
 */
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
		$openid = $_GPC['openid'];
	$fanid = $_GPC['fanid'];
	$tokenarray=iunserializer($_W['account']['access_token']);
	//print_r($tokenarray);
	$access_token=$tokenarray['token'];		//获取access_token
		$token = $access_token;
		$url = "http://api.weixin.qq.com/customservice/kfsession/getsession?access_token={$token}&openid={$openid}";
		load()->func('communication');
		$back = ihttp_get($url);	
		$data = json_decode($back,true);
		$_SESSION['kefu'] = $data['kf_account'];	
		$return['kefu']='fm453';
		echo  $return;