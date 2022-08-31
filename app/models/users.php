<?php

namespace App\models;

use App\controllers\UserInterface;

class users implements UserInterface
{
    public $name;
    public $team;
    public $isAlive;
    public $money;
    public $health;
    public $timeJoined;
    public $heavy;
    public $pistol;
    public $knife;
    public $kills;
    public $killed;
    public static $timeArray = [];

    public function __construct(string $userName)
    {
        $this->name = $userName;
        $this->team = self::setTeam();
        $this->isAlive = false;
        $this->money = 0;
        $this->health = 100;
        $this->timeJoined = self::setTime();
        $this->heavy = null;
        $this->pistol = null;
        $this->knife = weapons::$weapons[8]->name;
        $this->kills = 0;
        $this->killed = 0;
    }

    public function isNameEqual(string $name = null): bool
    {
        if ($name == $this->name)
            return true;
        return false;
    }

    public static function setTeam(): string
    {
        $reflect = new \ReflectionClass(get_called_class());
        if ($reflect->getShortName() == "counterTerroristUser") {
            $team = "Counter-Terrorist";
        } else {
            $team = "Terrorist";
        }
        return $team;
    }

    public function setAlive(): void
    {
        if ($this->health != 0) {
            $this->isAlive = true;
        }
    }

    public static function setTime(): int
    {
        $min = (int)self::$timeArray[0];
        $sec = (int)self::$timeArray[1];
        $ms = (int)self::$timeArray[2];
        return ($min * 60000) + ($sec * 1000) + $ms;
    }

    public static function getTime(array $timeArray): int
    {
        $min = (int)$timeArray[0];
        $sec = (int)$timeArray[1];
        $ms = (int)$timeArray[2];
        return ($min * 60000) + ($sec * 1000) + $ms;
    }

    public function getMoney(): int
    {
        return $this->money;
    }

    public function addMoney(int $money): void
    {
        $this->money += $money;
        if ($this->money > 10000) {
            $this->money = 10000;
        }
    }

    public function reduceMoney(int $money): void
    {
        $this->money -= $money;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setMaxHealth(): void
    {
        $this->health = 100;
    }

    public function reduceHealth(int $health): void
    {
        $this->health -= $health;
        if ($this->health < 0) {
            $this->health = 0;
        }
    }

    public function buyGun(string $gunName, string $injunction): void
    {
        $gun = weapons::findGun($gunName);
        $purchaseTime = self::getTime(explode(":", trim($injunction)));

        if ($gun != null) {
            if ($this == null) {
                echo "invalid username \n";
            } elseif ($this->isAlive == false) {
                echo "deads can not buy \n";
            } else {
                if ($purchaseTime < 45000) {
                    if ($gun->team != $this->team) {
                        echo "invalid category gun \n";
                    } elseif ($this->money < $gun->price) {
                        echo "no enough money \n";
                    } elseif ($this->heavy != null) {
                        echo "you have a heavy \n";
                    } elseif ($this->pistol != null) {
                        echo "you have a pistol \n";
                    } else {
                        $this->reduceMoney($gun->price);
                        if ($gun->type == "pistol") {
                            $this->pistol = $gun->name;
                        } else {
                            $this->pistol = null;
                        }
                        if ($gun->type == "heavy") {
                            $this->heavy = $gun->name;
                        } else {
                            $this->heavy = null;
                        }
                        echo "I hope you can use it \n";
                    }
                } else {
                    echo "you are out of time \n";
                }
            }
        }
    }

    public function tap(object $attackedUser, string $weaponUsed): void
    {
        $gun = weapons::findGun($weaponUsed);

        if ($this == null or $attackedUser == null) {
            echo "invalid username \n";
        } else {
            if ($this->isAlive == false) {
                echo "attacker is dead \n";
            } elseif ($attackedUser->isAlive == false) {
                echo "attacked is dead \n";
            } else {
                if ($this->heavy != null and $weaponUsed == "heavy") {
                    $gun = $this->heavy;
                    $gun = weapons::findGun($gun);
                    self::tapEffect($this, $attackedUser, $gun);
                } elseif ($this->pistol != null and $weaponUsed == "pistol") {
                    $gun = $this->pistol;
                    $gun = weapons::findGun($gun);
                    self::tapEffect($this, $attackedUser, $gun);
                } elseif ($weaponUsed == "knife") {
                    $gun = $this->knife;
                    $gun = weapons::findGun($gun);
                    self::tapEffect($this, $attackedUser, $gun);
                } else {
                    echo "no such gun \n";
                }
            }
        }
    }

    public static function findUser(string $name): UserInterface | null
    {
        $reflect = new \ReflectionClass(get_called_class());
        if ($reflect->getShortName() == "counterTerroristUser") {
            $members = counterTerroristTeam::getTeamUser();
        } else {
            $members = terroristTeam::getTeamUser();
        }
        foreach ($members as $member) {
            if ($member->isNameEqual($name)) {
                return $member;
            }
        }
        return null;
    }

    public static function tapEffect(object $attackerUser, object $attackedUser, object $gun): void
    {
        if ($attackerUser->team == $attackedUser->team) {
            echo "friendly fire \n";
        } else {
            echo "nice shot \n";
            $attackedUser->reduceHealth($gun->power);
            if ($attackedUser->health <= 0) {
                $attackedUser->isAlive = false;
                $attackedUser->killed++;
                $attackerUser->kills++;
                $attackerUser->addMoney($gun->reward);
            }
        }
    }
}
