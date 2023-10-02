<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CurrencyConversion Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $origin_currency
 * @property string $destination_currency
 * @property float $value_to_convert
 * @property string $payment_method
 * @property float $destination_currency_conversion_value
 * @property float $destination_currency_purchased_value
 * @property float $payment_tax
 * @property float $conversion_tax
 * @property float $conversion_value_without_tax
 * @property \Cake\I18n\DateTime $created
 */
class CurrencyConversion extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'origin_currency' => true,
        'destination_currency' => true,
        'value_to_convert' => true,
        'payment_method' => true,
        'destination_currency_conversion_value' => true,
        'destination_currency_purchased_value' => true,
        'payment_tax' => true,
        'conversion_tax' => true,
        'conversion_value_without_tax' => true,
        'created' => true,
    ];
}
