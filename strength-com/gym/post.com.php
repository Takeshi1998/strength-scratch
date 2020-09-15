<?php
require_once("./db.php");
require_once('./function.php');
session_start();
if(empty($_POST['tweet'])){
  session_start();
  $_SESSION['error']="入力されていません";
  header('Location: ./about.php');
  exit();
}

$tweet=h($_POST['tweet']);
$talker_id=$_SESSION['id'];
$name=$_SESSION['name'];

$pdosql=new database();
$db=$pdosql->dbconnect();
$sql="INSERT INTO  comments(talker_id,name,tweet,zikan) VALUES(:talker_id,:name,:tweet,NOW()+ INTERVAL 9 HOUR)";
$stmt=$db->prepare($sql);
$stmt->bindParam(':talker_id',$talker_id);
$stmt->bindParam(':name',$name);
$stmt->bindParam(':tweet',$tweet);
$stmt->execute();
$db=null;
header('Location: ./home.php');
?>