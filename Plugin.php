<?php namespace BizMark\BonusesShopaholic;

use Backend, Event;
use BizMark\BonusesShopaholic\Classes\Event\Order\OrderModelHandler;
use BizMark\BonusesShopaholic\Classes\Event\PromoMechanism\PromoMechanismModelHandler;
use System\Classes\PluginBase;
use BizMark\BonusesShopaholic\Classes\Event\User\ExtendUserFieldsHandler;
use BizMark\BonusesShopaholic\Classes\Event\User\UserModelHandler;
use BizMark\BonusesShopaholic\Classes\Event\User\UsersControllerHandler;
use BizMark\BonusesShopaholic\Classes\Event\Offer\ExtendOfferFieldsHandler;
use BizMark\BonusesShopaholic\Classes\Event\Offer\OfferModelHandler;
use BizMark\BonusesShopaholic\Classes\Event\PromoMechanism\BonusesDiscountTotalPrice;

/**
 * BonusesShopaholic Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'Lovata.Toolbox',
        'Lovata.Buddies',
        'Lovata.Shopaholic',
        'Lovata.OrdersShopaholic'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'bizmark.bonusesshopaholic::lang.plugins.name',
            'description' => 'bizmark.bonusesshopaholic::lang.plugins.description',
            'author'      => 'Nick Khaetsky, Biz-Mark',
            'icon'        => 'icon-plus-circle'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $this->addEventListeners();
    }

    protected function addEventListeners()
    {
        // Users
        Event::subscribe(UserModelHandler::class);
        Event::subscribe(UsersControllerHandler::class);
        Event::subscribe(ExtendUserFieldsHandler::class);

        // Offers
        Event::subscribe(OfferModelHandler::class);
        Event::subscribe(ExtendOfferFieldsHandler::class);

        // PromoMechanisms
        Event::subscribe(PromoMechanismModelHandler::class);

        // Orders
        Event::subscribe(OrderModelHandler::class);
    }
}
