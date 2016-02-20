<?php
  require 'Connection.php';

  $names = $_POST['names'];
  $name = explode("|", $names);

  $base = new Connection('localhost', 'FirstDate_base', 'root', 'irahebbdlms');

  $query = "INSERT IGNORE INTO likes (titlelikes) VALUES ";
  for ($i=0; $i < count($name); $i++) {
    $query .= "(" . $base->getBDD()->quote($name[$i]) . ")";
    if($i != count($name) - 1){
      $query .= ",";
    }
  }
  echo $query;
  $base->query($query);
?>
