<?php



  class database{
    // DBの設定
  
  
  // DB接続
        function dbconnect(){
          try{
            $db=new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_78c8926ce8bb3ba;charset=utf8;','b14cd205a2e012','10b9210d');
          $db->setAttribute(\PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          return $db;
        }catch(PDOException $e){
          $e->getMessage();
          echo "接続失敗";
          $db=null;
          exit();
        }
      }

      // insert
  


  // DBからユーザー情報を参照,$stmtを返す
    public function userinfo($table,$name){

      $db=$this->dbconnect();
      $sql="SELECT * FROM ".$table." WHERE name=:name";
      $stmt=$db->prepare($sql);
      $stmt->bindParam(':name',$name);
  
      $stmt->execute();
      // $count=$stmt->rowCount();
      $db=null;
      return $stmt;
    }


    // paging機能:$percommentは件数/1ページ $pageは今何ページにいるか $tableはテーブル名
    //  何件目から取得するかの計算 $offset
 function readtweet($percomment,$page,$table){ 

      $offset=$percomment*($page-1);
      $db=$this->dbconnect();
      $sql="SELECT * FROM ".$table." ORDER BY id DESC LIMIT $offset,$percomment";
      $stmt=$db->query($sql);
      $comments=$stmt->fetchAll(PDO::FETCH_ASSOC);
      $db=null;
      return $comments;
    }

      // pagingの件数カウント
    function pagecount($table,$percomment){
    $db=$this->dbconnect();
    $sql="SELECT COUNT(*) FROM ".$table;
    $stmt=$db->query($sql);
    $counts=$stmt->fetchColumn();
    $counts=ceil($counts/$percomment);
    $db=null;
    return $counts;
    }
      // pagingの件数カウント where
    function pagecountwhere($table,$column,$id,$percomment){
    $db=$this->dbconnect();
    $sql="SELECT COUNT(*) FROM ".$table." WHERE ".$column."=:id";
    $stmt=$db->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->execute();
    $counts=$stmt->fetchColumn();
    $counts=ceil($counts/$percomment);
    $db=null;
    return $counts;
    }

    // 各user記録取得 ページング
    public function person($table,$column,$id,$offset,$percomment){
      $db=$this->dbconnect();
      $sql="SELECT * FROM ".$table." WHERE ".$column."=:id ORDER BY id DESC LIMIT $offset,$percomment";
      $stmt=$db->prepare($sql);
      $stmt->bindValue(':id',$id);
      $stmt->execute();
      $db=null;
      return $stmt;
    
    }

    // 各user記録を取得
    public function personCount($table,$column,$id){
      $db=$this->dbconnect();
      $sql="SELECT * FROM ".$table." WHERE ".$column."=:id ";
      $stmt=$db->prepare($sql);
      $stmt->bindValue(':id',$id);
      $stmt->execute();
      $db=null;
      return $stmt;
    }

// DELETE
    public function delete($table,$column,$id){
   
      $db=$this->dbconnect();
      $sql="DELETE FROM ".$table." WHERE ".$column."=:id ";
      $stmt=$db->prepare($sql);
      $stmt->bindParam(':id',$id);
      $stmt->execute();
      $db=null;
    }
    
  // updateのための1件のみ取得
        public function update($table,$column,$post){
      $db=$this->dbconnect();
      $sql="SELECT * FROM ".$table." WHERE ".$column."=:id LIMIT 1";
      $stmt=$db->prepare($sql);
      $stmt->bindParam(':id',$post);
      $stmt->execute();
      $comment=$stmt->fetch();
      $db=null;
      return $comment;
        }

      // update書き換え

      public function updatecom($table,$tweet,$id){
        $db=$this->dbconnect();
        $sql="UPDATE ".$table." SET tweet=:tweet  WHERE id=:id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam(':tweet',$tweet);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $db=null;
        header('Location: ./gallery.php');
        exit();
      }


}
//databaseクラスの終わり
  