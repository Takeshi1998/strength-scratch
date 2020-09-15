<?php
session_start();
if(empty($_SESSION['id'])){
  header('Location: ./login.php');
  exit();
}
if(!empty($_SESSION['error'])){
	$error=$_SESSION['error'];
	unset($_SESSION['error']);
}

require_once('./function.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>記録画面</title>
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
<li><a href="./home.php">みんなの投稿</a></li>
	<li><a href="./gallery.php"><?=$_SESSION['name']?>の投稿</a></li>
	<li><a href="./gallery2.php">ベンチプレスmax計算</a></li>
	<li><a href="./learning.php">筋トレのすゝめ</a></li>
	<li><a href="./logout.php">ログアウト</a></li>
</ul>
</nav>

</div>
<!--/sh-->

<div id="container">

<div id="main">

<section class="box">

<h2>記録する</h2>


<form action="./post.com.php" method="post">
  <textarea name="tweet" cols="40" rows="10" placeholder="(例)&#13ベンチプレス:50kg  10回8回7回&#13スクワット:60kg  6回5回5回&#13懸垂  7回6回5回"></textarea>
		<br>

		<?php if(!empty($error)):?>
		<p>※<?=$error;?></p>
		<?php endif;?>

    <input type="submit" value="記録する">
  </form>


</div>
<!--/main-->

<div id="sub">

<!--大きな端末用（481px以上端末）ロゴ-->
<p id="logo"><a href="./home.php"><img src="../images/logo.png" alt="SAMPLE LOGO"></a></p>

<!--大きな端末用（481px以上端末）メニュー-->
<nav id="menubar">
<ul>
			<li><a href="./home.php">みんなの投稿</a></li>
	<li><a href="./gallery.php"><?=$_SESSION['name']?>の投稿</a></li>
	<li><a href="./gallery2.php">ベンチプレスmax計算</a></li>
	<li><a href="./learning.php">筋トレのすゝめ</a></li>
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
