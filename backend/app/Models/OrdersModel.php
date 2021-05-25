<?php

namespace App\Models;
use CodeIgniter\Model;

class OrdersModel extends Model {
  protected $table = 'orders';
  protected $allowedFields = ['client_id', 'items', 'status'];
}