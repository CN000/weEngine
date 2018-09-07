<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 *  根据OPENID获取客服工号
 */
	global $_GPC, $_W;
		$openid = $_GPC['openid'];
		$token = $_W['account']['access_token']['token'];
		$url = "http://api.weixin.qq.com/customservice/kfsession/getsession?access_token={$token}&openid={$openid}";
		$back = file_get_contents($url);
		$data = json_decode($back,true);
		$_SESSION['kefu'] = $data['kf_account'];
		//echo $data['kf_account'];