<?php

use App\models\counterTerroristTeam;
use App\models\counterTerroristUser;
use App\models\terroristTeam;
use App\models\terroristUser;
use App\models\users;
use App\models\weapons;

require_once "bootstrap.php";

function sortUsers($memberOne, $memberTwo)
{
    if ($memberOne->kills == $memberTwo->kills) {
        if ($memberOne->killed == $memberTwo->killed) {
            return $memberOne->timeJoined <=> $memberTwo->timeJoined;
        }
        return $memberOne->killed <=> $memberTwo->killed;
    }
    return $memberTwo->kills <=> $memberOne->kills;
}

class input
{
    public $Inputstring = [];
    public $injunction;
    public function __construct(public $gameInput = null)
    {
        $this->Inputstring = explode(PHP_EOL, $gameInput);
        // echo($this->Inputstring);
    }
    public function checkCommands()
    {
        $injunction = $this->Inputstring;
        // var_dump($injunction);

        $tempIndex = -1;
        foreach ($injunction as $str) {
            $injunction = explode(" ", trim($str));

            $timeArray = explode(":", trim(end($injunction)));
            users::$timeArray = $timeArray;

            $method = "__" . str_replace("-", "_", strtolower($injunction[0]));
            $parameter = array_shift($injunction);
            if (method_exists($this, $method))
                $this->$method($injunction);

            if ($parameter == "ROUND") {
                $tempIndex = (int) $injunction[0];
            } else {
                if ($tempIndex != -1) {
                    $tempIndex--;
                }
            }
            if ($tempIndex == 0) {
                $tempIndex =  -1;
            }
        }
        // var_dump($terroristTeam->getTeamUser());
        // var_dump($counterTerroristTeam->getTeamUser());
    }
    
    private function __add_user(array $injunction): void
    {
        $terroristTeam = new terroristTeam;
        $counterTerroristTeam = new counterTerroristTeam;
        if ($injunction[1] == "Terrorist") {
            $member = $terroristTeam->addToTeam($injunction[0]);
        } else {
            $member = $counterTerroristTeam->addToTeam($injunction[0]);
        }
        if ($member != null) {
            $member->addMoney(1000);
            if ($member->timeJoined >= 3000) {
                $member->reduceHealth(100);
            } else {
                $member->setAlive();
            }
        }
    }

    private function __get_money(array $injunction): void
    {
        $name = $injunction[0];
        $member = terroristUser::findUser($name) ?? counterTerroristUser::findUser($name);
        if ($member != null) {
            echo $member->getMoney() . "\n";
        } else {
            echo "invalid username \n";
        }
    }

    private function __get_health(array $injunction): void
    {
        $name = $injunction[0];
        $member = terroristUser::findUser($name) ?? counterTerroristUser::findUser($name);
        if ($member != null) {
            echo $member->getHealth() . "\n";
        } else {
            echo "invalid username \n";
        }
    }

    private function __buy(array $injunction): void
    {
        $name = $injunction[0];
        $member = terroristUser::findUser($name) ?? counterTerroristUser::findUser($name);
        $gunName = $injunction[1];
        if ($gunName == "AWP" and $member->team == "Terrorist") {
            $gunName = "AWPT";
        } elseif ($gunName == "AWP" and $member->team == "Counter-Terrorist") {
            $gunName = "AWPCT";
        }
        $gun = weapons::findGun($gunName);
        $member->buyGun($gun->name, $injunction[2]);
    }

    private function __tap(array $injunction): void
    {
        $attacker = $injunction[0];
        $attackerUser = terroristUser::findUser($attacker) ?? counterTerroristUser::findUser($attacker);
        $attacked = $injunction[1];
        $attackedUser = terroristUser::findUser($attacked) ?? counterTerroristUser::findUser($attacked);
        $weaponUsed = $injunction[2];

        $attackerUser->tap($attackedUser, $weaponUsed);
    }

    private function __score_board(): void
    {
        usort(counterTerroristTeam::$members, "sortUsers");
        $rank = 1;
        echo "Counter-Terrorist-Players: \n";
        foreach (counterTerroristTeam::$members as $member) {
            echo $rank++ . " " . $member->name . " " . $member->kills . " " . $member->killed . "\n";
        }

        usort(terroristTeam::$members, "sortUsers");
        $rank = 1;
        echo "Terrorist-Players: \n";
        foreach (terroristTeam::$members as $member) {
            echo $rank++ . " " . $member->name . " " . $member->kills . " " . $member->killed . "\n";
        }
    }
    private function __round()
    {
        if ((terroristTeam::isAllMemberDie() and  !counterTerroristTeam::isAllMemberDie()) or (!terroristTeam::isAllMemberDie() and !counterTerroristTeam::isAllMemberDie())) {
            echo "Counter-Terrorist won \n";
            counterTerroristTeam::addReward(2700);
            terroristTeam::addReward(2400);
        } else {
            echo "Terrorist won \n";
            terroristTeam::addReward(2700);
            counterTerroristTeam::addReward(2400);
        }

        counterTerroristTeam::clearUser();
        terroristTeam::clearUser();
    }
}

$commandString = "3
ROUND 6
ADD-USER King2Krazy Counter-Terrorist 00:01:130
ADD-USER Cat Terrorist 00:02:314
GET-MONEY King2Krazy 00:04:411
GET-MONEY Cat 00:04:715
GET-HEALTH King2Krazy 00:05:004
GET-HEALTH Cat 00:14:000
ROUND 1
TAP King2Krazy Cat knife 00:15:741
ROUND 8
TAP King2Krazy Cat knife 00:13:000
TAP King2Krazy Cat knife 00:15:001
TAP King2Krazy Cat knife 00:16:023
GET-MONEY King2Krazy 01:04:411
GET-MONEY Cat 01:04:715
GET-HEALTH King2Krazy 01:05:004
GET-HEALTH Cat 01:14:051
SCORE-BOARD 01:17:200";


$num = readline();
$commandsList = [];
for ($i = 0; $i < $num; $i++) {
    $round = readline();
    array_push($commandsList, $round);
    $roundCL = explode(' ', $round);
    $roundLineCount = $roundCL[1];
    for ($j = 0; $j < $roundLineCount; $j++) {
        $roundLine = readline();
        array_push($commandsList, $roundLine);
    }
}

foreach ($commandsList as $commands) {
    $commands = new input($commands);
    $commands->checkCommands();
}

// 135000 ms - ttt