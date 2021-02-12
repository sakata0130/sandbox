<?php
if (isset($_SESSION['customer'])) {
?>
	<table>
		<th>商品番号</th>
		<th>商品名</th>
		<th>価格</th>
		<?php
		//MySQLデータベースに接続する
		require 'db_connect.php';
		//SQL文を作る（プレースホルダを使った式）
		$sql = "select * from favorite, product where customer_id = :customer_id and product_id = id";
		//プリペアードステートメントを作る
		$stm = $pdo->prepare($sql);
		//プリペアードステートメントに値をバインドする
		$stm->bindValue(':customer_id', $_SESSION['customer']['id'], PDO::PARAM_STR);
		//SQL文を実行する
		$stm->execute();
		//結果の取得（連想配列で受け取る）
		$result = $stm->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $row) {
			$id = $row['id'];
		?>
			<tr>
				<td><?= $id ?></td>
				<td><a href="detail.php?id=<?= $id ?>"><?= $row['name'] ?></a></td>
				<td><?= $row['price'] ?></td>
				<td><a href="favorite_delete.php?id=<?= $id ?>">削除</a></td>
			</tr>
		<?php
		}
		?>
	</table>
<?php
} else {
?>
	お気に入りを表示するには、ログインしてください。
<?php
}
?>