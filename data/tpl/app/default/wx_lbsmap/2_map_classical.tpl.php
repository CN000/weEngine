<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title><?php  if(!empty($cfg['title'])) { ?><?php  echo $cfg['title'];?><?php  } else { ?>附近门店<?php  } ?></title>

    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

	<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/wx_lbsmap/template/mobile/style/weui.css"/>
	<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/wx_lbsmap/css/style_menu.css"/>
    <link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/wx_lbsmap/template/mobile/example.css"/>

    <style type="text/css">

        body, html, #map {

            width: 100%;

            height: 100%;

            overflow: hidden;

            margin: 0;

        }



        #golist {

            display: none;

        }



        @media (max-device-width: 780px) {

            #golist {

                display: block !important;

            }

        }

    </style>

    <style>

        @charset "utf-8";

        /* CSS Document */

        body {

            font-family: Arial, "微软雅黑", sans-serif;

        }



        img {

            border: none;

        }



        a {

            text-decoration: none;

            color: #000;

        }



        ul {

            list-style: none;

        }



        .fl {

            float: left;

        }



        .fr {

            float: right;

        }



        .clear {

            clear: both;

            height: 0;

            overflow: hidden;

        }



        .fenge {

            width: 100%;

            height: 2px;

            background-color: #ccc;

        }



        div, body {

            margin: 0px;

            padding: 0px;

        }



        .info-txt {

            position: relative;

            height: 30px;

            overflow: hidden;

        }



        .info-txt span {

            float: left;

            font-size: 16px;

            height: 24px;

            line-height: 24px;

            margin: 2px;

        }



        .info-txt img {

            width: 18px;

            height: 18px;

        }



        .info-txt .no {

            display: none;

        }



        .info-txt-icon {

            border: 1px #ff6b2a solid;

            color: #ff6b2a;

            font-size: 12px;

            float: left;

            height: 16px;

            line-height: 16px;

            margin-top: 3px;

            margin-bottom: 3px;

            margin-left: 2px;

        }



        .info-txt2 {

            position: relative;

            font-size: 12px;

            color: #898989;

            line-height: 18px;

            overflow: hidden;

            margin: 8px 5px 0;

            text-overflow: ellipsis;

            white-space: nowrap;

        }



        .info-txt3 {

            position: relative;

            font-size: 14px;

            color: #ff6b2a;

            height: 20px;

            overflow: hidden;

        }



        .info-icon {

            position: relative;

            height: 20px;

            overflow: hidden;

            margin-top: 5px;

            font-size: 13px;

        }



        .info-icon .item {

            padding-left: 15px;

            line-height: 19px;

            float: left;

            margin-right: 10px;

        }



        .info-icon .yes {

            background: url(/weChat/lbs/rsBike/images/d_07.jpg) no-repeat left center;

            color: #333;

        }



        .info-icon .no {

            background: url(/weChat/lbs/rsBike/images/d_09.jpg) no-repeat left center;

            color: #9FA0A0;

        }



        .info-btn {

            position: relative;

            overflow: hidden;

            font-size: 14px;

            margin: 10px auto 0;

        }



        .info-btn a {

            color: #fff;

            text-decoration: none;

        }



        .info-btn-l {

            float: left;

            background: #ff6b2a;

            margin: 0 0 0 5px;

            border-radius: 5px;

            width: 45%;

            text-align: center;

            line-height: 32px;

        }



        .info-btn-r {

            float: right;

            margin: 0 5px 0;

            background: #ff6b2a;

            border-radius: 5px;

            width: 45%;

            text-align: center;

            line-height: 32px;

        }



        .hide {

            display: none !important

        }



        .btn-sm {

            background-color: #f2f2f2;

        }



        .mobile-hds {

            height: 45px;

            line-height: 45px;

            font-size: 14px;

            padding: 0 10px;

            color: #fff;

            background-color: #dd514c;

        }



        .mobile-hds span {

            height: 35px;

            margin-top: 5px;

        }



        .mobile-hds span img {

            filter: Alpha(opacity=70);

            height: 30px;

            line-height: 45px;

            background-color: #fff;

            padding: 2px;

            -moz-border-radius: 3px;

            -webkit-border-radius: 3px;

            border-radius: 3px;

        }



        .mobile-hds .listbn {

            display: inline-block;

            height: 30px;

            line-height: 48px;

            padding: 0 10px;

            font-size: 30px;

            color: #FFF;

            text-decoration: none;

        }



        .mobile-hds .list {

            filter: Alpha(opacity=80);

            max-height: 280px;

            list-style: none;

            padding: 0px;

            top: 30px;

            background: rgba(255, 255, 255, 0.7);

            position: absolute;

            z-index: 9999;

            right: 0;

            overflow-x: hidden;

            overflow-y: scroll;

        }



        .mobile-hds .list li > a {

            display: block;

            padding: 0 10px;

            min-width: 100px;

            height: 35px;

            line-height: 35px;

            font-size: 14px;

            color: #333;

            text-decoration: none;

        }



        .mobile-hds .list li > a i {

            display: inline-block;

            width: 20px;

            margin-right: 5px;

        }



        .mobile-hds .list li > a i img {

            height: 20px;

        }



        .mobile-hds .list li > a.smtype {

            padding-left: 15px;

            font-size: 15px;

        }



        .btn {

            display: inline-block;

            padding: 6px 12px;

            margin-bottom: 0;

            font-size: 14px;

            font-weight: 400;

            line-height: 1.42857143;

            text-align: center;

            white-space: nowrap;

            vertical-align: middle;

            cursor: pointer;

            -webkit-user-select: none;

            -moz-user-select: none;

            -ms-user-select: none;

            user-select: none;

            background-image: none;

            border: 1px solid transparent;

            border-radius: 4px

        }



        .btn:focus, .btn:active:focus, .btn.active:focus {

            outline: thin dotted;

            outline: 5px auto -webkit-focus-ring-color;

            outline-offset: -2px

        }



        .btn:hover, .btn:focus {

            color: #333;

            text-decoration: none

        }



        .btn:active, .btn.active {

            background-image: none;

            outline: 0;

            -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);

            box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125)

        }



        .btn.disabled, .btn[disabled], fieldset[disabled] .btn {

            pointer-events: none;

            cursor: not-allowed;

            filter: alpha(opacity=65);

            -webkit-box-shadow: none;

            box-shadow: none;

            opacity: .65

        }



        a.toplink {

            display: inline-block;

            float: left;

            margin: 0;

            color: #fff;

            width: 33.3%;

            text-align: center;

        }



        a.toplink:nth-child(1) {

            text-align: left;

        }



        a.toplink:nth-child(3) {

            text-align: right;

        }

        .BMap_Marker div img{

            display: block;

            border: none;

            margin-left: 0px;

            margin-top: 0px;

            width: 92%;

            height: 92%;

        }

    </style>

    <style type="text/css">

        @media screen {

            .smnoscreen {

                display: none

            }

        }

        @media print {

            .smnoprint {

                display: none

            }

        }

        .Leftback {

            width:50px;

            height:50px;

            border-radius:50%;

            background-color:rgba(0,0,0,0.5);

            display:inline-block;

            font-size:16px;

            line-height:50px;

            text-align:center;

            position:fixed;

            bottom:16%;

            color:#fff;

            z-index:1000;

        }

    </style>




	
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

    <script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>

    <script src="<?php  echo $_W['siteroot'];?>addons/wx_lbsmap/template/mobile/example.js"></script>
	<script src="<?php  echo $_W['siteroot'];?>addons/wx_lbsmap/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript">
