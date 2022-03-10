<?php

namespace custombox\models;

class Produit extends \Illuminate\Database\Eloquent\Model{
    
    public $timestamps = false;

    protected $table = 'produit';
    protected $primaryKey = 'id';

    public function boite(){
        return Boite::where('poidsmax', '<', $this->poids)->first();
    }
}