<?php
/*
il faut ajouter la fonctionnalité:
 GET /weapon/findOne.php?id=<id> : retourne l'arme d'id <id>

for viking:

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/utils/server.php';

header('Content-Type: application/json');

if (!methodIsAllowed('read')) {
    returnError(405, 'Method not allowed');
    return;
}

if (!isset($_GET['id'])) {
    returnError(400, 'Missing parameter : id');
}

$viking = findOneViking($_GET['id']);
if (!$viking) {
    returnError(404, 'Viking not found');
}
echo json_encode($viking);
*/

require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/dao/weapon.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/utils/server.php';

header('Content-Type: application/json');

if (!methodIsAllowed('read')) { 
    returnError(405, 'Method not allowed');
    return;
}

if (!isset($_GET['id'])) {
    returnError(400, 'Missing parameter : id');
}

$weapon = findOneWeapon($_GET['id']);
if (!$weapon) {
    returnError(404, 'Weapon not found');
}

echo json_encode($weapon);