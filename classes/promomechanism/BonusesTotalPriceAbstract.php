<?php namespace BizMark\BonusesShopaholic\Classes\PromoMechanism;

use Lovata\Buddies\Facades\AuthHelper;
use BizMark\BonusesShopaholic\Models\Card;
use Lovata\OrdersShopaholic\Classes\PromoMechanism\InterfacePromoMechanism;
use Lovata\OrdersShopaholic\Classes\PromoMechanism\AbstractPromoMechanism;

/**
 * Class BonusesTotalPriceAbstract
 * @package BizMark\BonusesShopaholic\Classes\PromoMechanism
 */
abstract class BonusesTotalPriceAbstract extends AbstractPromoMechanism implements InterfacePromoMechanism
{

    /**
     * Check discount condition
     * @param \Lovata\OrdersShopaholic\Classes\PromoMechanism\OrderPromoMechanismProcessor $obProcessor
     * @param \Lovata\OrdersShopaholic\Classes\Item\CartPositionItem $obPosition
     * @return bool
     * @throws \Exception
     */
    protected function check($obProcessor, $obPosition = null): bool
    {
        if (!parent::check($obProcessor, $obPosition)) {
            return false;
        }

        if (!AuthHelper::check()) {
            return false;
        }

        // Get requested amount
        try {
            $iRequestedBonuses = request()->get('bonuses') ?? 0;
        } catch (\Exception $e) {
            return false;
        }

        // Get user
        $obUser = AuthHelper::getUser();
        if (empty($obUser) || empty($obUser->card)) {
            return false;
        }

        /** @var Card $obCard */
        $obCard = $obUser->card;

        // Check that user has required amount of bonuses
        if ($obCard->bonuses == 0 || $obCard->bonuses < $iRequestedBonuses) {
            return false;
        }

        // User has valid amount of bonuses and can use them in this order
        return true;
    }
}
