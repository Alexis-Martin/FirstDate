<?php
  require 'Connection.php';
  require 'conf.php';
  $keys = array_keys($_POST);

  $base = new Connection($server, $base, $user, $mdp);

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
  echo $query;
  $base->query($query);
?>
