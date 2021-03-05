<?php
include './config.php';

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

//エラー
if(!$result) {
  $error = $e->getMessage();
  echo $error;
  exit();
}

//ページング

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
    <section class="section columns">
      <div class="column"></div>
      <div class="column is-half">
        <h1 class="title">蔵書リスト</h1>
        <div style="overflow-x:scroll">
          <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" style="white-space: nowrap;">
            <thead>
              <tr>
                <th>ID</th>
                <th>ISBN</th>
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
              <td><?=$row['isbn']; ?></td>
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
    </section>
  </body>
</html>
