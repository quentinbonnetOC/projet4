<?php

/**
 * connexion à la bdd
 */
abstract class Bdd{

    public function dbConnect(){
        //return new PDO('mysql:host=localhost; dbname=projet4; charset=utf8', 'tmP9u&EPcmp8M', '$^7AN6&qePrdRz7Y');
        return new PDO('mysql:host=localhost; dbname=projet4; charset=utf8', 'quentin', '0306LOVe!');
    }
}
