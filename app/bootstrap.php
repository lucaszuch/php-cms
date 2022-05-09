<?php
// Load Config.
require_once 'config/config.php';

// Load helpers.
require_once 'helpers/url_helpers.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/get_user_id.php';

// Displays the error handling if DISPLAY_ERROR is set true.
if (DISPLAY_ERROR) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

// Load Libraries.
spl_autoload_register(function ($class_name) {
  require_once 'libraries/' . $class_name . '.php';
});
