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
  <?php if (!empty($data['all_posts'])) : ?>
    <?php foreach ($data['all_posts'] as $item) : ?>
      <div class="col-12 col-md-6 col-lg-4 mx-auto">
        <div class="card">
          <div class="card-header">
            Posted by: <?= $item->name ?>.
          </div>
          <div class="card-body">
            <h5 class="card-title">
              <?= $item->title ?>.
            </h5>
            <p class="card-text">
              <?= $item->content ?>.
            </p>
            <a href="<?= URL_LINK ?>/posts/show/<?= $item->post_id ?>" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <div class="col-6 mx-auto">
      <div class="card">
        <div class="card-body">
          <p class="card-text text-center">
            No posts available. Click <a href="<?= URL_LINK ?>/posts/add">here</a> to create your first post!
          </p>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>