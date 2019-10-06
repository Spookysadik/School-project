<?php
// Indique le domène de travail 
namespace Models;
//utilise le fichier models.php
use classes\Models;

class JdrService {

    private $models;
    private $errors = [];
//constructeur
    public function __construct(Models $models) {
        $this->models = $models;
    }
    // Selection de la base de donnée
    public function getByGenr($genr) {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT jeu_nom 
                    FROM jeu 
                    WHERE jeu_genr = :genr'
        );
        $query->execute([
            'genr' => $genr
        ]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
// Récupère une information dans la base de donnée
    public function getAllResaByDate($date) {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT resa_heure_deb, resa_heure_fin 
                    FROM resa_jdr
                    WHERE resa_jour = :date'
        );
        $query->execute([
            'date' => $date->format("Y-m-d")
        ]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertNewResa($name, $tel, $day, $heure_deb, $heure_fin) {
        //on insert en Bdd
        $insert = $this->getModels()->getBdd()->prepare("INSERT INTO resa_jdr (resa_nom, resa_jour, resa_heure_deb, resa_heure_fin, resa_tel) VALUES (:name, :day, :heure_deb, :heure_fin, :tel)");

        $insert->execute([
            'name' => $name,
            'day' => $day->format("Y-m-d"),
            'heure_deb' => $heure_deb->format("H:i:s"),
            'heure_fin' => $heure_fin->format("H:i:s"),
            'tel' => $tel,
        ]);
    }

    /**
     * @return Models
     */
    public function getModels() {
        return $this->models;
    }

    /**
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors) {
        $this->errors[] = $errors;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