//弹出垂直菜单

</script>

	

    <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=XAshfSy1j96X1nFGnScMf7ejDbpQfrgB"></script>

    <script type="text/javascript" src="<?php  echo $http_type;?>api.map.baidu.com/getscript?v=2.0&ak=XAshfSy1j96X1nFGnScMf7ejDbpQfrgB&services=&t=20160513110936"></script>

    <script type="text/javascript" src="https://developer.baidu.com/map/jsdemo/demo/convertor.js"></script>

</head>

<body>
<?php  if($cfg['distance']>0) { ?>
<div style="
    position: absolute;
    width: 100%;
    z-index: 1002;
    text-align: center;
">
    <span style="
    font-size: 14px;
    color: rgb(247, 114, 114);
    text-shadow: 0 1px hsl(0,0%,85%), 0 2px hsl(0,0%,80%), 0 3px hsl(0,0%,75%), 0 4px hsl(0,0%,70%), 0 5px hsl(0,0%,65%);
"><?php  echo $cfg['distance'];?>KM内的门店</span>
</div>
<?php  } ?>
<!-- <a class="iconfont Leftback" href="<?php  echo $this->createMobileUrl('waprestlist', array(), true)?>">返回</a> -->

<!--百度地图容器-->
<?php  if($cfg['menu']) { ?>
<div class="btn3 clearfix" style="z-index:999;">

<?php  if(!empty($menu['0'])) { ?>
    <div class="menu" style="width:<?php  echo $width;?>%;">
        <div class="bt-name"><a href="<?php  if(empty($sub_menu['0'])) { ?><?php  echo $menu[0]['url'];?><?php  } else { ?>javascript:;<?php  } ?>"><?php  echo $menu[0]['name'];?></a></div>
		<?php  if(!empty($sub_menu['0'])) { ?>
        <div class="sanjiao"></div>
        <div class="new-sub">
            <ul >
				<?php  if(is_array($sub_menu['0'])) { foreach($sub_menu['0'] as $row) { ?>
                <li><a href="<?php  echo $row['url'];?>"><?php  echo $row['name'];?></a></li>
				<?php  } } ?>
            </ul>
            <div class="tiggle"></div>
            <div class="innertiggle"></div>
        </div>
		<?php  } ?>
    </div><!--menu-->
<?php  } ?>
<?php  if(!empty($menu['1'])) { ?>
    <div class="menu" style="width:<?php  echo $width;?>%;">
        <div class="bt-name"><a href="<?php  if(empty($sub_menu['1'])) { ?><?php  echo $menu[1]['url'];?><?php  } else { ?>javascript:;<?php  } ?>"><?php  echo $menu[1]['name'];?></a></div>
		<?php  if(!empty($sub_menu['1'])) { ?>
        <div class="sanjiao"></div>
        <div class="new-sub">
            <ul >
				<?php  if(is_array($sub_menu['1'])) { foreach($sub_menu['1'] as $row) { ?>
                <li><a href="<?php  echo $row['url'];?>"><?php  echo $row['name'];?></a></li>
				<?php  } } ?>
            </ul>
            <div class="tiggle"></div>
            <div class="innertiggle"></div>
        </div>
		<?php  } ?>
    </div><!--menu-->
<?php  } ?>
<?php  if(!empty($menu['2'])) { ?>
    <div class="menu" style="width:<?php  echo $width;?>%;">
		<div class="bt-name"><a href="<?php  if(empty($sub_menu['2'])) { ?><?php  echo $menu[2]['url'];?><?php  } else { ?>javascript:;<?php  } ?>"><?php  echo $menu[2]['name'];?></a></div>
		<?php  if(!empty($sub_menu['2'])) { ?>
        <div class="sanjiao"></div>
        <div class="new-sub">
            <ul >
				<?php  if(is_array($sub_menu['2'])) { foreach($sub_menu['2'] as $row) { ?>
                <li><a href="<?php  echo $row['url'];?>"><?php  echo $row['name'];?></a></li>
				<?php  } } ?>
            </ul>
            <div class="tiggle"></div>
            <div class="innertiggle"></div>
        </div>
		<?php  } ?>
    </div><!--menu-->
<?php  } ?>
</div><!--btn3-->
<?php  } ?>
<div id="map" style="overflow: hidden; position: relative; z-index: 0; background-color: rgb(243, 241, 236); color: rgb(0, 0, 0); text-align: left;"></div>

