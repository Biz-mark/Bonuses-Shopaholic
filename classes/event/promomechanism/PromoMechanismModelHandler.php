<?php namespace BizMark\BonusesShopaholic\Classes\Event\PromoMechanism;

use BizMark\BonusesShopaholic\Classes\PromoMechanism\BonusesDiscountTotalPrice;
use Lovata\Buddies\Facades\AuthHelper;
use Lovata\OrdersShopaholic\Classes\PromoMechanism\PromoMechanismStore;
use Lovata\OrdersShopaholic\Models\PromoMechanism;
use Lovata\OrdersShopaholic\Controllers\PromoMechanisms;
use BizMark\Elektro\Classes\PromoMechanism\UserDiscountTotalPrice;

/**
 * Class PromoMechanismModelHandler
 * @package BizMark\BonusesShopaholic\Classes\Event\PromoMechanism
 */
class PromoMechanismModelHandler
{
    /** @var PromoMechanism */
    protected $obElement;

    /**
     * Add listeners
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        PromoMechanism::extend(function ($obElement) {
            $this->addDynamicMethods($obElement);
        });

        $obEvent->listen(PromoMechanismStore::EVENT_ADD_PROMO_MECHANISM_CLASS, function () {
            return [BonusesDiscountTotalPrice::class];
        });
    }

    protected function addDynamicMethods(PromoMechanism $obElement)
    {
        $obElement->addDynamicMethod('getDiscountValueAttribute', function ($iValue) {
            $obUser = AuthHelper::getUser();
            if (empty($obUser) || empty($obUser->card)) {
                return $iValue;
            }

            $iRequestedBonuses = e(request()->get('bonuses'));
            if (empty($iRequestedBonuses)) {
                return $iValue;
            }

            return (int) $iRequestedBonuses;
        });
    }

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return PromoMechanism::class;
    }

    protected function getControllerClass()
    {
        return PromoMechanisms::class;
    }
}
