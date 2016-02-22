<?php
  require 'Connection.php';

  $base = new Connection();


  $id      = $base->getBDD()->quote($_POST['id']);
  $idlikes = $_POST['idlike'];
  $names   = $_POST['names'];
  $name    = explode("<||>", $names);
  $idlike  = explode("<||>", $idlikes);


  //INSERT INTO table (id, name, age) VALUES(1, "A", 19) ON DUPLICATE KEY UPDATE name="A", age=19

  $ask = "SELECT id_connect_users, id_connect_likes FROM connect_users_likes WHERE id_connect_users=" . $id . " AND (id_connect_users, id_connect_likes) NOT IN (SELECT id_connect_users, id_connect_likes FROM connect_users_likes WHERE ";

  for ($i=0; $i < count($name); $i++) {
    $ask .= "(id_connect_users=" . $id . " AND id_connect_likes=" . $base->getBDD()->quote($idlike[$i]) . ")";
    if($i != count($name) - 1){
      $ask .= " OR ";
    }
  }

  $ask .= ")";

  $req2 = $base->query($ask);

  if($req2 != NULL){
    while ($data = $req2->fetch(PDO::FETCH_ASSOC)) {
      $delete = "DELETE FROM connect_users_likes WHERE id_connect_users=" . $data['id_connect_users'] . " AND id_connect_likes=" . $data['id_connect_likes'];
      $base->query($delete);
    }
  }

  //Insertion des nouveaux likes
  $query  = "INSERT IGNORE INTO likes (id_fb_likes, title_likes) VALUES ";
  $query4 = "INSERT IGNORE INTO connect_users_likes (id_connect_users, id_connect_likes) VALUES ";

  for ($i=0; $i < count($name); $i++) {
    $query2 = $query . "(" . $base->getBDD()->quote($idlike[$i]) .
              "," . $base->getBDD()->quote($name[$i]) . ")";
    $base->query($query2);

    $query3 = $query4 . "(" . $id .
              "," . $base->getBDD()->quote($idlike[$i]) . ")";
    $base->query($query3);
  }



?>
