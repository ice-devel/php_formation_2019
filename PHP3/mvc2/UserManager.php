<?php
/**
 * Manager : gérer les récupérations/modifications des données en base de données
 * pour une entité en particulier
 * Ce qu'on appelle la DAO (data access object)
 */

class UserManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create(User $user) {
        // requete INSERT INTO
    }

    public function update(User $user) {
        // requete UPDATE
    }

    public function delete(User $user) {
        // requete DELETE
    }

    public function get($id) {

    }

    public function getAll() {

    }

    public function getByNameAndBirthday($name, $birthday) {
        // 2- création requête dynamique
        $sql = "SELECT * FROM utilisateur";
        $params = [];
        if ($name != null && $name != "" && $birthday != null && $birthday != "") {
            $sql = $sql." WHERE name = :name AND birthday = :birthday";
            $params[':name'] = $name;
            $params[':birthday'] = $birthday;
        }
        elseif ($name != null && $name != "") {
            $sql = $sql." WHERE name = :name";
            $params[':name'] = $name;
        }
        elseif ($birthday != null && $birthday != "") {
            $sql = $sql." WHERE birthday = :birthday";
            $params[':birthday'] = $birthday;
        }

        // 3- exécution de la requête
        // 3.1- connexion bdd : la connexion se ne fait dans le manager
        // on lui a passé en paramètre du constructeur
        //$db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');

        // 3.2- envoi de la requête
        $statement = $this->db->prepare($sql);
        $statement->execute($params);
        // 3.3 - récupération des résultats
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($result as $u) {
            $user = new User();
            $user->setId($u['id']);
            $user->setName($u['name']);
            $user->setBirthday($u['birthday']);
            $user->setCreatedAt($u['created_at']);
            $user->setPoints($u['points']);
            $user->setZipcode($u['zipcode']);
            $users[] = $user;
        }

        return $users;
    }
}