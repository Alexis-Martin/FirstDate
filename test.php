<!DOCTYPE html>
<html lang="fr" dir="ltr" class="client-nojs">
<head>
<meta charset="UTF-8" />
<title>test</title>
</head>
<body>
<p> bla </p>
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
    $res= $this->getBDD()->query($req);//'SELECT COUNT(*) as nb FROM likes');
    //$res= $this->getBDD()->prepare($req);
    //$res->execute();
        if ($res!=NULL){
            $rc=$res->rowCount();
            return $res;
        }
        else{
            return NULL;
        }
        
    while ($data = $requete->fetch(PDO::FETCH_ASSOC)) {
            print_r ($data);
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
    //phpinfo();
    $test1= new Connection('localhost','FirstDate_base','root','go93han');
    //$pp=$test1->query('SELECT COUNT(*) as nb FROM likes');
    $pp=$test1->query('SELECT * as nb FROM likes');
    echo $test1->count($pp)."<br/><hr/>";
    $pp=$test1->query('SELECT COUNT(*) as nb FROM likes');
    echo $test1->count($pp)."<br/><hr/>";
    $pp=$test1->query("DESCRIBE FirstDate_base");
    echo "FINI"."<br\>";
     
     
     
  /*
    $bdd='';
    try
    {
         //    $bdd = new PDO('mysql :host='.$server.:3306';dbname='.$db.'', $user, $mdp);   
         $bdd = new PDO('mysql:host=localhost;dbname=FirstDate_base', 'root', 'go93han');
    }
        catch (Exception $e)
    {
        die('Erreur ICI : ' . $e->getMessage());

    }
    echo "Connected successfully";


$s=$bdd->query('SELECT COUNT(*) as nb FROM likes');
if ($s!=NULL){
    $rc=$s->rowCount();
    echo $rc.' rows selected:NIGGA11';
}
else{
    echo "balot";
    }
echo "fini";
$reponse->closeCursor(); // Termine le traitement de la requête

*/ 
?>
</body>
</html> 
