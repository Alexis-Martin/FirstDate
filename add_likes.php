<?php
  require 'Connection.php';

  $id      = $_POST['id'];
  $idlikes = $_POST['idlike'];
  $names   = $_POST['names'];
  $name    = explode("<||>", $names);
  $idlike  = explode("<||>", $idlikes);

  $base = new Connection('localhost', 'FirstDate_base', 'root', 'irahebbdlms');

  //INSERT INTO table (id, name, age) VALUES(1, "A", 19) ON DUPLICATE KEY UPDATE name="A", age=19

  $query  = "INSERT IGNORE INTO likes (id_fb_likes, title_likes) VALUES ";
  $query4 = "INSERT IGNORE INTO connect_users_likes (id_connect_users, id_connect_likes) VALUES ";

  for ($i=0; $i < count($name); $i++) {
    $query2 = $query . "(" . $base->getBDD()->quote($idlike[$i]) .
              "," . $base->getBDD()->quote($name[$i]) . ")";
    $base->query($query2);

    $query3 = $query4 . "(" . $base->getBDD()->quote($id) .
              "," . $base->getBDD()->quote($idlike[$i]) . ")";
    $base->query($query3);
  }

?>
