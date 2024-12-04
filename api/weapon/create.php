<?php
/*<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/viking/service.php';

header('Content-Type: application/json');

if (!methodIsAllowed('create')) {
    returnError(405, 'Method not allowed');
    return;
}

$data = getBody();

if (validateMandatoryParams($data, ['name', 'health', 'attack', 'defense'])) {
    verifyViking($data);

    $newVikingId = createViking($data['name'], $data['health'], $data['attack'], $data['defense']);
    if (!$newVikingId) {
        returnError(500, 'Could not create the viking');
    }
    echo json_encode(['id' => $newVikingId]);
    http_response_code(201);
} else {
    returnError(412, 'Mandatory parameters : name, health, attack, defense');
}
*/

require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/dao/weapon.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/utils/server.php';

header('Content-Type: application/json');

if (!methodIsAllowed('create')) {
    returnError(405, 'Method not allowed');
    return;
}

$data = getBody();

if (validateMandatoryParams($data, ['name', 'damage'])) {
    verifyWeapon($data);

    $newWeaponId = createWeapon($data['name'], $data['damage']);
    if (!$newWeaponId) {
        returnError(500, 'Could not create the weapon');
    }
    echo json_encode(['id' => $newWeaponId]);
    http_response_code(201);
} else {
    returnError(412, 'Mandatory parameters : name, damage');
}