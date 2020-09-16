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
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Sign in</title>
</head>

<body>
  <div class="main">
    <p class="sign" align="center">Sign up</p>
    <form class="form1" action="./add.con.php" method="post">
      <input class="un " type="text" align="center" placeholder="Username" name="name">
      <input class="pass" type="password" align="center" placeholder="Password" name="pass">
      <br>
      <input type="submit" class="submit" align="center" value="Sign up">
      <p class="forgot" align="center">※ユーザー名とパスワードはログイン時に必要です</p>
    </form>
<?php if(!empty($error_name)):?>
<p class="forgot">※<?=$error_name;?></p>
<?php endif;?>          
    </div>
     
</body>

</html>