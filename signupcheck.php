<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>新規登録</title>
</head>
<body>
	<?php

	$inputUsername = $_POST['inputUsername'];
	$inputPassword = $_POST['inputPassword'];
	$inputPassword2 = $_POST['inputPassword2'];

	$inputUsername = htmlspecialchars($inputUsername);
	$inputPassword = htmlspecialchars($inputPassword);
	$inputPassword2 = htmlspecialchars($inputPassword2);

	// ユーザー名
	if($inputUsername==''){
		print 'ユーザー名が入力されていません。</br>';
	} else {
		print 'ユーザー名:';
		print $inputUsername;
		print '</br>';

	}
	if($inputPassword!=$inputPassword2){
		print 'パスワードが一致しません。</br>';
	}

	if($inputUsername==''||$inputPassword=''||$inputPassword!=$inputPassword2){
		print '<form>';
		print '<input type="button" onclick="history.back()" value="戻る">';
		print '</form>';
		
	}else{
		$inputPassword=md5($inputPassword);
		print '<form method="post" action="signupdone.php">';
		print '<input type="hidden" name="inputUsername" value="'.$inputUsername.'">';
		print '<input type="hidden" name="inputPassword" value="'.$inputPassword.'">';
		print '</br>';
		print '<input type="button" onclick="history.back()" value="戻る">';
		print '<input type="submit" value="登録">';
		print '</form>';
	}
	?>
</body>
</html>