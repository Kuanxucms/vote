<?php 
	include("conn.php");
	
	@session_start();

	header("Cache-control:private");
	if( $_GET['do'] ){
		if($_GET['do']=="logout"){
			unset($_SESSION['user']);
			unset($_SESSION['name']);
			unset($_SESSION['username']);
			unset($_SESSION['tel']);
			@session_destroy();
		}
	}
	$result = $db->query("select * from sysconfig");
	$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php echo $row['vote_name']; ?></title>

<script type="text/javascript" src="admin/js/jquery.min.js"></script>
<link rel="stylesheet" href="main.css" type="text/css" media="screen" />
<link rel="stylesheet" href="main.css" type="text/css" media="screen" />
  <script type="text/javascript">
   function uploadevent(status,picUrl,callbackdata){
  //alert(picUrl); //后端存储图片
	//alert(callbackdata); //后端返回数据
        status += '';
     switch(status){
     case '1':
		var time = new Date().getTime();
		var filename180 = picUrl+'_180.jpg';

		document.getElementById('pic').innerHTML = "<input type='text'  name='pic' value='"+filename180+"'>" ;
		document.getElementById('avatar_priview').innerHTML = "头像1 : <img src='"+filename180+"?" + time + "'/>" ;
		
		
	break;
     case '-1':
	  window.location.reload();
     break;
     default:
     window.location.reload();
    } 
   }
  </script>
  <SCRIPT>    
  function isHidden(oDiv){      
  var vDiv = document.getElementById(oDiv);      
  vDiv.style.display = (vDiv.style.display == 'none')?'block':'none';    
  } 
    function isbc(bc){      
  var vbc = document.getElementById(bc);      
  vbc.style.display = (vbc.style.display == 'none')?'block':'none';    
  }   
  </SCRIPT>
  
</head>
<body>
<div class="main">
	<div style="width:auto; height:54px; background:url(images/logo.png) no-repeat; border-bottom:solid #F0F0F0 0px; text-align:right;">
		<div style=" padding:0.25em  0.5em 0.25em  0;">
		<?php if( !isset($_SESSION['user']) || $_SESSION['user']!==true ){ ?>
			<a href="admin/login.html">登录投票</a>
		<?php }else{ ?>
			<span>你好,<?php echo $_SESSION['name']; ?></span>
			<a href="admin/index.php">&nbsp;查看投票数据</a>
			<a href="index.php?do=logout">&nbsp;登出</a>
		<?php } ?>
		</div>
	</div>
	<form action="vote.php" method="post">
	<div class="content">
		<div>
			<h1><?php echo $row['vote_name']; ?></h1>
			<div class="description">
				<?php echo $row['description']; ?>
			</div>
		</div>
		<div class="mcontent">
		<input name="class" type="radio" id="class1" value="1"><label for="class1">一班</label>
		<input name="class" type="radio" id="class2" value="2"><label for="class2">二班</label>
		<input name="class" type="radio" id="class3" value="3"><label for="class3">三班</label>
		<input name="class" type="radio" id="class4" value="4"><label for="class4">四班</label>
		<input name="class" type="radio" id="class5" value="5"><label for="class5">五班</label>
		<div style="clear:both;"></div>
		&nbsp;&nbsp;姓&nbsp;&nbsp;  名&nbsp;&nbsp;:<input type="text"  name="username" placeholder="姓名:">
		<div style="clear:both;"></div>
		联系电话:<input type="text"  name="tel" placeholder="必填项">
		<div style="clear:both;"></div>
			<h3 style="cursor:hand" onclick="isbc('bc')">更多个人信息增进了解合作（选填）</h3>
<div id="bc" style="display:none">
		<div style="clear:both;"></div>
<DIV style="cursor:hand" onclick="isHidden('div1')">上传头像:<span id="pic"><input type="text"  name="pic" ></span><div id="avatar_priview"></div></DIV>  
<DIV id="div1" style="display:none">
  <div id="altContent">
