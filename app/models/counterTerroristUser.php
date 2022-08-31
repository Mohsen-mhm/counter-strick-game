<?php

namespace App\models;

use App\controllers\UserInterface;

class counterTerroristUser extends users implements UserInterface
{
    public $team = "Counter-Terrorist";

    public static $members = array();

    public static function getTeamUser(): array
    {
        return self::$members;
    }
    protected static function addMember(object $member): void
    {
        array_push(self::$members, $member);
    }
}
