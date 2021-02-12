<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>商品一覧画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<?php require 'menu.php'; ?>
	<form action="product.php" method="post">
		商品検索
		<input type="text" name="keyword">
		<input type="submit" value="検索">
	</form>
	<hr>
	<table>
		<th>商品番号</th>
		<th>商品名</th>
		<th>価格</th>
		<?php
		//MySQLデータベースに接続する
		require 'db_connect.php';
		//検索の判断
		if (isset($_POST['keyword'])) {
			//SQL文を作る（プレースホルダを使った式）
			$sql = "select * from product where name like :keyword";
			//プリペアードステートメントを作る
			$stm = $pdo->prepare($sql);
			//プリペアードステートメントに値をバインドする
			$stm->bindValue(':keyword', '%' . $_POST['keyword'] . '%', PDO::PARAM_STR);
			//SQL文を実行する
			$stm->execute();
			//結果の取得（連想配列で受け取る）
			$result = $stm->fetchAll(PDO::FETCH_ASSOC);
		} else {
			//SQL文を作る
			$sql = "select * from product";
			//プリペアードステートメントを作る
			$stm = $pdo->prepare($sql);
			//SQL文を実行する
			$stm->execute();
			//結果の取得（連想配列で受け取る）
			$result = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		foreach ($result as $row) {
			$id = $row['id'];
		?>
			<tr>
				<td><?= $id ?></td>
				<td><a href="detail.php?id=<?= $id ?>"><?= $row['name'] ?></a>
				</td>
				<td><?= $row['price'] ?></td>
			</tr>
		<?php
		}
		?>
	</table>
</body>

</html>