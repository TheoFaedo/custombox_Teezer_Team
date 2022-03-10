let products = [];

class Produit{

    constructor(id, titre, desc, cat, poids, img){
        this.id = id
        this.titre = titre
        this.description = desc
        this.categorie = cat
        this.poids = poids
        this.image = img
    }
}

function ajouterProduit(prod){
    products.push(prod);
}

export default{
    Produit,
    ajouterProduit,
    search,
    products
}

function search(keywords){
    let tableauf = this.products.filter(function (research) {
        return (research.titre.includes(keywords) || research.description.includes(keywords));
    });
    return tableauf;
}








