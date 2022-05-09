<?php

/**
 * Handles the Pages display and data. All the pages must call a view and can pass data accordingly.
 */
class Pages extends Controller
{
  public function __construct()
  {
    // Do something.
  }

  public function index()
  {
    // Data to display
    $view_data = array(
      'site_index_title' => 'PHP CMS',
      'site_index_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
    );
    $this->view('pages/index', $view_data);
  }

  public function about()
  {
    $this->view('pages/about');
  }
}
