<?php

namespace App\Controllers;

use App\Models\UserModel;

class Signup extends BaseController
{
    public function __construct()
    {
        // Load the Form Helper
        helper('form');
    }

    public function index(): string
    {
        return view('signup');
    }

    public function submit()
    {
        // Check if it's an AJAX request
        if ($this->request->isAJAX()) {
            // Validate and process form data
            $validationRules = [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|valid_email|is_unique[users.email]',
                'pnumber' => 'required',
                'password' => 'required|min_length[6]'
                // Add more validation rules as needed
            ];

            if (!$this->validate($validationRules)) {
                // Validation failed, return error response
                $response = [
                    'status' => 'error',
                    'message' => validation_errors(),
                ];
            } else {
                // Validation passed, insert data into the database
                $userModel = new UserModel();

                $userData = [
                    'fname' => $this->request->getVar('fname'),
                    'lname' => $this->request->getVar('lname'),
                    'email' => $this->request->getVar('email'),
                    'phone' => $this->request->getVar('pnumber'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ];

                $userModel->insert($userData);

                // Return success response
                $response = [
                    'status' => 'success',
                ];
            }

            return $this->response->setJSON($response);
        } else {
            // If it's not an AJAX request, return to the signup page
            return redirect()->to(base_url('signup'));
        }
    }

    public function success(): string
    {
        return view('login');
    }
}
