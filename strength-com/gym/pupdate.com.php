<?php
require('./function.php');
require_once('./db.php');

if(empty($_POST['id'])){
  header('Location: ./login.php');
  exit();
}

if(empty($_POST['tweet'])){
  header('Location: ./gallery.php');
  exit();
}
$table="comments";
$tweet=h($_POST['tweet']);
$id=$_POST['id'];

$pdosql=new database();
$pdosql->updatecom($table,$tweet,$id);
?>



