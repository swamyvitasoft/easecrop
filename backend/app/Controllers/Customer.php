<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\CustomerModel;
use App\Models\DroneModel;

class Customer extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $customerInfo;
    private $customerModel;
    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->loggedInfo = session()->get('LoggedData');
    }
    public function index()
    {
        $this->customerInfo = $this->customerModel->findAll();
        $data = [
            'pageTitle' => 'EASE CROP | Customer',
            'pageHeading' => 'Customer',
            'loggedInfo' => $this->loggedInfo,
            'customerInfo'    => $this->customerInfo
        ];
        return view('common/top', $data)
            . view('customer/index')
            . view('common/bottom');
    }
}
