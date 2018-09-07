<?php
/**
 * 客服助手模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 自定义导航条设置页
 */
defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '自定义导航条设置';
global $_GPC,$_W;
if(!empty($this->module['config']['shouquan']['sufm453code']) && $this->module['config']['onoffs']['isnavs']==1){
    $navsmun = $this->module['config']['navsnum'];
         if(empty($navsnum)){
		        $navsmun = 5;
		   }
	$saveNav = array();
    for ($n=0; $n <$navsmun ; $n++) {

}else {
    $navmenusmun = $this->module['config']['navmenusnum'];
        if(empty($navmenusnum)){
		        $navmenusmun = 5;
		 }
    $saveItem = array();
    $mymenuname = $_GPC['mymenuname'];
        $saveItem['mymenuname']=$mymenuname;
    $mymenuvalue = $_GPC['mymenuvalue'];
        $saveItem['mymenuvalue']=$mymenuvalue;
    $mymenuicon = $_GPC['mymenuicon'];
        $saveItem['mymenuicon']=$mymenuicon;
    for ($i=0; $i <$navmenusmun ; $i++) {
    	$iconValue=$_GPC['icon'.$i];
    	$linkValue=$_GPC['value'.$i];
    	$nameValue=$_GPC['name'.$i];

		$saveItem['icon'.$i]=$iconValue;
		$saveItem['value'.$i]=$linkValue;
		$saveItem['name'.$i]=$nameValue;
    }
   $this->module['config']['navmenus']=$saveItem;

	if($this->saveSettings($this->module['config'])) {
	message('导航模块设置成功','referer','success');
}else{
	message('模块设置失败','','error');
}
}