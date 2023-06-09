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
        if (!empty($this->request->getPost("start"))) {
            $start = $this->request->getPost("start");
        } else {
            $start = date('d-m-Y', strtotime('2023-01-01'));
        }
        if (!empty($this->request->getPost("end"))) {
            $end = $this->request->getPost("end");
        } else {
            $end = date('Y-m-d');
        }
        if ($this->loggedInfo['role'] == "Admin") {
            $this->customerInfo = $this->paymentModel->select('customer_id,sum(amount) as amount,sum(paid_amount) as paid_amount,sum(due_amount) as due_amount')
                ->where('create_date BETWEEN "' . date('Y-m-d', strtotime($start)) . '" and "' . date('Y-m-d', strtotime($end)) . '"')
                ->groupBy('customer_id')->findAll();
        } else if ($this->loggedInfo['role'] == "Drone") {
            $this->customerInfo = $this->paymentModel->select('customer_id,sum(amount) as amount,sum(paid_amount) as paid_amount,sum(due_amount) as due_amount')->where(['login_id' => $this->loggedInfo['login_id']])
                ->where('create_date BETWEEN "' . date('Y-m-d', strtotime($start)) . '" and "' . date('Y-m-d', strtotime($end)) . '"')
                ->groupBy('customer_id')->findAll();
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
        if ($this->loggedInfo['role'] == "Admin") {
            $this->customerInfo = $this->paymentModel->select('customer_id,sum(amount) as amount,sum(paid_amount) as paid_amount,sum(due_amount) as due_amount')->where(['payment_type' => 'Pending'])->groupBy('customer_id')->findAll();
        } else if ($this->loggedInfo['role'] == "Drone") {
            $this->customerInfo = $this->paymentModel->select('customer_id,sum(amount) as amount,sum(paid_amount) as paid_amount,sum(due_amount) as due_amount')->where(['payment_type' => 'Pending', 'login_id' => $this->loggedInfo['login_id']])->groupBy('customer_id')->findAll();
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
            $this->customerInfo = $this->paymentModel->select('customer_id,sum(amount) as amount,sum(paid_amount) as paid_amount,sum(due_amount) as due_amount')->where(['payment_type' => 'Paid'])->groupBy('customer_id')->findAll();
        } else if ($this->loggedInfo['role'] == "Drone") {
            $this->customerInfo = $this->paymentModel->select('customer_id,sum(amount) as amount,sum(paid_amount) as paid_amount,sum(due_amount) as due_amount')->where(['payment_type' => 'Paid', 'login_id' => $this->loggedInfo['login_id']])->groupBy('customer_id')->findAll();
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
