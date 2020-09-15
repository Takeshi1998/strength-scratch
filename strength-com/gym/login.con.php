<?php
require_once('./function.php');
require_once('./db.php');
session_start();
if(empty($_POST['name'])||empty($_POST['pass'])):
?>
<p>全ての情報を入力してください</p>
<a href="login.php">戻る</a>
<?php
exit();
?>
<?php endif;

?>

<?php
$name=h($_POST['name']);
$pass=h($_POST['pass']);
$table='gym';

// DBからユーザー情報を参照
$pdosql=new database();
$stmt=$pdosql->userinfo($table,$name);
// 会員かどうか確認
// $count=$stmt->rowCount();

$member=$stmt->fetchAll(PDO::FETCH_ASSOC);
$count=count($member);

if($count>0){
  //ログインパスワードの確認とクッキー
  if(password_verify($pass,$member[0]['pass'])){
    $_SESSION['id']=$member[0]['id'];
    $_SESSION['name']=$member[0]['name'];
    // cookieに保存するかどうか
        if(!empty($_POST['cookie'])){
          setcookie("name",$_SESSION['name'],time()+60*60*24*4);
          setcookie("pass",$pass,time()+60*60*24*4);
        }
        // cookie情報を消去するかどうか
        if(!empty($_POST['cookie_delete'])){
          setcookie("name",$_SESSION['name'],time()-60);
          setcookie("pass",$pass,time()-60);
        }
        
  header('Location: ./home.php');
  exit();
  }else{
  // ログイン情報の不一致
  $_SESSION=array();
  session_destroy();
  $msg="名前とパスワードが正しくありません";
  $link='<a href="login.php">ログインページ</a>';
  }

}
  else{
    // dbにユーザー名が登録されていないとき
  $msg="その名前のユーザーは見つかりません";
  $link='<a href="login.php">ログインページ</a>';
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
</head>
<body>
  <h1><?=$msg?></h1>
  <?=$link?>
</body>
</html>