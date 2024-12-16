<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/dao/weapon.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/utils/server.php';

header('Content-Type: application/json');

if (!methodIsAllowed('read')) {
    returnError(405, 'Method not allowed');
    return;
}

if (!isset($_GET['weapon'])) {
    returnError(400, 'Missing parameter : weapon');
    return;
}

$weapon = findOneWeapon($_GET['weapon']);

if (!$weapon) {
    returnError(404, 'Weapon not found');
    return;
}

$vikings = findVikingsByWeapon($_GET['weapon']);
foreach ($vikings as &$viking) {
    $viking['link'] = '/MKR_TP_VIKINGS/api/viking/findById.php?id=' . $viking['id'];
}

echo json_encode($vikings);
