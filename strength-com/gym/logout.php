<?php

session_start();
$_SESSION=array();
session_destroy();


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログアウト</title>
</head>
<body>
  <h1>ログアウトしました</h1>
  <p><a href="./login.php">ログインページへ戻る</a></p>
</body>
</html>