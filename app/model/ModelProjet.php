<!-- ----- debut ModelProjet -->

<?php
require_once 'Model.php';

class ModelProjet {
 private $id, $label, $responsable, $groupe;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id = NULL, $label = NULL, $responsable = NULL, $groupe = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($id)) {
   $this->id = $id;
   $this->label = $label;
   $this->responsable = $responsable;
   $this->groupe = $groupe;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setLabel($label) {
  $this->label = $label;
 }

 function setResponsable($responsable) {
  $this->responsable = $responsable;
 }

 function setGroupe($groupe) {
  $this->groupe = $groupe;
 }

 function getId() {
  return $this->id;
 }

 function getLabel() {
  return $this->label;
 }

 function getResponsable() {
  return $this->responsable;
 }

 function getGroupe() {
  return $this->groupe;
 }

 
// retourne une liste des id
 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select id from projet";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getMany($query) {
  try {
   $database = Model::getInstance();
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProjet");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from projet";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProjet");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }


 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from projet where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProjet");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }


 public static function getProjetByResponsable($responsable_id) {
   try {
    $database = Model::getInstance();
    $query = "SELECT 
                  projet.label,
                  personne.nom,
                  personne.prenom,
                  projet.groupe
              FROM 
                  projet
              JOIN 
                  personne ON projet.responsable = personne.id
              WHERE 
                  projet.responsable = :responsable";


    $statement = $database->prepare($query);
    $statement->execute([
      'responsable' => $responsable_id
    ]);


    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;

   } catch (PDOException $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;
   }
 }

 public static function projetGetAll($examinateur_id) {
   try {
    $database = Model::getInstance();
    $query = "SELECT
                p.label AS label_projet,
                pe.nom AS nom_examinateur,
                p.groupe AS taille_groupe,
                c.creneau AS creneau
              FROM
                projet AS p
              JOIN
                creneau AS c
              ON
                p.id = c.projet
              JOIN
                personne AS pe
              ON
                c.examinateur = pe.id
              WHERE
                pe.id = :examinateur_id" ;


    $stmt = $database->prepare($query); 
    $stmt->bindParam(':examinateur_id', $examinateur_id, PDO::PARAM_INT); 
    $stmt->execute(); 

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    return $results;

   } catch (PDOException $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;
   }
 }
 
 public static function projetGetAllOnceForAll($examinateur_id) {
   try {
    $database = Model::getInstance();
    $query = "SELECT * FROM projet" ;


    $stmt = $database->prepare($query); 
    $stmt->execute(); 

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    return $results;

   } catch (PDOException $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;
   }
 }
 
 public static function projetGetAllOnce($examinateur_id) {
   try {
    $database = Model::getInstance();
    $query = "SELECT DISTINCT p.label AS label,
                        pe.nom,
                        p.groupe AS groupe,
                        pr.nom AS responsable
                      FROM
                        projet AS p
                      JOIN
                        creneau AS c ON p.id = c.projet
                       LEFT JOIN 
                        personne AS pr ON p.responsable = pr.id 
                      JOIN
                        personne AS pe ON c.examinateur = pe.id
                      WHERE
                        pe.id = :examinateur_id" ;


    $stmt = $database->prepare($query); 
    $stmt->bindParam(':examinateur_id', $examinateur_id, PDO::PARAM_INT); 
    $stmt->execute(); 

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    return $results;

   } catch (PDOException $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;
   }
 }


 public static function getProjetByResponsableWithId($responsable_id) {
   try {
    $database = Model::getInstance();
    $query = "SELECT 
                  projet.id,
                  projet.label,
                  personne.nom,
                  personne.prenom,
                  projet.groupe
              FROM 
                  projet
              JOIN 
                  personne ON projet.responsable = personne.id
              WHERE 
                  projet.responsable = :responsable";


    $statement = $database->prepare($query);
    $statement->execute([
      'responsable' => $responsable_id
    ]);


    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;

   } catch (PDOException $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;
   }
 }


 public static function insert($label, $responsable_id, $groupe) {
    try {
      $database = Model::getInstance();

      // recherche de la valeur de la clé = max(id) + 1
      $query = "select max(id) from projet";
      $statement = $database->query($query);
      $tuple = $statement->fetch();
      $id = $tuple['0'];
      $id++;

      // vérifier que les valeurs obligatoires sont renseignées et qu'elles sont correctes
      if ($label == '' || is_null($responsable_id) || is_null($groupe) || $groupe > 5 || $groupe < 1 || strlen($label) > 60) {
        return -1;
      }

      // ajout d'un nouveau tuple;
      $query = "insert into projet value (:id, :label, :responsable, :groupe)";
      $statement = $database->prepare($query);
      $statement->execute([
        'id' => $id,
        'label' => $label,
        'responsable' => $responsable_id,
        'groupe' => $groupe
      ]);

      return $id;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
 }
 
 public static function getProjectIdByLabel($label) {
        try {
            $database = Model::getInstance();
            $query = "SELECT id FROM projet WHERE label = :label"; 
            $stmt = $database->prepare($query);
            $stmt->bindParam(':label', $label, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? (int)$result['id'] : null; 
        } catch (PDOException $e) {
            error_log("Erreur dans getProjectIdByLabel: " . $e->getMessage());
            return null; 
        }
    }

 
 public static function update() {
  echo ("ModelProjet : update() TODO ....");
  return null;
 }

 public static function delete() {
  echo ("ModelProjet : delete() TODO ....");
  return null;
 }


 public static function getAllProper() {
   try {
    $database = Model::getInstance();
    $query = "SELECT 
                  id,
                  label
              FROM 
                  projet";


    $statement = $database->prepare($query);
    $statement->execute();


    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;

   } catch (PDOException $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;
   }
 }

}
?>
<!-- ----- fin ModelProjet -->
