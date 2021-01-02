<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href='css/style.css'>
	<title>kakeibo register</title>
</head>
<body>
	<?php
		// 現在日付
		$today = date("Y/m/d");	

		// ユーザー名
		$userArray=["Saya","Rin"];
	// try{
		// localのmysqlに接続
		// $dsn = 'mysql:dbname=kakeibo;host=localhost';
		// $user = 'root';
		// $password = 'root';
		// $dbh = new PDO($dsn, $user, $password);
		// $dbh->query('SET NAMES uft8');

	 //  	$sql = 'INSERT INTO trn_kakeibo_spent_info (kakeibo_no, date, seq_no, ctgry_id, spent, user_no, comment) VALUES (?,?,?,?,?,?)';
	 // 	$stmt = $dbh->prepare($sql);
	 // 	$data[]="1";
	 // 	$data[]="2020/12/07";
	 // 	$data[]="FD";
	 // 	$data[]="1000";
	 // 	$data[]="1";
	 // 	$data[]="Comment";
	 // 	$stmt->execute($data);

	// } (Exception $e){
	//  	print'只今障害により大変ご迷惑をおかけしております。<br/>システム担当者へご連絡下さい。<br/>';
	//  	echo "ErrorMes : " . $e->getMessage() . "<br/>";
	//     echo "ErrorCode : " . $e->getCode() . "<br/>";
	//     echo "ErrorFile : " . $e->getFile() . "<br/>";
	//     echo "ErrorLine : " . $e->getLine() . "<br/>";
	//  	exit();
 // 	}

	?>
	<div class="contentwrap">
	<div class="inputWindow">
	<form method="post">
	<p>入力</p>
	<p><input type="text" name="inputDate" value="<?php print $today; ?>"></p>
	<select name="inputUser">
		<?php for($i=0;$i<count($userArray);$i++){
			print "<option value=$i>$userArray[$i]</option>";
		}?>
	</select>
	<select name="inputCategory">
		<option value="FD">食費</option>
		<option value="OT">その他</option>
		<option value="EL">電気</option>
		<option value="GS">ガス</option>
	</select>
	<p><input type="text" name="inputAmount" placeholder="金額"></p>
	<p><input type="text" name="inputComment" placeholder="コメント"></p>
	<input type="submit" id="inputBtn" value="+入力する">
	</form>
	<button onclick="location.href='./top.php'">戻る</button>
	</div>
	</div>

	<?php 
		$dsn = 'mysql:dbname=kakeibo;host=localhost';
		$user = 'root';
		$password = 'root';
		$dbh = new PDO($dsn, $user, $password);
		$dbh->query('SET NAMES uft8');

	  	$sql = 'INSERT INTO trn_kakeibo_spent_info (kakeibo_no, date, ctgry_id, spent, user_no, comment) VALUES (?,?,?,?,?,?)';
	 	$stmt = $dbh->prepare($sql);

	 	$data[]="1";                     // 家計簿番号
	 	$data[]=$_POST['inputDate'];     // 日付
	 	$data[]=$_POST['inputCategory']; // カテゴリ
	 	$data[]=$_POST['inputAmount'];   // 金額
	 	$data[]=$_POST['inputUser']+1;     // ユーザー名
	 	$data[]=$_POST['inputComment'];  // コメント
	 	$stmt->execute($data);

	 	$dbh = null;
	?>

</body>
</html>