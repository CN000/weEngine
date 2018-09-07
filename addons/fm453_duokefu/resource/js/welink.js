/*
 By fm453@lukegzs.com
 说明：请复制下面的JS代码到需要的页面即可；注释部分不用复制
*/

<script>
if (window.frames.length != parent.frames.length) {
  document.write("<span id='postcurrenturl' class='duokefuurl'>当前网址：<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> </span>");
}
</script>