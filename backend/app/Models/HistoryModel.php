<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table      = 'history';
    protected $primaryKey = 'history_id';
    protected $allowedFields = ['amount_type', 'amount_paid', 'details', 'payment_id', 'login_id', 'create_date'];
}
