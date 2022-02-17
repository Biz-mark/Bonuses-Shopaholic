<?php namespace BizMark\BonusesShopaholic\Classes\Event\Order;

use BizMark\BonusesShopaholic\Classes\PromoMechanism\BonusesDiscountTotalPrice;
use BizMark\BonusesShopaholic\Models\Card;
use Lovata\Buddies\Classes\Item\UserItem;
use Lovata\OrdersShopaholic\Classes\Processor\OrderProcessor;
use Lovata\OrdersShopaholic\Models\Order;
use October\Rain\Events\Dispatcher;

/**
 * Class ExtendOfferFieldsHandler
 * @package BizMark\BonusesShopaholic\Classes\Event\Order
 */
class OrderModelHandler
{
    public function subscribe(Dispatcher $obEvent)
    {
        $obEvent->listen(OrderProcessor::EVENT_ORDER_CREATED, function ($obOrder) {
            $this->withdrawBonuses($obOrder);
        });
    }

    /**
     * @param Order $obOrder
     */
    protected function withdrawBonuses(Order $obOrder)
    {
        if (empty($obOrder->user_id)) {
            return;
        }

        $obUser = $obOrder->user;
        if (empty($obUser->card)) {
            return;
        }

        /** @var Card $obCard */
        $obCard = $obOrder->card;

        if ($obOrder->order_promo_mechanism()->count() <= 0) {
            return;
        }

        foreach ($obOrder->order_promo_mechanism as $obPromoMechanism) {
            if ($obPromoMechanism->type == BonusesDiscountTotalPrice::class) {
                $obCard->bonuses = $obCard->bonuses - $obPromoMechanism->discount_value;
                $obCard->save();
            }
        }

        $this->clearCaches($obOrder);
    }

    /**
     * Clear caches
     *
     * @param Order $obOrder
     */
    protected function clearCaches(Order $obOrder)
    {
        UserItem::clearCache($obOrder->user_id);
    }
}
