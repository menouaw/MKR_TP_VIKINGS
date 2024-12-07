<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/utils/database.php';
/*
Vikings 
Un viking ne peut avoir qu'une seule arme au maximum, mais peut n'en avoir aucune.
 Modifier la table viking pour qu'elle ait une arme (clé étrangère weaponId vers 
la table Weapon, peut être null).
 Ajouter les fonctionnalités CRUD pour les vikings :
 Mettre à jour les fonctionnalités Read du viking (findOne et findAll) pour qu'elles 
retournent le détail de l'arme du viking si celui-ci en a une. L'arme doit être 
retournée au format d'un lien vers le détail de l'arme (HATEOAS) si le viking en a 
une (sinon renvoyer "weapon": ""). Exemple :
 Mettre à jour la fonctionnalité Create du viking pour qu'il puisse être créé avec 
une arme par défaut si elle existe. Retourner une erreur appropriée si elle 
n'existe pas et ne pas créer le viking.
 {
  "id": 1,
  "name": "Ragnar",
  "health": 300,
  "attack": 200,
  "defense": 150,
  "weapon": "/weapon/findOne.php?id=3"
 }
Mettre à jour la fonctionnalité Update avec PUT pour mettre à jour le viking dans 
son intégralité. Faire les vérifications appropriées pour mettre à jour l'arme si 
elle existe, ou la supprimer si elle n'existe pas.
*/

function findOneViking(string $id) {
    $db = getDatabaseConnection();
    $sql = "SELECT id, name, health, attack, defense, weaponId FROM viking WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);
    if ($res) {
        $viking = $stmt->fetch(PDO::FETCH_ASSOC);

        $viking['id'] = intval($viking['id']);
        $viking['health'] = intval($viking['health']);
        $viking['attack'] = intval($viking['attack']);
        $viking['defense'] = intval($viking['defense']);

        if ($viking['weaponId']) {
            $viking['weapon'] = "/weapon/findOne.php?id=" . $viking['weaponId'];
        } else {
            $viking['weapon'] = "";
        }
        unset($viking['weaponId']);
        return $viking;
    }
    return null;
}

function findAllVikings (string $name = "", int $limit = 10, int $offset = 0) {
    $db = getDatabaseConnection();
    $params = [];
    $sql = "SELECT id, name, health, attack, defense, weaponId FROM viking";
    if ($name) {
        $sql .= " WHERE name LIKE :name";
        $params['name'] = "%$name%";
    }
    $sql .= " LIMIT $limit OFFSET $offset ";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute($params);
    if ($res) {
        $vikings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($vikings as &$viking) {
            $viking['id'] = intval($viking['id']);
            $viking['health'] = intval($viking['health']);
            $viking['attack'] = intval($viking['attack']);
            $viking['defense'] = intval($viking['defense']);
            if ($viking['weaponId']) {
                $viking['weapon'] = "/weapon/findOne.php?id=" . $viking['weaponId'];
            } else {
                $viking['weapon'] = "";
            }
            unset($viking['weaponId']);
        }
        return $vikings;
    }
    return null;
}

function createViking(string $name, int $health, int $attack, int $defense) {
    $db = getDatabaseConnection();
    $sql = "INSERT INTO viking (name, health, attack, defense) VALUES (:name, :health, :attack, :defense)";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['name' => $name, 'health' => $health, 'attack' => $attack, 'defense' => $defense]);
    if ($res) {
        return $db->lastInsertId();
    }
    return null;
}

function updateViking(string $id, string $name, int $health, int $attack, int $defense) {
    $db = getDatabaseConnection();
    $sql = "UPDATE viking SET name = :name, health = :health, attack = :attack, defense = :defense WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id, 'name' => $name, 'health' => $health, 'attack' => $attack, 'defense' => $defense]);
    if ($res) {
        return $stmt->rowCount();
    }
    return null;
}

function deleteViking(string $id) {
    $db = getDatabaseConnection();
    $sql = "DELETE FROM viking WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);
    if ($res) {
        return $stmt->rowCount();
    }
    return null;
}