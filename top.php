<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href='css/style.css'>
	<title>kakeibo home</title>
</head>
<body>
<?php
	// kakeibo_noを指定
	// 一時的に
	$kakeibo_no = 1;

try{

	// localのmysqlに接続
	$dsn = 'mysql:dbname=kakeibo;host=localhost';
	$user = 'root';
	$password = 'root';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES uft8');

	// 現在日付
	$today = date("Y/m/d");
 	
 	// 予算情報を取得
 	// $budget_data = getBudget($dbh);
 	$sql = 'SELECT * FROM trn_kakeibo_budget_info WHERE kakeibo_no = ?';
	$stmt = $dbh->prepare($sql);
	$data5[]=$kakeibo_no;
	$stmt->execute($data5);
	// データ取得
	$budget_data = $stmt->fetchAll();

	// 予算合計
	$budget_total = 0;
	for($i=0; $i<count($budget_data); $i++){
		$budget_total += $budget_data[$i]['budget'];
	}

 	// kakeibo支出情報を取得
 	$sql = 'SELECT * FROM trn_kakeibo_spent_info WHERE kakeibo_no = ? AND date LIKE ?';
	$stmt = $dbh->prepare($sql);
	$data[]=$kakeibo_no;
	$targetDate = substr($today, 0, 7)."%";
	$data[]=$targetDate;

	$stmt->execute($data);
	// データ取得
	$rec = $stmt->fetchAll();

	// 家計簿名を取得
 	$sql = 'SELECT kakeibo_name FROM trn_kakeibo WHERE kakeibo_no = ?';
	$stmt = $dbh->prepare($sql);
	$data2[]=$kakeibo_no;
	$stmt->execute($data2);
	// データ取得
	$kakeibo_name = $stmt->fetchAll();


	// 家計簿に紐づくユーザーを取得
 	$sql = 'SELECT * FROM trn_kakeibo_user WHERE kakeibo_no = ?';
	$stmt = $dbh->prepare($sql);
	$data3[]=$kakeibo_no;
	$stmt->execute($data3);

	// データ取得
	$kakeibo_user = $stmt->fetchAll();


	// かんたん入力
	// 家計簿に紐づくユーザーを取得
 	$sql = 'INSERT INTO trn_kakeibo_spent_info (kakeibo_no, date, seq_no, ctgry_id, spent, user_no, comment) VALUES (?,?,?,?,?,?,?)';
	$stmt = $dbh->prepare($sql);
	$data5[]="1";
	$data5[]=$_POST['inputDate'];
	$data5[]=$_POST['inputCategory'];
	$data5[]=$_POST['inputAmount'];
	$data5[]="1";
	$data5[]=$_POST['inputComment'];
	$stmt->execute($data5);

	// ユーザー名を取得　（のとほど修正）
	// for($i=0; $i<count($kakeibo_user); $i++){
	// 	$sql = 'SELECT user_name FROM mst_user WHERE user_no = ?';
	// 	$stmt = $dbh->prepare($sql);
	// 	$data4[] = $kakeibo_user[$i]['user_no'];
	// 	$stmt->execute($data4);
	// 	// データ取得
	// 	$user_name = $stmt->fetchAll();
	// 	echo $user_name[$i]['user_name'];	
	// }

	$userArray = ["undefined","Saya","Rin"];

	$categoryArray = array("FD" => "食費", "OT" => "その他", "EL" => "電気", "GS" => "ガス");

	// $sql = 'SELECT user_name FROM mst_user WHERE user_no = ?';
	// $stmt = $dbh->prepare($sql);
	// $data4[] = 2;
	// $stmt->execute($data4);
	// echo $user_name[0]['user_name'];

	$dbh = null;

}catch (Exception $e){
 	print'只今障害により大変ご迷惑をおかけしております。<br/>システム担当者へご連絡下さい。<br/>';
 	echo "ErrorMes : " . $e->getMessage() . "<br/>";
    echo "ErrorCode : " . $e->getCode() . "<br/>";
    echo "ErrorFile : " . $e->getFile() . "<br/>";
    echo "ErrorLine : " . $e->getLine() . "<br/>";
 	exit();
}

?>

<?php include("header.php"); ?>

<div class="contentwrap">
<div class="content">
<div class="kakeiboBasicInfo">
<p>家計簿名：<?php print $kakeibo_name[0]['kakeibo_name'];?></p>
<p>メンバー：
<?php 
for($i=0; $i<count($kakeibo_user); $i++){
	print $kakeibo_user[$i]['user_no']; 
}
?></p>
</div>
<div class="kakeiboHistory">
	<p>履歴</p>
	<div class="kakeiboHistoryScroll">
		<?php $previousMonth = date('Y-m-d', strtotime($today.' -1 month')); ?>
		<?php $nextMonth = date('Y-m-d', strtotime($today.' +1 month')); ?>
		<p class="link">< <?php print substr($previousMonth,5, 2) ?></p>
		<p class="link ">< <?php print substr($nextMonth,5, 2) ?></p>
	<table border="1">
		<tr>
			<th>日付</th>
			<th>カテゴリ</th>
			<th>出費額</th>
			<th>支払い者</th>
			<th>コメント</th>
		</tr>
		<?php
		// レコード毎
			for($i=0; $i<count($rec); $i++){
				$date     = $rec[$i]['date'];
				$ctgry_id = $rec[$i]['ctgry_id'];
				$spent    = $rec[$i]['spent'];
				$user_no  = $rec[$i]['user_no'];
				$commnet  = $rec[$i]['comment'];

				// ユーザー名を取得
				$user_name = $userArray[$user_no];

				// カテゴリ名を取得
				$ctgry_name = $categoryArray[$ctgry_id];

				// 合計を算出
				$spentTotal += $spent;

				// 履歴一覧を表示 
				print "<tr>";
				print "<td>$date</td>";
				print "<td>$ctgry_name</td>";
				print "<td>$spent</td>";
				print "<td>$user_name</td>";
				print "<td>$commnet</td>";
				print "</tr>";			
			}
		?>
	</table>
	</div>
</div>

<div class="kakeiboSummary">
	<p>予算：￥<?php print $budget_total; ?></p>
	<p>出費合計：￥<?php print $spentTotal?></p>
	<p>バランス：￥<?php print $budget_total - $spentTotal ?></p>
</div>

<div class="kakeiboAnalyze">
<p>支払い者別：<?php ?></p>
<p>カテゴリ別：<?php ?>
</p>
</div>

</div>

<div class="easyInput">
	<form method="post">
	<p>かんたん入力</p>
	<p><input type="text" name="inputDate" value="<?php print $today; ?>"></p>
	<p><input type="text" name="inputAmount" placeholder="金額"></p>
	<select name="inputCategory">
		<option value="FD">食費</option>
		<option value="OT">その他</option>
		<option value="EL">電気</option>
		<option value="GS">ガス</option>
	</select>
	<p><input type="text" name="inputComment" placeholder="コメント"></p>
	<input type="submit" id="easyInputButton" value="+入力する">
	</form>
</div>

</div>

<?php include("footer.php"); ?>

</body>
</html>