<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"
WIDTH="650" HEIGHT="450" id="myMovieName">
<PARAM NAME=movie VALUE="avatar.swf">
<PARAM NAME=quality VALUE=high>
<PARAM NAME=bgcolor VALUE=#FFFFFF>
<param name="flashvars" value="imgUrl=./default.jpg&uploadUrl=./upfile.php&uploadSrc=false" />
<EMBED src="avatar.swf" quality=high bgcolor=#FFFFFF WIDTH="650" HEIGHT="450" wmode="transparent" flashVars="imgUrl=./default.jpg&uploadUrl=./upfile.php&uploadSrc=false"
NAME="myMovieName" ALIGN="" TYPE="application/x-shockwave-flash" allowScriptAccess="always"
PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
</EMBED>
</OBJECT>
  </div>


</DIV>
		


		
		
		<div style="clear:both;"></div>
		常用ＱＱ:<input type="text"  name="QQ" >
		<div style="clear:both;"></div>
		电子邮箱:<input type="text"  name="email" >
		<div style="clear:both;"></div>
现居城市:<select id="province" name="province" onChange="InitCity(this.options[this.options.selectedIndex].text)"></select>
<select id="city" name="city"></select>
<script language="javascript">
<!--
function Hashtable() {
    this._hash = new Object();
    //add()
    this.add = function(key,value){
        if(typeof(key)!="undefined"){
            if(this.contains(key)==false){
                this._hash[key]=typeof(value)=="undefined"?null:value;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //remove()
    this.remove = function(key){delete this._hash[key];}
    //count
    this.count = function(){var i=0;for(var k in this._hash){i++;} return i;}
    //items
    this.items = function(key){return this._hash[key];}
    //contains
    this.contains = function(key){ return typeof(this._hash[key])!="undefined";}
    //clear
    this.clear = function(){for(var k in this._hash){delete this._hash[k];}}
}

var provinceString = "--请选择--|,河南|21,安徽|10,北京|11,重庆|12,福建|13,甘肃|14,广东|15,广西自治区|16," +
                    "贵州|17,海南|18,河北|19,黑龙江|20,湖北|22,湖南|23,江西|24,江苏|25,吉林|26," +
                    "辽宁|27,内蒙古自治区|28,宁夏自治区|29,青海|30,山东|31,上海|32,山西|33,陕西|34," +
                    "四川|35,天津|36,新疆自治区|37,西藏自治区|38,云南|39,浙江|40,澳门特别行政区|41," +
                    "香港特别行政区|42,台湾|43";
var provinceArray = provinceString.split(',');

var cityHT = new Hashtable();
cityHT.add("--请选择--","");
cityHT.add("河南","郑州,开封,洛阳,平顶山,安阳,鹤壁,新乡,焦作,濮阳,许昌,漯河,三门峡,南阳,商丘,信阳,周口,驻马店,济源");
cityHT.add("安徽","合肥,芜湖,蚌埠,马鞍山,淮北,铜陵,安庆,黄山,滁州,宿州,池州,淮南,巢湖,阜阳,六安,宣城,亳州");
cityHT.add("北京","北京");
cityHT.add("重庆","重庆");
cityHT.add("福建","福州,厦门,莆田,三明,泉州,漳州,南平,龙岩,宁德");
cityHT.add("甘肃","兰州,嘉峪关,金昌,白银,天水,酒泉,张掖,武威,定西,陇南,平凉,庆阳,临夏,甘南");
cityHT.add("广东","广州,深圳,珠海,汕头,东莞,中山,佛山,韶关,江门,湛江,茂名,肇庆,惠州,梅州,汕尾,河源,阳江,清远,潮州,揭阳,云浮");
cityHT.add("广西自治区","南宁,柳州,桂林,梧州,北海,防城港,钦州,贵港,玉林,南宁地区,柳州地区,贺州,百色,河池");
cityHT.add("贵州","贵阳,六盘水,遵义,安顺,铜仁,黔西南,毕节,黔东南,黔南");
cityHT.add("海南","海南");
cityHT.add("河北","石家庄,邯郸,邢台,保定,张家口,承德,廊坊,唐山,秦皇岛,沧州,衡水");
cityHT.add("黑龙江","哈尔滨,齐齐哈尔,牡丹江,佳木斯,大庆,绥化,鹤岗,鸡西,黑河,双鸭山,伊春,七台河,大兴安岭");
cityHT.add("湖北","武汉,宜昌,荆州,襄樊,黄石,荆门,黄冈,十堰,恩施,潜江,天门,仙桃,随州,咸宁,孝感,鄂州");
cityHT.add("湖南","长沙,常德,株洲,湘潭,衡阳,岳阳,邵阳,益阳,娄底,怀化,郴州,永州,湘西,张家界");
cityHT.add("江西","南昌市,景德镇,九江,鹰潭,萍乡,新馀,赣州,吉安,宜春,抚州,上饶");
cityHT.add("江苏","南京,镇江,苏州,南通,扬州,盐城,徐州,连云港,常州,无锡,宿迁,泰州,淮安");
cityHT.add("吉林","长春,吉林,四平,辽源,通化,白山,松原,白城,延边");
cityHT.add("辽宁","沈阳,大连,鞍山,抚顺,本溪,丹东,锦州,营口,阜新,辽阳,盘锦,铁岭,朝阳,葫芦岛");
cityHT.add("内蒙古自治区","呼和浩特,包头,乌海,赤峰,呼伦贝尔盟,阿拉善盟,哲里木盟,兴安盟,乌兰察布盟,锡林郭勒盟,巴彦淖尔盟,伊克昭盟");
cityHT.add("宁夏自治区","银川,石嘴山,吴忠,固原");
cityHT.add("青海","西宁,海东,海南,海北,黄南,玉树,果洛,海西");
cityHT.add("山东","济南,青岛,淄博,枣庄,东营,烟台,潍坊,济宁,泰安,威海,日照,莱芜,临沂,德州,聊城,滨州,菏泽");
cityHT.add("上海","上海");
cityHT.add("山西","太原,大同,阳泉,长治,晋城,朔州,吕梁,忻州,晋中,临汾,运城");
cityHT.add("陕西","西安,宝鸡,咸阳,铜川,渭南,延安,榆林,汉中,安康,商洛");
cityHT.add("四川","成都,绵阳,德阳,自贡,攀枝花,广元,内江,乐山,南充,宜宾,广安,达川,雅安,眉山,甘孜,凉山,泸州");
cityHT.add("天津","天津");
cityHT.add("新疆自治区","乌鲁木齐,石河子,克拉玛依,伊犁,巴音郭勒,昌吉,克孜勒苏柯尔,克孜,博尔塔拉,吐鲁番,哈密,喀什,和田,阿克苏");
cityHT.add("西藏自治区","拉萨,日喀则,山南,林芝,昌都,阿里,那曲");
cityHT.add("云南","昆明,大理,曲靖,玉溪,昭通,楚雄,红河,文山,思茅,西双版纳,保山,德宏,丽江,怒江,迪庆,临沧");
cityHT.add("浙江","杭州,宁波,温州,嘉兴,湖州,绍兴,金华,衢州,舟山,台州,丽水");
cityHT.add("澳门特别行政区","澳门");
cityHT.add("香港特别行政区","香港");
cityHT.add("台湾","台湾");

function GetNameFromString(str)
{
    return str.split('|')[0];
}

function GetIDFromString(str)
{
    return str.split('|')[1];
}

function InitProvince()
{
    document.getElementById("province").options.length = 0;
    for (var i=0; i<provinceArray.length; ++i)
    {
        provStr = provinceArray[i];
        document.getElementById("province").options[i] = new Option(GetNameFromString(provStr), GetNameFromString(provStr));
    }
}

function InitCity(provinceName)
{
    var cityArray = cityHT.items(provinceName).split(',');
    document.getElementById("city").options.length = 0;
    for (var i=0; i<cityArray.length; ++i)
    {
        cityStr = cityArray[i];
        document.getElementById("city").options[i] = new Option(cityStr, cityStr);
    }
}

InitProvince();
InitCity("--请选择--");
//-->
</script>
		
		<div style="clear:both;"></div>
		工作单位:<input type="text"  name="com" >
		<div style="clear:both;"></div>
		行业领域:<input type="text"  name="domain" >
		<div style="clear:both;"></div>
		工作领域:<input type="checkbox" name="zhiwu[]" value="技术"id="zhiwu1"><label for="zhiwu1">技术</label>
		<input type="checkbox" name="zhiwu[]" value="销售"id="zhiwu2"><label for="zhiwu2">销售</label>
		<input type="checkbox" name="zhiwu[]" value="管理"id="zhiwu3"><label for="zhiwu3">管理</label>
		<input type="checkbox" name="zhiwu[]" value="其他"id="zhiwu4"><label for="zhiwu4">其他</label>

		<div style="clear:both;"></div>
		简单介绍:<textarea name="jianjie" rows="10" cols="" class="label" placeholder="简单介绍"></textarea>
		<div style="clear:both;"></div>
</div>
		</div>

			
		<?php
			$num = 0;
			$result_name = $db->query ( "select * from votename" );
			while ( $row_name = mysqli_fetch_assoc ( $result_name ) ) {
			$num += 1;
		?>
		<div class="mcontent">
			<h3><?php echo $num.".".$row_name['question_name']; if($row_name['votetype']=="1") echo "(可多选)";?></h3>
			<?php
				$result_option = $db->query ( "select * from voteoption where upid='" . $row_name ['cid'] . "';" );
				while ( $row_option = mysqli_fetch_assoc ( $result_option ) ) {
			?>
			<div class="obox">
				<?php 
					if($row_name['votetype']=="0"){
						echo '<input name="'.$row_name['cid'].'" type="radio"  id="'.$row_option['cid'].'"value="'.$row_option['cid'].'"><label for="'.$row_option['cid'].'">'.$row_option['optionname'].'</label>';
					}else if($row_name['votetype']=="1"){
						echo '<input name="'.$row_name['cid'].'[]" type="checkbox"  id="'.$row_option['cid'].'"value="'.$row_option['cid'].'"><label for="'.$row_option['cid'].'">'.$row_option['optionname'].'</label>';
					}
				?>
				
			</div>
			<?php } ?>
			<div class="obox">
				<?php
				if($row_name['ismore']=="1")
				{
					if($row_name['votetype']=="0"){
						echo '<input name="'.$row_name['cid'].'" type="radio" id="'.$row_name['cid'].'more" value="0"><label for="'.$row_name['cid'].'more" class="label">其他<input type="text"  name="more'.$row_name['cid'].'" ></label>';
					}else if($row_name['votetype']=="1"){
						echo '<input name="'.$row_name['cid'].'[]" type="checkbox" id="'.$row_name['cid'].'more" value="0"><label for="'.$row_name['cid'].'more">其他<input type="text" name="more'.$row_name['cid'].'"></label>';
					}
					
				}

				 

				?>
				
			</div>
			
			<div style="clear:both;"></div>
		</div>
		<?php } ?>
		<?php if($result_name->num_rows > 0){
		?>
		<div class="mcontent">
			<h3>我要补充留言</h3>
		<textarea name="book" rows="10" cols="" class="label"placeholder="我要补充:"></textarea>
		<div style="clear:both;"></div>
		</div>
		

		
		<div class="votebu">
			<input style="width:10em; height:3em; float:left;" type="text" name="code_num" placeholder="在此填写验证码"maxlength="4" />
		 	<img style="float:left;" onClick="this.src='img.php'" src="img.php"  alt="看不清，点击换一张">
		 	<div style="clear:both;"></div><br>
			<input style="float:left; width:10em; height:3em; margin-left:1em;"class="btn btn-success" name="" type="submit" value="提交">
			<input name="num" type="hidden" value="<?php echo $num; ?>">
			<div style="clear:both;"></div>
		</div>
		<?php }else{ ?>
			<h1>当前没有投票</h1>
		<?php } ?>
		<br>
	</div>
  </form>


	<div style="width:auto; height:auto; border-bottom:solid #F0F0F0 0px; text-align:right;">
		<div style=" padding:0.25em  0.5em 0.25em  0;">
		
		策划 牟洪强 制作 肖勇
		</div>
	</div>	
</div>

</body>
</html>