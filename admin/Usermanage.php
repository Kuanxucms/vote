<?php
	include("common.php");
	include("../conn.php");

	if($_GET['do'] == "delete"){
		$id = $_GET['id'];
		$result = $db->query("delete from users where cid in ($id);");
		if($result){
			echo "<script>onload = function(){document.getElementById('errortext').innerHTML='删除成功';}</script>";
		}else{
			echo "<script>onload = function(){document.getElementById('errortext').innerHTML='删除失败';}</script>";
		}
	}
	if($_POST['Submit']){
		$id = $_POST['id'];
		$passwd = $_POST['passwd'];
		$result = $db->query("update users set passwd='$passwd' where cid='$id';");
		if($result){
			echo "<script>onload = function(){document.getElementById('errortext').innerHTML='修改成功';}</script>";
		}else{
			echo "<script>onload = function(){document.getElementById('errortext').innerHTML='修改失败';}</script>";
		}
		
	}

	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title></title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/add.css" type="text/css" media="screen" />
<link rel="stylesheet" href="utilLib/bootstrap.min.css" type="text/css" media="screen" />

<script language="javascript">
	function selectall()
	{
		var node = document.getElementsByName("checkboxitem");
		for(var i=0; i<node.length;i++){
			node[i].checked=true;
		}
	}
	function unselectall(){
		var node = document.getElementsByName("checkboxitem");
		for(var i=0; i<node.length;i++){
			node[i].checked = false;
		}
	}
	function deleteselect(){
		var node = document.getElementsByName("checkboxitem");
		id = "";
		for(var i=0; i<node.length;i++){
			if(node[i].checked){
				if(id == ""){
					id = node[i].value;
				}else{
					id = id+", "+node[i].value;
				}
			}
		}
		if(id == ""){
			alert("请选择删除项");
		}else{
			location.href="?do=delete&id="+id;
		}
		
	}
</script>

</head>
<body>

<div class="div_from_aoto" style="width: 98%;">
	<div id="result111" class="result111" style="width:300px; height:20px; margin:4px auto; color:#33FF99;  ">
	<h5 id="errortext"></h5>
	</div>
	<a href="?class=1"><input name="class" type="button"  id="class1" value="一班"></a>
		
		<a href="?class=2"><input name="class" type="button"  id="class2" value="二班"></a>
		<a href="?class=3"><input name="class" type="button"  id="class3" value="三班"></a>
		<a href="?class=4"><input name="class" type="button"  id="class4" value="四班"></a>
		<a href="?class=5"><input name="class" type="button"  id="class5" value="五班"></a>
  <form name="form1" method="post" action="">
    <table width="90%" border="0" cellspacing="0" cellpadding="0" class="table">
    <thead>
      <tr>
        <td>ID</td>
        <td>姓名</td>
        <td>电话</td>
        <td>留言</td>
        <td>修改</td>
        <td>删除</td>
      </tr>
      </thead>
	  <?php
	  $class=$_GET['class'];
	  
	  $i=0;
	  if($_GET['class']){
		$result = mysqli_query($db,"select * from users where admin='0' and class='$class'  order by class, convert(username using gb2312) asc;");  
	  }
	  else
	  {
	  	$result = mysqli_query($db,"select * from users where admin='0' order by class, convert(username using gb2312) asc;");  
	  }
			
			
	  		while($row = mysqli_fetch_assoc($result)){
		  		$i++;
	  ?>
      <tr>
        <td width="60" height="28" valign="middle"><input style="width:15px;" name="checkboxitem" type="checkbox" value="<?php echo $row['cid']; ?>"><?php echo $i; ?></td>
        <td width="70" ><?php echo $row['username']; ?></td>
        <td width="90" ><?php echo $row['tel']; ?>



        </td>
        <td><?php 
        $uid=$row['tel'];
			$vote = $db->query("select uid from voted where uid='$uid';");
			if($vote->num_rows > 0){	

			}
			else echo "【无投票数据】";




        echo $row['book']; ?></td>
        <td width="*"><input style="width:40px; height:22px;" value="修改" type="button" onClick="location.href='?do=change&id=<?php echo $row['cid']; ?>'"></td>
        <td width="34"><input style="width:40px; height:22px;" value="删除" type="button" onClick="location.href='?do=delete&id=<?php echo $row['cid']; ?>'"></td>
      </tr>
	  <?php }?>
	  <tr>
        <td colspan="4"><input value="选择全部" type="button" onClick="selectall()" />
						<input value="取消全选" type="button" onClick="unselectall()" />
						<input value="删除所选" type="button" onClick="deleteselect()" /></td>
	  </tr>
    </table>
  </form>
  
 <?php
	if($_GET['do'] == "change"){
		$id = $_GET['id'];
		$result = mysqli_query($db,"select * from users where cid='$id';");
	  	$row = mysqli_fetch_assoc($result)
 ?>
  	<br/>
	<div class="div_from_aoto" style="width: 800px;">
	<form action="" method="post">
	  <input name="id" type="hidden" value="<?php echo $id; ?>">
	  <label>
	  <input name="" type="text" readonly="true" value="<?php echo $row['username']; ?>">
	  </label>
	  <label>
	  <input type="password" name="passwd" placeholder="输入新密码">
	  </label>
	  <label>
	  <input type="submit" name="Submit" value="修改">
	  </label>
	</form>
	</div>
  
 <?php } ?>
</div>
</body>
</html>