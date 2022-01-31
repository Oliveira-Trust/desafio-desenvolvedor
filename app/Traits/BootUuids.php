<?php
namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait BootUuids
{

	/**
	 * Boot function from laravel.
	 */
	protected static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			$model->incrementing = false;
			$model->{$model->getKeyName()} = Uuid::uuid4();
		});
	}
}
