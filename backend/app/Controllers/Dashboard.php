<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\LoginModel;
use App\Models\PaymentModel;
use App\Models\TopicsModel;

class Dashboard extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $paymentModel;
    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->loggedInfo = session()->get('LoggedData');
        $this->paymentModel = new PaymentModel();
    }
    public function index()
    {
        $todayInfo = $this->paymentModel->where(['estimated_date' => date('Y-m-d')])->findAll();
        $tomorrowInfo = $this->paymentModel->where(['estimated_date' => date('Y-m-d', strtotime('+ 1 day'))])->findAll();
        $data = [
            'pageTitle' => 'Ease Crop | Dashboard',
            'pageHeading' => 'Dashboard',
            'loggedInfo' => $this->loggedInfo,
            'todayInfo' => $todayInfo,
            'tomorrowInfo' => $tomorrowInfo
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
}
