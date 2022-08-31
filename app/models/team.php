<?php

namespace App\models;

use App\controllers\TeamInterface;
use App\controllers\UserInterface;

class team implements TeamInterface
{


    public static function getTeamUser()
    {
        return [];
    }

    protected static function addMember(object $member)
    {
    }

    public function addToTeam(string $userName): UserInterface | null
    {
        if (get_class($this) == counterTerroristTeam::class) {
            $member = new counterTerroristUser($userName);
        } else {
            $member = new TerroristUser($userName);
        }

        if (!counterTerroristTeam::isMember($member) and !terroristTeam::isMember($member)) {
            if ($this->hasCapacity()) {
                $this->addMember($member);
                if (get_class($this) == counterTerroristTeam::class) {
                    echo "this user added to Counter-Terrorist \n";
                } else {
                    echo "this user added to Terrorist \n";
                }
                return $member;
            } else {
                echo "this team is full \n";
            }
        } else {
            echo "you are already in this game \n";
        }
        return null;
    }

    public static function isMember(UserInterface $user): bool
    {
        $reflect = new \ReflectionClass(get_called_class());
        if ($reflect->getShortName() == "counterTerroristTeam") {
            $members = counterTerroristTeam::getTeamUser();
        } else
            $members = terroristTeam::getTeamUser();
        foreach ($members as $member)
            if ($member->name == $user->name)
                return true;
        return false;
    }

    public function hasCapacity(): bool
    {
        $maxCapacity = 10;
        if (count(counterTerroristTeam::getTeamUser()) < $maxCapacity and count(terroristTeam::getTeamUser()) < $maxCapacity) {
            return true;
        } else {
            return false;
        }
    }

    public static function isAllMemberDie(): bool
    {
        $reflect = new \ReflectionClass(get_called_class());
        if ($reflect->getShortName() == "counterTerroristTeam") {
            $members = counterTerroristTeam::getTeamUser();
        } else
            $members = terroristTeam::getTeamUser();
        foreach ($members as $member)
            if ($member->isAlive)
                return false;
        return true;
    }

    public static function addReward(int $reward): void
    {
        $reflect = new \ReflectionClass(get_called_class());
        if ($reflect->getShortName() == "counterTerroristTeam") {
            $members = counterTerroristTeam::getTeamUser();
        } else
            $members = terroristTeam::getTeamUser();
        foreach ($members as $member) {
            $member->addMoney($reward);
        }
    }

    public static function clearUser(): void
    {
        $reflect = new \ReflectionClass(get_called_class());
        if ($reflect->getShortName() == "counterTerroristTeam") {
            $members = counterTerroristTeam::getTeamUser();
        } else
            $members = terroristTeam::getTeamUser();
        foreach ($members as $member) {
            if ($member->isAlive == false) {
                $member->heavy = null;
                $member->pistol = null;
            }
            $member->setMaxHealth();
        }
    }
}
