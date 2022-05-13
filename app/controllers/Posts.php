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

  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitaze data to string.
      $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

      // Initiate the data.
      $data = [
        'user_id' => get_user_id(),
        'title' => trim($_POST['title']),
        'content' => trim($_POST['content'])
      ];

      // Validate the fields and if data is not empty, post it to the DB.
      if (!empty($data['title'])) {
        if (!empty($data['content'])) {
          // Posting to the DB.
          if ($this->post_model->add_post($data)) {
            flash_message('post_registered', 'Woop! Woop! Post added!');
            redirect_user('posts/index');
          }
        } else {
          flash_message('invalid_content', 'Invalid content!', 'alert alert-danger');
        }
      } else {
        flash_message('invalid_title', 'Invalid title!', 'alert alert-danger');
      }
    } else {
      // If any other request we don't change the data.
      $data = [
        'title' => '',
        'body' => ''
      ];
    }

    // Load the view.
    $this->view('posts/add', $data);
  }

  public function remove()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize data.
      $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

      // Fetch post data.
      $current_user = get_user_id();
      $post_data = $this->post_model->get_single_post($_POST['post_id']);

      // If user_id owns the post, we proceed to delete it. Otherwise we display an error.
      if ($post_data->user_id == $current_user) {
        if ($this->post_model->remove_post($post_data->id)) {
          flash_message('delete_success', 'Post deleted!');
          redirect_user('posts/index');
        }
      } else {
        flash_message('delete_error', 'Could not delete post!', 'alert alert-danger');
      }
    } else {
      flash_message('request_error', 'Something went wrong!', 'alert alert-danger');
    }
  }
}
