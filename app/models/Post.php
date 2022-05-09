<?php

/**
 * Manages posts - CRUD.
 */
class Post
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Return all the posts from the user.
  public function get_posts(string $user_id)
  {
    $this->db->query("SELECT *, posts.id as post_id, users.id as user_id  FROM posts INNER JOIN users ON posts.user_id = users.id WHERE user_id = :id");
    $this->db->bind(':id', $user_id);
    if ($this->db->execute_query()) {
      return $this->db->result_set();
    }
    return false;
  }
}
