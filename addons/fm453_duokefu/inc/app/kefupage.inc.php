<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 客服助手插件中心-手动获取用户信息
 */
global $_GPC,$_W;
load()->func('tpl');
	$root=$_W['siteroot'];
	$uniacid=$_W['uniacid'];
	$acid=$_W['acid'];
	$url="{$root}app/index.php?i={$uniacid}&c=entry&do=kefupage&m=fm453_duokefu";
	$qq=intval($this->module['config']['kefuqq']);
	$qq=!empty($qq)?$qq:'1280880631';
	$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
	$openid = $_GPC['openid'];//经测试，这里加不了$_GPC['openid']
	$fanid = $_GPC['fanid'];
$loadmod = 0; //加载信息的方式，0为网址(通过该模块网址入口进入)，1为引用（通过调用该文件方式进入）
if (checksubmit('reload')) {
	message('页面刷新成功!您下次也可以直接按下F5键进行刷新',$this->createMobileUrl('kefupage'),'success');
}

if (checksubmit('getfaninfo')){
	if(!empty($_GPC['openid'])){
		include_once  '../addons/fm453_duokefu/inc/app/getfansinfo.inc.php';
		$memberinfo=$return['getfaninfo']["memberinfo"];
		$column=$return['getfaninfo']["column"];
		$isshow=$return['getfaninfo']['isshow'];
		$shows=$return['getfaninfo']['shows'];
		//print_r($memberinfo);
	}
}

//插件钩子,程序文件在plugin文件夹下;为避免不必要的风险,需要事先加载用户信息,否则插件不生效.

if (checksubmit('fm453_shopping') && $this->module['config']['onoffs']['fm453_shopping'] ==1){
	if(!empty($_GPC['openid'])){
		include_once  '../addons/fm453_kfzs_hlxsc/inc/app/ordersactions.inc.php';
		$fm453_shopping=$return["fm453_shopping"];//对回调数据进行插件标识化，以便各插件独立显示；
//		include $this->template('plugin/fm453_shopping/display');
	}else{
		message('请先加载用户信息',$url,'error');
	}
}
if (checksubmit('ewei_shopping') && $this->module['config']['onoffs']['ewei_shopping'] ==1){
	if(!empty($_GPC['openid'])){
		include_once  '../addons/fm453_duokefu/plugin/ewei_shopping/453.php';
	}else{
		message('请先加载用户信息',$url,'error');
	}
}
if (checksubmit('ewei_shop') && $this->module['config']['onoffs']['ewei_shop'] ==1){
	if(!empty($_GPC['openid'])){
		include_once  '../addons/fm453_duokefu/plugin/ewei_shop/ewei_shop.php';
	}else{
		message('请先加载用户信息',$url,'error');
	}
}
if (checksubmit('fengyixin_pintuan') && $this->module['config']['onoffs']['fengyixin_pintuan'] ==1){
	if(!empty($_GPC['openid'])){
	include_once  '../addons/fm453_kfzs_fyxpt/inc/app/ordersactions.inc.php';
	$fengyixin_pintuan=$return["fengyixin_pintuan"];//对回调数据进行插件标识化，以便各插件独立显示；
	}else{
		message('请先加载用户信息',$url,'error');
	}
}
if (checksubmit('quick_shop') && $this->module['config']['onoffs']['quick_shop'] ==1){
	if(!empty($_GPC['openid'])){
		include_once  '../addons/fm453_duokefu/plugin/quick_shop/453.php';
	}else{
		message('请先加载用户信息','','error');
	}
}
if (checksubmit('yunmall') && $this->module['config']['onoffs']['yunmall'] ==1){
	if(!empty($_GPC['openid'])){
		include_once  '../addons/fm453_duokefu/plugin/yunmall/453.php';
	}else{
		message('请先加载用户信息',$url,'error');
	}
}
if (checksubmit('ewei_hotels') && $this->module['config']['onoffs']['ewei_hotels'] ==1){
	if(!empty($_GPC['openid'])){
		include_once  '../addons/fm453_duokefu/plugin/ewei_hotels/453.php';
	}else{
		message('请先加载用户信息',$url,'error');
	}
}
include $this->template('kefupage');