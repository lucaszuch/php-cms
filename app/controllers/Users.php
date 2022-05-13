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
    // Check for post.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize data to string.
      $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

      // Initiate the data.
      $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password'])
      ];

      // Check if email is already registered.
      if (!empty($data['email'])) {
        if ($this->userModel->find_user_email($data['email'])) {
          die('Already on DB!');
        } else {
          // Validation needs to change - for now we only check the email.
          // Hash the password.
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Add the user to the DB.
          if (!empty($data['password'])) {
            if ($this->userModel->register_user($data)) {
              flash_message('register_ok', 'Register! Please log in!');
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
        'email' => $_POST['email'],
        'password' => $_POST['password'],
      ];

      // Check if email is registered
      if (!empty($data['email'])) {
        if ($this->userModel->find_user_email($data['email'])) {
          if ($data['password']) {
            // Initialize the login within a variable
            $loggedUser = $this->userModel->login($data['email'], $data['password']);

            // We check if the response was positive and manage accordingly
            if ($loggedUser) {
              // Create a new session and redirect user
              $this->current_user($loggedUser);
              flash_message('login_ok', 'Welcome ' . $loggedUser->name . '!');
              $this->create_user_session($loggedUser);
            } else {
              die('Invalid password!');
            }
          }
        } else {
          // User not found.
          die('Invalid email!');
        }
      }
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

  // Create a new session to a logged in user and redirect to the posts page.
  public function create_user_session($user)
  {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['name'] = $user->name;
    $_SESSION['email'] = $user->email;
    redirect_user('posts/index');
  }

  // Remove all the session information about the user.
  public function logout()
  {
    unset($_SESSION['user_id']);
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    session_destroy();
    redirect_user('pages/index');
  }

  // Support function that check if there's a user currently logged in.
  public function current_user($user)
  {
    if (isset($_SESSION['user_id'])) {
      return $user;
    }
    return;
  }
}
