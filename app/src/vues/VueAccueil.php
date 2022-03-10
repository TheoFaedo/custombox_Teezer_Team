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
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CustomBox</title>
            <link rel="stylesheet" href="$BaseUrl/css/reset.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
            <link rel="stylesheet" href="$BaseUrl/css/style_index.css">
        </head>


        <body> 

            <div class="container">
                <h2>Produits</h2>
                <div class="row">
                    <a>$BaseUrl/listeProduits</a>
                    <div class="col-md-3">
                        <div class="product">
                            <img src="$BaseUrl/images/categories/1.png">
                            <div class="overlay">
                                <button type="button" class="btn btn-secondary" title="Voir plus">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-secondary" title="Ajouter">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </body>

        </html>
        END ;

        return $html;
    }
}
