<?php

namespace App\EloquentModels\Admin;

use App\Notifications\Admin\User\ResetPasswordNotification;
use App\Traits\BootUuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxInterval extends Model
{
    use Notifiable, SoftDeletes;
    use BootUuids;

    public $incrementing = false;
    protected $connection = 'sqlite_admin';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $table = 'tax_intervals';
    protected $casts = [
        'id'     => 'uuid',
        'tax_id' => 'uuid',
        'min'    => 'string',
        'max'    => 'string'
    ];
    protected $dates = [
        'deleted_at',
        'updated_at',
        'created_at'
    ];
    protected $fillable = [
        'id',
        'tax_id',
        'min',
        'max',
        'deleted_at',
        'updated_at',
        'created_at'
    ];


    public function intervals()
    {
        return $this->belongsTo(Tax::class, 'tax_id', 'id');
    }
}
