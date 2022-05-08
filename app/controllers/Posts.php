<?php
class Posts extends Controller
{
  // Load the post index through a model.
  public function index()
  {
    $data = [];

    $this->view('posts/index');
  }
}
