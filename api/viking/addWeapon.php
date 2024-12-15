<?php
/*
Créer une nouvelle fonctionnalité Update dans le fichier 
api/viking/addWeapon.php du viking pour lui ajouter une arme si elle existe. 
Retourner une erreur appropriée si elle n'existe pas et ne pas mettre à jour le 
viking. Faire les vérifications appropriées pour correspondre aux contraintes 
d'appel suivantes :
 PATCH api/viking/addWeapon.php?id=<vikingId>
 Body :
 {
 "weaponId": 3
 }
 Attention : la nouvelle fonctionnalité d'Update ne doit mettre à jour que le champ 
WeaponId du viking, et ne doit pas mettre à jour les autres champs du viking.
*/

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

if (validateMandatoryParams($data, ['weaponId'])) {
    $weaponId = intval($data['weaponId']);
    if (!findOneWeapon($weaponId)) {
        returnError(400, 'Weapon not found');
    }

    $updated = updateVikingWeapon($id, $weaponId);
    if ($updated) {
        http_response_code(204);
    } elseif ($updated == 0) {
        returnError(404, 'Viking not found');
    } else {
        returnError(500, 'Could not update the viking\'s weapon');
    }
} else {
    returnError(412, 'Mandatory parameters : weaponId');
}