<!-- ----- debut ModelCreneau -->

<?php
require_once 'Model.php';

class ModelCreneau {
 private $id, $projet, $examinateur, $creneau;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id = NULL, $projet = NULL, $examinateur = NULL, $creneau = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($id)) {
   $this->id = $id;
   $this->projet = $projet;
   $this->examinateur = $examinateur;
   $this->creneau = $creneau;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setProjet($projet) {
  $this->projet = $projet;
 }

 function setExaminateur($examinateur) {
  $this->examinateur = $examinateur;
 }

 function setCreneau($creneau) {
  $this->creneau = $creneau;
 }

 function getId() {
  return $this->id;
 }

 function getProjet() {
   return $this->projet;
 }

 function getExaminateur() {
   return $this->examinateur;
 }

 function getCreneau() {
   return $this->creneau;
 }

 
 public static function getMany($query) {
  try {
   $database = Model::getInstance();
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCreneau");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from creneau";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCreneau");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from creneau where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCreneau");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function creneauxGetAllByExaminateur($examinateur_id)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT
                        c.id AS creneau_id,
                        c.creneau AS creneau,
                        p.label AS label, 
                        pe.nom AS examinateur,
                        pr.nom AS responsable
                    FROM
                        creneau AS c
                    JOIN
                        projet AS p ON c.projet = p.id
                    JOIN
                        personne AS pe ON c.examinateur = pe.id
                    LEFT JOIN 
                        personne AS pr ON p.responsable = pr.id 
                    WHERE
                        c.examinateur = :examinateur_id
                    ORDER BY
                        c.creneau;"; 

            $stmt = $database->prepare($query);
            $stmt->bindParam(':examinateur_id', $examinateur_id, PDO::PARAM_INT);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère les résultats
            return $results;

        } catch (PDOException $e) {
            error_log("Erreur dans creneauxGetAllByExaminateur: " . $e->getMessage());
            return [];
        }
    }
    
    public static function creneauByProjet($id,$projet_label) {
        try {
            $database = Model::getInstance();
            $query = "SELECT
                        c.id AS creneau_id,
                        c.creneau AS creneau,
                        p.label AS label,
                        pe.nom AS examinateur,
                        pr.nom AS responsable
                      FROM
                        creneau AS c
                      JOIN
                        projet AS p ON c.projet = p.id
                      JOIN
                        personne AS pe ON c.examinateur = pe.id
                      LEFT JOIN 
                        personne AS pr ON p.responsable = pr.id 
                      WHERE
                        c.examinateur = :id AND p.label = :projet_label
                      ORDER BY
                        c.creneau;"; 

            $stmt = $database->prepare($query);
            $params = [
                ':id' => $id,
                ':projet_label' => $projet_label
            ];

            $stmt->execute($params);

            $results = $stmt->fetchAll(); 
            return $results;

        } catch (PDOException $e) {
            error_log("Erreur dans creneauxByProjet: " . $e->getMessage());
            return [];
        }
    }
    
    public static function insertCreneau($projetId, $examinateurId, $creneauDatetime) {
        try {
            $database = Model::getInstance();
            $query_max_id = "SELECT MAX(id) FROM creneau";
            $statement = $database->query($query_max_id);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;
            
            
            $queryInsert = "INSERT INTO creneau (id, projet, examinateur, creneau) VALUES (:id, :projet_id, :examinateur_id, :creneau_datetime)";
            $stmtInsert = $database->prepare($queryInsert); 

            $stmtInsert->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtInsert->bindParam(':projet_id', $projetId, PDO::PARAM_INT);
            $stmtInsert->bindParam(':examinateur_id', $examinateurId, PDO::PARAM_INT);
            $stmtInsert->bindParam(':creneau_datetime', $creneauDatetime, PDO::PARAM_STR);

            $success = $stmtInsert->execute();
            if ($success) {
                error_log("Insertion du créneau réussie.");
            } else {
                
                error_log("Échec de l'insertion du créneau. Erreur PDO: " . var_export($stmtInsert->errorInfo(), true));
            }
            return $id;

        } catch (PDOException $e) {
            error_log("Erreur lors de l'insertion du créneau : " . $e->getMessage());
            return NULL;
        }
    }


    public static function update() {
  echo ("ModelCreneau : update() TODO ....");
  return null;
 }

 public static function delete($id) {
  try {
   $database = Model::getInstance();
   $query = "delete from creneau where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id
   ]);
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }


 public static function selectByProjet($projet_id) {
  try {
    $database = Model::getInstance();
    $query = "SELECT c.creneau AS creneau_datetime, p.nom AS examinateur_nom, p.prenom AS examinateur_prenom, c.id AS creneau_id
              FROM creneau c 
              INNER JOIN personne p ON c.examinateur = p.id 
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

}
?>
<!-- ----- fin ModelCreneau -->
