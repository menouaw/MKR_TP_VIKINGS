<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MKR_TP_VIKINGS/api/dao/weapon.php';

// how to define a number like: %define DEFAULT_WEAPON_ID 6:
define('DEFAULT_WEAPON_ID', 6);


function verifyViking($viking): bool {
    $name = trim($viking['name']);
    if (strlen($name) < 3) {
        returnError(412, 'Name must be at least 3 characters long');
    }

    $health = intval($viking['health']);
    if ($health < 1) {
        returnError(412, 'Health must be a positive and non zero number');
    }

    $attack = intval($viking['attack']);
    if ($attack < 1) {
        returnError(412, 'Attack must be a positive and non zero number');
    }

    $defense = intval($viking['defense']);
    if ($defense < 1) {
        returnError(412, 'Defense must be a positive and non zero number');
    }

    $weapon = intval($viking['weapon']);
    if ($weapon == 0) {
        if (!findOneWeapon(DEFAULT_WEAPON_ID)) {
            returnError(500, 'Default weapon not found');
        }
    } else {
        if (!findOneWeapon($weapon)) {
            returnError(412, 'Weapon not found');
        }
    }

    return true;
}