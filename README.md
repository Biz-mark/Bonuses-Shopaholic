# Bonuses-Shopaholic

This plugin allows your customers to have bonus cards and use them as discount to orders. 

## Features

- Unlimited bonus cards per user
- You can set bonus value of each offer at administration panel!
- Actions log of each card, you can show in personal user dashboard history of card withdrawals and top ups!
- Flexible promo-mechanism, that can be tweaked as any other promo-mechanism!
- Easy to use, just add one parameter to request and bonuses will apply automatically!

## Installation

```
php artisan plugin:install BizMark.BonusesShopaholic
```

Required plugins:

- Lovata.ToolBox
- Lovata.Shopaholic
- Lovata.OrdersShopaholic
- Lovata.Buddies


## Usage

After migrating database, new promo-mechanism will be created for you with "Auto-apply" checkbox enabled. 
That means that this promo-mechanism always enabled at user cart and order. 
All you need to do to apply bonuses to cart or order just add get parameter `bonuses` with any amount to each request to cart or order

---
© 2022, Biz-Mark under MIT License.

Developed by Nick Khaetsky at Biz-Mark.
