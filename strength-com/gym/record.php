<?php
session_start();
if(empty($_SESSION['id'])){
	header('Location: ./login.php');
	exit();
}
require('./function.php');
require_once('./db.php');

$pdosql=new database();
$table="bprecord";
$column="bp_id";
$id=$_SESSION['id'];
$percomment=5;
// 記録が1つ以上あるかどうか、ページング件数取得
// whereでない
$counts=$pdosql->pagecountwhere($table,$column,$id,$percomment); 
if($counts>0){
  
  if(empty($_GET['page'])){
    $_GET['page']=1;
  }
  $page=$_GET['page'];
  $offset=$percomment*($page-1);
  $column="bp_id";
  // データ取得
  $stmt=$pdosql->person($table,$column,$id,$offset,$percomment);
  $records=$stmt->fetchAll();
  // 

}else{
  $caution2="過去の記録がありません。記録してください。";
 $_SESSION['caution']=$caution2; 
 header('Location: ./gallery2.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ベンチプレス記録確認</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ここにサイト説明を入れます">
<meta name="keywords" content="キーワード１,キーワード２,キーワード３,キーワード４,キーワード５">
<link rel="stylesheet" href="../css/style.css">
<script type="text/javascript" src="../js/openclose.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<!--小さな端末用（480px以下端末）ブロック-->
<div id="sh">

<!--小さな端末用ロゴ-->
<p id="logo"><a href="./login.php"><img src="../images/logo_s.png" alt="SAMPLE LOGO"></a></p>

<!--小さな端末用メニュー-->
<nav id="menubar-s">
<ul>
<li><a href="home.php">みんなの記録</a></li>
<li><a href="gallery.php"><?=$_SESSION['name']?>の投稿</a></li>
<li><a href="learning.php">筋トレのすゝめ</a></li>
<li><a href="./logout.php">ログアウト</a></li>
</ul>
</nav>

</div>
<!--/sh-->

<div id="container">

<div id="main">

<div class="box">

<article>

<h2><?=$_SESSION['name']?>の記録</h2>

<table>
  <tr>
    <th>日にち</th>
    <th>max重量</th>
  
  </tr>
  
  
  <?php if(!empty($records)):?>
    <?php foreach ($records as $key=>$record):?>
      <?php
$record['time']=substr($record['time'],-5,5)

      ?>
      <tr>
    <td><?=$record['time']?></td>
    <td><?=$record['kg']?>kg</td>
    <td>
    <form action="./rdelete.php" method="post">
      <input type="hidden" name="id" value=<?=$record['id'];?>>
      <input type="submit" value="消去">
    </form>
    </td>
     </tr>
  
    <?php endforeach;?>
    <?php endif;?>
  </table>
  
<!-- ページング3件未満 -->
<?php if($counts<3):?>
  <?php for($i=1;$i<=$counts;$i++):?>
    <a href="?page=<?= $i;?>"><?=$i?></a>
    <?php endfor;?>
    <?php else:?>
    <!-- 3件未満じゃないとき -->
    <!-- 最後のページ -->
      <?php if($page==$counts&&$page!=1):?>
        <a href="?page=<?=$page-1;?>">前へ</a>
        <?php for($i=$page-2;$i<=$page;$i++):?>
        <a href="?page=<?= $i;?>"><?=$i?></a>
        <?php endfor;?>
      <?php endif;?>
        <!-- page=1且つページング3件以上 -->
        <?php if($page==1&&$counts>2):?>
          <?php for($i=$page;$i<=3;$i++):?>
            <a href="?page=<?= $i;?>"><?=$i?></a>
            <?php endfor;?>
            <a href="?page=<?=$page+1;?>">次へ</a>
          <?php endif;?>
        <!-- page=2且つページング3件以上 -->
        <?php if($page==2&&$counts>2):?>
          <?php for($i=$page-1;$i<=$page+1;$i++):?>
            <a href="?page=<?= $i;?>"><?=$i?></a>
            <?php endfor;?>
            <a href="?page=<?=$page+1;?>">次へ</a>
          <?php endif;?>
        <!--page=3以上 ページング3件以上 -->
        <?php if($counts>2&&$page!=2&&$page!=$counts&&$page!=1):?>
          <a href="?page=<?=$page-1;?>">前へ</a>
          <?php for($i=$page-1;$i<=$page+1;$i++):?>
            <a href="?page=<?= $i;?>"><?=$i?></a>
            <?php endfor;?>
            <a href="?page=<?=$page+1;?>">次へ</a>
          <?php endif;?>

		
    <?php endif;?>
    <!-- ページング3件以下 -->
	<p><a href="javascript:history.back()">&lt;&lt; 前のページに戻る</a></p>
</article>


</div>

</div>
<!--/main-->

<div id="sub">

<!--大きな端末用（481px以上端末）ロゴ-->
<p id="logo"><a href="./login.php"><img src="../images/logo_s.png" alt="SAMPLE LOGO"></a></p>

<!--大きな端末用（481px以上端末）メニュー-->
<nav id="menubar">
<ul>
<li><a href="home.php">みんなの記録</a></li>
<li><a href="gallery.php"><?=$_SESSION['name']?>の投稿</a></li>
<li><a href="learning.php">筋トレのすゝめ</a></li>
<li><a href="./logout.php">ログアウト</a></li>
</ul>
</nav>

</div>
<!--/sub-->

</div>
<!--/container-->

<footer>
<small>Copyright&copy; <a href="index.html" id="footer">Sample Site</a> All Rights Reserved.</small>
<span class="pr"><a href="http://template-party.com/" target="_blank" id="footer">Web Design:Template-Party</a></span>
</footer>

<!--メニューの３本バー-->
<div id="menubar_hdr" class="close"><span></span><span></span><span></span></div>
<!--メニューの開閉処理条件設定　480px以下-->
<script type="text/javascript">
if (OCwindowWidth() <= 480) {
	open_close("menubar_hdr", "menubar-s");
}
</script>
</body>
</html>
