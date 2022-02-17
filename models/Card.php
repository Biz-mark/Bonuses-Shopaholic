<?php namespace BizMark\BonusesShopaholic\Models;

use Model, Str;
use Lovata\Buddies\Models\User;

/**
 * Card Model
 * @package BizMark\Ermolino\Models
 * @author Nick Khaetsky, Biz-Mark, nick@biz-mark.ru
 *
 * @mixin \October\Rain\Database\Builder
 * @mixin \Eloquent
 *
 * @property int                                            $id
 * @property string                                         $number
 * @property int                                            $bonuses
 * @property \October\Rain\Argon\Argon                      $created_at
 * @property \October\Rain\Argon\Argon                      $updated_at
 *
 * Relations
 * @property int                                            $user_id
 * @property User                                           $user
 * @method \October\Rain\Database\Relations\BelongsTo|User  user()
 *
 * @property Action[]                                       $actions
 * @method \October\Rain\Database\Relations\HasMany|Action  actions()
 *
 * Scopes
 * @method static $this                                     getByNumber(string $sCardNumber)
 */
class Card extends Model
{
    use \October\Rain\Database\Traits\Validation;

    const CARD_SECTIONS = 4;

    /**
     * @var string table associated with the model
     */
    public $table = 'bizmark_bonuses_shopaholic_cards';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array rules for validation
     */
    public $rules = [];

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
        'created_at',
        'updated_at'
    ];

    /**
     * @var array hasOne and other relations
     */
    public $hasMany = [
        'actions' => [
            Action::class,
            'key' => 'card_id',
            'delete' => true
        ]
    ];
    public $belongsTo = [
        'user' => User::class
    ];

    public function beforeSave()
    {
        if (empty($this->number)) {
            $this->number = $this->generateCardNumber();
        }
    }

    public function afterSave()
    {
        if ($this->isDirty('bonuses') && $this->getOriginal('bonuses') != $this->bonuses) {
            $this->logAction();
        }
    }

    protected function generateCardNumber(): string
    {
        $bAvailableCardNumber = false;
        do {
            $arSections = [];
            for ($i = 1; $i < self::CARD_SECTIONS; $i++) {
                $arSections[] = Str::upper(Str::random(3));
            }

            $sCardNumber = implode('-', $arSections);

            if (empty($this->getByNumber($sCardNumber)->first())) {
                $bAvailableCardNumber = true;
            }
        } while (!$bAvailableCardNumber);

        return $sCardNumber;
    }

    protected function logAction()
    {
        $iOldValue = $this->getOriginal('bonuses') ?? 0;
        $iNewValue = $this->bonuses;
        $iValue = $iNewValue;
        $iType = 2;

        if ($iOldValue > $iNewValue){
            $iType = 0;
            $iValue = $iNewValue - $iOldValue;
        } elseif ($iOldValue < $iNewValue) {
            $iType = 1;
            $iValue = $iNewValue - $iOldValue;
        }

        Action::create([
            'card_id' => $this->id,
            'type' => $iType,
            'value' => $iValue,
        ]);
    }

    /**
     * @param \October\Rain\Database\Builder|Card $obQuery
     * @param string $sCardNumber
     */
    public function scopeGetByNumber($obQuery, string $sCardNumber)
    {
        $obQuery->where('number', $sCardNumber);
    }
}
