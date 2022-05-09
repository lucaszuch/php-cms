<?php

/**
 * Check if there's a valid user logged in.
 */
function get_user_id()
{
  if (isset($_SESSION['user_id'])) {
    return $_SESSION['user_id'];
  }
  return false;
}
