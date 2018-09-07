<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 多客服插件页-获取当前访客信息
 */
global $_GPC,$_W;
	$root=$_W['siteroot'];
	$uniacid=$_W['uniacid'];
	$openid = $_GPC['openid'];
		$fanid = $_GPC['fanid'];
	if(!empty($_GPC['openid'])){
		$condition = 'WHERE';
		$condition	.= '`uniacid` =:uniacid';
		$condition .= " AND openid LIKE '%{$openid}%'";
		$sql = 'SELECT * FROM ' . tablename('mc_mapping_fans') . $condition;
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$faninfo = pdo_fetch($sql, $params);
		$return['faninfo'] = $faninfo;
		$sqlnum = 'SELECT COUNT(*) FROM ' . tablename('mc_mapping_fans') . $condition;
		$fansnum = pdo_fetchcolumn($sqlnum, $params);
		$faninfos = count($faninfo);
		$fanid = $faninfo['uid'];
		$fanrow=$faninfo;
		$sqlmc = 'SELECT * FROM ' . tablename('mc_members') ."WHERE `uniacid` =:uniacid AND `uid` LIKE  '%{$fanid}%' ";
		$memberinfo = pdo_fetch($sqlmc, $params);
		$gender = array (
			'0' => array('css' => 'default', 'name' => '未知'),
			'1' => array('css' => 'danger','name' => '男'),
			'2' => array('css' => 'info', 'name' => '女'),
		);
		$memberinfo['gender'] =$gender[$memberinfo['gender']]['name'];
		$memberinfo['createtime'] = date('Y-m-d H:i:s',$memberinfo['createtime']);
		$faninfo['followtime'] = date('Y-m-d H:i:s',$faninfo['followtime']);
		if(!empty($memberinfo['birthday'])) {
			$memberinfo['birthday'] = $memberinfo['birthyear']." 年 ".$memberinfo['birthmonth']." 月 ".$memberinfo['birthday']." 日";
		}else {
			$memberinfo['birthday'] ="未填写";
		}
		if(!empty($memberinfo['birthyear'])) {
			$memberinfo['birthyear'] = $memberinfo['birthyear']." 年";
		}else {
			$memberinfo['birthday'] ="未填写";
		}
		if(!empty($memberinfo['birthmonth'])) {
			$memberinfo['birthmonth'] = $memberinfo['birthmonth']." 月";
		}else {
			$memberinfo['birthmonth'] ="未填写";
		}
		//print_r($memberinfo);
		$isshow = array (
			'0' => 'hidden',
			'1' => 'show',
		);
		//读取用户信息字段表,按设置的排序数大小倒序，按ID，DESC倒序（从大到小），ASC正序（从小到大）。
		$sql = "select id,column_show_name from ".tablename('fm453_duokefu_fanslistkey')." where uniacid={$_W['uniacid']} order by show_order DESC , id ASC";
		if(pdo_fetchall($sql)){	//先判断执行上面这条查询是否有效返回结果再决定下一下使用哪个sql来执行查询
			$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid={$_W['uniacid']} and is_show=1  order by show_order DESC , id ASC";
		}else{
			$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid=0 and is_show=1  order by show_order DESC , id ASC";
		}
		$column = pdo_fetchall($sql);
		//print_r($column);

		$shows=array();
		foreach($column as $cvalue){
			$shows[$cvalue['column_name']]['showname']=$cvalue['column_show_name'];
			$shows[$cvalue['column_name']]['is_show']=$cvalue['is_show'];
			$shows[$cvalue['column_name']]['is_edit']=$cvalue['is_edit'];
			$shows[$cvalue['column_name']]['show_order']=$cvalue['show_order'];
			}
	//print_r($shows);
		foreach($memberinfo as $key => $value){
			$newvalue= array(
				'isshow' => $shows[$key]['is_show'],
				'isedit' => $shows[$key]['is_edit'],
				'showname' => $shows[$key]['showname'],
				'showorder' => $shows[$key]['show_order'],
				'value' => $value,
			);
			$memberinfo[$key]=$newvalue;
			if($newvalue['isshow'] !=1) {
				unset($memberinfo[$key]);
			}
		}
		foreach($shows as $key => $value){
			$shows[$key]['value'] = $memberinfo[$key]['value'];
		}
			//print_r($memberinfo);
		$return['getfaninfo']['memberinfo'] = $memberinfo;
		$return['getfaninfo']['column'] = $column;
		$return['getfaninfo']['isshow'] = $isshow;
		$return['getfaninfo']['shows'] = $shows;
		$mcrow= $memberinfo;
		}
		//echo json_encode($returns);
//include $this->template('plugin-faninfos');