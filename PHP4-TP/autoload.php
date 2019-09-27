<?php

function getEntity($class) {
    $file = "entity/".$class.".php";
    if (file_exists($file)) {
        require $file;
    }
}
spl_autoload_register('getEntity');

?>