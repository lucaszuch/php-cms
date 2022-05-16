<?php
class Posts extends Controller
{
  // Create a variable that automates if posts belongs to user.

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

  public function check_post_onwer(string $post_id)
  {
    // Fetch the current user and the post date based on the post_id.
    $current_user = get_user_id();
    $post_data = $this->post_model->get_single_post($post_id);

    // Check if the user is the post owner.
    if ($post_data->user_id == $current_user) {
      return true;
    }
    return false;
  }

  public function remove()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize data.
      $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

      // If user_id owns the post, we proceed to delete it. Otherwise we display an error.
      if ($this->check_post_onwer($_POST['post_id'])) {
        if ($this->post_model->remove_post($_POST['post_id'])) {
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

  public function edit()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize data.
      $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

      // Prepare data.
      $post_to_edit = [
        'id' => trim($_POST['post_id']),
        'title' => trim($_POST['title']),
        'content' => trim($_POST['content'])
      ];

      // Fetch post data.
      $current_user = get_user_id();
      $post_data = $this->post_model->get_single_post($_POST['post_id']);

      // If user own the post, we proceed to edit it. Otherwise, we display an error.
      if ($this->check_post_onwer($_POST['post_id'])) {
        if ($this->post_model->update_post($post_to_edit)) {
          flash_message('update_success', 'Woop! Post updated!!');
          redirect_user('posts/index');
        } else {
          flash_message('update_error', 'Oops! We could not update it.', 'alert alert-danger');
          redirect_user('posts/index');
        }
      }
    } else {
      // Check if there's a valid post id.
      if (!isset($_GET['id']) || $_GET['id'] == '') {
        redirect_user('posts/index');
      }

      // Fetch the post ID and check if post belongs to the user.
      $_GET = filter_input_array(INPUT_GET, FILTER_UNSAFE_RAW);
      $post_id = $_GET['id'];

      // Fetch post data.
      $current_user = get_user_id();
      $post_data = $this->post_model->get_single_post($post_id);

      // If user_id owns the post, we proceed to delete it. Otherwise we display an error.
      if ($post_data->user_id == $current_user) {
        $data =  [
          'id' => $post_data->id,
          'title' => $post_data->title,
          'content' => $post_data->content
        ];
      } else {
        flash_message('not_owner', 'You are not allowed to edit this post!', 'alert alert-danger');
        redirect_user('posts/index');
      }
    }

    // Load the view.
    $this->view('posts/edit', $data);
  }
}
