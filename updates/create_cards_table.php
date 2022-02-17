<?php namespace BizMark\BonusesShopaholic\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateCardsTable Migration
 */
class CreateCardsTable extends Migration
{
    const TABLE_NAME = 'bizmark_bonuses_shopaholic_cards';

    public function up()
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            return;
        }

        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('number')->unique()->index();
            $table->integer('bonuses')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
