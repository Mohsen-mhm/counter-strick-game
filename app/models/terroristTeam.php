<?php

namespace App\models;

class terroristTeam extends team
{
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
