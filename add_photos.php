<?php
  require 'Connection.php';
  require 'conf.php';

  $id  = $_POST['id'];
  $url = $_POST['url'];

  $base = new Connection($server, $base, $user, $mdp);

  $query  = "UPDATE users SET photo_users=" . $base->getBDD()->quote($url) . " WHERE id_fb_users=" . $base->getBDD()->quote($id);
  $base->query($query);
?>
