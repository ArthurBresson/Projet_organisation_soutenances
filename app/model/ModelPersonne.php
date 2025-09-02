<!-- ----- debut ModelPersonne -->

<?php
require_once 'Model.php';

class ModelPersonne {
 private $id, $nom, $prenom, $role_responsable, $role_examinateur, $role_etudiant, $login, $password;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $role_responsable = NULL, $role_examinateur = NULL, $role_etudiant = NULL, $login = NULL, $password = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($id)) {
   $this->id = $id;
   $this->nom = $nom;
   $this->prenom = $prenom;
   $this->role_responsable = $role_responsable;
   $this->role_examinateur = $role_examinateur;
   $this->role_etudiant = $role_etudiant;
   $this->login = $login;
   $this->password = $password;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setNom($nom) {
  $this->nom = $nom;
 }

 function setPrenom($prenom) {
  $this->prenom = $prenom;
 }

 function setResponsable($role_responsable) {
  $this->role_responsable = $role_responsable;
 }

 function setExaminateur($role_examinateur) {
  $this->role_examinateur = $role_examinateur;
 }

 function setEtudiant($role_etudiant) {
  $this->role_etudiant = $role_etudiant;
 }

 function setLogin($login) {
  $this->login = $login;
 }

 function setPassword($password) {
  $this->password = $password;
 }

 function getId() {
  return $this->id;
 }

 function getNom() {
  return $this->nom;
 }

 function getPrenom() {
  return $this->prenom;
 }

 function getResponsable() {
  return $this->role_responsable;
 }

 function getExaminateur() {
  return $this->role_examinateur;
 }

 function getEtudiant() {
  return $this->role_etudiant;
 }

 function getLogin() {
  return $this->login;
 }

 function getPassword() {
  return $this->password;
 }

 // renvoie 1 si le login/password sont corrects, 0 autrement, -1 si erreur
 public static function checkCredentials($login, $password) {
  try {
   $database = Model::getInstance();
   $query = "select * from personne where login = :login and password = :password";
   $statement = $database->prepare($query);
   $statement->bindValue(':login', $login);
   $statement->bindValue(':password', $password);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
   if ($results == NULL) {
    return 0;
   } else {
    // mise en session
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    } // making sure session is started
    $_SESSION['login_id'] = $results[0]->getId();
    return 1;
   }
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }
 
// retourne une liste des id
 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select id from personne";
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
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from personne";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from personne where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function insert($nom, $prenom, $role_responsable, $role_examinateur, $role_etudiant, $login, $password) {
  try {
   $database = Model::getInstance();

   // recherche de la valeur de la clé = max(id) + 1
   $query = "select max(id) from personne";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   // vérifier que le nom d'utilisateur n'existe pas déjà (car il est unique)
   $query = "select * from personne where login = :login";
   $statement = $database->prepare($query);
   $statement->execute([
     'login' => $login
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");

   // vérifier que toutes les données sont correctes ainsi que le nom d'utilisateur est unique
   if ($results != NULL || strlen($login) > 20 || strlen($password) > 20 || strlen($nom) > 40 || strlen($prenom) > 40 || $nom == '' || $prenom == '' || $login == '' || $password == '') {
    return -2; // fin de la fonction
   }

   // ajout d'un nouveau tuple;
   $query = "insert into personne value (:id, :nom, :prenom, :role_responsable, :role_examinateur, :role_etudiant, :login, :password)";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id,
     'nom' => $nom,
     'prenom' => $prenom,
     'role_responsable' => $role_responsable,
     'role_examinateur' => $role_examinateur,
     'role_etudiant' => $role_etudiant,
     'login' => $login,
     'password' => $password
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }
 
 public static function getRole($id) {
    try {
        include '../controller/config.php';

        $database = Model::getInstance();

        $query = "SELECT
            role_responsable,    -- Directly select the boolean columns
            role_examinateur,
            role_etudiant
          FROM personne
          WHERE id = :id";

        $stmt = $database->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $roles = $stmt->fetch(PDO::FETCH_ASSOC); 

        return $roles; 

    } catch (PDOException $e) {

        printf("%s - %s</p>\n", $e->getCode(), $e->getMessage());
        return null; 
    }
}



 public static function update() {
  echo ("ModelPersonne : update() TODO ....");
  return null;
 }

 public static function delete() {
  echo ("ModelPersonne : delete() TODO ....");
  return null;
 }

 public static function getAllExaminateur() {
  try {
    $database = Model::getInstance();
    $query = "select nom, prenom from personne where role_examinateur = 1";
    $statement = $database->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  } catch (PDOException $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return -1;
  }
 }


 public static function getExaminateurByProjet($id_projet) {
    try {
      $database = Model::getInstance();
      $query = "SELECT DISTINCT p.*
                FROM personne p
                JOIN creneau c ON p.id = c.examinateur
                WHERE c.projet = :id_projet
                  AND p.role_examinateur = 1";
      $statement = $database->prepare($query);
      $statement->execute([
        'id_projet' => $id_projet
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
<!-- ----- fin ModelPersonne -->
