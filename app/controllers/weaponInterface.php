<?php

namespace App\controllers;

interface weaponInterface
{
    public static function readJsonFile(): void;

    public static function addWeapon(object $weapon): void;

    public static function findGun(string $gunName);
}
