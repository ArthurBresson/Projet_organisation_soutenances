<!-- ----- debut ModelRdv -->

<?php
require_once 'Model.php';

class ModelRdv {
 private $id, $creneau, $etudiant;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id = NULL, $creneau = NULL, $etudiant = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($id)) {
   $this->id = $id;
   $this->creneau = $creneau;
   $this->etudiant = $etudiant;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setCreneau($creneau) {
  $this->creneau = $creneau;
 }

 function setEtudiant($etudiant) {
  $this->etudiant = $etudiant;
 }

 function getId() {
  return $this->id;
 }

 function getCreneau() {
  return $this->creneau;
 }

 function getEtudiant() {
  return $this->etudiant;
 }

 
 public static function getMany($query) {
  try {
   $database = Model::getInstance();
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRdv");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from rdv";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRdv");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from rdv where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRdv");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }



 public static function selectByProjet($projet_id) {
    try {
        $database = Model::getInstance();
        $query = "SELECT 
                    r.id AS rdv_id,
                    r.creneau,
                    r.etudiant,
                    etu.nom AS etudiant_nom,
                    etu.prenom AS etudiant_prenom,
                    ex.nom AS examinateur_nom,
                    ex.prenom AS examinateur_prenom,
                    c.creneau AS creneau_datetime,
                    c.id AS creneau_id
                  FROM rdv r
                  JOIN creneau c ON r.creneau = c.id
                  JOIN personne etu ON r.etudiant = etu.id
                  JOIN personne ex ON c.examinateur = ex.id
                  WHERE c.projet = :projet_id";
        $statement = $database->prepare($query);
        $statement->execute([
            'projet_id' => $projet_id
        ]);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
 }

 
 public static function rdvGetAll($etudiantId) {
     try{
     $database = Model::getInstance();
     $query = "SELECT
                    etu.nom AS nom_etudiant,
                    p.label AS label_projet,        
                    c.id AS creneau_id,             
                    c.creneau AS creneau_creneau, 
                    pe.nom AS nom_examinateur     
                FROM
                    rdv AS r                        
                JOIN
                    creneau AS c ON r.creneau = c.id 
                JOIN
                    personne AS etu ON r.etudiant = etu.id
                JOIN
                    projet AS p ON c.projet = p.id  
                JOIN
                    personne AS pe ON c.examinateur = pe.id 
                WHERE
                    r.etudiant = :etudiant_id       
                ORDER BY
                    c.creneau;";
     $statement = $database->prepare($query);
     $statement->bindParam(':etudiant_id', $etudiantId, PDO::PARAM_INT);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
    } catch (PDOException $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;
    }
 }





 public static function update() {
  echo ("ModelRdv : update() TODO ....");
  return null;
 }

 public static function delete() {
  echo ("ModelRdv : delete() TODO ....");
  return null;
 }



 public static function insert($creneau, $etudiant) {
  try {
   $database = Model::getInstance();

   // recherche de la valeur de la clé = max(id) + 1
   $query = "select max(id) from rdv";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;


   // vérifier que toutes les données sont correctes
   if ($creneau == NULL || $etudiant == NULL) {
    return -2; // fin de la fonction
   }

   // ajout d'un nouveau tuple;
   $query = "insert into rdv value (:id, :creneau, :etudiant)";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id,
     'creneau' => $creneau,
     'etudiant' => $etudiant
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

}
?>
<!-- ----- fin ModelRdv -->
