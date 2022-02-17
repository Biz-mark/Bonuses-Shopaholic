<?php namespace BizMark\BonusesShopaholic\Classes\Event\User;

use Lovata\Buddies\Controllers\Users;
use Lovata\Buddies\Models\User;
use Lovata\Toolbox\Classes\Event\AbstractBackendFieldHandler;

/**
 * Class ExtendUserFieldsHandler
 * @package BizMark\BonusesShopaholic\Classes\Event\User
 */
class ExtendUserFieldsHandler extends AbstractBackendFieldHandler
{
    /**
     * Extend fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function extendFields($obWidget)
    {
        $this->addField($obWidget);
    }

    /**
     * Add fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function addField($obWidget)
    {
        $obWidget->addTabFields([
            'cards' => [
                'tab' => 'bizmark.bonusesshopaholic::lang.tab.cards',
                'span' => 'full',
                'type' => 'partial',
                'path' => '$/bizmark/bonusesshopaholic/views/cards.htm'
            ]
        ]);
    }

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass() : string
    {
        return User::class;
    }

    /**
     * Get controller class name
     * @return string
     */
    protected function getControllerClass() : string
    {
        return Users::class;
    }
}
