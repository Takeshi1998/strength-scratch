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
  <title>login</title>
</head>
<body>
  <h1>ログイン</h1>
  <form action="./login.con.php" method="post">
  <label for="name_">ユーザー名: </label>
  <input type="text" name="name" id="name_" value="<?php if(!empty($_COOKIE['name'])){
    echo $_COOKIE['name'];
  }
    ?>">
  <br>
  <label for="pass_">パスワード(半角数字のみ): </label>
  <input type="text" name="pass" id="pass_" value="<?php if(!empty($_COOKIE['pass'])){
    echo $_COOKIE['pass'];
  }
    ?>">
  <br>
<!-- cookieに保存するかどうか -->
  <?php if(empty($_COOKIE['name'])&&empty($_COOKIE['pass'])):?>
  <label for="cookie_">次回から入力を省略</label>
  <input type="checkbox" name="cookie" value="cookie" id="cookie_"><br>
<?php endif;?>
<!-- cookieを消去するかどうか -->
  <?php if(!empty($_COOKIE['name'])&&!empty($_COOKIE['pass'])):?>
  <label for="cookie_d">ログイン情報を消去</label>
  <input type="checkbox" name="cookie_delete" value="cookie_delete" id="cookie_d"><br>
<?php endif;?>

  <input type="submit" value="送信する">
  </form>

  <?php if(!empty($_COOKIE['name'])&&!empty($_COOKIE['pass'])):?>
<p>※前回のログイン時の情報を入力しています</p>
  <?php endif;?>
</body>
</html>