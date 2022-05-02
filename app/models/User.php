<?php

/**
 * Manages the users action from the DB.
 */

class User
{
  private $db;

  public function __construct()
  {
    // Instantiate the DB
    $this->db = new Database;
  }

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

  public function register_user(array $data)
  {
    // Add users to the DB
    $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    // Runs the query and return a boolean to be used on the User clas
    if ($this->db->execute_query()) {
      return true;
    }
    return false;
  }
}
