<?php
include './config.php';
include './zosho.php';
$zosho = new zosho();

/*Time*/
$time = date('YmdHis');
$year = date('Y');
$month = date('m');
$day = date('d');

//接続
try{
  $pdo = new PDO('sqlite:books.db');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
}catch (PDOException $e){
  $error = $e->getMessage();
}

//SQL実行
$prepare = $pdo->prepare('SELECT * FROM booksTest2');
$prepare->execute();
$result = $prepare->fetchAll();
$len = count($result);
//エラー
if(!$result) {
  $error = $e->getMessage();
  echo $error;
  exit();
}
?>
<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="preload" as="style" href="./css/bulma.min.css" onload="this.as='';this.rel='stylesheet'">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/upload.js"></script>
  </head>
  <body>
  <nav class="navbar is-info" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="https://zosho.dafu.cf/">
        Zosho
      </a>
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div id="navbar" class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item" href="/">
          Home
        </a>
        <a class="navbar-item" href="/form.php">
          Update
        </a>
    </div>
  </nav>
  <section class="section">
    <div class="columns">
      <div class="column"></div>
      <div class="section column is-6 is-center">
        <section class="hero is-info">
            <div class="hero-body">
              <div class="container">
                <h1 class="title">
                  <?=$site_name?>
                </h1>
                <h2 class="subtitle">
                  <?=$description?>
                </h2>
              </div>
            </div>
        </section>
        <div class="notification is-success" style="margin-top:30px;">
          <p><?=$year?>年<?=$month?>月<?=$day?>日</p>
          <p>現在<?=$len?>冊の蔵書があります</p>
        </div>
        <a href="./form.php" class="button is-info">投稿はこちら</a>
        <div style="overflow-x:auto" style="margin-top:30px;">
          <h2 class="title">蔵書リスト</h2>
          <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" style="white-space: nowrap;">
            <thead>
              <tr>
                <th>ID</th>
                <th>書名</th>
                <th>著者名</th>
                <th>出版社名</th>
              </tr>
            </thead>
            <tbody>
            <?php
              foreach($result as $row){
            ?>
            <tr>
              <td><a href="./detail.php?id=<?=$row['id'];?>"><?=$row['id']; ?></a></td>
              <td><?=$row['title']; ?></td>
              <td><?=$row['author']; ?></td>
              <td><?=$row['publisher']; ?></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="column"></div>
    </div>
  </section>
    <script>
      var url = './read.php';
      $('#reader').on('click',function(){
        fetch(url)
      })
    </script>
