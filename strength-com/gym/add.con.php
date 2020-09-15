<?php
require_once("./db.php");
$name=$_POST["name"];
$pass=$_POST["pass"];
// 暗号化
$pass=password_hash($pass,PASSWORD_DEFAULT);
$sex=$_POST["sex"];
$pdosql=new database();
$db=$pdosql->dbconnect();
$sql="INSERT INTO gym(name,pass,sex,zikan) VALUES (:name,:pass,:sex,NOW()+ INTERVAL 9 HOUR)";
$stmt=$db->prepare($sql);
$stmt->bindParam(':name',$name);
$stmt->bindParam(':pass',$pass);
$stmt->bindParam(':sex',$sex);
$stmt->execute();
$db=null;
header('Location: ./home.php');
exit();



?>