<?php
/**
 * 
 * Fichier index contenant toutes les requetes possible et ce qu'elles execute en consequence
 * 
 */

require 'vendor/autoload.php';


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use custombox\controleurs\AccueilController;

$c = new \Slim\Container(['settings'=>['displayErrorDetails'=>true]]);

$app = new \Slim\App($c);

/**
 * ROUTE PAGE ACCUEIL
 */
$app->get('/', function( $rq, $rs, $args ) {
    IntegrateurBdd::$dbconfig = parse_ini_file("../../db.config.ini");

    $cont= new AccueilController($this) ;

   

    return $cont->getPage( $rq, $rs, $args );

    
});

/**
 * ROUTE PAGE JOUER PARTIE
 */
$app->get('/jouerPartie/{tokenPartie}[/]', function( $rq, $rs, $args ) {
    IntegrateurBdd::$dbconfig = parse_ini_file("../../db.config.ini");
    $cont= new JouerPartieController($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->post('/creerPartie[/]', function( $rq, $rs, $args ) {
    IntegrateurBdd::$dbconfig = parse_ini_file("../../db.config.ini");
    $cont= new CreerPartieController($this) ;

    return $cont->getPage($rq, $rs, $args, "cree");
});


$app->run();