<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\CustomerModel;
use App\Models\PaymentModel;

class Payment extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $customerModel;
    private $paymentInfo;
    private $paymentModel;
    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->paymentModel = new PaymentModel();
        $this->loggedInfo = session()->get('LoggedData');
    }
    public function index()
    {
        $data = [
            'pageTitle' => 'EASE CROP | Payment',
            'pageHeading' => 'Payment',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('common/top', $data)
            . view('payment/index')
            . view('common/bottom');
    }
    public function paymentAction()
    {
        $validation = $this->validate([
            'crop_place' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Crop Place is required.'
                ]
            ],
            'acre' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Acre is required.'
                ]
            ],
            'service' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Service is required.'
                ]
            ],
            'crop' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Crop is required.'
                ]
            ],
            'crop_age' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Crop Age is required.'
                ]
            ],
            'fertilizer' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Fertilizer Age is required.'
                ]
            ],
            'estimated_date' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Estimated Date Age is required.'
                ]
            ],
            'amount' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Amount is required.'
                ]
            ]
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            if (empty($this->request->getPost("reference_id"))) {
                $input2 = [
                    'name' => $this->request->getPost("rname"),
                    'mobile' => $this->request->getPost("rmobile"),
                    'reference_id' => 0,
                    'login_id' => $this->loggedInfo['login_id'],
                    'status' => 1
                ];
                $query2 = $this->customerModel->insert($input2);
                $reference_id = $this->customerModel->getInsertID();
            } else {
                $reference_id = $this->request->getPost("reference_id");
            }
            if (empty($this->request->getPost("customer_id"))) {
                $input1 = [
                    'name' => $this->request->getPost("cname"),
                    'mobile' => $this->request->getPost("cmobile"),
                    'reference_id' => $reference_id,
                    'login_id' => $this->loggedInfo['login_id'],
                    'status' => 1
                ];
                $query1 = $this->customerModel->insert($input1);
                $customer_id = $this->customerModel->getInsertID();
            } else {
                $customer_id = $this->request->getPost("customer_id");
            }
            $inputData = [
                'customer_id' => $customer_id,
                'crop_place' => $this->request->getPost("crop_place"),
                'reference_id' => $reference_id,
                'acre' => $this->request->getPost("acre"),
                'service' => $this->request->getPost("service"),
                'crop' => $this->request->getPost("crop"),
                'crop_age' => $this->request->getPost("crop_age"),
                'fertilizer' => $this->request->getPost("fertilizer"),
                'estimated_date' => $this->request->getPost("estimated_date"),
                'amount' => $this->request->getPost("amount"),
                'payment_type' => $this->request->getPost("payment_type"),
                'login_id' => $this->loggedInfo['login_id'],
                'status' => 1,
                'create_date' => date('Y-m-d H:i:s')
            ];
            $query = $this->paymentModel->insert($inputData);
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            return  redirect()->to('dashboard/' . Hash::path('index'))->with('success', 'Congratulations! Payment Done');
        }
    }
    public function paid()
    {
        $inputData = array(
            'payment_type'    => 'Cash',
        );
        $payment_id = $this->request->getPost("payment_id");
        $query = $this->paymentModel->update($payment_id, $inputData);
        if (!$query) {
            $data = [
                'success' => false
            ];
        } else {
            $data = [
                'success' => true
            ];
        }
        return $this->response->setJSON($data);
    }
}
