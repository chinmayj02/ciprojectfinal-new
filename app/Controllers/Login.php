<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function submit()
{
    // Get form input data
    $email = $this->request->getPost('email');
    $password = (string) $this->request->getPost('password'); // Explicitly cast to string

    // Load the UserModel
    $userModel = new UserModel();

    // Find the user by email
    $user = $userModel->where('email', $email)->first();

    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // User login successful
            // You can set user session here if needed
            // For example, set the user's ID in the session
            session()->set('user_id', $user['id']);
            return $this->response->setJSON(['success' => true]);
        }
    }

    // Login failed
    return $this->response->setJSON(['success' => false, 'message' => 'Invalid login credentials']);
}

    public function success(): string
    {
        return view('welcome');
    }
}
