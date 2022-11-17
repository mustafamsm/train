<?php
 namespace A;
include __DIR__.'/autoload.php';
// use Person;


$person=new \A\B\Person;
$person2=new \B\Person;
$person->name="mustafa";
// $person2->name="ahmed";
 

 echo $person->name.'<br>';
//  echo $person2->name;



 