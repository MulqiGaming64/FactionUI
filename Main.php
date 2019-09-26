<?php

namespace MulqiGaming;

use pocketmine\plugin\PluginBase;
use pocketmine\Player; 
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\level\particle\{DustParticle, FlameParticle, FloatingTextParticle, EntityFlameParticle, CriticalParticle, ExplodeParticle, HeartParticle, LavaParticle, MobSpawnParticle, SplashParticle};
use pocketmine\event\player\PlayerMoveEvent;

class Main extends PluginBase implements Listener {
	
	public $plugin;

	public function onEnable(){
		$this->getLogger()->info("FactionUI Indonesia By MulqiGaming Aktif");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");	
	}
	
	public function onCommand(CommandSender $sender, Command $command, String $label, array $args) : bool {
        switch($command->getName()){
            case "fui":
            $this->FormClan($sender);
            return true;
        }
        return true;
	}
	
	 public function FormClan($sender){
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function(Player $sender, $data){
          $result = $data;
          if($result === null){
          }
          switch($result){
              case 0:
              $sender->addTitle("§b§lFactionUI");
              case 1:
			  $this->Create($sender);
              break;
              case 2:
              $command = "f del";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 3:
              $command = "f leave";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 4:
              $this->Invite($sender);
              break;
              case 5:
              $command = "f topfaction";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 6:
              $command = "f accept";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 7:
              $command = "f accept";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
          }
        });
        $config = $this->getConfig();
        $name = $sender->getName();
        $form->setTitle("§b§lFaction UI");
		$form->addButton("§cBack");
		$form->addButton("§cBuat Team\n§fBuat Faction");
		$form->addButton("§6Hapus Team\n§fHapus Faction");
		$form->addButton("§eKeluar Team\n§fKeluar Faction");
        $form->addButton("§aInvite Temen\n§fInvite Temen");
		$form->addButton("§bTop Team\n§fTop Factiom");
		$form->addButton("§dTerima\n§fTerima");
		$form->addButton("§cJangan Terima\n§fTidak Menerima");
        $form->sendToPlayer($sender);
	}
	
	public function Create($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
				return true;
			}
			$cmd = "f create $data[0]";
			$this->getServer()->getCommandMap()->dispatch($player, $cmd);
		});
		$form->setTitle("§b§lFactionUI");
		$form->addInput("§bMasukan Nama Team");
		$form->sendToPlayer($player);
	}
	
	public function Invite($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
				return true;
			}
			$cmd = "f invite $data[0]";
			$this->getServer()->getCommandMap()->dispatch($player, $cmd);
		});
		$form->setTitle("§b§lFactionUI");
		$form->addInput("§eMasukan Nama Player");
		$form->sendToPlayer($player);
	}
}