<?php
/**
 * 客服助手插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 模块授权配置（清空覆盖方式）
 */
 defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '客服助手初始授权设置';
global $_GPC,$_W;
load()->func('file');
$saveItem = array();
$suip=$_GPC['suip'];
    $saveItem['suip']=$suip;
$sudomin=$_GPC['sudomin'];
    $saveItem['sudomin']=$sudomin;
$suapi=$_GPC['suapi'];
$suseceret=$_GPC['suseceret'];
$sufm453code = $_GPC['sufm453code'];

if(checksubmit(bindme)) {
    if($_W['isfounder']){
           $saveItem['suapi']=$suapi;
           $saveItem['suseceret']=$suseceret;
        $saveItem['sufm453code']=$sufm453code;
        $suinfo =md5($suip.$sudomin.$sufm453code);
            $saveItem['suinfo']=$suinfo;
        if(!empty($sufm453code)) {
	       $this->module['config']['shouquan']=$saveItem;
            file_write('fm453_duokefu/verify/'.$sudomin.'.log', $suinfo);
             //在附件文件夹下生成fm453_duokefu文件夹，并在其中建立一个以当前域名命名的日志文件，将授权信息写入文件中；
	       if($this->saveSettings($this->module['config']) && file_write('fm453_duokefu/verify/'.$sudomin.'.log', $suinfo)) {
	           message('恭喜，授权保存成功！','referer','success');
            }
        }else{
        message('亲，请填入客服给您的授权码！','referer','error');
        }
    }else {
        message('亲，这种事请让管理员来处理吧！','referer','error');
    }
}
if(checksubmit(rebindme) ) {
     if($_W['isfounder']){
        if(!empty($this->module['config']['shouquan']['sufm453code'])) {
            $saveItem['sufm453code']='';
             $saveItem['suapi']='';
             $saveItem['seceret']='';
            $sulog='由'.$_W['role'].$_W['username'].'(ID:'.$_W['uid'].')于'.date("Y-m-d H:i:s",TIMESTAMP).'操作解除授权';
            $suinfo ='IP:'.$suip.'，域名'.$sudomin.'，状态：'.$sulog;
                $saveItem['suinfo']=$suinfo;
            $this->module['config']['shouquan']=$saveItem;
            file_write('fm453_duokefu/verify/'.$sudomin.'.log', $suinfo);
            //  在附件文件夹下生成fm453_duokefu文件夹，并在其中建立一个以当前域名命名的日志文件，将授权信息写入文件中；
	       if($this->saveSettings($this->module['config']) && file_write('fm453_duokefu/verify/'.$sudomin.'.log', $suinfo)) {
	           message('现在，已经为您解绑了！','referer','success');
            }
        }else {
            message('亲，您还没有购买授权呢！','referer','error');
        }
    }else {
        message('亲，这种事请让管理员来处理吧！','referer','error');
    }
}