<?php

namespace App\controllers;

interface UserInterface
{
    public function __construct(string $userName);

    public function isNameEqual(string $name = null): bool;

    public static function setTeam(): string;

    public function setAlive(): void;

    public static function setTime(): int;

    public static function getTime(array $timeArray): int;

    public function getMoney(): int;

    public function addMoney(int $money): void;

    public function reduceMoney(int $money): void;

    public function getHealth(): int;

    public function setMaxHealth(): void;

    public function reduceHealth(int $health): void;

    public function buyGun(string $gunName, string $injunction): void;
    
    public function tap(object $attackedUser, string $weaponUsed): void;

    public static function findUser(string $name): UserInterface | null;

    public static function tapEffect(object $attackerUser, object $attackedUser, object $gun) :void;
}
