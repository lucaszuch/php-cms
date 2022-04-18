<?php

/**
 * Handles the Pages display and data. All the pages must call a view and can pass data accordingly.
 */
class Pages extends Controller
{
  public function __construct()
  {
    // Example for models
    //$this->post_model = $this->model('Post');
  }

  public function index()
  {
    // Examples for posts
    //$posts = $this->post_model->get_posts();

    // Data to display
    $view_data = array(
      'title' => 'The title',
      // 'posts' => $posts
    );
    $this->view('pages/index', $view_data);
  }

  public function about()
  {
    $this->view('pages/about');
  }
}
