<?php namespace BizMark\BonusesShopaholic\Classes\Event\User;

use BizMark\BonusesShopaholic\Models\Card;
use Lovata\Buddies\Classes\Item\UserItem;
use Lovata\Buddies\Models\User;
use Lovata\Toolbox\Classes\Event\ModelHandler;

class UserModelHandler extends ModelHandler
{
    /** @var User */
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
            $this->extendUserModel($obElement);
        });
    }

    protected function extendUserModel(User $obElement)
    {
        $obElement->hasMany['cards'] = [
            Card::class,
            'key' => 'user_id'
        ];

        $obElement->addDynamicMethod('getCardAttribute', function () use ($obElement){
            return $obElement->cards()->first();
        });
    }

    protected function getModelClass()
    {
        return User::class;
    }

    protected function getItemClass()
    {
        return UserItem::class;
    }
}
