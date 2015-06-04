<?php
	include ('conn.php');
	@session_start();

	$result = $db->query("select * from sysconfig");
	$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row['vote_name']; ?></title>

<script type="text/javascript" src="admin/js/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="admin/css/add.css" type="text/css" media="screen" />
<link rel="stylesheet" href="admin/utilLib/bootstrap.min.css" type="text/css"media="screen" />
<style type="text/css">
<!--
body {
	background:#014E8F;
	margin:0 0 0 0;
	font-family: "Microsoft Yahei", "宋体", "Tahoma", "Arial";

	color: #014E8F;

}
-->
</style>
</head>
<body>
<div class="main">
		<div>
			<h1><?php echo $row['vote_name']; ?></h1>
			<div class="description">
				<?php echo $row['description']; ?>
			</div>
		</div>
	<div class="div_from_aoto" >
	<?php
	$num = 0;
	$result_name = $db->query ( "select * from votename" );
	while ( $row_name = mysqli_fetch_assoc ( $result_name ) ) {
		$num += 1;
		?>
        <DIV class="control-group" style=" height: auto;">
			<label class="laber_from" style="line-height: inherit; margin-bottom: 0;width:auto;"><?php echo $num.".".$row_name['question_name']; ?></label>
			<br />
			<?php
$result_t = $db->query ( "select * from voted where nid='" . $row_name ['cid'] . "';" );
//$sql="SELECT COUNT(*) AS count FROM TABLE WHERE id='$id'"; 
//$result_t=mysql_fetch_array($result_t); 
//echo $total=$result_t['count']; 
$total=$result_t->num_rows;



			
		$result_option = $db->query ( "select * from voteoption where upid='" . $row_name ['cid'] . "';" );
		$sumnum = $total;
		while ( $row_option = mysqli_fetch_assoc ( $result_option ) ) {
			$result_to = $db->query ( "select * from voted where nid='" . $row_name ['cid'] . "' and oid='" . $row_option ['cid'] . "';" );
 $totalo=$result_to->num_rows; 
 $result_others = $db->query ( "select * from voted where nid='" . $row_name ['cid'] . "' and oid=0;" );
 $result_other=$result_others->num_rows;
			?>
				<DIV class="controls"
				style=" float: left; width: 580px; margin: 2px 0 0 2em; clear: both;">
					<div style="width: 280px; float:left;"><?php echo $row_option['optionname']; ?></div>
					<div style="float:left;">
						<div style="float:left; text-align:right; width:40px;"><?php echo $totalo ?>票</div>&nbsp;
						<img src="images/100.jpg" height="5" width="<?php echo $totalo/$sumnum*100 ?>"/>
						<?php echo round($totalo/$sumnum*100); ?>%
					</div>
				</DIV>
				
			<?php } ?>
			<div style="clear: both;"></div>
		<?php 
					if($result_other > 0){
		?>
				<DIV class="controls"
				style=" float: left; width: 580px; margin: 2px 0 0 2em; clear: both;">
					<div style="width: 280px; float:left;"><?php echo "其他:"; ?>
<?php 
while ( $row_other = mysqli_fetch_assoc ( $result_others ) ) {
	echo "<span>".$row_other['more']."</span>";
}
?>

					</div>
					<div style="float:left;">
						<div style="float:left; text-align:right; width:40px;"><?php echo $result_other ?>票</div>&nbsp;
						<img src="images/100.jpg" height="5" width="<?php echo $result_other/$sumnum*100 ?>"/>
						<?php echo round($result_other/$sumnum*100); ?>%
					</div>
				</DIV>
				
			<div style="clear: both;"></div>

		<?php } ?>
		</DIV>




		
	<?php } ?>
  
</div>	
</div>

</body>
</html>