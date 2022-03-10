<?php
namespace custombox\controleurs;

require 'vendor/autoload.php';

use custombox\vues\VueProduits;

class ListeProduitsController {

    private $container;

    public function __construct($container){
        
        $this->container = $container;
        
    }
    
    public function getPage($rq, $rs, $args) {
        $v = new VueProduits($rq);
        $rs->getBody()->write($v->render());
        return $rs;
    }
}
