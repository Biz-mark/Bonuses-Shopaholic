<?php namespace BizMark\BonusesShopaholic\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * ExtendTables Migration
 */
class ExtendTables extends Migration
{
    const OFFERS_TABLE_NAME = 'lovata_shopaholic_offers';

    public function up()
    {
        if (Schema::hasTable(self::OFFERS_TABLE_NAME)) {
            Schema::table(self::OFFERS_TABLE_NAME, function (Blueprint $obTable) {
                if (!Schema::hasColumn(self::OFFERS_TABLE_NAME, 'bonuses')) $obTable->integer('bonuses')->default(0);
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable(self::OFFERS_TABLE_NAME)) {
            Schema::table(self::OFFERS_TABLE_NAME, function (Blueprint $obTable) {
                if (Schema::hasColumn(self::OFFERS_TABLE_NAME, 'bonuses')) $obTable->dropColumn('bonuses');
            });
        }
    }
}
