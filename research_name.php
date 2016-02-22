<?php

  require "Connection.php";

  $name = "%" . $_POST['name'] . "%";

  $base = new Connection();

   $query = "SELECT id_fb_users, gender_users, photo_users, name_users, birthday_users, bio_users, location_users, interested_users, relation_users FROM users WHERE name_users LIKE " . $base->getBDD()->quote($name) ;
  $req2 = $base->query($query);
  $rep = "";
  if($req2!=NULL){
    while ($data = $req2->fetch(PDO::FETCH_ASSOC)) {
      $rep .= $data['gender_users'] . "|/|" .
              $data['photo_users']  . "|/|" .
              $data['name_users'] . "|/|" .
              $data['birthday_users'] . "|/|" .
              $data['bio_users'] . "|/|" .
              $data['location_users']  . "|/|" .
              $data['interested_users'] . "|/|" .
              $data['relation_users'] . "|/|" .
              $data['id_fb_users'];
      $rep .= "<!!>";
    }
  }
  echo $rep;
?>
