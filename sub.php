<?php
	require_once './config.php';
	$datetime = date("Y-m-d H:i:s");

	if(isset($data)){
		$data = explode($data, ',');
		$hash = $data[0];
		$temp = $data[1];
		$loca = $data[2];
		$code = $data[3];

		/*hash效验*/
		$hash_sql = "SELECT * FROM hashlist WHERE hash = '$hash'";
		$result = $link->query($hash_sql);
		$row = $result->fetch_assoc();

		if(isset($row['valid'])){
			if(!$row['valid'] == 1) exit('hash无效');
		}else {
			exit('hash不存在');
		}
		
		//$mac = $row['MAC'];

		$sql = "INSERT INTO what (time, temp, code) VALUES ('$datetime', '$temp', '$code')";
		//数据表后期应选择为location

		if(mysqli_query($link, $sql)) {

			$sql = "SELECT * FROM what WHERE id=0";
			$result = $link->query($sql);
			$row = $result->fetch_assoc();
			//code大于100时为模式代码，小于等于无效
			if($row['code'] >100) $send = '0';
			else $send = $row['temp'];

			$connection->send($send);//后期应输出用户设置温度或模式
		}else exit(('mysql error'));

	}else {
		 exit ('65535');
	}
?>