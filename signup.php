<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href='css/style.css'>
	<title>kakeibo login</title>
</head>
<body>
	<div class="contentwrap">
	<div class="inputWindow">
	<form method="post" action="signupcheck.php">
		<p>KAKEIBO ユーザー登録</p>
		<input type="text" placeholder="username" name="inputUsername">
		<input type="password" placeholder="password" name="inputPassword">
		<p>もう一度パスワードを入力して下さい。</p>
		<input type="password" placeholder="password" name="inputPassword2">
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="登録">
	</form>
	</div>
	</div>
</body>
</html>