<?php

namespace Domain\Exchange\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property Carbon $created_at
 * @property string $exchange_data
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeUsers query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeUsers whereExchangeData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeUsers whereUserId($value)
 * @mixin \Eloquent
 */
class ExchangeUsers extends Model
{
  public $timestamps = false;

  protected $guarded = [];
}