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

  // Add post to the DB.
  public function add_post(array $post_data)
  {
    $this->db->query('INSERT INTO posts (user_id, title, content) VALUES (:user, :title, :content)');
    $this->db->bind(':user', $post_data['user_id']);
    $this->db->bind(':title', $post_data['title']);
    $this->db->bind(':content', $post_data['content']);

    // Run query
    if ($this->db->execute_query()) {
      return true;
    }
    return false;
  }

  // Get a single post.
  public function get_single_post(string $post_id)
  {
    $this->db->query("SELECT * FROM posts WHERE id = :id");
    $this->db->bind(':id', $post_id);

    // Run the query.
    if ($this->db->execute_query()) {
      return $this->db->result_single();
    }
    return false;
  }

  // Remove a post from the DB.
  public function remove_post(string $post_id)
  {
    $this->db->query("DELETE FROM posts WHERE id = :id");
    $this->db->bind(':id', $post_id);

    // Run query.
    if ($this->db->execute_query()) {
      return true;
    }
    return false;
  }

  // Update a post.
  public function update_post(array $post_data)
  {
    $this->db->query("UPDATE posts SET title = :title, content = :content WHERE id = :id");
    $this->db->bind(':id', $post_data['id']);
    $this->db->bind(':title', $post_data['title']);
    $this->db->bind(':content', $post_data['content']);

    // Run query.
    if ($this->db->execute_query()) {
      return true;
    }
    return false;
  }
}
