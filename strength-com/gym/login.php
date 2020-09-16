<?php
session_start();
$_SESSION=array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
  <html>
    <head>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="../css/login.css">
      <title>Sign in</title>
    </head>
    
    <body>
      <div class="main">
        <p class="sign" align="center">Sign in</p>
        <form action="./login.con.php" class="form1" method="post">
        <!-- name -->
          <input class="un " type="text" align="center" value="<?php if(!empty($_COOKIE['name'])){
          echo $_COOKIE['name'];}?>" placeholder="Username" name="name">
        <!-- pass -->
          <input class="pass" type="password" align="center" value="<?php if(!empty($_COOKIE['pass'])){
    echo $_COOKIE['pass'];}?>" placeholder="Password" name="pass"><br>
    
    <!-- cookieに保存するかどうか -->
  <?php if(empty($_COOKIE['name'])&&empty($_COOKIE['pass'])):?>
  <label for="cookie_" class="cookie">次回から入力を省略</label>
  <input type="checkbox" name="cookie" value="cookie" id="cookie_"><br>
<?php endif;?>
<!-- cookieを消去するかどうか -->
  <?php if(!empty($_COOKIE['name'])&&!empty($_COOKIE['pass'])):?>
  <label for="cookie_d"class="cookie">ログイン情報を消去</label>
  <input type="checkbox" name="cookie_delete" value="cookie_delete" id="cookie_d"><br>
<?php endif;?>

  <br>
  <input type="submit" class="submit" align="center" value="Sign in"></input>
</form>

<p class="forgot" align="center"><a href="index.php">新規登録</p>
  <?php if(!empty($_COOKIE['name'])&&!empty($_COOKIE['pass'])):?>
  <p>※前回のログイン時の情報を入力しています</p>
  <?php endif;?>
  
</div>

    </body>
    
    </html>