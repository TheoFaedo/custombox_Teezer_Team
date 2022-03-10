<?php
/**
 * 
 * Fichier index contenant toutes les requetes possible et ce qu'elles execute en consequence
 * 
 */

require 'vendor/autoload.php';


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use custombox\autres\FonctionsBdd;

use custombox\controleurs\AccueilController;
use custombox\controleurs\ListeProduitsController;

$c = new \Slim\Container(['settings'=>['displayErrorDetails'=>true]]);

$app = new \Slim\App($c);

/**
 * ROUTE PAGE ACCUEIL
 */
$app->get('/', function( $rq, $rs, $args ) {
    FonctionsBdd::$dbconfig = parse_ini_file("db.config.ini");
    $cont= new AccueilController($this) ;

    return $cont->getPage( $rq, $rs, $args );
});


$app->get('/listeProduits[/]', function( $rq, $rs, $args ) {
    FonctionsBdd::$dbconfig = parse_ini_file("db.config.ini");
    $cont= new ListeProduitsController($this) ;

    return $cont->getPage($rq, $rs, $args);
});


$app->run();