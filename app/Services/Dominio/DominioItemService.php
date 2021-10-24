<?php


namespace App\Services\Dominio;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dominio\DominioItem;

class DominioItemService
{

    public function __construct()
    {
    }

    public function getDominioItensById(string $id){
        return DominioItem::query()
            ->where('dominio_id', $id)
            ->get([
                'dominio_id',
                'dsc_dominio_item',
                'val_dominio_item'
            ]);
    }

}
