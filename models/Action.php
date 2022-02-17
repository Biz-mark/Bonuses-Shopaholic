<?php namespace BizMark\BonusesShopaholic\Models;

use Model;

/**
 * Action Model
 * @package BizMark\Ermolino\Models
 * @author Nick Khaetsky, Biz-Mark, nick@biz-mark.ru
 *
 * @mixin \October\Rain\Database\Builder
 * @mixin \Eloquent
 *
 * @property int                                           $id
 * @property int                                           $type
 * @property int                                           $value
 * @property string|null                                   $description
 * @property boolean                                       $is_done
 * @property \October\Rain\Argon\Argon|null                $action_at
 * @property \October\Rain\Argon\Argon                     $created_at
 * @property \October\Rain\Argon\Argon                     $updated_at
 *
 * Relations
 * @property int                                           $card_id
 * @property Card                                          $card
 * @method \October\Rain\Database\Relations\BelongsTo|Card card()
 */
class Action extends Model
{
    use \October\Rain\Database\Traits\Validation;

    const TYPE = [
        0 => 'bizmark.bonusesshopaholic::lang.action.type_0',
        1 => 'bizmark.bonusesshopaholic::lang.action.type_1',
        2 => 'bizmark.bonusesshopaholic::lang.action.type_2'
    ];

    /**
     * @var string table associated with the model
     */
    public $table = 'bizmark_bonuses_shopaholic_actions';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = [
        'card_id',
        'type',
        'value',
        'description',
        'is_done',
        'action_at'
    ];

    /**
     * @var array rules for validation
     */
    public $rules = [
        'type' => 'required',
        'value' => 'required'
    ];

    /**
     * @var array hidden attributes removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array dates attributes that should be mutated to dates
     */
    protected $dates = [
        'action_at',
        'created_at',
        'updated_at'
    ];

    /**
     * @var array hasOne and other relations
     */
    public $belongsTo = [
        'card' => Card::class
    ];

    public function getHumanTypeAttribute(): string
    {
        return self::TYPE[$this->type];
    }
}