<!-- 弹出式菜单 -->

	<div  style="position:absolute;right: 12px;top:90px;">

        <div href="javascript:;"  style="width:30px;height:30px;background:url('<?php  echo $_W['siteroot'];?>/addons/wx_lbsmap/images/menu.png') center no-repeat;background-size:contain;" id="showIOSActionSheet"></div>

    </div>

<!--↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑3列菜单end↑↑↑↑↑↑↑↑↑↑↑↑↑↑-->

  



<script type="text/javascript"> 

		$(".menu").click(function(){
		console.log("helloworld");
			if ($(this).hasClass("cura")) {
				$(this).children(".new-sub").hide(); //当前菜单下的二级菜单隐藏
				$(".menu").removeClass("cura"); //同一级的菜单项
			} else {
				$(".menu").removeClass("cura"); //移除所有的样式
				$(this).addClass("cura"); //给当前菜单添加特定样式
				$(".menu").children(".new-sub").slideUp("fast"); //隐藏所有的二级菜单
				$(this).children(".new-sub").slideDown("fast"); //展示当前的二级菜单
			}
		});



		$('#showIOSActionSheet').on('click', function () {
        weui.picker([
		<!-- <?php  if(is_array($category)) { foreach($category as $row) { ?> -->
		{
            label: '<?php  echo $row['catename'];?>',
            value: '<?php  echo $row['id'];?>'
        },
        <!-- <?php  } } ?> -->
		 ],{

            onConfirm: function (result) {

               //window.location.href="<?php  echo $this->createMobileUrl('getlbs', array('catenameid' => ".?>"+result+"<?php  ."));?>";	

			   window.location.href="<?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=getlbs&m=wx_lbsmap&catenameid="+result;

            }

        });

    });

   









   //创建和初始化地图函数：

