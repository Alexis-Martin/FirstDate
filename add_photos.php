<?php
  require 'Connection.php';

  $id  = $_POST['id'];
  $url = $_POST['url'];

  $base = new Connection('localhost', 'FirstDate_base', 'root', 'irahebbdlms');

  $query  = "UPDATE users SET photo_users=" . $base->getBDD()->quote($url) . " WHERE id_fb_users=" . $base->getBDD()->quote($id);
  $base->query($query);
?>
