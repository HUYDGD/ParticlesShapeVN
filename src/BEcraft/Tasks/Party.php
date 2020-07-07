<?php

namespace BEcraft\Tasks;

use BEcraft\Loader;
use pocketmine\scheduler\Task;
use pocketmine\math\Vector3;
use pocketmine\level\{Level, Location};
use pocketmine\level\particle\DustParticle;

class Party extends Task{
	
	public function __construct(Loader $plugin, Location $location, Level $level){
	//parent::__construct($plugin, $location, $level);
	$this->plugin = $plugin;
	$this->location = $location;
	$this->level = $level;
	}
	
	public function onRun($tick){
	$location = $this->location;
	$level = $this->level;
	$pi = 3.14159;
	for($i = 0; $i <= 16; $i+=$pi/22){
	$radio = sin($i);
	$y = cos($i);
	for($a = 0; $a < $pi*4; $a+=$pi/8){
	$x = cos($a)*$radio;
	$z = sin($a)*$radio;
	$location->level->addParticle(new DustParticle($location->add($x, $i, $z), mt_rand(1, 255), mt_rand(1, 255), mt_rand(1, 255)));
	}
	}
	}
	
}