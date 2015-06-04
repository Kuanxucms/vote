<?php
/**********  仅测试程序 **********/

$savePath = './avatar/';  //图片存储路径
$savePicName = time();  //图片存储名称


$file_src = $savePath.$savePicName."_src.jpg";
$filename180 = $savePath.$savePicName."_180.jpg";     


$pic1=base64_decode($_POST['pic1']);   



file_put_contents($filename180,$pic1);

$rs['status'] = 1;
$rs['picUrl'] = $savePath.$savePicName;

print json_encode($rs);

?>
