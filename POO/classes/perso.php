<?php

Class Personnage
{

public $_nom;
public $_prenom;
public $_age;
public $_sexe;

public function setNommage($nom){
    $this->_nom = $nom;
}



public function setPrenomage($prenom){
    $this->_prenom = $prenom;
}


public function setAge($age){
    $this->_age = $age;
}


public function setGenre($sexe){
    $this->_sexe = $sexe;
}


}
?>