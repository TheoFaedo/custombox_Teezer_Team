<?php
namespace custombox\autres;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Illuminate\Database\Capsule\Manager as DB;



class FonctionsBdd{

    public static $dbconfig;

    /**
     * Permet de créer une connection si il n'y en a pas déjà une
     */
    static function creerConnection(){
        $db = new DB();

        $db->addConnection(FonctionsBdd::$dbconfig);
 
        $db->setAsGlobal();
        $db->bootEloquent(); //On lance Eloquent

        return $db;
    }
}