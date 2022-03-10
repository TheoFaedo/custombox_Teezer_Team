<?php
namespace custombox\controleurs;

require 'vendor/autoload.php';

use custombox\vues\VueAccueil;

class AccueilController {

    private $container;

    public function __construct($container){
        
        $this->container = $container;
        
    }
    
    public function getPage($rq, $rs, $args) {
        $v = new VueAccueil($rq);
        $rs->getBody()->write($v->render());
        return $rs;
    }
}
