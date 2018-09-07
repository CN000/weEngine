<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 多客服插件页-获取客服信息
 */
global $_GPC,$_W;
		global $_GPC;
		$_SESSION['kefu'] = $_GPC['workeraccount'];
		$return['workeraccount'] = $_SESSION['kefu'];
		echo json_encode($return);