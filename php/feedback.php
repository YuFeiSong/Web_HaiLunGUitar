<?php
	/*
	 根据省份及市县 返回该地经销商数据
	 * */
	
	$mysql_server_name='localhost'; //mysql数据库服务器
 
	$mysql_username='hailunguitar'; //mysql数据库用户名
 
	$mysql_password='hailunguitar'; //mysql数据库密码
 
	$mysql_database='hailunguitar'; //mysql数据库名

	$mysql_table_feedback = 'gt_form_feedback';//经销商数据表
	



// 获取用户提交数据	
	$name = $_POST["info_na"];
	$tel = $_POST["info_te"];
	$sn = $_POST["info_sn"];
	$email = $_POST["info_em"];
	$info = $_POST["info_in"];
	$other = $_POST["info_ot"];
	
	$date = time();
	
	$ip = "0";

	$str;

// 链接数据库
	$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database) or die("error connecting") ; //连接数据库
	if (mysqli_connect_errno($conn)) 
	{ 
	    echo "Mysql Connect Error：" . mysqli_connect_error(); 
	}
 	
	mysqli_query($conn,"set names utf8"); //数据库输出编码
	
	
	if($name!="" && $tel!="" && $sn!="" && $email!=""){
		$sql = "insert into $mysql_table_feedback (username,datetime,ip,name,tel,sn,email,feedInfo,feedOther) values ('$name','$date','$ip','$name','$tel','$sn','$email','$info','$other')";
		$result=mysqli_query($conn, $sql);
		$str="1";
	}else{
		$str="-1";
	}
	
// 返回数据
	echo $str;
	
	
?>