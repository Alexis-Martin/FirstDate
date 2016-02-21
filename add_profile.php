<?php
  require 'Connection.php';
  $keys = array_keys($_POST);

  $base = new Connection('localhost', 'FirstDate_base', 'root', 'irahebbdlms');

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
