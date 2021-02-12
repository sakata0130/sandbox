<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>購入画面</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php require 'menu.php'; ?>
	<?php
		// ログイン有無の確認
		if (!isset($_SESSION['customer'])) {
			echo '購入手続きを行うにはログインしてください。';
		} else if (empty($_SESSION['product'])) {
			echo 'カートに商品がありません。';
		} else { // 正常処理
	?>
	<p>お名前：<?=$_SESSION['customer']['name'] ?></p>
	<p>ご住所：<?=$_SESSION['customer']['address'] ?></p>
	<hr>
	<?php require 'cart.php' ?>
	<hr>
	<p>内容をご確認いただき、購入を確定してください。</p>
	<a href="purchase_output.php">購入を確定する</a>
	<?php
		}
	?>
</body>
</html>