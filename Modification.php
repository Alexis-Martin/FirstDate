<?php

require 'Connection.php';


class Modification{

      private $_id;
      private $_conn;

  public function __construct($id){
    $this->_conn=new Connection('localhost','FirstDate_base','root','go93han');
    $this->_id=$this->_conn->getBDD()->quote($id);
    }

    public function getBDD(){
        return $this->_conn->getBDD();
    }

  public function setAll($name,$bio,$birth,$gen,$loc,$rel,$int){
    $this->_conn->query("UPDATE users SET name_users = ".$name.", bio_users = ".$bio.",birthday_users = ".$birth.",gender_users = ".$gen.",location_users = ".$loc.",relation_users = ".$rel.",interested_users = ".$int." WHERE id_fb_users=".$this->_id);
  }
  public function get_all(){
    $res=$this->_conn->query("select * from users where id_fb_users=".$this->_id); 
    
    
            /*while ($data = $res->fetch(PDO::FETCH_NUM)) {
                    print_r ($data);
                    echo "2 ".$data[0]."<br>"; 
            }*/
    $data = $res->fetch(PDO::FETCH_NUM);
    
    return $data;
   
   }
   
}
/*
  echo "de bat1'";
  $test= new Modification(1);
  echo "de bat'2";
  $test->setAll("Petek","Bioinformatique","Marseille","Shemale","Paris","Complicated","AllSpecies");
  echo "de bat'3";
  $req=$test->get_all();
    echo " de bat 4 ".$req[3];*/

/*
while ($data = $res->fetch(PDO::FETCH_ASSOC)) {
                    print_r ($data);
                    echo $data[$type]."<br>"; 
                }
*/
?>

