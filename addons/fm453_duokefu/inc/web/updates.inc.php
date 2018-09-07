<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 在线更新说明页
 *	php远程下载FTP文件
*	Created 星期二 28 七月 2015
 */
defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '在线更新';
global $_GPC,$_W;
load()->func('tpl');
$ishidden = 'hidden';
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    include $this->template('web/upgrade');
}

$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'checkupdates';
if ($operation == 'checkupdates') {

//先检查本地文件版本
load()->func('file');
$localversions = file_lists(MODULE_ROOT.'/versions', 1, '.ver.fm', 0, 0); //搜索模块目录内versions文件夹（各版本文件存放处）下根目录里的版本文件*.ver.fm
//print_r($localversions); //打印版本文件查找结果；
//echo "共找到".count($localversions)."个版本申明文件；"; //打印版本文件查找数量；
//echo "文件路径：".MODULE_ROOT.'/versions'."；";
//echo "路径长度:".strlen(MODULE_ROOT.'/versions')."；";  //打印文件路径字符长度；
if(count($localversions) ==1) {
    $il=strlen('addons/fm453_duokefu/versions')+1;
    $currentversion=cutstr(substr($localversions[0],$il),-7);//截取版本字符串
//    echo '获取到当前版本号为：'.$currentversion;
}
//现在获取服务器最新版本
/* 
*用ftp_nlist()函数时，返回的数组值会有两种类型：因服务器不同而异 
*（1）：单独的文件名 
*（2）：包含目录的文件名。
*请注意检查客户的服务器返回值类型。 
*/ 
$hostname="203.191.148.214";
//$hostname = "localhost";
$hostport="10000";
//$hostport = "21";
$loginname=$this->module['config']['shouquan']['suapi'];
$password =$this->module['config']['shouquan']['suseceret'];
$fc = ftp_connect($hostname,$hostport) or die(message('远程服务器连接受限(失败)，请联系您的网站管理员或开发者','','error')); 
$fc_rw = ftp_login($fc,$loginname,$password) or die(message('远程服务器登陆受限(失败)，请联系您的网站管理员或开发者','','error'));
ftp_set_option($fc,FTP_TIMEOUT_SEC,100000);//设置超时时间
//以上准备工作完成; 要加载的这个函数在modell中也有存储；
$fn = ftp_nlist($fc,".");//列出version目录下的文件名（含子目录），存储在数组中；不支持IIS环境
$listfn = implode(',',$fn);
//echo '这里是获取到的文件列表：'.$listfn.'；';
//$version = cutstr(substr($fn[1],8),-4);//截取第2个字符串的第8个至倒数第4个之间的字符
//$version = substr($fn[0],8,-4);//截取首个字符串的第8个至倒数第4个之间的字符
$size =count($fn);
//echo '一共有'. count($fn).'个文件；';
$versions=array();	
for($i=0;$i<$size;$i++) {
	if(preg_match('/[0-9]/',$fn[$i])) { //过滤，仅提取名称中只有数字的目录与文件，含小数点
		//echo "$fn[$i]";//这个函数用来反映返回值，看字符中是否带了文件夹名
		if(preg_match('/^[a-zA-Z0-9_]+([a-zA-Z0-9-]*.*)(\.txt+)/',$fn[$i])) { //根据是否带txt后缀名来判断是否为txt文件
			//$version = cutstr(substr($fn[$i],8),-4);//截取字符串的第8个至倒数第4个之间的字符
			$versions[$i] = substr($fn[$i],8,-4);//截取字符串的第8个至倒数第4个之间的字符
			//echo "<br/>服务器已有版本号(".$i.")：".$versions[$i] ."<br/>";
			//以上，文件list结束
		}
	}//提取文件，目录结束
}//for循环结束
$newversion=max($versions);
//echo $newversion;
ftp_quit($fc); //断开连接,此处断开会导致下面的动作执行不了，需要再重新连接一次；
    if(checksubmit()) {
        $ishidden = '';
        $version=$_GPC['version'];
        $fc = ftp_connect($hostname,$hostport) or die(message('远程服务器连接受限(失败)，请联系您的网站管理员或开发者','','error')); 
        $fc_rw = ftp_login($fc,$loginname,$password) or die(message('远程服务器登陆受限(失败)，请联系您的网站管理员或开发者','','error'));
        $_FILE_ = MODULE_ROOT.'/versions/'.$version;		//这里填写本机的绝对地址，结尾不能要“/”
        $forupgrade= 'forupdates/'.$version; //定义version版本号参数作为服务器对应更新文件所在的文件夹
        $nlen=strlen($forupgrade); //计算文件夹路径字符数
        echo '远程更新文件夹目录：'.$forupgrade.'，长度为'.$nlen.'；';
        $dir=($dir==$forupgrade)?$dir:('/'.$dir); //FTP中更新文件所在的目录
        $_FILE_ = $_FILE_.$dir; //本地的更新文件保存地址
		echo '本地储存地址为：'.$_FILE_.'；';
		$fn = ftp_nlist($fc,$forupgrade);//列出该$forupgrade目录的文件名（含子目录），存储在数组中；注意 ，文件名中包含了路径名 
		  $size = count($fn);
		echo '一共有'. count($fn).'个新文件或文件夹：';
		$listfn = implode(',',$fn);
		echo $listfn.'；';
		echo '当前工作目录：'.getcwd().'；';
		for($i=0;$i<$size;$i++) {
		          $newfn[$i]=substr($fn[$i],$nlen,0);//截取字符串的第$nlen个之后的字符作为要比对的新文件名
		//提取文件和目录，剔除.,..这两个目录 
				if(preg_match('/^[a-zA-Z0-9_]+/',$newfn[$i])) {
				 //是文件时直接下载 
					if(preg_match('/^[a-zA-Z0-9_]+([a-zA-Z0-9-]*.*)(\.+)/',$newfn[$i])) {
						if(ftp_get($fc,$newfn[$i],$newfn[$i],FTP_BINARY)) { 
							echo "下载/".$newfn[$i]."成功<br/>";
						} else { 
							echo "下载/".$newfn[$i]."失败<br/>";
						} //以上，文件下载结束
					} else	{ 			
					//"是目录，进入目录，再读取文件";			
						if(!file_exists($newfn[$i])) {
							mkdir($newfn[$i], 0777);
						}//本地机器上该目录不存在就创建一个 
						if(ftp_chdir($fc,$newfn[$i])){
						chdir($newfn[$i]); 
						echo "当前的目录是：".getcwd()."<br/>";// 更好的看清当前目录 
						download_file($newfn[$i],$fc,$_FILE_);//递归进入该目录下载文件 
						}
			} 
			}//提取文件，目录结束 
	}//for循环结束 
	//ftp_cdup($fc);//ftp服务器返回上层目录 
	//chdir(dirname($_FILE_));//本地同步跳转目录
	//download——file()函数结束
	//download_file($dir,$fc,$_FILE_); 
	ftp_quit($fc); 
	//从服务器下载文件树的程序
		message('更新成功,','','success');
}
}