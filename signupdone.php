<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ユーザー登録完了</title>
</head>
<body>
	<?php
	// try{
		$inputUsername = $_POST['inputUsername'];
		$inputPassword = $_POST['inputPassword'];

		$inputUsername = htmlspecialchars($inputUsername);
		$inputPassword = htmlspecialchars($inputPassword);

		// DB接続
		$dsn = 'mysql:dbname=kakeibo;host=localhost';
		$user = 'root';
		$password = 'root';
		$dbh = new PDO($dsn, $user, $password);
		$dbh->query('SET NAMES uft8');

		$sql = 'INSERT INTO mst_user (user_name,password) VALUES (?,?)';
		$stmt = $dbh->prepare($sql);

		//$data[]="4";
		$data[]=$inputUsername;
		$data[]=$inputPassword;
		$stmt->execute($data);

		$dbh = null;

		print $inputUsername;
		print 'さんを追加しました。</br>';	

	// }catch(Exception e){
	// 	print 'ただいま障害により大変ご迷惑をおかけしております。';
	// 	execute();
	// }
	?>

	<input type="button" onclick="history.back()" value="戻る">
</body>
</html>