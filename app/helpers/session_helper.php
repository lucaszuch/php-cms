<?php
session_start();

function flash_message(string $name = '', string $message = '', string $class = 'alert alert-success')
{
  if (!empty($name)) {
    if (!empty($message) && empty($_SESSION[$name])) {
      // If session exists, we unset it before starting a new one
      if (!empty($_SESSION[$name])) {
        unset($_SESSION['name']);
      }

      if (!empty($_SESSION[$name . '_class'])) {
        unset($_SESSION[$name . '_class']);
      }

      // Once we know there are no pending $_SESSION, we start a new one.
      $_SESSION[$name] = $message;
      $_SESSION[$name . '_class'] = $class;
    } elseif (empty($message) && !empty($_SESSION[$name])) {
      // If a message is passed but the session don't exist, we check if there's a class passed when the function was called.
      // With that we build the container and echo to the screen.
      // We unset it to make sure that the alert can be called again.
      $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
      echo '<div class="' . $class . '" id="flash_message">' . $_SESSION[$name] . '</div>';
      unset($_SESSION[$name]);
      unset($_SESSION[$name . '_class']);
    }
  }
}
