<?php
namespace custombox\controleurs;

require 'vendor/autoload.php';

use custombox\vues\VueCreerProduit;

class CreerProduitControlleur {

    private $container;

    public function __construct($container){
        
        $this->container = $container;
        
    }
    
    public function getPage($rq, $rs, $args) {
        $v = new VueCreerProduit($rq);
        $rs->getBody()->write($v->render());
        return $rs;
    }
}