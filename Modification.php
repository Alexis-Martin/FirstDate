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
  public function get_all(){
    $res=$this->_conn->query("select * from users where id_users=".$this->_id); 
    
    /*
            while ($data = $res->fetch(PDO::FETCH_NUM)) {
                    print_r ($data);
                    //echo $data[0]."<br>"; 
            }
    */
    
    return $res;
   
   }
   
}
  echo "de bat1'";
  $test= new Modification(1);
  echo "de bat'2";
  $test->setAll("Petek","Bioinformatique","Marseille","Shemale","Paris","Complicated","AllSpecies");
  echo "de bat'3";
  $req=$test->get_all();


/*
while ($data = $res->fetch(PDO::FETCH_ASSOC)) {
                    print_r ($data);
                    echo $data[$type]."<br>"; 
                }
*/
?>

