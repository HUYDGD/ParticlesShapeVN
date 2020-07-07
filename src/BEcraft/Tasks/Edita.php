<?php

namespace BEcraft\Tasks;

use BEcraft\Loader;
use pocketmine\scheduler\Task;
use pocketmine\level\{Location, Level};
use pocketmine\level\particle\DustParticle;

class Edita extends Task{
	
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
	$phi = 0;
	$phi+=$pi/15;
	for($i = 0; $i < 2*$pi; $i+=$pi/40){
	for($a = 1; $a < 10; ++$a){
	$radio = 1+$a;
	if($radio < 5){
	$x = $radio*cos($i)*sin($phi);
	$y = $radio*cos($phi)+1.5;
	$z = $radio*sin($i)*sin($phi);
	$location->level->addParticle(new DustParticle($location->add($x, $y, $z), mt_rand(219, 255), mt_rand(0, 20), mt_rand(180, 203)));
	}else{
	for($b = 1; $b < 5; ++$b){
	$radio = 6-$b;
	if($radio > 1){
	$x = $radio*cos($i)*sin($phi);
	$y = $radio*cos($phi)+1.5;
	$z = $radio*sin($i)*sin($phi);
	$location->level->addParticle(new DustParticle($location->add($x, $y, $z), mt_rand(219, 255), mt_rand(0, 20), mt_rand(180, 203)));
	}else{
	for($c = 1; $c < 5; ++$c){
	$radio = 1+$c;
	if($radio < 5){
	$x = $radio*cos($i)*sin($phi);
	$y = $radio*cos($phi)+1.5;
	$z = $radio*sin($i)*sin($phi);
	$location->level->addParticle(new DustParticle($location->add($x, $y, $z), mt_rand(219, 255), mt_rand(0, 20), mt_rand(180, 203)));
	}else{
	for($d = 1; $d < 5; ++$d){
	$radio = 6-$d;
	if($radio > 1){
	$x = $radio*cos($i)*sin($phi);
	$y = $radio*cos($phi)+1.5;
	$z = $radio*sin($i)*sin($phi);
	$location->level->addParticle(new DustParticle($location->add($x, $y, $z), mt_rand(219, 255), mt_rand(0, 20), mt_rand(180, 203)));
	}
	}
	}
	}
	}
	}
	}
	}
	}
	}
	
}