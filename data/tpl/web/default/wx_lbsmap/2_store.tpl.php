<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('store', array('op' => 'display'))?>">门店管理</a></li>
    <li <?php  if($operation == 'edit') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('store', array('op' => 'edit'))?>">添加门店</a></li>
</ul>
<?php  if($operation == 'edit') { ?>
<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">
       添加门店
      </h3>
   </div>

   
   <div class="panel-body">
   <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<div class="form-group">
					<label  class="col-sm-2 control-label">分类</label>
					<div  class="col-sm-10">
						<select name="catenameid" class="form-control">
							<option value="0">请选择分类</option>
							<?php  if(is_array($category)) { foreach($category as $row) { ?>
							<option value="<?php  echo $row['id'];?>" <?php  if($row['id']==$getid['id']) { ?>selected<?php  } ?>><?php  echo $row['catename'];?></option>
							
							<?php  } } ?>
						</select>
					</div>	               
		</div>
		
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">门店名称</label>
            <div class="col-sm-10">
              <input type="text"  name="sname" class="form-control" value="<?php  echo $list['sname'];?>" placeholder="请输入门店在地图上的显示名称"/>
            </div>
        </div>
		<div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">门店logo</label>
            <div class="col-sm-10">
              <?php  echo tpl_form_field_image('sthumb', $list['sthumb']);?>
			  <span class="help-block">点击后显示的门店logo，推荐与参数设置中的logo一致。</span>
            </div>
			
        </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">联系电话</label>
            <div class="col-sm-10">
              <input type="text" name="stel" class="form-control" value="<?php  echo $list['stel'];?>" placeholder="请输入门店联系电话"/>
			  
            </div>
        </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">门店地址</label>
            <div class="col-sm-10">
              <input type="text" name="saddress" class="form-control" value="<?php  echo $list['saddress'];?>" placeholder="请输入门店地址"/>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">坐标</label>
            <div class="col-sm-9">
                <?php  echo tpl_form_field_coordinate('baidumap', $list)?>
				<span class="help-block">请在地图中选择正确的坐标位置</span>
            </div>
        </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否显示自定义按钮</label>
            <div class="col-sm-10">
				<label class="radio radio-inline">
				<input type="radio" name="showbtn" value="0" <?php  if(intval($list['showbtn']) == 0) { ?>checked="checked"<?php  } ?>>不显示
				</label>
				<label class="radio radio-inline">
					<input type="radio" name="showbtn" value="1" <?php  if(intval($list['showbtn']) == 1) { ?>checked="checked"<?php  } ?>>显示
				</label>
            </div>
        </div>
		<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">自定义链接名称</label>
					<div class="col-sm-10">
						<input type="text" name="diyurl_name" class="form-control" value="<?php  echo $list['diyurl_name'];?>" placeholder="请输入自定义链接名称"/>
						<span class="help-block">自定义链接名称最多为6个字，多余的字以"..."代替</span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">自定义链接</label>
					<div class="col-sm-10">
						<input type="text" name="diyurl" class="form-control" value="<?php  echo $list['diyurl'];?>" placeholder="请输入自定义链接"/>
					</div>
		</div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否显示店长信息</label>
            <div class="col-sm-10">
				<label class="radio radio-inline">
				<input type="radio" name="showc" value="0" <?php  if(intval($list['showc']) == 0) { ?>checked="checked"<?php  } ?>>不显示
				</label>
				<label class="radio radio-inline">
					<input type="radio" name="showc" value="1" <?php  if(intval($list['showc']) == 1) { ?>checked="checked"<?php  } ?>>显示
				</label>
            </div>
        </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店长姓名</label>
            <div class="col-sm-10">
              <input type="text"  name="cname" class="form-control" value="<?php  echo $list['cname'];?>" placeholder="请输入店长姓名"/>
            </div>
        </div>
		<div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">店长头像</label>
            <div class="col-sm-10">
              <?php  echo tpl_form_field_image('cthumb', $list['cthumb']);?>
			  
            </div>
        </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店长手机</label>
            <div class="col-sm-10">
              <input type="text" name="ctel" class="form-control" value="<?php  echo $list['ctel'];?>" placeholder="请输入店长联系电话"/>
            </div>
        </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店长简介</label>
            <div class="col-sm-10">
              <input type="text" name="cinfo" class="form-control" value="<?php  echo $list['cinfo'];?>" placeholder="请输入店长简介"/>
			  <span class="help-block">用一句话对店长进行介绍，最多5000字</span>
            </div>
        </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店长星级</label>
            <div class="col-sm-10">
                <div class="input-group">
                <select class="form-control" name="clevel">
                    <option value='5' <?php  if($list['clevel'] == 5) { ?>selected<?php  } ?>>★★★★★</option>
                    <option value='4' <?php  if($list['clevel'] == 4) { ?>selected<?php  } ?>>★★★★</option>
                    <option value='3' <?php  if($list['clevel'] == 3) { ?>selected<?php  } ?>>★★★</option>
                    <option value='2' <?php  if($list['clevel'] == 2) { ?>selected<?php  } ?>>★★</option>
                    <option value='1' <?php  if($list['clevel'] == 1) { ?>selected<?php  } ?>>★</option>
                </select>                
                </div>
            </div>
        </div>
		<div class="form-group col-sm-12">
                <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
				
                <input type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交" />
        </div>
   
   </form>
   </div>
</div>
<?php  } else { ?>
   <div class="panel panel-default">
   <div class="panel-body">
            <form action="<?php  echo $this->createWebUrl('store',array('op'=>'display'))?>" method="post" class="form-horizontal">
                <div class="form-group">
                   <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 200px;">按店名称搜索</label>
                    <div class="col-sm-2 col-lg-3">
	                    <input type="text" name="search" value="<?php  echo $search;?>" class="form-control" style="display: inline-block;">
                    </div>
                </div>
				<div class="form-group">
                   <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 200px;">按分类ID搜索</label>
                    <div class="col-sm-2 col-lg-3">
	                    <input type="text" name="searchid" value="<?php  echo $searchid;?>" class="form-control" style="display: inline-block;">
                    </div>
                </div>
				<button class="btn btn-default">搜索</button>
            </form>
    </div>
	</div>
	    <div class="panel panel-default">
        <div class="table-responsive panel-body">
            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
						<th style="width:10%;">分类ID</th>
                        <th style="width:10%;">门店分类</th>
						<th style="width:20%;">门店名称</th>
                        <th style="width:20%;">门店logo</th>
                        <th style="width:20%;">门店电话</th>
                        <th style="width:20%;text-align: right;" >操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($lists)) { foreach($lists as $list) { ?>
                    <tr>
						<td>
							<?php  echo $list['catenameid'];?>
                        </td>
                        <td>
							<?php  if($list['catenameid']==0) { ?>未分类<?php  } else { ?><?php  echo $list['catename'];?><?php  } ?>
                        </td>
                        <td>
							<?php  echo $list['sname'];?>
                        </td>
                        <td>
                            <img src="<?php  if(strstr($list['sthumb'], 'http') || strstr($list['sthumb'], './source/modules/')) { ?><?php  echo $list['sthumb'];?><?php  } else { ?><?php  echo $_W['attachurl'];?><?php  echo $list['sthumb'];?><?php  } ?>" onerror="this.src='./resource/images/nopic.jpg';" width="60px;" style="border-radius: 3px;">
                        </td>
                        <td><?php  echo $list['stel'];?></td>
                        <td style="text-align: right;">
                            <a href="<?php  echo $this->createWebUrl('store', array('op' => 'edit','sid' => $list['id']))?>" title="编辑" class="btn btn-default btn-sm"><i class="fa fa-edit"></i>
						查看编辑</a>
					
						<a href="<?php  echo $this->createWebUrl('store', array('op' => 'delete','sid' => $list['id']))?>" onclick="return confirm('确认删除此门店信息吗？');return false;" title="删除" class="btn btn-default btn-sm"><i class="icon-remove"></i>
						删除</a>
                        </td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>