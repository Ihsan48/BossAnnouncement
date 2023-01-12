<?php

namespace xenialdan\BossAnnouncement;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\player\Player;

class EventListener implements Listener {

    public function onJoin(PlayerJoinEvent $ev): void
    {
        if (Loader::getInstance()->isWorldEnabled($ev->getPlayer()->getWorld()->getFolderName())) {
            Loader::getInstance()->bar->addPlayer($ev->getPlayer());
        }
    }

    public function onLeave(PlayerQuitEvent $ev): void
    {
        Loader::getInstance()->bar->removePlayer($ev->getPlayer());
    }

    public function onLevelChange(EntityTeleportEvent  $ev) : void {
        $entity = $ev->getEntity();
        if ($ev->isCancelled() || !$entity instanceof Player) {
            return;
        }
        Loader::getInstance()->bar->removePlayer($entity);
        if (Loader::getInstance()->isWorldEnabled($ev->getTo()->getWorld()->getFolderName())) {
            Loader::getInstance()->bar->addPlayer($entity);
        }
    }

}