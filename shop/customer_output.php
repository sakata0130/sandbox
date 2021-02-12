<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>会員登録画面</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php require 'menu.php'; ?>
	<?php
		//MySQLデータベースに接続する
		require 'db_connect.php';
		//SQL文を作成する
		$sql = "INSERT INTO customer VALUES(null, :name, :address, :login, :password)";
		//プリペアードステートメントを作成
		$stm = $pdo->prepare($sql);
		$stm->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
		$stm->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
		$stm->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
		$stm->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
		//SQL文を実行
		$stm->execute();
		echo 'お客様情報を登録しました。';
	?>
</body>

</html>