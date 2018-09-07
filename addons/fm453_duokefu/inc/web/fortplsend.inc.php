<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 模板消息发送页
 */
defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '发送模板消息';
global $_GPC,$_W;
load()->func('tpl');
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'single';
$postdata = array();	
    for ($i=0; $i <$this->module['config']['tasktplparamnum']; $i++) { 
    	$colorValue = $this->module['config']['tasktpl']['color'.$i];
    	$dicValue = $this->module['config']['tasktpl']['value'.$i];
    	$dicKye = $this->module['config']['tasktpl']['name'.$i];
    	$item = array('value'=>$dicValue,'color'=>$colorValue);
		$postdata[$dicKye]=$item;
		}

if ($operation == 'single') {
	$touser = $_GPC['touser'];
    load()->classs('weixin.account');
    $access_token = WeAccount::token();
    if(empty($access_token)) {
        message('获取access_token失败','','error');
    }
	$postUrl='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;    
	$post_data = array(
		'touser' => $touser,  
		'template_id' => $this->module['config']['tasktplid'],
		'url'=>$this->module['config']['taskurl'],
		'topcolor'=>'#0095F6',
		'data'=>$postdata
		);	
	$json_data = json_encode($post_data);
	if(checksubmit()) {
	load()->func('communication');
	$result = ihttp_post($postUrl ,urldecode($json_data) );
//	print_r( $result); //调试时打开此功能，打印返回信息
	if(empty($result)){
	message('发送失败，数据没有成功发送','','error');
	}
	if($result[1] == 0) {
		message('发送成功！公众平台返回码：'.$result[2],'','success');
	}else{
		message('发送失败'.$result[1],'','error');
		message('发送失败<br /> 发送失败\n','','success');
	}
	}
} 

if ($operation == 'mass') {
   	$groupid = $_GPC['groupid'];	
    //从数据库中获得openid
    $sql = 'SELECT openid FROM '.tablename('mc_mapping_fans').' WHERE `uniacid` = :acid and `groupid` = :groupid ';
    $params = array(':acid' => $_W['uniacid'],':groupid'=>$groupid);
    $result=pdo_fetchall($sql, $params);
    $openidNum=count($result);    
    load()->classs('weixin.account');
    //发送数据
    $access_token = WeAccount::token();
    if(empty($access_token)) {
		message('获取access_token失败','','error');
    }
    $postUrl='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
    $feedBack = array();
    $flag=0;
	if(checksubmit()) {
		if($openidNum==0) {
			message('该分组人数为0','','error');
        }
		for ($k=0; $k <$openidNum; $k++) {
			$touser=$result[$k]['openid'];
			$post_data = array(  
				'touser' => $touser,  
				'template_id' => $this->module['config']['tasktplid'],
				'url'=>$this->module['config']['taskurl'],
				'topcolor'=>'#0095F6',
				'data'=>$postdata
  		 	); 
			$json_data = json_encode($post_data); 		
			load()->func('communication');
			$result2=  ihttp_post($postUrl ,urldecode($json_data));    			 
			if($result2[1]!= 0 ) {
				$arr = array();
				$arr['user'] =  $touser;
				$arr['error'] = $result2[1];
				array_push($feedBack,$arr);
				$flag = 1;
				// message('发送失败,微信平台返回码：'.$result2[1],'','error');
			}	
		}
		if($flag==0) {
			message('群发成功！','','success');
		}else{
			$finalError= '';
			for($i =0 ; $i<count($feedBack) ; $i++)	{
				$finalError = $finalError.'发送失败用户:'.$feedBack[$i]['user'].'  错误类型:'.$feedBack[$i]['error'].'<br/>';
			}
			$finalError = $finalError.'以上用户未发送成功，其他用户已经发送成功。请检查同步粉丝数据';
			message($finalError,'','error');
		}
		}
}
include $this->template('web/fortplsend');		