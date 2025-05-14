<?php

declare(strict_types=1);

namespace Aality\SyliusReassuranceBundle\EventSubscriber;

use App\Entity\User\AdminUser;
use Knp\Menu\MenuItem;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class AdminMenuSubscriber implements EventSubscriberInterface
{
    public function __construct(private Security $security, private TranslatorInterface $translator)
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
            ->setLabel($this->translator->trans('aality_reassurance.menu.main'))
            ->setLabelAttribute('icon', 'tabler:align-box-left-stretch')
        ;

        $menu->addChild($configurationMenu);
        $menu->addChild($supportMenu);

        $menuReassurance = $menu->getChild('reassurance');


        $menuReassurance->addChild('reassuranceIndex', ['route' => 'aality_reassurance_admin_reassurance_index'])->setLabel($this->translator->trans('aality_reassurance.menu.list'));
        $menuReassurance->addChild('reassuranceCreate', ['route' => 'aality_reassurance_admin_reassurance_create'])->setLabel($this->translator->trans('aality_reassurance.menu.new'));
        $menuReassurance->addChild('reassuranceConfiguration', ['route' => 'aality_reassurance_admin_configuration'])->setLabel($this->translator->trans('aality_reassurance.menu.settings'));

    }
}
