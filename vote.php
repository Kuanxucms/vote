<?php 
	include("sqlsafe.php");
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	include("conn.php");
	
	@session_start();
	$ss = $_POST;
	//echo $_POST['16'];
	//print_r($_POST['16']);
	//print_r($ss);
/*		
	if($_POST[num] != (count($ss)-2)){
		echo "<script>alert('请完善你的选择');</script>";
		echo "<script>history.go(-1);</script>";	
		exit();
	}
*/
	if($_POST['tel'] == '' || $_POST['username']==''){
		echo "<script>alert('姓名和联系电话为必填项目');</script>";
		echo "<script>history.go(-1);</script>";	
		exit();	
	}
	if($_POST['code_num'] != $_SESSION['VCODE'] || $_POST['code_num']==''){
		echo "<script>alert('请填写验证码');</script>";
		echo "<script>history.go(-1);</script>";	
		exit();	
	}





	
	//插入用户数据
	$class=$_POST['class'];
	$tel=$_POST['tel'];
	$username=$_POST['username'];
	$pic=$_POST['pic'];
	$QQ=$_POST['QQ'];
	$email=$_POST['email'];
	$province=$_POST['province'];
	$city=$_POST['city'];
	$com=$_POST['com'];
	$domain=$_POST['domain'];
	$jianjie=$_POST['jianjie'];
	$book=$_POST['book'];
	$_SESSION['username'] = $username;
	$_SESSION['tel'] = $tel;
	if( is_array( $_POST['zhiwu']) )
	{ 
		$arrzhiwu=$_POST['zhiwu'];
		for($i = 0;$i < count($arrzhiwu);$i++)
		{
		$zhiwu=$zhiwu.$arrzhiwu[$i]."|";
		}	
	}
		$contact = $db->query("select tel from users where tel='$tel';");
		if($contact->num_rows > 0){			
			$db->query("update users set pic='$pic',QQ='$QQ',email='$email',province='$province',city='$city',com='$com',domain='$domain',zhiwu='$zhiwu',jianjie='$jianjie' where  tel='$tel';");
			echo "<meta http-equiv=\"Refresh\" content=\"0;url=card.php\">";
		}
		else
		{
			$db->query("insert into users (admin,isvote,class,pic,username,passwd,QQ,tel,email,province,city,com,domain,zhiwu,jianjie,book) values ('0','0','$class','$pic', '$username','$tel','$QQ','$tel','$email','$province','$city', '$com','$domain','$zhiwu','$jianjie','$book')");

		}
	//插入用户数据结束
	//投票函数开始
	function voteing($tel,$db)
	{
	
	$num = 0;
	$result_name = $db->query ( "select * from votename" );
	while ( $row_name = mysqli_fetch_assoc ( $result_name ) ) 
	{
		$num += 1;
		$votecid=$row_name ['cid'];
		if($_POST[$row_name ['cid']]!==null|$_POST[$row_name ['cid']]!="")
		{
			$op=$_POST[$row_name ['cid']];
			 $more=$_POST['more'.$row_name ['cid']];
			if( is_array( $_POST[$row_name ['cid']] ) )
			{ 
				$op=$_POST[$row_name ['cid']];
				for($i = 0;$i < count($op);$i++)
				{
					$db->query("insert into voted (uid,nid, oid) values ('$tel','$votecid', '$op[$i]')");
					}
				if($more!="")
				{//echo $more;
					$db->query("insert into voted (uid,nid,oid,more) values ('$tel','$votecid', '0','$more')");  
				}
			}
			else
			  if($more!="")
			  {//echo $more;
				$db->query("insert into voted (uid,nid, oid,more) values ('$tel','$votecid', '0','$more')");  
			  }
				else $db->query("insert into voted (uid,nid, oid) values ('$tel','$votecid', '$op')");
		}
		} 
	
	}	
	//投票函数结束
	
	$result = $db->query("select * from sysconfig");
	$row = mysqli_fetch_assoc($result);
	
	$now = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
	$dietimelist = explode("-",$row['dietime']);
	$dietime = mktime(0, 0, 0, $dietimelist[1]  , $dietimelist[2], $dietimelist[0]);
	if(round(($dietime-$now)/3600/24) < 0){
		echo "<script>alert('已经过了投票日期');</script>";
		echo "<meta http-equiv=\"Refresh\" content=\"0;url=index.php\">";
		exit();
	}
	
	if($row['method'] == 1){//ip统计投票
		$voteuid = $db->query("select uid from voted where uid='$tel';");//
		if($voteuid->num_rows > 0)
		{
			echo "<script>alert('投票不成功，请填写您的个人电话号码！');</script>";
			echo "<script>history.go(-1);</script>";		
			exit();
		}
		else
		{
			$clientip = getenv("REMOTE_ADDR");
			$ips = $db->query("select ip from voteips where ip='$clientip';");
			if($ips->num_rows > 0){
				echo "<script>alert('投票不成功，同一个ip只能投一次票');</script>";
				echo "<script>history.go(-1);</script>";	
				exit();
			}else{
				voteing($tel,$db);
				$db->query("insert into voteips (ip) values ('$clientip');");
				echo "<script>alert('投票成功');</script>";
				echo "<meta http-equiv=\"Refresh\" content=\"0;url=Votedata.php\">";	
				exit();
			}	
		}

	}else if($row['method'] == 2){//登录投票
		if($_SESSION['user'] == true){
			$test = $db->query("select isvote from users where username='".$_SESSION['name']."';");
			$test_row = mysqli_fetch_assoc($test);
			if($test_row['isvote']==1){
				echo "<script>alert('你已经投过票了');</script>";
				echo "<meta http-equiv=\"Refresh\" content=\"0;url=Votedata.php\">";	
				exit();
			}else{
				voteing($tel,$db);
				$db->query("update users set isvote='1' where username='".$_SESSION['name']."';");
				echo "<script>alert('投票成功');</script>";
				echo "<meta http-equiv=\"Refresh\" content=\"0;url=Votedata.php\">";	
				exit();
			}
		}else{
			echo "<script>alert('请登录再投票');</script>";
			echo "<script>history.go(-1);</script>";
			exit();
		}
		
	}
	
	
	
?>