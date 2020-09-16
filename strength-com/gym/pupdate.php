<?php
require_once('./db.php');
if(empty($_POST['id'])){
  header('Location: ./login.php');
  exit();
}

$post=$_POST['id'];
$table="comments";
$column="id";
$pdosql=new database();
$comment=$pdosql->update($table,$column,$post);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿 編集</title>
</head>
<body>
  <h1>編集画面</h1>
  <ul>
    <li>名前:<?=$comment['name']?></li>
    <li style="list-style:none;">
      <form action="./pupdate.com.php" method="post">
        <input type="hidden" name="id" value="<?=$post?>">
        <textarea name="tweet" cols="40" rows="10" ><?=$comment['tweet']?></textarea>
          <br> 
          <input type="submit" value="編集する">
      </form>
    </li>
  </ul>
</body>
</html>
