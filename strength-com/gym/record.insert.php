<?php
session_start();
require_once('./db.php');


if(empty($_SESSION['result'])){
  header('Location: ./bp.php');
}else{

$pdosql=new database();
$db=$pdosql->dbconnect();
$sql="INSERT INTO bprecord(bp_id,kg,time) VALUES(:bp_id,:kg,NOW())";
$stmt=$db->prepare($sql);
$stmt->bindParam(':bp_id',$_SESSION['id']);
$stmt->bindParam(':kg',$_SESSION['result']);
$stmt->execute();
$dn=null;
$_SESSION['insert']="記録を追加しました";
header('Location: ./gallery2.php');
exit();
}
?>
