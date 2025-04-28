<?php

declare(strict_types=1);

namespace Aality\SyliusReassuranceBundle\EventSubscriber;

use App\Entity\User\AdminUser;
use Knp\Menu\MenuItem;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class AdminMenuSubscriber implements EventSubscriberInterface
{
    public function __construct(private Security $security)
    {

    }

    public static function getSubscribedEvents(): array
    {
        return [
            'sylius.menu.admin.main' => 'modifyAdminMenu',
        ];
    }

    public function modifyAdminMenu(MenuBuilderEvent $event): void
    {
        /** @var MenuItem $menu */
        $menu        = $event->getMenu();
        $configurationMenu = $menu->getChild('configuration');
        $supportMenu = $menu->getChild('official_support');


        $menu->removeChild('configuration');
        $menu->removeChild('official_support');

        $menu
            ->addChild('reassurance')
            ->setLabel('Réassurance')
            ->setLabelAttribute('icon', 'tabler:align-box-left-stretch')
        ;

        $menu->addChild($configurationMenu);
        $menu->addChild($supportMenu);

        $menuReassurance = $menu->getChild('reassurance');


        $menuReassurance->addChild('reassuranceIndex', ['route' => 'aality_reassurance_admin_reassurance_index'])->setLabel('Réassurances');
        $menuReassurance->addChild('reassuranceCreate', ['route' => 'aality_reassurance_admin_reassurance_create'])->setLabel('Nouvelle réassurance');
        $menuReassurance->addChild('reassuranceConfiguration', ['route' => 'aality_reassurance_admin_configuration'])->setLabel('Réglages');

    }
}
