<?php
  include './config.php';
  include './zosho.php';
  $zosho = new zosho();
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
    <div class="section columns">
      <div class="column"></div>
      <div class="column is-half">
        <h1 class="title ">蔵書登録フォーム</h1>
        <form method="POST" action="up.php">
          <label for="isbn" class="label">ISBN</label>
          <div class="field is-grouped">
            <div class="control is-expanded">
              <input type="number" id="isbn" name="isbn" class="input" required/>
            </div>
            <div class="control">
              <button id="noIsbn" type="button" class="button is-warning">ISBN不明</button>
              <button id="auto" type="button" class="button is-info">自動入力</button>
            </div>
          </div>
          <label for="title" class="label">書名</label>
          <input type="text" id="title" name="title" class="input" required/>
          <label for="author" class="label">著者名</label>
          <input type="text" id="author" name="author" class="input" required/>
          <label for="publisher" class="label">出版社名</label>
          <input type="text" id="publisher" name="publisher" class="input" required/>
          <label for="about" class="label">概要</label>
          <textarea id="about" name="about" class="textarea"></textarea>
          <label for="imgpath" class="label">書影画像URL</label>
          <input type="text" id="imgpath" name="imgpath" placeholder="http(s)://" class="input" required/>
          <label for="password" class="label">投稿用パスワード</label>
          <input type="text" id="uppass" name="uppass" class="input" required/>
          <input type="submit" id="submit" class="button is-info"/>
        </form>
      </div>
      <div class="column"></div>
    </div>
  </body>
</html>
