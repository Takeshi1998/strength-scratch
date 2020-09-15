<?php
session_start();
if(!empty($_SESSION['error_name'])){
$error_name="その名前のユーザーはすでに存在しています";
}

if(!empty($_SESSION['error_all'])){
$error_name=$_SESSION['error_all'];
}

$_SESSION=array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録</title>
</head>
<body>
  <h1>ユーザー情報</h1>
  <form action="./add.php" method="post">
  <label for="_name">ユーザー名</label>
  <input type="text" name="name" id="_name">
  <br>
  <label for=""></label>
  <label for="pass_">パスワード(半角数字)</label>
  <input type="number" name="pass" id="pass_">
  <br>
  <label for="sex_">性別</label>
  <input type="radio" name="sex" id="sex_" value="男">男
  <input type="radio" name="sex" id="sex_" value="女">女
  <br>
  <input type="submit" value="登録">
  </form>
<?php if(!empty($error_name)):?>
  <p>※<?=$error_name;?></p>
<?php endif;?>
<span>※名前とパスワードはログイン時に必要です</span>
</body>
</html>