<?php

namespace App\Models;

use CodeIgniter\Model;

class DroneModel extends Model
{
    protected $table      = 'drone';
    protected $primaryKey = 'drone_id';
    protected $allowedFields = ['drone_number', 'pilot_operator', 'mobile', 'login_id', 'status'];
}