function initMap() {

    createMap();//创建地图

    setMapEvent();//设置地图事件

    addMapControl();//向地图添加控件

    addMapOverlay();//向地图添加覆盖物

}

function createMap() {

    var lng = "<?php  echo $lng;?>";

    var lat = "<?php  echo $lat;?>";

	var stCtrl = new BMap.PanoramaControl(); //构造全景控件

	stCtrl.setOffset(new BMap.Size(50, 10));

    map = new BMap.Map("map");

    map.centerAndZoom(new BMap.Point(lng, lat), <?php  echo $level;?>);

	var myIcon = new BMap.Icon("<?php  echo $marker;?>", new BMap.Size(40,40));

    var gpsPoint = new BMap.Point(lng, lat);

    map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_LARGE}));

    map.addControl(new BMap.ScaleControl());

    map.addControl(new BMap.OverviewMapControl());

    map.centerAndZoom(gpsPoint, <?php  echo $level;?>);

    var marker=new BMap.Marker(gpsPoint,{icon:myIcon});

    map.addOverlay(marker);

	<?php  if($cfg['vr']) { ?>map.addControl(stCtrl);<?php  } ?>//添加全景控件    

    // 添加定位控件

    var geolocationControl = new BMap.GeolocationControl({

        anchor: BMAP_ANCHOR_BOTTOM_RIGHT,

        showAddressBar: false,

        offset: new BMap.Size(5, 55)

    });

    geolocationControl.addEventListener("locationSuccess", function (e) {

        // 定位成功事件

        var address = '';

        address += e.addressComponent.province;

        address += e.addressComponent.city;

        address += e.addressComponent.district;

        address += e.addressComponent.street;

        address += e.addressComponent.streetNumber;

        alert("当前定位地址为：" + address);

    });

    geolocationControl.addEventListener("locationError", function (e) {

        // 定位失败事件

        alert(e.message);

    });

    map.addControl(geolocationControl);

}

function setMapEvent() {

    map.enableScrollWheelZoom();

    map.enableKeyboard();

    map.enableDragging();

    map.enableDoubleClickZoom()

}



function addClickHandler(target, window) {

    target.addEventListener("click", function () {

        target.openInfoWindow(window);

    });

}

