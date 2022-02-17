<?php namespace BizMark\BonusesShopaholic\Classes\Event\User;

use Lovata\Buddies\Controllers\Users;
use Lovata\Toolbox\Classes\Event\AbstractExtendRelationConfigHandler;

/**
 * Class UsersControllerHandler
 * @package BizMark\BonusesShopaholic\Classes\Event\User
 */
class UsersControllerHandler extends AbstractExtendRelationConfigHandler
{
    /**
     * Get controller class name
     * @return string
     */
    protected function getControllerClass() : string
    {
        return Users::class;
    }

    /**
     * Get path to config file
     * @return string
     */
    protected function getConfigPath() : string
    {
        return '$/bizmark/bonusesshopaholic/config/users_cards_config_relation.yaml';
    }
}
