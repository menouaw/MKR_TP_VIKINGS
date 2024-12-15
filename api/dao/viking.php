<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/utils/database.php';


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

function createViking(string $name, int $health, int $attack, int $defense, int $weaponId) {
    $db = getDatabaseConnection();
    $sql = "INSERT INTO viking (name, health, attack, defense, weaponId) VALUES (:name, :health, :attack, :defense, :weaponId)";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['name' => $name, 'health' => $health, 'attack' => $attack, 'defense' => $defense, 'weaponId' => $weaponId]);
    if ($res) {
        return $db->lastInsertId();
    }
    return null;
}

function updateViking(string $id, string $name, int $health, int $attack, int $defense, int $weaponId) {
    $db = getDatabaseConnection();
    $sql = "UPDATE viking SET name = :name, health = :health, attack = :attack, defense = :defense, weaponId = :weaponId WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id, 'name' => $name, 'health' => $health, 'attack' => $attack, 'defense' => $defense, 'weaponId' => $weaponId]);
    if ($res) {
        return $id;
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

function updateVikingWeapon(string $id, int $weaponId) {
    $db = getDatabaseConnection();
    $sql = "UPDATE viking SET weaponId = :weaponId WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id, 'weaponId' => $weaponId]);
    if ($res) {
        return $id;
    }
    return null;
}