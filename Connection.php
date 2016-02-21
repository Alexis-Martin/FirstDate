<?php

class Connection{

      private $bdd;
      private $_host;
      private $_dbname;
      private $_mdp;
      private $_user;

  public function __construct($h,$db,$user,$mdp){
    $this->sethost($h);
    $this->setdbname($db);
    $this->setuser($user);
    $this->setmdp($mdp);
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
  public function sethost($h){
    $this->_host = $h;
  }
  public function setdbname($db){
    $this->_dbname = $db;
  }
  public function setuser($user){
    $this->_user = $user;
  }
  public function setmdp($mdp){
    $this->_mdp = $mdp;
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
  public function getmdp(){
    return $this->$_mdp;
  }
  public function query($req){
    $res = $this->getBDD()->query($req);//'SELECT COUNT(*) as nb FROM likes');
    //$res= $this->getBDD()->prepare($req);
    //$res->execute();
        if ($res!=NULL){
            return $res;
        }
        else{
            return NULL;
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
}

?>
