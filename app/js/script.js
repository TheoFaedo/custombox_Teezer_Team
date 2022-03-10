import produit from "./module/produit.js";
import ui from "./module/ui.js";

function init(){
    console.log("a");
    ui.buildProductsList(produit.products);
}

init();

export default{
    init
}
