import box from "./box"

class Commande{

    constructor(box ){
        this.box = box
    }

}


function ajouterProduit(prod){
    box.poids += prod.poids
    if (box.poids <= box.poids_max){
        box.push(produit)
    }else{
        box.poids -= prod.poids
    }
}


export default{
    ajouterProduit
}