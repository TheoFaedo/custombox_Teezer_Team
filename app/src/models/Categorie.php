<?php

namespace custombox\models;

class Categorie extends \Illuminate\Database\Eloquent\Model{
    
    public $timestamps = false;

    protected $table = 'categorie';
    protected $primaryKey = 'id';
    
    public function produits(){
        return $this->hasMany('\models\Produit', 'categorie');
    }
    
}