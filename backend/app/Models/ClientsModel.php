<?php

namespace App\Models;
use CodeIgniter\Model;

class ClientsModel extends Model {
  protected $table = 'clients';
  protected $allowedFields = ['name', 'document', 'email', 'birthday', 'phone'];
}