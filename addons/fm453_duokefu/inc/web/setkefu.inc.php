<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 配置客服变量缓存页
 */
	global $_GPC,$_W;
	$_SESSION['kefu'] = $_GPC['workeraccount'];
	$return['workeraccount'] = $_SESSION['kefu'];
	//echo json_encode($return);