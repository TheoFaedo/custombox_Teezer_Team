import baseUrlScript from "./baseUrlScript.js";

/**
 * fonction qui retourne un html représentant un produit
 * @param {*} produit : produit dont on souhaite obtenir la réprésentation html
 * @returns : représentation html du produit
 */
function displayProduct(produit){

    let res = ""
    res+=`
    <div class="photo">
        <img src="${baseUrlScript.getBaseUrl()}/images/produits/${produit.id}.jpg">
        <a class="product-add2cart">
            <i class="fa fa-eye"></i>
        </a>
    </div>
    <div class="details">
        <div class="details-top">
            <strong class="bigger" data-type="ref">${produit.titre}</strong>
            <strong class="bigger" data-type="price">${produit.poids}g</strong>
        </div>
        <div class="details-description">
            ${produit.description}
        </div>
    </div>`


    return res;
}

/**
 * fonction qui affiche la liste des produits
 * @param {*} produits : liste des produits qu'on souhaite afficher sur la page
 * @param {*} cb : fonction s'éxécutera lors du click sur le bouton ajouter au panier
 */
function buildProductsList(produits, cb){
    let tempNode;

    let dom = document.querySelector("#product-list");

    dom.innerHTML ="";

    produits.forEach((e) => {
        tempNode = document.createElement("div");
        tempNode.innerHTML = displayProduct(e);
        tempNode.classList.add("product");
        tempNode.querySelector("a").onclick = (evnt) => {
            cb(evnt, e);
        };
        
        dom.appendChild(tempNode);
    });  
    
}



export default{
    buildProductsList,
}