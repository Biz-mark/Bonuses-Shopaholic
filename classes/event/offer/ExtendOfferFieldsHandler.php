<?php namespace BizMark\BonusesShopaholic\Classes\Event\Offer;

use Lovata\Shopaholic\Controllers\Offers;
use Lovata\Shopaholic\Models\Offer;
use Lovata\Toolbox\Classes\Event\AbstractBackendFieldHandler;

/**
 * Class ExtendOfferFieldsHandler
 * @package BizMark\BonusesShopaholic\Classes\Event\Offer
 */
class ExtendOfferFieldsHandler extends AbstractBackendFieldHandler
{
    /**
     * Extend fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function extendFields($obWidget)
    {
        $this->removeField($obWidget);
        $this->addField($obWidget);
    }

    /**
     * Remove fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function removeField($obWidget)
    {
    }

    /**
     * Add fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function addField($obWidget)
    {
        $obWidget->addTabFields([
            'bonuses' => [
                'tab' => 'lovata.toolbox::lang.tab.settings',
                'label' => 'bizmark.bonusesshopaholic::lang.fields.bonuses',
                'type' => 'number',
                'default' => 0,
                'span' => 'left'
            ],
        ]);
    }

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass() : string
    {
        return Offer::class;
    }

    /**
     * Get controller class name
     * @return string
     */
    protected function getControllerClass() : string
    {
        return Offers::class;
    }
}
