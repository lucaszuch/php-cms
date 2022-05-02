<?php

/**
 * Redirect the user to a specific page.
 */
function redirect_user(string $page)
{
  header('location: ' . URL_LINK . '/' . $page);
}
