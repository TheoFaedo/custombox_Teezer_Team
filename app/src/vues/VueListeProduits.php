<?php
namespace custombox\vues;

use custombox\autres\IntegrateurBdd;


class VueListeProduits{

    private $rq;
    private $prod;

    public function __construct($rq, $prod){
        $this->rq = $rq;
        $this->prod = $prod;
    }

    public function render(){

        $BaseUrl = $this->rq->getUri()->getBasePath();

        $listeProduits = "";

        foreach ($this->prod as $key => $value) {
            $listeProduits = $listeProduits . <<<END
            produit.ajouterProduit({id: '$value->id',
                titre: '$value->titre',
                description: "$value->description",
                categorie: '$value->categorie',
                poids: '$value->poids',
            });
            END;
        }

        

        


        $html = <<<END
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="utf-8">
            <title>TD2</title>
            <link rel="stylesheet" href="$BaseUrl/css/reset.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
            <link rel="stylesheet" href="$BaseUrl/css/cart.css">
        </head>

        <body>

            <header>
                <span class="mdi mdi-magnify">
                    <input type="text" id="product-search" placeholder="Rechercher un produit" />
                </span>
                <img src="$BaseUrl/images/Logos/print-logo-noir-petit.png">
            </header>


            <main>
                <section id="products-wrapper">
                    <div id="product-list">
                        <!-- zone d'insertion des produits -->

                        <div class="product">
                            <div class="photo">
                                <img src="$BaseUrl/images/categories/1.png">
                                <a class="product-add2cart">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                            <div class="details">
                                <div class="details-top">
                                    <strong class="bigger" data-type="ref">#REF1</strong>
                                    <strong class="bigger" data-type="price">123g</strong>
                                </div>
                                <div class="details-description">
                                    le super produit 1
                                </div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="photo">
                                <img src="$BaseUrl/images/categories/2.png">
                                <a class="product-add2cart">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                            <div class="details">
                                <div class="details-top">
                                    <strong class="bigger" data-type="ref">#REF1</strong>
                                    <strong class="bigger" data-type="price">123g</strong>
                                </div>
                                <div class="details-description">
                                    le super produit 1
                                </div>
                            </div>
                        </div>


                    </div>
                </section>
            </main>

            <div class="BG">
            </div>


            <script src="https://kit.fontawesome.com/d4cd47c0a4.js" crossorigin="anonymous"></script>
        
        </body>

        <script type="module">
        import produit from "$BaseUrl/js/module/produit.js";
        import ui from "$BaseUrl/js/module/ui.js";

        function inject(){
            $listeProduits
            console.log(produit.products)
        }
        inject();

        export default{
            inject
        }

        let enter = document.getElementById("product-search");

        enter.addEventListener("keyup", (e) => {
            if (e.keyCode === 13){
                console.log(produit.search(enter.value));
                ui.buildProductsList(produit.search(enter.value));
            }
        });

        
        </script>
        <script type="module" src="$BaseUrl/js/script.js"></script>

        </html>
        END ;

        return $html;
    }
}
