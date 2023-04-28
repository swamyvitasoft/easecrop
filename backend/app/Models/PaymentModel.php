<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table      = 'payment';
    protected $primaryKey = 'payment_id';
    protected $allowedFields = ['customer_id', 'crop_place', 'reference_id', 'acre', 'service', 'crop', 'crop_age', 'fertilizer', 'estimated_date', 'amount', 'login_id', 'status'];
}
