<?php

namespace BEcraft;

use BEcraft\Loader;
use pocketmine\{Server, Player};
use pocketmine\utils\TextFormat;
use pocketmine\command\{CommandSender, PluginCommand};

class ParticleCommand extends PluginCommand{
	
	private $plugin;
	
	public function __construct($command, Loader $plugin){
	parent::__construct($command, $plugin);
	$this->setDescription(TextFormat::YELLOW."Lệnh chính của ParticlesShape!");
	$this->plugin = $plugin;
	}
	
	public function execute(CommandSender $sender, string $label, array $args): bool{
	if(!$sender instanceof Player){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Không thể dùng trên CONSOLE! Vui lòng sử dụng lệnh trong game.");
	return true;
	}
	
	if(!$sender->isOp()){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Bạn không có quyền để làm điều này.");
	return true;
	}
	
	$shapes = ["helix", "crown", "cloud", "dhelix", "laser", "dring", "tornado", "party", "edita"];
	
	if(!isset($args[0])){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Sử dụng: /particles <add [particle] [name]> | <remove [name]>");
	return true;
	}
	
	$values = ["add", "remove", "list"];
	
	if(!in_array($args[0], $values)){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Sử dụng: /particles <add [particle] [name]> | <remove [name]> | <list>");
	return true;
	}
	
	switch($args[0]){
	case "add":
	if(!isset($args[1])){
	$sender->sendMessage(Loader::PREFIX.TextFormat::GOLD." Vui lòng nhập tên để thêm shape tại vị trí đang đứng! Danh sách shape có sẵn: helix, crown, cloud, dhelix, laser, dring, tornado, party, edita");
	return true;
	}
	$shape = $args[1];
	if(!in_array($shape, $shapes)){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Không thành công! Danh sách shape có sẵn: ".TextFormat::GREEN.implode(", ", $shapes));
	return true;
	}
	if(!isset($args[2])){
	$sender->sendMessage(Loader::PREFIX.TextFormat::GOLD." Bạn cần phải đặt tên cho shape này! VD: /particles add helix concac");
	return true;
	}
	$name = strtolower($args[2]);
	if(is_numeric($name)){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Tên không được chứa chữ số!");
	return true;
	}
	if($this->getPlugin()->existsTask($name)){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Tên này đã được đặt! Vui lòng sử dụng một tên khác...");
	return true;
	}
	switch($shape){
	case "helix":
	$this->getPlugin()->newHelix($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "crown":
	$this->getPlugin()->newCrown($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "cloud":
	$this->getPlugin()->newCloud($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "dhelix":
	$this->getPlugin()->newDoubleHelix($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "laser":
	$this->getPlugin()->newLaser($sender, $name);
	break;
	case "dring":
	$this->getPlugin()->newDring($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "tornado":
	$this->getPlugin()->newTornado($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "party":
	$this->getPlugin()->newParty($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "edita":
	$this->getPlugin()->newEdita($sender->getLocation(), $sender->getLevel(), $name);
	break;
	}
	$sender->sendMessage(Loader::PREFIX.TextFormat::GRAY." Bạn đã spawn ra một shape có tên: ".TextFormat::GREEN.$name.TextFormat::GRAY.", loại shape là: ".TextFormat::GREEN.$shape);
	return true;
	break;
	
	case "remove":
	if(!isset($args[1])){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Bạn cần nhập đúng tên shape! VD: /particles remove concac");
	return true;
	}
	$name = strtolower($args[1]);
	if(!$this->getPlugin()->existsTask($name)){
	$sender->sendMessage(Loader::PREFIX.TextFormat::GRAY." Không có shape nào tên như vậy! Sử dụng ".TextFormat::GREEN."/particles list".TextFormat::GRAY." để hiển thị danh sách các tên.");
	return true;
	}
	$this->getPlugin()->removeTask($this->getPlugin()->tasks[$name]);
	unset($this->getPlugin()->tasks[$name]);
	$sender->sendMessage(Loader::PREFIX.TextFormat::GREEN." Bạn đã xóa một shape có tên: ".TextFormat::GOLD.$name);
	return true;
	break;
	
	case "list":
	$sender->sendMessage($this->getPlugin()->getTasks());
	return true;
	break;
	}
	}
}