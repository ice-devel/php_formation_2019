<?php
/**
 * Héritage
 */
function getEntity($class) {
    $file = "Entity/".$class.".php";
    if (file_exists($file)) {
        require $file;
    }
}
spl_autoload_register('getEntity');

$being = new Being();
$being->setSize(100);
$being->perish();
var_dump($being);
echo "<br>";

$human = new Human();
$human->setSize(200);
$human->perish();
var_dump($human);
echo "<br>";

$rose = new Rose();
$rose->setSize(30);
$rose->perish();
var_dump($rose);
echo "<br>";

$developer = new Developer();
$developer->setSize(160);
$developer->code();
$developer->perish();
$developer->code();
var_dump($developer);
echo "<br>";

$astronaut = new Astronaut();
$astronaut->setSize(180);
$astronaut->gravity();
echo $astronaut->getSize();
// echo $astronaut->coordinates; // propriété protected donc pas d'accès en dehors des classes
var_dump($astronaut);
echo "<br>";
