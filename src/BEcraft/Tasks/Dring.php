<?php

namespace BEcraft\Tasks;

use BEcraft\Loader;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\level\{Location, Level};
use pocketmine\level\particle\HappyVillagerParticle;

class Dring extends Task{
	
	public function __construct(Loader $plugin, Location $location, Level $level){
	//parent::__construct($plugin, $location, $level);
	$this->plugin = $plugin;
	$this->location = $location;
	$this->level = $level;
	}
	
	public function onRun($tick){
	$level = $this->level;
	$location = $this->location;
	$time = 0;
	$pi = 3.14159;
	$time+=$pi/2;
	for($i = 0; $i <= 50; $i+=$pi/16){
	$radio = 1.5;
	$x = $radio*cos($i)*sin($time);
	$y = $radio*cos($time)+1.5;
	$z = $radio*sin($i)*sin($time);
	$level->addParticle(new HappyVillagerParticle($location->add($x, $y, $z)));
	}
	}
	
}