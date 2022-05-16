<?php require APP_ROOT . '/views/inc/header.php'; ?>
<div class="row">
  <?php flash_message('login_ok'); ?>
  <?php flash_message('post_registered'); ?>
  <?php flash_message('request_error'); ?>
  <?php flash_message('delete_error'); ?>
  <?php flash_message('delete_success'); ?>
  <?php flash_message('not_owner'); ?>
  <?php flash_message('update_error'); ?>
  <?php flash_message('update_success'); ?>
  <h1>POSTS</h1>
</div>
<div class="row mb-3">
  <nav class="nav">
    <a class="nav-link active" aria-current="page" href="<?= URL_LINK ?>/posts/add">New Post</a>
  </nav>
</div>
<div class="row">
  <?php if (!empty($data['all_posts'])) : ?>
    <?php foreach ($data['all_posts'] as $item) : ?>
      <div class="col-12 col-md-6 col-lg-4 mx-auto">
        <div class="card mb-3">
          <div class="card-header">
            Posted by: <?= $item->name ?>
          </div>
          <div class="card-body">
            <h5 class="card-title">
              <?= $item->title ?>
            </h5>
            <p class="card-text">
              <?= $item->content ?>
            </p>
            <a href="<?= URL_LINK ?>/posts/edit/?id=<?= $item->post_id ?>" class="btn btn-primary">Edit</a>
            <form action="<?= URL_LINK ?>/posts/remove" method="POST">
              <input type="hidden" name="post_id" value="<?= $item->post_id ?>" />
              <button type="submit" class="btn btn-danger">Remove</button>
            </form>
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