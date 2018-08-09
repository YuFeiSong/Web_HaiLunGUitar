<?php
	/*
	 根据省份及市县 返回该地经销商数据
	 * */
	
	$mysql_server_name='localhost'; //mysql数据库服务器
 
	$mysql_username='hailunguitar'; //mysql数据库用户名
 
	$mysql_password='hailunguitar'; //mysql数据库密码
 
	$mysql_database='hailunguitar'; //mysql数据库名

	$mysql_table_seller = 'gt_seller';//经销商数据表
	
	$mysql_table_seller_detail = 'gt_seller_data';//经销商详细数据表



// 获取用户提交数据	
	$provinceID = $_POST['province'];

// 链接数据库
	$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database) or die("error connecting") ; //连接数据库
	if (mysqli_connect_errno($conn)) 
	{ 
	    echo "Mysql Connect Error：" . mysqli_connect_error(); 
	}
 	
	mysqli_query($conn,"set names utf8"); //数据库输出编码
	
	
// 读取数据库
	//
	//
	/* *
	 * 在主表中读取 琴行名称和id
	 * 再根据主表读到的id 在详情表中读取琴行详细信息
	 * */
	$sql = "select * from $mysql_table_seller where sheng='$provinceID' order by listorder desc";
	
	$result = mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);
	
	$dataArr = array();
	
	while($row = mysqli_fetch_assoc($result)) {
	
		$id = $row['id'];
		
		$sql_d = "select * from $mysql_table_seller_detail where id='$id'";
		$result_d = mysqli_query($conn,$sql_d);
		$row_d = mysqli_fetch_assoc($result_d);
		
		$tel = $row_d['tel'];
		$addr = $row_d['address'];
		
		$itemArr = array();
		$itemArr = [
			'id'=>$row['id'],
			'title'=>$row['title'],
			'tel'=>$tel,
			'addr'=>$addr
		];
		
		$dataArr[] = $itemArr;
	}
	
	$str = json_encode($dataArr);
	
// 返回数据
	echo $str;
	
?>