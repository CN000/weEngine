<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 多客服插件页-查询微酒店订单功能
 */
global $_GPC,$_W;
$openid = $_GPC['openid']; //OPENID由客服助手模块主程序处理，此页自动继承
$fanid = $_GPC['fanid'];
	//API接口文件，置入从客服助手的第三方插件中获取的返回数据。// 本接口需开启allow_url_fopen支持
	$filename = $_W['siteroot']."app/".str_replace('./','',url('entry//ordersactions',array('op'=>'orderlist','m'=>'fm453_kfzs_eweihotels','openid'=>$openid,'fanid'=>$fanid,'page'=>$_GPC['page'])));
	load()->func('communication');
	$returns = ihttp_get($filename);//将数据存入数组
	//print_r($returns['content']);
	$return['ewei_hotels'] = $returns['content'];