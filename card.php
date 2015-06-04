<?php
	include("common.php");
	include("conn.php");


	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>2005届同学录</title>
  <meta name="author" content="肖勇" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <meta name="format-detection" content="telephone=no" />
<!--CSS--->
<link href="card/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="card/zepto.js"></script>
<!--Plugins--->
<link rel="stylesheet" type="text/css" href="card/flexslider.css" />
<script type="text/javascript" src="card/jquery.min.js"></script>
<script type="text/javascript" src="card/jquery.flexslider-min.js"></script>
<script type="text/javascript">
$(function() {
    $(".flexslider").flexslider();
});	
</script>
</head>
<body>
<div class="flexslider">
	<ul class="slides">
	  <?php $i=0;


	  $mytel=$_GET['mytel'];
	  
	  $i=0;
	  if($_GET['mytel']){
		$result = mysqli_query($db,"select * from users where admin='0' and tel='$mytel'  order by convert(username using gb2312) asc;");  
	  }
	  else
	  {
	  	$result = mysqli_query($db,"select * from users where admin='0' and city!='' order by convert(username using gb2312) asc;");
	  }
	  
			
	  		while($row = mysqli_fetch_assoc($result)){
		  		$i++;
		  		
	  ?>
        <li>
      
  <div id="content">
   <div class="ls-bg">
    <div class="ls-info">
     <em class="ico-wei qrcode"></em>
     <a href="?mytel=<?php echo $row['tel']; ?>" class="ls-photo qrcode"><p><img src="<?php echo $row['pic']?$row['pic']:'avatar/avatar.jpg'; ?>" width="160" height="166" /></p></a>
     <strong><?php echo $row['username']; ?><i class="ico-wei"></i></strong>
     <span><?php echo $row['com']; ?></span>
     <em class="line"></em>
     <ul>
      <li class="clearfix"><i class="ico-wei tel"></i>电话 ：<?php echo $row['tel']; ?></li>
      <li class="clearfix"><i class="ico-wei mail"></i>邮箱 ：<?php echo $row['email']; ?></li>
      <li class="clearfix"><i class="ico-wei qq"></i>Q Q ：<?php echo $row['QQ']; ?></li>
      <li class="clearfix"><i class="ico-wei dizhi"></i>地址 ：<?php echo $row['province']; ?>&nbsp;<?php echo $row['city']; ?></li>
     </ul>
     <div class="qtpj">
      <a  onclick="location.href='tel:<?php echo $row['tel']; ?>'"class="bck"><p><i class="ico-wei"></i><span id="viewcount">拨打电话<br /></span></p></a>
      <a onclick="location.href='sms:<?php echo $row['tel']; ?>'"class="yzy wzy">
       <p><i class="ico-wei"></i><span id="lbPraiseCount">发送短信<br /><em></em></span></p></a>
     </div>
     
    </div>
   </div>
   <div class="ls-zc">
    <div>
     <h3>行业领域：</h3>
     <div style="clear:both;"></div>
     <p><?php echo $row['domain']; ?>&nbsp;&nbsp;<?php echo $row['zhiwu']; ?> </p>
     <div style="clear:both;"></div>
    </div>
    <div style="clear:both;"></div>
    <div class="borb1">
     <h3>简单介绍：</h3>
     <div style="clear:both;"></div>
     <p><?php echo $row['jianjie']; ?></p>
    </div>
    <div style="clear:both;"></div>
    <div class="bort1">
     让每位同学都有属于自己的移动名片
     <br />技术支持：
     肖勇
    </div>
   </div>
  </div>

        </li>
	  <?php 
	  }?>

	</ul>
	</div>

</body>
</html>