<?php
	
	$db = new mysqli('localhost','root','93321981@QQ.com','vote');
	$db->query("SET NAMES utf8");
	if(mysqli_connect_errno()){
		echo "据库连接失败";
		exit();
	}

 
?>