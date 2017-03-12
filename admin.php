<?php
	require_once './config.php';
	$datetime = date("Y-m-d H:i:s");

	if(isset($_POST["passwd"])){
		$passwd = addslashes($_POST["passwd"]);
		$passwd = md5($passwd);
		$passwd = strtoupper($passwd);

		if(strcmp($passwd, ADMINPASS) == 0){
			$link = mysqli_connect(HOST, USER, PASSWORD);
			mysqli_select_db($link, DB_NAME);
			$hashList = "SELECT id, MAC, hash, valid FROM hashlist";
			$result = $link->query($hashList);
			$result->num_rows;

		}else{
			exit('密码错误');
		}

	}else{
		exit('参数缺失');
	}
?>
<html>
<head>
<script type="text/javascript" src="./js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="./js/jquery-ui.js"></script>
<link href="./css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>
							编号
						</th>
						<th>
							MAC
						</th>
						<th>
							Hash
						</th>
						<th>
							状态
						</th>
					</tr>
				</thead>
				<tbody>

					<?php
						if($result->num_rows > 0){
							while ($row = $result->fetch_assoc()) {
								echo '<tr><td>'.$row["id"].'</td>'.'<td>'.$row["MAC"].'</td>'.'<td>'.$row["hash"].'</td>'.'<td>'.$row["valid"].'</td></tr>';
							}
						}
					?>
</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>