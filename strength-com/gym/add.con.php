<?php
$name=$_POST['name'];
$pass=$_POST['pass'];
session_start();


if(empty($name)||empty($pass)){
   
$_SESSION['error_all']="全ての情報を入力してください";
  header('Location: ./login.php');
  exit();
}


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




require_once("./db.php");
// hash
setcookie("name",$name,time()+60*60*24*4);
setcookie("pass",$pass,time()+60*60*24*4);
$pass=password_hash($pass,PASSWORD_DEFAULT);
$pdosql=new database();
$db=$pdosql->dbconnect();
$sql="INSERT INTO gym(name,pass,zikan) VALUES (:name,:pass,NOW()+ INTERVAL 9 HOUR)";
$stmt=$db->prepare($sql);
$stmt->bindParam(':name',$name);
$stmt->bindParam(':pass',$pass);
$stmt->execute();
$db=null;
header('Location: ./login.php');
exit();



?>