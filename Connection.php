<?php

$server = 'localhost';
$base   = 'FirstDate_base';
$user   = 'root';
$mdp    = 'go93han';

class Connection{

   private $bdd;
   private $_host;
   private $_dbname;
   private $_mdp;
   private $_user;

public function __construct($h,$db,$user,$mdp){
 $this->_host = $h;
 $this->_dbname = $db;
 $this->_user = $user;
 $this->_mdp = $mdp;
 try{
     $this->bdd = new PDO('mysql:host='.$h.';dbname='.$db, $user, $mdp);
 }
 catch (Exception $e)
 {
     die('Erreur : ' . $e->getMessage());
 }
}
public function getBDD(){
 return $this->bdd;
}
public function gethost(){
 return $this->$_host;
}
public function getdbname(){
 return $this->$_dbname;
}
public function getuser(){
 return $this->$_user;
}
public function query($req){
 $res= $this->getBDD()->query($req);
 //$res= $this->getBDD()->prepare($req);
 //$res->execute();
     if ($res!=NULL){
         $rc=$res->rowCount();
         return $res;
     }
     else{
         return NULL;
     }
 }
public function printReq($res,$type){

     if($res!=NULL){
             while ($data = $res->fetch(PDO::FETCH_ASSOC)) {
                 print_r ($data);
                 echo $data[$type]."<br>";
             }
     }
}
public function count($res){

     if($res==NULL){
         return 0;
     }
     else{
         return $res->rowCount();
     }
 }
 public function match($id){ // checker que $id est bien dans la table
     $req=$this->query("select id_fb_users as nb from users where id_fb_users!=".$id);
     $nbr= $this->count($req);
     //$ids=$req->fetchAll();
     //$tab[];
     //$tab1[];
     $tab=array();

     for ($numero = 0; $numero < $nbr; $numero++){
         $data=$req->fetch(PDO::FETCH_ASSOC)['nb'];
         //echo $nbr." et ".$data." et ".$numero."  a";
         $req1=$this->query("SELECT count(*) as value FROM connect_users_likes AS aa inner join connect_users_likes as bb on aa.id_connect_likes=bb.id_connect_likes and aa.id_connect_users=".$data." and bb.id_connect_users=".$id);
         $res=$req1->fetch(PDO::FETCH_ASSOC)['value'];
         //echo "Le id n°".$id." a ".$res." centre d'interet avec le id n°".$data."<br>";
         $tab[$data] = $res;

     }
    //echo print_r($tab);
    arsort($tab);
     return $tab;
 }
}

?>
