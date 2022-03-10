import produit from "./produit"
import box from "./box"

class Commande{

    constructor(box ){
        this.box = box
    }

}


function ajouterProduit(produit){
    box.poids += produit.poids
    if (box.poids <= box.poids_max){
        box.push(produit)
    }else{
        box.poids -= produit.poids
    }
}
