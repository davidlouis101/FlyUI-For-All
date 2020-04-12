<?php

namespace Crow\FlyUI;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {


    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::AQUA . "Aktiviert");
    }

    public function onDisable() {
$this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info(TextFormat::RED . "Deaktiviert!");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "fly":
                if ($sender->hasPermission("Fly.command")){
                     $this->openMyForm($sender);
                }else{     
                     $sender->sendMesseage(TextFormat::RED . "You Have No Permission To Fly");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function openMyForm($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $player->sendMessage(TextFormat::AQUA . "Fly >> is now on");
                    $player->addTitle("§l§6FlyUI", "§c§lFly on");
                break;
//Fly Off//
                case 1:
                    $player->sendMessage(TextFormat::RED . "FlUI >> Fly is now off");
                    $player->addTitle("§l§6YouTubeUI", "§c§lFly off");
                break;
                
                                case 2:
                    $player->sendMessage(TextFormat::RED . "FlyUI >> Closed Menu");
                    $player->addTitle("§l§6YouTubeUI", "§c§lClosed Menu");
                break;
            }
            
            //FlyUI//
            });
            $form->setTitle("§l§6FlyUI");
            $form->setContent("FlyUI Code by Crow Balde");
            $form->addButton("§aFly on");
            $form->addButton("§4Fly off");
            $form->addButton("§cClose");
            $form->sendToPlayer($player);
            return $form;                         
    }
}
