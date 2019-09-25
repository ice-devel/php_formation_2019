<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 25/09/2019
 * Time: 15:32
 */

class Developer extends Human
{
    public function code() {
        if (!$this->getisDead()) {
            echo htmlentities("<?php echo 'salut'; ?>");
        }
        else {
            echo "...";
        }
    }
}