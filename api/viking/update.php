<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/viking/service.php';

header('Content-Type: application/json');

if (!methodIsAllowed('update')) {
    returnError(405, 'Method not allowed');
    return;
}

$data = getBody();

if (!isset($_GET['id'])) {
    returnError(400, 'Missing parameter : id');
}

$id = intval($_GET['id']);

if (validateMandatoryParams($data, ['name', 'health', 'attack', 'defense'])) {
    verifyViking($data);
    $weapon = setWeapon($data['weapon']);

    $updated = updateViking($id, $data['name'], $data['health'], $data['attack'], $data['defense'], $weapon);
    if ($updated) {
        http_response_code(204);
    } elseif ($updated == 0) {
        returnError(404, 'Viking not found');
    } else {
        returnError(500, 'Could not update the viking');
    }
} else {
    returnError(412, 'Mandatory parameters : name, health, attack, defense');
}