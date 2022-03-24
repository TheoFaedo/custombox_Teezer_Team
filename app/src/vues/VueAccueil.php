<?php
namespace custombox\vues;

use custombox\autres\IntegrateurBdd;


class VueAccueil{

    private $rq;

    public function __construct($rq){
        $this->rq = $rq;
    }

    public function render(){

        $BaseUrl = $this->rq->getUri()->getBasePath();


        $html = <<<END
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CustomBox</title>
            <link rel="stylesheet" href="$BaseUrl/css/reset.css">
            <link rel="stylesheet" href="$BaseUrl/css/style-acceuil.css">
        </head>

        <body>

            <section>

                <div class="box">
                    <img class="image" src="$BaseUrl/images/Logos/logogrand.png">
                    <div class="container">
                        <div class="btn"><a href="$BaseUrl/listeProduits">Voir nos produits</a></div>
                    </div>
                </div>
            </section>


            <div class="BG">
            </div>

        </body>
        </html>
        END ;

        return $html;
    }
}
