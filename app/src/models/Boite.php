<?php

namespace custombox\models;

class Boite extends \Illuminate\Database\Eloquent\Model{
    
    public $timestamps = false;

    protected $table = 'boite';
    protected $primaryKey = 'id';

    public function produits(){
        return $this->belongsTo('\models\Categorie', 'id');
    }
    
}