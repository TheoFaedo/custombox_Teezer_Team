<?php
/*
 * Cette classe a pour but d'automatiser l'importation des musiques dans la base de données
 * La but final est de l'utiliser à chaque fois que le joueur voudra créer une nouvelle partie.
 */

namespace teezer\autres;

require 'vendor/james-heinrich/getid3/getid3/getid3.php'; //Importation d'une librairie permettant la lecture de tags id3



use teezer\models\Musique;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Illuminate\Database\Capsule\Manager as DB;

class IntegrateurBdd{

    static $dbconfig; //array de toutes les informations de la base de données

    static function integrerNouveauxMorceaux($repertoire){
        
        $db = new DB();

        $db->addConnection(IntegrateurBDD::$dbconfig);
 
        $db->setAsGlobal();
        $db->bootEloquent(); //On lance Eloquent

        $musiqueFichiers = IntegrateurBDD::recupererNomFichiers($repertoire); //Array contenant touts les noms de musiques dans le repertoire musique

        $musiqueBDD = Musique::select('nomMusique')->get(); //Array contenant toutes les musiques de la base de données

        $arrayMusiqueBDD = array();

        //On transforme musiqueBDD en array
        foreach($musiqueBDD as $musique){
            array_push($arrayMusiqueBDD, $musique->nomMusique);
        }


        //On importe dans la base de données toutes les musiques qui n'y sont pas
        foreach($musiqueFichiers as $key => $value){

            //La base de donnée n'accepte que des noms de fichiers en dessous de 90 caractères
            //Donc on ne prend pas en compte les musiques dont le nom contient plus de 90 caractères
            if(strlen($value) > 90){
                break;
            }

            if(!in_array($value, $arrayMusiqueBDD)){//On vérifie si la musique courante n'est pas dans la bdd
                $metadata = IntegrateurBdd::metadata_mp3("musique/" . $value);

                $musique = new Musique();
                $musique->nomMusique = $value;
                $musique->nomArtiste = $metadata['artiste'];
                $musique->titreMusique = $metadata['titre'];
                $musique->genre = $metadata['genre'];
                $musique->annee = $metadata['annee'];

                $musique->save();
            }
        }
            
    }


    /**
     * Methode permettant de récupérer le nom de tout les fichiers d'un repertoire placé en paramètre
     */
    static function recupererNomFichiers($repertoire){
        $tabRes = array();
        if ($handle = opendir($repertoire)) {
            
            /* Ceci est la façon correcte de traverser un dossier. */
            while (false !== ($entry = readdir($handle))) {
                if($entry !== '.' && $entry !== '..'){
                    array_push($tabRes, $entry);
                }
            }
            closedir($handle);
        }

        return $tabRes;
    }

    /**
     * Méthode permettant de récupérer un certain nombres d'informations à partir des tags id3 d'un fichier dont le chemin
     * associé est placé en paramètre
     */
    static function metadata_mp3($file)
    {
            // Initialisation de getID3
            $getID3 = new \getID3();

            //Analyse le fichier et met les informations dans une array
            $ThisFileInfo = array ();
            $ThisFileInfo = $getID3->analyze($file);
            
            /*echo "<p>";
            print_r($ThisFileInfo);
            echo "</p>";

            echo "<br/>";*/
            
            
            return array ('titre' => $ThisFileInfo['tags']['id3v2']['title'][0], 'artiste' => $ThisFileInfo['tags']['id3v2']['artist'][0], 'genre' => $ThisFileInfo['tags']['id3v2']['genre'][0], 'annee' => $ThisFileInfo['tags']['id3v2']['year'][0],'path' => $file);

            
    }


    


}


