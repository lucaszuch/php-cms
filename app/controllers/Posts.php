<?php
class Posts extends Controller
{

  public function __construct()
  {
    // We check if there's a valid user when the controller is called. We don't want not logged in users to access the post pages.
    if (!get_user_id()) {
      redirect_user('users/login');
    }

    // Fetch athe Post model.
    $this->post_model = $this->model('Post');
  }

  // Load the post index through a model.
  public function index()
  {
    // Fetch all the posts for the user.
    $posts = $this->post_model->get_posts(get_user_id());

    $data = [
      'all_posts' => $posts
    ];

    $this->view('posts/index', $data);
  }
}
