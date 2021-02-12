<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>お気に入り画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php require 'menu.php'; ?>
	<?php
	if (isset($_SESSION['customer'])) {
		//MySQLデータベースに接続する
		require 'db_connect.php';

		//SQL文を作る（プレースホルダを使った式）
		$sql = "insert into favorite values(:customer_id,:product_id)";
		//プリペアードステートメントを作る
		$stm = $pdo->prepare($sql);
		//プリペアードステートメントに値をバインドする
		$stm->bindValue(':customer_id', $_SESSION['customer']['id'], PDO::PARAM_STR);
		$stm->bindValue(':product_id', $_REQUEST['id'], PDO::PARAM_STR);
		//SQL文を実行する
		$stm->execute();
	?>
		お気に入りに商品を追加しました。
		<hr>
	<?php require 'favorite.php';
	} else {
	?>
		お気に入りに商品を追加するには、ログインしてください。
	<?php
	}
	?>
</body>

</html>