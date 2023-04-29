<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\CustomerModel;
use App\Models\DroneModel;
use App\Models\PaymentModel;

class Customer extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $customerInfo;
    private $customerModel;
    private $paymentModel;
    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->loggedInfo = session()->get('LoggedData');
        $this->paymentModel = new PaymentModel();
    }
    public function index()
    {
        if ($this->loggedInfo['role'] == "Drone") {
            $this->customerInfo = $this->customerModel->where(['login_id' => $this->loggedInfo['login_id']])->findAll();
        } else {
            $this->customerInfo = $this->customerModel->findAll();
        }

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
    public function view()
    {
        $mobile = $this->request->getPost("mobile");
        $customerData = $this->customerModel->where(['mobile' => $mobile])->findAll();
        if (!empty($customerData)) {
            $data = [
                'success' => true,
                'customer_id'   => $customerData[0]['customer_id'],
                'name'   => $customerData[0]['name'],
                'mobile'   => $customerData[0]['mobile'],
                'msg' => "Exists Employee Check your Data"
            ];
        } else {
            $data = [
                'customer_id' => ''
            ];
        }
        return $this->response->setJSON($data);
    }
    public function show($customer_id = 0)
    {
        $customerData = $this->customerModel->where(['customer_id' => $customer_id])->findAll();
        $paymentData = $this->paymentModel->where(['customer_id' => $customer_id])->findAll();
        $data = [
            'pageTitle' => 'EASE CROP | Customer',
            'pageHeading' => 'Customer(' . $customerData[0]['name'] . ')',
            'loggedInfo' => $this->loggedInfo,
            'paymentData'    => $paymentData
        ];
        return view('common/top', $data)
            . view('customer/history')
            . view('common/bottom');
    }
    public function credit()
    {
        $this->customerModel->table('customer');
        $this->customerModel->select('customer.*');
        $this->customerModel->join('payment', 'payment.customer_id = customer.customer_id');
        if ($this->loggedInfo['role'] == "Drone") {
            $this->customerInfo = $this->customerModel->where(['payment.payment_type' => 'Credit', 'payment.login_id' => $this->loggedInfo['login_id']])->findAll();
        } else {
            $this->customerInfo = $this->customerModel->where(['payment.payment_type' => 'Credit'])->findAll();
        }
        $data = [
            'pageTitle' => 'EASE CROP | Customer',
            'pageHeading' => 'Customer(Pending List)',
            'loggedInfo' => $this->loggedInfo,
            'customerInfo'    => $this->customerInfo
        ];
        return view('common/top', $data)
            . view('customer/index')
            . view('common/bottom');
    }
    public function cash()
    {
        $this->customerModel->table('customer');
        $this->customerModel->select('customer.*');
        $this->customerModel->join('payment', 'payment.customer_id = customer.customer_id');
        if ($this->loggedInfo['role'] == "Drone") {
            $this->customerInfo = $this->customerModel->where(['payment.payment_type' => 'Cash', 'payment.login_id' => $this->loggedInfo['login_id']])->groupBy('customer.mobile')->findAll();
        } else {
            $this->customerInfo = $this->customerModel->where(['payment.payment_type' => 'Cash'])->groupBy('customer.mobile')->findAll();
        }
        $data = [
            'pageTitle' => 'EASE CROP | Customer',
            'pageHeading' => 'Customer(Paid List)',
            'loggedInfo' => $this->loggedInfo,
            'customerInfo'    => $this->customerInfo
        ];
        return view('common/top', $data)
            . view('customer/index')
            . view('common/bottom');
    }
}
