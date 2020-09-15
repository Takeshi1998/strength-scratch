<?php
session_start();
if(empty($_SESSION['id'])){
  header('Location: ./login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>筋トレのすゝめ</title>
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
	<li><a href="gallery.php"><?=$_SESSION['name']?>の記録</a></li>
	<li><a href="gallery2.php">ベンチプレスmax計算</a></li>
	<li><a href="./logout.php">ログアウト</a></li>
</ul>
</nav>

</div>
<!--/sh-->

<div id="container">

<div id="main">

<section>

<h2>筋トレのすゝめ</h2>

<section class="list">
<a href="workout.html">
<figure><img src="../images/muscle.png" alt=""></figure>
<h4>筋トレ</h4>
</a>
</section>

<section class="list">
<a href="eat.html">
<figure><img src="../images/eat.png" alt=""></figure>
<h4>食事</h4>
</a>
</section>

<section class="list">
<a href="sapuri.html">
<figure><img src="../images/sapuri.png" alt=""></figure>
<h4>サプリ</h4>
</a>
</section>



<!-- <section class="list">
<a href="gallery2.html">
<figure><img src="images/sample1.jpg" alt=""></figure>
<h4>title</h4>
</a>
</section> -->

</section>

</div>
<!--/main-->

<div id="sub">

<!--大きな端末用（481px以上端末）ロゴ-->
<p id="logo"><a href="./home.php"><img src="../images/logo_s.png" alt="SAMPLE LOGO"></a></p>

<!--大きな端末用（481px以上端末）メニュー-->
<nav id="menubar">
<ul>
	<li><a href="home.php">ホーム</a></li>
<li><a href="about.php">記録する</a></li>
	<li><a href="gallery.php"><?=$_SESSION['name']?>の記録</a></li>
	<li><a href="gallery2.php">ベンチプレスmax計算</a></li>
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
