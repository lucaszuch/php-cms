<?php require APP_ROOT . '/views/inc/header.php'; ?>
<div class="row">
  <?php flash_message('invalid_title'); ?>
  <?php flash_message('invalid_content'); ?>
  <h1>EDIT POST</h1>
</div>
<div class="row">
  <div class="col-12 mx-auto">
    <form action="<?= URL_LINK ?>/posts/edit" method="POST">
      <input type="hidden" name="post_id" value="<?= $data['id'] ?>" />
      <div class="form-group mt-3">
        <label for="email">Title: <sup>*</sup></label>
        <input type="title" name="title" class="form-control" value="<?= $data['title'] ?>" />
      </div>
      <div class="form-group mt-3">
        <label for="email">Content: <sup>*</sup></label>
        <textarea type="content" name="content" rows="10" class="form-control"><?= $data['content'] ?></textarea>
      </div>
      <div class="row">
        <div class="col-4 mt-3">
          <button type="submit" class="btn btn-success">SUBMIT</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>