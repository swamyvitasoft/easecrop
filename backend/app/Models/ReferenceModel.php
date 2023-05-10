<?php

namespace App\Models;

use CodeIgniter\Model;

class ReferenceModel extends Model
{
    protected $table      = 'reference';
    protected $primaryKey = 'reference_id';
    protected $allowedFields = ['name', 'mobile', 'status'];
}
