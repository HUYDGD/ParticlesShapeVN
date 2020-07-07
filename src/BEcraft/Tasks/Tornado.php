<?php

namespace BEcraft\Tasks;

use BEcraft\Loader;
use pocketmine\scheduler\Task;
use pocketmine\level\{Location, Level};
use pocketmine\level\particle\FlameParticle;

class Tornado extends Task{
	
	public function __construct(Loader $plugin, Location $location, Level $level){
	//parent::__construct($plugin, $location, $level);
	$this->plugin = $plugin;
	$this->location = $location;
	$this->level = $level;
	}
	
	public function onRun($tick){
	$level = $this->level;
	$location = $this->location;
	$pi = 3.14159;
	$altura = 10;
	$radio = 10;
	$lineas = 4;
	$upaltura = 0.2;
	$upradio = $radio/$altura;
	for($i = 0; $i < $lineas; ++$i){
	for($y = 0; $y < $altura; $y+=$upaltura){
	$radio = $y*$upradio;
	$x = cos(deg2rad(360/$lineas*$i+$y*25))*$radio;
	$z = sin(deg2rad(360/$lineas*$i+$y*25))*$radio;
	$level->addParticle(new FlameParticle($location->add($x, $y, $z)));
	}
	}
	}
}