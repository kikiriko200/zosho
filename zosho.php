<?php
  class zosho {
    public function connectdb(){
      //接続
      try{
        $pdo = new PDO('sqlite:books.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

        return($pdo);
      }catch (PDOException $e){
        $error = $e->getMessage();

        exit($error);
      }
    }

    public function createdb(){
      //テーブル作成
      $pdo->exec("CREATE TABLE IF NOT EXISTS booksTest2(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        isbn INTEGER VARCHAR(15),
        title VARCHAR(100),
        author VARCHAR(100),
        imgpath VARCHAR(1000),
        publisher VARCHAR(1000),
        about VARCHAR(1000),
        UNIQUE (isbn)
      )");
    }

    public function upload(){
      $isbn = $_POST['isbn'];
      $title = $_POST['title'];
      $author = $_POST['author'];
      $imgpath = $_POST['imgpath'];
      $publisher = $_POST['publisher'];
      $about = $_POST['about'];
      $upload = $pdo->prepare("INSERT INTO booksTest2(isbn, title, author, imgpath, publisher,about) VALUES (?, ?, ?, ?, ?, ?)");
      $query = [$isbn,$title,$author,$imgpath,$publisher,$about];
      $upload -> execute($query);
    }

    public function deleted(){
      $id = $_POST['id'];
      connectdb();
      $delete = $pdo->prepare("DELETE FROM booksTest2 WHERE id = ?");
      $query = [$id];
      $delete -> execute($query);
    }
  }
