<?php namespace BizMark\BonusesShopaholic\Classes\Event\Offer;

use BizMark\Ermolino\Classes\Helper\ShopHelper;
use BizMark\Ermolino\Models\Availability;
use Lovata\Toolbox\Classes\Event\ModelHandler;
use Lovata\Shopaholic\Models\Offer;
use Lovata\Shopaholic\Classes\Item\OfferItem;

/**
 * Class OfferModelHandler
 * @package BizMark\BonusesShopaholic\Classes\Event\Offer
 */
class OfferModelHandler extends ModelHandler
{
    /** @var Offer */
    protected $obElement;

    /**
     * Add listeners
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        parent::subscribe($obEvent);
        $sModelClass = $this->getModelClass();
        $sModelClass::extend(function ($obElement) {
            $this->extendOfferModel($obElement);
        });
    }

    protected function extendOfferModel(Offer $obElement)
    {
        $obElement->addFillable(['bonuses']);
        $obElement->addCachedField(['bonuses']);
    }

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Offer::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return OfferItem::class;
    }
    /**
     * After create event handler
     */
    protected function afterCreate()
    {
        parent::afterCreate();
    }

    /**
     * After save event handler
     */
    protected function afterSave()
    {
        parent::afterSave();
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();
    }
}
