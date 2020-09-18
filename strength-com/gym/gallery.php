<?php
require_once('./function.php');
require_once('./db.php');
session_start();
// ログインの確認
if(!empty($_SESSION['id'])){
  $id=$_SESSION['id'];
  // ページング get値がnullの時?page=1
  if(empty($_GET['page'])){
    $_GET['page']=1;
  }
  $table="comments";
  $column="talker_id";
  $pdosql=new database();
  // ログインユーザーの過去投稿の有無
  $stmt=$pdosql->personCount($table,$column,$id);
  $results=$stmt->fetchAll();
  $count=count($results);

 
    if($count>0){
      
      $page=$_GET['page'];
      $percomment=4;
      $offset=$percomment*($page-1);
      // ページングページ数の計算
      $counts=ceil($count/$percomment);
      
      // ログインユーザーのページング投稿取得
      
      $results=$pdosql->person($table,$column,$id,$offset,$percomment);
   
    } else{
      $msg="投稿はありません";
    }
    
  }
// 非ログイン時
   else{
    header('Location: ./login.php');
    exit();
   }
$db=null;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?=$_SESSION['name'];?>の投稿</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<p id="logo"><a href="./home.php"><img src="../images/logo_s.png" alt="SAMPLE LOGO"></a></p>

<!--小さな端末用メニュー-->
<nav id="menubar-s">
<ul>
  <li><a href="home.php">ホーム</a></li>
  <li><a href="about.php">記録する</a></li>
<li><a href="gallery2.php">ベンチプレスmax計算</a></li>
<li><a href="learning.php">筋トレのすすめ</a></li>
<li><a href="./logout.php">ログアウト</a></li>
</ul>
</nav>

</div>
<!--/sh-->

<div id="container">

<div id="main">

<section>

<h2><?=$_SESSION['name'];?>の投稿
<?php if(empty($msg)):?>
(<?=$page?>ページ)
<?php endif;?>
</h2>

<?php if(!empty($results)):?>
<ul  id="mypost">
  <?php foreach($results as $result):?>
  <?php
    $result['zikan']=substr($result['zikan'],0,16);
  ?>
    <div id="line">
          <li style="display:flex; justify-content: space-between;">
            <span id="pname">名前:<?=h($result['name']);?></span>

            <form action="./pdelete.php" method="post">
              <input type="hidden" value="<?=$result['id']?>" name="post_id">
            <input type="submit" value="消去">
            </form>
            
          </li> 
          <li> <?=nl2br(h($result['tweet']));?></li>
          <li style="display:flex; justify-content: space-between;">
            <?=day($result['zikan']);?>
            <form action="./pupdate.php" method="post">
              <input type="hidden" value="<?=$result['id']?>" name="id">
              <input type="submit" value="編集する">
            </form>
           </li>

    </div>
<?php endforeach;?>
        </ul>
  <?php endif;?>

<?php if(!empty($counts)):?>
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
  <?php endif;?>

  <?php if(!empty($msg)):?>
  <p><?=$msg?></?>
  <?php endif;?>
</section>

</div>
<!--/main-->

<div id="sub">

<!--大きな端末用（481px以上端末）ロゴ-->
<p id="logo"><a href="./home.php"><img src="../images/logo.png" alt="SAMPLE LOGO"></a></p>

<!--大きな端末用（481px以上端末）メニュー-->
<nav id="menubar">
<ul>
  <li><a href="home.php">ホーム</a></li>
  <li><a href="about.php">記録する</a></li>
<li><a href="gallery2.php">ベンチプレスmax計算</a></li>
<li><a href="learning.php">筋トレのすすめ</a></li>
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
