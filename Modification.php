<?php

require 'Connection.php';


class Modification{

      private $_id;
      private $_conn;

  public function __construct($id){
    $this->_conn=new Connection('localhost','FirstDate_base','root','go93han');
    $this->_id=$id;
    }
    
  public function setAll($name,$bio,$birth,$gen,$loc,$rel,$int){
    $this->_conn->query("UPDATE users SET name_users = '".$name."', bio_users = '".$bio."',birthday_users = '".$birth."',gender_users = '".$gen."',location_users = '".$loc."',relation_users = '".$rel."',interested_users = '".$int."' WHERE id_users=".$this->_id);
  }
  
}  
    $test= new Modification(1);
  $test->setAll("Petek","Bioinformatique","Marseille","Shemale","Paris","Complicated","AllSpecies");
   
?>
