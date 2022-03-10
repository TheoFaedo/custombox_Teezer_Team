<?php
namespace custombox\controleurs;

require 'vendor/autoload.php';

use custombox\autres\FonctionsBdd;

use custombox\vues\VueListeProduits;

use custombox\models\Produit;

class ListeProduitsController {

    private $container;

    public function __construct($container){
        
        $this->container = $container;
        
    }
    
    public function getPage($rq, $rs, $args) {

        $db = FonctionsBdd::creerConnection();

        $produits = Produit::all();

        $v = new VueListeProduits($rq, $produits);
        $rs->getBody()->write($v->render());
        return $rs;
    }
}
