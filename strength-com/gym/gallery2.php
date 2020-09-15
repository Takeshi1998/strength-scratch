<?php

session_start();
// login
if(empty($_SESSION['id'])){
  header('Location: ./login.php');
  exit();
}

require_once('./function.php');
if(!empty($_SESSION['caution'])){
  $caution2=$_SESSION['caution'];
  unset($_SESSION['caution']);
}

if(!empty($_SESSION['insert'])){
	$insert=$_SESSION['insert'];
	unset($_SESSION['insert']);
}

 if(!empty($_POST['kg'])&&!empty($_POST['number'])){
   
  if(is_numeric($_POST['kg'])){
    $kg=h($_POST['kg']);
    $number=h($_POST['number']);
    $result=round($kg*$number/40+$kg,2);
    $_SESSION['result']=$result;
   }else{
     $caution="数字を入力してください";
   }
 }
 
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ベンチプレスmax計算＆記録</title>
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

<li><a href="gallery.php"><?=$_SESSION['name']?>の記録</a></li>
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

<h2>ベンチプレスmax計算</h2>

<a href="./record.php">現在までの記録確認</a>

  <form action="" method="post">
    <label for="kg_">重さ</label>
    <input type="text" name="kg" id="kg_">
    <br>
    <label for="number_">回数</label>
    <input type="number" name="number" id="number_">
    <br>
    <input type="submit" value="計算する">
  </form>

  <?php if(!empty($result)):?>
  <h3 style="margin-bottom:0px;">max 推定:<?=$result?></ｈ>
  <button><a href="./record.insert.php">記録する</a></button>
	<?php endif;?>

		<?php if(empty($result)&&empty($insert)):?>
		<p>※1セット目の重さと回数を記入してください</p>
		
		<?php endif;?>
		<!--過去の記録参照のエラー -->
    <?php if(!empty($caution2)):?>
      <p>※<?=$caution2?></p>
		<?php endif;?>
<!-- 数字を入力してください -->
  <?php if(!empty($caution)):?>
    <p><?=$caution?></p>
	<?php endif;?>

	<!-- 追加しましたのメッセージ -->
  <?php if(!empty($insert)):?>
    <p><?=$insert?></p>
  <?php endif;?>

<figure>
<img src="../images/bpfhoto.png" alt="写真の説明を入れます"/>
</figure>


</article>

<p><a href="javascript:history.back()">前のページに戻る</a></p>

</div>

</div>
<!--/main-->

<div id="sub">

<!--大きな端末用（481px以上端末）ロゴ-->
<p id="logo"><a href="./home.php"><img src="../images/logo_s.png" alt="SAMPLE LOGO"></a></p>

<!--大きな端末用（481px以上端末）メニュー-->
<nav id="menubar">
<ul>
  <li><a href="./home.php">ホーム</a></li>
<li><a href="gallery.php"><?=$_SESSION['name']?>の記録</a></li>
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
