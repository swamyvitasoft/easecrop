<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table      = 'customer';
    protected $primaryKey = 'customer_id';
    protected $allowedFields = ['name', 'mobile', 'reference_id', 'login_id', 'status'];
}
