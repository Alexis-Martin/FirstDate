<?php

  require "Connection.php";


  $base = new Connection('localhost', 'FirstDate_base', 'root', 'irahebbdlms');
  $req = $base->match($base->getBDD()->quote($_POST['id']));
  $rep = "";
  $keys =  array_keys($req);
  for ($i=0; $i < count($req); $i++) {
    $query = "SELECT id_fb_users, gender_users, photo_users, name_users, birthday_users, bio_users, location_users, interested_users, relation_users FROM users WHERE id_fb_users=" . $keys[$i];
    $req2 = $base->query($query);
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
      }
    }
    $rep .= "|/|" . $req[$keys[$i]] . "<!!>";
  }
  echo $rep;
?>
