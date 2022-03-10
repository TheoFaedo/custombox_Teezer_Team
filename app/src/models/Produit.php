<?php

namespace custombox\models;

use custombox\models\Categorie;

class Produit extends \Illuminate\Database\Eloquent\Model{
    
    public $timestamps = false;

    protected $table = 'produit';
    protected $primaryKey = 'id';

    public function boite(){
        return Boite::where('poidsmax', '<', $this->poids)->first();
    }

    public function categorie(){
        return $this->belongsTo('custombox\models\Categorie', 'id')->first();
    }
}