<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\CustomerModel;
use App\Models\HistoryModel;
use App\Models\PaymentModel;
use App\Models\ReferenceModel;

class Payment extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $customerModel;
    private $paymentInfo;
    private $paymentModel;
    private $historyModel;
    private $referenceModel;
    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->paymentModel = new PaymentModel();
        $this->historyModel = new HistoryModel();
        $this->referenceModel = new ReferenceModel();
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
                    'required' => 'Next Estimated Date is required.'
                ]
            ],
            'estimated_fps' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Next Estimated F/P/S is required.'
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
                    'status' => 1
                ];
                $query2 = $this->referenceModel->insert($input2);
                $reference_id = $this->referenceModel->getInsertID();
            } else {
                $reference_id = $this->request->getPost("reference_id");
            }
            if (empty($this->request->getPost("customer_id"))) {
                $input1 = [
                    'name' => $this->request->getPost("cname"),
                    'mobile' => $this->request->getPost("cmobile"),
                    'status' => 1
                ];
                $query1 = $this->customerModel->insert($input1);
                $customer_id = $this->customerModel->getInsertID();
            } else {
                $customer_id = $this->request->getPost("customer_id");
            }
            $amount_type = $this->request->getPost("amount_type");
            if ($amount_type == 'Credit') {
                $due_amount = $this->request->getPost("amount");
                $paid_amount = 0;
                $payment_type = 'Pending';
            } else {
                $due_amount = 0;
                $paid_amount = $this->request->getPost("amount");
                $payment_type = 'Paid';

                $details = 'No Image';
                if ($amount_type == 'Online') {
                    $details1 = $this->request->getFile('details');
                    if (!$details1->hasMoved()) {
                        $details = $details1->getRandomName();
                        $details1->move('uploads', $details);
                    }
                } else {
                    $details = 'Cash Taken by Hand';
                }
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
                'estimated_fps' => $this->request->getPost("estimated_fps"),
                'amount' => $this->request->getPost("amount"),
                'due_amount' => $due_amount,
                'paid_amount' => $paid_amount,
                'payment_type' => $payment_type,
                'login_id' => $this->loggedInfo['login_id'],
                'status' => 1,
                'create_date' => date('Y-m-d H:i:s')
            ];
            $query = $this->paymentModel->insert($inputData);
            $payment_id = $this->paymentModel->getInsertID();
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            if ($amount_type == 'Online' || $amount_type == 'Cash') {
                $inputData = [
                    'amount_type' => $amount_type,
                    'amount_paid' => $paid_amount,
                    'details' => $details,
                    'payment_id' => $payment_id,
                    'login_id' => $this->loggedInfo['login_id'],
                    'create_date' => date('Y-m-d H:i:s')
                ];

                $query = $this->historyModel->insert($inputData);
            }
            return  redirect()->to('dashboard/' . Hash::path('index'))->with('success', 'Congratulations! Payment Done');
        }
    }
    public function pending()
    {
        $payment_id = $this->request->getPost("payment_id");
        $paymentInfo = $this->paymentModel->where(['payment_id' => $payment_id])->findAll();

        $data = [
            'pageTitle' => 'EASE CROP | Payment',
            'pageHeading' => 'Payment',
            'loggedInfo' => $this->loggedInfo,
            'paymentInfo' => $paymentInfo
        ];
        return view('common/top', $data)
            . view('payment/pending')
            . view('common/bottom');
    }
    public function paid()
    {
        $amount = $this->request->getPost("amount");
        $due_amount = $this->request->getPost("due_amount");
        $paid_amount = $this->request->getPost("paid_amount");
        $amount_paid = $this->request->getPost("amount_paid");
        $payment_id = $this->request->getPost("payment_id");

        $due_amount = $due_amount - $amount_paid;
        $paid_amount = $paid_amount + $amount_paid;

        $amount_type = $this->request->getPost("amount_type");
        $details = 'No Image';
        if ($amount_type == 'Online') {
            $details1 = $this->request->getFile('details');
            if (!$details1->hasMoved()) {
                $details = $details1->getRandomName();
                $details1->move('uploads', $details);
            }
        } else {
            $details = 'Cash Taken by Hand';
        }
        $inputData = [
            'amount_type' => $amount_type,
            'amount_paid' => $amount_paid,
            'details' => $details,
            'payment_id' => $payment_id,
            'login_id' => $this->loggedInfo['login_id'],
            'create_date' => date('Y-m-d H:i:s')
        ];

        $query = $this->historyModel->insert($inputData);

        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            $payment_type = $due_amount == 0 ? 'Paid' : 'Pending';
            $inputData1 = array(
                'due_amount'    => $due_amount,
                'paid_amount' => $paid_amount,
                'payment_type' => $payment_type
            );
            $query = $this->paymentModel->update($payment_id, $inputData1);
            return  redirect()->to('dashboard/' . Hash::path('index'))->with('success', 'Congratulations! Payment Done');
        }
    }
}
