<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 使用指南说明页
 */
defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '多客服插件使用指南';
global $_GPC,$_W;
load()->func('tpl');
include $this->template('web/manual');