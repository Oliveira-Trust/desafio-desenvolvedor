<?php

namespace App\EloquentModels\Admin;

use App\Notifications\Admin\User\ResetPasswordNotification;
use App\Traits\BootUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangePurchaseSetup extends Model
{
    use Notifiable, SoftDeletes;
    use BootUuids;

    public $incrementing = false;
    protected $connection = 'sqlite_admin';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $table = 'setups';
    protected $casts = [
        'id'           => 'uuid',
    ];
    protected $dates = [
        'deleted_at',
        'updated_at',
        'created_at',
    ];
    protected $fillable = [
        'id',
        'deleted_at',
        'updated_at',
        'created_at',
    ];


    public function taxes()
    {
       return $this->hasMany(Tax::class, 'setup_id', 'id');
    }
}
