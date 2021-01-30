<?php

namespace SilencedTick880;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\entity\Human;

class Main extends PluginBase implements Listener {
         
         public function onEnable(){
                  $this->getServer()->getPluginManager()->registerEvents($this, $this);
                  @mkdir($this->getDataFolder());
                  $this->saveDefaultConfig();
                  $this->getResources("config.yml");
         }
         
         public function onDeath(EntityDamageEvent $event){
                  $player = $event->getEntity();
                  
                  if($event->getFinalDamage() >= $player->getHealth()) {
                           if($player instanceof Human) {
                                    $event->setCancelled();
                                    $player->setHealth($player->getMaxHealth());
                                    $sender->teleport($this->getServer()->getDefaultLevel()->getSpawnLocation());
                                    $this->Configs($player);
                                    return true;
                           }
                  }
         }
         
         public function Configs($player){
                  if($this->getConfig()->get("send_title") == true){
                           $player->addTitle($this->getConfig()->get("title"), $this->getConfig()->get("subtitle"));
                           return true;
                  }
         }
}
