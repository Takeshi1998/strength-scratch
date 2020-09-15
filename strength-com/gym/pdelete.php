<?php
require_once('./db.php');
if(empty($_POST['post_id'])){
  header('Location: ../index.html');
  exit();
}
$post=$_POST['post_id'];
// db消去
$pdosql=new database();
$table="comments";
$column="id";
$pdosql->delete($table,$column,$post);

header('Location: ./gallery.php');
exit();

?>