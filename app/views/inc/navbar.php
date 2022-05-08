<?php

/**
 * Template: Navegation Bar.
 * Included via header.php
 */
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= APP_ROOT ?>"><i class="fa-solid fa-container-storage"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#cms-navbar-mobile" aria-controls="cms-navbar-mobile" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="cms-navbar-mobile">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URL_LINK ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL_LINK ?>/pages/about">About</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-md-0">
        <?php if (!isset($_SESSION['user_id'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL_LINK ?>/users/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL_LINK ?>/users/register">Register</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL_LINK ?>/posts/index">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL_LINK ?>/users/logout">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>