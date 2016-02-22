<?php
  require 'Connection.php';
  require 'conf.php';
  $keys = array_keys($_POST);

  $base = new Connection($server, $base, $user, $mdp);
  $id = 0;
  $birth = "";
  $gend = "";
  $name = "";
  $bio = "";
  $loc = "";
  $rel = "";
  $int = "";
  $ask = "SELECT mv_name_users, mv_bio_users, mv_birthday_users, mv_gender_users, mv_location_users, mv_relation_users, mv_interested_users FROM users WHERE ";
  for ($i=0; $i < count($keys); $i++) {
    if($keys[$i] == "id_fb_users"){
      $id = $base->getBDD()->quote($_POST[$keys[$i]]);
      $ask .= $keys[$i] . "=" . $id;
    }
    elseif ($keys[$i] == "birthday_users") {
      $birth = $base->getBDD()->quote($_POST[$keys[$i]]);
    }
    elseif ($keys[$i] == "gender_users") {
      $gend = $base->getBDD()->quote($_POST[$keys[$i]]);
    }
    elseif ($keys[$i] == "name_users") {
      $name = $base->getBDD()->quote($_POST[$keys[$i]]);
    }
    elseif ($keys[$i] == "bio_users") {
      $bio = $base->getBDD()->quote($_POST[$keys[$i]]);
    }
    elseif ($keys[$i] == "location_users") {
      $loc = $base->getBDD()->quote($_POST[$keys[$i]]);
    }
    elseif ($keys[$i] == "relation_users") {
      $rel = $base->getBDD()->quote($_POST[$keys[$i]]);
    }
    elseif ($keys[$i] == "interested_users") {
      $int = $base->getBDD()->quote($_POST[$keys[$i]]);
    }
  }

  $res=$base->query($ask);

  if($base->count($res) == 1){
    $upd = "UPDATE users SET ";
    $data = $res->fetch(PDO::FETCH_ASSOC);
    $exist = false;
    $suiv = false;
    if($data['mv_name_users'] == 0){
      $upd .= "name_users=" . $name;
      $exist = true;
      $suiv = true;
    }
    if($data['mv_bio_users'] == 0){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "bio_users=" . $bio;
      $exist = true;
      $suiv = true;
    }
    if($data['mv_birthday_users'] == 0){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "birthday_users=" . $birth;
      $exist = true;
      $suiv = true;
    }
    if($data['mv_gender_users'] == 0){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "gender_users=" . $gend;
      $exist = true;
      $suiv = true;
    }
    if($data['mv_location_users'] == 0){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "location_users=" . $loc;
      $exist = true;
      $suiv = true;
    }
    if($data['mv_relation_users'] == 0){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "relation_users=" . $rel;
      $exist = true;
      $suiv = true;
    }
    if($data['mv_interested_users'] == 0){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "interested_users=" . $int;
      $exist = true;
    }
    $upd .= " WHERE id_fb_users=" . $id;
    if($exist == true){
      $base->query($upd);
    }


  }

  else{
    $query = "INSERT IGNORE INTO users (";
    for ($i=0; $i < count($keys); $i++) {
      $query .= $keys[$i];
      if($i != count($keys) - 1){
        $query .= ", ";
      }
    }
    $query .= ") VALUES (";
    for ($i=0; $i < count($keys); $i++) {
      $query .= $base->getBDD()->quote($_POST[$keys[$i]]);
      if($i != count($keys) - 1){
        $query .= ",";
      }
    }
    $query .= ")";
    $base->query($query);
  }
?>
