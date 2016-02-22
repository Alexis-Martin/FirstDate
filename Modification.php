<?php

require 'Connection.php';

class Modification{
      private $_id;
      private $_conn;

  public function __construct($id){
    $this->_conn=new Connection('localhost', 'FirstDate_base', 'root', 'irahebbdlms');
    $this->_id=$this->_conn->getBDD()->quote($id);
    }

    public function getBDD(){
        return $this->_conn->getBDD();
    }

  public function setAll($name,$bio,$birth,$gen,$loc,$rel,$int){
    $ask = "SELECT name_users, bio_users, birthday_users, gender_users, location_users, relation_users, interested_users FROM users WHERE id_fb_users=" . $this->_id;
    $res=$this->_conn->query($ask);
    $data = $res->fetch(PDO::FETCH_ASSOC);


    $upd = "UPDATE users SET ";
    $exist = false;
    $suiv = false;
    if('\'' . $data['name_users'] . '\'' != $name){
      $upd .= "name_users=" . $name . ", mv_name_users=1";
      $exist = true;
      $suiv = true;
    }
    if('\'' . $data['bio_users'] . '\'' != $bio){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "bio_users=" . $bio . ", mv_bio_users=1";
      $exist = true;
      $suiv = true;
    }
    if('\'' . $data['birthday_users'] . '\'' != $birth){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "birthday_users=" . $birth . ", mv_birthday_users=1";
      $exist = true;
      $suiv = true;
    }
    if('\'' . $data['gender_users'] . '\'' != $gen){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "gender_users=" . $gen . ", mv_gender_users=1";
      $exist = true;
      $suiv = true;
    }
    if('\'' . $data['location_users'] . '\'' != $loc){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "location_users=" . $loc . ", mv_location_users=1";
      $exist = true;
      $suiv = true;
    }
    if('\'' . $data['relation_users'] . '\'' != $rel){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "relation_users=" . $rel . ", mv_relation_users=1";
      $exist = true;
      $suiv = true;
    }
    if('\'' . $data['interested_users'] . '\'' != $int){
      if($suiv == true){
        $upd .= ", ";
      }
      $upd .= "interested_users=" . $int . ", mv_interested_users=1";
      $exist = true;
    }
    $upd .= " WHERE id_fb_users=".$this->_id;

    if($exist == true){
      echo $upd;
      $this->_conn->query($upd);
    }
  }

  public function get_all(){
    $res=$this->_conn->query("select id_fb_users, name_users, bio_users, birthday_users, gender_users, location_users, relation_users, interested_users from users where id_fb_users=".$this->_id);


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
