<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\DroneModel;
use App\Models\LoginModel;

class Drone extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $droneInfo;
    private $droneModel;
    public function __construct()
    {
        $this->droneModel = new DroneModel();
        $this->loginModel = new LoginModel();
        $this->loggedInfo = session()->get('LoggedData');
    }
    public function index()
    {
        $this->droneInfo = $this->droneModel->findAll();
        $data = [
            'pageTitle' => 'EASE CROP | Drone',
            'pageHeading' => 'Drone',
            'loggedInfo' => $this->loggedInfo,
            'droneInfo'    => $this->droneInfo
        ];
        return view('common/top', $data)
            . view('drone/index')
            . view('common/bottom');
    }
    public function add()
    {
        $data = [
            'pageTitle' => 'EASE CROP | Drone',
            'pageHeading' => 'Drone',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('common/top', $data)
            . view('drone/add')
            . view('common/bottom');
    }
    public function addAction()
    {
        $validation = $this->validate([
            'drone_number' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Drone Number is required.'
                ]
            ],
            'pilot_operator' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilot Operatoris required.'
                ]
            ],
            'mobile' => [
                'rules'  => 'required|is_unique[drone.mobile]',
                'errors' => [
                    'required' => 'Phone Number is required.',
                    'is_unique' => 'Operator Unique'
                ]
            ]
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $password = "123456";
            $values = [
                'role' => 'Drone',
                'name' => $this->request->getPost("pilot_operator"),
                'username' => $this->request->getPost("mobile"),
                'password' => Hash::make($password),
            ];
            $this->loginModel->insert($values);
            $login_id = $this->loginModel->getInsertID();
            $inputData = [
                'drone_number' => $this->request->getPost("drone_number"),
                'pilot_operator' => $this->request->getPost("pilot_operator"),
                'mobile' => $this->request->getPost("mobile"),
                'login_id' => $login_id,
                'created_by' => $this->loggedInfo['login_id'],
                'status' => 1
            ];
            $query = $this->droneModel->insert($inputData);
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            return  redirect()->to('drone/' . Hash::path('index'))->with('success', 'Congratulations! Drone Registered');
        }
    }
    public function show($login_id = 0){
        session()->remove('LoggedData');
        $logged_info = $this->loginModel->where('login_id', $login_id)->first();
        session()->set('LoggedData', $logged_info);
        return  redirect()->to('dashboard/' . Hash::path('index'));
    }
}
