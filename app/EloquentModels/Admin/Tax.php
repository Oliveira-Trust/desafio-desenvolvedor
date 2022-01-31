<?php

namespace App\EloquentModels\Admin;

use App\Notifications\Admin\User\ResetPasswordNotification;
use App\Traits\BootUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use Notifiable, SoftDeletes;
    use BootUuids;

    public $incrementing = false;
    protected $connection = 'sqlite_admin';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $table = 'taxes';
    protected $casts = [
        'id'       => 'uuid',
        'setup_id' => 'uuid',
        'name'     => 'string',
        'value'    => 'double',
    ];
    protected $dates = [
        'deleted_at',
        'updated_at',
        'created_at',
    ];
    protected $fillable = [
        'id',
        'setup_id',
        'name',
        'value',
        'updated_at',
        'created_at',
    ];


    public function interval()
    {
        return $this->hasOne(TaxInterval::class, 'tax_id', 'id');
    }

    public function setup()
    {
        return $this->belongsTo(ExchangePurchaseSetup::class, 'setup_id', 'id');
    }

    /**
     * @return float
     */
    public function getExchageTaxTotal(float $amount)
    {
        return (float)(($this->value / 100) * $amount);
    }
}