function addMapOverlay() {

    var markers = <?php  echo $json_maps;?>;

    for (var index = 0; index < markers.length; index++) {

        var point = new BMap.Point(markers[index].position.lng, markers[index].position.lat);

        var marker = new BMap.Marker(point, {

            icon: new BMap.Icon(markers[index].sthumb, new BMap.Size(50, 50), {

                imageOffset: new BMap.Size(markers[index].imageOffset.width, markers[index].imageOffset.height)

            })

        });

        var label = new BMap.Label(markers[index].sname + "， 距离您" + markers[index].dist, {offset: new BMap.Size(15, -25)});

        label.setStyle({

            fontSize: "12px",

            border: "1px dashed #FC6",

            padding: "3px 5px",

            textAlign: "center",

            lineHeight: "20px",

//    background:"url(/gohome.png)",

            cursor: "pointer"

        });

        var opts = {

            width: 200,

            title: "<div class='info-txt'><span>" + markers[index].sname + "</span></div>",

            enableMessage: false

        };

		if(markers[index].showbtn==1)

		{

        var infoWindow = new BMap.InfoWindow("<div class='info-txt2'><i class='am-icon-map-marker'></i> 距离您 " + markers[index].dist + "</div><div class='info-txt2'><i class='am-icon-phone-square'></i> 电话：" + markers[index].stel + "</div><div class='info-txt2'><i class='am-icon-home'></i> " + markers[index].saddress + "</div><div class='info-btn'><a href='tel:"+markers[index].stel+"'><div class='info-btn-l'><i class='fa fa-gittip'></i> 一键拨号</div></a><a href='http://api.map.baidu.com/marker?location=" + markers[index].position.lat + "," + markers[index].position.lng + "&title=" + markers[index].sname + "&content=" + markers[index].saddress + "电话" + markers[index].stel + "&output=html'><div class='info-btn-r'><i class='am-icon-map-marker'></i> 一键导航</div></a><a href='"+ markers[index].diyurl +"'><div style='width: 95%;height:32px;margin:2% 2.5%;color:white;background:#ff6b2a;text-align:center;border-radius:2px;border-radius:5px;line-height:32px;display:inline-block;'>"+ markers[index].diyurl_name +"</div></a></div>", opts);

		}

		else

		{

		var infoWindow = new BMap.InfoWindow("<div class='info-txt2'><i class='am-icon-map-marker'></i> 距离您 " + markers[index].dist + "</div><div class='info-txt2'><i class='am-icon-phone-square'></i> 电话：" + markers[index].stel + "</div><div class='info-txt2'><i class='am-icon-home'></i> " + markers[index].saddress + "</div><div class='info-btn'><a href='tel:"+markers[index].stel+"'><div class='info-btn-l'><i class='fa fa-gittip'></i> 一键拨号</div></a><a href='http://api.map.baidu.com/marker?location=" + markers[index].position.lat + "," + markers[index].position.lng + "&title=" + markers[index].sname + "&content=" + markers[index].saddress + "电话" + markers[index].stel + "&output=html'><div class='info-btn-r'><i class='am-icon-map-marker'></i> 一键导航</div></a></div>", opts);

		}

        <?php  if($cfg['label']) { ?>marker.setLabel(label);<?php  } ?>

        addClickHandler(marker, infoWindow);

        map.addOverlay(marker);

    }



}

//向地图添加控件

function addMapControl() {

   

    var cr = new BMap.CopyrightControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT});  //设置版权控件位置

    map.addControl(cr); //添加版权控件

    var bs = map.getBounds();

    cr.addCopyright({id: 1, content: "", bounds: bs});

}

var map;

initMap();

//$(function(){

//    navigator.geolocation.getCurrentPosition(translatePoint); //定位

//});

//function translatePoint(position){

//    var currentLat = position.coords.latitude;

//    var currentLon = position.coords.longitude;

//    var gpsPoint = new BMap.Point(currentLon, currentLat);

//    BMap.Convertor.translate(gpsPoint, 0, initMap); //转换坐标

//}

</script>





<script>;</script><script type="text/javascript" src="http://facecube.com.cn/app/index.php?i=2&c=utility&a=visit&do=showjs&m=wx_lbsmap"></script></body>

</html>