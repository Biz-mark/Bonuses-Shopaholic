<?php namespace BizMark\BonusesShopaholic\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateActionsTable Migration
 */
class CreateActionsTable extends Migration
{
    const TABLE_NAME = 'bizmark_bonuses_shopaholic_actions';

    public function up()
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            return;
        }

        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('card_id')->unsigned()->index();
            $table->integer('type')->default(0);
            $table->integer('value')->default(0);
            $table->string('description')->nullable();
            $table->boolean('is_done')->default(1);
            $table->timestamp('action_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
