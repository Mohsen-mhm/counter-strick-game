<?php

namespace App\controllers;

interface TeamInterface
{
    public static function getTeamUser();

    public function addToTeam(string $userName): UserInterface | null;

    public static function isMember(UserInterface $user): bool;

    public function hasCapacity(): bool;

    public static function isAllMemberDie(): bool;

    public static function addReward(int $reward): void;

    public static function clearUser(): void;
}
