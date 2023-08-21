<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\CustomerModel;
use App\Models\DroneModel;
use App\Models\PaymentModel;
use App\Models\ReferenceModel;

class Customer extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $customerInfo;
    private $customerModel;
    private $paymentModel;
    private $referenceModel;
    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->loggedInfo = session()->get('LoggedData');
        $this->paymentModel = new PaymentModel();
        $this->referenceModel = new ReferenceModel();
    }
    public function index()
    {
        if ($this->loggedInfo['role'] == "Admin") {
            $this->customerInfo = $this->customerModel->table('customer')
                ->join('payment', 'payment.customer_id = customer.customer_id')
                ->groupBy('payment.customer_id')->findAll();
        } else if ($this->loggedInfo['role'] == "Drone") {
            $this->customerInfo = $this->customerModel->table('customer')
                ->join('payment', 'payment.customer_id = customer.customer_id')
                ->where(['payment.login_id' => $this->loggedInfo['login_id']])
                ->groupBy('payment.customer_id')->findAll();
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
    public function view1()
    {
        $mobile = $this->request->getPost("mobile");
        $referenceData = $this->referenceModel->where(['mobile' => $mobile])->findAll();
        if (!empty($referenceData)) {
            $data = [
                'success' => true,
                'reference_id'   => $referenceData[0]['reference_id'],
                'name'   => $referenceData[0]['name'],
                'mobile'   => $referenceData[0]['mobile'],
                'msg' => "Exists Employee Check your Data"
            ];
        } else {
            $data = [
                'reference_id' => ''
            ];
        }
        return $this->response->setJSON($data);
    }
    public function show($customer_id = 0)
    {
        $customerData = $this->customerModel->where(['customer_id' => $customer_id])->findAll();
        $paymentData = $this->paymentModel->where(['customer_id' => $customer_id, 'login_id' => $this->loggedInfo['login_id']])->findAll();
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
        if ($this->loggedInfo['role'] == "Admin") {
            $this->customerInfo = $this->customerModel->table('customer')
                ->join('payment', 'payment.customer_id = customer.customer_id')
                ->where(['payment.payment_type' => 'Pending'])
                ->groupBy('payment.customer_id')->findAll();
        } else if ($this->loggedInfo['role'] == "Drone") {
            $this->customerInfo = $this->customerModel->table('customer')
                ->join('payment', 'payment.customer_id = customer.customer_id')
                ->where(['payment.payment_type' => 'Pending', 'payment.login_id' => $this->loggedInfo['login_id']])
                ->groupBy('payment.customer_id')->findAll();
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
        if ($this->loggedInfo['role'] == "Admin") {
            $this->customerInfo = $this->customerModel->table('customer')
                ->join('payment', 'payment.customer_id = customer.customer_id')
                ->where(['payment.payment_type' => 'Paid'])
                ->groupBy('payment.customer_id')->findAll();
        } else if ($this->loggedInfo['role'] == "Drone") {
            $this->customerInfo = $this->customerModel->table('customer')
                ->join('payment', 'payment.customer_id = customer.customer_id')
                ->where(['payment.payment_type' => 'Paid', 'payment.login_id' => $this->loggedInfo['login_id']])
                ->groupBy('payment.customer_id')->findAll();
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
