<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\CustomerModel;
use App\Models\DroneModel;
use App\Models\LoginModel;
use App\Models\PaymentModel;
use App\Models\TopicsModel;

class Dashboard extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $paymentModel;
    private $droneModel;
    private $customerModel;
    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->loggedInfo = session()->get('LoggedData');
        $this->paymentModel = new PaymentModel();
        $this->droneModel = new DroneModel();
        $this->customerModel = new CustomerModel();
    }
    public function index()
    {
        if ($this->loggedInfo['role'] == "Drone") {
            $todayInfo = $this->paymentModel->where(['estimated_date' => date('Y-m-d'), 'login_id' => $this->loggedInfo['login_id']])->findAll();
            $tomorrowInfo = $this->paymentModel->where(['estimated_date' => date('Y-m-d', strtotime('+ 1 day')), 'login_id' => $this->loggedInfo['login_id']])->findAll();
            $cash = $this->paymentModel->where(['payment_type' => 'Cash', 'login_id' => $this->loggedInfo['login_id']])->select('sum(amount) as amount')->first();
            $credit = $this->paymentModel->where(['payment_type' => 'Credit', 'login_id' => $this->loggedInfo['login_id']])->select('sum(amount) as amount')->first();
            $drone = $this->droneModel->countAllResults();
            $customer = $this->customerModel->where(['login_id' => $this->loggedInfo['login_id']])->countAllResults();
        } else {
            $todayInfo = $this->paymentModel->where(['estimated_date' => date('Y-m-d')])->findAll();
            $tomorrowInfo = $this->paymentModel->where(['estimated_date' => date('Y-m-d', strtotime('+ 1 day'))])->findAll();
            $cash = $this->paymentModel->where(['payment_type' => 'Cash'])->select('sum(amount) as amount')->first();
            $credit = $this->paymentModel->where(['payment_type' => 'Credit'])->select('sum(amount) as amount')->first();
            $drone = $this->droneModel->countAllResults();
            $customer = $this->customerModel->countAllResults();
        }

        $cash = $cash['amount'] > 0 ? $cash['amount'] : '0';
        $credit = $credit['amount'] > 0 ? $credit['amount'] : '0';
        $data = [
            'pageTitle' => 'Ease Crop | Dashboard',
            'pageHeading' => 'Dashboard',
            'loggedInfo' => $this->loggedInfo,
            'todayInfo' => $todayInfo,
            'tomorrowInfo' => $tomorrowInfo,
            'cash'  => $cash,
            'credit'  => $credit,
            'drone' => $drone,
            'customer' => $customer,
            'payment' => $cash + $credit
        ];
        return view('common/top', $data)
            . view('dashboard/index')
            . view('common/bottom');
    }
    public function changepwd()
    {
        $data = [
            'pageTitle' => 'Ease Crop | Dashboard',
            'pageHeading' => 'Dashboard',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('common/top', $data)
            . view('dashboard/changepwd')
            . view('common/bottom');
    }
    public function updatepwd()
    {
        $validation = $this->validate([
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username is required.'
                ]
            ],
            'password' => [
                'rules'  => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must have atleast 5 characters in length.',
                    'max_length' => 'Password must not have characters more thant 20 in length.',
                ],
            ],
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $inputData = array(
                'password' => Hash::make($this->request->getPost("password"))
            );
            $query = $this->loginModel->update($this->loggedInfo['login_id'], $inputData);
            if (!$query) {
                return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
            } else {
                return  redirect()->back()->with('success', 'Your Password Changed Success');
            }
        }
    }
    public function calendar()
    {
        $data = [
            'pageTitle' => 'Ease Crop | Dashboard',
            'pageHeading' => 'Dashboard',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('dashboard/calendar', $data);
    }
    public function load()
    {
        $this->paymentModel->table('payment');
        $this->paymentModel->join('customer', 'payment.customer_id = customer.customer_id');
        $todayInfo = $this->paymentModel->groupBy('customer.mobile')->findAll();

        // $todayInfo = $this->paymentModel->findAll();
        foreach ($todayInfo as $key => $row) {
            $data[] = array(
                'id' => $row['payment_id'],
                'title' => $row['name'],
                'mobile'  => $row['mobile'],
                'crop_place'  => $row['crop_place'],
                'acre'  => $row['acre'],
                'service'  => $row['service'],
                'crop'  => $row['crop'],
                'crop_age'  => $row['crop_age'],
                'fertilizer'  => $row['fertilizer'],
                'start' => $row['estimated_date'],
                'end' => $row['estimated_date'],
                'estimated_fps'  => $row['estimated_fps'],
                'url' => $row['mobile'],
            );
        }
        echo json_encode($data);
    }
}
