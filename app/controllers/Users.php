<?php

class Users extends Controller
{
  public function __construct()
  {
    // Loading the model
    $this->userModel = $this->model('User');
  }

  public function register()
  {
    // Check for post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize data to string
      $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

      // Initiate the data
      $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password'])
      ];

      // Check if email is already registered
      if (!empty($data['email'])) {
        if ($this->userModel->find_user_email($data['email'])) {
          die('Already on DB!');
        } else {
          // Validation needs to change - for now we only check the email
          // Hash the password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Add the user to the DB
          if (!empty($data['password'])) {
            if ($this->userModel->register_user($data)) {
              redirect_user('users/login');
            } else {
              die('Something went wrong!');
            }
          }
        }
      }
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

      // Load the view
      $this->view('users/register', $data);
    }
  }

  public function login()
  {
    // Check for post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize data to string
      $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

      // Initiate the data
      $data = [
        'email' => $_POST['name'],
        'password' => $_POST['name'],
      ];
    } else {
      $data = [
        'email' => '',
        'password' => '',
        'email_error' => '',
        'password_error' => ''
      ];

      // Load the view
      $this->view('users/login', $data);
    }
  }
}
