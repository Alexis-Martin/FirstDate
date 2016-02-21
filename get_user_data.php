<?php

require 'Modification.php';
$i=$_POST['id'];

  //echo "ALLLO ".$i." la";
  $test= new Modification($i);

  $req=$test->get_all();
  //echo "ALLLO ".$req." FINIDEALLO";
  echo $req[0] . '<||>' . $req[1] . '<||>' .
       $req[2] . '<||>' . $req[3] . '<||>' .
       $req[4] . '<||>' . $req[5] . '<||>' .
       $req[6] . '<||>' . $req[7] . '<||>' . $req[8];

?>
