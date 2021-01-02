<?php 
//try{
	$inputUsername = $_POST['inputUsername'];
	$inputPassword = $_POST['inputPassword'];
	
	$inputUsername = htmlspecialchars($inputUsername);
	$inputPassword = htmlspecialchars($inputPassword);

	$inputPassword = md5($inputPassword);

	// DB接続
	$dsn = 'mysql:dbname=kakeibo;host=localhost';
	$user = 'root';
	$password = 'root';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES uft8');

	// チェック
	$sql = 'SELECT user_name FROM mst_user WHERE user_name = ? AND password = ?';
 	$stmt = $dbh->prepare($sql);
 	$data[] = $inputUsername;
 	$data[] = $inputPassword;
 	$stmt->execute($data);

 	$dsn = null;

  	$rec = $stmt->fetch(PDO::FETCH_ASSOC);

 	if($rec == false){
 		print 'ユーザー名かパスワードが間違っています。</br>';
 		//print '<button onclick="location.href='./signup.php'" id="signupBtn">sign up</button>';

 	}else{
 		header('Location:top.php');
 	}

// } catch (Exception e) {
// 	print 'ただいま障害により大変御迷惑をおかけします。';
// 	exit();
// }

?>