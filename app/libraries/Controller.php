<?php

/**
 * Base Controller.
 * Loads models/views.
 */
class Controller
{
  public function model(string $model)
  {
    require_once '../app/models/' . $model . '.php';

    return new $model();
  }

  public function view(string $view, array $data = [])
  {
    if (file_exists('../app/views/' . $view . '.php')) {
      require_once '../app/views/' . $view . '.php';
    } else {
      die('View does not exists!');
    }
  }
}
