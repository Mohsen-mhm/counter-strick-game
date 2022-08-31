<?php

namespace App\models;

use App\controllers\weaponInterface;

class weapons implements weaponInterface
{

    public static $weapons = array();

    public static function readJsonFile(): void
    {
        $weaponJson='[{"name":"AK","type":"heavy","team":"Terrorist","price":2700,"power":31,"reward":100},{"name":"AWPT","type":"heavy","team":"Terrorist","price":4300,"power":110,"reward":50},{"name":"Revolver","type":"pistol","team":"Terrorist","price":600,"power":51,"reward":150},{"name":"Glock-18","type":"pistol","team":"Terrorist","price":300,"power":11,"reward":200},{"name":"M4A1","type":"heavy","team":"Counter-Terrorist","price":2700,"power":29,"reward":100},{"name":"AWPCT","type":"heavy","team":"Counter-Terrorist","price":4300,"power":110,"reward":50},{"name":"Desert-Eagle","type":"pistol","team":"Counter-Terrorist","price":600,"power":53,"reward":175},{"name":"UPS-S","type":"pistol","team":"Counter-Terrorist","price":300,"power":13,"reward":225},{"name":"knife","type":"knife","team":null,"price":null,"power":43,"reward":500}]';
        $jsonData = json_decode($weaponJson, false);
        foreach ($jsonData as $data) {
            self::addWeapon($data);
        }
    }

    public static function addWeapon(object $data): void
    {
        $weapon = new weapon($data->name, $data->type, $data->team, $data->price, $data->power, $data->reward);
        array_push(self::$weapons, $weapon);
    }

    public static function findGun(string $gunName)
    {
        foreach (self::$weapons as $gun) {
            if ($gun->name == $gunName) {
                return $gun;
            }
        }
        return null;
    }
}
weapons::readJsonFile();
