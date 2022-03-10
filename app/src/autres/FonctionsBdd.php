<?php
namespace teezer\autres;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Illuminate\Database\Capsule\Manager as DB;

use teezer\models\Musique;
use teezer\models\Partie;
use teezer\models\MusiquePartie;
use teezer\models\ScorePartie;

class FonctionsBdd{

    /**
     * Permet de créer une connection si il n'y en a pas déjà une
     */
    static function creerConnection(){
        $db = new DB();

        $db->addConnection(IntegrateurBDD::$dbconfig);
 
        $db->setAsGlobal();
        $db->bootEloquent(); //On lance Eloquent

        return $db;
    }

    /**
     * Permet de créer une nouvelle partie à partir du genre placé en paramètre de cette fonction
     */
    static function creerNouvellePartie($genre, $annee){
        
        $db = FonctionsBdd::creerConnection();

        //Creation de la liste des musiques en fonction des paramètres voulus
        $listeMusiques = Musique::inRandomOrder()->where('genre', '=', $genre)->where('annee', '>=', $annee)->where('annee', '<', $annee+10)->limit(3)->get();

        //Creation de la partie
        $partie = new Partie();
        $partie->genre = $genre;
        $partie->annee = $annee;
        $partie->nbMusiques = 3;
        $partie->save();

        

        //Creation du token de la partie
        $partie->token = base_convert(hash('sha256', time() . $partie->idPartie), 16, 36);;
        $partie->save();
        


        $musiquePartie;
        //Ajout de l'association partie/musique
        foreach ($listeMusiques as $value) {
            $musiquePartie = new MusiquePartie();
            $musiquePartie->idPartie = $partie->idPartie;
            $musiquePartie->idMusique = $value->idMusique;
            $musiquePartie->save();
        }

        return $partie->token;
    }

    /**
     * fonction qui permet de récupérer l'id d'une partie à partir de son token
     */
    static function recupIdPartie($token){

        $db = FonctionsBdd::creerConnection();

        $partie = Partie::where('token', '=', $token)->first();
        return $partie->idPartie;
    }

    /***
     * fonction qui permet de récupérer la liste des musiques d'une partie à partir de son id
     */
    static function recupListeMusiques($idPartie){

        $db = FonctionsBdd::creerConnection();

        $musiqueparties = MusiquePartie::where('idPartie','=',$idPartie)->get();

        $idmusiques = array();
        foreach ($musiqueparties as $value) {
            array_push($idmusiques, $value->idMusique);
        }

        
        $listeMusiques = array();
        foreach ($idmusiques as $value) {
            array_push($listeMusiques, Musique::where('idMusique', '=', $value)->first());
        }

        return $listeMusiques;
    }

    static function recupClassement($pseudo, $partie){
        $db = FonctionsBdd::creerConnection();
        $classementPartie = ScorePartie::orderBy('score', 'DESC')->where('idPartie',  '=', $partie)->limit(5)->get();
        $partieActuelle = ScorePartie::where('pseudo', '=', $pseudo)->where('idPartie', '=', $partie)->first();
        return $partieActuelle;
    }

    /****************************************
     * 
     * 
     *      FONCTIONS CONVERTION EN JAVASCRIPT
     * 
     * 
     ***************************************/

    static function recupListeReponses($listeMusiques){
        $db = FonctionsBdd::creerConnection();
        $res = "";
        foreach($listeMusiques as $value){
            $res = $res . 'res.push({titre: "' . $value->titreMusique . '", artiste: "' . $value->nomArtiste . '"});';
        }
        return $res;
    }

    static function recupListeRepertoires($listeMusiques){
        $db = FonctionsBdd::creerConnection();
        $res = 'sounds.push({src:"../musique/son_bonne_reponse.mp3", id:"101"});';
        $i=1;
        
        foreach($listeMusiques as $value){
            $res = $res . 'sounds.push({src:"../musique/' . $value->nomMusique . '", id:"' . $i . '"});';
            $i++;
        }
        return $res;
    }
     
}