<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
	protected $connection = "mysql";

    public function distinct( $column )
	{
		return self::select( $column )->distinct ()->where( $column, '<>', 'null' )->orderBy( $column )
			->lists( $column );
	}

	/**
	 * Fix a problem with format at MSSQL.
	 *
	 * @return Response.
	 */
	public function getCreatedAtAttribute( $date )
	{
		return date_format( date_create( $date ), "d/m/Y H:i" );
	}
}