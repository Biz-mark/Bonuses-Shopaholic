<?php namespace BizMark\BonusesShopaholic\Classes\PromoMechanism;

/**
 * Class UserDiscountTotalPrice
 * @package BizMark\BonusesShopaholic\Classes\PromoMechanism
 */
class BonusesDiscountTotalPrice extends BonusesTotalPriceAbstract
{
    const LANG_NAME = 'bizmark.bonusesshopaholic::lang.promo-mechanism';

    /**
     * Get discount type
     * @return string
     */
    public static function getType() : string
    {
        return self::TYPE_TOTAL_PRICE;
    }
}
