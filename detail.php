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

//ID指定
$query = 'SELECT * FROM booksTest2 WHERE id = ?';
$id = $_GET['id'];

//SQL実行
$prepare = $pdo->prepare($query);
$prepare->bindValue(1,(int)$id,PDO::PARAM_INT);
$prepare->execute();
$result = $prepare->fetch();

//エラー
if(!$result) {
  $result['id'] = $_GET['id'];
  $result['title'] = 'Not found such ID!!';
  $result['isbn'] = '?_?';
  $result['author'] = '・。・';
}
?>
<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?=$result['title']?></title>
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
      <div class="column is-8">
        <h1 class="title">蔵書詳細(ID:<?=$result['id']?>)</h1>
        <div class="box">
          <div class="columns">
            <div class="column is-3">
              <img src="<?=$result['imgpath']?>" onerror="this.src='./img/error.png'">
            </div>
            <div class="column">
              <h1 class="title"><?=$result['title']?></h1>
              <h2 class="subtitle">ISBN:<?=$result['isbn']?></h2>
              <h2 class="subtitle">著者名:<?=$result['author']?></h2>
              <h2 class="subtitle">出版社:<?=$result['publisher']?></h2>
              <h2 class="subtitle">概要</h2>
              <p><?=$result['about']?></p>
              <form method="POST" action="./delete.php">
                <input type="hidden" id="id" name="id" value="<?=$result['id']?>" />
                <label for="delpass" class="label">削除</label>
                <div class="field is-grouped">
                  <div class="control is-expanded">
                    <input type="text" id="delpass" name="delpass" class="input" required/>
                  </div>
                  <div class="control">
                    <input type="submit" class="button is-danger" value="削除">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="column"></div>
    </section>
  </body>
</html>
