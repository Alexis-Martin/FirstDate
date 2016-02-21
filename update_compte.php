<?php


require 'Modification.php';
$i=$_POST['id'];

$modif= new Modification($i);
$name=$modif->getBDD()->quote($_POST['name']);
$text=$modif->getBDD()->quote($_POST['text']);
$date=$modif->getBDD()->quote($_POST['date']);
$gen= $modif->getBDD()->quote($_POST['gen']);
$city=$modif->getBDD()->quote($_POST['city']);
$rel= $modif->getBDD()->quote($_POST['rel']);
$int= $modif->getBDD()->quote($_POST['int']);

$modif->setAll($name,$text,$date,$gen,$city,$rel,$int);

?>
