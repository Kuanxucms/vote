<?php
	include ('../conn.php');
	@session_start();
	if( !isset($_SESSION['admin']) || !isset($_SESSION['user']) || ( $_SESSION['user']!== true && $_SESSION['admin']!== true ) ){
		echo "<meta http-equiv=\"Refresh\" content=\"0;url=login.html\">";
		exit();
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title></title>

<script type="text/javascript" src="js/jquery.min.js"></script>

<link rel="stylesheet" href="css/add.css" type="text/css" media="screen" />
<link rel="stylesheet" href="utilLib/bootstrap.min.css" type="text/css"
	media="screen" />

</head>
<body>
	<div class="div_from_aoto" style="width: 98%;  ">
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
 $result_others = $db->query ( "select * from voted,users where nid='" . $row_name ['cid'] . "' and oid=0 and voted.uid=users.tel;" );
 $result_other=$result_others->num_rows;
			?>
				<DIV class="controls"
				style=" float: left; min-width: 580px; margin: 2px 0 0 2em; clear: both;">
					<div style="min-width: 280px; float:left;" title="
					<?php if($_SESSION['admin'] == true){
while ( $row_tx = mysqli_fetch_assoc ( $result_to ) ) {

	$result = $db->query("select * from users where tel='" . $row_tx ['uid'] . "' ;");
	$row = mysqli_fetch_assoc($result);
echo $row ['username']."&nbsp;";

}

			
			}
			?>

			"><?php echo $row_option['optionname']; ?></div>
					<div style="float:left;">
						<div style="float:left; text-align:right; width:40px;"><?php echo $totalo ?>票</div>&nbsp;
						<img src="../images/100.jpg" height="5" width="<?php echo $totalo/$sumnum*100 ?>"/>
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
	echo "<span title='".$row_other['username']."'>".$row_other['more']."</span>";
}
?>

					</div>
					<div style="float:left;">
						<div style="float:left; text-align:right; width:40px;"><?php echo $result_other ?>票</div>&nbsp;
						<img src="../images/100.jpg" height="5" width="<?php echo $result_other/$sumnum*100 ?>"/>
						<?php echo round($result_other/$sumnum*100); ?>%
					</div>
				</DIV>
				
			<div style="clear: both;"></div>

		<?php } ?>
		</DIV>




		
	<?php } ?>
  
</div>
</body>
</html>