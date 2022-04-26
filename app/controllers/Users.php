<?php

class Users extends Controller
{
  public function __construct()
  {
    // Do something
  }

  public function register()
  {
    // Check for post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Form
    } else {
      $data = [
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'name_error' => '',
        'email_error' => '',
        'password_error' => '',
        'confirm_password_error' => ''
      ];

      print_r($data);

      // Load the view
      $this->view('users/register', $data);
    }
  }

  public function login()
  {
    // Check for post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Form
    } else {
      $data = [
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'name_error' => '',
        'email_error' => '',
        'password_error' => '',
        'confirm_password_error' => ''
      ];

      print_r($data);

      // Load the view
      $this->view('users/login', $data);
    }
  }
}
