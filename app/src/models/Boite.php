<?php

namespace custombox\models;

class Boite extends \Illuminate\Database\Eloquent\Model{
    
    public $timestamps = false;

    protected $table = 'createur';
    protected $primaryKey = 'idCreateur';
    

    protected $idCreateur;
    protected $pseudo;
    protected $password;
    protected $email;
    
    /*
    public function liste(){
        return $this->belongsTo('\models\liste', 'liste_id');
    }*/

    
    /*public function parties(){
        return $this->hasMany('\models\', 'liste_id');
    }*/
    
}