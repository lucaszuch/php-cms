<?php require APP_ROOT . '/views/inc/header.php'; ?>
<div class="row">
  <?php flash_message('login_ok'); ?>
  <h1>POSTS</h1>
</div>
<div class="row mb-3">
  <nav class="nav">
    <a class="nav-link active" aria-current="page" href="<?= URL_LINK ?>/posts/add">New Post</a>
    <a class="nav-link" href="<?= URL_LINK ?>/posts/edit">Edit Post</a>
    <a class="nav-link" href="<?= URL_LINK ?>/posts/remove">Remove Post</a>
  </nav>
</div>
<div class="row">
  <div class="col-12 mx-auto">
    Posts should be dislayed here.
  </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>