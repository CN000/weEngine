<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 点评有礼活动手机端入口
 */
 global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$root=$_W['siteroot'];
$acid=$_W['acid'];
load()->func('tpl');
load()->model('mc');
$returnurl=!empty($_GPC['returnurl']) ? $_GPC['returnurl'] : $this->createMobileUrl('comment');
//checkauth();//强制登陆，以便获取用户信息
$openid=$_W['openid'];
//print_r($_W['uniaccount']);
if($openid){
	$fanid=mc_openid2uid($openid);
	$member = mc_fetch($fanid);
	$faninfo=mc_fansinfo($openid);
}
$useravatar=$this->getFanAvatar();
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';//display,提交页面；mine,会员全部评论汇总页；detail，评论的详情页；wall，评论墙
$isneedaddress=0;//1,必须填写地址；0,非必须
$isneedstatrtime=0;//1,必须填写地址；0,非必须
$isneedendtime=0;//1,必须填写地址；0,非必须
$isneedchannel=0;//1,必须填写地址；0,非必须
$uploadurl=$this->createMobileUrl('comment',array('op'=>'upload'));//文件上传
if($operation=="display"){
	$defaultaddress = pdo_fetch("SELECT * FROM " . tablename('mc_member_address') . " WHERE isdefault = 1 and uid = :uid limit 1", array(':uid' => $fanid));//从会员地址表中获取收货地址
if (checksubmit('add_comment')) {
	$data=array();
	$data['uniacid']=$uniacid;
	$data['from_openid']=$_GPC['from_openid'];
	$data['from_uid']=$_GPC['from_uid'];
	$data['createtime']=TIMESTAMP;
	//防止非法提交数据
	if($_GPC['from_openid']!=$openid ||$_GPC['from_uid']!=$fanid) {
	message("您提交的资料异常！请登陆后重新进入页面按要求提交！",$this->createMobileUrl('comment'),"alse");
	exit();
	}
	if(empty($_GPC['username'])) {
	message("请填写您的姓名","","false");
	exit();
	}else{
	$data['username']=$_GPC['username'];
	}
	if(empty($_GPC['mobile'])) {
	message("请填写您的手机号","","false");
	exit();
	}else{
	$data['mobile']=$_GPC['mobile'];
	}
	if(empty($_GPC['address']) & $isneedaddress==1) {
	message("请填写您的联系地址","","false");
	exit();
	}else{
	$data['address']=$_GPC['address'];
	}
	if(empty($_GPC['starttime'])  & $isneedstarttime==1) {
	message("请填写您的入住日期","","info");
	exit();
	}else{
	$data['starttime']=strtotime($_GPC['starttime']);
	}
	if(empty($_GPC['endtime']) & $isneedendtime==1) {
	message("请填写您的离店日期","","info");
	exit();
	}else{
	$data['endtime']=strtotime($_GPC['endtime']);
	}
	if($data['endtime']<=$data['starttime'] & $isneedendtime==1) {
	message("离店日期必须晚于入住日期","","info");
	exit();
	}
	if(empty($_GPC['rnumber'])) {
	message("请填写您的房号","","false");
	exit();
	}else{
	$data['rnumber']=$_GPC['rnumber'];
	}
	if(empty($_GPC['thumburl'])) {
	message("请上传点评的截图图片(选择后须点击上传按钮)","","info");
	exit();
	}else{
	$data['thumb']=$_GPC['thumburl'];
	}
	if($isneedchannel==1) {
	$data['from_channel']=$_GPC['channel'];
	}
	$data['remark']=$_GPC['remark'];
	pdo_insert('fm453_duokefu_comment',$data);
	message('您的评论信息已经提交，我们将尽快审核',$this->createMobileUrl('comment',array('op'=>'mine')), 'success');
}
	//自定义分享信息（未审核通过的点评，不开启微信分享）
	$_share = array(
    'title'   => $_W['uniaccount']['name']."好评征集活动",
    'link'    => $_W['siteroot']."app".str_replace('./','',$this->createMobileUrl('comment')),
    'imgUrl'  => $_W['attachurl']."headimg_".$acid.".jpg",
    'content' => "即日起，参与对".$_W['uniaccount']['name']."的好评活动，官方将会根据您的点评内容与人气，发放相应的奖励哦！",
	);
	include $this->template('comment');
}elseif($operation=="mine") {
	$pindex = max(1, intval($_GPC['page']));
	$psize = 3;
	$limit = ' LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
	$deleted = $_GPC['deleted'];
	$condition="";
	if ($deleted == 1) {
		$condition .= " AND `deleted` = ". intval($deleted)."";
	}else{
		$deleted = 0;
		$condition .= " AND `deleted` = ". intval($deleted)."";
	}
$displayorder=" ORDER BY displayorder DESC ";
$displayorder.=", createtime DESC";
// 使用uid而非openid进行关联查询？
$sql ="SELECT COUNT(*) FROM " . tablename('fm453_duokefu_comment') . " WHERE `uniacid`='{$uniacid}' AND `from_uid`='{$fanid}' ".$condition;
$total=pdo_fetchcolumn($sql);
$pager = pagination($total, $pindex, $psize);
	$sql ="SELECT * FROM " . tablename('fm453_duokefu_comment') . " WHERE  `uniacid`='{$uniacid}' AND `from_uid`='{$fanid}' ".$condition.$displayorder.$limit;
	$comments=pdo_fetchall($sql);
	foreach($comments as $key=>$comment){

	}
	//自定义分享信息（未审核通过的点评，不开启微信分享）
	$_share = array(
    'title'   => $_W['uniaccount']['name']."好评征集活动",
    'link'    => $_W['siteroot']."app".str_replace('./','',$this->createMobileUrl('comment')),
    'imgUrl'  => $_W['attachurl']."headimg_".$acid.".jpg",
    'content' => "即日起，参与对".$_W['uniaccount']['name']."的好评活动，官方将会根据您的点评内容与人气，发放相应的奖励哦！",
	);
	include $this->template('inner/comment/mine');
}elseif($operation=="detail") {
	$id=$_GPC['id'];
	$sql ="SELECT * FROM " . tablename('fm453_duokefu_comment') . " WHERE `id`='{$id}'";
	$comment=pdo_fetch($sql);
	//增加浏览量(本人阅读的不计算；未授权状态下浏览不计算)
	$view_count=$comment['view_count'];//当前浏览量
    $cfaninfo=mc_fansinfo($comment['from_openid']);
    $cmember = mc_fetch($comment['from_openid']);
	$cavatar=$cmember['avatar'];
	//$avatar=$cfaninfo['tag']['avatar'];
	//print_r($avatar);
	if($openid!=$comment['from_openid'] & !empty($openid)) {
		pdo_query("update " . tablename('fm453_duokefu_comment') . " set view_count=view_count+1 where id=:id and uniacid='{$_W['uniacid']}' ", array(":id" => $id));
//写入浏览记录
    $avatar=$useravatar;
	$data=array();
	$data['cid']=$id;
	$data['from_openid']=$openid;
	$data['from_uid']=$fanid;
	$data['do']="view";
	$data['avatar']=$avatar;
	$data['createtime']=TIMESTAMP;
	pdo_insert('fm453_duokefu_comment_viewlog',$data);
	}
	//列出浏览者的一些信息
	$sql ="SELECT * FROM " . tablename('fm453_duokefu_comment_viewlog') . " WHERE `cid`='{$id}' AND `do`='view'";
	$viewlogs=pdo_fetchall($sql);
	//列出点赞人清单
		//列出浏览者的一些信息
	$sql ="SELECT * FROM " . tablename('fm453_duokefu_comment_viewlog') . " WHERE `cid`='{$id}' AND `do`='up'";
	$uplogs=pdo_fetchall($sql);
	//统计数值
	$sql ="SELECT COUNT(*) FROM " . tablename('fm453_duokefu_comment_viewlog') . " WHERE `cid`='{$id}'";
	$logcount=pdo_fetchcolumn($sql);//关联日志记录数
	$rp_power=$comment['up_count']*15-$comment['down_count']*20+$comment['view_count']*10+$comment['rnumber']*rand(0.1,1); //影响力计算公式： (赞数×15-踩数×20)+浏览量×10+房号×随机乘量
	//自定义分享信息（未审核通过的点评，不开启微信分享）
	$_share = array(
    'title'   => $_W['uniaccount']['name']."好评征集活动",
    'link'    => $_W['siteurl'],
    'imgUrl'  => $member['avatar'],
    'content' => $comment['username']."是第".$comment['id']."位点评客，希望能得到亲们的支持啦！",
	);
	//print_r($faninfo['tag']['avatar']);
	include $this->template('inner/comment/detail');
}elseif($operation=="up") {
	$id=$_GPC['id'];
	$sql ="SELECT * FROM " . tablename('fm453_duokefu_comment') . " WHERE `id`='{$id}'";
	$comment=pdo_fetch($sql);
	if($openid!=$comment['from_openid'] & !empty($openid)) {
	pdo_query("update " . tablename('fm453_duokefu_comment') . " set up_count=up_count+1 where id=:id and uniacid='{$_W['uniacid']}' ", array(":id" => $id));
			$logs="";
			$logs .="顶";
			$logs .="（执行方式：粉丝自行操作）";
			$logs .='---by  ' . $_W['openid'];
			$logs .='操作时间:' . date('y年m月d日 h:i:s', $timestamp =  TIMESTAMP);
			$logs .="\r\n";
			$logs .="<br>";
			$logs .=$comment['log'];
			pdo_update('fm453_duokefu_comment', array('log' => $logs), array('id' => $id));
//写入单独的记录表中
	$avatar=$faninfo['tag']['avatar'];
	$data=array();
	$data['cid']=$id;
	$data['from_openid']=$openid;
	$data['from_uid']=$fanid;
	$data['do']="up";
	$data['avatar']=$avatar;
	$data['createtime']=TIMESTAMP;
	pdo_insert('fm453_duokefu_comment_viewlog',$data);
	message('感谢亲的支持，我已经收到你的好评啦！',$this->createMobileUrl('comment', array('op' => 'detail','id'=>$id)),"success");
	}elseif(empty($openid)) {
		message('亲,请登陆后再操作！',"","false");
	}elseif($openid==$comment['from_openid']) {
		message('亲,不可以给自己加评哦！',"","false");
	}
}elseif($operation=="down") {
	$id=$_GPC['id'];
	$sql ="SELECT * FROM " . tablename('fm453_duokefu_comment') . " WHERE `id`='{$id}'";
	$comment=pdo_fetch($sql);
	if($openid!=$comment['from_openid'] & !empty($openid)) {
	pdo_query("update " . tablename('fm453_duokefu_comment') . " set down_count=down_count+1 where id=:id and uniacid='{$_W['uniacid']}' ", array(":id" => $id));
			$logs="";
			$logs .="踩";
			$logs .="（执行方式：粉丝自行操作）";
			$logs .='---by  ' . $_W['openid'];
			$logs .='操作时间:' . date('y年m月d日 h:i:s', $timestamp =  TIMESTAMP);
			$logs .="\r\n";
			$logs .="<br>";
			$logs .=$comment['log'];
			pdo_update('fm453_duokefu_comment', array('log' => $logs), array('id' => $id));
//写入单独的记录表中
	$avatar=$faninfo['tag']['avatar'];
	$data=array();
	$data['cid']=$id;
	$data['from_openid']=$_GPC['from_openid'];
	$data['from_uid']=$_GPC['from_uid'];
	$data['do']="down";
	$data['avatar']=$avatar;
	$data['createtime']=TIMESTAMP;
	pdo_insert('fm453_duokefu_comment_viewlog',$data);
	message('感谢亲的关注！',$this->createMobileUrl('comment', array('op' => 'detail','id'=>$id)),"success");
	}elseif(empty($openid)) {
		message('亲,请登陆后再操作！',"","false");
	}elseif($openid==$comment['from_openid']) {
		message('亲,不可以给自己加评哦！',"","false");
	}

}elseif($operation=="edit"){
	$id=$_GPC['id'];
	$sql ="SELECT * FROM " . tablename('fm453_duokefu_comment') . " WHERE `id`='{$id}'";
	$comment=pdo_fetch($sql);
	$isneedaddress=1;
if (checksubmit('edit_comment')) {
	$data=array();
	//防止非法提交数据
	if($_GPC['from_openid']!=$openid ||$_GPC['from_uid']!=$fanid) {
	message("您提交的资料异常！请登陆后重新进入页面按要求提交！",$this->createMobileUrl('comment'),"alse");
	exit();
	}elseif($_GPC['username']==$comment['username'] && $_GPC['mobile']==$comment['mobile'] && $_GPC['address']==$comment['address'] && $_GPC['starttime']==$comment['starttime'] && $_GPC['endtime']==$comment['endtime'] && $_GPC['rnumber']==$comment['rnumber'] && $_GPC['thumb']==$comment['thumb'] && $_GPC['channel']==$comment['from_channel'] && $_GPC['remark']==$comment['remark']) {
//无修改数据时，不对提交进行任何响应
		break;
	}else{
	if(empty($_GPC['username'])) {
	message("请填写您的姓名","","false");
	exit();
	}else{
	$data['username']=$_GPC['username'];
	}
	if(empty($_GPC['mobile'])) {
	message("请填写您的手机号","","false");
	exit();
	}else{
	$data['mobile']=$_GPC['mobile'];
	}
	if(empty($_GPC['address']) & $isneedaddress==1) {
	message("请填写您的联系地址","","false");
	exit();
	}else{
	$data['address']=$_GPC['address'];
	}
	if(empty($_GPC['starttime'])  & $isneedstarttime==1) {
	message("请填写您的入住日期","","info");
	exit();
	}else{
	$data['starttime']=strtotime($_GPC['starttime']);
	}
	if(empty($_GPC['endtime']) & $isneedendtime==1) {
	message("请填写您的离店日期","","info");
	exit();
	}else{
	$data['endtime']=strtotime($_GPC['endtime']);
	}
	if($data['endtime']<=$data['starttime'] & $isneedendtime==1) {
	message("离店日期必须晚于入住日期","","info");
	exit();
	}
	if(empty($_GPC['rnumber'])) {
	message("请填写您的房号","","false");
	exit();
	}else{
	$data['rnumber']=$_GPC['rnumber'];
	}
	if(!empty($_GPC['thumburl'])) {
	$data['thumb']=$_GPC['thumburl'];
	}
	if($isneedchannel==1) {
	$data['from_channel']=$_GPC['channel'];
	}
		$data['remark']=$_GPC['remark'];
		$date['ischecked']=-1;//重新提交后该评论改变为待审核状态
		pdo_update('fm453_duokefu_comment',$data,array("id" => $id));
			$logs="";
			$logs .="编辑评论";
			$logs .="（执行方式：粉丝自行操作）";
			$logs .='---by  ' . $_W['fans']['nickname']."(".$_W['openid'].")";
			$logs .='操作时间:' . date('y年m月d日 h:i:s', $timestamp =  TIMESTAMP);
			$logs .="\r\n";
			$logs .="<br>";
			$logs .=$comment['log'];
			pdo_update('fm453_duokefu_comment', array('log' => $logs), array('id' => $id));
			message('您的评论信息已经提交，我们将尽快审核',$this->createMobileUrl('comment',array('op'=>'mine')), 'success');
	}
}
	//自定义分享信息（未审核通过的点评，不开启微信分享）
	$_share = array(
    'title'   => $_W['uniaccount']['name']."好评征集活动",
    'link'    => $_W['siteroot']."app".str_replace('./','',$this->createMobileUrl('comment')),
    'imgUrl'  => $_W['attachurl']."headimg_".$acid.".jpg",
    'content' => $comment['username']."是第".$comment['id']."位点评客，亲们，也一起来参加吧！",
	);
include $this->template('inner/comment/edit');

}elseif($operation=="delete") {
	$id=$_GPC['id'];
	$sql ="SELECT * FROM " . tablename('fm453_duokefu_comment') . " WHERE `id`='{$id}'";
	$comment=pdo_fetch($sql);
	pdo_query("update " . tablename('fm453_duokefu_comment') . " set deleted=1 where id=:id and uniacid='{$_W['uniacid']}' ", array(":id" => $id));
			$logs="";
			$logs .="删除评论";
			$logs .="（执行方式：粉丝自行操作）";
			$logs .='---by  ' . $_W['openid'];
			$logs .='操作时间:' . date('y年m月d日 h:i:s', $timestamp =  TIMESTAMP);
			$logs .="\r\n";
			$logs .="<br>";
			$logs .=$comment['log'];
			pdo_update('fm453_duokefu_comment', array('log' => $logs), array('id' => $id));
	message('您的删除操作执行成功！',$this->createMobileUrl('comment', array('op' => 'mine')),"success");
	exit();

}elseif($operation=="upload") {
	$max_size = "5000000";//文件大小 5M以内
	$inputname=$_GPC['inputname'];
	$filedata=$_FILES[$inputname];
	$returns=array();//要返回的数据
	if ($_FILES[$inputname]["error"] > 0){
  	$returns['error']= "错误: " . $_FILES[$inputname]["error"];
		$returns=json_encode($returns);
		echo $returns;//用return不行，必须要echo
  }else{
  $fname = $filedata["name"];
  $ftype = strtolower(substr(strrchr($fname, '.'), 1));
  $realtype =$filedata['type'];
  $fsize = $filedata["size"];
  $Storedpath = $filedata["tmp_name"];
 if ($fsize > $max_size) {
		$returns['error']= " 错误:"."您上传的图片超过了5M，请缩小或重新选择后再上传" . "";
		$returns=json_encode($returns);
		echo $returns;//用return不行，必须要echo
		exit;
	}
	load()->func('file');
	$imageid=date('YmdHis',TIMESTAMP);
	$imagename=$imageid."_".rand(1, 10000).".".$ftype;
	$imgurl="fm453_duokefu/images/".$imagename;
	file_move($Storedpath, IA_ROOT.'/attachment/'.$imgurl);//将文件从临时文件中复制到附件指定目录内
	chmod(IA_ROOT.'/attachment/'.$imgurl,0777);//修改文件权限
	//file_write($_W['attachurl'].'/fm453_duokefu/images',$filedata);
	$returns['initialPreview']=array();
	$returns['initialPreview'][0]="<img src='".tomedia($imgurl)."' class='file-preview-image' alt='pic with comment' title='pic with comment' id='".$imageid."'>";
	$returns['imgurl']=$imgurl;
	//在返回前，对returns进行json encode处理（file-input的ajax上传方式只接收json encode对象的返回）
	$returns=json_encode($returns);
echo $returns;//用return不行，必须要echo
return $returns;
}
}