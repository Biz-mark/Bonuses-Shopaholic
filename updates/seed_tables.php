<?php namespace BizMark\BonusesShopaholic\Updates;

use October\Rain\Database\Updates\Migration;
use Lovata\OrdersShopaholic\Models\PromoMechanism;
use BizMark\BonusesShopaholic\Classes\PromoMechanism\BonusesDiscountTotalPrice;

/**
 * SeedTables Migration
 */
class SeedTables extends Migration
{
    public function up()
    {
        if (PromoMechanism::query()->where('type', BonusesDiscountTotalPrice::class)->exists()) {
            return;
        }

        PromoMechanism::create([
            'name' => 'Бонусы',
            'type' => BonusesDiscountTotalPrice::class,
            'increase' => 0,
            'auto_add' => 1,
            'priority' => 100,
            'discount_value' => 0.00,
            'discount_type' => 'fixed',
            'final_discount' => 0,
            'property' => json_decode('{"amount":"","offer_limit":"","quantity_limit":"","quantity_limit_from":"","position_limit":"","shipping_type_id":"","payment_method_id":""}'),
        ]);
    }

    public function down()
    {
        // ...
    }
}
