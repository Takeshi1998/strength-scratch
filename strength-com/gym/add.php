<?php
$name=$_POST['name'];
$pass=$_POST['pass'];
session_start();


if(empty($name)||empty($pass)||empty($_POST['sex'])){
   
$_SESSION['error_all']="全ての情報を入力してください";
  header('Location: ./login.php');
  exit();
}
$sex=$_POST['sex'];
//DB内に同じ名前のユーザーの有無を確認 
require('./db.php');
$table="gym";
$column="name";
$id=$name;
// ページングの関数を利用するために便宜上定義
$percomment=1;
$pdosql=new database();
$counts=$pdosql->pagecountwhere($table,$column,$id,$percomment);
// 

if($counts>0){

  $_SESSION['error_name']="その名前のユーザーはすでに存在しています";
  header('Location: ./index.php');
  exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録情報確認</title>
</head>
<body>
  <h1>登録情報確認</h1>
  <table>
  <tr>
    <th>ユーザー名</th>
    <th>パスワード</th>
    <th>性別</th>
  </tr>

  <tr>
    <td><?=$name;?></td>
    <td><?=$pass;?></td>
    <td><?=$sex;?></td>
  </tr>
  </table>
  <form action="add.con.php" method="post">
<input type="hidden" name="name" value="<?= $name;?>">
<input type="hidden" name="pass" value="<?= $pass;?>">
<input type="hidden" name="sex" value="<?=$sex?>">
<br>
<input type="submit" value="登録完了">
  </form>
</body>
</html>