<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 多客服插件页-自动加载用户用户信息
 */
global $_GPC,$_W;
load()->func('tpl');
	$root=$_W['siteroot'];
	$uniacid=$_W['uniacid'];
	$acid=$_W['acid'];
	$url="{$root}app/index.php?i={$uniacid}&c=entry&do=plugin&m=fm453_duokefu";
	$qq=intval($this->module['config']['kefuqq']);
	$qq=!empty($qq)?$qq:'1280880631';
	$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
	$openid = $_GPC['openid'];//必须由页面发起提交后才能获取得到 $_GPC['openid']
	$fanid = $_GPC['fanid'];
	//读取用户信息字段表,按设置的排序数大小倒序，按ID，DESC倒序（从大到小），ASC正序（从小到大）。
		$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid={$_W['uniacid']} order by show_order DESC , id ASC";
		if(pdo_fetchall($sql)){
			$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid={$_W['uniacid']} and is_show=1  order by show_order DESC , id ASC";
		}else{
			$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid=0 and is_show=1  order by show_order DESC , id ASC";
		}
		$column = pdo_fetchall($sql);

if (checksubmit('reload')) {
	message('您可以直接按下F5键进行刷新','','success');
}

if (checksubmit('getfaninfo')){
	if(!empty($_GPC['openid'])){
		$condition = 'WHERE';
		$condition	.= '`uniacid` =:uniacid';
		$condition .= " AND openid LIKE '%$openid%'";
		$sql = 'SELECT * FROM ' . tablename('mc_mapping_fans') . $condition;
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$faninfo = pdo_fetchall($sql, $params);
		$sqlnum = 'SELECT COUNT(*) FROM ' . tablename('mc_mapping_fans') . $condition;
		$fansnum = pdo_fetchcolumn($sqlnum, $params);
		$faninfos = count($faninfo);
		$fanid = $faninfo[0]['uid'];
		foreach($faninfo as $key => $fanrow){

		}
		$sqlmc = 'SELECT * FROM ' . tablename('mc_members') ."WHERE `uniacid` =:uniacid AND `uid` LIKE  '%$fanid%' ";
		$memberinfo = pdo_fetchall($sqlmc, $params);
		foreach($memberinfo as $kye => $mcrow){
		//echo "这是".$key."的值".$mcrow[uid].",".$mcrow[uniacid].",".$mcrow['mobile'].",".$mcrow['tag']; //打印测试结果
		}
	}

}

if (checksubmit('smssend')) {
    load()->model('cloud');
	cloud_prepare();
	$body = $_GPC['smstext'] . random(3) .	'【Hiluker技术支持】' .
							'【微擎】';
	cloud_sms_send(intval($_GPC['toPhonenum']), $body);
}
include $this->template('plugin');