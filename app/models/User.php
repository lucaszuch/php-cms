<?php

/**
 * Manages the users action from the DB.
 */

class User
{
  private $db;

  // Instantiate the DB
  public function __construct()
  {
    $this->db = new Database;
  }

  // Find the user based on its email.  
  public function find_user_email(string $email)
  {
    // Return all the users with that specific emails
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind(':email', $email);

    // Store the results in a variable
    $row = $this->db->result_single();

    // Check if the email already exists in the DB
    if ($this->db->row_count() > 0) {
      return true;
    }
    return false;
  }

  // Find the user based on its ID and return all its data.
  public function get_user(string $id)
  {
    // Return all the users with that specific emails
    $this->db->query('SELECT * FROM users WHERE id = :id');
    $this->db->bind(':id', $id);

    // Store the results in a variable
    $row = $this->db->result_single();

    // Check if the email already exists in the DB
    if ($this->db->row_count() > 0) {
      return $row;
    }
    return;
  }

  public function register_user(array $data)
  {
    // Add users to the DB
    $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    // Runs the query and return a boolean to be used on the User class.
    if ($this->db->execute_query()) {
      return true;
    }
    return false;
  }

  public function login(string $email, string $password)
  {
    // Find the user in the DB.
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind(':email', $email);

    // Return a single result and fetch the password from the row.
    $row = $this->db->result_single();
    $hashed_password = $row->password;

    // As the password is hashed, we have to match them.
    // If it's correct we will return the whole row, otherwise false and the checking will fail.
    if (password_verify($password, $hashed_password)) {
      return $row;
    } else {
      return false;
    }
  }
}
