<?php

namespace custombox\vues;

use custombox\autres\IntegrateurBdd;


class VueCreerProduit{

    private $rq;
    private $prod;

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
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
            <link rel="stylesheet" href="$BaseUrl/css/style_index.css">

        </head>


        <body> 

            <form>

                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre"/>

                <br/>
                <label for="description">Description du produit</label><br/>
                <textarea name="description" id="description"></textarea>
                <br/>
            
                <label for="categorie">Categorie de la box :</label>
                <select name="cat" id="categorie">
                    <option value="">Choisissez une catégorie</option>
                    <option value="1">Catégorie 1</option>
                    <option value="2">Catégorie 2</option>
                    <option value="3">Catégorie 3</option>
                    <option value="4">Catégorie 4</option>
                    <option value="5">Catégorie 5</option>
                </select>
                
                <br/>
                <label for="poids">Poids du produit</label>
                <input type="number" id="poids" name="poids" step="0.1" min="0.1" max="3.2">
                <br/>
                <input type="submit" value="Creer le Produit">
            
            </form>

        </body>

        </html>
        END ;

        return $html;
    }
}
