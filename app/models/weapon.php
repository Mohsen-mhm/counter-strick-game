<?php

namespace App\models;

use App\models\weapons;

class weapon
{
    public $name;
    public $type;
    public $team;
    public $price;
    public $power;
    public $reward;

    public function __construct($name, $type, $team, $price, $power, $reward)
    {
        $this->name = $name;
        $this->type = $type;
        $this->team = $team;
        $this->price = $price;
        $this->power = $power;
        $this->reward = $reward;
    }
}
