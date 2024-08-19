<?php

require_once('POO/classes/perso.php');

$p = new Personnage();
$p->setNommage("Lebowski");
$p->setPrenomage("Jeff");
$p->setAge("30");
$p->setGenre("masculin");

//var_dump($p);
 foreach($p as $key =>$value){
    echo $key." : ".$value."<br>";
 };

?>