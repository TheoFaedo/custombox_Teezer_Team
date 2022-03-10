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
        IntegrateurBdd::integrerNouveauxMorceaux("musique/");


        $html = <<<END
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Teezer</title>
            <link rel="stylesheet" href="css/reset.css">
            <link rel="stylesheet" href="css/style_MAIN.css">
            <link rel="stylesheet" href="css/style_index.css">
            <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        </head>

        <body>
            <div class="loader">
                <div class="load"></div>
                <div class="load"></div>
                <div class="load"></div>
            </div>
            <script src="js/loader.js" charset="utf-8"></script>
        
            <section>

            <video muted loop id="bgv">
                <source src="videos/Backround_video.mp4" type="video/mp4">
            </video>
            <script src="js/video.js" charset="utf-8"></script>

                <div class="box">
                    <img class="image" src="images/Horizontal_BC.png">
                    <div class="container">
                        <div class="btn"><a href="$BaseUrl/creerPartie">Créer une partie</a></div>
                    </div>
                </div>
            </section>
        </body>
        </html>
        END ;

        return $html;
    }
}
