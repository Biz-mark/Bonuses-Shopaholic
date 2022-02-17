<?php

return [
    'plugin' => [
        'name' => 'Bonuses',
        'description' => 'Bonuses system for Shopaholic'
    ],
    'column' => [
        'number' => 'Card number',
        'bonuses' => 'Bonuses'
    ],
    'field' => [
        'number' => [
            'label' => 'Card number',
            'comment' => 'Generated automatically after saving.'
        ],
        'actions' => 'Actions',
        'bonuses' => 'The number of accrued bonuses after the purchase'
    ],
    'tab' => [
        'cards' => 'Bonus cards',
    ],
    'table' => [
        'action' => 'Action',
        'value' => 'Value',
        'comment' => 'Comment',
        'is_done' => 'Done',
        'action_at' => 'Action at',
        'yes' => 'Yes',
        'no' => 'No',
        'immediately' => 'Immediately',
        'no_actions' => 'There have been no actions on the bonus card yet'
    ],
    'action' => [
        'type_0' => 'Balance withdrawal',
        'type_1' => 'Top up of balance',
        'type_2' => 'Other'
    ],
    'button' => [
        'create' => 'Create card',
        'delete' => 'Delete card',
    ],
    'promo-mechanism' => 'Discount on the total amount of the order using user bonuses',
    'promo-mechanism_description' => 'Discount on the <b>total amount</b> of the order in the amount of the specified bonuses.',
];
