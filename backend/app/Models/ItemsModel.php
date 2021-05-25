<?php

namespace App\Models;
use CodeIgniter\Model;

class ItemsModel extends Model {
  protected $table = 'items';
  protected $allowedFields = ['description', 'cost_price', 'retail_price'];
}