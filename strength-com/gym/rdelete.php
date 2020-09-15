<?php
require_once('./db.php');
if(empty($_POST['id'])){
  header('Location: ./login.php');
  exit();
}
$table="bprecord";
$column="id";
$id=$_POST['id'];
$pdosql=new database();
$pdosql->delete($table,$column,$id);
header('Location: ./record.php');



?>